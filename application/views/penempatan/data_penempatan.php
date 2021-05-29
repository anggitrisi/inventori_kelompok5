<?php if ($this->session->userdata('msg'))
  echo "<span class='alert alert-success'>" . $this->session->userdata('msg') . "</span>";
?>

<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Data penempatan | <a href='<?= base_url(); ?>penempatan/tambah_penempatan' class='btn btn-info'>
            Permohonan penempatan <i class="fa fa-plus"></i>
          </a></h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
          <table class="display table table-bordered table-striped dataTable" id="example1">
            <thead>
              <tr>
                <th>No.</th>
                <th>No penempatan</th>
                <th>Tanggal Permintaan <br> Penempatan</th>
                <th>Lokasi</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1;
              foreach ($penempatan as $pgd) : ?>
                <tr>

                  <td><?= $i; ?></td>
                  <td><?= $pgd->id_penempatan; ?></td>
                  <td><?= date('d M Y', strtotime($pgd->tgl_permintaan_penempatan)); ?></td>
                  <td><?= $pgd->nama_lokasi ?>,
                    <br><?= $pgd->fakultas; ?>
                  </td>
                  <td><?php if ($pgd->status == 0) : ?>
                      <a href="#" class="btn btn-warning disabled">
                        <span class="icon text-white-50">
                          <i class="fa fa-hourglass-half"></i>
                        </span>
                        <span class="text">Waiting</span>
                      </a>
                    <?php elseif ($pgd->status == 1) : ?>
                      <a href="#" class="btn btn-success disabled">
                        <span class="icon text-white-50">
                          <i class="fa fa-check"></i>
                        </span>
                        <span class="text">Accepted</span>
                      </a>
                    <?php else : ?>
                      <a href="#" class="btn btn-danger disabled">
                        <span class="icon text-white-50">
                          <i class="fa fa-close"></i>
                        </span>
                        <span class="text">Canceled</span>
                      </a>
                    <?php endif; ?>
                  </td>

                  <td>
                    <!-- kalau belum diterima atau ditolak manager tidak bisa diproses-->
                    <!-- atau kalo sudah diterima dan sudah diproses tidak bisa lagi diproses-->
                    <?php if (($pgd->status == 0 || $pgd->status == 2) || ($pgd->status == 1 || $pgd->di_proses == 1)) : ?>
                      <a href="#" class="btn btn-default disabled">
                        <span class="icon text-white-50">
                          <i class="fa fa-circle-o-notch"></i>
                        </span>
                        <span class="text">Proses</span>
                      </a>
                    <?php endif; ?>
                    <!-- kalau sudah diterima manager baru bisa diproses-->
                    <?php if ($pgd->status == 1) : ?>
                      <a href="<?= base_url(); ?>penempatan/proses_penempatan/<?= $pgd->id_penempatan; ?>" class="btn btn-info">
                        <span class=" icon text-white-50">
                          <i class="fa fa-circle-o-notch"></i>
                        </span>
                        <span class="text">Proses</span>
                      </a>
                    <?php endif; ?>
                    <!-- kalau status masih waiting -->
                    <a href="<?= base_url() ?>penempatan/detail_penempatan/<?= $pgd->id_penempatan; ?>" class="btn btn-primary"><i class=" fa fa-eye"></i> </a>
                    <a data-toggle="modal" href="#deletepenempatan<?= $pgd->id_penempatan; ?>" data-url="" class="btn btn-danger confirm_delete" title="Hapus" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Hapus penempatan"><i class="fa fa-trash"></i></a>



                    <!-- Modal Hapus-->
                    <div class="modal fade" id="deletepenempatan<?= $pgd->id_penempatan; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteBusLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>

                          <div class="modal-body text-danger">
                            <h3>APAKAH ANDA YAKIN INGIN MENGHAPUS DATA penempatan?</h3>
                            <h3>PERUBAHAN TIDAK DAPAT DIKEMBALIKAN</h3>
                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <a href="<?= base_url('penempatan/hapus_penempatan/' . $pgd->id_penempatan); ?>"><button type="button" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus data penempatan ini?')">Ya</button></a>
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