  <?php
  //==================================== HOME ====================================
  if ($page == 'home') {
  ?>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo  $judul; ?></h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6 col-12">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $jml_barang; ?></h3>

                <p>Jumlah Barang</p>
              </div>
              <div class="icon">
                <i class="ion ion-cube"></i>
              </div>
              <a href="<?php echo base_url('dashboard/barang') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          
        </div>
      </div>
    </section>

    <section class="content">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Selamat Datang Admin</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>

        <div class="card-body">
          <h2>Info</h2>
          <p>Ini adalah contoh sistem informasi menggunakan CI3 dengan sistem login,
            dan menggunakan data yang berelasi. Didalamnya juga menggunakan sistem
            multilogin untuk membedakan level user tertentu.<br>
            Besar harapan contoh coding ini bermanfaat sebagai start awal memahami
            membangun sebuah sistem informasi yang lebih rumit.</p>
          <p></p>

        </div>
        <div class="card-footer">
          Create @2022
        </div>
      </div>

    </section>
  </div>
<?php
}

//============================================STOK MATERIAL=================================================//
else if ($page == 'barang') {
?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo  $judul; ?></h1>
          </div>
        </div>
      </div>
    </section>

      <section class="content">
      <?= $this->session->flashdata('pesan'); ?>
      <div class="card">
        <div class="card-body">
          <div class="row">
           <div class="col-sm-0"><?= form_open_multipart('dashboard/uploaddata') ?> </div>
            <div class="col-sm-2.5">
              <input type="file" class="form-control-file" id="importexcel" name="importexcel" accept=".xlsx,.xls"> 
            </div>
              <div class="col-sm-5">
                  <button type="submit" class="btn btn-primary">Import</button>
              </div>
              <?= form_close(); ?>
              </div>  
     
          <table id="datatable_01" class="table table-bordered">
            <thead>
              <tr>
                <th>NO</th>
                <th>Kode Material</th>
                <th>Nama Material</th>
                <th>Jumlah</th>
                <th>satuan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <?php $i = 1;
            foreach ($barang as $data) { ?>
              <tr>
                <td><?= $i++; ?></td>
                <td><?php echo $data['ID_BARANG'] ?></td>
                <td><?php echo $data['NAMA_BARANG'] ?></td>
                <td><?php echo $data['JUMLAH'] ?></td>
                <td><?php echo $data['SATUAN'] ?></td>
                <td>
                  <a href=<?php echo base_url("dashboard/barang_edit/") . $data['ID_BARANG']; ?>> <i class="fas fa-pencil-alt"></i> </a>
                  <a href=<?php echo base_url("dashboard/barang_hapus/") . $data['ID_BARANG']; ?> onclick="return confirm('Yakin menghapus Material : <?php echo $data['NAMA_BARANG']; ?> ?');" ;><i class="fas fa-trash-alt"></i></a> <!-- <a href="#"><i class="fas fa-pencil-alt" data-toggle="modal" data-target="#modal-default"></i></a> -->
                </button>

              </td>
                
                 
              </tr>
            <?php
            }
            ?>
          </table>

                
            </div>
        </div>
    </section>
  </div>

<?php
}

//--------------------------------- TAMBAH ---------------------------------
else if ($page == 'barang_edit') {
    ?>
      <div class="content-wrapper">
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1><?php echo  $judul; ?></h1>
              </div>
            </div>
          </div>
        </section>
    
        <section class="content">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Isikan Data Dengan Benar</h3>
            </div>
            <div class="card-body">
    
              <?php echo validation_errors(); ?>
    
              <form method="POST" action="<?php echo base_url('dashboard/barang_edit/' . $d['ID_BARANG']); ?>" class="form-horizontal">
    
                <div class="card-body">
    
                   <div class="form-group row">
                            <label for="ID_BARANG" class="col-sm-2 col-form-label">Kode Material</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="ID_BARANG" id="ID_BARANG" value="<?php echo set_value('ID_BARANG',$d['ID_BARANG'],true); ?>" placeholder="Masukkan ID Barang">
                              <span class="badge badge-warning"><?php echo strip_tags(form_error('ID_BARANG')); ?></span>
                            </div>
                          </div>

                         <div class="form-group row">
                            <label for="nama_barang" class="col-sm-2 col-form-label">Nama Material</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="NAMA_BARANG" id="NAMA_BARANG" value="<?php echo set_value('NAMA_BARANG', $d['NAMA_BARANG'],true); ?>" placeholder="Masukkan Nama Barang">
                              <span class="badge badge-warning"><?php echo strip_tags(form_error('NAMA_BARANG')); ?></span>
                            </div>
                          </div>

                         <div class="form-group row">
                            <label for="nama_barang" class="col-sm-2 col-form-label">Jumlah</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="JUMLAH" id="JUMLAH" value="<?php echo set_value('JUMLAH', $d['JUMLAH'],true); ?>" placeholder="Masukkan Jumlah">
                              <span class="badge badge-warning"><?php echo strip_tags(form_error('JUMLAH')); ?></span>
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="SATUAN" class="col-sm-2 col-form-label">Satuan</label>
                            <div class="col-sm-10">
                             
                              <select class="form-control" name="SATUAN" id="SATUAN" value="<?php echo set_value('SATUAN'); ?>" >
                                <option value="" disabled>Pilih Satuan</option>
                                <option value="M"<?php if($d['SATUAN']=='M') echo 'selected'?><?php echo set_value('SATUAN'); ?>>M</option>
                                <option value="PC"<?php if($d['SATUAN']=='PC') echo 'selected'?><?php echo set_value('SATUAN'); ?>>PC</option>
                                <option value="BTG"<?php if($d['SATUAN']=='BTG') echo 'selected'?><?php echo set_value('SATUAN'); ?>>BTG</option>
                              </select>
                              <span class="badge badge-warning"><?php echo strip_tags(form_error('SATUAN')); ?></span>
                            </div>
                          </div>

                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Simpan</button>
                </div>
              </form>
    
            </div>
          </div>
        </section>
      </div>
    
    <?php
    }






