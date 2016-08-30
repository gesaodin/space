<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * MamonSoft 
 *
 * Componente
 *
 * @package pace\application\modules\panel\model\beneficiario
 * @subpackage utilidad
 * @author Carlos Peña
 * @copyright Derechos Reservados (c) 2015 - 2016, MamonSoft C.A.
 * @link http://www.mamonsoft.com.ve
 * @since version 1.0
 */

class MComponente extends CI_Model{

  /**
  * @var striing
  */
  var $id = null;

  /**
  * @var striing
  */
  var $nombre = '';

  /**
  * @var striing
  */
  var $descripcion = '';

  /**
  * @var MGrado
  */
  var $Grado;

  /**
  * Iniciando la clase, Cargando Elementos Pace
  *
  * @access public
  * @return void
  */
  public function __construct(){
    parent::__construct();
    $this->load->model('beneficiario/MGrado');
    $this->Grado = new $this->MGrado();
  }

  
  /**
  * @param int | Componente ID
  * @param int | Grado ID
  * @return MComponete 
  */
  public function ObtenerConGrado($cid, $gid){
    $sConsulta = 'SELECT grado.id AS gid, grado.codigo AS gcod, grado.nombre AS gnomb, grado.descripcion AS gdesc,
      componente_id AS cid, componente.nombre as cnomb, componente.descripcion as cdesc 
      FROM componente 
      JOIN grado ON componente.id = grado.componente_id
      WHERE componente.id=' . $cid . ' AND grado.id=' . $gid;
    
    $obj = $this->Dbpace->consultar($sConsulta);
    //print_r($obj);
    if($obj->code == 0 ){
      foreach ($obj->rs as $clv => $val) {
        $this->id = $val->cid;
        $this->nombre = $val->cnomb;
        $this->descripcion = $val->cdesc;
        $this->Grado->id = $val->gid;
        $this->Grado->codigo = $val->gcod;
        $this->Grado->nombre = $val->gnomb;
        $this->Grado->descripcion = $val->gdesc;
      }
    }
  }

  /**
  * @param int | Componente ID
  * @return array 
  */
  public function Listar($id){
    $sConsulta = 'SELECT grado.id AS gid, grado.codigo AS gcod, grado.nombre AS gnomb, grado.descripcion AS gdesc,
      componente_id AS cid, componente.nombre as cnomb, componente.descripcion as cdesc 
      FROM componente 
      JOIN grado ON componente.id = grado.componente_id
      WHERE componente.id=' . $id;
    
    $obj = $this->Dbpace->consultar($sConsulta);
    $lstComponente = array();

    if($obj->code == 0 ){
      foreach ($obj->rs as $clv => $val) {
        $Componente = new $this->MComponente();
        $Componente->id = $val->cid;
        $Componente->nombre = $val->cnomb;
        $Componente->descripcion = $val->cdesc;
        $Componente->Grado->id = $val->gid;
        $Componente->Grado->codigo = $val->gcod;
        $Componente->Grado->nombre = $val->gnomb;
        $Componente->Grado->descripcion = $val->gdesc;
        $lstComponente[] = $Componente;
      }
    }
    return $lstComponente;
     
  }

  
}