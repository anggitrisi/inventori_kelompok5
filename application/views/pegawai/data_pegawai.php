<?php if ($this->session->userdata('msg'))
    echo "<span class='alert alert-success'>" . $this->session->userdata('msg') . "</span>";
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Pegawai | <a href='<?= base_url(); ?>Pegawai/tambah_pegawai' class='btn btn-info'>
                        Tambah Pegawai <i class="fa fa-plus"></i>
                    </a></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <table class="display table table-bordered table-striped dataTable" id="example1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>email</th>
                                <th>No. Handphone</th>
                                <th>Alamat</th>
                                <th>Jenis Kelamin</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($pegawai as $pgw) : ?>
                                <tr>

                                    <td><?= $i; ?></td>
                                    <td><?= $pgw->EMP_NAME; ?></td>
                                    <td><?= $pgw->EMP_EMAIL; ?></td>
                                    <td><?= $pgw->EMP_CELL; ?></td>
                                    <td><?= $pgw->EMP_ADDRESS; ?></td>

                                    <?php if ($pgw->EMP_GENDER == "P") : ?>
                                        <td><?php echo "Perempuan"; ?></td>
                                    <?php else : ?>
                                        <td><?php echo "Laki-laki"; ?></td>
                                    <?php endif; ?>
                                    <td><a href="<?= base_url() ?>Pegawai/edit_pegawai/<?= $pgw->EMP_ID; ?>" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                        <a data-toggle="modal" href="#deletePegawai<?= $pgw->EMP_ID; ?>" data-url="" class="btn btn-danger confirm_delete" title="Hapus" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Hapus Pegawai"><i class="fa fa-trash"></i> Hapus</a>
                                        <a href="<?= base_url() ?>Pegawai/detail_pegawai/<?= $pgw->EMP_ID; ?>" class="btn btn-primary"><i class=" fa fa-eye"></i> </a>
                                        <?php if ($pgw->STATUS == 0) : ?>
                                            <a href="<?= base_url(); ?>Pegawai/aktifkan_pegawai/<?= $pgw->EMP_ID; ?>" class="btn btn-success ">
                                                <span class="icon text-white-50">
                                                    <i class="fa fa-check-circle"></i>
                                                </span>
                                                <span class="text">Aktifkan</span>
                                            </a>
                                        <?php endif; ?>
                                        <?php if ($pgw->STATUS == 1) : ?>
                                            <a href="<?= base_url(); ?>Pegawai/nonaktifkan_pegawai/<?= $pgw->EMP_ID; ?>" class="btn btn-danger">
                                                <span class=" icon text-white-50">
                                                    <i class="fa fa-close"></i>
                                                </span>
                                                <span class="text">Nonaktifkan</span>
                                            </a>
                                        <?php endif; ?>

                                        <!-- Modal Hapus-->
                                        <div class="modal fade" id="deletePegawai<?= $pgw->EMP_ID; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteBusLabel" aria-hidden="true">
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
                                                        <a href="<?= base_url('Pegawai/hapus_pegawai/' . $pgw->EMP_ID); ?>"><button type="button" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus data pasien ini?')">Ya</button></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END Modal -->
                                </tr>
                            <?php $i++;
                            endforeach; ?>
                        </tbody>
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