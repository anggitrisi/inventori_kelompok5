<?php

?>

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Form Pegawai
            </header>
            <?php
            if ($this->session->flashdata('msg')) ;
            echo $this->session->flashdata('msg');

            ?>
            <div class="panel-body">
                    <?php $attributes = array('class' => 'form-horizontal group-border hover-stripped','method'=>'post');
                    echo form_open_multipart('Barang/insert_barang', $attributes);?>

                    <div class="form-group">
                        <div class="col-sm-6"><label>Nama Barang</label><input class="form-control" name="nama_barang" autofocus="" type="text"><?= form_error('nama_barang', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <div class="col-sm-6"><label>Merek</label><input class="form-control" name="merek" type="text"> <?= form_error('merek', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    
                        <!-- <div class="col-sm-6"><label>Jumlah</label><input class="form-control"name="jumlah" type="text"> <?= form_error('jumlah', '<small class="text-danger">', '</small>'); ?>
                        </div>                    -->
                    <div class="form-group">
                        <div class="col-sm-6"><label>Gambar</label><input class="form-control" name="gambar" type="file"><?= form_error('gambar', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="col-sm-6"><label>Kategori</label>
                        
                        <select class="form-control" name="id_kategori" id="">
                        <option value="0">===>Select Category<===</option>
                        <?php foreach ($tampil as $rows): ?>
                                <option
                                    value="<?php echo $rows->id_kategori; ?>"><?php echo $rows->nama_kategori ?></option>
                                    
                            <?php endforeach; ?>
                        </select>

                        <!-- <div class="col-sm-6"><label>kategori</label><input class="form-control" name="kategori" type="text"><?= form_error('kategori', '<small class="text-danger">', '</small>'); ?> -->
                        
                        <?= form_error('keterangan', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-6"><label>Keterangan</label><textarea class="form-control" name="keterangan" type="text"><?= form_error('keterangan', '<small class="text-danger">', '</small>'); ?></textarea>
                        </div>

                       
                    </div>

                    <hr>
                    <div class="form-group" style="padding-left: 42%">
                        <div class="col-md-6">
                            <input type="submit" name="Save" class="btn btn-info">
                            <a href="<?= base_url(); ?>Barang/data_barang" class="btn btn-danger">Cancel</a>
                        </div>

                    </div>

                <?php form_close();?>

            </div>
        </section>

    </div>
</div>
<!-- page end-->
<!--Table starts-->


<!--Table ends-->


