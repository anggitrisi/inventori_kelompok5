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
        
            <div class="form-horizontal group-border hover-stripped panel-body">
                <?php
                echo form_open_multipart('Barang/update_barang/'.$result['id_barang']); ?>
                
                <div class="form-group">
                    <div class="col-sm-6"><label>Nama barang</label><input class="form-control" name="nama_barang"
                                                                        autofocus="" type="text"
                                                                        value="<?= $result['nama_barang']; ?>" required>
                                                                       
                    
                    <input type="hidden" name="id_barang" value="<?=  $result['id_barang'];?>">

                    </div>
                    <div class="col-sm-6"><label>Merek</label><input class="form-control" 
                                                                     value="<?= $result['merek'];?>"
                                                                     name="merek" type="text" required>
                                                                    
                    </div>
                </div>

                <div class="form-group">
                    <!-- <div class="col-sm-6"><label>Jumlah</label><input class="form-control" value="<?= $result['jumlah']; ?>" name="jumlah"
                    name="address" type="text" required>
                    </div> -->
        
                    <div class="col-sm-6"><label>Keterangan</label><input class="form-control" value="<?= $result['keterangan']; ?>" name="keterangan"
                name="address" type="text" required>
                    </div>

                    <label for='inputPassword1'
                               class='col-sm-6'>Kategori</label>

                        <div class='col-sm-6'>
                            <select name="id_kategori" class="form-control">
                                    <!--  -->

                                <?php foreach ($tampil as $kategori) { ?>
                                    <?php if ($edit_barang->id_kategori== $kategori->id_kategori) {
                                        ?> <option selected value="<?= $kategori->id_kategori; ?>"><?= $kategori->nama_kategori; ?></option> 
                                    <?php } else { ?> 
                                    <option value="<?= $kategori->id_kategori; ?>"><?= $kategori->nama_kategori; ?></option> <?php } ?>
                                <?php } ?>

                            </select>

                    
                    </div>
                    
                </div>

                <div class="form-group">
                    <div class="col-sm-6"><label>Gambar</label> <br>
							    			<img src="<?= base_url('assets_user/img/') . $result['gambar']; ?>" height="100" witdh="100">
                    <input class="form-control" name="gambar"
                                                                          type="file"
                                                                          value="<?= base_url('assets_user/img/') .$result['gambar']; ?>" >
                    </div>
            
            
                    
                </div>
                <hr>
                <div class="form-group" style="padding-left: 42%">
                    <div class="col-md-6">
                        <input type="submit" name="Update" class="btn btn-info">
                        <a href="<?= base_url(); ?>Barang/data_barang" class="btn btn-danger">Cancel</a>
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
