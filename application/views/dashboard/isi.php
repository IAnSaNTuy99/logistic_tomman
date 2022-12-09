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
                <!-- <h3><?php echo $jml_barang; ?></h3> -->

                <p>Jumlah Barang</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-people"></i>
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

//============================================Barang=================================================//
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
      <div class="card">
        <div class="card-body">
           <?= form_open_multipart('dashboard/uploaddata') ?>
            <div class="col-4">
              <input type="file" class="form-control-file" id="importexcel" name="importexcel" accept=".xlsx,.xls"></div>
              <div class="col">
                  <button type="submit" class="btn btn-primary">Import</button>
              </div>
              <div class="col">
                  <?= $this->session->flashdata('pesan'); ?>
              </div>
             
     
          <table id="datatable_01" class="table table-bordered">
            <thead>
              <tr>
                <th>NO</th>
                <th>Kode Material</th>
                <th>Nama Material</th>
                <th>Jumlah</th>
              </tr>
            </thead>
            <?php $i = 1;
            foreach ($barang as $data) { ?>
              <tr>
                <td><?= $i++; ?></td>
                <td><?php echo $data['ID_BARANG'] ?></td>
                <td><?php echo $data['NAMA_BARANG'] ?></td>
                <td><?php echo $data['JUMLAH'] ?></td>
              </tr>
            <?php
            }
            ?>
          </table>

        </div>
    </section>
  </div>

<?php
}

 