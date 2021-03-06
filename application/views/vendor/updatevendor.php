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

  <h2 class="col-md-12 pagetitle" style="padding: 0; margin: 0;">Update Vendor</h2>
  <div class="row warzone">
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
          <input class="form-control" id="bank_id" required type="text" name="bank_id" value="<?php echo $vendor['bank_id']; ?>">
        </div>
        
        <div class="form-group">
          <label for="v_remarks">Catatan</label>
          <input class="form-control" id="v_remarks" type="text" name="v_remarks" value="<?php echo $vendor['v_remarks']; ?>">
        </div>
        <button type="submit" class="btn btn-success" name="submit">Submit</button>
      </form>
       
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 backto">
      <a href="<?php echo base_url(); ?>index.php/vendor" class="btn btn-danger" role="button">Kembali ke Daftar Vendor</a>
    </div>
  </div>


</div>