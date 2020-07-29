<div class="container body-content">

  <?php if (isset($status)) : ?>
    <div class="row notification">
      <div class="col-md-12">

        <div class="alert alert-<?php echo $status; ?>">
          <?php echo $message; ?>
        </div>
      </div>
    </div>
  <?php endif ?>

  <h2 class="col-md-12 pagetitle" style="padding: 0; margin: 0;">Update Bank</h2>
  <div class="row my-3">
    <div class="col-md-12">
      <form method="post">
        <div class="form-group">
          <label for="bank_name">Nama Bank </label>
          <input type="text" class="form-control" id="bank_name" required type="text" name="bank_name" value="<?php echo $bank['bank_name']; ?>">
        </div>
        <button type="submit" class="btn btn-success" name="submit">Submit</button>
        <div class="my-2">
          <a href="<?php echo base_url(); ?>index.php/bank" class="btn btn-danger" role="button">Back to Banks</a>
        </div>
      </form>
    </div>
  </div>

</div>