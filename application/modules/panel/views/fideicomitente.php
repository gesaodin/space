
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
                Beneficiarios
                <small>Carga de fideicomientes</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Beneficiarios</a></li>
                <li><a href="#">Carga de fideicomientes</a></li>
                <!--<li class="active">Blank page</li>-->
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Carga de fideicomientes</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <b><p>Seleccione archivos</p></b>


                        <div class="col-md-4">
                      Tipo de Archivo:
                            </div>
                        <div class="col-md-4">
                             <div class="radio">
                    <label>
                      <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                      Nuevos Fideicomitentes
                    </label>
                  </div>
                            </div>
                        <div class="col-md-4">
                        <div class="radio">
                    <label>
                      <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                      Actualización Fideicomitentes
                    </label>
                  </div>
                            </div>
<br><br>

                        <div class="col-md-4">
                            Tipo de Reporte:
                        </div>
                        <div class="col-md-4">
                            <div class="radio">
                    <label>
                      <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                     Reporte de Comparación SAMAN
                    </label>
                  </div>
                        </div>
                        <div class="col-md-4">
                             <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                     Reporte de Comparación PACE
                        </div>
                        <div class="col-md-12">
<form action="#" method="post">

              <div class="form-group">
                <label for="exampleInputFile">Archivo Nuevos Beneficiarios:</label>
                <input type="file" id="exampleInputFile">
              </div>

            <center></center><button type="button" class="btn btn-info btn-flat">Enviar</button>

                 
          <button type="button" class="btn btn-danger pull-right"><i class="fa fa-file-text"></i> Ver el Registro de Errores  
          </button>
          </form>
          </div>
                </div>
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


























