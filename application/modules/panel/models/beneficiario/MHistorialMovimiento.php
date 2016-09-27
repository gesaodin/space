<?php

/**
* 
*/
class MHistorialMovimiento extends CI_Model{
	var $id = '';
	var $tipo = 0;
	var $fecha = '';
	var $monto = 0.00;	
	
	function __construct(){
		parent::__construct();
		if(!isset($this->Dbpace)) $this->load->model('comun/Dbpace');
	}

	function listar($cedula = ''){
		$arr = array();
		$sConsulta = 'select tipo_movimiento_id, sum(monto) AS monto, MAX(f_contable) AS f_contable from movimiento where cedula =\'' . $cedula . '\' GROUP BY tipo_movimiento_id';
		$obj = $this->Dbpace->consultar($sConsulta);
		
		$rs = $obj->rs;
		foreach ($rs as $c => $v) {
			$hm = new $this->MHistorialMovimiento();
			$hm->id = $v->tipo_movimiento_id;
			$hm->fecha = substr($v->f_contable, 0, 10);
			$hm->monto = $v->monto;
			$arr[$hm->id] = $hm;
		}
		return $arr;
	}


	public function listarPorComponente($idComponente = 0){
		$sConsulta = 'SELECT 
										beneficiario.cedula AS cedula, movimiento.tipo_movimiento_id, 
										SUM(movimiento.monto) AS monto, MAX(f_contable) AS f_contable FROM beneficiario 
										JOIN movimiento ON beneficiario.cedula=movimiento.cedula
									WHERE beneficiario.status_id=201 AND movimiento.tipo_movimiento_id != 99
									AND beneficiario.componente_id = ' . $idComponente . '
									 GROUP BY beneficiario.cedula, movimiento.tipo_movimiento_id';
	  $obj = $this->Dbpace->consultar($sConsulta);
		$lst = array();
		$lstH = array();
		$ced = 0;
		$i = 0;
		foreach ($obj->rs as $clv => $val) {		
			if($ced != $val->cedula){
				$lstH = array();
				$ced = $val->cedula;
			}
			$lstH[$val->tipo_movimiento_id] = array('monto' => $val->monto, 'fecha' => $val->f_contable ); 
			$lst[$ced] = $lstH;
			$i++;				
		}
		/**
		echo '<pre>';		
		print_r($lst);
		echo 'Registros Consultados: ' . $i . '<br><br>';
		**/
		return $lst;
	}


}