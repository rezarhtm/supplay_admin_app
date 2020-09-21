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

	<?php if (count($orders) > 0) : ?>
	<div class="row text-center">
		<div class="col-md-12">
			<h3>
				ID Transaksi/Order: <?= $orders[0]->transaction_id ?>
			</h3>
			<div class="badge badge-primary" style="font-size: 1rem;">
				<?= $transaction_status ?>
			</div>
		</div>
	</div>
	<?php endif ?>

	<?php if (count($orders) > 0) : ?>
		<form method="POST">
			<input type="text" hidden name="transaction_id" value="<?= $orders[0]->transaction_id ?>">
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
									<th scope="col">Unit</th>

									<th scope="col">Subtotal</th>

									<th scope="col">Diterima</th>
									<th scope="col">Diretur</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($orders as $order) : ?>
									<tr>
										<td>
											<input type="checkbox" name="checked_product[]" value="<?= $order->order_id ?>" id="checked_product" checked>
										</td>
										<td>
											<?= $order->product_name ?>
										</td>
										<td>
											<?= number_format($order->product_price) ?>
										</td>
										<td>
											<?= $order->qty ?>
										</td>
										<td>
											<?= $order->unit ?>
										</td>
										<td>
											<?= number_format($order->order_price) ?>
										</td>
										<td>
											<input type="number" name="diterima[]" value="<?= $order->jumlah_diterima != null ? $order->jumlah_diterima : $order->qty ?>" class="form-control">
										</td>
										<td>
											<input type="number" name="diretur[]" value="<?= $order->jumlah_diretur != null ? $order->jumlah_diretur : 0 ?>" class="form-control">
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>

						<?php if($transaction_status == 'SENT' || $transaction_status == 'RETURN'): ?>
						<div class="my-4">
							<button type="submit" onclick="return confirm('Submit transaksi?')" name="submit_transaction" value="submit" class="w-100 btn btn-success font-weight-bold">
								Submit
							</button>
						</div>
						<?php endif ?>
					</div>
				</div>
			</div>
		</form>
	<?php else : ?>
		<div class="row">
			<div class="col-md-12">
				Pesanan Kosong
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
