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
                Form Pegawai
            </header>
            <?php
            if ($this->session->flashdata('msg'));
            echo $this->session->flashdata('msg');

            ?>
            <div class="panel-body">
                <?php $attributes = array('class' => 'form-horizontal group-border hover-stripped', 'method' => 'post');
                echo form_open_multipart('Pegawai/update_pegawai', $attributes); ?>

                <div class="form-group">
                    <div class="col-sm-6"><label>Nama Pegawai</label><input class="form-control" name="emp_name" autofocus="" type="text" value="<?= $edit_pegawai->EMP_NAME; ?>">
                        <input type="hidden" name="emp_id" value="<?= $edit_pegawai->EMP_ID; ?>">
                    </div>
                    <div class="col-sm-6"><label>email</label><input class="form-control" value="<?= $edit_pegawai->EMP_EMAIL; ?>" name="emp_email" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6"><label>Alamat</label><input class="form-control" value="<?= $edit_pegawai->EMP_ADDRESS; ?>" name="address" type="text">
                    </div>

                    <div class="col-sm-6"><label>Gender</label>
                        <div class="row">
                            <div class="custom-control custom-radio">
                                <div class="col-sm-3"><input class="custom-control-input" type="radio" name="emp_gender" <?php if ($edit_pegawai->EMP_GENDER == 'L') echo "checked" ?> id="laki-laki" value="L">
                                    <label class="custom-control-label" for="laki-laki">Laki-laki</label>
                                </div>
                            </div>
                            <div class="custom-control custom-radio">
                                <div class="col-sm-3"><input class="custom-control-input" type="radio" name="emp_gender" <?php if ($edit_pegawai->EMP_GENDER == 'P') echo "checked" ?> id="perempuan" value="P">
                                    <label class="custom-control-label" for="perempuan">Perempuan</label>
                                </div>
                            </div>
                        </div>
                        <?= form_error('emp_gender', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6"><label>No Handphone</label><input class="form-control" name="emp_cell" type="text" value="<?= $edit_pegawai->EMP_CELL; ?>"></div>

                </div>
                <hr>
                <div class="form-group" style="padding-left: 42%">
                    <div class="col-md-6">
                        <input type="submit" name="Update" class="btn btn-info">
                        <a href="<?= base_url(); ?>pegawai" class="btn btn-danger">Cancel</a>
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