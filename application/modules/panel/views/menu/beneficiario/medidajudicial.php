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
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Cerrar" onclick="principal()"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              
                   <form class="form-horizontal" >
                <div class="box-body">
                  <div class="form-group">
                    <label class="col-md-2">Cédula</label>
                    <div class="col-md-6"> 

                      <div class="input-group">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-success" onclick="consultar()"><i class="fa fa-search"></i></button>
                        </span> 
                        <input type="text" class="form-control" placeholder="Cédula de Identidad" id='id' onblur="consultar()"></input>                          
                      </div>                  
                      
                    </div>
                  </div> <!-- /Cedula -->
                  <div class="form-group">
                    <label class="col-md-2" >Cuenta</label>
                    <div class="col-md-6">                      
                      
                      <div class="input-group">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-success" id='btnCuenta'><i class="fa fa-bank"></i></button>
                        </span> 
                        <input type="text" class="form-control" placeholder="Número de Cuenta" id="numero_cuenta" readonly="readonly"></input>                          
                      </div>  
                    </div> 
                  </div> <!-- /Numero Cuenta -->

                  <div class="form-group">
                    <label class="col-md-2">Nombres</label>
                    <div class="col-md-2">                      
                      <input type="text" placeholder="Nombre"  id='nombres' class="form-control" readonly="readonly"></input>
                    </div> 
                    <label class="col-md-2">Apellidos</label>
                    <div class="col-md-2">                      
                      <input type="text" placeholder="Apellido"  id='apellidos' class="form-control" readonly="readonly"></input>
                    </div> 
                    <label class="col-md-2">Sexo</label>
                    <div class="col-md-2">                      
                      <input type="text" placeholder="Sexo"  id='sexo' class="form-control" readonly="readonly"></input>
                    </div> 
                  </div> <!-- /Numero Cuenta -->

                  <div class="form-group">
                    <label class="col-md-2">Componente</label>
                    <div class="col-md-2">                      
                      <input type="text" placeholder="Componente"  id='componente' class="form-control" readonly="readonly"></input>
                    </div> 
                    <label class="col-md-2">Grado</label>
                    <div class="col-md-2">                      
                      <input type="text" placeholder="Grado"  id='grado' class="form-control" readonly="readonly"></input>
                    </div> 
                    <label class="col-md-2">Estatus</label>
                    <div class="col-md-2">                      
                      <input type="text" placeholder="Estatus"  id='estatus' class="form-control" readonly="readonly"></input>
                    </div> 
                  </div> <!-- /Numero Cuenta -->

                  <div class="form-group">
                    <label class="col-md-2">Fecha Ingreso</label>
                    <div class="col-md-2">                      
                      <input type="text" placeholder="Fecha de Ingreso" id='fingreso' class="form-control" readonly="readonly"></input>
                    </div> 
                    <label class="col-md-2">Tiempo Servicio</label>
                    <div class="col-md-2">                      
                      <input type="text" placeholder="Tiempo servicio" id='tservicio' class="form-control" value="0,00" readonly="readonly"></input>
                    </div> 
                    <label class="col-md-2">No. Hijos</label>
                    <div class="col-md-2">                      
                      <input type="text" placeholder="No. Hijos" id='nhijos' class="form-control" readonly="readonly"></input>
                    </div> 
                  </div> <!-- /Numero Cuenta -->


                  <div class="form-group">
                    <label class="col-md-2">Ultimo Ascenso</label>
                    <div class="col-md-2">                      
                      <input type="text" placeholder="Ultimo Ascenso" id='fuascenso' class="form-control" readonly="readonly"></input>
                    </div> 
                    <label class="col-md-2">No. Ascenso</label>
                    <div class="col-md-2">                      
                      <input type="text" placeholder="No. Ascenso" id='noascenso' class="form-control" readonly="readonly"></input>
                    </div> 
                    <label class="col-md-2">St. Prof.</label>
                    <div class="col-md-2">                      
                      <input type="text" placeholder="St. Prof" id='profesionalizacion' class="form-control" readonly="readonly"></input>
                    </div> 
                  </div> <!-- /Numero Cuenta -->

                  <div class="form-group">
                    <label class="col-md-2">Años Recon.</label>
                    <div class="col-md-2">                      
                      <input type="text" placeholder="Ultimo Ascenso" id='arec' class="form-control" readonly="readonly"></input>
                    </div> 
                    <label class="col-md-2">Meses Recon.</label>
                    <div class="col-md-2">                      
                      <input type="text" placeholder="No. Ascenso" id='mrec' class="form-control" readonly="readonly"></input>
                    </div> 
                    <label class="col-md-2">Días Recon.</label>
                    <div class="col-md-2">                      
                      <input type="text" placeholder="Días Reconocidos" id='drec' class="form-control" readonly="readonly"></input>
                    </div> 
                  </div> <!-- /Numero Cuenta -->

                  <div class="form-group">
                    <label class="col-md-2">Fecha de Retiro</label>
                    <div class="col-md-2">                      
                      <input type="text" placeholder="Fecha de Retiro" id='fecha_retiro' class="form-control" readonly="readonly"></input>
                    </div> 
                  </div> <!-- /Numero Cuenta -->


                </div>
              </form>
                  
                  <div class="form-group">
                  <!--<div class="col-md-8">                      
                     

                  </div> -->
              </form>
            </div><!-- /.box-body -->
            <div class="box-footer">
              <div class="row no-print">
                <div class="col-xs-12"  id='divBotones' >
                <button type="button" class="btn btn-success" 
                data-toggle="modal" data-target="#myModal" id='btnMedida'><i class="glyphicon glyphicon-plus">
                </i>&nbsp;&nbsp;Agregar Medida Judicial</button>
              </div>
            </div><!-- /.box-footer-->
          </div><!-- /.box -->
          </div>
          </div>
           

          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Detalles de las Medidas</h3>
              <div class="box-tools pull-right">
               
              </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">                    
                  <br><br>
                    <table id="reporteMedida" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                          <th style="width: 40px;">Acciones</th>
                          <th style="width: 40px;">Tipo</th>
                          <th>Estatus</th>
                          <th>Fecha</th>
                          <th>Oficio</th>
                          <th>Expediente</th>
                          <th>Cedula</th>
                          <th>Beneficiario</th>
                          <th >Estado</th>
                          
                      </tr>
                      </thead>
                      <tbody>
                      </tbody>
                  </table>

            </div><!-- /.box-body -->
          </div><!-- /.box -->

          
                 <!-- Modal -->
                    <div div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="myModal" >
                      <div class="modal-dialog modal-lg" role="document">
                      
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Nueva Medida Judicial</h4>
                          </div>
                          <div class="modal-body">
                           <div class="row">
                            <div class="col-md-2"><h4>N° Oficio:</h4></div>
                            <div class="col-md-4"><input type="text" class="form-control" placeholder="N° Oficio" /></div>
                            <div class="col-md-2"><h4>Expediente:</h4></div>
                            <div class="col-md-4"><input type="text" class="form-control" placeholder="Expediente" /></div>
                          </div>
                          <div class="row">
                              <div class="col-md-2"><h4>Tipo:</h4></div>
                            <div class="col-md-4"><select class="form-control select2" style="width: 100%;">
                                      <option selected="selected">Asignación de Antiguedad</option>
                                      <option>Intereses</option>
                                    </select></div>
                             <div class="col-md-2">
                                      <h4>Fecha:</h4>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="input-group date">
                                        <div class="input-group-addon">
                                          <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control" id="datepicker">
                                      </div>
                                      </div>          
                          </div>
                          <div class="row">
                            <div class="col-md-12"><h4>Observaciones:</h4><textarea class="form-control" placeholder="Descripción"></textarea></div>
                          </div>
                              


                            
                          </div>
                          
                          <div class="box-footer">
                          <div class="col-xs-12">
                            <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i>&nbsp;&nbsp;Cancelar
                            </button>
                            
                            
                          </div>
                            
                          </div>
                        </div>
                        
                      </div>
                    </div>









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
    <script src="<?php echo base_url()?>application/modules/panel/views/js/medidajudicial.js"></script>
  </body>
</html>

























