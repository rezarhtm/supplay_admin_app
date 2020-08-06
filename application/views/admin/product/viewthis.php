<div class="container body-content">
    <?php foreach ($product as $row) {?>
        <div class="row">
            <div class="col-md-12">
            <h2><?php echo $row->product_id; ?></h2>
            </div>
            <div class="col-md-12">
            <h1><?php echo $row->product_name; ?></h1>
            </div>
        </div>

        <div class="row warzone">
            <div class="col-md-6">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Vendor</th>
                            <td><?php echo $row->vendor_id; ?></td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td><?php echo $row->product_desc; ?></td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td><?php echo $row->category_id; ?></td>
                        </tr>
                        <tr>
                            <th>Jumlah / kuantitas</th>
                            <td><?php echo $row->qty; ?></td>
                        </tr>
                        <tr>
                            <th>Unit / Satuan</th>
                            <td><?php echo $row->unit; ?></td>
                        </tr>
                        <tr>
                            <th>Harga satuan</th>
                            <td><?php echo $row->price_perunit; ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td><?php echo $row->status_id; ?></td>
                        </tr>
                        <tr>
                            <th>Update terakhir</th>
                            <td><?php echo $row->updated_at; ?></td>
                        </tr>
                    
                    </tbody>
                
                </table>
            </div>
            <div class="col-md-6">
            </div>
            <div class="col-md-12">
                <a href="<?php echo base_url(); ?>index.php/admin/product/" class="btn btn-danger" role="button">Kembali</a>
            </div>

        </div>
    <?php } ?>
</div>