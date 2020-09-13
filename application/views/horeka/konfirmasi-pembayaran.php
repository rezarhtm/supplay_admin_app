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
				Konfirmasi Pembayaran
			</h3>
		</div>
	</div>

	<?php echo form_open_multipart();?>
		<div class="row justify-content-center text-center my-3">
			<div class="col-md-6">
				<div class="form-group">
					<label for="id">ID Konfirmasi Pembayaran</label>
					<input required type="text" id="id" name="id" class="form-control" readonly>
				</div>
				<div class="form-group">
					<label for="invoice">Nomor Invoice</label>
					<input required type="text" id="invoice" name="invoice" class="form-control">
					<div class="form-group">
						<div class="list-group">
							<div class="list-group-item">
								<span class="float-left font-weight-bold">
									Nominal
								</span>
								<span class="float-right" id="detail-nominal"></span>
							</div>
							<div class="list-group-item">
								<span class="float-left font-weight-bold">
									Status
								</span>
								<span class="float-right" id="detail-status"></span>
							</div>
							<div class="list-group-item">
								<span class="float-left font-weight-bold">
									Tanggal Order
								</span>
								<span class="float-right" id="detail-tanggal"></span>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="jumlah">Jumlah Transfer</label>
					<input required type="number" id="jumlah" name="jumlah" class="form-control">
				</div>
				<div class="form-group">
					<label for="bank">Transfer ke Bank</label>
					<select required id="bank" name="bank" class="custom-select">
						<option value="bca">
							BCA
						</option>
						<option value="mandiri">
							Mandiri
						</option>
					</select>
				</div>
				<div class="form-group">
					<label for="bukti">Bukti pembayaran</label>
					<input required type="file" class="form-control-file" id="bukti" name="bukti">
				</div>

				<div>
					<button class="btn btn-primary w-100 font-weight-bold" type="submit" name="konfirmasi" value="submit">
						Konfirmasi
					</button>
				</div>
			</div>
		</div>
	</form>

</div>

<script>
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});

	$("#invoice").change(function(e) {
		var random = Math.floor(Math.random() * 100);
		var invoice = $("#invoice").val();
		var id = `${2}${invoice}${random}`;
		id = id.replace(/\s/g,'');

		$("#detail-nominal").text("");
		$("#detail-status").text("");
		$("#detail-tanggal").text("");

		$("#id").val("");

		$.ajax({
			url: `<?= site_url('api/invoice/detail/') ?>${invoice}`,
			type: 'GET',
			success: function(res) {
				if (res) {
					var data = JSON.parse(res);
					$("#detail-nominal").text(data.nominal);
					$("#detail-status").text(data.status);
					$("#detail-tanggal").text(data.tanggal);

					$("#id").val(id);
				}
			}
		});
	});
</script>
