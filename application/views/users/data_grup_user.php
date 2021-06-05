<?php if ($this->session->flashdata('message')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('message'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>


<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">

                <h3 class="box-title">Data Grup User | <button type="button" class="btn btn-info" data-toggle="modal" data-target="#tambah_data">
                        Tambah Grup User <i class="fa fa-plus"></i>
                    </button>
                    </a></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <table class="display table table-bordered table-striped dataTable" id="example1">
                        <thead>
                            <tr>
                                <th>Id Grup User</th>
                                <th>Nama Grup User</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($grup_user as $gu) : ?>
                                <tr>

                                    <td><?= $i; ?></td>
                                    <td><?= $gu->GROUP_NAME; ?></td>
                                    <td><a href="#editGrupUser<?= $gu->GROUP_ID; ?>" data-toggle='modal' class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                        <a data-toggle="modal" href="#deleteKategori<?= $gu->GROUP_ID; ?>" data-url="" class="btn btn-danger confirm_delete" title="Hapus" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Hapus Pegawai"><i class="fa fa-trash"></i></a>

                                        <!-- Modal Hapus-->
                                        <div class="modal fade" id="deleteKategori<?= $gu->GROUP_ID; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteBusLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body text-danger">
                                                        <h3>APAKAH ANDA YAKIN INGIN MENGHAPUS DATA PEGAWAI?</h3>
                                                        <h3>PERUBAHAN TIDAK DAPAT DIKEMBALIKAN</h3>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <a href="<?= base_url('User/hapus_grup_user/' . $gu->GROUP_ID); ?>"><button type="button" class="btn btn-danger">Ya</button></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END Modal -->

                                    <?php $i++;
                                endforeach; ?>
                    </table>

                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </div>
    <!-- /.col -->
</div>
<!-- page end-->



<?php foreach ($grup_user as $rows) : ?>

    <div class="modal fade" id="editGrupUser<?php echo $rows->GROUP_ID; ?>" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Edit Grup USer</h4>
                </div>
                <?php $attributes = array('class' => 'form-horizontal group-border hover-stripped', 'id' => 'myform', 'method' => 'post');
                echo form_open('user/update_grup_user', $attributes); ?>
                <div class="modal-body">
                    <div class='form-group'>
                        <label for='nama_kategori' class='col-lg-3 col-sm-3 control-label'>Nama Kategori</label>

                        <div class='col-lg-9'>
                            <input type='hidden' name="id_grup" class='form-control' id='id_grups' value='<?php echo $rows->GROUP_ID; ?>'>
                            <input type='text' name="GROUP_NAME" class='form-control' id='nama_grup' value='<?php echo $rows->GROUP_NAME; ?>'>
                        </div>
                    </div>
                </div>
                <br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" name="addNewKota" class="btn btn-primary" value="Simpan">
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>



<!-- Modal Add New Menu-->
<div class="modal fade" id="tambah_data" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Grup User</h4>

            </div>
            <form action="<?= base_url('User/insert_grup_user'); ?>" method="post">

                <div class="modal-body">

                    <div class='form-group'>
                        <label for='GROUP_NAME' class='col-lg-4 col-sm-3 control-label'>Nama Grup User</label>
                        <div class='col-lg-8'>

                            <input type='text' name="GROUP_NAME" required class='form-control' id='GROUP_NAMEs' placeholder="Masukkan Grup User">
                        </div>
                    </div>
                </div>
                <br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" name="addNewKota" class="btn btn-primary" value="Simpan">
                </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>