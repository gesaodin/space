<?php

/**
 * Seguridad MamonSoft C.A
 * 
 *
 * @package mamonsoft.modules.seguridad
 * @subpackage perfil
 * @author Carlos Peña
 * @copyright	Derechos Reservados (c) 2014 - 2015, MamonSoft C.A.
 * @link		http://www.mamonsoft.com.ve
 * @since Version 1.0
 *
 */

class Perfil extends CI_Model{
	
	var $identificador;
	
	var $nombre;
	
	var $descripcion;

	var $Privilegios = array();

	var $Dependientes = array();
	
	
	
	function __construct() {
		parent::__construct();
		$this->load->model("comun/DBSpace");
		
	
	}
	
	function listar(){		
		$s = 'SELECT oid, nomb FROM space.menu';
		$obj = $this->DBSpace->consultar($s);
		return $obj->rs;
	}

	function listarSubMenu($id){
		$s = 'SELECT oid, url, obse FROM space.menu_accion WHERE idmenu=' . $id;
		$obj = $this->DBSpace->consultar($s);
		return $obj->rs;
	}

	/**
	*	Listar Perfiles con privilegios
	* 
	*	
	*/
	function listarPerfilPrivilegios($url){
		$s = 'SELECT p.oid,p.nomb,prv.oid AS oidp,prv.id, prv.nomb AS bnom FROM space.privilegio prv
				JOIN space.menu_accion ma ON prv.para=ma.url
				JOIN space.perfil_privilegio pp ON pp.oidpr=prv.oid
				JOIN space.perfil p ON p.oid=pp.oidp
				WHERE ma.url=\'' . $url . '\'';
		$obj = $this->DBSpace->consultar($s);
		$lst = array();
		$lstp = array();
		if($obj->code == 0 ){
			$perfil =  $obj->rs[0]->nomb;	

			foreach ($obj->rs as $clv => $v) {
				if($perfil != $v->nomb){
					$lst[$perfil] = $lstp;
					$perfil = $v->nomb;
					$lstp = null;
				}
				$lstp[] =  array(
					'oidp' => $v->oid,
					'cod'=> $v->oidp,
					'nomb' => $v->bnom
				);
			}
			$lst[$perfil] = $lstp;
		}
		return $lst;
	}

	function listarMenu($id = 0){
		$s = 'SELECT 
				ua.oid,ua.nomb,ua.obse,mnu.nomb as menu,ua.url,mnu.clase,ua.clase_, prv.id,prv.cod,prv.func,
				prv.nomb AS prvnomb, prv.visi,prv.clase AS clase_prv
			FROM space.usuario u
			JOIN space.usuario_menu um ON u.id=um.oidu
			JOIN space.menu_accion ua ON um.oidm=ua.oid 
			LEFT JOIN (
				SELECT 
					p.obse,pr.cod,pr.id,pr.func,pr.nomb,pr.clase, pr.para,pr.visi 
				FROM space.usuario u
				JOIN space.usuario_perfil up on u.id=up.oidu
				JOIN space.perfil p on p.oid = up.oidp
				JOIN space.perfil_privilegio pp ON p.oid=pp.oidp
				JOIN space.privilegio pr ON pp.oidpr=pr.oid
				WHERE u.id='  . $id . ') AS prv
			ON ua.url=prv.para 
			JOIN space.menu mnu ON ua.idmenu=mnu.oid
			WHERE u.id='  . $id . '
			ORDER BY mnu.oid';

		$obj = $this->DBSpace->consultar($s);

	    $lst = array();
	    $lstpriv = array();

	    if($obj->code == 0 ){
	      $nombre = $obj->rs[0]->menu;
	      $observacion = $obj->rs[0]->url;
	   
	      foreach ($obj->rs as $clv => $val) {	  
	      	if ($observacion != $val->url ){
	      		$lst[$nombre][$observacion]['priv_'] = $lstpriv;
	      		$nombre = $val->menu;
	      		$observacion = $val->url;
	      		$lstpriv = null;
	      	}	
	      	$lst[$val->menu][$val->url] = array(
	      		'oid' => $val->oid,
	          	'desc' => $val->obse, 
	          	'menu' => $val->menu,
	          	'url' => $val->url,
	          	'clase' => $val->clase,
	          	'clase_' => $val->clase_,
	          	'priv_' => array()
        	); 
	      	if ($val->id != ""){
	      		$lstpriv[$val->id] = array(
	      			'tipo' => $val->cod,
	      			'cod' => $val->id,
	      			'nomb' => $val->prvnomb,
	      			'clas' => $val->clase_prv,
	      			'func' => $val->func,
	      			'visi' => $val->visi
	      		);
	      	}
	      }
	    }
	    return json_encode($lst);

	}	
	
	function listaPrivilegios() {
		$s = 'select pr.cod,pr.id,pr.func,pr.nomb,pr.clase from space.usuario u
		join space.usuario_perfil up on u.id=up.oidu
		join space.perfil p on p.oid = up.oidp
		join space.perfil_privilegio pp ON p.oid=pp.oidp
		join space.privilegio pr ON pp.oidpr=pr.oid';
		$obj = $this->DBSpace->consultar($s);
		$lst = array();
		if($obj->code == 0 ){
			$nombre = $obj->rs[0]->menu;

			foreach ($obj->rs as $clv => $val) {

				if($nombre != $val->menu){
					$lst[$nombre] = $pr;
					$nombre = $val->menu;

					$pr = null;
				}
				$pr[] = array(
					'desc' => $val->obse, 
					'menu' => $val->menu,
					'url' => $val->url,
					'clase' => $val->clase,
					'clase_' => $val->clase_	 
					);


			}
			$lst[$nombre] = $pr;
		}


	}
	
	
	function __destruct(){
		unset($this->db);
	}
	
}
