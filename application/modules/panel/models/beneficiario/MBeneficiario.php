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
	var $cedula = '';

	/**
	* @var string
	*/
	var $nombres = '';
	
	/**
	* @var string
	*/
	var $apellidos = '';
		
	/**
	* @var string
	*/
	var $estado_civil = '';

	/**
	* @var string
	*/
	var $sexo = '';
	
	/**
	* @var int
	*/
	var $numero_hijos = 0;

	/**
	* @var string
	*/
	var $numero_cuenta = '';

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
	* @var string
	*/
	var $tiempo_servicio_aux = 0;

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
	var $estatus_descripcion;

	/**
	* @var int
	*/
	var $estatus_activo;

	/**
	* @var int
	*/
	var $no_ascenso;

	/**
	* @var date
	*/
	var $fecha_retiro = '';

	/**
	* @var date
	*/
	var $fecha_retiro_efectiva = '';
	
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
	* @var double
	*/
	var $prima_descendencia = 0.00;
	
	/**
	* @var double
	*/
	var $prima_transporte = 0.00;
	
	/**
	* @var double
	*/
	var $prima_especial = 0.00;
	
	/**
	* @var double
	*/
	var $prima_noascenso = 0.00;
	
	/**
	* @var double
	*/
	var $prima_tiemposervicio = 0.00;
	
	/**
	* @var double
	*/
	var $prima_profesionalizacion = 0.00;

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
	* @var MHistorialAnticipos
	*/
	var $HistorialAnticipo = array();

	/**
	* @var MMedidaJudicial
	*/
	var $MedidaJudicial = array();

	/**
	* @var MHistorialMovimiento
	*/
	var $HistorialDetalleMovimiento = array();

	/**
	* @var MCalculo
	*/
	var $Calculo = array();
	
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
		$this->load->model('beneficiario/MHistorialAnticipo');
		$this->load->model('beneficiario/MHistorialMovimiento');
		$this->load->model('beneficiario/MMedidaJudicial');
		$this->load->model('beneficiario/MDirectiva');
		$this->load->model('beneficiario/MCalculo');
		
		$this->Componente = new $this->MComponente();
		
	} 

	public function guardar(){

	}

	public function eliminar(){

	}

	public function obtenerID($id, $fecha = ''){
		$obj = $this->_consultar($id);
		if($obj->code == 0 ){
			foreach ($obj->rs as $clv => $val) {
				$this->cedula = $val->cedula;
				$this->nombres = $val->nombres;
				$this->apellidos = $val->apellidos;
				$this->estado_civil = $val->edo_civil;
				$this->estatus_activo = $val->status_id;
				$this->estatus_descripcion = $val->estatus_descripcion;
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
				$this->numero_cuenta = $val->numero_cuenta;
				$this->Componente->ObtenerConGrado($val->componente_id, $val->grado_id, $val->st_no_ascenso);
			}
			$this->HistorialSueldo = $this->MHistorialSueldo->listar($id);
			$this->HistorialMovimiento = $this->MHistorialMovimiento->listar($id);
			$this->MedidaJudicial = $this->MMedidaJudicial->listar($id, $this->fecha_retiro);
			$this->HistorialAnticipo = $this->MHistorialAnticipo->listar($id);
			
			if($fecha != '') $this->fecha_retiro = $fecha; //En el caso de calcular finiquitos
			$this->MCalculo->iniciarCalculosBeneficiario($this->MBeneficiario);
			//$this->Calculo = 		
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
		
		/** SIN BENEFICIARIO CALC
		$sConsulta = 'SELECT 
		  cedula, nombres, apellidos, grado_id,componente_id, tiempo_servicio, fecha_ingreso, 
		  edo_civil, n_hijos, f_ult_ascenso, anio_reconocido, mes_reconocido, 
		  dia_reconocido, f_ingreso_sistema, f_retiro, f_retiro_efectiva,
		  status_id, st_no_ascenso, numero_cuenta, st_profesion, sexo, status.descripcion AS estatus_descripcion
		FROM beneficiario JOIN status ON beneficiario.status_id=status.id WHERE cedula=\'' . $cedula . '\'';
		**/

		$sConsulta = '
			SELECT beneficiario.cedula, beneficiario.nombres, beneficiario.apellidos, 
				beneficiario.grado_id, beneficiario.componente_id, beneficiario.tiempo_servicio, 
				beneficiario.fecha_ingreso, beneficiario.edo_civil, beneficiario.n_hijos, 
				beneficiario.f_ult_ascenso, beneficiario.anio_reconocido, beneficiario.mes_reconocido, 
				beneficiario.dia_reconocido, beneficiario.f_ingreso_sistema, beneficiario.f_retiro, 
				beneficiario.f_retiro_efectiva, beneficiario.status_id, beneficiario.st_no_ascenso, 
				beneficiario.numero_cuenta, beneficiario.st_profesion, beneficiario.sexo,
				beneficiario_calc.numero_cuenta, status.descripcion AS estatus_descripcion 
			FROM beneficiario 
				JOIN beneficiario_calc ON beneficiario.cedula=beneficiario_calc.cedula
				JOIN status ON beneficiario.status_id=status.id WHERE beneficiario_calc.cedula=\'' . $cedula . '\'';
	

		//echo $sConsulta;

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

	function CargarFamiliares($id = ''){
		$this->load->model('comun/DbSaman');
		$familiar = array();
		
		$sConsulta = 'SELECT A.codnip, A.nombrecompleto, A.sexocod, A.persrelstipcod  FROM personas JOIN 
			(SELECT pers_relaciones.nropersona, personas.nombrecompleto, personas.sexocod, personas.codnip,pers_relaciones.persrelstipcod  FROM pers_relaciones 
				INNER JOIN pers_relacs_tipo ON pers_relaciones.persrelstipcod=pers_relacs_tipo.persrelstipcod
				INNER JOIN personas ON pers_relaciones.nropersonarel=personas.nropersona
				LEFT JOIN edo_civil ON personas.edocivilcod=edo_civil.edocivilcod
				LEFT JOIN direcciones ON personas.nropersona=direcciones.nropersona) AS A ON personas.nropersona = A.nropersona
			WHERE personas.codnip = \'' . $id . '\' AND tipnip=\'V\'';
		$obj = $this->DbSaman->consultar($sConsulta);
		foreach ($obj->rs as $clv => $val) {				
			$familiar[] = array(
				'cedula' => $val->codnip,
				'nombre'=> $val->nombrecompleto,
				'parentesco' => $this->Parentesco($val->sexocod, $val->persrelstipcod)
				);
				
				
		}
		return $familiar;

	}


	function Parentesco($sexo, $tipo){
		switch ($tipo) {
			case 'PD':
				$valor = 'MADRE';
				if($sexo == 'M')$valor = 'PADRE';
				break;
			case 'HJ':
				$valor = 'HIJA';
				if($sexo == 'M')$valor = 'HIJO';
				break;
			case 'HO':
				$valor = 'HERMANA';
				if($sexo == 'M')$valor = 'HERMANO';
				break;
			case 'EA':
				$valor = 'ESPOSA';
				if($sexo == 'M')$valor = 'ESPOSO';
				break;
			case 'CON':
				$valor = 'CONCUBINA';
				if($sexo == 'M')$valor = 'CONCUBINO';
				break;
			default:
				# code...
				break;
		}

		return $valor;
	}


	function CargarPersona($id){
		$this->load->model('comun/DbSaman');
		$familiar = array();
		
		$sConsulta = 'SELECT 
			nropersona, personas.nombrecompleto, personas.sexocod, personas.codnip  
			FROM personas WHERE personas.codnip = \'' . $id . '\' AND tipnip=\'V\' LIMIT 1';
		
		$obj = $this->DbSaman->consultar($sConsulta);
		foreach ($obj->rs as $clv => $val) {				
			$familiar = array(
				'cedula' => $val->codnip,
				'nombre'=> $val->nombrecompleto,
				'parentesco' => 'OTRO'
			);
				
				
		}
		return $familiar;
	}

}