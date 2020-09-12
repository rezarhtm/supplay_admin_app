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
				Invoices
			</h3>
		</div>
	</div>

	<?php if (count($invoices) > 0) : ?>
		<form method="POST">
			<div class="row">
				<div class="col-md-12">
					<div class="mt-4">
						<table class="table" id="datatable">
							<thead>
								<tr>
									<th scope="col">Nomor Invoice</th>
									<th scope="col">Nominal</th>
									<th scope="col">Status</th>
									<th scope="col">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($invoices as $invoice) : ?>
									<tr>
										<td>
											<?= $invoice->invoice_number ?>
										</td>
										<td>
											<?= $invoice->nominal ?>
										</td>
										<td>
											<?= $invoice->status ?>
										</td>
										<td>
											<a href="<?= base_url('index.php/horeka/transactions/action/') . $invoice->transaction_id ?>" class="btn btn-primary">
												View
											</a>
											<button class="btn btn-secondary">
												Print
											</button>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>

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
				Tagihan Kosong
				<!-- <a href="../" class="w-100 btn btn-secondary font-weight-bold my-2">
					Tambah Produk
				</a> -->
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
