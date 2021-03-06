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

  <h2 class="col-md-12" style="padding: 0; margin: 0;">Registrasi Horeka</h2>

  <div class="row warzone">
    <div class="col-md-12">

      <form method="post">
        <div class="form-group">
          <?php
            #$data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $date = date("Y-m-d");
            $act = '6';
            $yy = substr($date, 2, 2);
            $mm = substr($date, 5, 2);
            #$random = substr(str_shuffle($data), 0, 5);
            $random = rand(100,999);
          ?>
          <label for="horeka_id">Horeka ID</label>
          <input class="form-control" id="horeka_id" required type="text" name="horeka_id" value="<?php echo $act.$yy.$mm.$random; ?>">
        </div>
        <div class="form-group">
          <label for="h_name">Nama Horeka</label>
          <input class="form-control" id="h_name" required type="text" name="h_name">
        </div>
        <div class="form-group">
          <label for="h_npwp">NPWP</label>
          <input class="form-control" id="h_npwp" required type="text" name="h_npwp">
        </div>
        <div class="form-group">
          <label for="h_username">Username</label>
          <input class="form-control" id="h_username" required type="text" name="h_username">
        </div>
        <div class="form-group">
          <label for="h_pic_name">Nama Penanggungjawab</label>
          <input class="form-control" id="h_pic_name" required type="text" name="h_pic_name">
        </div>
        <div class="form-group">
          <label for="h_address">Alamat Lengkap</label>
          <textarea class="form-control" id="h_address" required type="text" name="h_address"></textarea>
        </div>
        <div class="form-group">
          <label for="h_biz_address">Alamat Penagihan</label>
          <textarea class="form-control" id="h_biz_address" required type="text" name="h_biz_address"></textarea>
        </div>
        <div class="form-group">
          <label for="h_phone">Telepon</label>
          <input class="form-control" id="h_phone" required type="text" name="h_phone">
        </div>
        <div class="form-group">
          <label for="h_fax">Fax</label>
          <input class="form-control" id="h_fax" required type="text" name="h_fax">
        </div>
        <div class="form-group">
          <label for="h_email">e-mail</label>
          <input class="form-control" id="h_email" required type="email" name="h_email">
        </div>
        <div class="form-group">
          <label for="h_bank_acc">No. Rekening Bank</label>
          <input class="form-control" id="h_bank_acc" required type="text" name="h_bank_acc">
        </div>
        <div class="form-group">
          <label for="bank_id">Bank</label>
          <input class="form-control" id="bank_id" required type="text" name="bank_id">
        </div>
        
        <div class="form-group">
          <label for="remarks">Catatan</label>
          <input class="form-control" id="bank_id" type="text" name="remarks">
        </div>
        <button type="submit" class="btn btn-success" name="submit">Daftar</button>
      </form>
       
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 backto">
      <a href="<?php echo base_url(); ?>index.php/Horeka" class="btn btn-danger" role="button">Kembali ke Daftar Horeka</a>
    </div>
  </div>


</div>