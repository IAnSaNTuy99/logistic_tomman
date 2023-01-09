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
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $jml_material; ?></h3>

                <p>Jumlah material</p>
              </div>
              <div class="icon">
                <i class="ion ion-cube"></i>
              </div>
              <a href="<?php echo base_url('dashboard/material') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
else if ($page == 'material') {
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
           <div class="update">Last Update: <?php echo implode(" ",$date); ?> </div> 
          <div class="row">
            
           <div class="col-sm-0"><?= form_open_multipart('dashboard/uploaddata')  ?>  </div>
           
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
                <th>Satuan</th>
                <!-- <th>Aksi</th> -->
              </tr>
            </thead>
            <?php $i = 1;
            foreach ($material as $data) { ?>
              <tr>
                <td><?= $i++; ?></td>
                <td><?php echo $data['ID_MATERIAL'] ?></td>
                <td><?php echo $data['NAMA_MATERIAL'] ?></td>
                <td><?php echo $data['JUMLAH'] ?></td>
                <td><?php echo $data['SATUAN'] ?></td>

                
                
                 
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
else if ($page == 'material_edit') {
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
    
              <form method="POST" action="<?php echo base_url('dashboard/material_edit/' . $d['ID_MATERIAL']); ?>" class="form-horizontal">
    
                <div class="card-body">
    
                   <div class="form-group row">
                            <label for="ID_MATERIAL" class="col-sm-2 col-form-label">Kode Material</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="ID_MATERIAL" id="ID_MATERIAL" value="<?php echo set_value('ID_MATERIAL',$d['ID_MATERIAL'],true); ?>" placeholder="Masukkan ID MATERIAL">
                              <span class="badge badge-warning"><?php echo strip_tags(form_error('ID_MATERIAL')); ?></span>
                            </div>
                          </div>

                         <div class="form-group row">
                            <label for="nama_material" class="col-sm-2 col-form-label">Nama Material</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="NAMA_MATERIAL" id="NAMA_MATERIAL" value="<?php echo set_value('NAMA_MATERIAL', $d['NAMA_MATERIAL'],true); ?>" placeholder="Masukkan Nama MATERIAL">
                              <span class="badge badge-warning"><?php echo strip_tags(form_error('NAMA_MATERIAL')); ?></span>
                            </div>
                          </div>

                         <div class="form-group row">
                            <label for="nama_material" class="col-sm-2 col-form-label">Jumlah</label>
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
            <table id="datatable_03" class="table table-bordered">
              <thead>
                <tr>
                  <th>NO</th>
                  <!-- <th>NIK</th> -->
                  <th>Nama Staff</th>
                  <th>Gender</th>
                  <th>Tanggal Lahir</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <?php $i = 1;
              foreach ($staff_gudang as $data) { ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <!-- <td><?php echo $data['id_staff'] ?></td> -->
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




//============================================material Keluar=================================================//
else if ($page == 'material_keluar') {
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
            <table id="datatable_02" class="table table-bordered">
              <thead>
                <tr>
                  <th>NO</th>
                 <!--  <th>Id material</th> -->
                  <th>Nama Material</th>
                  <th>Jumlah</th>
                  <th>Satuan</th>
                  <th>Tanggal</th>
                  <th>Waktu</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <?php $i = 1;
              foreach ($material_keluar as $data) { ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <!-- <td>BK<?php echo $data['ID_MATERIAL_KELUAR'] ?></td> -->
                  <td><?php echo $data['NAMA_MATERIAL'] ?></td>
                  <td><?php echo $data['JUMLAH'] ?></td>
                  <td><?php echo $data['SATUAN'] ?></td>
                  <td><?php echo $data['TANGGAL'] ?></td>
                  <td><?php echo $data['WAKTU'] ?></td>
                  <td>
                 <a href=<?php echo base_url("dashboard/bk_edit/") . $data['ID_MATERIAL_KELUAR']; ?>> <i class="fas fa-pencil-alt"></i> </a> 
                  <a href=<?php echo base_url("dashboard/bk_hapus/") . $data['ID_MATERIAL_KELUAR']; ?> onclick="return confirm('Yakin menghapus Data MATERIAL Keluar: <?php echo $data['NAMA_MATERIAL']; ?> ?');" ;><i class="fas fa-trash-alt"></i></a>
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
 


//========================================Tambah material Keluar==========================//
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
  
            <form method="POST" action="<?php echo base_url('dashboard/bk_tambah/' ); ?>" class="form-horizontal">
  
              <div class="card-body">
                <div class="form-group row">
                  <label for="ID_MATERIAL" class="col-sm-2 col-form-label">Pilih Material</label>
                  <div class="col-sm-10" >
                    <select class="form-control" name="ID_MATERIAL" id="ID_MATERIAL" value="<?php echo form_dropdown('ID_MATERIAL', $ddmaterial, set_value('ID_MATERIAL')); ?>
                    
                    <span class="badge badge-warning"><?php echo strip_tags(form_error('ID_MATERIAL')); ?></span>
                    </select>
                </div>
              </div>

                 <div class="form-group row">
                <label for="JUMLAH" class="col-sm-2 col-form-label">Jumlah</label>
                <div class="col-sm-10">
                  <input type="text"min="0"  max="<?php echo set_value('b.JUMLAH',$d['JUMLAH']); ?>" class="form-control" name="JUMLAH" id="JUMLAH" value="<?php echo set_value('JUMLAH'); ?>" placeholder="Masukkan Jumlah">
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

  //========================================Edit material Keluar==========================//
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
  
            <form method="POST" action="<?php echo base_url('dashboard/bk_edit/' . $d['ID_MATERIAL_KELUAR']); ?>" class="form-horizontal">
  
              <div class="card-body">
                <div class="form-group row">
                  <label for="ID_MATERIAL" class="col-sm-2 col-form-label">Pilih material</label>
                  <div class="col-sm-10" >
                    <select class="form-control" name="ID_MATERIAL" id="ID_MATERIAL" value="<?php echo form_dropdown('ID_MATERIAL', $ddmaterial, set_value('ID_MATERIAL',$d['ID_MATERIAL'])); ?>
                    
                    <span class="badge badge-warning"><?php echo strip_tags(form_error('ID_MATERIAL')); ?></span>
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
            <a href=<?php echo base_url("dashboard/qcm_upload") ?> class="btn btn-primary" style="margin-bottom:15px">
            Input QC Material</a>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>NO</th>
                  <th>Id material</th>
                  <th>Dokumen</th>
                  <th>Evidence</th>
                  <th>Status QCM</th>
                  <th>Tgl QCM</th>
                  <th>Tgl Upload</th>
                  <th>Aksi</th>
            <!--       <th>Aksi</th> -->
                </tr>
              </thead>
              <?php $i = 1;
              foreach ($qcm as $data) { ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td><?php echo $data['id_material'] ?></td>
                  <td><?php echo $data['dokumen'] ? '<a href="' . base_url("uploads/pdf/{$data['dokumen']}") . '" target="_blank">UPLOADED</a>' : 'NOT UPLOADED'?></td>
                  <td><?php echo $data['evidence'] ? '<a href="' . base_url("uploads/images/{$data['evidence']}") . '" target="_blank">UPLOADED</a>' : 'NOT UPLOADED'?></td>
                  <td><?php echo $data['status_qcm'] ?></td>
                  <td><?php echo $data['tgl_qcm'] ?></td>
                  <td><?php echo $data['tgl_upload'] ?></td>
                  <td>
                  <a href=<?php echo base_url("dashboard/qcm_edit/") . $data['id_qcm']; ?>> <i class="fas fa-pencil-alt"></i> </a>
                  <a href=<?php echo base_url("dashboard/qcm_hapus/") . $data['id_qcm']; ?> onclick="return confirm('Yakin menghapus staff: <?php echo $data['id_material']; ?> ?');" ;><i class="fas fa-trash-alt"></i></a>
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

  //--------------------------------- QCM TAMBAH ---------------------------------
else if ($page == 'qcm_upload') {
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
                <!-- <?php echo validation_errors(); ?> -->

          
               <?php echo form_open_multipart('dashboard/qcm_upload');?>

              <div class="card-body">

                <div class="form-group row">
                  <label for="id_material" class="col-sm-2 col-form-label">Nama material</label>
                  <div class="col-sm-10">
                  <select class="form-control" name="id_material" id="id_material" 
                  value="<?php echo form_dropdown('id_material', $ddmaterial, set_value('id_material')); ?>  
                    <span class="badge badge-warning"><?php echo strip_tags(form_error('id_material')); ?></span>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="dokumen" class="col-sm-2 col-form-label">Upload PDF</label>
                  <div class="col-sm-10">
                    <input type="file" accept=".pdf" class="form-control-file" id="dokumen" name="dokumen" >
                  </div>
                </div>

                <div class="form-group row">
                  <label for="evidence" class="col-sm-2 col-form-label">Upload Evidence</label>
                  <div class="col-sm-10">
                    <input type="file" accept=".jpg,.png,.jpeg" class="form-control-file" id="evidence" name="evidence" >
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="statusqcm" class="col-sm-2 col-form-label">Status QC</label>
                  <div class="col-sm-10">
                    <label >
                    <input type="radio"  name="status_qcm" id="status_qcm" value="SPEC" <?php echo set_value('status_qcm'); ?>> SPEC
                  </label>
                  <label >
                    <input type="radio"  name="status_qcm" id="status_qcm" value="UNSPEC" <?php echo set_value('status_qcm'); ?>> UNSPEC
                  </label>
                  <span class="badge badge-warning"><?php echo strip_tags(form_error('status_qcm')); ?></span>
                  </div>
                </div>

                <div class="form-group row">
                    <label for="tanggal lahir" class="col-sm-2 col-form-label">Tanggal QCM</label>
                      <div class="col-sm-10">
                        <input type="date" class="form-control" name="tgl_qcm" id="tgl_qcm"
                              value="<?php echo set_value('tgl_qcm'); ?>">
                                <span class="badge badge-warning"><?php echo strip_tags(form_error('tgl_qcm')); ?></span>
                      </div>
                </div>

                <div class="form-group row">
                    <label for="tanggal lahir" class="col-sm-2 col-form-label">Tanggal Upload</label>
                      <div class="col-sm-10">
                        <input type="date" class="form-control" name="tgl_upload" id="tgl_upload"
                              value="<?php echo set_value('tgl_upload'); ?>">
                                <span class="badge badge-warning"><?php echo strip_tags(form_error('tgl_upload')); ?></span>
                      </div>
                </div>

                

                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Simpan</button>
                </div>
              </div>
              <?= form_close(); ?>
  
            </div>
          </div>
      </section>
    </div>
  <?php
}

//--------------------------------- QCM EDIT ---------------------------------
else if ($page == 'qcm_edit') {
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
                <!-- <?php echo validation_errors(); ?> -->

          
               <?php echo form_open_multipart('dashboard/qcm_edit');?>

              <div class="card-body">

                <div class="form-group row">
                  <label for="id_material" class="col-sm-2 col-form-label">Nama material</label>
                  <div class="col-sm-10">
                  <select class="form-control" name="id_material" id="id_material" 
                  value="<?php echo form_dropdown('id_material', $ddmaterial, set_value('id_material')); ?>  
                    <span class="badge badge-warning"><?php echo strip_tags(form_error('id_material')); ?></span>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="dokumen" class="col-sm-2 col-form-label">Upload PDF</label>
                  <div class="col-sm-10">
                    <input type="file" accept=".pdf" class="form-control-file" id="dokumen" name="dokumen" >
                  </div>
                </div>

                <div class="form-group row">
                  <label for="evidence" class="col-sm-2 col-form-label">Upload Evidence</label>
                  <div class="col-sm-10">
                    <input type="file" accept=".jpg,.png,.jpeg" class="form-control-file" id="evidence" name="evidence" >
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="statusqcm" class="col-sm-2 col-form-label">Status QC</label>
                  <div class="col-sm-10">
                    <label >
                    <input type="radio"  name="status_qcm" id="status_qcm" value="SPEC" <?php echo set_value('status_qcm'); ?>> SPEC
                  </label>
                  <label >
                    <input type="radio"  name="status_qcm" id="status_qcm" value="UNSPEC" <?php echo set_value('status_qcm'); ?>> UNSPEC
                  </label>
                  <span class="badge badge-warning"><?php echo strip_tags(form_error('status_qcm')); ?></span>
                  </div>
                </div>

                <div class="form-group row">
                    <label for="tanggal lahir" class="col-sm-2 col-form-label">Tanggal QCM</label>
                      <div class="col-sm-10">
                        <input type="date" class="form-control" name="tgl_qcm" id="tgl_qcm"
                              value="<?php echo set_value('tgl_qcm'); ?>">
                                <span class="badge badge-warning"><?php echo strip_tags(form_error('tgl_qcm')); ?></span>
                      </div>
                </div>

                <div class="form-group row">
                    <label for="tanggal lahir" class="col-sm-2 col-form-label">Tanggal Upload</label>
                      <div class="col-sm-10">
                        <input type="date" class="form-control" name="tgl_upload" id="tgl_upload"
                              value="<?php echo set_value('tgl_upload'); ?>">
                                <span class="badge badge-warning"><?php echo strip_tags(form_error('tgl_upload')); ?></span>
                      </div>
                </div>

                

                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Simpan</button>
                </div>
              </div>
              <?= form_close(); ?>
  
            </div>
          </div>
      </section>
    </div>
  <?php
}


//============================================material Keluar=================================================//
else if ($page == 'material_masuk') {
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
            <table id="datatable_02" class="table table-bordered">
              <thead>
                <tr>
                  <th>NO</th>
                 <!--  <th>Id material</th> -->
                  <th>Nama Material</th>
                  <th>Jumlah</th>
                  <th>Satuan</th>
                  <th>Tanggal</th>
                  <th>Waktu</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <?php $i = 1;
              foreach ($material_masuk as $data) { ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <!-- <td>BK<?php echo $data['ID_MATERIAL_MASUK'] ?></td> -->
                  <td><?php echo $data['NAMA_MATERIAL'] ?></td>
                  <td><?php echo $data['JUMLAH'] ?></td>
                  <td><?php echo $data['SATUAN'] ?></td>
                  <td><?php echo $data['TANGGAL'] ?></td>
                  <td><?php echo $data['WAKTU'] ?></td>
                  <td>
                 <a href=<?php echo base_url("dashboard/bm_edit/") . $data['ID_MATERIAL_MASUK']; ?>> <i class="fas fa-pencil-alt"></i> </a> 
                  <a href=<?php echo base_url("dashboard/bm_hapus/") . $data['ID_MATERIAL_MASUK']; ?> onclick="return confirm('Yakin menghapus Data MATERIAL Keluar: <?php echo $data['NAMA_MATERIAL']; ?> ?');" ;><i class="fas fa-trash-alt"></i></a>
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
 


//========================================Tambah material Keluar==========================//
  else if ($page == 'bm_tambah') {
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
         <!--  <a href=<?php echo base_url("dashboard/bmnew_tambah") ?> class="btn btn-primary" style="margin-bottom:15px">
            Tambah Data Material Baru</a> -->
            <form method="POST" action="<?php echo base_url('dashboard/bm_tambah/' ); ?>" class="form-horizontal">
  
              <div class="card-body">
                <div class="form-group row">
                  <label for="ID_MATERIAL" class="col-sm-2 col-form-label">Pilih Material</label>
                  <div class="col-sm-10" >
                    <select class="form-control" name="ID_MATERIAL" id="ID_MATERIAL" value="<?php echo form_dropdown('ID_MATERIAL', $ddmaterial, set_value('ID_MATERIAL')); ?>
                    
                    <span class="badge badge-warning"><?php echo strip_tags(form_error('ID_MATERIAL')); ?></span>
                    </select>
                </div>
              </div>

                 <div class="form-group row">
                <label for="JUMLAH" class="col-sm-2 col-form-label">Jumlah</label>
                <div class="col-sm-10">
                  <input type="text"min="0"  max="<?php echo set_value('b.JUMLAH',$d['JUMLAH']); ?>" class="form-control" name="JUMLAH" id="JUMLAH" value="<?php echo set_value('JUMLAH'); ?>" placeholder="Masukkan Jumlah">
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

  //--------------------------------- TAMBAH ---------------------------------
else if ($page == 'bmnew_tambah') {
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
    
              <form method="POST" action="<?php echo base_url('dashboard/bmnew_tambah/' ); ?>" class="form-horizontal">
    
                <div class="card-body">
    
                   <div class="form-group row">
                            <label for="ID_MATERIAL" class="col-sm-2 col-form-label">Kode Material</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="ID_MATERIAL" id="ID_MATERIAL" value="<?php echo set_value('ID_MATERIAL'); ?>" placeholder="Masukkan ID MATERIAL">
                              <span class="badge badge-warning"><?php echo strip_tags(form_error('ID_MATERIAL')); ?></span>
                            </div>
                          </div>

                         <div class="form-group row">
                            <label for="nama_material" class="col-sm-2 col-form-label">Nama Material</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="NAMA_MATERIAL" id="NAMA_MATERIAL" value="<?php echo set_value('NAMA_MATERIAL'); ?>" placeholder="Masukkan Nama MATERIAL">
                              <span class="badge badge-warning"><?php echo strip_tags(form_error('NAMA_MATERIAL')); ?></span>
                            </div>
                          </div>

                         <div class="form-group row">
                            <label for="nama_material" class="col-sm-2 col-form-label">Jumlah</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="JUMLAH" id="JUMLAH" value="<?php echo set_value('JUMLAH'); ?>" placeholder="Masukkan Jumlah">
                              <span class="badge badge-warning"><?php echo strip_tags(form_error('JUMLAH')); ?></span>
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="SATUAN" class="col-sm-2 col-form-label">Satuan</label>
                            <div class="col-sm-10">
                             
                              <select class="form-control" name="SATUAN" id="SATUAN" value="<?php echo set_value('SATUAN'); ?>" >
                                <option value="" disabled>Pilih Satuan</option>
                                <option value="M"<?php echo set_value('SATUAN'); ?>>M</option>
                                <option value="PC"<?php echo set_value('SATUAN'); ?>>PC</option>
                                <option value="BTG"<?php echo set_value('SATUAN'); ?>>BTG</option>
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

  //========================================Edit material Keluar==========================//
 else if ($page == 'bm_edit') {
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
  
            <form method="POST" action="<?php echo base_url('dashboard/bm_edit/' . $d['ID_MATERIAL_MASUK']); ?>" class="form-horizontal">
  
              <div class="card-body">
                <div class="form-group row">
                  <label for="ID_MATERIAL" class="col-sm-2 col-form-label">Pilih material</label>
                  <div class="col-sm-10" >
                    <select class="form-control" name="ID_MATERIAL" id="ID_MATERIAL" value="<?php echo form_dropdown('ID_MATERIAL', $ddmaterial, set_value('ID_MATERIAL',$d['ID_MATERIAL'])); ?>
                    
                    <span class="badge badge-warning"><?php echo strip_tags(form_error('ID_MATERIAL')); ?></span>
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
  ?>