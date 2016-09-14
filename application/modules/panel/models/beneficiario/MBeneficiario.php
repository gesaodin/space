<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * MamonSoft 
 *
 * Beneficiario
 *
 * @package pace\application\modules\model
 * @subpackage utilidad
 * @author Carlos Peña
 * @copyright Derechos Reservados (c) 2015 - 2016, MamonSoft C.A.
 * @link http://www.mamonsoft.com.ve
 * @since version 1.0
 */

class MBeneficiario extends CI_Model{

	/**
	* @var string
	*/
	var $cedula;

	/**
	* @var string
	*/
	var $nombres;
	
	/**
	* @var string
	*/
	var $apellidos;
		
	/**
	* @var string
	*/
	var $estado_civil;

	/**
	* @var string
	*/
	var $sexo;
	
	/**
	* @var string
	*/
	var $numero_hijos;

	/**
	* @var date
	*/
	var $fecha_ingreso;
	
	/**
	* @var date
	*/
	var $fecha_ingreso_reconocida = '';

	/**
	* @var string
	*/
	var $tiempo_servicio = 0;

	/**
	* @var date
	*/
	var $fecha_ultimo_ascenso = '';

	/**
	* @var int
	*/
	var $antiguedad_grado = 0;

	/**
	* @var int
	*/
	var $grado_codigo = 0;

	/**
	* @var string
	*/
	var $ano_reconocido;
	
	/**
	* @var string
	*/
	var $mes_reconocido;
	
	/**
	* @var int
	*/
	var $dia_reconocido;

	/**
	* @var int
	*/
	var $estus_activo;

	//var $numero_cuenta = '';

	/**
	* @var int
	*/
	var $no_ascenso;

	/**
	* @var date
	*/
	var $fecha_retiro;

	/**
	* @var date
	*/
	var $fecha_retiro_efectiva;
	
	/**
	* @var double
	*/
	var $profesionalizacion;

	/**
	* @var double
	*/
	var $sueldo_base = 0.00;

	/**
	* @var double
	*/
	var $sueldo_global = 0.00;

	/**
	* @var double
	*/
	var $aguinaldos = 0.00;

	/**
	* @var double
	*/
	var $sueldo_integral = 0.00;

	/**
	* @var double
	*/
	var $asignacion_antiguedad = 0.00;

	/**
	* @var double
	*/
	var $vacaciones = 0.00;

	/**
	* @var double
	*/
	var $ano_antiguedad = 0.00;

	/**
	* @var double
	*/
	var $no_depositado_banco = 0.00;

	/**
	* @var MPrima
	*/
	var $Prima = array();

	/**
	* @var MComponente
	*/
	var $Componente = null;

	/**
	* @var MHistorialMovimiento
	*/
	var $HistorialMovimiento = array();

	/**
	* @var MHistorialSueldo
	*/
	var $HistorialSueldo = array();

	/**
	* @var MCalculo
	*/
	var $Calculo = null;
	
	/**
	* Iniciando la clase, Cargando Elementos Pace
	*
	* @access public
	* @return void
	*/
	public function __construct(){
		parent::__construct();
		$this->load->model('comun/Dbpace');
		$this->load->model('beneficiario/MComponente');
		$this->load->model('beneficiario/MHistorialSueldo');
		$this->load->model('beneficiario/MHistorialMovimiento');
		$this->load->model('beneficiario/MDirectiva');
		$this->load->model('beneficiario/MCalculo');
		
		$this->Componente = new $this->MComponente();
		
	} 

	public function guardar(){

	}

	public function eliminar(){

	}

	public function obtenerID($id){
		$obj = $this->_consultar($id);
		if($obj->code == 0 ){
			foreach ($obj->rs as $clv => $val) {
				$this->cedula = $val->cedula;
				$this->nombres = $val->nombres;
				$this->apellidos = $val->apellidos;
				$this->estado_civil = $val->edo_civil;
				$this->estus_activo = $val->status_id;
				$this->numero_hijos = $val->n_hijos;
				//$this->tiempo_servicio = $val->tiempo_servicio; //El tiempo es una herencia referencial al Beneficiario en MCalculo
				$this->fecha_ingreso = $val->fecha_ingreso;
				$this->ano_reconocido = $val->anio_reconocido;
				$this->mes_reconocido = $val->mes_reconocido;
				$this->dia_reconocido = $val->dia_reconocido;				
				$this->sexo = $val->sexo;
				$this->fecha_ultimo_ascenso = $val->f_ult_ascenso;
				$this->no_ascenso = $val->st_no_ascenso;
				$this->profesionalizacion = $val->st_profesion;
				$this->fecha_retiro = $val->f_retiro;
				$this->fecha_retiro_efectiva = $val->f_retiro_efectiva;
				//$this->numero_cuenta = $val->numero_cuenta;
				$this->Componente->ObtenerConGrado($val->componente_id, $val->grado_id, $val->st_no_ascenso);
			}
			$this->HistorialSueldo = $this->MHistorialSueldo->listar($id);
			$this->HistorialMovimiento = $this->MHistorialMovimiento->listar($id);
			$this->Calculo = $this->MCalculo->iniciarCalculosBeneficiario($this->MBeneficiario);		
		}
	}

