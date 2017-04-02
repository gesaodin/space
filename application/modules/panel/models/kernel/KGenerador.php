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


  function Apertura($archivo, $tipo){
    $m = 35;
    if($tipo == 1)$m = 36;
    

    $this->load->model('kernel/KSensor');
    $handle = @fopen("tmp/" . $archivo, "r");
    $sum = 0;
    $plan = '12345';
    if ($handle) {
        while (($buffer = fgets($handle, 4096)) !== false) {
          $l = explode(";", $buffer);
          if($l[30] == "0" && $l[32] == "0"){
            $nombre = '';
            $cedula = $this->completarCero(9, $l[0], '0');
            $nac = 'V';
            $edocivil = 'S';
            $n = explode(" ", $l[5]);
            
            for( $i=0; $i < 4; $i++){
              if(isset($n[$i])){
                $nombre .= $this->completarCero(15, $n[$i], " ", 1); 
              }else{
                $nombre .= $this->completarCero(15, " ", " ");
              }
              
            }
            
            
            
            $campo = $this->completarCero(26, " ", "0");
            $monto = round($l[$m], 2);
            $monto_s = $this->completarCero(13, str_replace('.', '', $monto) , "0");            
            $ganancia = '0';
            $tipo_cuenta = '';

            $numeroyubicacion = $this->completarCero(15, " ", " "); 
            echo $plan . $nac . $cedula .  $nombre . 
            $edocivil . $campo . $monto_s . $ganancia . 
            $tipo_cuenta . $numeroyubicacion . "\n";
            $sum++;
          }
            //echo $buffer;
        }
        if (!feof($handle)) {
            return "Error: unexpected fgets() fail\n";
        }
        fclose($handle);
    }
    
    //echo "Lineas $sum <br>";

    //$this->KSensor->Duracion();
    return "Proceso Exitoso";
  }




  function Aporte($archivo){
    $this->load->model('kernel/KSensor');
    $handle = @fopen("tmp/" . $archivo, "r");
    $sum = 0;
    $plan = '12345';
    if ($handle) {
        while (($buffer = fgets($handle, 4096)) !== false) {
          $l = explode(";", $buffer);
          if($l[30] != "0" && $l[32] != "0"){
            $nombre = '';
            $cedula = $this->completarCero(9, $l[0], '0');
            $nac = 'V';
            $tiptrn = '1';
            $tippre = '01';
            $frmpgo = ' ';

            $n = explode(" ", $l[5]);
            
            for($i=0;$i<4;$i++){
              if(isset($n[$i])){
                $nombre .= $this->completarCero(15, $n[$i], " ", 1); 
              }else{
                $nombre .= $this->completarCero(15, " ", " ");
              }
              
            }
            
            
            
                
            $campo = $this->completarCero(26, " ", " ");

            $ganancia = '0';
            $tipo_cuenta = '';
            $numeroyubicacion = $this->completarCero(15, " ", " "); 

            echo $plan . $nac . $cedula .  $nombre . 
            $edocivil . $campo . $ganancia . 
            $tipo_cuenta . $numeroyubicacion . "\n";
            $sum++;
          }
            //echo $buffer;
        }
        if (!feof($handle)) {
            return "Error: unexpected fgets() fail\n";
        }
        fclose($handle);
    }
    
    //echo "Lineas $sum <br>";

    //$this->KSensor->Duracion();
    return "Proceso Exitoso";
  }


  function completarCero($cant, $cadena, $caracter = " ", $sentido = 0){    
     $largo_numero = strlen($cadena);
     $largo_maximo = $cant;
     $agregar = $largo_maximo - $largo_numero;
     //agrego los ceros
     for($i =0; $i<$agregar; $i++){
      if($sentido == 1){
        $cadena = $cadena . $caracter;  
      } else {
        $cadena = $caracter . $cadena;
      }
      
     }

     return $cadena;
  }

}
