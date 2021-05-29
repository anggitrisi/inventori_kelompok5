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
                Form Lokasi
            </header>
            <?php
            if ($this->session->flashdata('msg'));
            echo $this->session->flashdata('msg');

            ?>
            <div class="panel-body">
                <?php $attributes = array('class' => 'form-horizontal group-border hover-stripped', 'method' => 'post');
                echo form_open_multipart('Lokasi/update_lokasi', $attributes); ?>

                <div class="form-group">
                    <div class="col-sm-6"><label>Nama Lokasi</label><input class="form-control" name="nama_lokasi" autofocus="" type="text" value="<?= $edit_lokasi->nama_lokasi; ?>">
                        <input type="hidden" name="id_lokasi" value="<?= $edit_lokasi->id_lokasi; ?>">
                    </div>
                              
                <div class="col-sm-6"><label>Fakultas</label>
                        <select name="fakultas" class="form-control" type="text" value="<?= set_value('fakultas') ?>"> <?= form_error('fakultas', '<small class="text-danger">', '</small>'); ?>
                            <option value="Fakultas Kedokteran">Kedokteran</option>
                            <option value="Fakultas Ilmu Budaya">Ilmu Budaya</option>
                            <option value="Fakultas Pertanian">Pertanian</option>
                            <option value="Fakultas Hukum">Hukum</option>
                            <option value="Fakultas Teknik">Teknik</option>
                            <option value="Fakultas Ekonomi dan Bisnis">Ekonomi dan Bisnis</option>
                            <option value="Fakultas Kedokteran Gigi">Kedokteran Gigi</option>
                            <option value="Fakultas Matematika dan Ilmu Pengetahuan Alam">Matematika dan Ilmu Pengetahuan Alam</option>
                            <option value="Fakultas Ilmu Sosial dan Politik">Ilmu Sosial dan Politik</option>
                            <option value="Fakultas Kesehatan Masyarakat">Kesehatan Masyarakat</option>
                            <option value="Fakultas Farmasi">Farmasi</option>
                            <option value="Fakultas Psikologi">Psikologi</option>
                            <option value="Fakultas Keperawatan">Keperawatan</option>
                            <option value="Fakultas Ilmu Komputer dan Teknologi Informasi">Ilmu Komputer dan Teknologi Informasi</option>
                        </select></div></div>
               
                <hr>
                <div class="form-group" style="padding-left: 42%">
                    <div class="col-md-6">
                        <input type="submit" name="Update" class="btn btn-info">
                        <a href="<?= base_url(); ?>lokasi" class="btn btn-danger">Cancel</a>
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