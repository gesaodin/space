
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
        Blank page
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Asociar Cuenta Bancaria</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
             <p><b>Datos Básicos</b></p>
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
                    <br><br>
                    <div class="col-md-2">
                        N° Ceunta:
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="Número de Cuenta">                
                    </div>
                    <div class="col-md-12">
              
                    </div>
                    <br><br>
                    <div class="col-md-2">
                        Apellidos:
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="Apellidos">                
                    </div>
                      <div class="col-md-2">
                        Nombres:
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="Nombres">                
                    </div>
                    <br><br>
                    <div class="col-md-2">
                        Componentes:
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="Componentes">                
                    </div>
                      <div class="col-md-2">
                        Grado:
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="Grado">                
                    </div>
                   
          </div>
        <!-- /.box-body
        <div class="box-footer">
          Footer
        </div> -->
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