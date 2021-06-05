<div class="row">
  <div class="col-md-12">
    <div class="portlet light">
      <div class="portlet-body">
        <div class="invoice">
          <div class="row invoice-logo">
            <div class="col-xs-6 invoice-logo-space">
              <img src="<?= base_url(); ?>assets/pages/media/invoice/walmart.png" class="img-responsive" alt="" />
            </div>
            <div class="col-xs-6">
              <p> #<?php echo $detail_pengadaan->id_pengadaan ?> / <?php echo date('d-m-y', strtotime($detail_pengadaan->tgl_permintaan)); ?>
              </p>

            </div>
          </div>
          <hr />
          <div class="row">
            <div class="col-xs-4">
              <h3>SUPPLIER:</h3>
              <ul class="list-unstyled">
                <li> <?= $detail_pengadaan->nama_supplier ?> </li>
                <li> <?= $detail_pengadaan->nama_perusahaan ?> </li>
                <li> <?= $detail_pengadaan->email; ?> </li>
                <li> <?= $detail_pengadaan->no_telpSupplier ?> </li>
              </ul>
            </div>
            <div class="col-xs-4">

            </div>
            <div class="col-xs-4 invoice-payment">
              <h3>Detail Pembayaran:</h3>
              <div id="invoice">
                <div class="date">Tanggal invoice: <?php echo date('d M Y', strtotime($detail_pengadaan->tgl_masuk)); ?></div>
                <div class="date">Invoice Status <?php if ($detail_pengadaan->_dibayar == 1) {
                                                    echo "<span class='label label-success'>PAID</span>";
                                                  } else {
                                                    echo "<span class='label label-warning'>NOT PAID</span>";
                                                  }
                                                  ?>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th> Item</th>
                    <th class="hidden-xs"> Jumlah</th>
                    <th class="hidden-xs"> Harga</th>
                    <th class="hidden-xs"> qrcode</th>
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
                      <td class=""><?php echo $rows->harga; ?></td>
                      <td><img src="<?php echo base_url('pengadaan/generate_qrcode/' . $rows->id_barang); ?>" width="100" height="100"></td>
                      </td>
                    </tr>
                  <?php $n++;
                  } ?>

                </tbody>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-4">
              <div class="well">
                <address>
                  <p><strong>Di <i>request</i> oleh &nbsp : </strong><?= $detail_pengadaan->petugas_peminta; ?></p>
                  <p><strong>Disetujui oleh &nbsp : </strong><?= $detail_pengadaan->petugas_penyetuju; ?></p>
                  <p><strong>Diterima oleh &nbsp : </strong><?= $detail_pengadaan->petugas_pembayar; ?></p>
                </address>
              </div>
            </div>
            <div class="col-xs-8 invoice-block">
              <ul class="list-unstyled detail_pengadaans">
                <li>
                  <strong>Total Harga:</strong> Rp. <?= $detail_pengadaan->total_harga ?>
                </li>
              </ul>
              <br />
              <a class="btn btn-lg btn-primary hidden-print margin-bottom-5" onclick="javascript:window.print();"> Print
                <i class="fa fa-print"></i>
              </a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>