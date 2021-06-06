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

                <h3 class="box-title">Data Kategori | 
                <?php if ($this->session->userdata('group_id') == '1' || $this->session->userdata('group_id') == '3'): ?>
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#tambah_data">
                        Tambah Kategori <i class="fa fa-plus"></i>
                    </button>
                    <?php endif; ?>
                    </a></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <table class="display table table-bordered table-striped dataTable" id="example1">
                        <thead>
                            <tr>
                                <th>Id kategori</th>
                                <th>Nama Kategori</th>
                                <?php if ($this->session->userdata('group_id') == '1' || $this->session->userdata('group_id') == '3'): ?>
                                <th>Aksi</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($kategori as $ktg) : ?>
                                <tr>

                                    <td><?= $i; ?></td>
                                    <td><?= $ktg->nama_kategori; ?></td>
                                    <?php if ($this->session->userdata('group_id') == '1' || $this->session->userdata('group_id') == '3'): ?>
                                    <td><a href="#editKategori<?= $ktg->id_kategori; ?>" data-toggle='modal' class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                        <a data-toggle="modal" href="#deleteKategori<?= $ktg->id_kategori; ?>" data-url="" class="btn btn-danger confirm_delete" title="Hapus" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Hapus Pegawai"><i class="fa fa-trash"></i></a>
                                        <?php endif; ?>
                                        <!-- Modal Hapus-->
                                        <div class="modal fade" id="deleteKategori<?= $ktg->id_kategori; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteBusLabel" aria-hidden="true">
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
                                                        <a href="<?= base_url('Kategori/hapus_kategori/' . $ktg->id_kategori); ?>"><button type="button" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus data pasien ini?')">Ya</button></a>
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




<!-- Modal Edit -->
<?php foreach ($kategori as $rows) : ?>

    <div class="modal fade" id="editKategori<?php echo $rows->id_kategori; ?>" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Edit Kategori</h4>
                </div>
                <?php $attributes = array('class' => 'form-horizontal group-border hover-stripped', 'id' => 'myform', 'method' => 'post');
                echo form_open('kategori/update_kategori', $attributes); ?>
                <div class="modal-body">
                    <div class='form-group'>
                        <label for='nama_kategori' class='col-lg-3 col-sm-3 control-label'>Nama Kategori</label>

                        <div class='col-lg-9'>
                            <input type='hidden' name="i_kategori" class='form-control' id='id_kategoris' value='<?php echo $rows->id_kategori; ?>'>
                            <input type='text' name="nama_kategori" class='form-control' id='nama_kategoris' value='<?php echo $rows->nama_kategori; ?>'>
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
                <h4 class="modal-title">Tambah Kategori</h4>

            </div>
            <form action="<?= base_url('Kategori/insert_kategori'); ?>" method="post">

                <div class="modal-body">

                    <div class='form-group'>
                        <label for='nama_kategori' class='col-lg-4 col-sm-3 control-label'>Nama Kategori</label>
                        <div class='col-lg-8'>

                            <input type='text' name="nama_kategori" required class='form-control' id='nama_kategoris' placeholder="Masukkan Kategori">
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