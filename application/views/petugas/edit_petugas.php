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
                Form Petugas
            </header>
            <?php
            if ($this->session->flashdata('msg'));
            echo $this->session->flashdata('msg');

            ?>
            <div class="panel-body">
                <?php $attributes = array('class' => 'form-horizontal group-border hover-stripped', 'method' => 'post');
                echo form_open_multipart('Petugas/update_petugas', $attributes); ?>

                <div class="form-group">
                    <div class="col-sm-6"><label>Nama Petugas</label><input class="form-control" name="nama_petugas" autofocus="" type="text" value="<?= $edit_petugas->nama_petugas; ?>">
                        <input type="hidden" name="id_petugas" value="<?= $edit_petugas->id_petugas; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6"><label>No Handphone</label><input class="form-control" name="no_telepon" type="text" value="<?= $edit_petugas->no_telepon; ?>"></div>
                </div>

                <div class="form-group">
                    <div class="col-sm-6"><label>Alamat</label><input class="form-control" value="<?= $edit_petugas->alamat; ?>" name="alamat" type="text">
                    </div>


                    <div class="form-group">
                        <div class='col-sm-6'><label>Jabatan</label>
                            <select name="GROUP_ID" class="form-control">
                                <?php foreach ($usr_group as $user_group) { ?>
                                    <?php if ($edit_petugas->GROUP_ID== $user_group->GROUP_ID) {
                                        ?> <option selected value="<?= $user_group->GROUP_ID; ?>"><?= $user_group->GROUP_NAME; ?></option> 
                                    <?php } else { ?> 
                                    <option value="<?= $user_group->GROUP_ID; ?>"><?= $user_group->GROUP_NAME; ?></option> <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                        </div>
                <hr>
                <div class="form-group" style="padding-left: 42%">
                    <div class="col-md-6">
                        <input type="submit" name="Update" class="btn btn-info">
                        <a href="<?= base_url(); ?>petugas" class="btn btn-danger">Cancel</a>
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