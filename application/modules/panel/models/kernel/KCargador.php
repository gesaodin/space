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

class KCargador extends CI_Model{
  
  /**
  * @var MBeneficiario
  */
  var $Beneficiario = null;

  /**
  * @var Complejidad del Manejador (Driver)
  */
  var $Nivel = 0;
  /**
  * Iniciando la clase, Cargando Elementos Pace
  *
  * @access public
  * @return void
  */
  public function __construct(){
    parent::__construct();
    $this->load->model('kernel/KCalculo');
    $this->load->model('kernel/KGenerador'); 
  }
  

  function ConsultarBeneficiario($id = '', $param = array()){
    $this->load->model('fisico/MBeneficiario');
    $this->MBeneficiario->ObtenerID('11953710'); 
    $this->KCalculo->Ejecutar($this->MBeneficiario);
    return $this->MBeneficiario;
  } 



  
  public function IniciarLote(){
    ini_set('memory_limit', '256M');
    $this->load->model('kernel/KCalculoLote');
    $this->load->model('kernel/KDirectiva');
    $this->load->model('comun/Dbpace');

    $Reglas = $this->KDirectiva->Cargar(48); //Directivas
    
    //print_r($Reglas);

    

    $this->load->model('fisico/MBeneficiario');
    $con = $this->DBSpace->consultar("
      SELECT 
        beneficiario.cedula, fecha_ingreso,f_ult_ascenso, grado.codigo,
        n_hijos, st_no_ascenso,
        tablacruce.asig_antiguedad,tablacruce.dep_adicional,tablacruce.dep_garantia
      FROM 
        beneficiario  
      JOIN 
        grado ON beneficiario.grado_id=grado.id
      LEFT JOIN space.tablacruce ON beneficiario.cedula=space.tablacruce.cedula

      WHERE beneficiario.status_id=201 
    ");

    
    $lst = array();
    //$file=fopen("tmp/datos.txt","a") or die("Problemas");
    
    foreach ($con->rs as $k => $v) {
      $Bnf = new $this->MBeneficiario;
      $Bnf->cedula = $v->cedula;
      $Bnf->fecha_ingreso = $v->fecha_ingreso;
      //$Bnf->grado_id = $v->grado_id;
      $Bnf->asignacion_antiguedad = $v->asig_antiguedad;
      $Bnf->garantias = $v->dep_garantia;
      $Bnf->dia_adicional = $v->dep_adicional;
      $Bnf->numero_hijos = $v->n_hijos;
      $Bnf->no_ascenso = $v->st_no_ascenso;

      $Bnf->grado_codigo = $v->codigo;

      $Bnf->fecha_ultimo_ascenso = $v->f_ult_ascenso;
      $Bnf->fecha_retiro = '2017-03-31';
      //GENERADOR DE CALCULOS DINAMICOS
      $this->KCalculoLote->Ejecutar($Bnf, $Reglas);

      $linea = $v->cedula . ';' . $v->fecha_ingreso . ';' . $Bnf->fecha_ultimo_ascenso . ';' . 
      $Bnf->grado_codigo. ';' . $Bnf->sueldo_base . ';' . 
      $Bnf->asignacion_antiguedad . ';' . $Bnf->garantias . ';' . $Bnf->dia_adicional;

      //print_r($Bnf);
      //fputs($file,"\n");
      //fputs($file,$linea);
      
    }
    //fclose($file);
  
    
  }

  private function SeleccionarLoteBeneficiarios(){

      
  }


  function Generar(){

  }


}