//============================================Staff=================================================//
else if ($page == 'staff_gudang') {
  ?>
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1><?php echo  $judul; ?></h1>
            </div>
          </div>
        </div>
      </section>
  
      <section class="content">
        <div class="card">
          <div class="card-body">
          <a href=<?php echo base_url("dashboard/staff_tambah") ?> class="btn btn-primary" style="margin-bottom:15px">
            Tambah Staff</a>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>NO</th>
                  <th>NIK</th>
                  <th>Nama</th>
                  <th>Gender</th>
                  <th>Tanggal Lahir</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <?php $i = 1;
              foreach ($staff_gudang as $data) { ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td><?php echo $data['id_staff'] ?></td>
                  <td><?php echo $data['nama_staff'] ?></td>
                  <td><?php echo $data['jenkel'] ?></td>
                  <td><?php echo $data['tgl_lahir'] ?></td>
                  <td>
                  <a href=<?php echo base_url("dashboard/staff_edit/") . $data['id_staff']; ?>> <i class="fas fa-pencil-alt"></i> </a>
                  <a href=<?php echo base_url("dashboard/staff_hapus/") . $data['id_staff']; ?> onclick="return confirm('Yakin menghapus staff: <?php echo $data['nama_staff']; ?> ?');" ;><i class="fas fa-trash-alt"></i></a>
                </td>
                </tr>
              <?php
              }
              ?>
            </table>
            </div>
        </div>
      </section>
    </div>
  
  <?php
  }
