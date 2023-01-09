<?php  ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?php echo base_url(); ?>assets/img/telkom_akses.png">
  <title>SIMAWAR</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/dist/css/adminlte.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style_umum.css">

    <!-- Load File jquery.min.js yang ada difolder js -->
  <script src="<?php echo base_url('js/jquery.min.js'); ?>"></script>
  
  <script>
  $(document).ready(function(){
    // Sembunyikan alert validasi kosong
    $("#kosong").hide();
  });
  </script>


</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="<?php echo base_url('dashboard'); ?>" class="nav-link">Home</a>
        </li>
        

      <!-- </ul>
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
 -->
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?php echo base_url(); ?>dashboard" class="brand-link">
        <img src="<?php echo base_url(); ?>assets/img/telkom_akses.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SIMAWAR</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <?php
            $menu_master1 = array('material', 'material_edit');
            $menu_master2 = array('bk_tambah');
            $menu_master3 = array('material_keluar', 'bk_edit', 'bk_hapus');
            $menu_master4 = array('staff_gudang', 'staff_edit','staff_tambah');
            $menu_master5 = array('qcm','qcm_upload','qcm_edit');
             $menu_master6 = array('bm_tambah');
             $menu_master7 = array('material_masuk','bm_edit','bm_hapus');

            ?>
            <li class="nav-item  
            <?php
              if (in_array($page, $menu_master1))
                echo "menu-open";
              ?>
            "> 

            <a href="#" class="nav-link 
                <?php
                if (in_array($page, $menu_master1))
                  echo "active";
                ?>
              ">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  WH Banjarmasin
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>


              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?php echo base_url('dashboard/material'); ?>" class="nav-link
                    <?php
                    if (in_array($page, $menu_master1))
                      echo "active";
                    ?>
                  ">
                  <p></p>
                    <i class="nav-icon fas fa-warehouse" style="margin-left: 10px;"></i>
                    <p>Stok Material</p>
                  </a>
                </li>
              </ul>
            </li>

          <li class="nav-item  
            <?php
              if (in_array($page, $menu_master2) || in_array($page, $menu_master3))
                echo "menu-open";
              ?>
            "> 
            <a href="#" class="nav-link 
                <?php
                if (in_array($page, $menu_master2)|| in_array($page, $menu_master3))
                  echo "active";
                ?>
              ">
                <i class="nav-icon fas fa-book" ></i>
                <p>
                  Material Out
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="<?php echo base_url('dashboard/bk_tambah'); ?>" class="nav-link
                    <?php
                    if (in_array($page, $menu_master2))
                      echo "active";
                    ?>
                  ">
                  <p>  </p>
                    <i class="nav-icon fas fa-share" style="margin-left: 10px;"></i>
                    <p>Input Material Keluar</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="<?php echo base_url('dashboard/material_keluar'); ?>" class="nav-link
                    <?php
                    if (in_array($page, $menu_master3))
                      echo "active";
                    ?>
                  ">
                  <p>  </p>
                    <i class="nav-icon fas fa-history" style="margin-left: 10px;"></i>
                    <p>History Material Keluar</p>
                  </a>
                </li>
              </ul>
          </li>
          <li class="nav-item  
            <?php
              if (in_array($page, $menu_master6)||in_array($page, $menu_master7 ))
                echo "menu-open";
              ?>
            "> 
            <a href="#" class="nav-link 
                <?php
                if (in_array($page, $menu_master6)||in_array($page, $menu_master7 ))
                  echo "active";
                ?>
              ">
                <i class="nav-icon fas fa-book" ></i>
                <p>
                  Material In
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              

              <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="<?php echo base_url('dashboard/bm_tambah'); ?>" class="nav-link
                    <?php
                    if (in_array($page, $menu_master6))
                      echo "active";
                    ?>
                  ">
                  <p>  </p>
                    <i class="nav-icon fas fa-share style" style="margin-left: 10px;"></i>
                    <p>Input Material Masuk</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="<?php echo base_url('dashboard/material_masuk'); ?>" class="nav-link
                    <?php
                    if (in_array($page, $menu_master7))
                      echo "active";
                    ?>
                  ">
                  <p>  </p>
                    <i class="nav-icon fas fa-history " style="margin-left: 10px;"></i>
                    <p>History Material Masuk</p>
                  </a>
                </li>
              </ul>
          </li>

          <li class="nav-item  
            <?php
              if (in_array($page, $menu_master5))
                echo "menu-open";
              ?>
            "> 
            <a href="#" class="nav-link 
                <?php
                if (in_array($page, $menu_master5))
                  echo "active";
                ?>
              ">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Quality Check Material
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              

              <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="<?php echo base_url('dashboard/qcm'); ?>" class="nav-link
                    <?php
                    if (in_array($page, $menu_master5))
                      echo "active";
                    ?>
                  ">
                  <p>  </p>
                    <i class="nav-icon fas fa-angle-left"></i>
                    <p>Upload QC</p>
                  </a>
                </li>
              </ul>
          </li>

           <li class="nav-item">
                  <a href="<?php echo base_url('dashboard/staff_gudang'); ?>" class="nav-link
                    <?php
                    if (in_array($page, $menu_master4))
                      echo "active";
                    ?>
                  "><i class="nav-icon fas fa-users"></i>
                    <p>Staff Gudang</p>
                  </a>
                </li>

          <li class="nav-item">
              <a href="<?php echo base_url("login/logout"); ?>" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                  Logout
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>