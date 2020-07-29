<div class="container body-content">

    <div class="row mx-2">
        <div class="mr-4">
            <h2>Bank</h2>
        </div>
        <div>
            <a href="<?php echo base_url(); ?>index.php/bank/insert" class="btn btn-danger" role="button">
                Add New
            </a>
        </div>
    </div>

    <div class="row warzone">
        <div class="col-md-12">
            <table class="table table-hover" id="datatable">
                <thead>
                    <tr>
                        <th>Bank</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($banks as $row) { ?>
                        <tr>
                            <td><?php echo $row->bank_name; ?></td>
                            <td><a href="<?php echo base_url(); ?>index.php/bank/update/<?php echo $row->bank_id; ?>" class="btn btn-danger" role="button">Update</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>