//--------------------------------- TAMBAH ---------------------------------
else if ($page == 'staff_tambah') {
  ?>
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1><?php echo  $judul; ?></h1>
            </div>
          </div>
        </div>
      </section>
  
      <section class="content">
        <div class="card">
          <div class="card-body">
  
            <form method="POST" action="<?php echo base_url('dashboard/staff_tambah/'); ?>" class="form-horizontal">
  
              <div class="card-body">
  
                <div class="form-group row">
                  <label for="nama_staff" class="col-sm-2 col-form-label">Nama staff</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_staff" id="nama_staff" value="<?php echo set_value('nama_staff'); ?>" placeholder="Masukkan Nama staff">
                    <span class="badge badge-warning"><?php echo strip_tags(form_error('nama_staff')); ?></span>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="jenkel" class="col-sm-2 col-form-label">Gender</label>
                  <div class="col-sm-10">
                    <label >
                    <input type="radio"  name="jenkel" id="jenkel" value="Laki-laki" <?php echo set_value('jenkel'); ?>> Laki-Laki
                  </label>
                  <label >
                    <input type="radio"  name="jenkel" id="jenkel" value="Perempuan" <?php echo set_value('jenkel'); ?>> Perempuan
                  </label>
                  <span class="badge badge-warning"><?php echo strip_tags(form_error('jenkel')); ?></span>
                  </div>
                </div>
  
                <div class="form-group row">
                    <label for="tanggal lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                      <div class="col-sm-10">
                        <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir"
                              value="<?php echo set_value('tanggal'); ?>">
                                <span class="badge badge-warning"><?php echo strip_tags(form_error('tgl_lahir')); ?></span>
                      </div>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-info">Simpan</button>
              </div>
            </form>
  
  
          </div>
      </section>
    </div>
  <?php

  //--------------------------------- Staff Edit ---------------------------------
  } else if ($page == 'staff_edit') {
    ?>
      <div class="content-wrapper">
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1><?php echo  $judul; ?></h1>
              </div>
            </div>
          </div>
        </section>
    
        <section class="content">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Isikan Data Dengan Benar</h3>
            </div>
            <div class="card-body">
    
              <?php echo validation_errors(); ?>
    
              <form method="POST" action="<?php echo base_url('dashboard/staff_edit/' . $d['id_staff']); ?>" class="form-horizontal">
    
                <div class="card-body">
    
                  <div class="form-group row">
                    <label for="nama_staff" class="col-sm-2 col-form-label">Nama Staff</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama_staff" id="nama_staff" value="<?php echo set_value('nama_staff',$d['nama_staff'],true); ?>" placeholder="Masukkan Nama Staff">
                      <span class="badge badge-warning"><?php echo strip_tags(form_error('nama_staff')); ?></span>
                    </div>
                  </div>

                  <div class="form-group row">
                  <label for="jenkel" class="col-sm-2 col-form-label">Gender</label>
                  <div class="col-sm-10">
                  <label >
                    <input type="radio"  name="jenkel" id="jenkel" value="Laki-laki" <?php if($d['jenkel']=='Laki-laki') echo 'checked'?>> Laki-Laki
                  </label>
                  <label>
                    <input type="radio"  name="jenkel" id="jenkel" value="Perempuan" <?php if($d['jenkel']=='Perempuan') echo 'checked'?>> Perempuan
                  </label>
                  <span class="badge badge-warning"><?php echo strip_tags(form_error('jenkel')); ?></span>
                  </div>
                </div>
    
                  <div class="form-group row">
                    <label for="tgl_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" value="<?php echo set_value('tgl_lahir',$d['tgl_lahir']); ?>"> 
                      <span class="badge badge-warning"><?php echo strip_tags(form_error('tgl_lahir')); ?></span>
                    </div>
                  </div>
    
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Simpan</button>
                </div>
              </form>
    
            </div>
          </div>
        </section>
      </div>
    
    <?php
    }




//============================================Barang Keluar=================================================//
else if ($page == 'barang_keluar') {
  ?>
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1><?php echo  $judul; ?></h1>
            </div>
          </div>
        </div>
      </section>
  
      <section class="content">
        <div class="card">
          <div class="card-body">
            <a href=<?php echo base_url("dashboard/bk_tambah") ?> class="btn btn-primary" style="margin-bottom:15px">
            Input Barang Out</a>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>NO</th>
                 <!--  <th>Id Barang</th> -->
                  <th>Nama Barang</th>
                  <th>Jumlah</th>
                  <th>Satuan</th>
                  <th>Tanggal</th>
            <!--       <th>Aksi</th> -->
                </tr>
              </thead>
              <?php $i = 1;
              foreach ($barang_keluar as $data) { ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <!-- <td>BK<?php echo $data['ID_BARANG_KELUAR'] ?></td> -->
                  <td><?php echo $data['NAMA_BARANG'] ?></td>
                  <td><?php echo $data['JUMLAH'] ?></td>
                  <td><?php echo $data['SATUAN'] ?></td>
                  <td><?php echo $data['TANGGAL'] ?></td>
                  <!-- <td>
                  <a href=<?php echo base_url("dashboard/bk_edit/") . $data['ID_BARANG_KELUAR']; ?>> <i class="fas fa-pencil-alt"></i> </a>
                  <a href=<?php echo base_url("dashboard/bk_hapus/") . $data['ID_BARANG_KELUAR']; ?> onclick="return confirm('Yakin menghapus Data Barang Keluar: <?php echo $data['NAMA_BARANG']; ?> ?');" ;><i class="fas fa-trash-alt"></i></a>
                </td> -->
                </tr>
              <?php
              }
              ?>
            </table>
            </div>
        </div>
      </section>
    </div>
  
  <?php
  }
 


