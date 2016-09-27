<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set ( 'America/Caracas' );
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
		$this->load->view("menu/beneficiario/beneficiario");
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
		$this->load->view("menu/beneficiario/finiquito");
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



	public function hojavida($cedula = ''){
		$this->load->model('beneficiario/MBeneficiario');
		$this->MBeneficiario->obtenerID($cedula);
		$data['Beneficiario'] = $this->MBeneficiario;
		$this->load->view('reporte/beneficiario/hoja_vida', $data);

	}

	public function salir(){
		$this->load->view("login");
	}

	public function consultarBeneficiario($cedula = '', $fecha = ''){		
		$this->load->model('beneficiario/MBeneficiario');
		$this->MBeneficiario->obtenerID($cedula, $fecha);
		echo json_encode($this->MBeneficiario);
	}
	

	public function consultarBeneficiarios($cedula = '', $fecha = ''){		
		$this->load->model('beneficiario/MBeneficiario');
		$this->MBeneficiario->obtenerID($cedula, $fecha);
		

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
		print_r( $this->MComponente->listar(1) ); 
	}
	
	/**
	* 
	*/
	function procesarComponenteLote(){
		echo '<pre>';
		$this->load->model('beneficiario/MBeneficiario');
		$this->MBeneficiario->listarPorComponente(2);
		
		
		echo 'listo...';
	}


	function listarMovimientos(){
		
		$this->load->model('beneficiario/MHistorialMovimiento');
		$this->MHistorialMovimiento->listarPorComponente(1);
		
	}

	/**
	* 	-----------------------------
	*	FINIQUITOS admin | dg2010
	*	-----------------------------
	*/
	function registrarFiniquito(){
		$this->load->model('beneficiario/MMotivoFiniquito');
		$this->load->model('beneficiario/MPartidaPresupuestaria');
		$data['Motivo'] = $this->MMotivoFiniquito->listarTodo(); 
		$data['Partida'] = $this->MPartidaPresupuestaria->listarTodo();
		$this->load->view('menu/beneficiario/registrar_finiquito', $data);
	}

	/**
	*	Listar Motivos de Finiquitos
	*/
	function listarMotivoFiniquitos(){
		echo '<pre>';
		$this->load->model('beneficiario/MMotivoFiniquito');
		print_r( $this->MMotivoFiniquito->listarTodo() ); 
	}

	/**
	*	Listar Partidas Presupuestarias
	*/
	function listarPartidaPresupuestaria(){
		echo '<pre>';
		$this->load->model('beneficiario/MPartidaPresupuestaria');
		print_r( $this->MPartidaPresupuestaria->listarTodo() ); 
	}

	function obtenerPartidaPresupuestaria($id = ''){
		$this->load->model('beneficiario/MPartidaPresupuestaria');
		echo json_encode( $this->MPartidaPresupuestaria->obtenerID($id) );
	}

	function obtenerFamiliares($id = ''){
		$this->load->model('beneficiario/MBeneficiario');
		echo json_encode( $this->MBeneficiario->CargarFamiliares($id) );
	}


	function init(){
		phpinfo();
	}

}
