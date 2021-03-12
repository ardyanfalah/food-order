<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar'); ?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Detail Tempat</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Detail Tempat</li>
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
            <?php echo form_open_multipart('tempat/update'); ?>
              <div class="card-header">Form Edit Status Tempat</div>
              <div class="card-body">
                <?php echo form_hidden('id_tmpt', $tempat['id_tmpt']); ?>
                <?php //echo $product['id_menu'] ?>
                <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                      <?php echo form_label('Nomor Tempat ', 'Nomor Tempat'); ?>
                      <?php echo form_input('no_tmpt', $tempat['no_tmpt'], ['class' => 'form-control', 'placeholder' => 'Nomor Tempat','disabled'=>'disabled']);   ?>
                    </div>
                    <div class="form-group">
                      <?php echo form_label('Deskripsi', 'Deskripsi'); ?>
                      <?php echo form_input('deskripsi', $tempat['deskripsi'], ['class' => 'form-control', 'placeholder' => 'Deskripsi','disabled'=>'disabled']);   ?>
                    </div>
                  </div>
                <div class="row">
                  <div class="col-md-12">
                    
                    <div class="form-group">
                      <?php echo form_label('Status', 'Status'); ?>
                      <?php echo form_dropdown('status_tmpt', ['' => 'Pilih', 'Empty' => 'Tersedia', 'Reserved' => 'Dipesan'], $tempat['status_tmpt'], ['class' => 'form-control']); ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                  <a href="<?php echo base_url('tempat'); ?>" class="btn btn-outline-info">Back</a>
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