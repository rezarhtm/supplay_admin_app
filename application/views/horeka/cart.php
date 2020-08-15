<div class="container my-4">
	<?php if (isset($status)) : ?>
		<div class="row notification">
			<div class="col-md-12">
				<div class="alert alert-<?php echo $status; ?>">
					<?php echo $message; ?>
				</div>
			</div>
		</div>
	<?php endif ?>
	<div class="row">
		<div class="col-md-12">
			<h3 class="text-center">
				Cart
			</h3>
		</div>
	</div>

	<?php if (count($carts) > 0) : ?>
		<form method="POST">
			<div class="row">
				<div class="col-md-12">
					<div class="mt-4">
						<table class="table" id="datatable">
							<thead>
								<tr>
									<th scope="col"></th>
									<th scope="col">Nama Produk</th>
									<th scope="col">Harga Per Unit</th>
									<th scope="col">Qty</th>
									<th scope="col">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($carts as $cart) : ?>
									<tr>
										<td>
											<input type="checkbox" name="checked_product[]" value="<?= $cart->product_id ?>" id="checked_product" checked>
										</td>
										<td>
											<?= $cart->product_name ?>
										</td>
										<td>
											<?= number_format($cart->price_perunit) ?>
										</td>
										<td>
											<?= $cart->cart_qty ?>
										</td>
										<td>
											<input type="text" name="product_id" value="<?= $cart->product_id ?>" hidden>
											<button onclick="return confirm('Hapus <?= $cart->product_name ?>?')" class="btn btn-danger" type="submit" value="delete" name="submit_cart">
												Hapus
											</button>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>

						<div class="my-4">
							<button type="submit" onclick="return confirm('Lakukan transaksi?')" name="submit_cart" value="buy" class="w-100 btn btn-success font-weight-bold">
								BELI
							</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	<?php else : ?>
		<div class="row">
			<div class="col-md-12">
				Cart Kosong
				<a href="../" class="w-100 btn btn-secondary font-weight-bold my-2">
					Tambah Produk
				</a>
			</div>
		</div>
	<?php endif ?>

</div>

<script>
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});

	$(document).ready(function() {
		$('#datatable').DataTable();
	});
</script>