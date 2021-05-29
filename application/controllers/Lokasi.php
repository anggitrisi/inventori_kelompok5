<?php


class Lokasi extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['lokasi'] = $this->Main_model->select_record('lokasi'); //lokasi adalah nama tabel database
        $this->header('Data Lokasi');
        $this->load->view('lokasi/data_lokasi', $data);
        $this->footer();
    }

    public function data_lokasi()
    {
        $data['lokasi'] = $this->Main_model->select_record('lokasi'); //lokasi adalah nama tabel database
        $this->header('Data Lokasi');
        $this->load->view('lokasi/data_lokasi', $data);
        $this->footer();
    }

    public function tambah_lokasi()
    {
        $this->header('Tambah Lokasi');

        $this->load->view('lokasi/tambah_lokasi');

        $this->footer();
    }
    public function insert_lokasi()
    {
        $data = array(
            'nama_lokasi' => $this->input->post('nama_lokasi'),
            'fakultas' => $this->input->post('fakultas'),
            // 'CREATED_USERID'=>$this->session->user_data('user_id'),
        );

        $this->form_validation->set_rules('nama_lokasi', 'Nama lokasi', 'trim|required');
        $this->form_validation->set_rules('fakultas', 'Email', 'trim|required');


        if ($this->form_validation->run() == FALSE) {
            $this->header('Tambah Lokasi');
            $this->load->view('lokasi/tambah_lokasi');
            $this->footer();
        } else {
            $response = $this->Main_model->save_record('lokasi', $data);
            if ($response == TRUE) {
                $this->session->set_flashdata('success', 'Data Lokasi Berhasil Ditambahkan');
                redirect(base_url() . 'Lokasi/data_lokasi');
            }
        }
    }

    public function edit_lokasi($id_lokasi)
    {
        $data['edit_lokasi'] = $this->Main_model->single_record('lokasi', array('id_lokasi' => $id_lokasi));
        $this->header('Edit Lokasi');
        $this->load->view('lokasi/edit_lokasi', $data);
        $this->footer();
    }

    public function update_lokasi()
    {
        $postData = $this->input->post();

        $data = array(
            'nama_lokasi' => $this->input->post('nama_lokasi'),
            'fakultas' => $this->input->post('fakultas'),
            // 'CREATED_USERID'=>$this->session->user_data('user_id'),
        );

        $where = array('id_lokasi' => $postData['id_lokasi']);
        $response = $this->Main_model->update_record('lokasi', $data, $where);
        if (response == TRUE) {
            $this->session->set_flashdata('success', 'Data Lokasi berhasil diupdate');
            redirect(base_url() . 'Lokasi');
        } else {
            $this->session->set_flashdata('info', 'Nothing updated');
            redirect(base_url() . 'Lokasi');
        }
    }

    public function hapus_lokasi($id)
    {
        $response = $this->Main_model->delete_record('lokasi', 'id_lokasi', $id);
        if ($response == TRUE) {
            $this->session->set_flashdata('success', "Record delection successfool");
            redirect(base_url() . 'Lokasi');
        } else {
            $this->session->set_flashdata('error', "Something Went Wrong");
            redirect(base_url() . 'Lokasi');
        }
    }

    public function aktifkan_lokasi($id)
    {
        $status = 1;
        $this->Main_model->ubahaktiflokasi($id, $status);
        redirect(base_url() . 'Lokasi');
    }

    public function nonaktifkan_lokasi($id)
    {
        $status = 0;
        $this->Main_model->ubahaktiflokasi($id, $status);
        redirect(base_url() . 'Lokasi');
    }
    public function detail_lokasi($id){
        $data['empDetail']= $this->Main_model->single_record('lokasi', array('id_lokasi'=> $id));
        $this->header('Detail Lokasi');
        $this->load->view('lokasi/detail_lokasi', $data);
        $this->footer();

    }
}
