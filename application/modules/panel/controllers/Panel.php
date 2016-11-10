<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set ( 'America/Caracas' );
define ('__CONTROLADOR', 'panel');
class Panel extends MY_Controller {

	var $_DIRECTIVA = array();

	/**
	* CONSTRUCTOR DEL PANEL
	*
	*/
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('beneficiario/MDirectiva');
		$this->_DIRECTIVA = $this->MDirectiva->iniciar();
		if(!isset($_SESSION['usuario']))$this->salir();

	}

	public function verificar(){		
		$this->load->model('usuario/Iniciar');
	}

	/**
	* 	----------------------------------
	*	Sección de la GUI
	* 	----------------------------------
	*/
	public function index(){
		$data['Directiva'] = $this->_DIRECTIVA;
		$this->load->view("view_home", $data);
	}

	public function fideicomitente(){
		$data['Directiva'] = $this->_DIRECTIVA;
		$this->load->view("fideicomitente", $data);		
	}

	public function beneficiario(){
		$data['Directiva'] = $this->_DIRECTIVA;
		$this->load->view("menu/beneficiario/beneficiario", $data);	
	}

	public function asociarcuenta(){
		$data['Directiva'] = $this->_DIRECTIVA;
		$this->load->view("asociarcuenta", $data);
	}

	public function reporte(){
		$data['Directiva'] = $this->_DIRECTIVA;
		$this->load->view("menu/beneficiario/reporte", $data);
	}

	public function actualizar(){
		$data['Directiva'] = $this->_DIRECTIVA;
		$this->load->view("menu/beneficiario/actualizarbeneficiario", $data);
	}

	public function finiquitos(){
		$data['Directiva'] = $this->_DIRECTIVA;
		$this->load->view("menu/beneficiario/finiquito", $data);
	}
	public function historialsueldo(){
		$data['Directiva'] = $this->_DIRECTIVA;
		$this->load->view("relaciondesueldo", $data);
	}

	public function sueldolote(){
		$data['Directiva'] = $this->_DIRECTIVA;
		$this->load->view('sueldolote', $data);
	}

	public function ordenpago(){
		$data['Directiva'] = $this->_DIRECTIVA;
		$this->load->view("menu/orden_pago/orden", $data);
	}
	public function ordenpagoejecutada(){
		$data['Directiva'] = $this->_DIRECTIVA;
		$this->load->view("menu/orden_pago/ejecutada", $data);
	}

	public function consultarmovimiento(){
		$data['Directiva'] = $this->_DIRECTIVA;
		$this->load->view("menu/beneficiario/consultarmovimiento", $data);
	}

	public function medidajudicial(){
		$data['Directiva'] = $this->_DIRECTIVA;
		$this->load->view("menu/beneficiario/medidajudicial", $data);
	}
	public function anticipo(){
		$data['Directiva'] = $this->_DIRECTIVA;
		$this->load->model('beneficiario/MAnticipo');
		$data['lst'] = $this->MAnticipo->listarTodo();
		$this->load->view("menu/beneficiario/anticipo", $data);
	}


	public function directiva(){
		$data['Directiva'] = $this->_DIRECTIVA;
		$this->load->view("menu/calculos/directiva", $data);
	}


	public function aportecapital(){
		$data['Directiva'] = $this->_DIRECTIVA;
		$this->load->view("menu/calculos/aportecapital", $data);
	}

	public function asignacionantiguedad(){
		$data['Directiva'] = $this->_DIRECTIVA;
		$this->load->view("menu/calculos/asignacionantiguedad", $data);
	}

	public function interesescaidos(){
		$data['Directiva'] = $this->_DIRECTIVA;
		$this->load->view("menu/calculos/interesescaidos", $data);
	}

	public function interessemestral(){
		$data['Directiva'] = $this->_DIRECTIVA;
		$this->load->view("menu/calculos/interessemestral", $data);
	}

	public function calcinitereses(){
		$data['Directiva'] = $this->_DIRECTIVA;
		$this->load->view("menu/calculos/calcinitereses", $data);
	}
	public function reclamos(){
		$data['Directiva'] = $this->_DIRECTIVA;
		$this->load->view("menu/reclamos/reclamos", $data);
	}
	public function administrar(){
		$data['Directiva'] = $this->_DIRECTIVA;
		$this->load->view("menu/administracion/administrar", $data);
	}
	public function auditoria(){
		$data['Directiva'] = $this->_DIRECTIVA;
		$this->load->view("menu/administracion/reporteauditoria", $data);
	}

	//----------------------------------------
	public function calculadoraspace(){
		$data['Directiva'] = $this->_DIRECTIVA;
		$this->load->view("menu/otros/calculadoraspace", $data);
	}


	/**
	*	--------------------------------------
	*	Reportes Generales del Sistema
	*	--------------------------------------
	*/
	public function hojavida($cedula = '', $cod = ''){
		$this->load->model('beneficiario/MBeneficiario');
		$this->MBeneficiario->obtenerID($cedula);
		$this->load->model('beneficiario/MOrdenPago');
		$this->MBeneficiario->HistorialOrdenPagos = $this->MOrdenPago->listarPorCedula($cedula);

		$data['Beneficiario'] = $this->MBeneficiario;

		$this->load->view('reporte/beneficiario/hoja_vida', $data);
	}

	public function cartaBanco($cedula = '', $cod = ''){
		$this->load->model('beneficiario/MBeneficiario');
		$this->load->model('beneficiario/MHistorialMovimiento');

		$this->MBeneficiario->obtenerID($cedula);
		$this->MBeneficiario->HistorialDetalleMovimiento = $this->MHistorialMovimiento->listarDetalle($cedula);

		$data['Beneficiario'] = $this->MBeneficiario;
		$data['codigo'] = $cod; 
		$this->load->view('reporte/beneficiario/carta_banco', $data);
	}

	public function cartaBancoFallecido($cedula = ''){
		$this->load->model('beneficiario/MBeneficiario');
		$this->MBeneficiario->obtenerID($cedula);
		$data['Beneficiario'] = $this->MBeneficiario;
		$data['lst'] = $this->MBeneficiario->detalleMovimientoFamiliar($cedula);		
		$this->load->view('reporte/beneficiario/carta_banco_fallecido', $data);
	}
	public function cartaBancoFallecidoM($cedula = ''){
		$this->load->model('beneficiario/MBeneficiario');
		$this->MBeneficiario->obtenerID($cedula);
		$data['Beneficiario'] = $this->MBeneficiario;
		$data['lst'] = $this->MBeneficiario->detalleMovimientoFamiliar($cedula);		
		$this->load->view('reporte/beneficiario/asignacion_menos_diez', $data);
	}
	public function asignacionFAS($cedula = ''){
		$this->load->model('beneficiario/MBeneficiario');
		$this->MBeneficiario->obtenerID($cedula);
		$data['Beneficiario'] = $this->MBeneficiario;
		$data['lst'] = $this->MBeneficiario->detalleMovimientoFamiliar($cedula);		
		$this->load->view('reporte/beneficiario/asignacion_fs', $data);
	}
	


	public function puntoCuenta($cedula = '', $codigo){
		$this->load->model('beneficiario/MBeneficiario');
		$this->MBeneficiario->obtenerID($cedula);
		$this->load->model('beneficiario/MOrdenPago');
		$this->MBeneficiario->HistorialOrdenPagos = $this->MOrdenPago->listarPorCedula($cedula);
		$data['Beneficiario'] = $this->MBeneficiario;
		$data['codigo'] = $codigo;
		$this->load->view('reporte/beneficiario/punto_cuenta_anticipo', $data);
	}
	
	public function impirmirAnticiposReportes($desde = '', $hasta = '', $componente = '', $nombre_componente = ''){
		$this->load->model('beneficiario/MOrdenPago');
		$data['Componente'] = $nombre_componente;
		$data['desde'] = $desde;
		$data['hasta'] = $hasta;
		$data['Anticipos'] = $this->MOrdenPago->listarPorFecha($desde, $hasta, $componente);
		$this->load->view('reporte/beneficiario/reporte_anticipos', $data);
	}

	public function cartaFinanzas($desde = '', $hasta = '', $componente = '', $nombre_componente = ''){
		$this->load->model('beneficiario/MOrdenPago');
		$this->load->model('utilidad/NumeroLetras');
		$data['Numero'] = $this->NumeroLetras;
		$data['Componente'] = $nombre_componente;
		$data['desde'] = $desde;
		$data['Anticipos'] = $this->MOrdenPago->listarPorFecha($desde, $hasta);
		$this->load->view('reporte/beneficiario/carta_anticipos_finanzas', $data);
	}

	public function numeroLetras(){
		
		
	}

	/**
	*	---------------------------------------------
	*	FIN DE LOS REPORTES GENERALES DEL SISTEMA
	*	---------------------------------------------
	*/

	public function salir(){
		redirect('panel/Login/salir');
	}

	public function consultarBeneficiario($cedula = '', $fecha = ''){		
		$this->load->model('beneficiario/MBeneficiario');
		$this->MBeneficiario->obtenerID($cedula, $fecha);
		$this->load->model('beneficiario/MOrdenPago');
		$this->MBeneficiario->HistorialOrdenPagos = $this->MOrdenPago->listarPorCedula($cedula);
		echo json_encode($this->MBeneficiario);
	}

	public function consultarBeneficiarioJudicial($cedula = '', $fecha = ''){		
		$this->load->model('beneficiario/MBeneficiario');
		$this->load->model('beneficiario/MMedidaJudicial');

		$this->MBeneficiario->obtenerID($cedula, $fecha);
		$this->load->model('beneficiario/MOrdenPago');
		$this->MBeneficiario->HistorialOrdenPagos = $this->MOrdenPago->listarPorCedula($cedula);
		$this->MBeneficiario->MedidaJudicial = $this->MMedidaJudicial->listarTodo($cedula);
		//print_r($this->MBeneficiario->MedidaJudicial);

		echo json_encode($this->MBeneficiario);
	}

	public function consultarHistorialBeneficiario($id = ''){		
		$this->load->model('beneficiario/MBeneficiario');
		$lst = $this->MBeneficiario->consultarHistorial($id);
		echo json_encode($lst);
	}

	public function consultarBeneficiarios($cedula = '', $fecha = ''){		
		$this->load->model('beneficiario/MBeneficiario');
		$this->load->model('beneficiario/MHistorialMovimiento');
		$this->load->model('beneficiario/MOrdenPago');

		$this->MBeneficiario->obtenerID($cedula, $fecha);
		
		$this->MBeneficiario->HistorialOrdenPagos = $this->MOrdenPago->listarPorCedula($cedula);
		$this->MBeneficiario->HistorialDetalleMovimiento = $this->MHistorialMovimiento->listarDetalle($cedula);
		

		echo "<pre>";
		print_r($this->MBeneficiario);
		//echo json_encode($this->MBeneficiario);
	}

	public function cargarGradoComponente($id = 1){
		$this->load->model('beneficiario/MGrado');
		echo json_encode($this->MGrado->porComponente($id));
	}

	public function actualizarBeneficiario(){
		$this->load->model('beneficiario/MBeneficiario');
		$data = json_decode($_POST['data']);
		$Persona = $data->Persona;
		$Bnf = new $this->MBeneficiario();
		
		$this->MBeneficiario->obtenerID($Persona->cedula);

		$Bnf->cedula = $Persona->cedula;
		$Bnf->grado_id = $Persona->grado;
		$Bnf->nombres = $Persona->nombres;
		$Bnf->apellidos = $Persona->apellidos;
		$Bnf->tiempo_servicio_db = $Persona->tservicio;
		$Bnf->fecha_ingreso = $Persona->fingreso;
		//$Bnf->estado_civil = $Persona->cedula;
		$Bnf->numero_hijos = $Persona->nhijos;
		$Bnf->fecha_ultimo_ascenso = $Persona->fuascenso;
		$Bnf->ano_reconocido = $Persona->arec;
		$Bnf->mes_reconocido = $Persona->mrec;
		$Bnf->dia_reconocido = $Persona->drec;
		$Bnf->no_ascenso = $Persona->noascenso;
		$Bnf->profesionalizacion = $Persona->profesionalizacion;
		$Bnf->sexo = $Persona->sexo;
		$Bnf->fecha_creacion = date("Y-m-d H:i:s");
		$Bnf->usuario_creador = $_SESSION['usuario'];
		$Bnf->fecha_ultima_modificacion = date("Y-m-d H:i:s");
		$Bnf->usuario_modificacion = $_SESSION['usuario'];
		
		$this->MBeneficiario->InsertarHistorial(); //Creando la traza de la modificacion
		$Bnf->guardar();
		echo 'Proceso exitoso';

	}

	public function paralizarDesparalizar(){
		$this->load->model('beneficiario/MBeneficiario');
		$Bnf = new $this->MBeneficiario();
		$data = json_decode($_POST['data']);

		
		$this->MBeneficiario->obtenerID($data->Paralizar->id);
		$this->MBeneficiario->InsertarHistorial(); //Creando la traza de la modificacion
		
		$Bnf->cedula = $data->Paralizar->id;
		$Bnf->estatus_activo = $data->Paralizar->estatus;
		$Bnf->motivo_paralizacion = $data->Paralizar->motivo;
		$Bnf->observacion = 'PARALIZADO';
		if($data->Paralizar->estatus == '202')$Bnf->observacion = 'RETIRADO';		
		$Bnf->ParalizarDesparalizar();
		
		echo 'Proceso exitoso';


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
		$this->MBeneficiario->listarPorComponente(1);
		
		
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
		$this->load->model('beneficiario/MFiniquito');
		$this->load->model('beneficiario/MPartidaPresupuestaria');
		$data['Motivo'] = $this->MFiniquito->listarMotivos(); 
		$data['Partida'] = $this->MPartidaPresupuestaria->listarTodo();
		$this->load->view('menu/beneficiario/registrar_finiquito', $data);
	}

	function listarFiniquito(){
		echo '<pre>';
		
		$this->load->model('beneficiario/MFiniquito');			
		$lst = $this->MFiniquito->listarCodigo('11953710', 'fb08e9fc3f3407bff9e6');

		//$this->MHistorialMovimiento->isertarReverso($lst);
		print_r( $lst ); 
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

	public function guardarFiniquito(){
		$this->load->model('beneficiario/MBeneficiario', 'Beneficiario');
		$this->load->model('beneficiario/MBeneficiario');
		$this->load->model('beneficiario/MHistorialMovimiento');

		$json = json_decode($_POST['data']); // 'Hola Mundo'; //Object($_POST);
		$json->u_s = $_SESSION['usuario'];
		
		$fecha_aux = isset($json->f_r) ? $json->f_r : '';
		if($fecha_aux != ''){
			
			$this->MBeneficiario->obtenerID($json->i_d, '');
			$nombre = $this->MBeneficiario->nombres . ' ' . $this->MBeneficiario->apellidos;

			if($this->MBeneficiario->fecha_retiro == ''){
				
				$f = explode('/', $fecha_aux);			
				$this->Beneficiario->fecha_retiro = $f[2] . '-' . $f[1] . '-' . $f[0];
				$json->f_r = $this->Beneficiario->fecha_retiro;
				$this->Beneficiario->cedula = $json->i_d;
				$this->Beneficiario->estatus_activo = 203;
				$this->Beneficiario->observacion = $json->o_b;

				//echo "<pre>";
				$this->MHistorialMovimiento->InsertarDetalle($json);
				$this->Beneficiario->ActualizarPorMovimiento();
				$this->MBeneficiario->InsertarHistorial();
				$this->MBeneficiario->insertarDetalle($json);
				echo 'Se ha procesado exitosamente el finiquito del beneficiario (' . $nombre . ')...';
			}else{
				echo 'El beneficiario  (' . $nombre . ') ya posee un finiquito...';
			}

			
		}
		
	}

	public function reversarFiniquito($ced = '', $codigo = ''){
		$this->load->model('beneficiario/MBeneficiario', 'Beneficiario');
		$this->load->model('beneficiario/MBeneficiario');
		$this->load->model('beneficiario/MHistorialMovimiento');
		$this->load->model('beneficiario/MFiniquito');	
		
		$this->MBeneficiario->obtenerID($ced, '');
		$this->Beneficiario->fecha_retiro = '';
		$this->Beneficiario->cedula = $ced;
		$this->Beneficiario->estatus_activo = 201;
		$this->Beneficiario->observacion = 'REVERSO DE FINIQUITO';

		//$this->MHistorialMovimiento->InsertarDetalle($json);

		$lst = $this->MFiniquito->listarCodigo($ced, $codigo);
		$this->MHistorialMovimiento->isertarReverso($lst);
		$this->Beneficiario->ActualizarPorMovimiento();
		$this->MBeneficiario->InsertarHistorial(); //Creando la traza de la modificacion
			
		echo 'Se ha procesado exitosamente el reverso';
		
		
	}

	public function crearOrdenPago(){
		
		$this->load->model('beneficiario/MOrdenPago');

		
		$data = json_decode($_POST['data']);
		$this->MOrdenPago->cedula_beneficiario = $data->Anticipo->id;
		$this->MOrdenPago->cedula_afiliado = $data->Anticipo->id;
		
		$this->MOrdenPago->nombre = $data->Anticipo->nombre;
		$this->MOrdenPago->apellido = $data->Anticipo->apellido;
		$this->MOrdenPago->fecha =  date("Y-m-d");
		
		$this->MOrdenPago->motivo = $data->Anticipo->motivo;
		$this->MOrdenPago->estatus = $data->Anticipo->estatus;
		$this->MOrdenPago->tipo = $data->Anticipo->tipo;
		$this->MOrdenPago->monto = $data->Anticipo->monto;

		$this->MOrdenPago->fecha_creacion =  date("Y-m-d H:i:s");
		$this->MOrdenPago->usuario_creacion = $_SESSION['usuario'];
		$this->MOrdenPago->fecha_modificacion =  date("Y-m-d H:i:s");
		$this->MOrdenPago->usuario_modificacion = $_SESSION['usuario'];

		
		$this->MOrdenPago->salvar();	
		

		echo "Se registro el nuevo anticipo en estatus de pendiente";
	}

	public function ejecutarAnticipo(){
		//echo "<pre>";
		
		$this->load->model('beneficiario/MHistorialMovimiento');
		$this->load->model('beneficiario/MOrdenPago');

		$json = json_decode($_POST['data']); // 'Hola Mundo'; //Object($_POST);
		$json->u_s = $_SESSION['usuario'];
		
		$fecha_aux = isset($json->f_r) ? $json->f_r : '';
		if($fecha_aux != ''){
			$this->MOrdenPago->estatus = 100;
			$this->MOrdenPago->id = $json->o_b;
			$this->MOrdenPago->emisor = $json->emi;
			$this->MOrdenPago->revision = $json->rev;
			$this->MOrdenPago->autoriza = $json->aut;

			$this->MOrdenPago->ultima_observacion = $this->MHistorialMovimiento->InsertarDetalle($json);
			$this->MOrdenPago->ejecutar();
			echo 'Se ha ejecutado exitosamente el anticipo del beneficiario...';
			//print_r($json);
		}
		

	}

	public function reversarAnticipo(){
		$this->load->model('beneficiario/MOrdenPago');
		$this->load->model('beneficiario/MHistorialMovimiento');
		$this->load->model('beneficiario/MAnticipo');	
		$json = json_decode($_POST['data']);
		$ced = $json->cedula;
		$codigo = $json->certificado;

		$this->MOrdenPago->estatus = 103;
		$this->MOrdenPago->cedula_afiliado = $ced;
		$this->MOrdenPago->ultima_observacion = $codigo;
		//echo "<pre>";
		$lst = $this->MAnticipo->listarCodigo($ced, $codigo);
		//print_r($lst);
		$this->MHistorialMovimiento->isertarReverso($lst);
		$this->MOrdenPago->reversar();			
		echo 'Se ha procesado exitosamente el reverso';
		
		
	}
	public function rechazarAnticipo(){
		$this->load->model('beneficiario/MOrdenPago');
		$json = json_decode($_POST['data']);
		//print_r($json);
		$this->MOrdenPago->estatus = 102;
		$this->MOrdenPago->id = $json->id;
		$this->MOrdenPago->rechazar();			
		echo 'Se ha procesado exitosamente el reverso';
	}
	public function lstAnticipoFecha(){
		$this->load->model('beneficiario/MOrdenPago');
		$json = json_decode($_POST['data']);
		$lst = $this->MOrdenPago->listarPorFecha($json->desde, $json->hasta, $json->componente);
		echo json_encode($lst);
	}


	public function listarOrdenesPagoBeneficiario($id){
		$this->load->model('beneficiario/MOrdenPago');
		print_r($this->MOrdenPago->listarPorCedula($id));
	}

	public function actualizarClave($clv){
		$this->load->model('usuario/Usuario');
		$this->Usuario->id = $_SESSION['id'];
		$this->Usuario->clave =  $clv;
		$this->Usuario->actualizar();
		echo 'Actualización de Clave Exitosa';
	}

	function roles(){
		echo "<pre>";
		print_r($_SESSION);
	}

	function init(){
		phpinfo();
	}

}
