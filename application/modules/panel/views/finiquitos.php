<!DOCTYPE html>
<html>
  <?php $this->load->view('inc/cabecera.php');?>
    <!-- Site wrapper -->
    <div class="wrapper">

      <?php $this->load->view('inc/top.php');?>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo base_url()?>system/img/pace.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>Prestaciones</p>
              <a href="#"><i class="fa fa-circle text-success"></i> En Linea</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Consultar...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <?php $this->load->view('inc/menu.php')?>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
                <h1>
                  Finiquitos
                  <small>.</small>
                </h1>
                <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Beneficiario</a></li>
                  <li><a href="#">Finiquitos</a></li>
                </ol>
              </section>

              <!-- Main content -->
              <section class="content">

                <!-- Default box -->
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Finiquito</h3>
                       <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                      <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                  </div>
                  
                      <div class="box-body">
                       <p><b>Registrar Finiquitos</b></p>
                              <div class="col-md-2">
                                  C.I:
                              </div>
                              <div class="col-md-4">
                                  <input type="text" class="form-control" placeholder="Cedula de Identidad">
                                  
                              </div>
                              <div class="col-md-6">
                          <button type="button" class="btn btn-success pull-midium"><i class="fa fa-check"></i> Consultar
                    </button>
                          </a>
                              </div>
                              <br>
                    </div>
                    </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                   <!-- /.box-header -->
                                  <div class="box-body">
                                      <table id="example2" class="table table-bordered table-hover">
                                          <thead>
                                          <tr>
                                              <th>Fecha de Creación</th>
                                              <th>Cédula</th>
                                              <th>Benficiario</th>
                                              <th>Componente</th>
                                              <th>Grado</th>
                                              <th>T. Servicio</th>
                                              <th>Total Finiquito (BsF.) </th>
                                              <th>Motivo</th>
                                              <th>Estatus de Beneficiario</th>
                                              <th>_________</th>
                                          </tr>
                                          </thead>
                                          <tbody>

                                      </table>
                                  </div>
                  </div>
                  <!-- /.box-footer-->
                </div>
                <!-- /.box -->

              </section>

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