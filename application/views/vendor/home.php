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
				Vendor - Dashboard
			</h3>
			<div class="my-3">
				<a href="vendor/products" class="btn btn-primary font-weight-bold">Management Produk</a>
				<a href="vendor/orders" class="btn btn-primary font-weight-bold">Management Order</a>
				<a href="" class="btn btn-primary font-weight-bold">Permohonan Pembayaran</a>
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