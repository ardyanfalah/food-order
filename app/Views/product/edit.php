<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar'); ?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Edit Menu</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Menu</li>
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
              <ul>
              <?php foreach ($errors as $error) : ?>
                  <li><?= esc($error) ?></li>
              <?php endforeach ?>
              </ul>
            </div>
          <?php } ?>
          <div class="card">
            <?php echo form_open_multipart('product/update'); ?>
              <div class="card-header">Form Edit Produk</div>
              <div class="card-body">
                <?php echo form_hidden('id_menu', $product['id_menu']); ?>
                <?php //echo $product['id_menu'] ?>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <?php echo form_label('Image', 'Image'); ?>
                      <br>
                      <img src="<?php echo base_url('uploads/'.$product['gambar_menu']) ?>" class="img-fluid">
                      <br>
                      <br>
                      <?php echo form_label('Ganti Image', 'Ganti Image'); ?>
                      <?php echo form_upload('gambar_menu', $product['gambar_menu']); ?>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group"> 
                      <?php echo form_label('Jenis', 'Jenis'); ?>
                      <?php //echo form_dropdown('category_id', $categories, $product['category_id'], ['class' => 'form-control']); ?>
                      <?php echo form_dropdown('id_ktgr', $categories, $product['id_ktgr'], ['class' => 'form-control']); ?>
                      <?php //echo form_input('Jenis_Menu', $product['Jenis_Menu'], ['class' => 'form-control', 'placeholder' => 'Jenis Menu']); ?>
                    </div>
                    <div class="form-group">
                      <?php echo form_label('Nama', 'Nama'); ?>
                      <?php echo form_input('nama_menu', $product['nama_menu'], ['class' => 'form-control', 'placeholder' => 'Nama']); ?>
                    </div>
                    <div class="form-group">
                      <?php echo form_label('Harga', 'Harga'); ?>
                      <?php echo form_input('harga_menu', $product['harga_menu'], ['class' => 'form-control', 'placeholder' => 'harga_menu', 'type' => 'number']); ?>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <?php echo form_label('Status', 'Status'); ?>
                      <?php echo form_dropdown('status_Menu', ['' => 'Pilih', 'Active' => 'Active', 'Inactive' => 'Inactieve'], $product['status_Menu'], ['class' => 'form-control']); ?>
                    </div>
                    <div class="form-group">
                      <?php echo form_label('Deskripsi', 'Deskripsi'); ?>
                      <?php echo form_textarea('deskripsi_menu', $product['deskripsi_menu'], ['class' => 'form-control', 'placeholder' => 'Deskripsi']); ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                  <a href="<?php echo base_url('product'); ?>" class="btn btn-outline-info">Back</a>
                  <button type="submit" class="btn btn-primary float-right">Update</button>
              </div>
            <?php echo form_close(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo view('_partials/footer'); ?>