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

  <h2 class="col-md-12 pagetitle" style="padding: 0; margin: 0;">Update Produk</h2>
  <div class="row warzone">
    <div class="col-md-12">

      <form method="post">
        <div class="form-group">
          <label for="product_name">Nama Produk</label>
          <input class="form-control" id="product_name" required type="text" name="product_name" value="<?php echo $product['product_name']; ?>">
        </div>
        <div class="form-group">
          <label for="vendor_id">Vendor</label>
          <input class="form-control" id="vendor_id" required type="text" name="vendor_id" value="<?php echo $product['vendor_id']; ?>">
        </div>
        <div class="form-group">
          <label for="product_desc">Deskripsi</label>
          <textarea class="form-control" id="product_desc" required name="product_desc"><?php echo $product['product_desc']; ?>
          </textarea>
        </div>
        <div class="form-group">
          <label for="category_id">Kategori</label>
          <input class="form-control" id="category_id" required type="text" name="category_id" value="<?php echo $product['category_id']; ?>">
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
      </form>
       
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 backto">
      <a href="<?php echo base_url(); ?>index.php/product" class="btn btn-danger" role="button">Kembali ke Daftar Produk</a>
    </div>
  </div>


</div>