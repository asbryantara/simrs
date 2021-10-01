<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="favicon" href="<?= base_url('assets/') ?>/img/logo_rs.png">
  <link rel="shortcut icon" href="<?= base_url('assets/') ?>/img/logo_rs.png">
  <title>SIM Klinik | Antrian</title>
  <link rel="shortcut icon" href="<?php echo base_url('assets/dist/img/logo_rs_icon.png') ?>">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>dist//css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins//iCheck/square/blue.css">
  <!-- sweetalert2 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>bower_components/sweetalert2/sweetalert2.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
    .antri{
      width: 100%;
      font-size: 40px;
    }

    #panggil{
      font-size: 180px;
    }

  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">

  <div class="login-logo">
    <a href="#"> <img src="<?php echo base_url('assets/img/logo_rs.png') ?>" alt="" height="100px"> <br> <b>DOQ</b>-IT</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <center>
      <h1>Antrian</h1>
      <h1 id="panggil"></h1>
    </center>

    <button class="antri btn-primary" id="loket"></button>
    
  </div>
  <!-- /.login-box-body -->
  <br>
  <small><center>Copyright &copy; 2019 - DOQ-IT </center></small>
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo base_url('assets/') ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assets/') ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url('assets/') ?>plugins//iCheck/icheck.min.js"></script>
<!-- sweetalert2 -->
<script src="<?php echo base_url('assets/') ?>bower_components/sweetalert2/sweetalert2.all.min.js"></script>
<script>
  $(document).ready(function(){

    panggil();

    setInterval(function(){
      panggil();
    }, 2000);

    function panggil(){
      $.ajax({
        url: '<?= base_url('antrian/panggilan') ?>',
        dataType: 'JSON',
        success: function(data){
          var panggilan = data.no_antrian;
          var loket = data.loket_antrian;
          $('#panggil').html(panggilan);
          $('#loket').html('Loket '+loket);
        }

      });
    }
  });
</script>
</body>
</html>
