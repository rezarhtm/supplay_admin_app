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
				Management Order
				<?php if (isset($_GET['status'])) : ?>
					<span class="text-capitalize"><?= $_GET['status'] == "pending" || $_GET['status'] == "running" ? "- " . $_GET['status'] . " Order" : null ?></span>
				<?php endif ?>
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
							<div class="mb-3">
								<div>
									<span class="font-weight-bold">Nama</span>
									<span class="float-right" id="horeka-name-transaksi"></span>
								</div>
								<div>
									<span class="font-weight-bold">Telepon</span>
									<span class="float-right" id="horeka-phone-transaksi"></span>
								</div>
								<div>
									<span class="font-weight-bold">Alamat</span>
									<span class="float-right" id="horeka-address-transaksi"></span>
								</div>

							</div>
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
							<th scope="col">Pesanan</th>
							<th scope="col">ID Transaksi</th>
							<th scope="col">Horeka</th>
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
					"status": "<?= isset($_GET['status']) ? $_GET['status'] : null ?>"
				},
				"type": "POST"
			},

			"columnDefs": [{
				"targets": 0,
				"searchable": false,
				"orderable": false,
			}, {
				"targets": -1,
				"searchable": false,
				"orderable": false,
			}]
		});

		$('#datatable tbody').on('click', '#btn-lihat-pesanan', function() {
			$("#order-list").text("");
			$("#id-transaksi").text("");

			$("#horeka-name-transaksi").text("");
			$("#horeka-phone-transaksi").text("");
			$("#horeka-address-transaksi").text("");

			var data = dt.row($(this).parents('tr')).data();
			var id = data[1];
			$.ajax({
					method: "GET",
					url: `<?= base_url() ?>/index.php/api/orders/detail/${id}`
				})
				.done(function(data) {
					var dx = JSON.parse(data);
					var d = dx.data;
					var h = dx.horeka;

					$("#id-transaksi").text(d[0].transaction_id);
					$("#horeka-name-transaksi").text(h.h_name);
					$("#horeka-phone-transaksi").text(h.h_phone);
					$("#horeka-address-transaksi").text(h.h_address);

					d.forEach(product => {
						var order = `
							<div class="card my-1">
								<div class="card-body">
									<div>
										<span>${product.product_name}</span>
										<span class="float-right">${product.product_price} <i class="fa fa-times mx-2"></i> ${product.qty}</span>
									</div>
								</div>
							</div>
						`;

						$("#order-list").append(order);
					});

					var order_1 = `
					<div class="mx-2 my-3">
						<span>Total Belanja</span>
						<span class="float-right">Rp. ${d[0].total_order}</span>
					</div>`;

					$("#order-list").append(order_1);
				});
		});

		// $('#cari').submit(function(e) {
		// 	dt.search($('#cari_input').val()).draw();
		// 	e.preventDefault()
		// })
	});
</script>