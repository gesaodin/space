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

        <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Anticipo
        <small>.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Beneficiario</a></li>
        <li><a href="#">Anticipo</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

          <!-- Default box -->
          <div class="box ">
            <div class="box-header with-border">
              <h3 class="box-title">Datos Basicos</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Cerrar"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <form class="form-horizontal" >
                <div class="box-body">
                  <div class="form-group">
                    <label class="col-md-2">C.I.</label>
                    <div class="col-md-2">                      
                      <input type="text" class="form-control" placeholder="Cédula de Identidad" id='id' onblur="consultar()"></input>
                    </div>
                  </div> <!-- /Cedula -->
                  <div class="form-group">
                    <label class="col-md-2">Cuenta</label>
                    <div class="col-md-2">                      
                      <input type="text" class="form-control" placeholder="Número de Cuenta"></input>
                    </div> 
                  </div> <!-- /Numero Cuenta -->

                  <div class="form-group">
                    <label class="col-md-2">Nombre</label>
                    <div class="col-md-2">                      
                      <input type="text" class="form-control" placeholder="Nombre"  id='nombres'></input>
                    </div> 
                    <label class="col-md-2">Apellido</label>
                    <div class="col-md-2">                      
                      <input type="text" class="form-control" placeholder="Apellido"  id='apellidos'></input>
                    </div> 
                    <label class="col-md-2">Sexo</label>
                    <div class="col-md-2">                      
                      <input type="text" class="form-control" placeholder="Sexo"  id='sexo'></input>
                    </div> 
                  </div> <!-- /Numero Cuenta -->

                  <div class="form-group">
                    <label class="col-md-2">Componente</label>
                    <div class="col-md-2">                      
                      <input type="text" class="form-control" placeholder="Componente"  id='componente'></input>
                    </div> 
                    <label class="col-md-2">Grado</label>
                    <div class="col-md-2">                      
                      <input type="text" class="form-control" placeholder="Grado"  id='grado'></input>
                    </div> 
                    <label class="col-md-2">Estatus</label>
                    <div class="col-md-2">                      
                      <input type="text" class="form-control" placeholder="Estatus"  id='estatus'></input>
                    </div> 
                  </div> <!-- /Numero Cuenta -->

                  <div class="form-group">
                    <label class="col-md-2">Fecha Ingreso</label>
                    <div class="col-md-2">                      
                      <input type="text" class="form-control" placeholder="Fecha de Ingreso" id='fingreso'></input>
                    </div> 
                    <label class="col-md-2">Tiempo Servicio</label>
                    <div class="col-md-2">                      
                      <input type="text" class="form-control" placeholder="Tiempo servicio" id='tservicio'></input>
                    </div> 
                    <label class="col-md-2">No. Hijos</label>
                    <div class="col-md-2">                      
                      <input type="text" class="form-control" placeholder="No. Hijos" id='nhijos'></input>
                    </div> 
                  </div> <!-- /Numero Cuenta -->


                  <div class="form-group">
                    <label class="col-md-2">Ultimo Ascenso</label>
                    <div class="col-md-2">                      
                      <input type="text" class="form-control" placeholder="Ultimo Ascenso" id='fuascenso'></input>
                    </div> 
                    <label class="col-md-2">No. Ascenso</label>
                    <div class="col-md-2">                      
                      <input type="text" class="form-control" placeholder="No. Ascenso" id='noascenso'></input>
                    </div> 
                    <label class="col-md-2">St. Prof.</label>
                    <div class="col-md-2">                      
                      <input type="text" class="form-control" placeholder="St. Prof" id='profesionalizacion'></input>
                    </div> 
                  </div> <!-- /Numero Cuenta -->

                  <div class="form-group">
                    <label class="col-md-2">Años Reconocidos</label>
                    <div class="col-md-2">                      
                      <input type="text" class="form-control" placeholder="Ultimo Ascenso" id='arec'></input>
                    </div> 
                    <label class="col-md-2">Mes Reconocidos</label>
                    <div class="col-md-2">                      
                      <input type="text" class="form-control" placeholder="No. Ascenso" id='mrec'></input>
                    </div> 
                    <label class="col-md-2">Días Reconocidos</label>
                    <div class="col-md-2">                      
                      <input type="text" class="form-control" placeholder="Días Reconocidos" id='drec'></input>
                    </div> 
                  </div> <!-- /Numero Cuenta -->
                   
                  <hr><b>Lista de anticipos</b></hr>
                  <div class="form-group">
                     <div class="col-md-8">                      
                     <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i>Nuevo anticipo</button>
                     <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nuevo Anticipo</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-4"> <input type="radio" class="pull-right" name="optionsRadios" id="optionsRadios" value="option" checked >
            </div>
            <div class="col-md-4"><input type="text" class="form-control" placeholder="Porcentaje" /></div>
            <div class="col-md-4"><h4>%</h4></div>
          </div>
          <div class="row">
            <div class="col-md-4"> <input type="radio" class="pull-right" name="optionsRadios" id="optionsRadios1" value="option1" checked >
            </div>
            <div class="col-md-4"><input type="text" class="form-control" placeholder="Monto" /></div>
            <div class="col-md-4"><h4>BsF.</h4></div>
          </div>
          <div class="row">
             <div class="col-md-4">
                      <h4>Motivo del anticipo:</h4>
                    </div>
                    <div class="col-md-4">
                      <select class="form-control select2" style="width: 100%;">
                      <option selected="selected">Viajes al exterior:Enfermedad/Tratamiento</option>
                      <option>Gastos por Estudios</option>
                      <option>Adquisición/Mejora Vivienda</option>
                      <option>Liberación de Hipoteca</option>
                    </select>
          </div>
          </div>
          
        </div>
        <div class="box-footer">
        <div class="col-xs-6">
    
          <button type="button" class="btn btn-success pull-right"><i class="glyphicon glyphicon-ok"></i> Aceptar
          </button>
          </div>
          <div class="col-xs-6">
          <button type="button" class="btn btn-danger" data-dismiss="modal">
            <i class="glyphicon glyphicon-remove"></i>Cancelar
          </button>
        </div>
          
        </div>
      </div>
      
    </div>
  </div>

                  </div>

                  <!--<div class="col-md-8">                      
                     

                  </div> -->
              </form>
            </div><!-- /.box-body -->
            <div class="box-footer">
              <div class="row no-print">
        <div class="col-xs-6">
    
          <button type="button" class="btn btn-success pull-right"><i class="glyphicon glyphicon-ok"></i> Aceptar
          </button>
          </div>
          <div class="col-xs-6">
          <button type="button" class="btn btn-danger" style="margin-right: 5px;">
            <i class="glyphicon glyphicon-remove"></i>Cancelar
          </button>
        </div>
            </div><!-- /.box-footer-->
          </div><!-- /.box -->

        </section><!-- /.content -->

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