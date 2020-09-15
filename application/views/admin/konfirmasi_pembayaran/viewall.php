<div class="container body-content">

	<div class="row mx-2">
		<div class="mr-4">
			<h2>Konfirmasi Pembayaran</h2>
		</div>
	</div>

	<form method="POST">
		<div class="row warzone">
			<div class="col-md-12">
				<table class="table table-hover" id="datatable">
					<thead>
						<tr>
							<th>Nomor Invoice</th>
							<th>Jumlah Transfer</th>
							<th>Bank Tujuan</th>
							<th>Status</th>
							<th>Bukti Pembayaran</th>
							<th>Tanggal</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($konfirmasi_pembayaran as $each) : ?>
							<td>
								<?= $each->invoice_number ?>
							</td>
							<td>
								<?= number_format($each->jumlah_transfer) ?>
							</td>
							<td>
								<?= $each->bank_tujuan ?>
							</td>
							<td>
								<?= $each->status ?>
							</td>
							<td>
								<img width="100px" height="100px" src="<?= base_url('uploads/bukti_pembayaran/') . $each->bukti_pembayaran ?>">
							</td>
							<td>
								<?= $each->tanggal ?>
							</td>
							<!-- <td>
							<a href="<?= base_url('index.php/admin/konfirmasipembayaran/detail/') . $each->invoice_number ?>" class="btn btn-primary">
								Lihat
							</a>
						</td> -->
							<td>
								<input type="hidden" value="<?= $each->invoice_number ?>" name="invoice_number">
								<button onclick="return confirm('Ubah status menjadi unpaid?')" class="btn btn-danger font-weight-bold" name="submit" value="unpaid" type="submit">
									UNPAID
								</button>
								<button onclick="return confirm('Ubah status menjadi paid?')" class="btn btn-primary font-weight-bold" name="submit" value="paid" type="submit">
									PAID
								</button>
							</td>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</form>
</div>
<script>
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
</script>