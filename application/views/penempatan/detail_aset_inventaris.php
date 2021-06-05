<section class="content">


  <div class="row">


    <div class="col-md-7">
      <!-- Detail Pengajuan Permintaan Box -->
      <div class="box box-light">
        <div class="box-header with-border">
          <h3 class="box-title">
            <strong><i class=" fa fa-cubes"></i> Detail Aset Inventaris</strong>
          </h3>
          <div class="text-right">
            <a href="<?= base_url('Penempatan/aset_inventaris') ?>" class="btn btn-default">Back</a>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <img src=" <?= base_url('assets_user/img/') . $detail_aset_inventaris->gambar; ?>" class="img-fluid" alt="..." width="300" height="300">
          <div class="row">
            <div class="col-xs-12">

              <table class=" table table-striped table-hover">

                <tbody>
                  <tr>
                    <td>Nama barang </td>
                    <td> :</td>
                    <td><?php echo $detail_aset_inventaris->nama_barang; ?></< /td>
                  </tr>
                  <tr>
                    <th>Kategori </th>
                    <td> :</td>
                    <td><?php echo $detail_aset_inventaris->nama_kategori; ?></< /td>
                  </tr>
                  <tr>
                    <th>Merek</th>
                    <td> :</td>
                    <td><?php echo $detail_aset_inventaris->merek; ?></< /td>
                  </tr>
                  <tr>
                    <th>Status</th>
                    <td> :</td>
                    <td><?= date('d M Y', strtotime($detail_aset_inventaris->tgl_keluar)); ?></< /td>
                  </tr>

                </tbody>
              </table>
            </div>
          </div>



        </div>
        <hr>

      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->


    <div class="col-md-5">
      <div class="box box-light">
        <div class="box-body box-profile">

          <h3 class="profile-username text-center"><?php echo $detail_aset_inventaris->id_penempatan; ?></h3>

          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>Lokasi penempatan</b>
              <p><a><?php echo $detail_aset_inventaris->nama_lokasi; ?>,<?php echo $detail_aset_inventaris->fakultas; ?></a></p>
            </li>
            <li class="list-group-item">
              <b>Jumlah yang ditempatkan</b>
              <p><a><?php echo $detail_aset_inventaris->jumlah_keluar; ?></a></p>
            </li>
            <li class="list-group-item">
              <b>Penanggungjawab</b>
              <p><a><?php echo $detail_aset_inventaris->penanggung_jawab; ?></a></p>
            </li>
            <li class="list-group-item">
              <b>Tanggal Penempatan</b>
              <p><a><?php echo $detail_aset_inventaris->tgl_keluar; ?></a></p>
            </li>
            <li>
              <img src="<?php echo base_url('penempatan/generate_qrcode/' . $detail_aset_inventaris->id); ?>" width="100" height="100">
            </li>

            </li>
          </ul>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>

</section>