<?php 
if (!defined('BASEPATH'))
   	exit('No direct script access allowed');


class pruebatxt extends CI_Model{

	var $sql_codigo = 0;
  	var $sql_status_prof = 0;
  	var $sql_cedula = 0;
  	var $sql_grado = 0;
  	var $sql_num_hijo = 0;
  	var $sql_porc_no_asc = 0;
  	var $sql_an_rec_ser = 0;
  	var $sql_mes_recon_ser = 0;
  	var $sql_dia_recon_ser = 0;
  	var $sql_fec_ult_ascenso = 0;
  	var $sql_fecha_ingreso = 0;
  	var $sql_apellidos = '';
  	var $sql_nombres = '';
  	var $sql_apellidos2 = '';
  	var $sql_nombres2 = '';
  	var $sql_categoria = '';


    public function __construct(){
  		parent::__construct();
    	if(!isset($this->Dbpace)) $this->load->model('comun/Dbpace');
    }
      	
    public function leerArchivo(){
      $query  = "DELETE FROM data_componente";
      $obj = $this->Dbpace->consultar($query);

      $fp = fopen("/var/www/html/space/tmp/FIDEICOMITENTES.txt", "r");
      while(!feof($fp)) {
        fscanf($fp,"%1d %2d %8ld %15s %15s %15s %15s %4d %2d %2d %2d %2d %2d %8d %8d %2s",$sql_codigo,$sql_status_prof,$sql_cedula,$sql_apellidos,$sql_nombres,$sql_apellidos2,$sql_nombres2,$sql_grado,$sql_num_hijo,$sql_porc_no_asc,$sql_an_rec_ser,$sql_mes_recon_ser,$sql_dia_recon_ser,$sql_fecha_ingreso,$sql_fec_ult_ascenso,$sql_categoria);

        /*$query = "INSERT INTO data_componente values ($sql_codigo,$sql_status_prof,$sql_cedula,'$sql_apellidos','$sql_nombres',$sql_grado,$sql_num_hijo,$sql_porc_no_asc,$sql_an_rec_ser,$sql_mes_recon_ser,$sql_dia_recon_ser,'$sql_fecha_ingreso','$sql_fec_ult_ascenso','$sql_categoria')";*/

        $obj = $this->Dbpace->consultar($query);
        $apellidos = sprintf("%-15s",$sql_apellidos.' '.$sql_nombres);
        $nombres = sprintf("%-15s",$sql_apellidos2.' '.$sql_nombres2);

        echo $sql_codigo,$sql_status_prof,$sql_cedula,$apellidos,$nombres,$sql_grado,$sql_num_hijo,$sql_porc_no_asc,$sql_an_rec_ser,$sql_mes_recon_ser,$sql_dia_recon_ser,$sql_fecha_ingreso,$sql_fec_ult_ascenso,$sql_categoria. PHP_EOL;

        /*echo $query;*/
        $query  = "UPDATE data_componente set nombres = regexp_replace(nombres, '0', ' ', 'g'), apellidos = regexp_replace(apellidos, '0', ' ', 'g');";

    $obj = $this->Dbpace->consultar($query);
    $this->insertarLinea($sql_codigo,$sql_status_prof,$sql_cedula,$apellidos,$nombres,$sql_grado,$sql_num_hijo,$sql_porc_no_asc,$sql_an_rec_ser,$sql_mes_recon_ser,$sql_dia_recon_ser,$sql_fecha_ingreso,$sql_fec_ult_ascenso,$sql_categoria);
    }
    
    fclose($fp);
    $this->reporte();
    }
    			
	public function insertarLinea($sql_codigo,$sql_status_prof,$sql_cedula,$apellidos,$nombres,$sql_grado,$sql_num_hijo,$sql_porc_no_asc,$sql_an_rec_ser,$sql_mes_recon_ser,$sql_dia_recon_ser,$sql_fecha_ingreso,$sql_fec_ult_ascenso,$sql_categoria){
  
     			$sInsert = 'INSERT INTO data_componente(
    			componente,
    			status_prof,
   	   			cedula,
      			apellidos,
      			nombres,
      			grado,
      			num_hijos,
      			no_ascenso,
      			year_recon,
      			meses_recon,
      			dias_recon,
      			fecha_ingreso,
      			fec_ult_ascenso,
      			categoria
    		) VALUES (';

    		$sInsert .=
      		'\''. $sql_codigo . '\',
      		\'' . $sql_status_prof . '\',
      		\'' . $sql_cedula . '\',
      		\'' . $apellidos . '\',
      		\'' . $nombres . '\',
      		\'' . $sql_grado . '\',
      		\'' . $sql_num_hijo . '\',
      		\'' . $sql_porc_no_asc. '\',
      		\'' . $sql_an_rec_ser . '\',
      		\'' . $sql_mes_recon_ser . '\',
      		\'' . $sql_dia_recon_ser . '\',
      		\'' . $sql_fecha_ingreso . '\',
      		\'' . $sql_fec_ult_ascenso . '\',
      		\'' . $sql_categoria . '\')';
    
    		$obj = $this->Dbpace->consultar($sInsert);
  		}

  public function reporte(){
  
    $query = "COPY (SELECT DISTINCT b.cedula as cedula_comp,
      lpad(b.apellidos,16)||' '||b.nombres as apellidos_comp,
      a.apellidos as apellidos_pace,
      b.grado as grado_comp,
      c.codigo as grado_pace,
      b.componente as componente_comp,
      a.componente_id as componente_pace,
      b.fecha_ingreso as fec_ingreso_comp,
      a.fecha_ingreso as fec_ingreso_pace,
      b.year_recon as año_reconocido_comp,
      a.anio_reconocido as año_reconicido_pace,
      b.meses_recon as mes_reconocido_comp,
      a.mes_reconocido as mes_reconocido_pace,
      b.dias_recon as dias_reconocido_comp,
      a.dia_reconocido as dia_reconocido_pace,
      b.status_prof as estatus_prof_comp,
      a.st_profesion as estatus_prof_pace,
      b.fec_ult_ascenso as ultimo_ascen_comp,
      a.f_ult_ascenso as ultimo_ascen_pace,
      b.no_ascenso as no_ascenso_comp,
      a.st_no_ascenso as no_ascenso_pace,
      b.num_hijos as num_hijos_comp,
      a.n_hijos as num_hijos_pace
      FROM beneficiario as a, data_componente as b, grado as c
      WHERE a.cedula=b.cedula
      and   a.grado_id= c.id
      and   b.componente=c.componente_id) 
      TO '/var/www/html/space/tmp/prueba.csv' CSV HEADER DELIMITER '|';";


    $obj = $this->Dbpace->consultar($query);  
  }

public function incluirActualizar(){

    
    $file ="/var/www/html/space/tmp/FIDEICOMITENTES.txt";

    $query = "COPY beneficiario(cedula, codigo, tipo_movimiento_id, monto, f_contable, f_creacion, usr_creacion) FROM '$file' DELIMITER ';' TXT;";

    $obj = $this->Dbpace->consultar($query);
  }
}