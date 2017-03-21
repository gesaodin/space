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

class Perfil {
	
	var $identificador;
	
	var $nombre;
	
	var $descripcion;

	var $Privilegios = array();

	var $Dependientes = array();
	
	
	
	function __construct() {
		parent::__construct();
		
	}
		
	
	function listaPrivilegios() {
		
	}
	
	
	function __destruct(){
		unset($this->db);
	}
	
}
