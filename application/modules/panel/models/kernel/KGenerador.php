<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * MamonSoft 
 *
 * Kernel
 *
 * @package pace\application\modules\panel\model\beneficiario
 * @subpackage utilidad
 * @author Carlos Peña
 * @copyright Derechos Reservados (c) 2015 - 2016, MamonSoft C.A.
 * @link http://www.mamonsoft.com.ve
 * @since version 1.0
 */

class KGenerador extends CI_Model{
  
  /**
  * Iniciando la clase, Cargando Elementos Pace
  *
  * @access public
  * @return void
  */
  public function __construct(){
    parent::__construct();
  }
  

  function Calcular(MBeneficiario & $Beneficiario){

  }

  function Generar(){

  }

  /**
  * Listar tamaños y de las tablas
  */

  function VerArquitecturaDeTablas(){
    $sCon = '
      SELECT relname AS "relation",
        pg_size_pretty(pg_total_relation_size(C.oid)) AS "total_size"
      FROM pg_class C
      LEFT JOIN pg_namespace N ON (N.oid = C.relnamespace)
      WHERE nspname NOT IN (\'pg_catalog\', \'information_schema\')
        AND C.relkind <> \'i\'
        AND nspname !~ \'^pg_toast\'
      ORDER BY pg_total_relation_size(C.oid) DESC
      LIMIT 5;
    ';
  }

  /**
  * Firmar la BD en columnas para saber si cambiaron algo
  */
  function VerPesoDeColumnas(){
    $sCon = '
      SELECT sum(pg_column_size(componente_id)),sum(pg_column_size(grado_id)) FROM beneficiario where status_id=201;
    ';
  }
}
