<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar'); ?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Detail Pemesanan</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Detail Pemesanan</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <?php 
            $inputs = session()->getFlashdata('inputs');
            $errors = session()->getFlashdata('errors');
            if(!empty($errors)){ ?>
            <div class="alert alert-danger" role="alert">
              Whoops! Ada kesalahan saat input data, yaitu:
              <?php  echo $errors ?>
            </div>
          <?php } ?>
          <div class="card">
            <?php echo form_open_multipart('transaction/update'); ?>
              <div class="card-header">Form Edit Status Pemesanan</div>
              <div class="card-body">
                <?php echo form_hidden('id_pmsn', $transaction['id_pmsn']); ?>
                <?php //echo $product['id_menu'] ?>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <?php echo form_label('Nama Admin ', 'Nama Admin '); ?>
                      <?php echo form_input('nama_admin', $transaction['nama_admin'], ['class' => 'form-control', 'placeholder' => 'Nama','disabled'=>'disabled']);   ?>
                    </div>
                    <div class="form-group">
                      <?php echo form_label('Nama Pelanggan', 'Nama Pelanggan'); ?>
                      <?php echo form_input('nama_plgn', $transaction['nama_plgn'], ['class' => 'form-control', 'placeholder' => 'Nama','disabled'=>'disabled']);   ?>
                    </div>
                    <div class="form-group">
                      <?php echo form_label('Harga Total', 'Harga Total'); ?>
                      <?php echo form_input('total_harga', $transaction['total_harga'], ['class' => 'form-control', 'placeholder' => 'Nama','disabled'=>'disabled']);   ?>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <?php echo form_label('Waktu Pemesanan', 'Status Pemesanan'); ?>
                      <?php echo form_input('waktu_pmsn', $transaction['waktu_pmsn'], ['class' => 'form-control', 'placeholder' => 'Waktu Pemesanan','disabled'=>'disabled']);   ?>
                    </div>
                    <div class="form-group">
                      <?php echo form_label('Waktu Bayar', 'Waktu Bayar'); ?>
                      <?php echo form_input('waktu_byr',  (!empty($transaction['waktu_byr'])) ? $transaction['waktu_byr'] : '-', ['class' => 'form-control', 'placeholder' => 'Waktu Bayar','disabled'=>'disabled']);   ?>
                    </div>
                    <div class="form-group">
                      <?php echo form_label('Waktu Datang', 'Waktu Datang'); ?>
                      <?php echo form_input('waktu_dtg', (!empty($transaction['waktu_dtg'])) ? $transaction['waktu_dtg'] : '-', ['class' => 'form-control', 'placeholder' => 'Waktu Datang','disabled'=>'disabled']);   ?>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    
                    <div class="form-group">
                      <?php echo form_label('Status', 'Status'); ?>
                      <?php echo form_dropdown('status_pemesanan', ['' => 'Pilih', 'Menunggu_Verifikasi' => 'Menunggu Verifikasi', 'Proses_Pembuatan' => 'Diproses', 'Selesai' => 'Selesai'], $transaction['status_pemesanan'], ['class' => 'form-control']); ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                  <a href="<?php echo base_url('transaction'); ?>" class="btn btn-outline-info">Back</a>
                  <button type="submit" class="btn btn-primary float-right">Update</button>
              </div>
            <?php echo form_close(); ?>
          </div>
          <div class="card">
                <div class="card-header">List Menu</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hovered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Menu</th>
                                    <th>Harga Menu</th>
                                    <th>Total Pesan</th>
                                    <th>Total Harga</th>
                                    <th>Rating Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach($details as $key => $row){ ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $row['nama_menu']; ?></td>
                                    <td><?php echo $row['harga_menu']; ?></td>
                                    <td><?php echo $row['jumlah_pesan']; ?></td>
                                    <td><?php echo $row['jumlah_harga_pesan']; ?></td>
                                    <td><?php echo $row['rating_status']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo view('_partials/footer'); ?>