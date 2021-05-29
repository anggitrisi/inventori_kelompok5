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
        Form Tambah Pengadaan
      </header>
      <?php
      if ($this->session->flashdata('msg'));
      echo $this->session->flashdata('msg');
      ?>
      <div class="panel-body">
        <?php $attributes = array('class' => 'form-horizontal group-border hover-stripped', 'method' => 'post');
        echo form_open_multipart('Pengadaan/insert_pengadaan', $attributes); ?>

        <div class="form-group">
          <div class="col-sm-6"><label for="date">Tanggal</label>
            <input type="date" name="date" id="date" class="form-control" value="<?= set_value('date'); ?> " required> <?= form_error('date', '<small class="text-danger">', '</small>'); ?>
          </div>

          <div class="col-sm-6"><label>Supplier</label><select class="form-control" id="id_supplier" name="id_supplier" required>
              <option value="">select..</option>
              <?php foreach ($supplier as $spl) : ?>
                <option value="<?php echo $spl->id_supplier; ?>"> <?php echo $spl->nama_perusahaan; ?></option>
              <?php endforeach; ?>
            </select>
            <?= form_error('id_supplier', '<small class="text-danger">', '</small>'); ?>
          </div>
        </div>

        <div class=" form-group" style="padding-left: 42%">
          <div class="col-md-6">
            <input type="submit" name="Save" class="btn btn-info" value="Tambah Barang"></span>
          </div>
        </div>

        <?php form_close(); ?>

      </div>
  </div>

  <hr>


</div>
</section>

</div>
</div>
<!-- page end-->