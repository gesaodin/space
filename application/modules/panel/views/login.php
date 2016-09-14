<!DOCTYPE html>
<html>
<?php $this->load->view('inc/cabecera.php');?>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
  
    <b>PACE</b>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">

    <p class="login-box-msg"><img src="<?php echo base_url()?>/application/modules/panel/views/img/ipsfa.png"style="width: 50%"><br>Inicio de Sesión</p>

    <form action="<?php echo base_url();?>index.php/panel/verificar" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Usuario">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Clave">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Iniciar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>


    


  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