//========================================Tambah Barang Keluar==========================//
  else if ($page == 'bk_tambah') {
  ?>
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1><?php echo  $judul; ?></h1>
            </div>
          </div>
        </div>
      </section>
  
      <section class="content">
        <div class="card">
          <div class="card-body">
  
            <form method="POST" action="<?php echo base_url('dashboard/bk_tambah/'); ?>" class="form-horizontal">
  
              <div class="card-body">
                <div class="form-group row">
                  <label for="ID_BARANG" class="col-sm-2 col-form-label">Pilih Barang</label>
                  <div class="col-sm-10" >
                    <select class="form-control" name="ID_BARANG" id="ID_BARANG" value="<?php echo form_dropdown('ID_BARANG', $ddbarang, set_value('ID_BARANG')); ?>
                    
                    <span class="badge badge-warning"><?php echo strip_tags(form_error('ID_BARANG')); ?></span>
                    </select>
                </div>
              </div>

                 <div class="form-group row">
                <label for="JUMLAH" class="col-sm-2 col-form-label">Jumlah</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="JUMLAH" id="JUMLAH" value="<?php echo set_value('JUMLAH'); ?>" placeholder="Masukkan Jumlah">
                  <span class="badge badge-warning"><?php echo strip_tags(form_error('JUMLAH')); ?></span>
                </div>
              </div>
  
                
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-info">Simpan</button>
              </div>
            </form>
  
  
          </div>
      </section>
    </div>
  <?php
  }

  //========================================Edit Barang Keluar==========================//
 else if ($page == 'bk_edit') {
  ?>
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1><?php echo  $judul; ?></h1>
            </div>
          </div>
        </div>
      </section>
  
      <section class="content">
        <div class="card">
          <div class="card-body">
  
            <form method="POST" action="<?php echo base_url('dashboard/bk_edit/' . $d['ID_BARANG_KELUAR']); ?>" class="form-horizontal">
  
              <div class="card-body">
                <div class="form-group row">
                  <label for="ID_BARANG" class="col-sm-2 col-form-label">Pilih Barang</label>
                  <div class="col-sm-10" >
                    <select class="form-control" name="ID_BARANG" id="ID_BARANG" value="<?php echo form_dropdown('ID_BARANG', $ddbarang, set_value('ID_BARANG',$d['ID_BARANG'])); ?>
                    
                    <span class="badge badge-warning"><?php echo strip_tags(form_error('ID_BARANG')); ?></span>
                    </select>
                </div>
              </div>

                 <div class="form-group row">
                <label for="JUMLAH" class="col-sm-2 col-form-label">Jumlah</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="JUMLAH" id="JUMLAH" value="<?php echo set_value('JUMLAH',$d['JUMLAH']); ?>" placeholder="Masukkan Jumlah">
                  <span class="badge badge-warning"><?php echo strip_tags(form_error('JUMLAH')); ?></span>
                </div>
              </div>
  
                
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-info">Simpan</button>
              </div>
            </form>
  
  
          </div>
      </section>
    </div>
  <?php
  }

//============================================Quality Check Material=================================================//
else if ($page == 'qcm') {
  ?>
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1><?php echo  $judul; ?></h1>
            </div>
          </div>
        </div>
      </section>
  
      <section class="content">
        <div class="card">
          
          <div class="card-body">
          <?= $this->session->flashdata('pesan'); ?>
          <div class="row">
           <div class="col-sm-0"><?= form_open_multipart('dashboard/uploadimg') ?></div>
            <div class="col-sm-2.5">
              <input type="file" class="form-control-file" id="importimg" name="importimg" accept=".xlsx,.xls"> 
            </div>
              <div class="col-sm-5">
                  <button type="submit" class="btn btn-primary">Import Evidence</button>
              </div>
              <?= form_close(); ?>
              </div> 
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>NO</th>
                  <th>Id Barang</th>
                  <th>Nama Barang</th>
                  <th>Evidence</th>
                  <th>Tgl Upload</th>
                  <th>Status QC</th>
            <!--       <th>Aksi</th> -->
                </tr>
              </thead>
              <?php $i = 1;
              foreach ($qcm as $data) { ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td><?php echo $data['id_barang'] ?></td>
                  <td><?php echo $data['nama_barang'] ?></td>
                  <td><?php echo $data['evidence'] ?></td>
                  <td><?php echo $data['tgl_upload'] ?></td>
                  <td><?php echo $data['status_qcm'] ?></td>
                  <td>
                  <a href=<?php echo base_url("dashboard/qcm_edit/") . $data['id_qcm']; ?>> <i class="fas fa-pencil-alt"></i> </a>
                  <a href=<?php echo base_url("dashboard/qcm_hapus/") . $data['id_qcm']; ?> onclick="return confirm('Yakin menghapus staff: <?php echo $data['nama_barang']; ?> ?');" ;><i class="fas fa-trash-alt"></i></a>
                  </td>
                </tr>
              <?php
              }
              ?>
            </table>
            </div>
        </div>
      </section>
    </div>
  
  <?php
  }

// ----------------------------------------- Tambah QCM -------------------------
else if ($page == 'qcm_tambah'){
  ?>

  <?php
  }