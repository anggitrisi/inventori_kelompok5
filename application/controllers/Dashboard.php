<?php

class Dashboard extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['total_users'] = $this->Main_model->count_all('usr_user');
        $data['total_petugas'] = $this->Main_model->count_all('petugas');
        $data['total_supplier'] = $this->Main_model->count_all('supplier');

        $data['update_pengadaan_hari_ini'] = $this->Main_model->get_pengadaan_hari_ini();
        $data['update_penempatan_hari_ini'] = $this->Main_model->get_penempatan_hari_ini();

        $data['total_pengadaan'] = $this->Main_model->count_where_done('pengadaan');
        $data['total_penempatan'] = $this->Main_model->count_where_done('penempatan');
        $data['total_pengadaan_bulan_ini'] = $this->Main_model->count_pengadaan_where_done_bulan_ini();
        $data['total_penempatan_bulan_ini'] = $this->Main_model->count_penempatan_where_done_bulan_ini();

        $data['total_permohonan_pengadaan'] = $this->Main_model->count_all('pengadaan');
        $data['total_permohonan_penempatan'] = $this->Main_model->count_all('penempatan');
        $data['total_permohonan_pengadaan_bulan_ini'] = $this->Main_model->count_all_pengadaan_sebulan('pengadaan');
        $data['total_permohonan_penempatan_bulan_ini'] = $this->Main_model->count_all_penempatan_sebulan('penempatan');

        $data['persediaan_barang'] = $this->Main_model->select_record('barang');

        $data['jumlah_barang_masuk'] = $this->Main_model->sum_all_masuk_item();
        $data['jumlah_barang_keluar'] = $this->Main_model->sum_all_keluar_item();
        $data['jumlah_barang_masuk_bulan_ini'] = $this->Main_model->sum_all_masuk_item_bulan_ini();
        $data['jumlah_barang_keluar_bulan_ini'] = $this->Main_model->sum_all_keluar_item_bulan_ini();

        $this->header('Dashboard');
        $this->load->view('__template/dashboard_admin', $data);
        $this->footer();
    }
}
