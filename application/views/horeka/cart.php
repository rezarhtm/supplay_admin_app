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
		<div class="row">
			<div class="col-md-12">
				<div class="mt-4">
					<table class="table" id="datatable">
						<thead>
							<tr>
								<th scope="col">Nama Produk</th>
								<th scope="col">Qty</th>
								<th scope="col">Harga Per Unit</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($carts as $cart) : ?>
								<tr>
									<td>
										<?= $cart->product_name ?>
									</td>
									<td>
										<?= $cart->cart_qty ?>
									</td>
									<td>
										<?= $cart->price_perunit ?>
									</td>
									<td>
										<form method="POST">
											<input type="text" name="product_id" value="<?= $cart->product_id ?>" hidden>
											<button onclick="return confirm('Hapus <?= $cart->product_name ?>?')" class="btn btn-danger" type="submit" value="delete" name="submit_cart">
												Hapus
											</button>
										</form>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>

					<div class="my-4">
						<button class="w-100 btn btn-success font-weight-bold">
							Lanjut Transaksi
						</button>
					</div>

				</div>
			</div>
		</div>

	<?php else: ?>
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