<section class="content">


    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    
                    <h3 class="profile-username text-center"><?php echo $empDetail->nama_supplier; ?></h3>
                    <p class="text-muted text-center"><?php echo $empDetail->nama_perusahaan; ?></p>
                    <p class="text-muted text-center"><?php echo $empDetail->email; ?></p>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

        <div class="col-md-9">
            <!-- About Me Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Tentang Supplier</h3>
                    <div class="text-right">
                        <a href="<?=base_url('Supplier/data_supplier')?>" class="btn btn-warning">Back</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-phone margin-r-5"></i> Phone</strong>

                    <p class="text-muted">
                        <?php if(empty($empDetail)){
                            echo "<span>NO record</span>";
                        }else{
                            echo $empDetail->no_telp;} ?>
                    </p>

                    <hr>

                    <strong><i class="fa fa-location-arrow"></i> Address</strong>

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
