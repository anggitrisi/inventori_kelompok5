<div class="row">
    <div class="col-md-12">

        <div class="box">
            <div class="box-body">

                <div class="row ">
                    <div class="col-md-8 col-md-offset-2">
                        <form method="post" action="#">
                            <div class="btn-group pull-right">
                                <a onclick="print_invoice('printableArea')" class="btn btn-primary">Print</a>

                                <input name="start_date" value="2017-04-05" type="hidden">
                                <input name="end_date" value="2017-04-05" type="hidden">

                            </div>
                        </form>

                    </div>
                </div>

                <br>
                <br>

                <div id="printableArea">
                    <link href="<?= base_url(); ?>assets/sales_report.css" rel="stylesheet" type="text/css">


                    <div class="row ">
                        <div class="col-md-8 col-md-offset-2">

                          

                            </header>
                            <hr>

                            <main class="invoice_report">

                                <h4>Laporan Pengadaan from: <strong><?= $start; ?></strong> to
                                    <strong><?= $end; ?></strong>
                                </h4>
                                <br>
                                <br>
                                <?php $total = '';
                                $quantity = '';
                                $i = 1;
                                foreach ($pengadaan as $pgd): ?>
                                    <table border="0" cellspacing="0" cellpadding="0">
                                        <thead>
                                        <tr style="background-color: #ECECEC">
                                        <th>No.</th>
                                                    <th>Nama barang</th>
                                                    <th>Jumlah</th>
                                                    <th>Harga</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $k = 1 ?>
                                                <?php foreach ($pengadaan as $pgd) : ?>
                                                    <tr>
                                                        <td><?= $k; ?></td>
                                                        <td><?= $pgd->nama_barang; ?></td>
                                                        <td><?= $pgd->jumlah_masuk; ?></td>
                                                        <td><?= $pgd->harga; ?></td>
                                        </tr>


                                        </tbody>



                                    </table>
                                    <?php $i++; endforeach; ?>

                            </main>
                            <hr>
                            <footer class="text-center">
                                <strong>Kelompok 5</strong>&nbsp;&nbsp;&nbsp;Sistem Inventaris kelompok 5
                            </footer>


                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>
</div>