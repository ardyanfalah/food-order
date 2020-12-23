<?php echo view('_partials/header'); ?>
<?php echo view('_partials/sidebar'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="">
                <div class="">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="m-0">Latest Transaction</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hovered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Tanggal</th>
                                            <th>Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        //foreach($latest_trx as $key => $row){ ?>
                                        <!-- <tr>
                                            <td><?php //echo $key + 1; ?></td>
                                            <td><?php //echo $row['product_name']; ?></td>
                                            <td><?php //echo date('j F Y', strtotime($row['trx_date'])); ?></td>
                                            <td><?php //echo "Rp. ".number_format($row['trx_price'], false, false, "."); ?></td>
                                        </tr> -->
                                        <?php //} ?>
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