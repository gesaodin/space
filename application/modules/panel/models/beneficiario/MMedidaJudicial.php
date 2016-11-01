<?php

/**
* 
*/
class MMedidaJudicial extends CI_Model{
	
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




}