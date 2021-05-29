<?php if ($this->session->userdata('msg'))
  echo "<span class='alert alert-success'>" . $this->session->userdata('msg') . "</span>";
?>

<div class="row">
  <div class="col-xs-12">
    <div class="box box-solid box-default">
      <div class="box-header">
        <h3 class="box-title">Data Invoice </h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
          <table class="display table table-bordered table-striped dataTable" id="example1">
            <thead>
              <tr>
                <th>No.</th>
                <th>No Pengadaan</th>
                <th>Tanggal Disetujui</th>
                <th>Supplier</th>
                <th>Total Biaya</th>
                <th>Disetujui oleh</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1;
              foreach ($pengadaan as $pgd) : ?>
                <tr>

                  <td><?= $i; ?></td>
                  <td><?= $pgd->id_pengadaan; ?></td>
                  <td><?= date('d M Y', strtotime($pgd->tgl_permintaan)); ?></td>
                  <td><?= $pgd->nama_perusahaan; ?></td>
                  <td><?= $pgd->total_harga; ?></td>
                  <td><?= $pgd->nama_petugas; ?></td>
                  <td><?php if ($pgd->_dibayar == 0) : ?>
                      <span class="label label-warning">
                        <span class="icon text-white-50">
                          <i class="fa fa-hourglass-half"></i> Belum dibayar</span>
                      </span>
                    <?php else : ?>
                      <span class="label label-success">
                        <span class="icon text-white-50">
                          <i class="fa fa-check"></i> Sudah Dibayar
                        </span>
                      </span>
                    <?php endif; ?>
                  </td>

                  <td>
                    <!-- kalau belum diterima atau ditolak manager atau sudah dibayar tidak bisa dibayar-->
                    <?php if ($pgd->status == 0 || $pgd->status == 2 || $pgd->_dibayar == 1) : ?>
                      <a href="<?= base_url(); ?>Pengadaan/bayar_pengadaan/<?= $pgd->id_pengadaan; ?>" class="btn btn-default disabled">
                        <span class="icon text-white-50">
                          <i class="fa fa-money"></i>
                        </span>
                      </a>
                    <?php endif; ?>
                    <!-- kalau sudah diterima manager baru bisa dibayar-->
                    <?php if ($pgd->status == 1 && $pgd->_dibayar == 0) : ?>
                      <a href="<?= base_url(); ?>Pengadaan/bayar_pengadaan/<?= $pgd->id_pengadaan; ?>" class="btn btn-info updateBayar">
                        <span class=" icon text-white-50">
                          <i class="fa fa-money"></i>
                        </span>
                      </a>
                    <?php endif; ?>
                    <!-- kalau status masih waiting -->
                    <a href="<?= base_url() ?>Pengadaan/detail_invoice_pengadaan/<?= $pgd->id_pengadaan; ?>" class="btn btn-primary"><i class=" fa fa-eye"></i> </a>
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