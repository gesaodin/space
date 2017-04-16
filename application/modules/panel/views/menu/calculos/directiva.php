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



 <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Directiva de Sueldo</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="col-md-12">
                    <label>Seleccionar Directivas:</label>
                        <select class="form-control select2" style="width: 100%;" id="directiva">
                          <option value="0" selected>SELECCIONAR UNA DIRECTIVA PARA INICIAR PROCESO</option>
                          <?php

                            foreach ($lst as $c => $v) {
                              echo '<option value="' . $v->id . '">' . $v->nombre . '</option>';
                            }
                          ?>

                        </select>
                    
                  </div>

                  
                  



              </div>
             
              <!-- /.box-body -->
              <div class="box-footer">
               <div class="row no-print">
                <div class="col-xs-6">

                  <button type="button" class="btn btn-success pull-right" onclick="ConsultarID()"><i class="fa fa-search"></i> Consultar
                  </button>
                </div>
                <div class="col-xs-6">
                  <button type="button" class="btn btn-danger" style="margin-right: 5px;">
                    <i class="fa fa-remove"></i> Cancelar
                  </button>
                </div>
              </div>
            </div>
            <!-- /.box-footer-->
          </div>
          <!-- /.box -->


                <div class="box box-success">
                  <div class="box-header with-border">
                    <h3 class="box-title">Detalles</h3>
                    <div class="box-tools pull-right">
                     
                    </div><!-- /.box-tools -->
                  </div><!-- /.box-header -->
                  <div class="box-body">
                      <!-- Date -->
                          <div class="form-group">
                              
                              <div class="col-md-6">
                              <label>Fecha de Vigencia:</label>
                                  <div class="input-group date">
                                      <div class="input-group-addon">
                                          <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" class="form-control" id="datepicker1" disabled>
                                  </div>
                              </div>
                                                         
                              <div class="col-md-6">
                                <label>Fecha de Inicio:</label>
                                  <div class="input-group date">
                                      <div class="input-group-addon">
                                          <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" class="form-control" id="datepicker2" disabled>
                                  </div>
                              </div>
                              <!-- /.input group -->
                          </div><br><br><br>
                

                          <table id="reportedirectiva" class="table table-bordered table-hover">
                              <thead>
                              <tr>
                                  <th style="width: 110px;">ID</th>
                                  <th>UNIDAD TRIBUTARIA</th>
                                  <!--<th>Cédula</th>
                                  <th>Benficiario</th>-->
                                  <th >GRADO</th>
                                  <th>SUELDO BASE</th>
                                  
                                  <th>AÑOS R.</th>
                                  
                                  
                                  
                                  
                              </tr>
                              </thead>
                              <tbody>
                              </tbody>

                          </table>

                  </div><!-- /.box-body -->
                </div><!-- /.box -->


  







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
    <script src="<?php echo base_url()?>application/modules/panel/views/js/directiva.js"></script>
  </body>
</html>








