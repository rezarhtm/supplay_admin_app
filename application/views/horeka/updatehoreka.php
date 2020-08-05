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

  <h2 class="col-md-12 pagetitle" style="padding: 0; margin: 0;">Update Horeka</h2>
  <div class="row my-3">
    <div class="col-md-12">

      <form method="post">
        <div class="form-group">
          <label for="h_name">Nama Horeka</label>
          <input class="form-control" id="h_name" required type="text" name="h_name" value="<?php echo $horeka['h_name']; ?>">
        </div>
        <div class="form-group">
          <label for="h_npwp">NPWP </label>
          <input class="form-control" id="h_npwp" required type="text" name="h_npwp" value="<?php echo $horeka['h_npwp']; ?>">
        </div>
        <div class="form-group">
          <label for="h_username">Username</label>
          <input class="form-control" id="h_username" required type="text" name="h_username" value="<?php echo $horeka['h_username']; ?>">
        </div>
        <div class="form-group">
          <label for="h_pic_name">Nama Penanggungjawab</label>
          <input class="form-control" id="h_pic_name" required type="text" name="h_pic_name" value="<?php echo $horeka['h_pic_name']; ?>">
        </div>
        <div class="form-group">
          <label for="h_address">Alamat Lengkap</label>
          <textarea class="form-control" id="h_address" required name="h_address"><?php echo $horeka['h_address']; ?>
          </textarea>
        </div>
        <div class="form-group">
          <label for="h_biz_address">Alamat Penagihan</label>
          <textarea class="form-control" id="h_biz_address" required name="h_biz_address"><?php echo $horeka['h_biz_address']; ?>
          </textarea>
        </div>
        <div class="form-group">
          <label for="h_phone">Phone</label>
          <input class="form-control" id="h_phone" required type="text" name="h_phone" value="<?php echo $horeka['h_phone']; ?>">
        </div>
        <div class="form-group">
          <label for="h_fax">Fax</label>
          <input class="form-control" id="h_fax" required type="text" name="h_fax" value="<?php echo $horeka['h_fax']; ?>">
        </div>
        <div class="form-group">
          <label for="h_email">e-mail</label>
          <input class="form-control" id="h_email" required type="email" name="h_email" value="<?php echo $horeka['h_email']; ?>">
        </div>
        <div class="form-group">
          <label for="h_bank_acc">No. Rekening Bank</label>
          <input class="form-control" id="h_bank_acc" required type="text" name="h_bank_acc" value="<?php echo $horeka['h_bank_acc']; ?>">
        </div>
        <div class="form-group">
          <label for="bank_id">Bank</label>
          <select class="custom-select" id="bank_id" required type="text" name="bank_id">
            <?php foreach ($bank as $row) : ?>
              <option <?= $row->bank_id == $horeka['bank_id'] ? "selected" : "" ?> value="<?= $row->bank_id ?>">
                <?= $row->bank_name ?>
              </option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="form-group">
          <label for="remarks">Catatan</label>
          <input class="form-control" id="remarks" type="text" name="remarks" value="<?php echo $horeka['remarks']; ?>">
        </div>

        <div class="form-group">
          <label for="status_id">Status</label>
          <select name="status_id" id="status_id" class="custom-select">
            <option value="1" <?= $horeka['status_id'] == "1" ? "selected" : "" ?>>Aktif</option>
            <option value="0" <?= $horeka['status_id'] == "0" ? "selected" : "" ?>>Tidak Aktif</option>
          </select>
        </div>

        <div class="form-group">
          <label for="credit_score">Credit Score</label>
          <select name="credit_score" id="credit_score" class="custom-select">
            <option value="1" <?= $horeka['credit_score'] == "1" ? "selected" : "" ?>>1</option>
            <option value="2" <?= $horeka['credit_score'] == "2" ? "selected" : "" ?>>2</option>
            <option value="3" <?= $horeka['credit_score'] == "3" ? "selected" : "" ?>>3</option>
          </select>
        </div>
        <button type="submit" class="btn btn-success" name="submit">Submit</button>
        <div class="my-2">
          <a href="<?php echo base_url(); ?>index.php/admin/horeka" class="btn btn-danger" role="button">Kembali ke Daftar horeka</a>
        </div>
      </form>

    </div>
  </div>

</div>