<div class="container body-content">
    <?php foreach ($horeka as $row) {?>
        <div class="row">
            <div class="col-md-12">
            <h2><?php echo $row->horeka_id; ?></h2>
            </div>
            <div class="col-md-12">
            <h1><?php echo $row->h_name; ?></h1>
            </div>
        </div>

        <div class="row warzone">
            <div class="col-md-6">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>NPWP</th>
                            <td><?php echo $row->h_npwp; ?></td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td><?php echo $row->h_username; ?></td>
                        </tr>
                        <tr>
                            <th>Password</th>
                            <td>*****</td>
                        </tr>
                        <tr>
                            <th>Nama Penanggungjawab</th>
                            <td><?php echo $row->h_pic_name; ?></td>
                        </tr>
                        <tr>
                            <th>Alamat Pengiriman</th>
                            <td><?php echo $row->h_address; ?></td>
                        </tr>
                        <tr>
                            <th>Alamat Kantor</th>
                            <td><?php echo $row->h_biz_address; ?></td>
                        </tr>
                        <!--
                        <tr>
                            <th>Propinsi</th>
                            <td><?php echo $row->h_province; ?></td>
                        </tr>
                        <tr>
                            <th>Kota</th>
                            <td><?php echo $row->h_city; ?></td>
                        </tr>
                        -->
                        <tr>
                            <th>Telepon</th>
                            <td><?php echo $row->h_phone; ?></td>
                        </tr>
                        <tr>
                            <th>Fax</th>
                            <td><?php echo $row->h_fax; ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo $row->h_email; ?></td>
                        </tr>
                        <tr>
                            <th>Bank</th>
                            <td><?php echo $row->bank_id; ?></td>
                        </tr>
                        <tr>
                            <th>Rekening</th>
                            <td><?php echo $row->h_bank_acc; ?></td>
                        </tr>
                        <tr>
                            <th>Catatan</th>
                            <td><?php echo $row->remarks; ?></td>
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
                <?php if($this->auth->hasRole('admin')): ?>
                <a href="<?php echo base_url(); ?>index.php/admin/horeka" class="btn btn-danger" role="button">Kembali</a>
                <?php elseif($this->auth->hasRole('vendor')): ?>
                <a href="<?php echo base_url(); ?>index.php/vendor/orders" class="btn btn-danger" role="button">Kembali</a>
                <?php endif ?>
            </div>

        </div>
    <?php } ?>
</div>