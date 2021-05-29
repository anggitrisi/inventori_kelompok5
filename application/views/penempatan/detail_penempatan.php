<section class="content">


  <div class="row">
    <div class="col-md-4">
      <div class="box box-primary">
        <div class="box-body box-profile">

          <h3 class="profile-username text-center"><?php echo $detail_penempatan->id_penempatan; ?></h3>

          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>Lokasi penempatan</b> <a class="pull-right"><?php echo $detail_penempatan->nama_lokasi; ?></a>
            </li>
            <li class="list-group-item">
              <b>Penanggungjawab</b> <a class="pull-right"><?php echo $detail_penempatan->EMP_NAME; ?></a>
            </li>
            <li class="list-group-item">
              <p class="text-right"><i class="fa fa-envelope mr"> </i> <a><?php echo $detail_penempatan->EMP_EMAIL; ?></a></p>
            </li>
            <li class="list-group-item">
              <p class="text-right"><i class="fa fa-phone"> </i> <a><?php echo $detail_penempatan->EMP_CELL; ?></a></p>
            </li>
          </ul>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>

    <div class="col-md-8">
      <!-- Detail Pengajuan Permintaan Box -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Detail Pengajuan Permintaan</h3>
          <div class="text-right">
            <a href="<?= base_url('Penempatan/data_penempatan') ?>" class="btn btn-warning">Back</a>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <strong><i class="fa fa-cubes"></i> Detail barang</strong>
          <div class="row">
            <div class="col-xs-12">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th> Item</th>
                    <th class="hidden-xs"> Jumlah</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $n = 1;
                  foreach ($barang as $rows) {
                  ?>
                    <tr>
                      <td><?php echo $n; ?></td>
                      <td><?php echo $rows->nama_barang; ?></td>
                      <td><?php echo $rows->jumlah; ?></td>
                    </tr>
                  <?php $n++;
                  } ?>

                </tbody>
              </table>
            </div>
          </div>

          <hr><br><br>
          <div class="row">
            <div class="col-sm-4 mx-auto">
              <strong><i class="fa fa-user"></i> Diajukan oleh</strong>
              <p class="text-muted ml">
                <?php if (empty($detail_penempatan)) {
                  echo "<span>NO record</span>";
                } else {
                  echo $detail_penempatan->petugas_peminta;
                } ?>
              </p>
              <p class="text-muted ml"><?php echo $detail_penempatan->no_telpPetugasPeminta; ?></a></p>
              <p class="text-muted ml"><?php echo $detail_penempatan->alamatPetugasPeminta; ?></a></p>
            </div>
            <div class="col-sm-4 mx-auto pull-right">
              <strong><i class="fa fa-user"></i> Disetujui oleh</strong>
              <p class="text-muted ml">
                <?php if ($detail_penempatan->disetujui_oleh == 0) {
                  echo "<span>(Belum disetujui)</span>";
                } else {
                  echo $detail_penempatan->petugas_penyetuju;
                } ?>
              </p>
              <p class="text-muted ml"><?php echo $detail_penempatan->no_telpPetugasPenyetuju; ?></a></p>
              <p class="text-muted ml"><?php echo $detail_penempatan->alamatPetugasPenyetuju; ?></a></p>
            </div>

          </div>
          <hr>

        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>

</section>