
<!DOCTYPE html>
<html>
  <?php $this->load->view('inc/cabecera.php');?>
    <!-- Site wrapper -->
    <div class="wrapper">

      <?php $this->load->view('inc/top.php');?>


      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
       <section class="content-header">

       <style type="text/css">
.juntas{
  padding-right: 0px;
padding-left: 0px;
}
       </style>
      <h1>
        Actualizar Aportes
        <small>.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Principal</a></li>
        <li><a href="#">Actualizar Aportes</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Actualizar Aportes</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
       
                   
        

        
        <div class="box-body">
                   
                    <table id="reportearchivos" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th style="width:350px;">Archivos Bancarios</th>
                            <th >Llave del Archivo</th>
                            <th style="width: 50px;">Registros</th>
                            <th>Descripcion</th>
                            <th>Peso</th>
                        </tr>
                        </thead>
                        <tbody>
                          <?php
                          foreach ($Archivos as $k => $v) {

                          $url = '/system/space/tmp/' . tipoMovimiento($v['tipo']) .  $v['id'] . '/APERT' . $v['sub'] . '.txt';
                          $urlApert = '/system/space/tmp/' . tipoMovimiento($v['tipo']) .  $v['id'] . '/APORT' . $v['sub'] . '.txt';
                          $urlRetir = '/system/space/tmp/' . tipoMovimiento($v['tipo']) .  $v['id'] . '/RETIR' . $v['sub'] . '.txt';
                          $urlResumen = 'resumenaporte/' . substr($v['id'], -8) . '/' . $v['tipo'] . '/' . $v['fecha'];
                          $urlActualizar = 'actualizarMovimiento/' . substr($v['id'], -8) . '/' . $v['tipo'] . '/' . $v['fecha'];
                            echo '<tr>
                                      <td>
                                        <a href="' .  $url . '" target="top" class="btn btn-app">
                                          <span class="badge bg-green">' . $v['apertura'] . '</span>
                                          <i class="fa fa-barcode"></i> Apertura
                                        </a>
                                        <a href="' . $urlApert . '"  target="top" class="btn btn-app">
                                          <span class="badge bg-green">' . $v['aporte'] . '</span>
                                          <i class="fa fa-barcode"></i> Aporte
                                        </a>
                                        <a href="' . $urlRetir . '"  target="top" class="btn btn-app">
                                          <span class="badge bg-green">' . $v['retiro'] . '</span>
                                          <i class="fa fa-barcode"></i> Retiro
                                        </a>
                                        <a href="' .  $urlResumen . '" target="top" class="btn btn-app">
                                          <i class="fa fa-print"></i> Resumen
                                        </a>
                                        <a href="' .  $urlActualizar . '" target="top" class="btn btn-app">
                                          <i class="fa fa-edit"></i> Atualizar
                                        </a>                    
                                      </td>
                                      <td>' . $v['id'] . '<br>' . $v['fecha'] .'<br>' . $v['usuario'] . '</td>
                                      <td>' . $v['registro']. '</td>
                                      <td>' . $v['tipotexto'] . '</td>
                                      <td>' . $v['peso'] . '</td>
                                    </tr>';

                            }

                            function tipoMovimiento($id) {
                              $tipo = '';
                              switch ($id) {
                                case 0:
                                  $tipo = 'G';
                                  break;
                                case 1:
                                  $tipo = 'D';
                                  break;
                                case 2:
                                  $tipo = 'A';
                                  break;
                                default:
                                  $tipo = 'G';
                                  break;
                              }
                              return $tipo;
                            }
                          ?>
                        </tbody>
                      </table>
                    
                    <br>
                    
                  <div class="form-group">
                    <div class="col-md-2"><label>Fecha Valor:</label></div>
                      <div class="col-md-4">
                          <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                                <input type="text" class="form-control" id="datepicker">
                          </div>
                      </div>
                      <div class="col-md-4">
                        <a href="#!" onclick="actualizarfecha()" class="btn btn-primary pull-left" target="_top" id='btnActualizar'><i class="fa fa-refresh"></i>&nbsp;&nbsp;Actualizar Fecha Valor</a>
                      </div>
                      <br>
                      <br>
                  </div>
                  <br>
                  <div class="form-group">
                    <div class="col-md-2"><label>Cedula del Rechazo:</label></div> 
                        <div class="col-md-4">
                          <input type="text" class="form-control" placeholder="Cedula" id="cedula" maxlength="16"></input>               
                        </div> 
                        <div class="col-md-4">
                          <a href="#!" onclick="actualizar()" class="btn btn-primary pull-left" target="_top" id='btnActualizar'><i class="fa fa-refresh"></i>&nbsp;&nbsp;Actualizar Rechazos</a>
                        </div>
                        <br>
                        <br>
                        <?php
                          foreach ($Archivos as $k => $v) {
                           echo '<option id="llave" value="' . substr($v['id'], -8) . '"></option>';
                          }
                        ?>
                  </div>
        
      <!-- /.box -->

    </section>
        <!-- /.content -->

        <!-- Main content -->

      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.6.7
        </div>
        <strong>Copyright &copy; 2015-2016 Instituto de Previsión Social.</strong> Todos los derechos.
      </footer>

     
    </div><!-- ./wrapper -->

    <?php $this->load->view('inc/pie.php');?>
    <script src="<?php echo base_url()?>application/modules/panel/views/js/actualizar_aporte.js"></script>
  </body>
</html>