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
				Shopping List
			</h3>
			<?php if (count($shopping_list) > 0) : ?>
				<h4 class="text-center">
					<?= $shopping_list[0]->shopping_list_name ?>
				</h4>
			<?php endif ?>
		</div>
	</div>

	<?php if (count($shopping_list) > 0) : ?>
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
									<th scope="col">Input Qty</th>
									<th scope="col">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($shopping_list as $list) : ?>
									<tr>
										<td>
											<input type="checkbox" name="checked_product[]" value="<?= $list->product_id ?>" id="checked_product" checked>
										</td>
										<td>
											<?= $list->product_name ?>
										</td>
										<td>
											<?= number_format($list->price_perunit) ?>
										</td>
										<td>
											<input type="number" name="qty[]" class="form-control" value="0">
										</td>
										<td>
											<form method="POST">
												<input type="text" name="product_id" value="<?= $list->product_id ?>" hidden>
												<button onclick="return confirm('Hapus <?= $list->product_name ?>?')" class="btn btn-danger" type="submit" value="delete" name="submit_shopping_list">
													Hapus
												</button>
											</form>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>

						<div class="my-4">
							<button type="submit" onclick="return confirm('Lakukan transaksi?')" name="submit_shopping_list" value="buy" class="w-100 btn btn-success font-weight-bold">
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
				Shopping List Kosong
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