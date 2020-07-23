<div class="container body-content">

  <div class="row">
    <h2>Produk</h2>
    <a href="<?php echo base_url(); ?>index.php/product/insert" class="btn btn-danger btn-reg" role="button">Registrasi</a>
  </div>

  <div class="row warzone">
      <div class="col-md-12">
        <table class="table table-hover">
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
                <?php foreach ($product as $row) {?>
                    <tr>
                        <td><?php echo $row->product_id; ?></td>
                        <td><?php echo $row->product_name; ?></td>
                        <td><?php echo $row->vendor_id; ?></td>
                        <td><a href="<?php echo base_url(); ?>index.php/product/update/<?php echo $row->product_id; ?>" class="btn btn-danger" role="button">Update</a></td>
                        <td><a href="<?php echo base_url(); ?>index.php/product/detail/<?php echo $row->product_id; ?>" class="btn btn-danger" role="button">View</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
      </div>
  </div>
</div>