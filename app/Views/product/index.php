<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Menu</h1>
                </div>
                <!-- <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Products</li>
                    </ol>
                </div> -->
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Daftar Menu
                            <a href="<?php echo base_url('product/create'); ?>" class="btn btn-primary float-right">Tambah Menu</a>
                        </div>
                        <div class="card-body">
                        
                            <?php
                            if(!empty(session()->getFlashdata('success'))){ ?>
                            <div class="alert alert-success">
                                <?php echo session()->getFlashdata('success');?>
                            </div>     
                            <?php } ?>

                            <?php if(!empty(session()->getFlashdata('info'))){ ?>
                            <div class="alert alert-info">
                                <?php echo session()->getFlashdata('info');?>
                            </div>
                            <?php } ?>

                            <?php if(!empty(session()->getFlashdata('warning'))){ ?>
                            <div class="alert alert-warning">
                                <?php echo session()->getFlashdata('warning');?>
                            </div>
                            <?php } ?>
                            <div class="row">
                                <!-- <div class="col-md-6">
                                    <div class="form-group">
                                    <?php 
                                        // echo form_label('Category');
                                        // echo form_dropdown('category', $categories, $category, ['class' => 'form-control', 'id' => 'category']); 
                                    ?>
                                    </div>
                                </div> -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <?php 
                                        echo form_label('Cari Menu');
                                        $form_keyword = [
                                            'type'  => 'text',
                                            'name'  => 'keyword',
                                            'id'    => 'keyword',
                                            'value' => $keyword,
                                            'class' => 'form-control',
                                            'placeholder' => 'Masukan kata kunci ...'
                                        ];
                                        echo form_input($form_keyword);
                                    ?>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hovered">
                                    <thead>
                                        <tr>
                                            <th width="10px" class="text-center">No</th>
                                            <th>Gambar</th>
                                            <th>Nama Menu</th>
                                            <th>Kategori</th>
                                            <th>Harga</th>
                                            <th>Rating</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($products as $key => $row){ ?>
                                        <tr>
                                            <td class="text-center"><?php echo ++$nomor; ?></td>
                                            <td><img src="<?php echo base_url('uploads/'.$row['gambar_menu']) ?>" class="rounded-circle" width="50" height="50"></td>
                                            <td><?php echo $row['nama_menu']; ?></td>
                                            <td><?php echo $row['id_ktgr']; ?></td>
                                            <td><?php echo "Rp. ".number_format($row['harga_menu']); ?></td>
                                            <td><?php echo $row['rating']; ?></td>
                                            <td><?php echo $row['status_Menu']; ?></td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="<?php echo base_url('product/show/'.$row['id_menu']); ?>" class="btn btn-sm btn-info">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="<?php echo base_url('product/edit/'.$row['id_menu']); ?>" class="btn btn-sm btn-success">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="<?php echo base_url('product/delete/'.$row['id_menu']); ?>" class="btn btn-sm btn-danger" >
                                                        <i class="fa fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- <div class="row mt-3 float-right">
                                <div class="col-md-12">
                                    <?php//echo $pager->links('product', 'bootstrap_pagination') ?> 
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php echo view('_partials/footer'); ?>