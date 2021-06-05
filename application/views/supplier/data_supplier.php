<?php if ($this->session->userdata('msg'))
    echo "<span class='alert alert-success'>" . $this->session->userdata('msg') . "</span>";
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data supplier | <a href='<?= base_url(); ?>Supplier/tambah_supplier' class='btn btn-info'>
                        Tambah supplier <i class="fa fa-plus"></i>
                    </a></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <table class="display table table-bordered table-striped dataTable" id="example1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Suppliers</th>
                                <th>Nama Perusahaan</th>
                                <th>Email</th>
                                <th>No Handphone</th>
                                <th>Alamat</th>
                                <th width="220px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($supplier as $spl) : ?>
                                <tr>

                                    <td><?= $i; ?></td>
                                    <td><?= $spl->nama_supplier; ?></td>
                                    <td><?= $spl->nama_perusahaan; ?></td>
                                    <td><?= $spl->email; ?></td>
                                    <td><?= $spl->no_telp; ?></td>
                                    <td><?= $spl->alamat; ?></td>

                                    <td><a href="<?= base_url() ?>Supplier/edit_supplier/<?= $spl->id_supplier; ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                        <a data-toggle="modal" href="#deletesupplier<?= $spl->id_supplier; ?>" data-url="" class="btn btn-danger confirm_delete" title="Hapus" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Hapus supplier"><i class="fa fa-trash"></i></a>
                                        <a href="<?= base_url() ?>Supplier/detail_supplier/<?= $spl->id_supplier; ?>" class="btn btn-primary"><i class=" fa fa-eye"></i> </a>
                                        <?php if ($spl->STATUS == 0) : ?>
                                            <a href="<?= base_url(); ?>Supplier/aktifkan_supplier/<?= $spl->id_supplier; ?>" class="btn btn-success ">
                                                <span class="icon text-white-50">
                                                    <i class="fa fa-check-circle"></i>
                                                </span>
                                                <span class="text">Aktifkan</span>
                                            </a>
                                        <?php endif; ?>
                                        <?php if ($spl->STATUS == 1) : ?>
                                            <a href="<?= base_url(); ?>Supplier/nonaktifkan_supplier/<?= $spl->id_supplier; ?>" class="btn btn-danger">
                                                <span class=" icon text-white-50">
                                                    <i class="fa fa-close"></i>
                                                </span>
                                                <span class="text">Nonaktifkan</span>
                                            </a>
                                        <?php endif; ?>

                                        <!-- Modal Hapus-->
                                        <div class="modal fade" id="deletesupplier<?= $spl->id_supplier; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteBusLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body text-danger">
                                                        <h3>APAKAH ANDA YAKIN INGIN MENGHAPUS DATA supplier?</h3>
                                                        <h3>PERUBAHAN TIDAK DAPAT DIKEMBALIKAN</h3>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <a href="<?= base_url('Supplier/hapus_supplier/' . $spl->id_supplier); ?>"><button type="button" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus data pasien ini?')">Ya</button></a>
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