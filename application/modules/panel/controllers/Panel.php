<?php
defined('BASEPATH') OR exit('No direct script access allowed');


define ('__CONTROLADOR', 'panel');
class Panel extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}

	public function index(){
		$this->load->view("login");
	}

	public function fideicomitente(){
		$this->load->view("fideicomitente");
	}

	public function beneficiario(){
		$this->load->view("beneficiario");
	}

	public function asociarcuenta(){
		$this->load->view("asociarcuenta");
	}

	public function reporte(){
		$this->load->view("reportebeneficiario");
	}

	public function actualizar(){
		$this->load->view("actualizarbeneficiario");
	}

	public function finiquitos(){
		$this->load->view("finiquitos");
	}
	public function historialsueldo(){
		$this->load->view("relaciondesueldo");
	}

	public function sueldolote(){
		$this->load->view('sueldolote');
	}

	public function verificar(){
		$this->load->view("view_home");
	}


	public function ordenpago(){
		$this->load->view("menu/orden_pago/orden");
	}

	public function consultarmovimiento(){
		$this->load->view("menu/beneficiario/consultarmovimiento");
	}

	public function medidajudicial(){
		$this->load->view("menu/beneficiario/medidajudicial");
	}
	public function anticipo(){
		$this->load->view("menu/beneficiario/anticipo");
	}


	public function directiva(){

		$this->load->view("menu/calculos/directiva");
	}


	public function aportecapital(){
		$this->load->view("menu/calculos/aportecapital");
	}

	public function asignacionantiguedad(){
		$this->load->view("menu/calculos/asignacionantiguedad");
	}

	public function interesescaidos(){
		$this->load->view("menu/calculos/interesescaidos");
	}

	public function interessemestral(){
		$this->load->view("menu/calculos/interessemestral");
	}

	public function calcinitereses(){
		$this->load->view("menu/calculos/calcinitereses");
	}

	public function reclamos(){
		$this->load->view("menu/reclamos/reclamos");
	}
		


	//----------------------------------------
	public function auditoria(){
		$this->load->view("menu/administracion/reporteauditoria");
	}

	//----------------------------------------
	public function calculadoraspace(){
		$this->load->view("menu/otros/calculadoraspace");
	}





	public function salir(){
		$this->load->view("login");
	}

	public function consultarBeneficiario($cedula = ''){		
		$this->load->model('beneficiario/MBeneficiario');
		$this->MBeneficiario->obtenerID($cedula);
		
	
		echo json_encode($this->MBeneficiario);
	}
	public function consultarBeneficiarios($cedula = ''){		
		$this->load->model('beneficiario/MBeneficiario');
		$this->MBeneficiario->obtenerID($cedula);
		

		echo "<pre>";
		print_r($this->MBeneficiario);
		//echo json_encode($this->MBeneficiario);
	}

	public function MDirectiva(){
		$this->load->model('beneficiario/MDirectiva');
		echo '<pre>';
		print_r($this->MDirectiva->iniciar());

	}

	public function calculo(){
			$this->load->model('beneficiario/MCalculo');
			print_r($this->MCalculo->AntiguedadCargo('2014-06-16'));
	}



	function listarComponente(){
		echo '<pre>';
		$this->load->model('beneficiario/MComponente');
		print_r( $this->MComponente->listarTodo() ); 
	}
	

	/**
	* 
	*/
	function imprimirComponente(){
		echo '<pre>';
		$this->load->model('beneficiario/MBeneficiario');
		$this->MBeneficiario->listarPorComponente(2);
		
		
		echo 'listo...';
	}

	function listarMovimientos(){
		
		$this->load->model('beneficiario/MHistorialMovimiento');
		$this->MHistorialMovimiento->listarPorComponente(1);
		
	}

	function restarFecha(){
		list($ano,$mes,$dia) = explode('-', '3-11-30');

    $ano_dif  = 2016 - $ano; //Porbar los tiempos
		echo $ano_dif;
    $mes_dif = 8 - $mes;
		echo $mes_dif;
    $dia_dif   = 2 - $dia;
    if ($dia_dif < 0 || $mes_dif < 0)
      $ano_dif--;
	
	  //return $ano_dif;
		
		echo $ano_dif;
	}
}
