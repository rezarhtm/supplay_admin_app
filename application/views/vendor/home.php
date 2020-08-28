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
		<div class="col-md-3">
			Hello
		</div>
	</div>
</div>

<script>
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
</script>