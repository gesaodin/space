<?php

/**
* 
*/
class MHistorialSueldo extends CI_Model{
	var $fecha = '';
	var $sueldo_base = 0;
	var $sueldo_global = 0;	
	
	function __construct(){
		parent::__construct();
	}

	function listar($cedula = ''){
		$arr = array();
		$sConsulta = 'SELECT * FROM historial_sueldo WHERE cedula=\'' . $cedula . '\'';
		$obj = $this->Dbpace->consultar($sConsulta);
		
		$rs = $obj->rs;
		foreach ($rs as $c => $v) {
			$hs = new $this->MHistorialSueldo();
			$hs->fecha = $v->fecha;
			$hs->sueldo_base = $v->sueldo_base;
			$hs->sueldo_global = $v->sueldo_global;
			$arr[] = $hs;
		}
		return $arr;
	}


}