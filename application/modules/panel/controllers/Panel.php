<?php
defined('BASEPATH') OR exit('No direct script access allowed');


define ('__CONTROLADOR', 'panel');
class Panel extends MY_Controller {


	function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}

	public function index(){

		$this->load->view("view_panel");
	}

	public function consultarBeneficiario($cedula = ''){		
		$this->load->model('beneficiario/MBeneficiario');
		$this->MBeneficiario->obtenerID($cedula);
		
	
		echo json_encode($this->MBeneficiario);
	}
	public function consultarBeneficiarios($cedula = ''){		
		$this->load->model('beneficiario/MBeneficiario');
		$this->MBeneficiario->obtenerID($cedula);
		

		echo "<pre>";
		print_r($this->MBeneficiario);
		//echo json_encode($this->MBeneficiario);
	}

	public function Directiva(){
		$this->load->model('beneficiario/MDirectiva');
		echo '<pre>';
		print_r($this->MDirectiva->iniciar());

	}

	public function calculo(){
			$this->load->model('beneficiario/MCalculo');
			print_r($this->MCalculo->AntiguedadCargo('2014-06-16'));
	}

	function ReversarVoucher($factura, $arrVoucher = ''){
		$lst = explode('%3E', $arrVoucher);
		$sActualizar = 'UPDATE t_lista_voucher SET estatus=0, observacion=\'\' WHERE `cid` LIKE \'' . $factura . '\' AND estatus=5;';
		echo $sActualizar . '<br>';
		//$this->db->query($sActualizar);
		$sActualizar = 'UPDATE t_lista_voucher SET estatus=0, observacion=\'\' WHERE `cid` LIKE \'' . $factura . '\' AND estatus=2;';
		echo $sActualizar . '<br><br>';
		//$this->db->query($sActualizar);
		foreach ($lst as $k => $v) {
			# code...
			echo '# --- ' . $v . '<br>';
			$sActualizar = 'UPDATE `electron`.`t_clientes_creditos` 
									SET `marca_consulta` = \'6\' WHERE 
									`t_clientes_creditos`.`contrato_id` = \'' . $v . '\';';
			echo $sActualizar;
			echo '<br>';
			//$this->db->query($sActualizar);
			$sActualizar = 'DELETE FROM `t_lista_cobros` WHERE 
									`credito_id` LIKE \'' . $v . '\' AND mes = \'Cambio De Modalidad\';';
			echo $sActualizar;
			echo '<br><br>';
			//$this->db->query($sActualizar);
		}
	}

	/**
	* 
	*/
	function imprimirComponente(){
		echo '<pre>';
		$this->load->model('beneficiario/MBeneficiario');
		$this->MBeneficiario->listarPorComponente(2);
		
		
		echo 'listo...';
	}

	function listarMovimientos(){
		echo '<pre>';
		$this->load->model('beneficiario/MHistorialMovimiento');
		$this->MHistorialMovimiento->listarPorComponente(1);
		
	}

	function restarFecha(){
		list($ano,$mes,$dia) = explode('-', '3-11-30');

    $ano_dif  = 2016 - $ano; //Porbar los tiempos
		echo $ano_dif;
    $mes_dif = 8 - $mes;
		echo $mes_dif;
    $dia_dif   = 2 - $dia;
    if ($dia_dif < 0 || $mes_dif < 0)
      $ano_dif--;
	
	  //return $ano_dif;
		
		echo $ano_dif;
	}
}
