<!DOCTYPE html>
<html>
  <?php $this->load->view('inc/cabecera.php');?>
  
    <!-- Site wrapper -->
    <div class="wrapper">

      <?php $this->load->view('inc/top.php');?>

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <section class="content-header">
          <h1>
            Pago de Aportes
            <small>Garantias, Dias Adicionales y Asignación de Antiguedad.</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Calculos</a></li>
            <li><a href="#">Pago de Aportes</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Depositos Bancarios</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" onclick="principal()" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                 

                <div class="form-group">
                  <div class="col-md-12">
                    <table id="reportearchivos" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th style="width: 120px;">Llave del Archivo</th>                            
                            <th style="width: 60px;">Registros</th>
                            
                            <th style="width: 120px;">Fecha</th>                            
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->


              </div>
              <!-- /.box-body 
              <div class="box-footer">
              
               
  
            </div>
            /.box-footer-->
          </div>
          <!-- /.box -->


          <!-- /.box -->
        </div>
      </div>

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
  </body>
</html>