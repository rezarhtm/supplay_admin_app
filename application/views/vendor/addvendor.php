<div class="container">

  <?php if (isset($status)) : ?>
    <div class="row notification">
      <div class="col-md-12">

        <div class="alert alert-<?php echo $status; ?>">
          <?php echo $message; ?>
        </div>
      </div>
    </div>
  <?php endif ?>

  <div class="row mt-4 mb-2 mx-2">
    <h2 class="col-md-12" class="mx-2">Registrasi Vendor</h2>

    <div class="col-md-12">

      <form method="post">
        <div class="form-group">
          <?php
          #$data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
          $date = date("Y-m-d");
          $act = '4';
          $yy = substr($date, 2, 2);
          $mm = substr($date, 5, 2);
          #$random = substr(str_shuffle($data), 0, 5);
          $random = rand(100, 999);
          ?>
          <label for="vendor_id">Vendor ID</label>
          <input class="form-control" id="vendor_id" required type="text" name="vendor_id" value="<?php echo $act . $yy . $mm . $random; ?>">
        </div>
        <div class="form-group">
          <label for="v_name">Nama Vendor</label>
          <input class="form-control" id="v_name" required type="text" name="v_name">
        </div>
        <div class="form-group">
          <label for="v_npwp">NPWP</label>
          <input class="form-control" id="v_npwp" required type="text" name="v_npwp">
        </div>
        <div class="form-group">
          <label for="v_username">Username</label>
          <input class="form-control" id="v_username" required type="text" name="v_username">
        </div>
        <div class="form-group">
          <label for="v_pic_name">Nama Penanggungjawab</label>
          <input class="form-control" id="v_pic_name" required type="text" name="v_pic_name">
        </div>
        <div class="form-group">
          <label for="v_address">Alamat Lengkap</label>
          <textarea class="form-control" id="v_address" required type="text" name="v_address"></textarea>
        </div>
        <div class="form-group">
          <label for="v_biz_address">Alamat Penagihan</label>
          <textarea class="form-control" id="v_biz_address" required type="text" name="v_biz_address"></textarea>
        </div>
        <div class="form-group">
          <label for="v_phone">Telepon</label>
          <input class="form-control" id="v_phone" required type="text" name="v_phone">
        </div>
        <div class="form-group">
          <label for="v_fax">Fax</label>
          <input class="form-control" id="v_fax" required type="text" name="v_fax">
        </div>
        <div class="form-group">
          <label for="v_email">e-mail</label>
          <input class="form-control" id="v_email" required type="email" name="v_email">
        </div>
        <div class="form-group">
          <label for="v_bank_acc">No. Rekening Bank</label>
          <input class="form-control" id="v_bank_acc" required type="text" name="v_bank_acc">
        </div>
        <div class="form-group">
          <label for="bank_id">Bank</label>
          <select class="custom-select" id="bank_id" required type="text" name="bank_id">
            <?php foreach ($bank as $row) : ?>
              <option value="<?= $row->bank_id ?>">
                <?= $row->bank_name ?>
              </option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="form-group">
          <label for="v_remarks">Catatan</label>
          <input class="form-control" id="bank_id" type="text" name="v_remarks">
        </div>
        <button type="submit" class="btn btn-success" name="submit">Daftar</button>
      </form>

    </div>
  </div>

  <div class="row mx-4 mb-4">
    <div class="col-md-12 backto">
      <a href="<?php echo base_url(); ?>index.php/admin/vendor" class="btn btn-danger" role="button">Kembali ke Daftar Vendor</a>
    </div>
  </div>


</div>