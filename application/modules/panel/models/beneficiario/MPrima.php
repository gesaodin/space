<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * MamonSoft 
 *
 * Grado
 *
 * @package pace\application\modules\panel\model\beneficiario
 * @subpackage utilidad
 * @author Carlos Peña
 * @copyright Derechos Reservados (c) 2015 - 2016, MamonSoft C.A.
 * @link http://www.mamonsoft.com.ve
 * @since version 1.0
 */

class MPrima extends CI_Model{


  /**
  * @var integer
  */
  var $id;


  /**
  * @var string
  */
  var $nombre = '';


  /**
  * @var string
  */
  var $descripcion = '';

 /**
  * @var integer
  */
  var $estatus;

  /**
  * @var array
  */ 
  var $Detalle = array();

 /**
  * @var double
  */
  var $unidad_tributaria = 0.00;

  var $Beneficiario = null;

  /**
  * Iniciando la clase, Cargando Elementos Pace
  *
  * @access public
  * @return void
  */
  public function __construct(){
    parent::__construct();
    $this->load->model('beneficiario/MPrimaDetalle');
    if(!isset($this->Dbpace)) $this->load->model('comun/Dbpace');
  }



  /**
  * Obtener detalles de las prima por Directiva Especifica
  *
  * @access public
  * @param int
  * @return array
  */
  public function obtenerSegunDirectiva($id){
    $sConsulta = 'SELECT directiva_id, grado_id, prima_id, prima.nombre, monto_nominal, monto_ut 
                  FROM prima_directiva
                  JOIN prima ON prima.id=prima_directiva.prima_id
                  WHERE directiva_id =\'' . $id . '\' order by grado_id ';
	  $obj = $this->Dbpace->consultar($sConsulta);
		$lstH = array();
		$gra = 0;
		$i = 0;
		foreach ($obj->rs as $clv => $val) {		
			if($gra != $val->grado_id){
				$lstH = array();
				$gra = $val->grado_id;
			}
			$lstH[] = array($val->nombre => $val->monto_nominal);
			$this->Detalle[$gra] = $lstH;
			$i++;				
		}
    /**
    echo '<pre>';		
		print_r($lst);
		echo 'Registros Consultados: ' . $i . '<br><br>';
		**/
		return $this;

  }


  /**
  * Obtener detalles de la prima por grado
  *
  * @access public
  * @param int
  * @param int
  * @return void
  */
  public function obtener($id_grado = 0, $directiva_id = 0, MBeneficiario &$Beneficiario){
    $this->Beneficiario = $Beneficiario;
    $this->unidad_tributaria =  $this->Beneficiario->Componente->Grado->Directiva->unidad_tributaria;
    
    $sConsulta = 'SELECT prima_directiva.id,
        prima_directiva.prima_id, prima.nombre, prima.descripcion, monto_nominal, monto_ut        
        FROM prima_directiva
      JOIN 
        prima ON prima_directiva.prima_id=prima.id
      WHERE 
        prima_directiva.grado_id = ' . $id_grado . ' AND directiva_id= ' . $directiva_id . ';';

    $obj = $this->Dbpace->consultar($sConsulta);
    $listaPrima = array();
		if($obj->code == 0 ){      
      //$Prima->estatus = $obj->rs[0]->estatus;
			foreach ($obj->rs as $clv => $val) {
        $Prima = new $this->MPrima();   
        $Detalle = new $this->MPrimaDetalle();
        $Prima->id = $val->prima_id;
        $Prima->nombre = $val->nombre;
        $NM = $val->nombre;
        $this->Beneficiario->Prima[$val->prima_id] = array($NM => $this->$NM());
        $Prima->descripcion = $val->descripcion;
        $Detalle->id = $val->id;
        $Detalle->monto_nominal = $val->monto_nominal;
        $Detalle->monto_unidad_tributaria = $val->monto_ut;        
        $Prima->Detalle[] = $Detalle;
        $listaPrima[$val->prima_id] = $Prima;
      }
    }
    
    
    $this->Beneficiario->Prima[8] = array('P_PROFESIONALIZACION' => $this->Beneficiario->profesionalizacion == 1 ? $this->Profesionalizacion() : 0.00);


    return $listaPrima;
  }

  /**
  * Efecctivo para el procesamiento por lotes
  *
  * @access public
  * @param MBeneficiario
  * @return array
  */
  public function calcular(MBeneficiario & $Beneficiario){
    $this->Beneficiario = $Beneficiario;
    $Detalle  = $this->Detalle[$this->Beneficiario->grado_codigo];
    foreach ($Detalle as $key => $val) {
      $lst = $val;
      foreach ($lst as $k => $v) {
        $this->Beneficiario->Prima[] = array( $k => $this->$k());
      }
    }
    $this->Beneficiario->Prima[8] = array('P_PROFESIONALIZACION' => $this->Beneficiario->profesionalizacion == 1 ? $this->Profesionalizacion() : 0.00);
    
  }

