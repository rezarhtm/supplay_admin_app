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

  <h2 class="col-md-12" style="padding: 0; margin: 0;">Registrasi Produk</h2>

  <div class="row warzone">
    <div class="col-md-12">

      <form method="post">
        <div class="form-group">
          <?php
            #$data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $date = date("Y-m-d");
            $act = '10';
            $yy = substr($date, 2, 2);
            #$random = substr(str_shuffle($data), 0, 5);
            $random = rand(10000,99999);
          ?>
          <label for="product_id">Product ID</label>
          <input class="form-control" id="product_id" required type="text" name="product_id" value="<?php echo $act.$yy.$random; ?>">
        </div>
        <div class="form-group">
          <label for="product_name">Nama Produk</label>
          <input class="form-control" id="product_name" required type="text" name="product_name">
        </div>
        <div class="form-group">
          <label for="vendor_id">Vendor</label>
          <!--<input class="form-control" id="vendor_id" required type="text" name="vendor_id">-->
          
          <?php
            $vendor_attribute = 'class="form-control"';
            echo form_dropdown('vendor_id', $vendor_get, $vendor_selected);
          ?>
        </div>
        <div class="form-group">
          <label for="product_desc">Deskripsi</label>
          <textarea class="form-control" id="product_desc" required type="text" name="product_desc"></textarea>
        </div>
        <div class="form-group">
          <label for="category_id">Kategori</label>
          <?php
            $category_attribute = 'class="form-control"';
            echo form_dropdown('category_id', $category_get, $category_selected);
          ?>
        </div>

        <div class="form-group">
          <label for="qty">Jumlah / Kuantitas</label>
          <input class="form-control" id="qty" required type="text" name="qty">
        </div>
        <div class="form-group">
          <label for="unit">Satuan / Unit</label>
          <input class="form-control" id="unit" required type="text" name="unit">
        </div>
        <div class="form-group">
          <label for="price_perunit">Harga satuan</label>
          <input class="form-control" id="price_perunit" required type="text" name="price_perunit">
        </div>
        <button type="submit" class="btn btn-success" name="submit">Daftar</button>
      </form>
       
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 backto">
      <a href="<?php echo base_url(); ?>index.php/product" class="btn btn-danger" role="button">Kembali ke Daftar Produk</a>
    </div>
  </div>


</div>