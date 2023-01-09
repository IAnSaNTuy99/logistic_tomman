
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LOGIN WH</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/dist/css/adminlte.css">
  <style>
    .login-page {
      /* background-image: url("<?php echo base_url(); ?>assets/img/bg_Simawar.jpg"); */
      background: linear-gradient(#B03A2E, #343a40);  
      background-position: center center;
      background-size: cover;
      background-attachment: fixed;
    }
  </style>
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="card">
      <div class="card-body p-lg-5 p-0">
      <div class="login-logo">
      <img src="<?php echo base_url(); ?>assets/img/telkom_logo.png">
      <span class="text-warning"><b></b></a></span>
    </div>
    <!-- /.login-logo -->
        <p class="login-box-msg">Silahkan Login Disini</p>
                <?php if(($this->session->flashdata('message'))){?> 
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                     <?= $this->session->flashdata('message');?>
                    </div>
                    <?php }?>
     
        <form action="<?php echo base_url("login"); ?>" method="post">
          <div class="input-group mb-3">
            <input type="text" name="USERNAME" class="form-control" placeholder="Username">
            <span class="badge badge-warning"><?php echo strip_tags(form_error('USERNAME')); ?></span>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
                  
          <div class="input-group mb-3">
            <input type="password" name="PASSWORD" class="form-control" placeholder="Password">
            <span class="badge badge-warning"><?php echo strip_tags(form_error('PASSWORD')); ?></span>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-4">

            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Login</button>
            </div>
            <!-- /.col -->
            <div class="col-4">

            </div>

          </div>
        </form>
        </div>
      <!-- /.login-card-body -->
    </div>
</div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?php echo base_url(); ?>assets/adminlte/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url(); ?>assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url(); ?>assets/adminlte/dist/js/adminlte.min.js"></script>


</body>

</html>