	/**
	* Consultar un beneficiario por cedula
	*
	* @access private
	* @param string
	* @return Dbpace
	*/
	private function _consultar($cedula = ''){
		$sConsulta = 'SELECT 
		  cedula, nombres, apellidos, grado_id,componente_id, tiempo_servicio, fecha_ingreso, 
		  edo_civil, n_hijos, f_ult_ascenso, anio_reconocido, mes_reconocido, 
		  dia_reconocido, f_ingreso_sistema, f_retiro, f_retiro_efectiva,
		  status_id, st_no_ascenso, numero_cuenta, st_profesion, sexo
		FROM beneficiario WHERE cedula=\'' . $cedula . '\'';
		$obj = $this->Dbpace->consultar($sConsulta);
		
		return $obj;

	}


	/**
	* Consultar los beneficiario por componente, cargar diirectivas, instanciar las primas y ejeutar calculos
	*
	* @access public
	* @param string
	* @return Dbpace
	*/
	public function listarPorComponente($idComponente = 0){
		$this->load->model('beneficiario/MCalculo');
		$this->load->model('beneficiario/MDirectiva');
	    $Directiva = $this->MDirectiva->iniciar();
	    $this->load->model('beneficiario/MPrima');
	    $Prima = $this->MPrima->obtenerSegunDirectiva($Directiva->id);
	    $Prima->unidad_tributaria = $Directiva->unidad_tributaria;
		$this->load->model('beneficiario/MCalculo');

		$this->load->model('beneficiario/MHistorialMovimiento');
		$HistorialMovimiento = $this->MHistorialMovimiento->listarPorComponente($idComponente);

		$sConsulta = 'SELECT 
				cedula, nombres, apellidos, grado_id, beneficiario.componente_id, tiempo_servicio, fecha_ingreso, 
				edo_civil, n_hijos, f_ult_ascenso, anio_reconocido, mes_reconocido, 
				dia_reconocido, f_ingreso_sistema, f_retiro, f_retiro_efectiva,
				beneficiario.status_id, st_no_ascenso, numero_cuenta, st_profesion, sexo,grado.codigo AS grado_codigo, grado.nombre
				FROM beneficiario
				JOIN grado ON grado.id=grado_id
				WHERE beneficiario.status_id=201 
				AND beneficiario.componente_id = ' . $idComponente;
	  $obj = $this->Dbpace->consultar($sConsulta);
		$i = 0;
		foreach ($obj->rs as $clv => $val) {	
				
				$Beneficiario = new $this->MBeneficiario();
				$Beneficiario->cedula = $val->cedula;			
				$Beneficiario->nombres = $val->nombres;
				$Beneficiario->apellidos = $val->apellidos;
				$Beneficiario->estado_civil = $val->edo_civil;
				$Beneficiario->estus_activo = $val->status_id;
				$Beneficiario->numero_hijos = $val->n_hijos;
				$Beneficiario->fecha_ingreso = $val->fecha_ingreso;
				$Beneficiario->ano_reconocido = $val->anio_reconocido;
				$Beneficiario->mes_reconocido = $val->mes_reconocido;
				$Beneficiario->dia_reconocido = $val->dia_reconocido;				
				$Beneficiario->sexo = $val->sexo;
				$Beneficiario->fecha_ultimo_ascenso = $val->f_ult_ascenso;
				$Beneficiario->no_ascenso = $val->st_no_ascenso;
				$Beneficiario->profesionalizacion = $val->st_profesion;
				$Beneficiario->fecha_retiro = $val->f_retiro;
				$Beneficiario->fecha_retiro_efectiva = $val->f_retiro_efectiva;
				$Beneficiario->grado_codigo = $val->grado_codigo;
								
				$this->MCalculo->iniciarCalculosLote($Beneficiario, $HistorialMovimiento, $Directiva, $Prima);
				$lst[] = $Beneficiario;
				$i++;
		}
		
		echo '<pre>';		
		print_r($lst);
		echo 'Registros Consultados: ' . $i . '<br><br>';
		
		return $lst;
	}



}