<div class="container body-content">

  <div class="row notification">
    <div class="col-md-12">
      <?php if (isset($data["status"])) { ?>
        <div class="alert alert-<?php echo $data["status"];?>">
          <?php echo $data["message"]; ?>
        </div> 
        <?php
      }  
      ?>
    </div>
  </row>

  <h2 class="col-md-12 pagetitle" style="padding: 0; margin: 0;">Update Bank</h2>
  <div class="row warzone">
    <div class="col-md-12">
      <form method="post">
        <div class="form-group">
          <label for="bank_name">Nama Bank </label>
          <input type="text" class="form-control" id="bank_name" required type="text" name="bank_name" value="<?php echo $bank['bank_name']; ?>">
        </div>
        <button type="submit" class="btn btn-success" name="submit">Submit</button>
      </form> 
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 backto">
      <a href="<?php echo base_url(); ?>index.php/bank" class="btn btn-danger" role="button">Back to Banks</a>
    </div>
  </div>


</div>