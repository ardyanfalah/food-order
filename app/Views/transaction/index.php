<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Transaksi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Transaksi</li>
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
                        <div class="card-header">
                            List Transaksi
                            <a href="<?php echo base_url('product/create'); ?>" class="btn btn-primary float-right">Tambah</a>
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
                            <!-- <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <?php 
                                        // echo form_label('Category');
                                        // echo form_dropdown('category', $categories, $category, ['class' => 'form-control', 'id' => 'category']); 
                                    ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <?php 
                                        // echo form_label('Search');
                                        // $form_keyword = [
                                        //     'type'  => 'text',
                                        //     'name'  => 'keyword',
                                        //     'id'    => 'keyword',
                                        //     'value' => $keyword,
                                        //     'class' => 'form-control',
                                        //     'placeholder' => 'Enter keyword ...'
                                        // ];
                                        // echo form_input($form_keyword);
                                    ?>
                                    </div>
                                </div>
                            </div> -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-hovered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Admin</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Waktu Pesan</th>
                                            <th>Waktu Datang</th>
                                            <th>Waktu Bayar</th>
                                            <th>Status</th>
                                            <th>Harga Total</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach($transactions as $key => $row){ ?>
                                        <tr>
                                            <td><?php echo $key + 1; ?></td>
                                            <td><?php echo $row['nama_admin']; ?></td>
                                            <td><?php echo $row['nama_plgn']; ?></td>
                                            <td><?php echo $row['waktu_pmsn']; ?></td>
                                            <td><?php echo $row['waktu_dtg']; ?></td>
                                            <td><?php echo $row['waktu_byr']; ?></td>
                                            <td><?php echo $row['status_pemesanan']; ?></td>
                                            <td><?php echo $row['total_harga']; ?></td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="<?php echo base_url('transaction/edit/'.$row['id_pmsn']); ?>" class="btn btn-sm btn-success">
                                                        <i class="fa fa-edit"></i>
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
                                    <?php //echo $pager->links('product', 'bootstrap_pagination') ?> 
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