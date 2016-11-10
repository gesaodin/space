<?php

/**
* 
*/
class MMedidaJudicial extends CI_Model{
	
	/**
	*	@var int
	*/
	var $id = 0;

	/**
	* @var date
	*/
	var $fecha = '';
	
	/**
	*	1 : Asignacion de Antiguedad | 2 : Intereses
	*	@var int
	*/
	var $tipo = 0;

	/**
	* @var string
	*/
	var $numero_oficio = '';

	/**
	* @var string
	*/
	var $descripcion_embargo = '';

	/**
	* @var string
	*/
	var $institucion = '';

	/**
	* @var string
	*/
	var $forma_pago = 0;

	/**
	* @var string
	*/
	var $cedula_beneficiario;

	/**
	* @var string
	*/
	var $numero_beneficiario;

	/**
	* @var string
	*/
	var $numero_autorizado;

	/**
	* @var integer
	*/
	var $estaus = 0;

	/**
	* @var string
	*/
	var $parentesco = 0;

	/**
	* @var string
	*/
	var $tipo_medida = 0;

	/**
	* @var string
	*/
	var $cantidad_salario = 0;

	/**
	* @var string
	*/
	var $unidad_tributaria = 0;

	/**
	* @var string
	*/
	var $nombre_autoridad = '';

	/**
	* @var string
	*/
	var $cargo_autoridad = '';

	/**
	* @var string
	*/
	var $motivo = 0;

	/**
	* @var string
	*/
	var $cedula = '';

	/**
	* @var string
	*/
	var $cedula_autorizado = '';

	/**
	* @var string
	*/
	var $fecha_creacion = '';

	/**
	* @var string
	*/
	var $usuario_creacion = '';

	/**
	* @var string
	*/
	var $fecha_ultima_modificacion = '';

	/**
	* @var string
	*/
	var $usuario_modificacion = '';

	/**
	* @var string
	*/
	var $ultima_observacion = '';

	/**
	* @var string
	*/
	var $municipio = 0;

	/**
	* @var string
	*/
	var $numero_expediente = '';

	/**
	* @var int
	*/
	var $porcentaje = 0;

	/**
	* @var double
	*/
	var $monto = 0;

	function __construct(){
		parent::__construct();
	}

	public function listar($cedula = '', $fecha_r = '', $estaus = false){
		$arr = array();

		$estatus_val = $fecha_r == '' ? 'status_id = 220' : 'status_id=223';
		
		$sEstatus = 'status_id IN(220, 223)';

		if($estaus == true){
			$sEstatus = 'status_id = 220';
		}

		$sConsulta = 'SELECT  SUM(porcentaje) AS porcentaje, SUM(total_monto) AS total_monto, tipo_medida_id 
		FROM medida_judicial 
		WHERE cedula=\'' . $cedula . '\' AND ' . $sEstatus . ' AND tipo_medida_id=1 GROUP BY tipo_medida_id';
		$obj = $this->Dbpace->consultar($sConsulta);
		
		$rs = $obj->rs;
		foreach ($rs as $c => $v) {
			$mdj = new $this->MMedidaJudicial();
			//$mdj->fecha = $v->f_documento;
			
			$mdj->porcentaje = $v->porcentaje;
			$mdj->monto = $v->total_monto;
			//$mdj->numero_expediente = $v->nro_expediente;
			$mdj->tipo = $v->tipo_medida_id;
			
			$arr[$v->tipo_medida_id] = $mdj;
		}
		return $arr;
	}

	public function listarTodo($cedula = ''){
		$arr = array();
		$sConsulta = 'SELECT  * 
			FROM medida_judicial 
			WHERE cedula=\'' . $cedula . '\' ';

		$obj = $this->Dbpace->consultar($sConsulta);
		

		$rs = $obj->rs;
		foreach ($rs as $c => $v) {
			$mdj = new $this->MMedidaJudicial();
			$mdj->fecha = $v->f_documento;
			$mdj->numero_oficio = $v->nro_oficio;
			$mdj->numero_expediente = $v->nro_expediente;
			$mdj->descripcion_embargo = $v->desc_embargo;
			$mdj->forma_pago = $v->forma_pago_id;
			$mdj->municipio = $v->municipio_id;
			$mdj->institucion = $v->institucion;

			$mdj->porcentaje = $v->porcentaje;
			$mdj->monto = $v->total_monto;
			$mdj->numero_expediente = $v->nro_expediente;
			$mdj->tipo = $v->tipo_medida_id;
			
			$arr[$v->tipo_medida_id] = $mdj;
		}

		return $arr;
	}

	/**
		*f_documento date,
		*nro_oficio character varying(30),
		*nro_expediente character varying(30),
		*total_monto numeric,
		*porcentaje numeric,
		*desc_embargo text,
		*forma_pago_id smallint,
		*municipio_id smallint,
		institucion character varying(200),
		desc_institucion text,
		ci_beneficiario character varying(20),
		n_beneficiario character varying(100),
		n_autorizado character varying(100),
		status_id integer,
		parentesco_id integer,
		tipo_medida_id integer,
		cantidad_salario integer,
		unidad_tributaria integer,
		nombre_autoridad character varying(100),
		cargo_autoridad character varying(100),
		motivo_id integer,
		cedula character varying(12),
		id integer NOT NULL DEFAULT nextval('medida_judicial_id_seq'::regclass),
		ci_autorizado character varying(20),
		f_creacion timestamp without time zone,
		usr_creacion character varying(30),
		f_ult_modificacion timestamp without time zone,
		usr_modificacion character varying(30),
		observ_ult_modificacion character varying(400),
	**/



}