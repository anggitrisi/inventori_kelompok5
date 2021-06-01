<section class="content">


    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box">
                <div class="box-body box-profile">

                    <h3 class="profile-username text-center"><?php echo $userDetail->nama_petugas ?></h3>
                    <ul class="list-group list-group-unbordered">
                        <p class="text-muted text-center">id petugas ( <?php echo $userDetail->id_petugas ?> )
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

        <div class="col-md-9">
            <!-- About Me Box -->
            <div class="box ">
                <div class="box-header with-border">
                    <h3 class="box-title">Tentang user</h3>
                    <div class="text-right">
                        <a href="<?= base_url('user/tambah_user') ?>" class="btn btn-warning">Back</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-user"></i> Username</strong>
                    <p class="text-muted">
                        <?php if (empty($userDetail)) {
                            echo "<span>NO record</span>";
                        } else {
                            echo $userDetail->USER_NAME;
                        } ?>
                    </p>

                    <hr>

                    <strong><i class="fa fa-lock"></i> Password</strong>
                    <p> ******</p>

                    <hr>

                    <strong><i class="fa fa-gear"></i> Jabatan </strong>
                    <p><?php echo $userDetail->jabatan ?></p>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>

</section>