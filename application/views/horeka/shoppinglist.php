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
											<input type="checkbox" name="checked_product[]" value="<?= $list->product_id ?>" id="checked_product_<?= $list->product_id ?>" checked>
										</td>
										<td>
											<?= $list->product_name ?>
										</td>
										<td>
											<?= number_format($list->price_perunit) ?>
										</td>
										<td>
											<input type="number" name="buy_qty" id="qty_<?= $list->product_id ?>" class="form-control my-1" value="1">
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
							<button onclick='addtocart(<?php echo json_encode($shopping_list) ?>)' class="btn btn-primary w-100" type="button">
								Add to Cart
							</button>
						</div>

						<!-- <div class="my-4">
							<button type="submit" onclick="return confirm('Lakukan transaksi?')" name="submit_shopping_list" value="buy" class="w-100 btn btn-success font-weight-bold">
								BELI
							</button>
						</div> -->
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
	async function addtocart(x) {
		var alert_;
		var total_sukses = 0;
		var total_gagal = 0;
		var alasan_gagal;

		for (var index = 0; index < x.length; index++) {
			var p = x[index].product_id;
			var qty = $(`#qty_${p}`).val();
			var checked = $(`#checked_product_${p}`).is(':checked');
			if (checked) {
				var data = {
					buy_qty: qty,
					buy_product_id: p,
					add_to: 'cart'
				};
				await $.post('<?= base_url('index.php/horeka') ?>', data, function(response) {
					alert_ = $(response).find('.alert')[0].innerText;
					if(alert_ == 'cart added' || alert_ == 'cart_updated'){
						total_sukses++;
					}else{
						total_gagal++;
						alasan_gagal = 'Hapus Cart dari vendor lain terlebih dahulu';
					}
				});
			}
		}

		await alert('Sukses: ' + total_sukses + ' Gagal: ' + total_gagal + ' alasan gagal: ' + alasan_gagal);
	}

	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});

	$(document).ready(function() {
		$('#datatable').DataTable();
	});
</script>