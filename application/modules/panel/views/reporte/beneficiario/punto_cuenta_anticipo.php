<?php  
  function fecha($fecha = ''){
    $mes = 'Enero';
    switch ($fecha) {
      case 'January':
        $mes="Enero";
        break;
      case 'February':
        $mes="Febrero";
        break;
      case 'March':
        $mes="Marzo";
        break;
      case 'April':
        $mes="Abril";
        break;
      case 'May':
        $mes="Mayo";
        break;
      case 'June':
        $mes="Junio";
        break;
      case 'July':
        $mes="Julio";
        break;
      case 'August':
        $mes="Agosto";
        break;
      case 'September':
        $mes="Septiembre";
        break;
      case 'October':
        $mes="Octubre";
        break;
      case 'November':
        $mes="Noviembre";
        break;
      case 'December':
        $mes="Diciembre";
        break;
      default:
        # code...
        break;
    }
    return $mes;
    
  }

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Formulario</title>
 <style>
    table {
        font-family: arial, sans-serif;
        font-size: 12px;
        border-collapse: collapse;
        width: 800px;
    }

    td{
        border: 0px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    th {
        border: 1px solid #dddddd;
        text-align: left;
        background-color: #dddddd; 
        padding: 8px;
    }

    /*tr:nth-child(even) {
        background-color: #dddddd;
    }*/
  </style>
  </head>
<BODY>
 <center>
 <table style="width: 700px">
 <tr>
   <td style="width: 65%;  border: 0px solid #dddddd; text-align: center; font-size: 10px">    
     REPÚBLICA BOLIVARIANA DE VENEZUELA<BR>
     MINISTERIO DEL PODER POPULAR PARA LA DEFENSA<BR>
     VICEMINISTERIO DE SERVICIOS, PERSONAL Y LOGISTICA<BR>
     DIRECCIÓN GENERAL DE EMPRESAS<BR>
     INSTITUTO DE PREVISIÓN SOCIAL<BR>
     DE LAS FUERZAS ARMADAS<BR>
   </td>
   <td style="width: 35%;  border: 0px solid #dddddd; text-align: right;">
     Sistema PACE<br>
     <?php echo 'Caracas, ' . date('d') . ' de ' . fecha(date('F')) . ' de '. date('Y') ?>

   </td>
 </tr>
 </table><BR>

 <table style="width: 900px;  text-align: justify;  font-size: 15px">
  <tr>
    <td>Nro.</td><td>320.600-<?php echo substr(md5($Beneficiario->cedula . $Beneficiario->fecha_ultima_modificacion), 0,6);?>/01</td>
  </tr> 
  <tr>
    <td>DE:</td><td><b>CNEL. EDUARDO JOSE MARTINEZ SALAS</b></td>
  </tr> 
  <tr>
    <td>PARA:</td><td><b>PRESIDENTE DEL IPSFA</b></td>    
  </tr> 

 </table>

 <table style="width: 900px;  text-align: justify;  font-size: 15px">
   <tr><td>TITULO DEL ASUNTO</td><td>DECISIÓN</td><td>OBSERVACIÓN</td></tr>
   <tr>
      <td>
        Esta Gerencia somete a la consideración del ciudadano GD. Presidente de la Junta Administradora del IPSFA,
        la solicitud formulada por <b><?php 
          echo $Beneficiario->Componente->Grado->nombre; echo $Beneficiario->nombres . ' ' . $Beneficiario->apellidos; ?>
         </b> titular de la cédula de identidad <b><?php echo $Beneficiario->cedula;?></b> de un adelanto de su 
         XXXXXXXXXX, con la finalidad: XXXXXCONCEPTOXXXXX. <br><br>
         Esta solicitud cumple con lo establecido en el Arículo 7° ordinal 4to del Reglamento de pago de 
         Asignaciones al Personal Militar.<br><br>
         Al profesional le corresponde por concepto de XXXXXXXXXX, la cantidad de Bs.
         

      </td>
      <td>DECISIÓN</td>
      <td>OBSERVACIÓN</td>
    </tr>
 </table>
</body>
</html>