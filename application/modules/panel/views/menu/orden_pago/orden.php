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
        Ordenes de Pago
        <small>.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Orden de Pago</a></li>
        <li><a href="#">Crear</a></li>
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
                                    <th>Operaciones</th>
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