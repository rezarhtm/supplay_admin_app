  <script>
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
          "targets": [0],
          "orderable": false,
        }, {
          "targets": -1,
          'defaultContent': '<button class="btn btn-success" data-toggle="modal" id="btn-beli" data-target="#info_produk">BELI</button>'
        }, ],
      });

      $('#datatable tbody').on('click', 'button', function() {
        // $("#detail_product_id").text("");
        $("#detail_product_name").text("");
        $("#detail_vendor_id").text("");
        $("#detail_product_desc").text("");
        $("#detail_category_id").text("");
        $("#detail_qty").text("");
        $("#detail_unit").text("");
        $("#detail_price_perunit").text("");

        $("#detail_updated_at").text("");
        $("#detail_status_id").text("");


        var data = dt.row($(this).parents('tr')).data();
        var id = data[1];
        $.ajax({
            method: "GET",
            url: `horeka/api/products/detail/${id}`
          })
          .done(function(data) {
            var d = JSON.parse(data);
            // $("#detail_product_id").text(d.product_id);
            $("#detail_product_name").text(`${d.product_name} [ ${d.product_id} ]`);
            $("#detail_vendor_id").text(d.vendor_id);
            $("#detail_product_desc").text(d.product_desc);
            $("#detail_category_id").text(d.category_id);
            $("#detail_qty").text(d.qty);
            $("#detail_unit").text(d.unit);
            $("#detail_price_perunit").text(d.price_perunit);

            $("#detail_updated_at").text(d.updated_at);
            $("#detail_status_id").text(d.status_id);
          });
      });

      $('#cari').submit(function(e) {
        dt.search($('#cari_input').val()).draw();
        e.preventDefault()
      })
    });

    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>
  </body>

  </html>