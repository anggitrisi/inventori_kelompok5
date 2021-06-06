<?php if ($this->session->userdata('msg'))
    echo "<span class='alert alert-success'>" . $this->session->userdata('msg') . "</span>";
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Lokasi | 
                <?php if ($this->session->userdata('group_id') == '1' || $this->session->userdata('group_id') == '3'): ?>
                <a href='<?= base_url(); ?>Lokasi/tambah_lokasi' class='btn btn-info'>
                        Tambah Lokasi <i class="fa fa-plus"></i>
                    </a>
                <?php endif; ?>
                    </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <table class="display table table-bordered table-striped dataTable" id="example1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lokasi</th>
                                <th>Fakultas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($lokasi as $lks) : ?>
                                <tr>

                                    <td><?= $i; ?></td>
                                    <td><?= $lks->nama_lokasi; ?></td>
                                    <td><?= $lks->fakultas; ?></td>

                                    <?php if ($this->session->userdata('group_id') == '2'): ?>
                                    <td><a href="<?= base_url() ?>lokasi/detail_lokasi/<?= $lks->id_lokasi; ?>" class="btn btn-primary"><i class=" fa fa-eye"></i> </a></td>
                                    <?php endif;?>

                                    <?php if ($this->session->userdata('group_id') == '1' || $this->session->userdata('group_id') == '3'): ?>
                                    <td><a href="<?= base_url() ?>lokasi/edit_lokasi/<?= $lks->id_lokasi; ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                        <a data-toggle="modal" href="#deletelokasi<?= $lks->id_lokasi; ?>" data-url="" class="btn btn-danger confirm_delete" title="Hapus" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Hapus lokasi"><i class="fa fa-trash"></i></a>
                                        <a href="<?= base_url() ?>lokasi/detail_lokasi/<?= $lks->id_lokasi; ?>" class="btn btn-primary"><i class=" fa fa-eye"></i> </a>
                                    <?php endif;?>

                                        <!-- Modal Hapus-->
                                        <div class="modal fade" id="deletelokasi<?= $lks->id_lokasi; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteBusLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body text-danger">
                                                        <h3>APAKAH ANDA YAKIN INGIN MENGHAPUS DATA lokasi?</h3>
                                                        <h3>PERUBAHAN TIDAK DAPAT DIKEMBALIKAN</h3>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <a href="<?= base_url('lokasi/hapus_lokasi/' . $lks->id_lokasi); ?>"><button type="button" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus data pasien ini?')">Ya</button></a>
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