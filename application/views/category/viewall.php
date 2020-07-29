<div class="container body-content">

  <div class="row">
    <h2>Kategori</h2>
    <a href="<?php echo base_url(); ?>index.php/category/insert" class="btn btn-danger" role="button">Add New</a>
  </div>

  <div class="row warzone">
      <div class="col-md-12">
        <table class="table table-hover" id="datatable">
            <thead>
                <tr>
                    <th>Kategori</th>
                <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $row) {?>
                    <tr>
                        <td><?php echo $row->category_desc; ?></td>
                        <td><a href="<?php echo base_url(); ?>index.php/category/update/<?php echo $row->category_id; ?>" class="btn btn-danger" role="button">Update</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
      </div>
  </div>
</div>