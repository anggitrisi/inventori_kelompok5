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
                Form supplier
            </header>
            <?php
            if ($this->session->flashdata('msg'));
            echo $this->session->flashdata('msg');

            ?>
            <div class="panel-body">
                <?php $attributes = array('class' => 'form-horizontal group-border hover-stripped', 'method' => 'post');
                echo form_open_multipart('Supplier/insert_supplier', $attributes); ?>

                <div class="form-group">
                    <div class="col-sm-6"><label>Nama supplier</label><input class="form-control" name="nama_supplier" autofocus="" type="text" value="<?= set_value('nama_supplier') ?>"><?= form_error('nama_supplier', '<small class="text-danger">', '</small>'); ?>
                    </div>

                    <div class="col-sm-6"><label>Nama Perusahaan</label><input class="form-control" name="nama_perusahaan" autofocus="" type="text" value="<?= set_value('nama_perusahaan') ?>"><?= form_error('nama_perusahaan', '<small class="text-danger">', '</small>'); ?>
                    </div>

                    <div class="col-sm-6"><label>Email</label><input class="form-control" name="email" type="text" value="<?= set_value('email') ?>"> <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                    </div>
          
                    <div class="col-sm-6"><label>No Handphone</label><input class="form-control" name="no_telp" type="text" value="<?= set_value('no_telp') ?>"><?= form_error('no_telp', '<small class="text-danger">', '</small>'); ?>
                    </div>

                    <div class="col-sm-6"><label>Alamat</label><input class="form-control" name="alamat" type="text" value="<?= set_value('alamat') ?>"><?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <hr>
                <div class=" form-group" style="padding-left: 42%">
                    <div class="col-md-6">
                        <input type="submit" name="Save" class="btn btn-info">
                        <a href="<?= base_url(); ?>supplier" class="btn btn-danger">Cancel</a>
                    </div>

                </div>

                <?php form_close(); ?>

            </div>
        </section>

    </div>
</div>
<!-- page end-->
<!--Table starts-->


<!--Table ends-->