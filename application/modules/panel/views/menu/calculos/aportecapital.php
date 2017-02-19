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
                  <h1>
                    Calculos
                    <small>Aporte de Capital.</small>
                  </h1>
                  <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Calculos</a></li>
                    <li><a href="#">Aporte de Capital</a></li>
                  </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                  <!-- Default box -->
                  <div class="box box-solid box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Aporte de capital</h3>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                          <i class="fa fa-minus"></i></button>
                          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                          </div>
                        </div>
                        <div class="box-body">
                     
                          
                            
                          
                            <div class="col-md-4">
                              <label>Fecha:</label>
                              <div class="input-group date">
                                <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control" id="datepicker1">
                              </div>
                          </div>
                   

                          
                          <div class="col-md-8">
                            <label>Seleccionar Directivas:</label>
                                <select class="form-control select2" style="width: 100%;" id="directiva">
                                  <option value="0" selected>SELECCIONAR UNA DIRECTIVA PARA INICIAR PROCESO</option>
                                  <?php

                                    foreach ($lst as $c => $v) {
                                      echo '<option value="' . $v->id . '">' . $v->nombre . '</option>';
                                    }
                                  ?>

                                </select>
                            
                          </div> <br>                          
                          <!-- /.input group -->
                          <br><br>
                          <div class="form-group"  style="display:none" id="detalle"><br>
                            <div class="col-md-12">
                              <b>Registros de Log:</b>
                              <textarea class="form-control" placeholder="Observacione" id="obse" style="width: 100%; height: 120px"  readonly></textarea>
                            </div>
                            <!-- /.input group -->
                          </div>
                          <!-- /.input group -->

                        </div>
                        <!-- /.form group -->
                        <div class="overlay"  id="cargando" style="display:none">
                            <i class="fa fa-refresh fa-spin"></i>

                        </div>

                      <!-- /.box-body -->
                      <div class="box-footer">
                        
                       <div class="row no-print">
                        <div class="col-md-12">

                          <button type="button" class="btn btn-primary pull-right" id="preparar" onclick="PrepararIndices()" id="btnGenerarIndices">
                            <i class="fa fa-cog"></i>&nbsp;&nbsp;Preparar Indices
                          </button>
                          <button type="button" class="btn btn-warning pull-right"  id="generar" onclick="GenerarAporte()" id="btnGenerarAporte" style="display:none">
                            <i class="fa fa-subscript"></i>&nbsp;&nbsp;Genear Calculos de Aporte
                          </button>
                          <button type="button" class="btn btn-success pull-right" id="descargar" onclick="DescargarAportes()" id="btnDescargarAportes" style="display:none">
                            <i class="fa fa-cloud-download"></i>&nbsp;&nbsp;Descargar Archivo
                          </button>
                          <button type="button" class="btn btn-danger" id="salir" onclick="principal()" id="btnSalir">
                            <i class="fa fa-close"></i>&nbsp;&nbsp;Salir de Aportes
                          </button>

                        </div>
                      </div>
                    </div>
                    <!-- /.box-footer-->
                  </div>
                  <!-- /.box -->


                  <!-- /.box -->
                </div>
              </div>

       </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.6.7
        </div>
        <strong>Copyright &copy; 2015-2016 Instituto de Previsión Social.</strong> Todos los derechos.
      </footer>

     
    </div><!-- ./wrapper -->

    <?php $this->load->view('inc/pie.php');?>
    <script src="<?php echo base_url()?>application/modules/panel/views/js/aporte_capital.js"></script>
  </body>
</html>