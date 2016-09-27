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

	function listar($cedula = '', $fecha_r = ''){
		$arr = array();

		$estatus = $fecha_r == '' ? '220' : '223';

		$sConsulta = 'SELECT  SUM(porcentaje) AS porcentaje, SUM(total_monto) AS total_monto, tipo_medida_id 
		FROM medida_judicial 
		WHERE cedula=\'' . $cedula . '\' AND status_id = ' . $estatus . ' GROUP BY tipo_medida_id';
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