  /**
  * Ano de Servicios FormatoCalculo #001
  * X = (0.5 * UT) * TS
  * UT = Unidad Tributaria
  * TS = Tiempo de Servicios
  *
  * @access public
  * @param double
  * @param int 
  * @return double
  */
  public function P_TIEMPOSERVICIO(){
    return $this->AnoServicio();
  }
  public function AnoServicio( $tiempo_servicio = 0){
    $valor = (0.5 * $this->unidad_tributaria) * $this->Beneficiario->tiempo_servicio;
    //$valor = (0.5 * $this->unidad_tributaria) * $this->Beneficiario->tiempo_servicio_aux;
    $this->Beneficiario->prima_tiemposervicio = $valor;
    return $valor;



  }

  /**
  * Transporte FormatoCalculo #002
  * X = 4 * UT
  * UT = Unidad Tributaria
  *
  * @access public
  * @param double
  * @param int 
  * @return double
  */
  public function P_TRANSPORTE(){
    return $this->Transporte();
  }
  public function Transporte(){
    $valor = round(4 * $this->unidad_tributaria,2);
    //$valor = 4 * $this->unidad_tributaria;
    $this->Beneficiario->prima_transporte = $valor;
    return $valor;
  }

  /**
  * Descendencia FormatoCalculo #003
  * X = 2 * UT * NH
  * UT = Unidad Tributaria
  * NH = Numero Hijos
  *
  * @access public
  * @param double
  * @param int 
  * @return double
  */
  public function P_DESCENDECIA(){
    return $this->Descendencia();
  }
  public function Descendencia($numero_hijos = 0){
    if(isset($this->Beneficiario)){
      
      $valor = round(2 * $this->unidad_tributaria * $this->Beneficiario->numero_hijos, 2);
      //$valor = 2 * $this->unidad_tributaria * $this->Beneficiario->numero_hijos;
      $this->Beneficiario->prima_descendencia = $valor;
      return $valor;
    }else{
      return round(2 * $this->unidad_tributaria * $numero_hijos, 2);
    }
  }

  /**
  * No Ascenso FormatoCalculo #004
  * X = (SB * Y) / 100
  * Y = No Ascenso 
  * SB = Sueldo Base
  *
  * @access public
  * @param double
  * @param int 
  * @return double
  */
  public function P_NOASCENSO(){
    return $this->NoAscenso();
  }
  public function NoAscenso($no_ascenso = 0, $sueldo_base = 0.00 ){
    if(isset($this->Beneficiario)){
      $codigo = $this->Beneficiario->grado_codigo . $this->Beneficiario->antiguedad_grado;
      $sueldo_base = $this->Beneficiario->sueldo_base;
      $no_ascenso = $this->Beneficiario->no_ascenso;
      
      $valor =  round(($sueldo_base * $no_ascenso) / 100, 2);
      //$valor =  ($sueldo_base * $no_ascenso) / 100;
      
      $this->Beneficiario->prima_noascenso = $valor;
      return $valor;
    }else{
      return round(($sueldo_base * $no_ascenso) / 100, 2);
    }
  }


  /**
  * Profecionalizacion #005
  * X = (SB * 12%) / 100
  * SB = Sueldo Base
  *
  * @access public
  * @param double
  * @param int 
  * @return double
  */
  public function Profesionalizacion( $sueldo_base = 0.00 ){    
    if(isset($this->Beneficiario)){
      $codigo = $this->Beneficiario->grado_codigo . $this->Beneficiario->antiguedad_grado;
      $sueldo_base = $this->Beneficiario->sueldo_base;    
      $sueldo = ($sueldo_base * 12) / 100;
      //$valor = $sueldo;
      //$valor = round($sueldo, 3, PHP_ROUND_HALF_UP);
      $valor = round($sueldo, 2);
      //$valor = round($valor,  2, PHP_ROUND_HALF_UP);
      $this->Beneficiario->prima_profesionalizacion = $valor;
      return $valor;
    }else{
      return round(($sueldo_base * 12) / 100, 2);
    }
  }


 public function P_ESPECIAL(){
   $this->Especial();
  }
  /**
  * Especial #006
  * X = 
  * SB = Sueldo Base
  *
  * @access public
  * @param double
  * @param int 
  * @return double
  */
  public function Especial( $sueldo_base = 0.00 ){
    $monto_nominal = 0;
    if(isset($this->Beneficiario)){
      $Prima = (object)$this->Beneficiario->Componente->Grado->Prima[3];
      foreach ($Prima as $c => $v) {
        if(is_array($v)){
          $monto_nominal = $v[0]->monto_nominal;  
        } 
      }
    }
    //$valor = $this->unidad_tributaria * $monto_nominal;
    $valor =  round($this->unidad_tributaria * $monto_nominal,2);
    $this->Beneficiario->prima_especial = $valor;
    //return round($this->unidad_tributaria * $monto_nominal,2);
    return $valor;


    /**
    if(isset($this->Beneficiario)){
      $codigo = $this->Beneficiario->Componente->Grado->codigo . $this->Beneficiario->antiguedad_grado;
      $sueldo_base = $this->Beneficiario->Componente->Grado->Directiva->Detalle[$codigo]->sueldo_base;    
      return round(($sueldo_base * 12) / 100, 2);
    }else{
      return round(($sueldo_base * 12) / 100, 2);
    }
    **/
  }


}