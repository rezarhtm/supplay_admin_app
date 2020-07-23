<div class="container body-content">
    <?php foreach ($vendor as $row) {?>
        <div class="row">
            <div class="col-md-12">
            <h2><?php echo $row->vendor_id; ?></h2>
            </div>
            <div class="col-md-12">
            <h1><?php echo $row->v_name; ?></h1>
            </div>
        </div>

        <div class="row warzone">
            <div class="col-md-6">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>NPWP</th>
                            <td><?php echo $row->v_npwp; ?></td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td><?php echo $row->v_username; ?></td>
                        </tr>
                        <tr>
                            <th>Password</th>
                            <td>******</td>
                        </tr>
                        <tr>
                            <th>Nama Penanggungjawab</th>
                            <td><?php echo $row->v_pic_name; ?></td>
                        </tr>
                        <tr>
                            <th>Alamat Pengiriman</th>
                            <td><?php echo $row->v_address; ?></td>
                        </tr>
                        <tr>
                            <th>Alamat Kantor</th>
                            <td><?php echo $row->v_biz_address; ?></td>
                        </tr>
                        <!--
                        <tr>
                            <th>Propinsi</th>
                            <td><?php echo $row->v_province; ?></td>
                        </tr>
                        <tr>
                            <th>Kota</th>
                            <td><?php echo $row->v_city; ?></td>
                        </tr>
                        -->
                        <tr>
                            <th>Telepon</th>
                            <td><?php echo $row->v_phone; ?></td>
                        </tr>
                        <tr>
                            <th>Fax</th>
                            <td><?php echo $row->v_fax; ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo $row->v_email; ?></td>
                        </tr>
                        <tr>
                            <th>Bank</th>
                            <td><?php echo $row->bank_id; ?></td>
                        </tr>
                        <tr>
                            <th>Rekening</th>
                            <td><?php echo $row->v_bank_acc; ?></td>
                        </tr>
                        <tr>
                            <th>Catatan</th>
                            <td><?php echo $row->v_remarks; ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td><?php echo $row->status_id; ?></td>
                        </tr>
                    
                    </tbody>
                
                </table>
            </div>
            <div class="col-md-6">
            </div>
            <div class="col-md-12">
                <a href="<?php echo base_url(); ?>index.php/vendor/" class="btn btn-danger" role="button">Kembali</a>
            </div>

        </div>
    <?php } ?>
</div>