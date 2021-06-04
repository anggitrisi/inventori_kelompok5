<?php


/*foreach ($results as $menulists) {


  @$menulistRow .= "<tr class='gradeA odd'>

								<td class='center'>" . $menulists->MENU_TEXT . "

								<td>" . $menulists->MENU_URL . "

								<td>" . $menulists->SORT_ORDER . "

								<td class=center>" . $menulists->PARENT_ID . "";


}*/
?>

<div class="row">
  <div class="col-lg-12">
    <section class="panel">
      <header class="panel-heading">
        Form Tambah Penempatan
      </header>
      <?php
      if ($this->session->flashdata('msg'));
      echo $this->session->flashdata('msg');

      ?>
      <div class="panel-body">
        <?php $attributes = array('class' => 'form-horizontal group-border hover-stripped', 'method' => 'post');
        echo form_open_multipart('Penempatan/insert_penempatan', $attributes); ?>

        <div class="form-group">
          <div class="col-sm-6"><label for="date">Tanggal</label>
            <div class="icon"><span class="ion-ios-arrow-down"></span></div>
            <input type="date" name="date" id="date" class="form-control" value="<?= set_value('date'); ?>" required>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-6"><label>Lokasi</label><select class="form-control" id="id_lokasi" name="id_lokasi" required>
              <option value="">pilih..</option>
              <?php foreach ($lokasi as $lks) : ?>
                <option value="<?php echo $lks->id_lokasi; ?>"> <?php echo $lks->nama_lokasi; ?>, <?php echo $lks->fakultas; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-6"><label>Pegawai Penganggung Jawab</label><select class="form-control" id="EMP_ID" name="EMP_ID" required>
              <option value="">pilih..</option>
              <?php foreach ($pegawai as $spl) : ?>

                <option value="<?php echo $spl->EMP_ID; ?>"> <?php echo $spl->EMP_NAME; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="form-group fieldGroup">
          <div class="input-group">
            <div class="col-sm-7"><label>Barang</label>
              <select class="form-control" id="id_barang[]" name="id_barang[]" required>
                <option value="">pilih..</option>
                <?php foreach ($barang as $brg) : ?>
                  <?php if ($brg->jumlah > 0) : ?>
                    <?php if ($brg->jumlah <= 10) : ?>
                      <option style="color:red" value="<?php echo $brg->id_barang; ?>"> <?php echo $brg->nama_barang; ?> (stok: <?php echo $brg->jumlah; ?> )
                      <?php else : ?>
                      <option value="<?php echo $brg->id_barang; ?>"> <?php echo $brg->nama_barang; ?> (stok: <?php echo $brg->jumlah; ?> )
                      <?php endif; ?>
                    <?php endif; ?>
                  <?php endforeach; ?>
              </select>
            </div>
            <div class="col-sm-4">
              <label>Jumlah</label><input class="form-control" name="jumlah[]" type="text" value="<?= set_value('jumlah') ?>"> <?= form_error('jumlah', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="input-group-addon">
              <a href="javascript:void(0)" class="btn btn-success addMore"><i class="fa fa-plus"></i></a>
            </div>
          </div>
        </div>
      </div>
  </div>

  <hr>
  <div class=" form-group" style="padding-left: 42%">
    <div class="col-md-6">
      <input type="submit" name="Save" class="btn btn-info">
      <a href="<?= base_url(); ?>Penempatan" class="btn btn-danger">Cancel</a>
    </div>
  </div>

  <?php form_close(); ?>

  <div class="form-group fieldGroupCopy" style="display: none;">
    <div class="input-group">
      <div class="col-sm-7"><label>Barang</label>
        <select class="form-control" id="id_barang[]" name="id_barang[]">
          <option value="">pilih..</option>
          <?php foreach ($barang as $brg) : ?>
            <?php if ($brg->jumlah > 0) : ?>
              <?php if ($brg->jumlah <= 10) : ?>
                <option style="color:red" value="<?php echo $brg->id_barang; ?>"> <?php echo $brg->nama_barang; ?> (stok: <?php echo $brg->jumlah; ?> )
                <?php else : ?>
                <option value="<?php echo $brg->id_barang; ?>"> <?php echo $brg->nama_barang; ?> (stok: <?php echo $brg->jumlah; ?> )
                <?php endif; ?>
              <?php endif; ?>
            <?php endforeach; ?>
        </select>
      </div>
      <div class="col-sm-4">
        <label>Jumlah</label><input class="form-control" name="jumlah[]" type="text" value="<?= set_value('jumlah') ?>"> <?= form_error('jumlah', '<small class="text-danger">', '</small>'); ?>
      </div>
      <div class="input-group-addon">
        <a href="javascript:void(0)" class="btn btn-danger remove"><i class="fa fa-trash"></i></a>
      </div>
    </div>
  </div>

</div>
</section>

</div>
</div>
<!-- page end-->
<!--Table starts-->


<!--Table ends-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function() {
    // membatasi jumlah inputan
    var maxGroup = 10;

    //melakukan proses multiple input 
    $(".addMore").click(function() {
      if ($('body').find('.fieldGroup').length < maxGroup) {
        var fieldHTML = '<div class="form-group fieldGroup">' + $(".fieldGroupCopy").html() + '</div>';
        $('body').find('.fieldGroup:last').after(fieldHTML);
      } else {
        alert('Maximum ' + maxGroup + ' groups are allowed.');
      }
    });

    //remove fields group
    $("body").on("click", ".remove", function() {
      $(this).parents(".fieldGroup").remove();
    });
  });
</script>