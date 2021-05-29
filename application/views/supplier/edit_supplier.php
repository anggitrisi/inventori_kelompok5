<?php



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
                echo form_open_multipart('Supplier/update_supplier', $attributes); ?>

                <div class="form-group">
                    <div class="col-sm-6"><label>Nama supplier</label><input class="form-control" name="nama_supplier" autofocus="" type="text" value="<?= $edit_supplier->nama_supplier; ?>">
                        <input type="hidden" name="id_supplier" value="<?= $edit_supplier->id_supplier; ?>">
                    </div>
                    </div>
                <div class="form-group">
                    <div class="col-sm-6"><label>Nama Perusahaan</label><input class="form-control" value="<?= $edit_supplier->nama_perusahaan; ?>" name="nama_perusahaan" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6"><label>Email</label><input class="form-control" value="<?= $edit_supplier->email; ?>" name="email" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6"><label>Alamat</label><input class="form-control" value="<?= $edit_supplier->alamat; ?>" name="alamat" type="text">
                    </div>
                        </div>
                        
                <div class="form-group">
                    <div class="col-sm-6"><label>No Handphone</label><input class="form-control" name="no_telp" type="text" value="<?= $edit_supplier->no_telp; ?>"></div>
                </div>
               
                <hr>
                <div class="form-group" style="padding-left: 42%">
                    <div class="col-md-6">
                        <input type="submit" name="Update" class="btn btn-info">
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