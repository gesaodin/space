<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * MamonSoft C.A
 *
 * Directiva de Sueldos Establece las reglas para la base del calculo
 *
 * @package pace\application\modules\panel\model\beneficiario
 * @subpackage utilidad
 * @author Carlos Peña
 * @copyright Derechos Reservados (c) 2015 - 2016, MamonSoft C.A.
 * @link http://www.mamonsoft.com.ve
 * @since version 1.0
 */

class MDirectiva extends CI_Model{

  /**
  * @var string
  */
  var $id = null;

  /**
  * @var string
  */
  var $nombre = '';

  /**
  * @var string
  */
  var $numero = '';  
  
  /**
  * @var string
  */
  var $fecha_inicio = ''; 

  /**
  * @var string
  */
  var $fecha_vigencia = ''; 

  /**
  * @var double
  */
  var $unidad_tributaria = 0;

  /**
  * @var MDirectivaDetalle
  */
  var $Detalle = array();
  /**
  * Iniciando la clase, Cargando Elementos Pace
  *
  * @access public
  * @return void
  */
  public function __construct(){
    parent::__construct();
    $this->load->model('beneficiario/MDirectivaDetalle');
    if(!isset($this->Dbpace)) $this->load->model('comun/Dbpace');
    //$this->_obtener();
  }

