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
            Registrar Finiquito
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Principal</a></li>
            
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box  box-solid box-primary">
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
                    <div class="col-md-8">                      
                      <input type="text" class="form-control" placeholder="Cédula de Identidad" id='id' onblur="consultar()"></input>
                    </div>
                  </div> <!-- /Cedula -->
                  <div class="form-group">
                    <label class="col-md-2" >Cuenta</label>
                    <div class="col-md-8">                      
                      <input type="text" class="form-control" placeholder="Número de Cuenta" id="numero_cuenta"></input>
                    </div> 
                  </div> <!-- /Numero Cuenta -->

                  <div class="form-group">
                    <label class="col-md-2">Nombres</label>
                    <div class="col-md-2">                      
                      <input type="text" placeholder="Nombre"  id='nombres' class="form-control"></input>
                    </div> 
                    <label class="col-md-2">Apellidos</label>
                    <div class="col-md-2">                      
                      <input type="text" placeholder="Apellido"  id='apellidos' class="form-control"></input>
                    </div> 
                    <label class="col-md-2">Sexo</label>
                    <div class="col-md-2">                      
                      <input type="text" placeholder="Sexo"  id='sexo' class="form-control"></input>
                    </div> 
                  </div> <!-- /Numero Cuenta -->

                  <div class="form-group">
                    <label class="col-md-2">Componente</label>
                    <div class="col-md-2">                      
                      <input type="text" placeholder="Componente"  id='componente' class="form-control"></input>
                    </div> 
                    <label class="col-md-2">Grado</label>
                    <div class="col-md-2">                      
                      <input type="text" placeholder="Grado"  id='grado' class="form-control"></input>
                    </div> 
                    <label class="col-md-2">Estatus</label>
                    <div class="col-md-2">                      
                      <input type="text" placeholder="Estatus"  id='estatus' class="form-control"></input>
                    </div> 
                  </div> <!-- /Numero Cuenta -->

                  <div class="form-group">
                    <label class="col-md-2">Fecha Ingreso</label>
                    <div class="col-md-2">                      
                      <input type="text" placeholder="Fecha de Ingreso" id='fingreso' class="form-control"></input>
                    </div> 
                    <label class="col-md-2">Tiempo Servicio</label>
                    <div class="col-md-2">                      
                      <input type="text" placeholder="Tiempo servicio" id='tservicio' class="form-control" value="0,00"></input>
                    </div> 
                    <label class="col-md-2">No. Hijos</label>
                    <div class="col-md-2">                      
                      <input type="text" placeholder="No. Hijos" id='nhijos' class="form-control"></input>
                    </div> 
                  </div> <!-- /Numero Cuenta -->


                  <div class="form-group">
                    <label class="col-md-2">Ultimo Ascenso</label>
                    <div class="col-md-2">                      
                      <input type="text" placeholder="Ultimo Ascenso" id='fuascenso' class="form-control"></input>
                    </div> 
                    <label class="col-md-2">No. Ascenso</label>
                    <div class="col-md-2">                      
                      <input type="text" placeholder="No. Ascenso" id='noascenso' class="form-control"></input>
                    </div> 
                    <label class="col-md-2">St. Prof.</label>
                    <div class="col-md-2">                      
                      <input type="text" placeholder="St. Prof" id='profesionalizacion' class="form-control"></input>
                    </div> 
                  </div> <!-- /Numero Cuenta -->

                  <div class="form-group">
                    <label class="col-md-2">Años Recon.</label>
                    <div class="col-md-2">                      
                      <input type="text" placeholder="Ultimo Ascenso" id='arec' class="form-control"></input>
                    </div> 
                    <label class="col-md-2">Meses Recon.</label>
                    <div class="col-md-2">                      
                      <input type="text" placeholder="No. Ascenso" id='mrec' class="form-control"></input>
                    </div> 
                    <label class="col-md-2">Días Recon.</label>
                    <div class="col-md-2">                      
                      <input type="text" placeholder="Días Reconocidos" id='drec' class="form-control"></input>
                    </div> 
                  </div> 

                  <div class="form-group">
                    <label class="col-md-2">Fecha de Retiro</label>
                    <div class="col-md-2">                      
                      <input type="text" placeholder="Fecha de Retiro" id='fecha_retiro' class="form-control"></input>
                    </div> 
                  </div> <!-- /Numero Cuenta -->


                </div>
              </form>
            </div><!-- /.box-body -->
            <div class="box-footer">
              <!-- <a href="#!" onclick="imprimir()" 
              class="btn btn-primary" target="_top"><i class="fa fa-print"></i> Imprimir Hoja de Vida (PRINT)</a>
            --> </div>
            <!-- /.box-footer-->
          </div><!-- /.box -->

          <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Datos Finiquito</h3>
            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box-tools -->
          </div><!-- /.box-header -->
          <div class="box-body">
            
              <div class="form-group">
                <label class="col-md-2">Motivo Finiquito</label>
                <div class="col-md-10">                    
                  <select aria-hidden="true" id="motivo_finiquito" tabindex="1" class="form-control select2 select2-hidden-accessible"
                  onchange="seleccionarMotivo()" 
                   style="width: 100%;">
                      <option selected="selected">Seleccioné un motivo</option>
                      <?php 
                        foreach ($Motivo as $k => $v) {
                          echo '<option value="' . $v['id'] . '">' . $v['desc'] . '</option>';
                        }
                      ?>
                  </select>
              
                </div> 
              </div>
            <br><br>
              <div class="form-group">
                <label class="col-md-2">Fecha Retiro</label>
                <div class="col-md-4"> 
                  <div class="input-group date ">
                      <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                      </div>
                      <input class="form-control" id="datepicker" type="text">
                      <span class="input-group-btn">
                        <button type="button" class="btn btn-success btn-flat" onclick="consultarBeneficiarioFecha()"><i class="fa fa-calculator"></i></button>
                      </span>
                  </div>
                </div>

                <label class="col-md-2">Directiva</label>
                <div class="col-md-4">                      
                      <input type="text" placeholder="Descripcion de Directiva" id='directiva' class="form-control"></input>
                </div> 
                </div> <!-- /Numero Cuenta -->
              

          </div><!-- /.box-body -->
        </div><!-- /.box -->
          

          
       <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Datos de Asignaciones</h3>
            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box-tools -->
          </div><!-- /.box-header -->
          <div class="box-body">
            
            <div class="row">
              <div class="form-group">
                <label class="col-md-2">A.A Generada</label>
                <div class="col-md-4">                       
                      <input type="text" placeholder="Asingación Generada" id='asignacion_antiguedad' class="form-control"></input>
                </div>
                <label class="col-md-2">A.A Depositado</label>
                <div class="col-md-4">                      
                      <input type="text" placeholder="Asignación Depositada" id='asignacion_depositada' class="form-control"></input>
                </div> 
                </div> <!-- form-group -->
            </div> <!-- row -->
            <br>
            <div class="row">
              <div class="form-group">
                <label class="col-md-2">Anticipos</label>
                <div class="col-md-4">                       
                      <input type="text" placeholder="Asingación Generada" id='anticipos' class="form-control"></input>
                </div>
                <label class="col-md-2">Embargo</label>
                <div class="col-md-4">                      
                      <input type="text" placeholder="Asignación Depositada" id='embargos' class="form-control"></input>
                </div> 
              </div> <!-- form-group -->
            </div> <!-- row -->
            <br>
            <div class="row">
              <div class="form-group">
                <label class="col-md-2">Comisión Servicios</label>
                <div class="col-md-4">                       
                      <input type="text" placeholder="Comisión de Servicios" id='comision_servicios' class="form-control"></input>
                </div>
                <label class="col-md-2">Monto a Recuperar</label>
                <div class="col-md-4">                      
                      <input type="text" placeholder="Monto a Recuperar" id='monto_recuperar' class="form-control"></input>
                </div> 
                </div> <!-- form-group -->
            </div> <!-- row -->
            <br>
            <div class="row">
              <div class="form-group">
                <label class="col-md-2">A.A Diferencia</label>
                <div class="col-md-4">                       
                      <input type="text" placeholder="Asingación Generada" id='asignacion_diferencia' class="form-control"></input>
                      <input type="hidden" placeholder="Asingación Generada" id='asignacion_diferencia_aux' class="form-control"></input>
                </div>
              </div> <!-- form-group -->
            </div> <!-- row -->

          </div><!-- /.box-body -->
        </div><!-- /.box -->




        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Otros Datos</h3>
            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box-tools -->
          </div><!-- /.box-header -->
          <div class="box-body">

            <div class="row">
              <div class="form-group">
                <label class="col-md-2">Deuda</label>
                <div class="col-md-4"> 
                   
                   <div class="input-group">
                    <input class="form-control" type="text" placeholder="Moto Por Deuda" id='deuda'>
                      <span class="input-group-btn">
                        <button type="button" class="btn btn-success btn-flat" onclick="CalcularDeuda()"><i class="fa fa-calculator"></i></button>
                      </span> 
                    </div>
                   <!-- <input type="text" placeholder="Moto Por Deuda" id='deuda' class="form-control"></input> -->
                </div>

                <label class="col-md-2">A. X Intereses Cap.</label>
                <div class="col-md-4">                      
                      <input type="text" placeholder="Intereses Capitalizados" id='directiva' class="form-control"></input>
                </div> 
                </div> <!-- /Numero Cuenta -->
            </div>
            <br>

            <div class="row">
              <div class="form-group">
                <label class="col-md-2">Total en Banco</label>
                <div class="col-md-4"> 
                   <input type="text" placeholder="Total en Banco" id='total_banco' class="form-control"></input>
                   <input type="hidden"  id='total_banco_calc' class="form-control"></input>
                   <input type="hidden"  id='total_banco_aux' class="form-control"></input>
                </div>

                <label class="col-md-2">Partida Presupuestaria</label>
                <div class="col-md-4">                      
                                     
                    <select aria-hidden="true" id="partida" tabindex="1" class="form-control select2 select2-hidden-accessible" style="width: 100%;" onchange="seleccionarPartida()">
                        <option selected="selected">Seleccioné Una Partida</option>
                        <?php 
                        foreach ($Partida as $k => $v) {
                          echo '<option value="' . $v['id'] . '">' . $v['desc'] . '</option>';
                        }
                      ?>
                    </select>
                
                </div> 
                </div> <!-- /Numero Cuenta -->
            </div>
            <br>

            <div class="row">
              <div class="form-group">
                <label class="col-md-2">Proyecto</label>
                <div class="col-md-4"> 
                   <input type="text" placeholder="Proyecto" id='proyecto' class="form-control"></input>
                </div>

                <label class="col-md-2">Unidad Ejecutora</label>
                <div class="col-md-4">                      
                                     
                   <input type="text" placeholder="Unidad Ejecutora" id='codigo_unidad_ejecutora' class="form-control"></input>
                
                </div> 
                </div> <!-- /Numero Cuenta -->
            </div>
            <br>

            <div class="row">
              <div class="form-group">
                
                <div class="col-md-12"> 
                   <div id="tblFamiliares">
                     
                   </div>
                </div>

                
                </div> <!-- /Numero Cuenta -->
            </div>
            <br>

            <div class="row">
              <div class="form-group">
                <label class="col-md-2">Notas</label>
                <div class="col-md-10"> 
                   <textarea class="form-control" rows="5" placeholder="Observaciones ..."></textarea>
                </div>

                
                </div> <!-- /Numero Cuenta -->
            </div>

          </div><!-- /.box-body -->
          <div class="box-footer"><center>

              <a href="#!" onclick="imprimir()" 
              class="btn btn-success" target="_top"><i class="glyphicon glyphicon-download-alt"></i> Guardar Finiquito</a>
              <a href="#!" onclick="imprimir()" 
              class="btn btn-danger" target="_top"><i class="glyphicon glyphicon-remove"></i> Cancelar Finiquito</a>
              </center>

            </div><!-- /.box-footer-->
        </div><!-- /.box -->





        <!-- Modal -->
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
            
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Agregar Familiar</h4>
                </div>
                <div class="modal-body">
                  
                  <div class="form-group">
                    <label class="col-md-2">Cedula</label>
                    <div class="col-md-10"> 
                      <input class="form-control" type="text" placeholder="Cedula de Identidad" id='fcedula'>
                    </div>    
                  </div> <!-- Fin Form -->
                  <br>

                  <div class="form-group">
                    <label class="col-md-2">Apellidos</label>
                    <div class="col-md-4"> 
                      <input class="form-control" type="text" placeholder="Apellidos" id='fapellidos'>
                    </div>
                    <label class="col-md-2">Nombres</label>
                    <div class="col-md-4"> 
                      <input class="form-control" type="text" placeholder="Nombres" id='fnombres'>
                    </div>
                  </div> <!-- Fin Form -->
                  <br>

                  <div class="form-group">
                    <label class="col-md-2">Parentesco</label>
                    <div class="col-md-4"> 
                      <input class="form-control" type="text" placeholder="Parentesco" id='fparentesco'>
                    </div>
                    <label class="col-md-2">Edad</label>
                    <div class="col-md-4"> 
                      <input class="form-control" type="text" placeholder="Edad" id='fedad'>
                    </div>
                  </div> <!-- Fin Form -->
                  <br>    
                  
                  <div class="form-group">
                    <label class="col-md-2">Estado</label>
                    <div class="col-md-4"> 
                      <input class="form-control" type="text" placeholder="Estado" id='festado'>
                    </div>
                    
                  </div> <!-- Fin Form -->
                  <br>   

                </div>
                <div class="box-footer">
                <div class="col-xs-6">
            
                  <button type="button" class="btn btn-success pull-right"><i class="glyphicon glyphicon-ok"></i> Aceptar
                  </button>
                  </div>
                  <div class="col-xs-6">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">
                    <i class="glyphicon glyphicon-remove"></i> Cancelar
                  </button>
                </div>
                  
                </div>
              </div>
              
            </div>
          </div>
          </div>

          <!-- Fin del Model -->


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
    <script src="<?php echo base_url()?>application/modules/panel/views/js/registrar_finiquito.js"></script>
  </body>
</html>