<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar'); ?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Tambah Menu</h1>
        </div>
        <!-- <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Tambah Menu</li>
          </ol>
        </div> -->
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
              Ada kesalahan saat input data, yaitu:
              <ul>
              <?php foreach ($errors as $error) : ?>
                  <li><?= esc($error) ?></li>
              <?php endforeach ?>
              </ul>
            </div>
          <?php } ?>
          <?php echo form_open_multipart('product/store'); ?>
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group"> 
                    <?php 
                      echo form_label('Kategori', 'Kategori');
                      echo form_dropdown('id_ktgr', $categories, $inputs['id_ktgr'], ['class' => 'form-control']); 
                      // echo form_label('Jenis');
                      // $jenis_menu = [
                      //   'type'  => 'text',
                      //   'name'  => 'Jenis_Menu',
                      //   'id'    => 'Jenis_Menu',
                      //   'value' => $inputs['Jenis_Menu'],
                      //   'class' => 'form-control',
                      //   'placeholder' => 'Jenis'
                      // ];
                      // echo form_input($jenis_menu); 
                    ?>
                  </div>
                  <div class="form-group">
                    <?php 
                      echo form_label('Nama Menu');
                      $nama_menu = [
                        'type'  => 'text',
                        'name'  => 'nama_menu',
                        'id'    => 'nama_menu',
                        'value' => $inputs['nama_menu'],
                        'class' => 'form-control',
                        'placeholder' => 'Nama'
                      ];
                      echo form_input($nama_menu); 
                    ?>
                  </div>
                  <div class="form-group">
                    <?php 
                      echo form_label('Harga');
                      $harga_menu = [
                        'type'  => 'number',
                        'name'  => 'harga_menu',
                        'id'    => 'harga_menu',
                        'value' => $inputs['harga_menu'],
                        'class' => 'form-control',
                        'placeholder' => '0'
                      ];
                      echo form_input($harga_menu); 
                    ?>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <?php 
                      echo form_label('Status', 'Status');
                      echo form_dropdown('status_Menu', ['' => 'Pilih', 'Active' => 'Active', 'Inactive' => 'Inactive'], $inputs['status_Menu'], ['class' => 'form-control']); 
                    ?>
                  </div>
                  <div class="form-group">
                    <?php 
                      echo form_label('Gambar');
                      echo form_upload('gambar_menu', '', ['class' => 'form-control']); 
                    ?>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <?php 
                      echo form_label('Deskripsi'); 
                      $deskripsi_menu = [
                        'type'  => 'text',
                        'name'  => 'deskripsi_menu',
                        'id'    => 'deskripsi_menu',
                        'value' => $inputs['deskripsi_menu'],
                        'class' => 'form-control',
                        'placeholder' => 'Masukan deskripsi menu'
                      ];
                      echo form_textarea($deskripsi_menu);
                    ?>
                  </div>
                </div>
                </div>
                <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                <li class=""><a href="<?php echo base_url('product'); ?>" class="btn btn-outline-info">Kembali</a></li>
                &nbsp;&nbsp;&nbsp;
                <li class=""> <button type="submit" class="btn btn-primary float-right">Simpan</button></li>
                </ol>
                </div>
              </div>
              <?php echo form_close(); ?>
              <!-- <div class="row"> -->
               
              <!-- </div> -->
            </div>
         
          </div>
         
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo view('_partials/footer'); ?>