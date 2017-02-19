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
          (cedula character varying(12), asig_antiguedad numeric, dep_adicional numeric, dep_garantia numeric);"  );
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
        WHERE beneficiario.status_id=201 LIMIT 100
      ");
  
      $this->asignarBeneficiario($con->rs,$directiva, $fecha, $archivo, $autor);
  
      $this->evaluarLotesLinuxComando($archivo);
  }


  private function asignarBeneficiario($obj, $id, $fecha, $archivo, $autor){
    $this->load->model('kernel/KCalculoLote');
    $this->load->model('kernel/KDirectiva');
    $Directivas = $this->KDirectiva->Cargar($id); //Directivas
    $this->load->model('kernel/KPerceptron'); //Red Perceptron Aprendizaje de patrones
    $lst = array(); //
    $file = fopen("tmp/" . $archivo . ".csv","a") or die("Problemas"); 

    $linea = 'cedula;grado_codigo;componente_id;apellidos_nombres;fecha_ingreso;tiempo_servicio;n_hijos;fecha_ultimo_ascenso;antiguedad_grado;sueldo_base;';
    $linea .= 'prima_tmt;prima_transporte;prima_smt;prima_tiemposervicio;prima_dmt;prima_descendencia;prima_emt;prima_especial;prima_nmt;';
    $linea .= 'prima_noascenso;prima_pmt;prima_profesionalizacion;';
    $linea .= 'sueldo_mensual;alicuota_aguinaldos;alicuota_vacaciones;sueldo_integral;asignacion_antiguedad;';
    $linea .= 'deposito_banco;garantias_acumuladas;dias_adicionales_acumulados;no_depositado_banco;garantias;dias_adicionales';
    fputs($file,$linea);
    fputs($file,"\n");  
    foreach ($obj as $k => $v) {
      $Bnf = new $this->MBeneficiario;
      $this->KCalculoLote->Instanciar($Bnf, $Directivas);

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
      $Bnf->grado_codigo = $v->codigo;
      $Bnf->fecha_ultimo_ascenso = $v->f_ult_ascenso;
      $Bnf->fecha_retiro = $fecha;
      $Bnf->prima_profesionalizacion_mt = $v->st_profesion;
      
      $patron = md5($v->fecha_ingreso.$v->n_hijos.$v->st_no_ascenso.$v->componente_id.
        $v->codigo.$v->f_ult_ascenso.$v->st_profesion.$v->anio_reconocido.$v->mes_reconocido.$v->dia_reconocido);      

      //GENERADOR DE CALCULOS DINAMICOS
      //if(!isset($this->KPerceptron->Neurona[$patron])){
        $this->KCalculoLote->Ejecutar(); 
        $segmentoincial = $Bnf->sueldo_base . ';' . $Bnf->prima_transporte_mt . ';' . 
                          $Bnf->prima_transporte . ';' . $Bnf->prima_tiemposervicio_mt . ';' . 
                          $Bnf->prima_tiemposervicio . ';' . $Bnf->prima_descendencia_mt . ';' . 
                          $Bnf->prima_descendencia . ';' . $Bnf->prima_especial_mt . ';' . 
                          $Bnf->prima_especial . ';' . $Bnf->prima_noascenso_mt . ';' . 
                          $Bnf->prima_noascenso . ';' . $Bnf->prima_profesionalizacion_mt . ';' . 
                          $Bnf->prima_profesionalizacion . ';' . $Bnf->sueldo_mensual . ';' . 
                          $Bnf->aguinaldos . ';' . $Bnf->vacaciones . ';' . $Bnf->sueldo_integral . ';' . $Bnf->asignacion_antiguedad . ';';
        $segmentofinal =  $Bnf->garantias . ';' . $Bnf->dias_adicionales;      

        $this->KPerceptron->Aprender($patron, $Bnf->cedula, array(
          'A_ANTIGUEDAD' => $Bnf->asignacion_antiguedad,
          'S_INTEGRAL' => $Bnf->sueldo_integral, 
          'SINCIAL' => $segmentoincial, 
          'SFINAL' =>  $segmentofinal)
        );

        //$linea = $this->generarLinea($Bnf);

      //}else{
      //  $Bnf->asignacion_antiguedad = $this->KPerceptron->Neurona[$patron]['A_ANTIGUEDAD'];
      //  $Bnf->sueldo_integral = $this->KPerceptron->Neurona[$patron]['S_INTEGRAL'];
      //  $this->KCalculoLote->GenerarNoDepositadoBanco();
      //  $linea = $this->generarLineaMemoria($Bnf, $this->KPerceptron->Neurona[$patron]);
      //}

      //fputs($file,$linea);
      fputs($file,"\n");      
      unset($Bnf);
    }

    fclose($file);
    print_r($this->KPerceptron->Neurona);
    //echo count($this->KPerceptron->Neurona);
  }


  private function generarLinea($Bnf){

    return 
        $Bnf->cedula . ';' . 
        $Bnf->grado_codigo . ';' .
        $Bnf->componente_id . ';' .  
        $Bnf->apellidos . ' ' . $Bnf->nombres . ';' .   
        $Bnf->fecha_ingreso . ';' . 
        $Bnf->tiempo_servicio . ';' .
        $Bnf->numero_hijos . ';' .        
        $Bnf->fecha_ultimo_ascenso . ';' . 
        $Bnf->antiguedad_grado . ';' . 
        $Bnf->sueldo_base . ';' . 
        $Bnf->prima_transporte_mt . ';' . 
        $Bnf->prima_transporte . ';' .         
        $Bnf->prima_tiemposervicio_mt . ';' . 
        $Bnf->prima_tiemposervicio . ';' .         
        $Bnf->prima_descendencia_mt . ';' . 
        $Bnf->prima_descendencia . ';' .         
        $Bnf->prima_especial_mt . ';' . 
        $Bnf->prima_especial . ';' . 
        $Bnf->prima_noascenso_mt . ';' . 
        $Bnf->prima_noascenso . ';' .
        $Bnf->prima_profesionalizacion_mt . ';' . 
        $Bnf->prima_profesionalizacion . ';' . 
        $Bnf->sueldo_mensual . ';' . 
        $Bnf->aguinaldos . ';' . 
        $Bnf->vacaciones . ';' . 
        $Bnf->sueldo_integral . ';' . 
        $Bnf->asignacion_antiguedad . ';' . 
        $Bnf->deposito_banco . ';' .
        $Bnf->garantias_acumuladas  . ';' .
        $Bnf->dias_adicionales_acumulados . ';' .
        $Bnf->no_depositado_banco  . ';' . 
        $Bnf->garantias . ';' . 
        $Bnf->dias_adicionales;      
  }


    private function generarLineaMemoria($Bnf, $Recuerdo){
    return 
        $Bnf->cedula . ';' . 
        $Bnf->grado_codigo . ';' .
        $Bnf->componente_id . ';' .  
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

    $this->Resultado = array('l' => $linea[0], 'f' => $firma[0]);
  }

  function Generar(){

  }


}

