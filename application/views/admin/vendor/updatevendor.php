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

  <h2 class="col-md-12 pagetitle" style="padding: 0; margin: 0;">Update Vendor</h2>
  <div class="row my-3">
    <div class="col-md-12">

      <form method="post">
        <div class="form-group">
          <label for="v_name">Nama Vendor</label>
          <input class="form-control" id="v_name" required type="text" name="v_name" value="<?php echo $vendor['v_name']; ?>">
        </div>
        <div class="form-group">
          <label for="v_npwp">NPWP </label>
          <input class="form-control" id="v_npwp" required type="text" name="v_npwp" value="<?php echo $vendor['v_npwp']; ?>">
        </div>
        <div class="form-group">
          <label for="v_username">Username</label>
          <input class="form-control" id="v_username" required type="text" name="v_username" value="<?php echo $vendor['v_username']; ?>">
        </div>
        <div class="form-group">
          <label for="v_pic_name">Nama Penanggungjawab</label>
          <input class="form-control" id="v_pic_name" required type="text" name="v_pic_name" value="<?php echo $vendor['v_pic_name']; ?>">
        </div>
        <div class="form-group">
          <label for="v_address">Alamat Lengkap</label>
          <textarea class="form-control" id="v_address" required name="v_address"><?php echo $vendor['v_address']; ?>
          </textarea>
        </div>
        <div class="form-group">
          <label for="v_biz_address">Alamat Penagihan</label>
          <textarea class="form-control" id="v_biz_address" required name="v_biz_address"><?php echo $vendor['v_biz_address']; ?>
          </textarea>
        </div>
        <div class="form-group">
          <label for="v_phone">Phone</label>
          <input class="form-control" id="v_phone" required type="text" name="v_phone" value="<?php echo $vendor['v_phone']; ?>">
        </div>
        <div class="form-group">
          <label for="v_fax">Fax</label>
          <input class="form-control" id="v_fax" required type="text" name="v_fax" value="<?php echo $vendor['v_fax']; ?>">
        </div>
        <div class="form-group">
          <label for="v_email">e-mail</label>
          <input class="form-control" id="v_email" required type="email" name="v_email" value="<?php echo $vendor['v_email']; ?>">
        </div>
        <div class="form-group">
          <label for="v_bank_acc">No. Rekening Bank</label>
          <input class="form-control" id="v_bank_acc" required type="text" name="v_bank_acc" value="<?php echo $vendor['v_bank_acc']; ?>">
        </div>
        <div class="form-group">
          <label for="bank_id">Bank</label>
          <select class="custom-select" id="bank_id" required type="text" name="bank_id">
            <?php foreach ($bank as $row) : ?>
              <option <?= $row->bank_id == $vendor['bank_id'] ? "selected" : "" ?> value="<?= $row->bank_id ?>">
                <?= $row->bank_name ?>
              </option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="form-group">
          <label for="v_remarks">Catatan</label>
          <input class="form-control" id="v_remarks" type="text" name="v_remarks" value="<?php echo $vendor['v_remarks']; ?>">
        </div>

        <div class="form-group">
          <label for="">Status</label>
          <select name="status_id" id="status_id" class="custom-select">
            <option value="1" <?= $vendor['status_id'] == "1" ? "selected" : "" ?>>Aktif</option>
            <option value="0" <?= $vendor['status_id'] == "0" ? "selected" : "" ?>>Tidak Aktif</option>
          </select>
        </div>
        <button type="submit" class="btn btn-success" name="submit">Submit</button>
        <div class="my-2">
          <a href="<?php echo base_url(); ?>index.php/admin/vendor" class="btn btn-danger" role="button">Kembali ke Daftar Vendor</a>
        </div>
      </form>

    </div>
  </div>

</div>