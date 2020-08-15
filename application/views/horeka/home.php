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
			<div>
				Atas: data horeka (query dari tabel horeka)
			</div>
			<div>
				Bawah: berisi tagihan tagihan ( Jika credit scoring bernilai 1, maka horeka hanya punya 1 slot tagihan yang aktif. Berlaku sejumlah kelipatan )
			</div>
		</div>
		<div class="col-md-9">
			<!-- Create Shopping List Modal -->
			<form method="POST">
				<div class="modal" tabindex="-1" id="create_shopping_list_modal" role="dialog">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">
									Create Shopping List
								</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label for="">
										Nama Shopping List
									</label>
									<input required type="text" name="shopping_list" class="form-control">

									<input type="text" value="create" name="status" hidden>
								</div>
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-primary">Create</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			<!-- Create Shopping List Modal -->

			<!-- Update Shopping List Modal -->
			<form method="POST">
				<div class="modal" tabindex="-1" id="update_shopping_list_modal" role="dialog">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">
									Update Shopping List
								</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label for="update_shopping_list_data">
										Nama Shopping List
									</label>
									<input type="text" id="update_shopping_list_id" name="shopping_list_id" hidden>
									<input required type="text" name="shopping_list" id="update_shopping_list_data" class="form-control">

									<input type="text" value="update" name="status" hidden>
								</div>
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-primary">Update</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			<!-- Update Shopping List Modal -->
			<h4>
				Shopping List
			</h4>
			<div class="mb-4">
				<ul class="list-group">
					<?php foreach ($shopping_list as $list) : ?>
						<li class="list-group-item">
							<div class="row">
								<div class="col-md-10" onclick="showShoppingProductsList(<?= $list->id ?>)" style="cursor: pointer;">
									<?= $list->name ?>
								</div>
								<div class="float-right col-md-2">
									<button class="btn btn-primary w-100 my-1" onclick="showEditShoppingListModal({id: <?= $list->id ?>, name: '<?= $list->name ?>'})">
										Edit
									</button>

									<form method="post">
										<input type="text" value="delete" name="status" hidden>
										<input type="text" value="<?= $list->id ?>" name="shopping_list_id" hidden>
										<button onclick="return confirm('Hapus <?= $list->name ?>?')" class="btn btn-danger w-100 my-1" type="submit">
											Hapus
										</button>
									</form>
								</div>
							</div>
						</li>
					<?php endforeach ?>
				</ul>
				<button class="btn btn-primary w-100 my-1" data-toggle="modal" data-target="#create_shopping_list_modal">
					Create
				</button>
			</div>
			<div>
				<h4>
					Cari Produk
				</h4>
				<div>
					<form class="form-inline my-2 my-lg-0" id="cari">
						<input class="form-control mr-sm-2" style="width: 50%;" type="search" id="cari_input" placeholder="Produk" aria-label="Search">
						<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cari</button>
					</form>
				</div>
			</div>
			<div>
				<form method="POST">
					<div class="modal" tabindex="-1" id="info_produk" role="dialog">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<!-- <div class="modal-header">
								<h5 class="modal-title" id="detail_product_name">
									detail_product_name [ detail_product_id ]
								</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div> -->
								<div class="modal-body">
									<!-- <div class="my-1">
									<span class="font-weight-bold">
										Vendor ID
									</span>
									<span id="detail_vendor_id" class="float-right">
										detail_vendor_id
									</span>
								</div> -->
									<div class="my-1">
										<span class="font-weight-bold">
											Nama Produk
										</span>
										<span id="detail_product_name" class="float-right">
											detail_product_name
										</span>
									</div>

									<div class="my-1">
										<span class="font-weight-bold">
											Deskripsi
										</span>
										<span id="detail_product_desc" class="float-right">
											detail_product_desc
										</span>
									</div>

									<div class="my-1">
										<span class="font-weight-bold">
											Kategori
										</span>
										<span id="detail_category_desc" class="float-right">
											detail_category_desc
										</span>
									</div>

									<div class="my-1">
										<span class="font-weight-bold">
											Jumlah / Kuantitas
										</span>
										<span id="detail_qty" class="float-right">
											detail_qty
										</span>
									</div>

									<div class="my-1">
										<span class="font-weight-bold">
											Unit / Satuan
										</span>
										<span id="detail_unit" class="float-right">
											detail_unit
										</span>
									</div>

									<div class="my-1">
										<span class="font-weight-bold">
											Harga Satuan
										</span>
										<span id="detail_price_perunit" class="float-right">
											detail_price_perunit
										</span>
									</div>

									<!-- <div class="my-1">
									<span class="font-weight-bold">
										Status
									</span>
									<span id="detail_status_id" class="float-right">
										detail_status_id
									</span>
								</div>

								<div class="my-1">
									<span class="font-weight-bold">
										Update Terakhir
									</span>
									<span id="detail_updated_at" class="float-right">
										detail_updated_at
									</span>
								</div> -->

									<div class="mt-3 form-group">
										<label for="buy_qty">
											Kuantitas
										</label>
										<input required id="buy_qty" name="buy_qty" type="number" value="1" class="form-control">
									</div>

									<div class="form-group">
										<select name="add_to_list_id" id="add_to_list_select" class="custom-select">
											<?php foreach ($shopping_list as $list) : ?>
												<option value="<?= $list->id ?>">
													<?= $list->name ?>
												</option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
								<div class="modal-footer">
									<input id="buy_product_id" name="buy_product_id" class="form-control" hidden>

									<button type="submit" value="list" name="add_to" class="btn btn-primary">Add to List</button>
									<button type="submit" value="cart" name="add_to" class="btn btn-success">Add to Cart</button>
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="mt-4">
				<table class="table" id="datatable">
					<thead>
						<tr>
							<!-- <th scope="col">No</th> -->
							<th scope="col">ID</th>
							<th scope="col">Nama Produk</th>
							<th scope="col">Harga Per Unit</th>
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

	function showEditShoppingListModal(data) {
		$("#update_shopping_list_id").val(data.id);
		$("#update_shopping_list_data").val(data.name);

		$("#update_shopping_list_modal").modal();
	}

	function showShoppingProductsList(id) {
		location.href = `<?= base_url() ?>index.php/horeka/shoppinglist/detail/${id}`;
	}

	$(document).ready(function() {
		var dt = $('#datatable').DataTable({
			"processing": true,
			"serverSide": true,
			"order": [],

			"ajax": {
				"url": "<?php echo site_url('horeka/api/products') ?>",
				"type": "POST"
			},

			"columnDefs": [{
				"targets": 0,
				"visible": false,
				"searchable": false
			}, {
				"targets": -1,
				'defaultContent': '<button class="btn btn-success" data-toggle="modal" id="btn-beli" data-target="#info_produk">BELI</button>'
			}, ],
		});

		$('#datatable tbody').on('click', 'button', function() {
			// $("#detail_product_id").text("");
			$("#detail_product_name").text("");
			// $("#detail_vendor_id").text("");
			$("#detail_product_desc").text("");
			$("#detail_category_desc").text("");
			$("#detail_qty").text("");
			$("#detail_unit").text("");
			$("#detail_price_perunit").text("");

			// $("#detail_updated_at").text("");
			// $("#detail_status_id").text("");

			$("#buy_product_id").text("");


			var data = dt.row($(this).parents('tr')).data();
			var id = data[0];
			$.ajax({
					method: "GET",
					url: `horeka/api/products/detail/${id}`
				})
				.done(function(data) {
					var d = JSON.parse(data);
					// $("#detail_product_id").text(d.product_id);
					$("#detail_product_name").text(d.product_name);
					// $("#detail_vendor_id").text(d.vendor_id);
					$("#detail_product_desc").text(d.product_desc);
					$("#detail_category_desc").text(d.category_desc);
					$("#detail_qty").text(d.qty);
					$("#detail_unit").text(d.unit);
					$("#detail_price_perunit").text(d.price_perunit);

					$("#buy_product_id").val(d.product_id);

					// $("#detail_updated_at").text(d.updated_at);
					// $("#detail_status_id").text(d.status_id);
				});
		});

		$('#cari').submit(function(e) {
			dt.search($('#cari_input').val()).draw();
			e.preventDefault()
		})
	});
</script>