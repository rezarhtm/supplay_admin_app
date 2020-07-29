<div class="container body-content">

    <div class="row mx-2">
        <div class="mr-4">
            <h2>Vendor</h2>
        </div>
        <div>
            <a href="<?php echo base_url(); ?>index.php/vendor/insert" class="btn btn-success btn-reg" role="button">Registrasi</a>
        </div>
    </div>

    <div class="row warzone">
        <div class="col-md-12">
            <table class="table table-hover" id="datatable">
                <thead>
                    <tr>
                        <th>Vendor ID</th>
                        <th>Nama Vendor</th>
                        <th>Update</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vendor as $row) { ?>
                        <tr>
                            <td><?php echo $row->vendor_id; ?></td>
                            <td><?php echo $row->v_name; ?></td>
                            <td><a href="<?php echo base_url(); ?>index.php/vendor/update/<?php echo $row->vendor_id; ?>" class="btn btn-danger" role="button">Update</a></td>
                            <td><a href="<?php echo base_url(); ?>index.php/vendor/detail/<?php echo $row->vendor_id; ?>" class="btn btn-danger" role="button">View</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>