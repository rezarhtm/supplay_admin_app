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
				Cara Pembayaran
			</h3>
		</div>
	</div>


	<form method="POST">
		<div class="row">
			<div class="col-md-12">
				<div class="accordion" id="accordionExample">
					<div class="card">
						<div class="card-header" id="headingOne">
							<h2 class="mb-0">
								<button class="btn btn-link w-100 text-left" type="button" data-toggle="collapse" data-target="#bca" aria-expanded="true" aria-controls="bca">
									Bank BCA
								</button>
							</h2>
						</div>

						<div id="bca" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
							<div class="card-body">
								Silahkan Transfer ke Rekening BCA <b>1234567890</b>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" id="headingOne">
							<h2 class="mb-0">
								<button class="btn btn-link w-100 text-left" type="button" data-toggle="collapse" data-target="#mandiri" aria-expanded="true" aria-controls="mandiri">
									Bank Mandiri
								</button>
							</h2>
						</div>

						<div id="mandiri" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
							<div class="card-body">
								Silahkan Transfer ke Rekening Mandiri <b>1234567890</b>
							</div>
						</div>
					</div>
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
</script>
