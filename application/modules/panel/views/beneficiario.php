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
            Hoja de Vida
            <small>Panel principal de SPACE</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Principal</a></li>
            
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
                    <div class="col-md-8">                      
                      <input type="text" class="form-control" placeholder="Cédula de Identidad" id='id' onblur="consultar()"></input>
                    </div>
                  </div> <!-- /Cedula -->
                  <div class="form-group">
                    <label class="col-md-2" >Cuenta</label>
                    <div class="col-md-8">                      
                      <input type="text" class="form-control" placeholder="Número de Cuenta"></input>
                    </div> 
                  </div> <!-- /Numero Cuenta -->

                  <div class="form-group">
                    <label class="col-md-2">Nombre</label>
                    <div class="col-md-2">                      
                      <input type="text" placeholder="Nombre"  id='nombres' class="form-control"></input>
                    </div> 
                    <label class="col-md-2">Apellido</label>
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
                      <input type="text" placeholder="Tiempo servicio" id='tservicio' class="form-control"></input>
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
                    <label class="col-md-2">Años Reconocidos</label>
                    <div class="col-md-2">                      
                      <input type="text" placeholder="Ultimo Ascenso" id='arec' class="form-control"></input>
                    </div> 
                    <label class="col-md-2">Mes Reconocidos</label>
                    <div class="col-md-2">                      
                      <input type="text" placeholder="No. Ascenso" id='mrec' class="form-control"></input>
                    </div> 
                    <label class="col-md-2">Días Reconocidos</label>
                    <div class="col-md-2">                      
                      <input type="text" placeholder="Días Reconocidos" id='drec' class="form-control"></input>
                    </div> 
                  </div> <!-- /Numero Cuenta -->


                </div>
              </form>
            </div><!-- /.box-body -->
            <div class="box-footer">
              <input type="button" class="btn btn-success" value="Salvar"></input>
            </div><!-- /.box-footer-->
          </div><!-- /.box -->

          <div class="box-body">
            <div class="col-md-12">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">Datos Sueldo</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Datos Asignación Antiguedad</a></li>

                  <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="col-md-2">Sueldo Base</label>
                          <div class="col-md-2">                      
                            <input type="text" placeholder="Sueldo Base" id="sueldo_base" class="form-control"></input>
                          </div> 
                          <label class="col-md-2">Sueldo Global</label>
                          <div class="col-md-2">                      
                            <input type="text" placeholder="Sueldo Global" id="sueldo_global" class="form-control"></input>
                          </div> 
                          <label class="col-md-2">Sueldo Integral</label>
                          <div class="col-md-2">                      
                            <input type="text" placeholder="Sueldo Integral" id="sueldo_integral" class="form-control"></input>
                          </div> 
                        </div> <!-- /Numero Cuenta -->
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="col-md-2">Fin Año</label>
                          <div class="col-md-2">                      
                            <input type="text" placeholder="Ali. Bono Fin de Año" id="fano" class="form-control"></input>
                          </div> 
                          <label class="col-md-2">Bono Vacacional</label>
                          <div class="col-md-2">                      
                            <input type="text" placeholder="Bono Vacacional" id="vacaciones" class="form-control"></input>
                          </div>                           
                        </div> <!-- /Numero Cuenta -->
                      </div>
                    </div>

                    <br>

                    <h4>Primas</h4>
                    <hr>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="col-md-2">Transporte</label>  
                          <div class="col-md-2">
                            <input type="text" placeholder="Transporte" id ="P_TRANSPORTE" class="form-control"></input>                          
                          </div>

                          <label class="col-md-2">Descendencia</label>  
                          <div class="col-md-2">
                            <input type="text" placeholder="Descendencia" id ="P_DESCENDECIA" class="form-control"></input>                          
                          </div>

                          <label class="col-md-2">Especial</label>  
                          <div class="col-md-2">
                            <input type="text" placeholder="Especial" id ="PE" class="form-control" id="P_ESPECIAL"></input>                          
                          </div>

                        </div>

                      </div>
                    </div>
                    <br>



                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="col-md-2">Años Servicio</label>  
                          <div class="col-md-2">
                            <input type="text" placeholder="Años Servicio" class="form-control" id="P_TIEMPOSERVICIO"></input>                          
                          </div>

                          <label class="col-md-2">No Ascenso</label>  
                          <div class="col-md-2">
                            <input type="text" placeholder="No Ascenso" class="form-control" id="P_NOASCENSO"></input>                          
                          </div>

                          <label class="col-md-2">Profesionalización</label>  
                          <div class="col-md-2">
                            <input type="text" placeholder="Profesionalización" class="form-control" id="P_PROFESIONALIZACION"></input>                          
                          </div>

                        </div>

                      </div>
                    </div>
                    <br>

                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group" id="DivDetalla">

                        </div>

                      </div>
                    </div>


                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                    <h4>Asignación de Antiguedad</h4>
                    <hr>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="col-md-2">A. de Antiguedad</label>
                          <div class="col-md-2">                      
                            <input type="text" placeholder="Asignación de Antiguedad" id='aantiguedad' class="form-control"></input>
                          </div> 
                          <label class="col-md-2">Capital En Banco.</label>
                          <div class="col-md-2">                      
                            <input type="text" placeholder="Capital en Banco" id='Deposito en Banco' class="form-control"></input>
                          </div> 
                          <label class="col-md-2">Garantías</label>
                          <div class="col-md-2">                      
                            <input type="text" placeholder="Garantías" id='grantias' class="form-control"></input>
                          </div> 
                        </div> <!-- /Numero Cuenta -->

                        <br>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">

                              <label class="col-md-2">Días Adicionales.</label>
                              <div class="col-md-2">                      
                                <input type="text" placeholder="Días Adicionales" id='diasadicionales' class="form-control"></input>
                              </div> 
                              <label class="col-md-2">Total Aportado</label>
                              <div class="col-md-2">                      
                                <input type="text" placeholder="Total Aportado" id='totalaportado' class="form-control"></input>
                              </div> 
                              <label class="col-md-2">Saldo Disponible</label>
                              <div class="col-md-2">                      
                                <input type="text" placeholder="Saldo Disponible" id='saldodisponible' class="form-control"></input>
                              </div> 
                            </div> <!-- /Numero Cuenta -->
                            <br>
                            <div class="form-group">
                              <label class="col-md-2">Fecha Ultimo Dep.</label>
                              <div class="col-md-2">                      
                                <input type="text" placeholder="Ultimo Deposito" id='udeposito' class="form-control"></input>
                              </div> 
                              <label class="col-md-2">% Cancelado.</label>
                              <div class="col-md-2">                      
                                <input type="text" placeholder="% Cancelado" id='cancelado' class="form-control"></input>
                              </div> 
                              <label class="col-md-2">Embargo</label>
                              <div class="col-md-2">                      
                                <input type="text" placeholder="Embargo" id='Embargo' class="form-control"></input>
                              </div> 

                            </div> <!-- /Numero Cuenta -->

                            <br>
                            <div class="form-group">
                              <label class="col-md-2">Anticipos.</label>
                              <div class="col-md-2">                      
                                <input type="text" placeholder="anticipos" id='anticipos' class="form-control"></input>
                              </div> 
                              <label class="col-md-2">Fecha Ultimo Anticipo</label>
                              <div class="col-md-2">                      
                                <input type="text" placeholder="Ultimo Anticipo" id='ultimoanticipos' class="form-control"></input>
                              </div> 
                              <label class="col-md-2">Comisión de S.</label>
                              <div class="col-md-2">                      
                                <input type="text" placeholder="Comisión de Servicio" id='comisionservicio' class="form-control">
                                  
                                </input>
                              </div> 

                            </div> <!-- /Numero Cuenta -->


                            <br>
                            <h4>Intereses Caidos</h4>
                            <hr>


                            <br>
                            <div class="form-group">
                              <label class="col-md-2">Total Calculados.</label>
                              <div class="col-md-2">                      
                                <input type="text" placeholder="Total Calculados" id='tcalculados' class="form-control"></input>
                              </div> 
                              <label class="col-md-2">Total Cancelados</label>
                              <div class="col-md-2">                      
                                <input type="text" placeholder="Total Cancelados" id='tcancelados' class="form-control"></input>
                              </div> 
                              <label class="col-md-2">Total Adeudado</label>
                              <div class="col-md-2">                      
                                <input type="text" placeholder="Total Adeudado" id='tacumulado' class="form-control"></input>
                              </div> 
                            </div> <!-- /Numero Cuenta -->

                            <br>
                            <div class="form-group">
                              <label class="col-md-2">Fecha Ultimo Deposito</label>
                              <div class="col-md-2">                      
                                <input type="text" placeholder="anticipos" id='ifudep' class="form-control"></input>
                              </div> 
                              <label class="col-md-2">Embargo</label>
                              <div class="col-md-2">                      
                                <input type="text" placeholder="Embargo" id='iembargo' class="form-control"></input>
                              </div> 

                            </div> <!-- /Numero Cuenta -->

                            <br>
                            <h4>Otros</h4>
                            <hr>

                          </div>
                        </div>

                      </div>
                      <!-- /.tab-pane -->               
                    </div>
                    <!-- /.tab-content -->
                  </div>

                </div>
              </div>
            </div>
          </div>
          

          



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
  </body>
</html>