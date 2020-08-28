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

  <div class="row mb-2 mx-2">
    <h2 class="col-md-12" class="mx-2">Registrasi Produk</h2>

    <div class="col-md-12">

      <form method="post">
        <div class="form-group">
          <?php
          #$data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
          $date = date("Y-m-d");
          $act = '10';
          $yy = substr($date, 2, 2);
          #$random = substr(str_shuffle($data), 0, 5);
          $random = rand(10000, 99999);
          ?>
          <label for="product_id">Product ID</label>
          <input class="form-control" id="product_id" required type="text" name="product_id" value="<?php echo $act . $yy . $random; ?>">
        </div>
        <div class="form-group">
          <label for="product_name">Nama Produk</label>
          <input class="form-control" id="product_name" required type="text" name="product_name">
        </div>

        <div class="form-group">
          <label for="vendor_id">Vendor</label>
          <div class="input-group mb-3">
          <?php if ($this->auth->hasRole('admin')) : ?>
            <div class="input-group-prepend">
              <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih</button>
              <div class="dropdown-menu">
                <?php foreach ($vendor_get as $vendor) : ?>
                  <span onclick="clickVendor(<?= $vendor->vendor_id ?>)" class="dropdown-item" style="cursor: pointer;">
                    <?= $vendor->vendor_id ?>
                  </span>
                <?php endforeach ?>
              </div>
            </div>
          <?php endif ?>
            
            <input type="text" value="<?= isset($current_vendor_id) ? $current_vendor_id : null ?>" id="vendor_id" name="vendor_id" class="form-control" <?= $this->auth->hasRole('admin') ? '' : 'readonly' ?> aria-label="Text input with dropdown button">
          </div>
        </div>
        <div class="form-group">
          <label for="product_desc">Deskripsi</label>
          <textarea class="form-control" id="product_desc" required type="text" name="product_desc"></textarea>
        </div>
        <div class="form-group">
          <label for="category_id">Kategori</label>
          <select name="category_id" id="category_id" class="custom-select">
            <?php foreach ($category_get as $category) : ?>
              <option value="<?= $category->category_id ?>">
                <?= $category->category_desc ?>
              </option>
            <?php endforeach ?>
          </select>
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

  <div class="row mx-4 mb-4">
    <div class="col-md-12 backto">
    <?php if($this->auth->hasRole('admin')): ?>
      <a href="<?php echo base_url(); ?>index.php/admin/product" class="btn btn-danger" role="button">Kembali ke Daftar Produk</a>
    <?php elseif($this->auth->hasRole('vendor')): ?>
      <a href="<?php echo base_url(); ?>index.php/vendor/products" class="btn btn-danger" role="button">Kembali ke Daftar Produk</a>
    <?php endif ?>
    </div>
  </div>

  <script>
    function clickVendor(vendor) {
      $("#vendor_id").val(vendor);
    }
  </script>

</div>