<?php if ($this->session->flashdata('msg')) { ?>


    <div class="alert alert-success fade in">

        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

        <i class="fa-ok alert-icon s24"></i> <strong><?= $this->session->flashdata('msg'); ?></strong>

    </div>


<?php } ?>


<div class=row>

    <!-- Start .row -->

    <div class=col-lg-4>

        <!-- Start col-lg-12 -->

        <div class="panel panel-default toggle">

            <!-- Start .panel -->

            <div class=panel-heading>

                <h3 class=panel-title>Tambah User</h3>

            </div>

            <div class=panel-body>

                <?php $attributes = array('class' => 'form-horizontal group-border hover-stripped', 'id' => 'myform', 'method' => 'post');
                echo form_open('User/create_user', $attributes); ?>

                <div class=form-group>
                    <label class="col-lg-3 col-md-3 col-sm-13 control-label">Employee</label>
                    <div class="col-lg-7 col-md-7">
                        <select class="form-control select2" name="id_petugas" required>
                            <option value="">Pilih Petugas Inventaris</option>
                            <?php foreach ($petugas_tanpa_account as $petugas_tanpa_account) : ?>
                                <option value="<?= $petugas_tanpa_account->id_petugas ?>"><?= $petugas_tanpa_account->nama_petugas ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('id_petugas', '<small class="text-danger">', '</small>'); ?>
                    </div>


                </div>

                <div class=form-group>
                    <label class="col-lg-3 col-md-3 col-sm-13 control-label" required>Group</label>
                    <div class="col-lg-7 col-md-7">
                        <select class="form-control select2" name="id_group">
                            <option value="">Pilih Jabatan</option>
                            <?php foreach ($list_jabatan as $list_jabatan) : ?>
                                <option value="<?= $list_jabatan->GROUP_ID ?>"><?= $list_jabatan->GROUP_NAME ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('id_group', '<small class="text-danger">', '</small>'); ?>
                    </div>

                </div>

                <div class=form-group>

                    <label class="col-lg-3 col-md-3 col-sm-13 control-label">Username</label>

                    <div class="col-lg-7 col-md-7">
                        <input class=form-control name="username" placeholder="" autofocus>
                        <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                    </div>

                </div>

                <div class=form-group>

                    <label class="col-lg-3 col-md-3 col-sm-13 control-label">Password</label>
                    <div class="col-lg-7 col-md-7">
                        <input type=password name="password" class=form-control placeholder="">
                        <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                    </div>

                </div>

                <!-- End .form-group  -->

                <div class=form-group>

                    <label class="col-lg-2 col-md-2 col-sm-12 control-label"></label>

                    <div class="col-lg-2 col-md-2">

                        <div class=" form-group">
                            <div class="col-md-6">
                                <input type="submit" value="Save" name="Save" class="btn btn-info">
                            </div>
                        </div>

                    </div>

                </div>

                <?php form_close(); ?>

            </div>

        </div>

        <!-- End .panel -->

    </div>

    <!-- End col-lg-5 -->

    <div class=col-lg-8>

        <!-- col-lg-12 start here -->

        <div class="panel panel-default plain toggle panelClose panelRefresh">

            <!-- Start .panel -->

            <div class="panel-heading white-bg">

                <h4 class=panel-title>List User</h4>

            </div>

            <div class=panel-body>

                <table class="table display" id="example1">

                    <thead>

                        <tr>
                            <th>Nama petugas</th>
                            <th>Jabatan</th>
                            <th>Username</th>
                            <th>Actions
                            </th>

                    <tbody>
                        <?php foreach ($list_user as $list_user) : ?>

                            <tr class=gradeX>
                                <td><?= $list_user->nama_petugas ?>

                                <td><?= $list_user->GROUP_NAME ?>

                                <td><?= $list_user->USER_NAME ?>


                                <td><a href="<?= base_url() ?>user/edit_user/<?= $list_user->USER_ID; ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                    <a data-toggle="modal" href="#deleteuser<?= $list_user->USER_ID; ?>" data-url="" class="btn btn-danger confirm_delete" title="Hapus" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Hapus user"><i class="fa fa-trash"></i></a>
                                    <a href="<?= base_url() ?>user/detail_user/<?= $list_user->USER_ID; ?>" class="btn btn-primary"><i class=" fa fa-eye"></i> </a>
                                    <?php if ($list_user->STATUS == 0) : ?>
                                        <a href="<?= base_url(); ?>user/aktifkan_user/<?= $list_user->USER_ID; ?>" class="btn btn-success ">
                                            <span class="icon text-white-50">
                                                <i class="fa fa-check-circle"></i>
                                            </span>
                                            <span class="text">Aktifkan</span>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ($list_user->STATUS == 1) : ?>
                                        <a href="<?= base_url(); ?>user/nonaktifkan_user/<?= $list_user->USER_ID; ?>" class="btn btn-danger">
                                            <span class=" icon text-white-50">
                                                <i class="fa fa-close"></i>
                                            </span>
                                            <span class="text">Nonaktifkan</span>
                                        </a>
                                    <?php endif; ?>

                                    <!-- Modal Hapus-->
                                    <div class="modal fade" id="deleteuser<?= $list_user->USER_ID; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteBusLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body text-danger">
                                                    <h3>APAKAH ANDA YAKIN INGIN MENGHAPUS DATA USER INI?</h3>
                                                    <h3>PERUBAHAN TIDAK DAPAT DIKEMBALIKAN</h3>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <a href="<?= base_url('user/hapus_user/' . $list_user->USER_ID); ?>"><button type="button" class="btn btn-danger" onclick="">Ya</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END Modal -->
                                <?php endforeach; ?>
                            </tr>
                </table>

            </div>

        </div>

        <!-- End .panel -->

    </div>
</div>