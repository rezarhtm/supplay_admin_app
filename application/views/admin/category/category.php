<div class="container body-content">

  <div class="row">
    <h2>Kategori</h2>
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#addnewcategory">Add New</button>

    <?php if (isset($status)) { ?>
      <div class="alert alert-<?php echo $status;?>">
        <?php echo $message; ?>
      </div> 
      <?php
    }  
    ?>

    <div class="modal" id="addnewcategory">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Add New Category</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          

          <div class="row modal-body">

          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-success" name="submit">Submit</button>
          </div>
      
        </div>
      </div>
    </div>

    <div class="modal" id="updatecategory">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Update Category</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            Modal body..
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>
  </div>
<!--
  <div class="row modal-body">
    <form method="post">
      <div class="row">
        <div class="form-group">
          <label for="category_desc">Nama Kategori: </label>
          <input class="form-control" id="category_desc" required type="text" name="category_desc">
        </div>
      </div>
      <button type="submit" class="btn-lg btn-success" name="submit">Submit</button>
    </form>
  </div>
-->

  <form method="post">
    <div class="row">
      <div class="form-group">
        <label for="category_desc">Nama Kategori </label>
        <input class="form-control" id="category_desc" required type="text" name="category_desc">
      </div>
    </div>
    <button type="submit" class="btn btn-success" name="submit">Submit</button>
  </form> 

  <table class="table table-hover">
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
        <td><a href="<?php echo base_url(); ?>main/update_data/<?php echo $row->id; ?>"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#updatecategory">Update</button></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>

</div>