<div class="container body-content">

  <div class="row">
    <h2>Horeka</h2>
    <a href="<?php echo base_url(); ?>index.php/horeka/insert" class="btn btn-danger" role="button">Registrasi</a>
  </div>

  <div class="row warzone">
      <div class="col-md-12">
        <table class="table table-hover" id="datatable">
            <thead>
                <tr>
                    <th>ID Horeka</th>
                    <th>Nama Perusahaan</th>
                    <th>Update</th>
                    <th>Tampilkan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($horeka as $row) {?>
                    <tr>
                        <td><?php echo $row->horeka_id; ?></td>
                        <td><?php echo $row->h_name; ?></td>
                        <td><a href="<?php echo base_url(); ?>index.php/horeka/update/<?php echo $row->horeka_id; ?>" class="btn btn-danger" role="button">Update</a></td>
                        <td><a href="<?php echo base_url(); ?>index.php/horeka/detail/<?php echo $row->horeka_id; ?>" class="btn btn-danger" role="button">View</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
      </div>
  </div>
</div>