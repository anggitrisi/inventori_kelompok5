<?php


class Petugas extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['jabatan'] = $this->Main_model->group_id();
        $data['petugas'] = $this->Main_model->select_record('petugas'); //petugas adalah nama tabel database
        $this->header('Data Petugas');
        $this->load->view('petugas/data_petugas', $data);
        $this->footer();
    }

    public function data_petugas()
    {
        $data['jabatan'] = $this->Main_model->group_id();
        $data['petugas'] = $this->Main_model->select_record('petugas'); //petugas adalah nama tabel database
        $this->header('Data Petugas');     //ini diganti jadi dua parameter
        $this->load->view('petugas/data_petugas', $data);
        $this->footer();
    }

    public function tambah_petugas()
    {
        $data['usr_group'] = $this->Main_model->select('usr_group');
        $this->header('Tambah Petugas');

        $this->load->view('petugas/tambah_petugas',  $data);

        $this->footer();

    }
    
    public function insert_petugas()
    {
        $data['usr_group'] = $this->Main_model->select('usr_group');
        $data = array(
            'nama_petugas' => $this->input->post('nama_petugas'),
            'no_telepon' => $this->input->post('no_telepon'),
            'alamat' => $this->input->post('alamat'),
            'GROUP_ID' => $this->input->post('GROUP_ID'),
            // 'USER_ID' => $this->session->user_data('USER_ID')
        );

        $this->form_validation->set_rules('nama_petugas', 'Nama Petugas', 'trim|required');         
        $this->form_validation->set_rules('no_telepon', 'No Handphone', 'numeric|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('GROUP_ID', 'Group ID', 'trim|required');
        // $this->form_validation->set_rules('USER_ID', 'USER ID', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->header('Tambah Petugas');
            $this->load->view('petugas/tambah_petugas');
            $this->footer();
        } else {
            $response = $this->Main_model->save_record('petugas', $data);
            if ($response == TRUE) {
                $this->session->set_flashdata('success', 'Data petugas Berhasil Ditambahkan');
                redirect(base_url() . 'Petugas/data_petugas');
            }
        }
    }

    public function edit_petugas($id_petugas)
    {
        $data['result'] = $this->Main_model->getUserById($id_petugas);
        $data['edit_petugas'] = $this->Main_model->single_record('petugas', array('id_petugas' => $id_petugas));
        $data['usr_group'] = $this->Main_model->select('usr_group');
        $this->header('Edit petugas');
        $this->load->view('petugas/edit_petugas', $data);
        $this->footer();
        // var_dump($data['edit_petugas']);
    }

    public function update_petugas()
    {
        $postData = $this->input->post();

        $data = array(
            'nama_petugas' => $this->input->post('nama_petugas'),
            'no_telepon' => $this->input->post('no_telepon'),
            'alamat' => $this->input->post('alamat'),
            'GROUP_ID' => $this->input->post('GROUP_ID'),
            // 'CREATED_USERID'=>$this->session->user_data('user_id'),
        );
        $where = array('id_petugas' => $postData['id_petugas']);
        $response = $this->Main_model->update_record('petugas', $data, $where);
        if ($response == TRUE) {
            $this->session->set_flashdata('success', 'Data petugas berhasil diupdate');
            redirect(base_url() . 'Petugas');
        } else {
            $this->session->set_flashdata('info', 'Nothing updated');
            redirect(base_url() . 'Petugas');
        }
    }

    public function hapus_petugas($id)
    {
        $response = $this->Main_model->delete_record('petugas', 'id_petugas', $id);
        if ($response == TRUE) {
            $this->session->set_flashdata('success', "Record delection successfool");
            redirect(base_url() . 'Petugas');
        } else {
            $this->session->set_flashdata('error', "Something Went Wrong");
            redirect(base_url() . 'Petugas');
        }
    }

    public function aktifkan_petugas($id)
    {
        $status = 1;
        $this->Main_model->ubahaktifPetugas($id, $status);
        redirect(base_url() . 'Petugas');
    }

    public function nonaktifkan_petugas($id)
    {
        $status = 0;
        $this->Main_model->ubahaktifPetugas($id, $status);
        redirect(base_url() . 'Petugas');
    }

    public function detail_petugas($id){
        $data['empDetail']= $this->Main_model->single_record('petugas', array('id_petugas'=> $id));
        $this->header('Detail Petugas');
        $this->load->view('petugas/detail_petugas', $data);
        $this->footer();

    }
}
