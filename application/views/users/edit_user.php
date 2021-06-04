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
                Form user
            </header>
            <?php
            if ($this->session->flashdata('msg'));
            echo $this->session->flashdata('msg');

            ?>
            <div class="panel-body">
                <?php $attributes = array('class' => 'form-horizontal group-border hover-stripped', 'method' => 'post');
                echo form_open_multipart('user/update_user', $attributes); ?>

                <div class="form-group ">
                    <div class="col-sm-6"><input class="form-control hidden" value="<?= $edit_user->USER_ID; ?>" name="USER_ID" type="text">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-6"><label>Username</label><input class="form-control" value="<?= $edit_user->USER_NAME; ?>" name="USER_NAME" type="text">
                    </div>
                </div>


                <div class="form-group">
                    <div class='col-sm-6'><label>Jabatan</label>
                        <select name="GROUP_ID" class="form-control">
                            <?php foreach ($list_jabatan as $list_jabatan) { ?>
                                <?php if ($edit_user->GROUP_ID == $list_jabatan->GROUP_ID) {
                                ?> <option selected value="<?= $list_jabatan->GROUP_ID; ?>"><?= $list_jabatan->GROUP_NAME; ?></option>
                                <?php } else { ?>
                                    <option value="<?= $list_jabatan->GROUP_ID; ?>"><?= $list_jabatan->GROUP_NAME; ?></option> <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>



                <div class="form-group">
                    <div class="col-sm-6"><label>Password</label><input class="form-control" value="" name="password" type="password">
                    </div>
                </div>


                <hr>
                <div class="form-group" style="padding-left: 42%">
                    <div class="col-md-6">
                        <input type="submit" name="Update" class="btn btn-info">
                        <a href="<?= base_url(); ?>user/tambah_user" class="btn btn-danger">Cancel</a>
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