<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * MamonSoft 
 *
 * Calculos
 *
 * @package pace\application\modules\panel\model\beneficiario
 * @subpackage utilidad
 * @author Carlos Peña
 * @copyright Derechos Reservados (c) 2015 - 2016, MamonSoft C.A.
 * @link http://www.mamonsoft.com.ve
 * @since version 1.0
 */

class MCalculo extends CI_Model{
  
  /**
  * @var MBeneficiario
  */
  var $Beneficiario = null;

  /**
  * Iniciando la clase, Cargando Elementos Pace
  *
  * @access public
  * @return void
  */
  public function __construct(){
    parent::__construct();
    //$this->load->model('beneficiario/MDirectiva');
   

  }


  function iniciarCalculosBeneficiario(MBeneficiario & $Beneficiario){
    $this->load->model('beneficiario/MDirectiva');
    $this->load->model('beneficiario/MPrima');
    $this->Beneficiario = $Beneficiario;   
    $this->AntiguedadGrado();
    $this->TiempoServicios();
    $codigo_grado = $this->Beneficiario->Componente->Grado->codigo;
    $this->Beneficiario->Componente->Grado->Directiva = $this->MDirectiva->obtener($this->Beneficiario);
    $directiva_id = $this->Beneficiario->Componente->Grado->Directiva->id;
    $this->Beneficiario->Componente->Grado->Prima = $this->MPrima->obtener($codigo_grado, $directiva_id,  $this->Beneficiario);
    $aplica = 0;
    switch ($codigo_grado) {
      case '10':
        $aplica = 1;
        break;
      case '15':
        $aplica = 1;
        break;
      case '20':
        $aplica = 1;
        break;
      case '30':
        $aplica = 1;
        break;
      case '6330':
        $aplica = 1;
        break;
      case '6340':
        $aplica = 1;
        break;
      default:
        $aplica = 0;
        break;
    }
    if($aplica == 1) $this->Beneficiario->Prima[3] = array('P_ESPECIAL' => $this->MPrima->Especial());


    $this->Beneficiario->sueldo_global = $this->SueldoGlobal();
    $this->AlicuotaAguinaldo();
    $this->AlicuotaVacaciones();
    $this->SueldoIntegral();
    $this->AsignacionAntiguedad();

    //return $this;
  }


  function iniciarCalculosLote( MBeneficiario & $Beneficiario, $HistorialMovimiento, MDirectiva $Directiva, MPrima $Prima){
    $this->Beneficiario = $Beneficiario;
    $this->AntiguedadGrado();
    $this->TiempoServicios();
    $grado_codigo = $this->Beneficiario->grado_codigo;
    $antiguedad_grado = $this->Beneficiario->antiguedad_grado;
    if(isset($Directiva->Detalle[$grado_codigo . $antiguedad_grado]->sueldo_base)){
      $sueldo_base = $Directiva->Detalle[$grado_codigo . $antiguedad_grado]->sueldo_base;
    }else{
      $sueldo_base = $Directiva->Detalle[$grado_codigo . 'M']->sueldo_base;
    }
    
    $this->Beneficiario->sueldo_base = $sueldo_base;
    $Prima->calcular($Beneficiario);
    $this->Beneficiario->sueldo_global = $this->SueldoGlobal();
    $this->Beneficiario->HistorialMovimiento = $HistorialMovimiento[$this->Beneficiario->cedula];
    $this->AlicuotaAguinaldo();
    $this->AlicuotaVacaciones();
    $this->SueldoIntegral();
    $this->AsignacionAntiguedad();
    
  }


  /**
  * Obtener detalles del Cargo
  *
  * @access public
  * @return void
  */
  function obtenerID(){

  }



  /**
  * Permite restar fechas exactas en el caso de los reconocidos antes de Calcular
  *
  * @access public
  * @param Date
  * @return int
  */
  private function __fechaReconocida($ano_reconocido = 0, $mes_reconocido = 0, $dia_reconocido = 0){
    list($ano,$mes,$dia) = explode("-",$this->Beneficiario->fecha_ingreso);
    $anoR = $ano - $this->Beneficiario->ano_reconocido;
    $mesR = $mes - $this->Beneficiario->mes_reconocido;
    $diaR = $dia - $this->Beneficiario->dia_reconocido; 
	  if($diaR < 0) {
      $mesR++;
      $diaR = $diaR * -1;
    }
    if($mesR < 0){
      $anoR--;
      $mesR = $mesR - 12;
    } 
    $fecha = $anoR .'-' . $mesR . '-' . $diaR;
    $this->Beneficiario->fecha_ingreso_reconocida = $fecha;
    return $this->__restarFecha($fecha);
  } 

  /**
  * Permite restar fechas exactas
  *
  * @access public
  * @param Date
  * @return int
  */
  private function __restarFecha($fecha){
    
    list($ano,$mes,$dia) = explode("-",$fecha);
    $ano_dif  = date("Y") - $ano; //Porbar los tiempos
    $mes_dif = date("m") - $mes;
    $dia_dif   = date("d") - $dia;
    if ($dia_dif < 0 || $mes_dif < 0)
      $ano_dif--;
	  return $ano_dif;
  }



