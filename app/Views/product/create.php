<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar'); ?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Tambah Menu</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Tambah Menu</li>
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
          <?php echo form_open_multipart('product/store'); ?>
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group"> 
                    <?php 
                      // echo form_label('Category', 'Category');
                      // echo form_dropdown('category_id', $categories, $inputs['category_id'], ['class' => 'form-control']); 
                      echo form_label('Jenis');
                      $jenis_menu = [
                        'type'  => 'text',
                        'name'  => 'Jenis_Menu',
                        'id'    => 'Jenis_Menu',
                        'value' => $inputs['Jenis_Menu'],
                        'class' => 'form-control',
                        'placeholder' => 'Jenis'
                      ];
                      echo form_input($jenis_menu); 
                    ?>
                  </div>
                  <div class="form-group">
                    <?php 
                      echo form_label('Nama');
                      $Nama_Menu = [
                        'type'  => 'text',
                        'name'  => 'Nama_Menu',
                        'id'    => 'Nama_Menu',
                        'value' => $inputs['Nama_Menu'],
                        'class' => 'form-control',
                        'placeholder' => 'Nama'
                      ];
                      echo form_input($Nama_Menu); 
                    ?>
                  </div>
                  <div class="form-group">
                    <?php 
                      echo form_label('Harga');
                      $Harga_Menu = [
                        'type'  => 'number',
                        'name'  => 'Harga_Menu',
                        'id'    => 'Harga_Menu',
                        'value' => $inputs['Harga_Menu'],
                        'class' => 'form-control',
                        'placeholder' => '0'
                      ];
                      echo form_input($Harga_Menu); 
                    ?>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <?php 
                      echo form_label('Status', 'Status');
                      echo form_dropdown('Status_Menu', ['' => 'Pilih', 'Active' => 'Active', 'Inactive' => 'Inactive'], $inputs['Status_Menu'], ['class' => 'form-control']); 
                    ?>
                  </div>
                  <div class="form-group">
                    <?php 
                      echo form_label('Image');
                      echo form_upload('Image_Menu', '', ['class' => 'form-control']); 
                    ?>
                  </div>
                </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <?php 
                      echo form_label('Description'); 
                      $Deskripsi_Menu = [
                        'type'  => 'text',
                        'name'  => 'Deskripsi_Menu',
                        'id'    => 'Deskripsi_Menu',
                        'value' => $inputs['Deskripsi_Menu'],
                        'class' => 'form-control',
                        'placeholder' => 'Product Description'
                      ];
                      echo form_textarea($Deskripsi_Menu);
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
                <a href="<?php echo base_url('product'); ?>" class="btn btn-outline-info">Back</a>
                <button type="submit" class="btn btn-primary float-right">Simpan</button>
            </div>
          </div>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo view('_partials/footer'); ?>