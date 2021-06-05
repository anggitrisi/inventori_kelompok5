<?php if ($this->session->userdata('msg'))
    echo "<span class='alert alert-success'>" . $this->session->userdata('msg') . "</span>";
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Petugas | <a href='<?= base_url(); ?>Petugas/tambah_petugas' class='btn btn-info'>
                        Tambah Petugas <i class="fa fa-plus"></i>
                    </a></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <table class="display table table-bordered table-striped dataTable" id="example1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Petugas</th>
                                <th>No Handphone</th>
                                <th>Alamat</th>
                                <th>Jabatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($jabatan as $jbt) : ?>
                                <tr>

                                    <td><?= $i; ?></td>
                                    <td><?= $jbt->nama_petugas; ?></td>
                                    <td><?= $jbt->no_telepon; ?></td>
                                    <td><?= $jbt->alamat; ?></td>
                                    <td><?php echo $jbt->GROUP_NAME; ?></td>

                                    <td><a href="<?= base_url() ?>Petugas/edit_petugas/<?= $jbt->id_petugas; ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                        <a data-toggle="modal" href="#deletePetugas<?= $jbt->id_petugas; ?>" data-url="" class="btn btn-danger confirm_delete" title="Hapus" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Hapus Petugas"><i class="fa fa-trash"></i></a>
                                        <a href="<?= base_url() ?>Petugas/detail_petugas/<?= $jbt->id_petugas; ?>" class="btn btn-primary"><i class=" fa fa-eye"></i> </a>

                                        <?php if ($jbt->STATUS == 0) : ?>
                                            <a href="<?= base_url(); ?>Petugas/aktifkan_petugas/<?= $jbt->id_petugas; ?>" class="btn btn-success ">
                                                <span class="icon text-white-50">
                                                    <i class="fa fa-check-circle"></i>
                                                </span>
                                                <span class="text">Aktifkan</span>
                                            </a>
                                        <?php endif; ?>
                                        <?php if ($jbt->STATUS == 1) : ?>
                                            <a href="<?= base_url(); ?>Petugas/nonaktifkan_petugas/<?= $jbt->id_petugas; ?>" class="btn btn-danger">
                                                <span class=" icon text-white-50">
                                                    <i class="fa fa-close"></i>
                                                </span>
                                                <span class="text">Nonaktifkan</span>
                                            </a>
                                        <?php endif; ?>

                                        <!-- Modal Hapus-->
                                        <div class="modal fade" id="deletePetugas<?= $jbt->id_petugas; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteBusLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body text-danger">
                                                        <h3>APAKAH ANDA YAKIN INGIN MENGHAPUS DATA PEtugas?</h3>
                                                        <h3>PERUBAHAN TIDAK DAPAT DIKEMBALIKAN</h3>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <a href="<?= base_url('Petugas/hapus_petugas/' . $jbt->id_petugas); ?>"><button type="button" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus data pasien ini?')">Ya</button></a>
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