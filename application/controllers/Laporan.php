<?php

class Laporan extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    //Laporan pengadaan Form
    public function pengadaan()
    {
        $data['barang'] = $this->Main_model->select('barang');
        $this->header('Laporan Pengadaan');
        $this->load->view('laporan/pengadaan', $data);
        $this->footer();
    }

    public function bps_table()
    {
        $this->Main_model->bps_table('pengadaan', 'id_pengadaan');
    }


    function laporan_pengadaan()
    {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $start_date1 = date('Y-m-d', strtotime($start_date));
        $end_date1 = date('Y-m-d', strtotime($end_date));

        $invoice = $this->Main_model->get_invoice_by_date1($start_date1, $end_date1);
        //echo "<pre>";print_r($invoice);exit;
        if (!empty($invoice)) {
            $this->bps_table();
            foreach ($invoice as $v_invoice) {
                $data['invoice_details'][$v_invoice->id_pengadaan] = $this->Main_model->p_detail_pengadaan(array('id_pengadaan' => $v_invoice->id_pengadaan));
                $data['order'][] = $v_invoice;
            }
        }
        // echo "<pre>";
        // print_r($data);
        // exit;
        //$data['pengadaans'] = $this->Main_model->getSales($start_date1,$end_date1);
        $data['start'] = $start_date;
        $data['end'] = $end_date;
        $data['barang'] = $this->Main_model->select('barang');

        $this->header('Laporan Pengadaan');
        //print_r($data);
        $this->load->view('laporan/p_laporan_pengadaan', $data);
        $this->footer();
    }

   

    
}
