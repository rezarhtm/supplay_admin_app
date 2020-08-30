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
			<h3>
				Permohonan Pembayaran
			</h3>

			<div class="card my-4">
				<form method="post">
					<div class="card-body">
						<div class="form-group">
							<label>Jumlah Uang yang tersedia</label>
							<input class="form-control" disabled type="number" value="<?= $vendor['fund'] ?>">
						</div>
						<div class="form-group">
							<label for="request">Jumlah Request</label>
							<input id="request" required name="request" class="form-control" type="number">
						</div>
						<button type="submit" onclick="return confirm('Lakukan Permohonan Pembayaran?')" class="btn btn-primary w-100 font-weight-bold">
							Request
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
</script>