<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * MamonSoft 
 *
 * Kernel
 *
 * @package pace\application\modules\panel\model\beneficiario
 * @subpackage utilidad
 * @author Carlos Peña
 * @copyright Derechos Reservados (c) 2015 - 2016, MamonSoft C.A.
 * @link http://www.mamonsoft.com.ve
 * @since version 1.0
 */

class KCargador extends CI_Model{
  
  /**
  * @var MBeneficiario
  */
  var $Beneficiario = null;

  /**
  * @var Complejidad del Manejador (Driver)
  */
  var $Nivel = 0;

  /**
  * @var array
  */
  var $Resultado = array();

  /**
  * Iniciando la clase, Cargando Elementos Pace
  *
  * @access public
  * @return void
  */
  public function __construct(){
    parent::__construct();
    $this->load->model('kernel/KCalculo');
    $this->load->model('kernel/KGenerador'); 
  }
  

  function ConsultarBeneficiario($id = '', $param = array()){
    $this->load->model('fisico/MBeneficiario');
    $this->MBeneficiario->ObtenerID('11953710'); 
    $this->KCalculo->Ejecutar($this->MBeneficiario);
    return $this->MBeneficiario;
  } 

  /**
   * Generar Indices para procesos de lotes (Activos)
   *
   * Creación de tablas para los cruce en el esquema space como
   * tablacruce permite ser indexada para evaluar la tabla movimiento
   * tipos de movimiento [3,31,32] dando como resultado del crosstab
   * cedula | Deposito AA | Deposito Dia Adicionales | Deposito Garantias
   *
   *  ---------------------------------------------
   *  INICIANDO PROCESOS POR LOTES
   *  ---------------------------------------------
   *
   * @return  void
   */
  public function PrepararIndices(){
    $this->load->model('kernel/KSensor');
    $this->load->model('comun/DBSpace');    
    $rs = $this->DBSpace->consultar(
          "DROP TABLE IF EXISTS space.tablacruce;
          CREATE TABLE space.tablacruce AS SELECT * FROM space.crosstab(
          'select b.cedula, m.tipo_movimiento_id, SUM(monto) AS monto 
          from beneficiario b, movimiento m
          WHERE 
          b.cedula=m.cedula AND
          b.status_id=201 AND
          m.tipo_movimiento_id IN (3,31,32)
          GROUP BY b.cedula, m.tipo_movimiento_id
          ORDER BY b.cedula,tipo_movimiento_id' ) AS rs 
          (cedula character varying(12), asig_antiguedad numeric, dep_adicional numeric, dep_garantia numeric);
          CREATE INDEX tablacruce_cedula ON space.tablacruce (cedula);
          "  );
  }

  
  public function IniciarLote($directiva, $fecha, $archivo, $autor){
    ini_set('memory_limit', '512M'); //Aumentar el limite de PHP
   
    $this->load->model('comun/Dbpace');
    $this->load->model('kernel/KSensor');
    $this->load->model('fisico/MBeneficiario');

    $con = $this->DBSpace->consultar("
      SELECT 
        beneficiario.nombres, beneficiario.apellidos,
        beneficiario.cedula, fecha_ingreso,f_ult_ascenso, grado.codigo,
        beneficiario.componente_id, n_hijos, st_no_ascenso,
        tablacruce.asig_antiguedad,tablacruce.dep_adicional,tablacruce.dep_garantia,
        st_profesion,anio_reconocido, mes_reconocido,dia_reconocido
        FROM 
          beneficiario  
        JOIN 
          grado ON beneficiario.grado_id=grado.id
        LEFT JOIN space.tablacruce ON beneficiario.cedula=space.tablacruce.cedula
        WHERE beneficiario.status_id=201 LIMIT 50
      ");
  
      $this->asignarBeneficiario($con->rs, $directiva, $fecha, $archivo, $autor);
  
      $this->evaluarLotesLinuxComando($archivo);
  }


  private function asignarBeneficiario($obj, $id, $fecha, $archivo, $autor){
    $this->load->model('kernel/KCalculoLote');
    $this->load->model('kernel/KDirectiva');
    $Directivas = $this->KDirectiva->Cargar($id); //Directivas
    $this->load->model('kernel/KPerceptron'); //Red Perceptron Aprendizaje de patrones
    $lst = array(); //
    $file = fopen("tmp/" . $archivo . ".csv","a") or die("Problemas"); 

    $linea = 'cedula;grado_codigo;grado;componente_id;componente;apellidos_nombres;fecha_ingreso;tiempo_servicio;n_hijos;fecha_ultimo_ascenso;antiguedad_grado;sueldo_base;';
    $linea .= 'prima_tmt;prima_transporte;prima_smt;prima_tiemposervicio;prima_dmt;prima_descendencia;prima_emt;prima_especial;prima_nmt;';
    $linea .= 'prima_noascenso;prima_pmt;prima_profesionalizacion;';
    $linea .= 'sueldo_mensual;alicuota_aguinaldos;alicuota_vacaciones;sueldo_integral;asignacion_antiguedad;';
    $linea .= 'deposito_banco;garantias_acumuladas;dias_adicionales_acumulados;no_depositado_banco;garantias;dias_adicionales';
    fputs($file,$linea);
    fputs($file,"\n");  
    foreach ($obj as $k => $v) {
      $Bnf = new $this->MBeneficiario;
      $this->KCalculoLote->Instanciar($Bnf, $Directivas);

      $linea = $this->generarConPatrones($Bnf,  $this->KCalculoLote, $this->KPerceptron, $fecha, $Directivas, $v);

      fputs($file,$linea);
      fputs($file,"\n");      
      unset($Bnf);
    }

    fclose($file);
    //print_r($this->KPerceptron->Neurona);
    //echo count($this->KPerceptron->Neurona);
  }

  /**
  * Generar Codigos por Patrones en la Red de Inteligencia
  *
  * @param MBeneficiario
  * @param KCalculoLote
  * @param KPerceptron
  * @param KDirectiva
  * @param object
  * @return void
  */
  private function generarConPatrones(MBeneficiario &$Bnf, KCalculoLote &$CalculoLote, KPerceptron &$Perceptron, $fecha, $Directivas, $v){
      $Bnf->cedula = $v->cedula;            
      $Bnf->deposito_banco = $v->asig_antiguedad; //Individual de la Red
      $Bnf->apellidos = $v->apellidos; //Individual del Objeto
      $Bnf->nombres = $v->nombres; //Individual del Objeto
      $Bnf->garantias_acumuladas = $v->dep_garantia; //Individual del Objeto
      $Bnf->dias_adicionales_acumulados = $v->dep_adicional; //Individual del Objeto
      $Bnf->fecha_ingreso = $v->fecha_ingreso;
      $Bnf->numero_hijos = $v->n_hijos;
      $Bnf->no_ascenso = $v->st_no_ascenso;
      $Bnf->componente_id = $v->componente_id;
      $Bnf->componente_nombre = $Directivas['com'][$v->componente_id];
      $Bnf->grado_codigo = $v->codigo;
      $Bnf->grado_nombre = $Directivas['sb'][$v->codigo.'M']['gr'];
      $Bnf->fecha_ultimo_ascenso = $v->f_ult_ascenso;
      $Bnf->fecha_retiro = $fecha;
      $Bnf->prima_profesionalizacion_mt = $v->st_profesion;

      $patron = md5($v->fecha_ingreso.$v->n_hijos.$v->st_no_ascenso.$v->componente_id.
        $v->codigo.$v->f_ult_ascenso.$v->st_profesion.$v->anio_reconocido.$v->mes_reconocido.$v->dia_reconocido);      

      //GENERADOR DE CALCULOS DINAMICOS
      if(!isset($Perceptron->Neurona[$patron])){
        $CalculoLote->Ejecutar(); 

        $segmentoincial = $Bnf->sueldo_base . ';' . $Bnf->prima_transporte_mt . ';' . 
                          $Bnf->prima_transporte . ';' . $Bnf->prima_tiemposervicio_mt . ';' . 
                          $Bnf->prima_tiemposervicio . ';' . $Bnf->prima_descendencia_mt . ';' . 
                          $Bnf->prima_descendencia . ';' . $Bnf->prima_especial_mt . ';' . 
                          $Bnf->prima_especial . ';' . $Bnf->prima_noascenso_mt . ';' . 
                          $Bnf->prima_noascenso . ';' . $Bnf->prima_profesionalizacion_mt . ';' . 
                          $Bnf->prima_profesionalizacion . ';' . $Bnf->sueldo_mensual . ';' . 
                          $Bnf->aguinaldos . ';' . $Bnf->vacaciones . ';' . $Bnf->sueldo_integral . ';' . $Bnf->asignacion_antiguedad . ';';
        $segmentofinal =  $Bnf->garantias . ';' . $Bnf->dias_adicionales;      

        $Perceptron->Aprender($patron, array(
          'T_SERVICIO' => $Bnf->tiempo_servicio,
          'A_ANTIGUEDAD' => $Bnf->asignacion_antiguedad,
          'S_INTEGRAL' => $Bnf->sueldo_integral, 
          'SINCIAL' => $segmentoincial, 
          'SFINAL' =>  $segmentofinal)
        );

        $linea = $this->generarLinea($Bnf);

      }else{
        $Bnf->tiempo_servicio = $Perceptron->Neurona[$patron]['T_SERVICIO'];
        $Bnf->asignacion_antiguedad = $Perceptron->Neurona[$patron]['A_ANTIGUEDAD'];
        $Bnf->sueldo_integral = $Perceptron->Neurona[$patron]['S_INTEGRAL'];
        $CalculoLote->GenerarNoDepositadoBanco();
        $linea = $this->generarLineaMemoria($Bnf, $Perceptron->Neurona[$patron]);
      }
      return $linea;
  }


  private function generarLinea($Bnf){

    return 
        $Bnf->cedula . ';' .  // 1
        $Bnf->grado_codigo . ';' . // 2
        $Bnf->grado_nombre . ';' . // 3
        $Bnf->componente_id . ';' .  //4
        $Bnf->componente_nombre . ';' . // 5
        $Bnf->apellidos . ' ' . $Bnf->nombres . ';' .  // 6
        $Bnf->fecha_ingreso . ';' . // 7
        $Bnf->tiempo_servicio . ';' . // 8
        $Bnf->numero_hijos . ';' . // 9
        $Bnf->fecha_ultimo_ascenso . ';' . // 10
        $Bnf->antiguedad_grado . ';' . // 11
        $Bnf->sueldo_base . ';' . // 12
        $Bnf->prima_transporte_mt . ';' . // 13
        $Bnf->prima_transporte . ';' . // 14
        $Bnf->prima_tiemposervicio_mt . ';' . // 15
        $Bnf->prima_tiemposervicio . ';' .  // 16
        $Bnf->prima_descendencia_mt . ';' . // 17
        $Bnf->prima_descendencia . ';' .  // 18
        $Bnf->prima_especial_mt . ';' . // 19
        $Bnf->prima_especial . ';' . // 20
        $Bnf->prima_noascenso_mt . ';' . // 21
        $Bnf->prima_noascenso . ';' . // 22
        $Bnf->prima_profesionalizacion_mt . ';' . // 23
        $Bnf->prima_profesionalizacion . ';' .  // 24
        $Bnf->sueldo_mensual . ';' . // 25
        $Bnf->aguinaldos . ';' . // 26
        $Bnf->vacaciones . ';' . // 27
        $Bnf->sueldo_integral . ';' . // 28
        $Bnf->asignacion_antiguedad . ';' . // 29 
        $Bnf->deposito_banco . ';' . // 30
        $Bnf->garantias_acumuladas  . ';' . // 31
        $Bnf->dias_adicionales_acumulados . ';' . // 32
        $Bnf->no_depositado_banco  . ';' .  // 33
        $Bnf->garantias . ';' .  // 34
        $Bnf->dias_adicionales;  // 35
  }


    private function generarLineaMemoria($Bnf, $Recuerdo){
    return 
        $Bnf->cedula . ';' . 
        $Bnf->grado_codigo . ';' .
        $Bnf->grado_nombre . ';' .
        $Bnf->componente_id . ';' .  
        $Bnf->componente_nombre . ';' . 
        $Bnf->apellidos . ' ' . $Bnf->nombres . ';' .   
        $Bnf->fecha_ingreso . ';' . 
        $Bnf->tiempo_servicio . ';' .
        $Bnf->numero_hijos . ';' .        
        $Bnf->fecha_ultimo_ascenso . ';' . 
        $Bnf->antiguedad_grado . ';' . 
        $Recuerdo['SINCIAL'] .        
        $Bnf->deposito_banco . ';' .
        $Bnf->garantias_acumuladas  . ';' .
        $Bnf->dias_adicionales_acumulados . ';' .
        $Bnf->no_depositado_banco  . ';' . 
        $Recuerdo['SFINAL'];
  }

  private function evaluarLotesLinuxComando($archivo){
    $comando = "wc -l tmp/" . $archivo . ".csv | awk -F\  '{print $1}'"; //Contar lineas del archivo generadas
    exec($comando, $linea);    
    $comando = "cd tmp/; zip " . $archivo . ".zip " . $archivo . ".csv";
    exec($comando);
    $comando = "cd tmp/; md5sum " . $archivo . ".csv  | awk -F\  '{print $1}'";
    exec($comando, $firma);
    $comando = "cd tmp/; awk -F\; '{SUMG += $34; SUMD += $35} END  {printf \"%.2f\", SUMG; printf \";%.2f\", SUMD}' " . $archivo . ".csv";
    exec($comando, $monto);
    $g_d = explode(";", $monto[0]);
    $comando = "cd tmp; du -sh " . $archivo . ".csv | awk  '{print $1}'";
    exec($comando, $peso);
    $time = date("Y-m-d H:i:s");
    $this->Resultado = array(
      'l' => $linea[0], 
      'f' => $firma[0], 
      'g' => number_format($g_d[0], 2, ',','.'), 
      'd' => number_format($g_d[1], 2, ',','.'), 
      'p' => $peso[0],
      't' => $time
    );

    exec("cd tmp/; rm -rf " . $archivo . ".csv");

    $sInsert = 'INSERT INTO space.archivos (arch,tipo,peso,cert,regi,usua,fech) 
    VALUES (\'' . $archivo . '\',1,\'' . $peso[0] . '\',\'' . $firma[0] . '\',\'' . $linea[0] . '\',\'' . 
    $_SESSION['usuario'] . '\', ' . $g_d[0] . ',' . $g_d[1] . ',' . $time . ');';
    

    $this->DBSpace->consultar($sInsert);

  }

  function Generar(){

  }


}

