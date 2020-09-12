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

	<?php if(count($transaction) < 1): ?>
	<form method="POST">
		<input type="text" hidden required value="<?= $transaction_id ?>" name="transaction_id">
		<div class="row justify-content-center text-center">
			<div class="col-md-12">
				<h4 class="font-weight-bold">
					Nilai Transaksi
				</h4>

				<div class="form-group">
					<div class="rating" style="font-size: 3rem; margin: 0 auto;"></div>
				</div>
				<div class="form-group">
					<label for="komentar">
						Komentar ( Opsional )
					</label>
					<textarea class="form-control w-50" style="margin: 0 auto;" name="komentar" id="komentar" rows="3"></textarea>
				</div>

				<input name="rate" hidden type="text" id="rate" required>

				<div>
					<button type="submit" name="submit_rating" value="submit" class="btn btn-primary font-weight-bold">
						Submit
					</button>
				</div>
			</div>
		</div>
	</form>
	<?php else: ?>
	<a href="<?= base_url('index.php/horeka/transactions') ?>" class="btn btn-primary">Kembali ke pesanan</a>
	<?php endif ?>
</div>

<script src="<?php echo base_url("public/rater.min.js"); ?>"></script>
<script>
	var options = {
		max_value: 5,
		step_size: 1,
		initial_value: 0,
		selected_symbol_type: 'utf8_star',
		cursor: 'default',
	}

	$(".rating").rate(options);

	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});

	$(".rating").on("change", function(ev, data) {
		$("#rate").val(data.to);
	});
</script>
