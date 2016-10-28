<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set ( 'America/Caracas' );
define ('__CONTROLADOR', 'panel');
class Panel extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
	}

	public function index(){
		if(isset($_SESSION['usuario'])){
			$this->load->view("view_home");
			//print_r($_SESSION);
		}else{

			$this->load->view("login");
		}
		
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
		
		$this->load->model('usuario/Iniciar');


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


	/**
	*	*******************************************************
	*	REPORTES GENERALES DEL SISTEMA
	*	*******************************************************
	*/
	public function hojavida($cedula = ''){
		$this->load->model('beneficiario/MBeneficiario');
		$this->MBeneficiario->obtenerID($cedula);
		$data['Beneficiario'] = $this->MBeneficiario;
		$this->load->view('reporte/beneficiario/hoja_vida', $data);
	}

	public function cartaBanco($cedula = ''){
		$this->load->model('beneficiario/MBeneficiario');
		$this->MBeneficiario->obtenerID($cedula);
		$data['Beneficiario'] = $this->MBeneficiario;
		$this->load->view('reporte/beneficiario/carta_banco', $data);
	}

	/**
	*	*******************************************************
	*	FIN DE LOS REPORTES GENERALES DEL SISTEMA
	*	*******************************************************
	*/

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
		$this->load->model('beneficiario/MHistorialMovimiento');

		$this->MBeneficiario->obtenerID($cedula, $fecha);
		

		$this->MBeneficiario->HistorialDetalleMovimiento = $this->MHistorialMovimiento->listarDetalle($cedula);
		

		echo "<pre>";
		print_r($this->MBeneficiario);
		//echo json_encode($this->MBeneficiario);
	}

	public function consultarFiniquitos($cedula = '', $fecha = ''){
		$this->load->model('beneficiario/MBeneficiario');
		$this->load->model('beneficiario/MHistorialMovimiento');
		$this->MBeneficiario->obtenerID($cedula, $fecha);
		$this->MBeneficiario->HistorialDetalleMovimiento = $this->MHistorialMovimiento->listarDetalle($cedula)['Comparacion'];
		echo json_encode($this->MBeneficiario);
		//echo "<pre>";
		//print_r($this->MBeneficiario);
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
	/**
	*  Cargar Persona ( X: Saman.- )
	*
	*  @param string
	*  @return json
	*/
	function cargarPersona($id = ''){
		$this->load->model('beneficiario/MBeneficiario');
		echo json_encode( $this->MBeneficiario->CargarPersona($id) );
	}

	function listarDetalleMovimiento($id = ''){
		echo "<pre>";
		$this->load->model('beneficiario/MHistorialMovimiento');
		print_r( $this->MHistorialMovimiento->listarDetalle($id) );
	}

	function guardarFiniquito(){
		$this->load->model('beneficiario/MBeneficiario', 'Beneficiario');
		$this->load->model('beneficiario/MHistorialMovimiento');

		$json = json_decode($_POST['data']); // 'Hola Mundo'; //Object($_POST);
		$json->u_s = $_SESSION['usuario'];
		
		$fecha_aux = isset($json->f_r) ? $json->f_r : '';
		if($fecha_aux != ''){
			//$Beneficiario = $this->MBeneficiario->obtenerID($json->i_d);
			$f = explode('/', $fecha_aux);			
			$this->Beneficiario->fecha_retiro = $f[2] . '-' . $f[1] . '-' . $f[0];
			$json->f_r = $this->Beneficiario->fecha_retiro;
			$this->Beneficiario->cedula = $json->i_d;
			$this->Beneficiario->estatus_activo = 203;
			$this->MHistorialMovimiento->InsertarDetalle($json);
			$this->Beneficiario->ActualizarPorMovimiento();


			
			
			echo "Beneficiario Liquidado exitosamente...";
		}
		
	}

	function init(){
		phpinfo();
	}

}
