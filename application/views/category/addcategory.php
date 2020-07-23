<div class="container body-content">

  <div class="row notification">
    <div class="col-md-12">
      <?php if (isset($status)) { ?>
        <div class="alert alert-<?php echo $status;?>">
          <?php echo $message; ?>
        </div> 
        <?php
      }  
      ?>
    </div>
  </row>

  <h2 class="col-md-12 pagetitle" style="padding: 0; margin: 0;">Add Category</h2>

  <div class="row warzone">
    <div class="col-md-12">

      <form method="post">
        <div class="form-group">
          <label for="category_desc">Nama Kategori </label>
          <input class="form-control" id="category_desc" required type="text" name="category_desc">
        </div>
        <button type="submit" class="btn btn-success" name="submit">Submit</button>
      </form>
       
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 backto">
      <a href="<?php echo base_url(); ?>index.php/category" class="btn btn-danger" role="button">Back to Categories</a>
    </div>
  </div>


</div>