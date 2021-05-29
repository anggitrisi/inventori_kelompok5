<section class="content">


    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    
                    <h3 class="profile-username text-center">Nama Lokasi</h3>
                    <?php echo $empDetail->nama_lokasi; ?>

                    <ul class="list-group list-group-unbordered">
                       
                        <li class="list-group-item">
                       
                        </li>

                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

        <div class="col-md-9">
            <!-- About Me Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Tentang Lokasi</h3>
                    <div class="text-right">
                        <a href="<?=base_url('lokasi/data_lokasi')?>" class="btn btn-warning">Back</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-phone margin-r-5"></i> Fakultas</strong>
                    <hr>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>

</section>
