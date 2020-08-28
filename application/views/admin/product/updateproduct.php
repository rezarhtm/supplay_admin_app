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

  <h2 class="col-md-12 pagetitle" style="padding: 0; margin: 0;">Update Produk</h2>
  <div class="row my-3">
    <div class="col-md-12">

      <form method="post">
        <div class="form-group">
          <label for="product_name">Nama Produk</label>
          <input class="form-control" id="product_name" required type="text" name="product_name" value="<?php echo $product['product_name']; ?>">
        </div>
        <div class="form-group">
          <label for="vendor_id">Vendor</label>
          <div class="input-group mb-3">
            <?php if($this->auth->hasRole('admin')): ?>
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
            <input value="<?= $product['vendor_id'] ?>" type="text" id="vendor_id" name="vendor_id" class="form-control" <?= $this->auth->hasRole('admin') ? '' : 'readonly' ?> aria-label="Text input with dropdown button">
          </div>
        </div>
        <div class="form-group">
          <label for="product_desc">Deskripsi</label>
          <textarea class="form-control" id="product_desc" required name="product_desc"><?php echo $product['product_desc']; ?></textarea>
        </div>
        <div class="form-group">
          <label for="category_id">Kategori</label>
          <select name="category_id" id="category_id" class="custom-select">
            <?php foreach ($category_get as $category) : ?>
              <option <?= $product['category_id'] == $category->category_id ? "selected" : "" ?> value="<?= $category->category_id ?>">
                <?= $category->category_desc ?>
              </option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="form-group">
          <label for="qty">Jumlah / kuantitas</label>
          <input class="form-control" id="qty" required type="text" name="qty" value="<?php echo $product['qty']; ?>">
        </div>
        <div class="form-group">
          <label for="unit">Unit / satuan</label>
          <input class="form-control" id="unit" required type="text" name="unit" value="<?php echo $product['unit']; ?>">
        </div>
        <div class="form-group">
          <label for="price_perunit">Harga satuan</label>
          <input class="form-control" id="price_perunit" required type="text" name="price_perunit" value="<?php echo $product['price_perunit']; ?>">
        </div>
        <div class="form-group">
          <label for="status_id">Status</label>
          <input class="form-control" id="status_id" required type="text" name="status_id" value="<?php echo $product['status_id']; ?>">
        </div>
        <button type="submit" class="btn btn-success" name="submit">Submit</button>
        <div class="my-2">
          <?php if($this->auth->hasRole('admin')): ?>
            <a href="<?php echo base_url(); ?>index.php/admin/product" class="btn btn-danger" role="button">Kembali ke Daftar Produk</a>
          <?php elseif($this->auth->hasRole('vendor')): ?>
            <a href="<?php echo base_url(); ?>index.php/vendor/products" class="btn btn-danger" role="button">Kembali ke Daftar Produk</a>
          <?php endif ?>
        </div>
      </form>

    </div>
  </div>

  <script>
    function clickVendor(vendor) {
      $("#vendor_id").val(vendor);
    }
  </script>


</div>