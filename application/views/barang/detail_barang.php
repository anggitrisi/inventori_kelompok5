<section class="content">


    <div class="row">
        <div class="col-md-4">

            <!-- Profile Image -->
            <div class="box">
                <div class="box-body box-profile">

                    <h3 class="profile-username text-center"><?php echo $brgDetail->nama_barang; ?></h3>
                    <img src=" <?= base_url('assets_user/img/') . $brgDetail->gambar; ?>" class="img-fluid" alt="..." width="300" height="300>

                    <ul class=" list-group list-group-unbordered">

                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

        <div class="col-md-8">
            <!-- About Me Box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Detail Barang</h3>
                    <div class="text-right">
                        <a href="<?= base_url('barang/data_barang') ?>" class="btn btn-default">Back</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <strong>Merek &ensp;</strong>
                        </div>
                        <div class="col-md-1">
                            <strong>: &ensp;</strong>
                        </div>
                        <div class="col-md-8">
                            <p class="text-muted">
                                <?php if (empty($brgDetail)) {
                                    echo "<span> NO record</span>";
                                } else {
                                    echo $brgDetail->merek;
                                } ?>
                            </p>
                        </div>
                    </div>

                    <hr style="margin: 3px 0 3px 0;" />

                    <div class="row">
                        <div class="col-md-3">
                            <strong>Keterangan &ensp;</strong>
                        </div>
                        <div class="col-md-1">
                            <strong>: &ensp;</strong>
                        </div>
                        <div class="col-md-8">
                            <p class="text-muted">
                                <?php if (empty($brgDetail)) {
                                    echo "<span> NO record</span>";
                                } else {
                                    echo $brgDetail->keterangan;
                                } ?>
                            </p>
                        </div>
                    </div>

                    <hr style="margin: 3px 0 3px 0;" />

                    <div class="row">
                        <div class="col-md-3">
                            <strong>Kategori Barang &ensp;</strong>
                        </div>
                        <div class="col-md-1">
                            <strong>: &ensp;</strong>
                        </div>
                        <div class="col-md-8">
                            <p class="text-muted">
                                <?php if (empty($brgDetail)) {
                                    echo "<span> NO record</span>";
                                } else {
                                    echo $brgDetail->nama_kategori;
                                } ?>
                            </p>
                        </div>
                    </div>

                    <hr style="margin: 3px 0 3px 0;" />

                    <div class="row">
                        <div class="col-md-4">
                            <strong>Qrcode &ensp;</strong>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>Stok barang &ensp;</strong>
                                </div>
                                <p class="text-muted">
                                    <?php if (empty($brgDetail)) {
                                        echo "<span> NO record</span>";
                                    } else {
                                        echo $brgDetail->jumlah;
                                    } ?>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>

</section>