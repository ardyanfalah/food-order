<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar'); ?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Detail Menu</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Detail Menu</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-4">
                  <img src="<?php echo base_url('uploads/'.$product['gambar_menu']) ?>" class="img-fluid">
                </div>
                <div class="col-md-8">
                  <dl class="dl-horizontal">
                    <dt>Jenis Menu</dt>
                    <dd><?php echo $product['nama_ktgr']; ?></dd>
                    <dt>Nama </dt>
                    <dd><?php echo $product['nama_menu']; ?></dd>
                    <dt>Harga </dt>
                    <dd><?php echo 'Rp. '.number_format($product['harga_menu']); ?></dd>		
                    <dt>Status </dt>
                    <dd><?php echo $product['status_Menu']; ?></dd>	   
                    <dt>Deskripsi </dt>
                    <dd><?php echo $product['deskripsi_menu']; ?></dd>             
                  </dl>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <a href="<?php echo base_url('product'); ?>" class="btn btn-outline-info float-right">Back</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo view('_partials/footer'); ?>