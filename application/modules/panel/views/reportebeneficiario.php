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
                Reporte de beneficiario
                <small>Listado</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Beneficiario</a></li>
                <li><a href="#">Reporte</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Lista de Beneficiarios</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                        <p><b>Datos a consultar</b></p>
                        <div class="col-md-2">
                            C.I:
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Cedula de Identidad">
                        </div>
                    <div class="col-md-2">
                        Apellido:
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="Apellido">
                    </div>
                    <br><br>
                    <div class="col-md-2">
                        Nombre
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="Nombre">
                    </div>
                    <div class="col-md-2">
                        Situación:
                    </div>
                    <div class="col-md-4">
                        <select class="form-control select2" style="width: 100%;">
                            <option selected="selected">Todos</option>
                            <option>1</option>
                        </select>
                    </div>
                    <br><br>
                    <div class="col-md-2">
                        Componentes:
                    </div>
                    <div class="col-md-4">
                        <select class="form-control select2" style="width: 100%;">
                            <option selected="selected">Todos</option>
                            <option>1</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        Grado:
                    </div>
                    <div class="col-md-4">
                        <select class="form-control select2" style="width: 100%;">
                            <option selected="selected">Todos</option>
                            <option>1</option>
                        </select>
                    </div>
                    <br><br>
                    <p><b>Fecha de Ingreso</b></p>
                    <!-- Date -->
                    <div class="form-group">
                        <div class="col-md-2">
                            Desde:
                        </div>
                        <div class="col-md-4">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control" id="datepicker">
                            </div>
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                    <div class="form-group">
                        <div class="col-md-2">
                         Hasta:
                        </div>
                        <div class="col-md-4">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control" id="datepicker1">
                            </div>
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                    <br><br>
                    <div class="col-md-2">
                     Ordenado por:
                    </div>
                    <div class="col-md-4">
                        <select class="form-control select2" style="width: 100%;">
                            <option selected="selected">Todos</option>
                            <option>1</option>
                        </select>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                   <div class="row no-print">
        <div class="col-xs-6">
    
          <button type="button" class="btn btn-success pull-right"><i class="fa fa-info-circle"></i> Consultar
          </button>
          </div>
          <div class="col-xs-6">
          <button type="button" class="btn" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Exportar PDF
          </button>
        </div>
      </div>
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->

            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Resultados</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fa fa-minus"></i></button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                                    <i class="fa fa-times"></i></button>
                            </div>
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Cédula</th>
                                    <th>Grado</th>
                                    <th>Componente</th>
                                    <th>Beneficiario</th>
                                    <th>Cuenta</th>
                                    <th>Asig. Ant.</th>
                                    <th>Fecha de Ingreso</th>
                                    <th>Situación</th>
                                    <th>Operacions</th>
                                </tr>
                                </thead>
                              

                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                    </div>
                    </div>
                    
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