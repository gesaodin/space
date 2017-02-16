<?php


// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';
// use namespace
use Restserver\Libraries\REST_Controller;
/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */

class WServer extends REST_Controller{
	
	public function __construct(){
		parent::__construct();
		
		
	}

	/**
	public function index_get(){
		

		$this->load->model('comun/DBSpace');
		//$this->load->model('kernel/KCargador');
		//$Beneficiario = $this->KCargador->ConsultarBeneficiario($this->get('id'));
		$sCon = "SELECT cedula,nombres,apellidos FROM beneficiario  WHERE status_id=201 LIMIT 100";
		$rs = $this->DBSpace->consultar($sCon);
	
		$lst = array();
		$i = 1;
		foreach ($rs->rs as $c => $v) {
			$lst[] = (array)$v;
		}
		
		$this->response($lst);
		
	}
	**/

	public function index_get(){
		//$this->load->model('comun/DBSpace');
		$this->load->model("comun/DbSaman");
		//$this->load->model('kernel/KCargador');
		//$Beneficiario = $this->KCargador->ConsultarBeneficiario($this->get('id'));
		
		$con = $this->DbSaman->consultar('SELECT codnip AS cedula FROM personas  LIMIT 10');
		
		$lst = array();
		foreach ($con->rs as $c => $v) {
			$lst[] = (array)$v;
		}
		$this->response($lst);
		//$this->response($Beneficiario);
	}

	public function index_post(){
		$this->load->model('comun/DBSpace');
		//$this->load->model('kernel/KCargador');
		//$Beneficiario = $this->KCargador->ConsultarBeneficiario($this->get('id'));
		
		//$this->response($Beneficiario, 201);
		$this->response($this->post('query'));
	/**
		$rs = $this->DBSpace->consultar($this->get('query'));

		
		$i = 1;
		foreach ($rs->rs as $c => $v) {
			$lst[] = (array)$v;
		}
		$this->response($lst);**/
	}

	public function book_get(){
		$this->response([
	'returned from delete:' => $this->get('id'),
	]);
	}
}