  /**
  * Permite calular el tiempo en la antiguedad del cargo bajo la ultima fecha de ascenso
  *
  * @access public
  * @param Date
  * @return int
  */
  function AntiguedadGrado($fechaUltimoAscenso = ''){
    if(isset($this->Beneficiario)){
      $anos = $this->__restarFecha($this->Beneficiario->fecha_ultimo_ascenso);
      $this->Beneficiario->antiguedad_grado = $anos;
      
    }else{
      
      return $this->__restarFecha($fechaUltimoAscenso);
    }
    
  }

  /**
  * Permite calular el tiempo en de servicio de una persona bajo su fecha de Ingreso
  *
  * @access public
  * @param Date
  * @param array
  * @return int
  */
  function TiempoServicios($fechaIngreso = '', $tiempoReconocido = array()){
    if(isset($this->Beneficiario)){
      if($this->Beneficiario->ano_reconocido != 0){
        $anos = $this->__fechaReconocida();
        $this->Beneficiario->tiempo_servicio = $anos;
      }else{
        $anos = $this->__restarFecha($this->Beneficiario->fecha_ingreso);
        $this->Beneficiario->tiempo_servicio = $anos;
      }      
    }else{
      return $this->__restarFecha($fechaIngreso);
    }
  }

  /**
  *	Sueldo Global #007
  * X = PTR + PAS + PDE + PNA + PES + PPR
  *
  * PTR = Prima Transporte
  * PAS = Prima Ano Servicio
  * PDE = Prima Descendecia
  * PNA = Prima No Ascenso
  * PES = Prima Especial
  * PPR = Prima Profesionalizacion
  *
  * @access public
  * @param double
  * @param int 
  * @return double
  */
  public function SueldoGlobal($primas = array(), $sueldo_global = 0.00){    
    $sum = 0;
    $primas = $this->Beneficiario->Prima;
    $sueldo_global = $this->Beneficiario->sueldo_base;
    foreach ($primas as $key => $value) {
     foreach ($value as $k => $v) {
       $sum += $v;
       
     }
    }
    $cal = $sum + $sueldo_global;
    return  number_format($cal, 2, '.', '');
  }

  /**
  *	Alicuota Bono Aguinaldo #00
  * X = ((90 * SG)/30)/12
  *
  * SG = Sueldo Global
  *
  * @access public
  * @return double
  */
  public function AlicuotaAguinaldo($sueldo_global = 0){
    if(isset($this->Beneficiario)){
      $sueldo_global = $this->Beneficiario->sueldo_global;
      $cal =  ((90 * $sueldo_global)/30)/12;
      $this->Beneficiario->aguinaldos = number_format($cal, 2, '.', '');      
    }else{
      $cal = ((90 * $sueldo_global)/30)/12;
      return number_format($cal, 2, '.', '');
    }
    
  }

  /**
  *	Alicuota Bono Vacaciones #00
  * X =  ((NDV * SG)/30)/12
  *
  * NDV = Numero de Dias de Vaciones que goza el Millitar
  * SG = Sueldo Global
  *
  * @access public
  * @return double
  */
  public function AlicuotaVacaciones($sueldo_global = 0){   


    if(isset($this->Beneficiario)){
      $dia = 0;
     if ($this->Beneficiario->tiempo_servicio > 0 && $this->Beneficiario->tiempo_servicio <= 14) {
        $dia = 40;
      }else if($this->Beneficiario->tiempo_servicio > 14 && $this->Beneficiario->tiempo_servicio <= 24){
        $dia = 45;
      }else if($this->Beneficiario->tiempo_servicio > 24){
        $dia = 50;
      }
      
      
      $sueldo_global = $this->Beneficiario->sueldo_global;
      $cal = (($dia * $sueldo_global)/30)/12;
      $this->Beneficiario->vacaciones = number_format($cal, 2, '.', ''); 
    }else{
      

      $cal = ((50 * $sueldo_global)/30)/12;
      return number_format($cal, 2, '.', '');

    }
  }

  /**
  *	Sueldo Integral #007
  * X = SUM(SG + AV + AA)
  *
  * SUM = Sumatoria Total
  * SG = Sueldo Global
  * AV = Alicuota Vacaciones
  * AA = Alicuota Aguinaldo
  *
  * @access public
  * @return double
  */
  public function SueldoIntegral(){
    if(isset($this->Beneficiario)){
      $sueldo_integral = $this->Beneficiario->sueldo_global + $this->Beneficiario->vacaciones + $this->Beneficiario->aguinaldos;
      $this->Beneficiario->sueldo_integral = number_format($sueldo_integral, 2, '.', '');
    }
  }

  /**
  *	Asignacion de Antiguedad #007
  * X = SI * TS
  *
  * SI = Sueldo Integral
  * TS = Prima Tiempo de Servicio
  *
  * @access public
  * @return double
  */
  public function AsignacionAntiguedad(){
    $this->Beneficiario->asignacion_antiguedad = $this->Beneficiario->sueldo_integral * $this->Beneficiario->tiempo_servicio;
    return $this->Beneficiario->asignacion_antiguedad;
  }


  public function DepositoBanco(){
    return $this->HistorialMovimiento[3];
  }

  public function NoDepositadoBanco(){
    return $this->Beneficiario->ano_antiguedad - $this->DepositoBanco();
  }

}