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
          Reporte de Auditoria
          <small>.</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Administracion</a></li>
          <li><a href="#">Auditoria</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Ordenes de Pago</h3>
               <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
          </div>
          
              <div class="box-body">
               <p><b>Generar Ordenes de Pago</b></p>
                      <div class="col-md-2">
                          C.I:
                      </div>
                      <div class="col-md-4">
                          <input type="text" class="form-control" placeholder="Cedula de Identidad">
                          
                      </div>
                      <div class="form-group">
                    <div class="col-md-2">
                      Objeto:
                    </div>
                    <div class="col-md-4">
                      <select class="form-control select2" style="width: 100%;">
                        <option selected="selected">Beneficiario</option>
                        <option>1</option>
                      </select>
                    </div>
                    <!-- /.input group -->
                  </div>
                      <br>
            </div>
            </div>

            <div class="box-footer">
                 <div class="row no-print">
                  <div class="col-xs-6">

                    <button type="button" class="btn btn-success pull-right"><i class="fa fa-info"></i> Consultar
                    </button>
                  </div>
                  <div class="col-xs-6">
                    <button type="button" class="btn btn-sucess" style="margin-right: 5px;">
                      <i class="fa fa-file-archive-o"></i> Exportar a Archivo
                    </button>
                  </div>
                </div>
              </div>
              <!-- /.box-footer-->
          <!-- /.box-body -->
          <div class="box-footer">
           <!-- /.box-header -->
                          <div class="box-body">
                          <p><b>Situación Actual</b></p>
                              <table id="example2" class="table table-bordered table-hover">
                                  <thead>
                                  <tr>
                                      <th>Nombre</th>
                                      <th>Comp</th>
                                      <th>Grado</th>
                                      <th>F. de Ingreso</th>
                                      <th>St. No Asc</th>
                                      <th>Num de Hijos</th>
                                      <Th>F. Ult. Asc.</Th>
                                      <th>Anios Rec.</th>
                                      <th>Meses Rec.</th>
                                      <th>Dias Rec.</th>
                                      <th>F. Ing Flde.</th>
                                      <th>Usuario C.</th>
                                      <th>Fecha C.</th>
                                      <th>Usuario M.</th>
                                      <th>Fecha M.</th>
                                  </tr>
                                  </thead>
                                  <tbody>

                              </table>
                          </div>
          </div>
          <div class="box-footer">
           <!-- /.box-header -->
                          <div class="box-body">
                          <p><b>Resultados</b></p>
                              <table id="example2" class="table table-bordered table-hover">
                                  <thead>
                                  <tr>
                                      <th>Nombre</th>
                                      <th>Comp</th>
                                      <th>Grado</th>
                                      <th>F. de Ingreso</th>
                                      <th>St. No Asc</th>
                                      <th>Num de Hijos</th>
                                      <Th>F. Ult. Asc.</Th>
                                      <th>Anios Rec.</th>
                                      <th>Meses Rec.</th>
                                      <th>Dias Rec.</th>
                                      <th>F. Ing Flde.</th>
                                      <th>Usuario C.</th>
                                      <th>Fecha C.</th>
                                      <th>Usuario M.</th>
                                      <th>Fecha M.</th>
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