  /**
  * Obtener el Objeto Directiva Asociado a un Grado
  * El codigo de grado es la relacion entre grado y detalles de la directiva
  *
  * @param int
  */
  public function iniciar(){
    $fecha = date("Y-m-d");
    $sConsulta = 'SELECT 
        A.id, A.nombre, A.numero, A.f_vigencia, 
        A.f_inicio, udad_tributaria, detalle_directiva.grado_id, 
        detalle_directiva.anio, detalle_directiva.sueldo_base 
        FROM (SELECT * FROM directiva_sueldo 
          WHERE f_inicio < \'' . $fecha . '\'  AND f_vigencia > \'' . $fecha . '\' ORDER BY f_inicio desc LIMIT 1) AS A 
      JOIN 
        detalle_directiva ON A.id=detalle_directiva.directiva_sueldo_id
      ORDER BY grado_id, anio;';

    //$this->load->model('beneficiario/MGrado');
    //$Grado = $this->MGrado->obtenerSegunDirectiva($this->id);
    $obj = $this->Dbpace->consultar($sConsulta);
		if($obj->code == 0 ){
      
      $this->id = $obj->rs[0]->id;
      //$Grado = $this->MGrado->obtenerSegunDirectiva($this->id);
      $this->nombre = $obj->rs[0]->nombre;
      $this->numero = $obj->rs[0]->numero;      
      $this->fecha_inicio = $obj->rs[0]->f_inicio;
      $this->fecha_vigencia = $obj->rs[0]->f_vigencia;
      $this->unidad_tributaria = $obj->rs[0]->udad_tributaria;
      $grado = $obj->rs[0]->grado_id;
      $rs = $obj->rs;
			foreach ($rs as $clv => $val) {        
        if($grado != $val->grado_id){
          $this->Detalle[$grado . 'M'] = $Detalle;
          $grado = $val->grado_id;
        }
        $Detalle = new $this->MDirectivaDetalle();
        $Detalle->grado_id = $val->grado_id;
        $Detalle->ano_servicio = $val->anio;
        $Detalle->sueldo_base = $val->sueldo_base;

        //$Detalle->Prima = $Grado[$val->grado_id]; 
        $codigo = $val->grado_id . $val->anio;
        $this->Detalle[$codigo] = $Detalle;
        
      }
      $this->Detalle[$grado . 'M'] = $Detalle;

    }
    return $this;
   
  }


  public function obtener(MBeneficiario &$Beneficiario){
    $codigo_grado = $Beneficiario->Componente->Grado->codigo; 
    $antiguedad_grado = $Beneficiario->antiguedad_grado;
    $no_ascenso =  $Beneficiario->no_ascenso;
    
    //echo "Hola mundo";
    //echo $Beneficiario->fecha_retiro . ' Retiro';

    $fecha = $Beneficiario->fecha_retiro == '' ? date("Y-m-d") : $Beneficiario->fecha_retiro;  
    
    //echo "<br><br>" . $no_ascenso . ' ' . $antiguedad_grado . ' G: ' . $codigo_grado . "<br><br>";


    //Seleccion 

    $sGradoMaximo = '(SELECT max(detalle_directiva.anio) FROM 
    ( SELECT * FROM directiva_sueldo WHERE f_inicio < \'' . $fecha . '\'  AND f_vigencia > \'' . $fecha . '\' ORDER BY f_inicio desc LIMIT 1) AS A
    JOIN 
            detalle_directiva ON detalle_directiva.directiva_sueldo_id=A.id
   WHERE detalle_directiva.grado_id = \'' . $codigo_grado . '\')';


    if($no_ascenso > 0){
     $antiguedad =  $sGradoMaximo;
    }else{

      $maximo = $this->maximoAscenso($fecha, $codigo_grado);

      if ($antiguedad_grado > $maximo){
        $antiguedad = $maximo;
      }else{
        $antiguedad = $antiguedad_grado;
      }
    }
   
   //$antiguedad = $no_ascenso > 0 ? $sGradoMaximo : $antiguedad_grado;



    $sConsulta = 'SELECT A.id, A.nombre, A.numero, A.f_vigencia, 
        A.f_inicio, udad_tributaria, detalle_directiva.grado_id, 
        detalle_directiva.anio, detalle_directiva.sueldo_base 
        FROM (SELECT * FROM directiva_sueldo 
              WHERE f_inicio <= \'' . $fecha . '\'  AND f_vigencia >= \'' . $fecha . '\'    ORDER BY f_inicio desc LIMIT 1) AS A 
        JOIN 
          detalle_directiva ON A.id=detalle_directiva.directiva_sueldo_id
        WHERE 
          grado_id = ' . $codigo_grado . ' AND anio= ' . $antiguedad . '
        ORDER BY grado_id;';

    //echo $sConsulta;
    
    $obj = $this->Dbpace->consultar($sConsulta);
    $Directiva = new $this->MDirectiva();
		if($obj->code == 0 ){
      $Directiva->id = $obj->rs[0]->id;
      $Directiva->nombre = $obj->rs[0]->nombre;
      $Directiva->numero = $obj->rs[0]->numero;
      $Directiva->unidad_tributaria = $obj->rs[0]->udad_tributaria;
			foreach ($obj->rs as $clv => $val) {        
        $Detalle = new $this->MDirectivaDetalle();
        $Detalle->grado_id = $val->grado_id;
        $Detalle->ano_servicio = $val->anio;
        $Detalle->sueldo_base = $val->sueldo_base;
        $Beneficiario->sueldo_base = $val->sueldo_base;
        $Beneficiario->sueldo_base_aux = number_format($val->sueldo_base, 2, ',','.');
        $Beneficiario->grado_codigo = $val->grado_id;
        $codigo = $val->grado_id . $antiguedad_grado;
        $Directiva->Detalle[$codigo] = $Detalle; 
      }

    }
    return $Directiva;
  } 
  

  /**
  * Establece el máximo año por grado en el asceso
  *
  * @var date
  * @var int
  * @return int
  */
  private function maximoAscenso($fecha, $grado){
    $antiguedad = 0;
    $sConsulta = 'SELECT max(detalle_directiva.anio) AS maximo, detalle_directiva.grado_id FROM 
    ( SELECT * FROM directiva_sueldo WHERE f_inicio <= \'' . $fecha . '\'  AND f_vigencia >= \'' . $fecha . '\' ORDER BY f_inicio desc LIMIT 1) AS A
    JOIN 
            detalle_directiva ON detalle_directiva.directiva_sueldo_id=A.id
    WHERE detalle_directiva.grado_id = \'' . $grado . '\'
            GROUP BY detalle_directiva.grado_id';

    //echo $sConsulta;

    $obj = $this->Dbpace->consultar($sConsulta);
    if($obj->code == 0 ){
      $antiguedad = $obj->rs[0]->maximo;
    }
    return $antiguedad;

  }

}