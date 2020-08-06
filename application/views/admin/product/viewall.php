<div class="container body-content">

    <div class="row mx-2">
        <div class="mr-4">
            <h2>Produk</h2>
        </div>
        <div>
            <a href="<?php echo base_url(); ?>index.php/admin/product/insert" class="btn btn-danger btn-reg" role="button">Registrasi</a>
        </div>
    </div>

    <div class="row warzone">
        <div class="col-md-12">
            <table class="table table-hover" id="datatable">
                <thead>
                    <tr>
                        <th>ID Produk</th>
                        <th>Nama Produk</th>
                        <th>Vendor</th>
                        <th>Update</th>
                        <th>Tampilkan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($product as $row) { ?>
                        <tr>
                            <td><?php echo $row->product_id; ?></td>
                            <td><?php echo $row->product_name; ?></td>
                            <td><?php echo $row->vendor_id; ?></td>
                            <td><a href="<?php echo base_url(); ?>index.php/admin/product/update/<?php echo $row->product_id; ?>" class="btn btn-danger" role="button">Update</a></td>
                            <td><a href="<?php echo base_url(); ?>index.php/admin/product/detail/<?php echo $row->product_id; ?>" class="btn btn-danger" role="button">View</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>