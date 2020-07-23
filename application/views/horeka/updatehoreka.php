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

  <h2 class="col-md-12 pagetitle" style="padding: 0; margin: 0;">Update Horeka</h2>
  <div class="row warzone">
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
          <input class="form-control" id="bank_id" required type="text" name="bank_id" value="<?php echo $horeka['bank_id']; ?>">
        </div>
        
        <div class="form-group">
          <label for="remarks">Catatan</label>
          <input class="form-control" id="remarks" type="text" name="remarks" value="<?php echo $horeka['remarks']; ?>">
        </div>
        <button type="submit" class="btn btn-success" name="submit">Submit</button>
      </form>
       
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 backto">
      <a href="<?php echo base_url(); ?>index.php/horeka" class="btn btn-danger" role="button">Kembali ke Daftar horeka</a>
    </div>
  </div>


</div>