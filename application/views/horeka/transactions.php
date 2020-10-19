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
				Pesanan
			</h3>
			<br>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="modal fade" id="lihat-pesanan" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Transaksi #<span id="id-transaksi"></span></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div id="order-list"></div>
						</div>
					</div>
				</div>
			</div>
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
							<th scope="col">ID Transaksi</th>
							<th scope="col">Total Harga</th>
							<th scope="col">Status</th>
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
				"url": "<?= site_url('api/orders') ?>",
				"data": {
					"invoice": "<?= isset($_GET['invoice']) ? $_GET['invoice'] : null ?>"
				},
				"type": "POST"
			},

			// "columnDefs": [{
			// 	"targets": 0,
			// 	"searchable": false,
			// 	"orderable": false,
			// }, {
			// 	"targets": -1,
			// 	"searchable": false,
			// 	"orderable": false,
			// }]
		});

		// $('#cari').submit(function(e) {
		// 	dt.search($('#cari_input').val()).draw();
		// 	e.preventDefault()
		// })
	});
</script>
