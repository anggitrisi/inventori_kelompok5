<section class="content">


    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    
                    <h3 class="profile-username text-center"><?php echo $empDetail->nama_petugas; ?></h3>

                    <ul class="list-group list-group-unbordered">

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
                    <h3 class="box-title">Tentang Petugas</h3>
                    <div class="text-right">
                        <a href="<?=base_url('Petugas/data_petugas')?>" class="btn btn-warning">Back</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-phone margin-r-5"></i> Phone</strong>

                    <p class="text-muted">
                        <?php if(empty($empDetail)){
                            echo "<span>NO record</span>";
                        }else{
                            echo $empDetail->no_telepon;} ?>
                    </p>

                    <hr>

                    <strong><i class="fa fa-location-arrow"></i> Alamat</strong>

                    <p> <?php if(empty($empDetail)){
                            echo "<span>NO record</span>";
                        }else{
                            echo $empDetail->alamat;} ?></p>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>

</section>
