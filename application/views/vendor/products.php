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
				Management Produk
			</h3>
			<br>
			<a href="product/insert" class="btn btn-primary font-weight-bold">
				Tambah Produk
			</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<!-- <div class="my-4">
				<h4>
					Cari Produk
				</h4>
				<div>
					<form class="form-inline my-2 my-lg-0" id="cari">
						<input class="form-control mr-sm-2" style="width: 50%;" type="search" id="cari_input" placeholder="Produk" aria-label="Search">
						<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cari</button>
					</form>
				</div>
			</div> -->
			<div class="mt-4">
				<table class="table" id="datatable">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Nama Produk</th>
							<th scope="col">Price Perunit</th>
							<th scope="col">Unit</th>

							<th scope="col">Aksi</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});

	$(document).ready(function() {
		var dt = $('#datatable').DataTable({
			"processing": true,
			"serverSide": true,
			"order": [],

			"ajax": {
				"url": "<?php echo site_url('api/products') ?>",
				"type": "POST"
			},

			"columnDefs": [{
				"targets": -1,
				"searchable": false, 
				"orderable": false,
			}]
		});

		// $('#cari').submit(function(e) {
		// 	dt.search($('#cari_input').val()).draw();
		// 	e.preventDefault()
		// })
	});
</script>