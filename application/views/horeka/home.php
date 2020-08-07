<div class="container my-4">
	<div class="row">
		<div class="col-md-9">
			<!-- <div>
				<h4>
					Shopping List
				</h4>
				<div>
					<div class="row">
						<div class="col-3">
							List 1
						</div>
						<div class="col-3">
							List 1
						</div>
						<div class="col-3">
							List 1
						</div>
					</div>
				</div>
			</div> -->
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
				<div class="modal" tabindex="-1" id="info_produk" role="dialog">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="detail_product_name">
									detail_product_name [ detail_product_id ]
								</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="my-1">
									<span class="font-weight-bold">
										Vendor ID
									</span>
									<span id="detail_vendor_id" class="float-right">
										detail_vendor_id
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
									<span id="detail_category_id" class="float-right">
										detail_category_id
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

								<div class="my-1">
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
								</div>

								<div class="mt-3 form-group">
									<label for="buy_qty">
										Kuantitas
									</label>
									<input id="buy_qty" type="number" class="form-control">
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-primary">Add to List</button>
								<button type="button" class="btn btn-success">Add to Cart</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="mt-4">
				<table class="table" id="datatable">
					<thead>
						<tr>
							<th scope="col">No</th>
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
		<div class="col-md-3">
			<div>
				Atas: data horeka (query dari tabel horeka)
			</div>
			<div>
				Bawah: berisi tagihan tagihan ( Jika credit scoring bernilai 1, maka horeka hanya punya 1 slot tagihan yang aktif. Berlaku sejumlah kelipatan )
			</div>
		</div>
	</div>
</div>