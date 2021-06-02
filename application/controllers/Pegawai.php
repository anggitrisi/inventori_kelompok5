<?php


class Pegawai extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['pegawai'] = $this->Main_model->select_record('pegawai'); //pegawai adalah nama tabel database
        $this->header('Data Pegawai');
        $this->load->view('pegawai/data_pegawai', $data);
        $this->footer();
    }

    public function data_pegawai()
    {
        $data['pegawai'] = $this->Main_model->select_record('pegawai'); //pegawai adalah nama tabel database
        $this->header('Data Pegawai');
        $this->load->view('pegawai/data_pegawai', $data);
        $this->footer();
    }

    public function tambah_pegawai()
    {
        $this->header('Tambah Pegawai');

        $this->load->view('pegawai/tambah_pegawai');

        $this->footer();
    }
    public function insert_pegawai()
    {
        $data = array(
            'EMP_NAME' => $this->input->post('emp_name'),
            'EMP_EMAIL' => $this->input->post('emp_email'),
            'EMP_ADDRESS' => $this->input->post('address'),
            'EMP_GENDER' => $this->input->post('emp_gender'),
            'EMP_CELL' => $this->input->post('emp_cell'),
            'CREATED_DATE' => date("Y-m-d"),
            // 'CREATED_USERID'=>$this->session->user_data('user_id'),
        );

        $this->form_validation->set_rules('emp_name', 'Nama Pegawai', 'trim|required');
        $this->form_validation->set_rules('emp_email', 'Email', 'valid_email|required');
        $this->form_validation->set_rules('address', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('emp_gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('emp_cell', 'No Handphone', 'numeric|required');

        if ($this->form_validation->run() == FALSE) {
            $this->header('Tambah Pegawai');
            $this->load->view('pegawai/tambah_pegawai');
            $this->footer();
        } else {
            $response = $this->Main_model->save_record('pegawai', $data);
            if ($response == TRUE) {
                $this->session->set_flashdata('success', 'Data pegawai Berhasil Ditambahkan');
                redirect(base_url() . 'Pegawai/data_pegawai');
            }
        }
    }

    public function edit_pegawai($emp_id)
    {
        $data['edit_pegawai'] = $this->Main_model->single_record('pegawai', array('EMP_ID' => $emp_id));
        $this->header('Edit pegawai');
        $this->load->view('pegawai/edit_pegawai', $data);
        $this->footer();
    }

    public function update_pegawai()
    {
        $postData = $this->input->post();

        $data = array(
            'EMP_NAME' => $postData['emp_name'],
            'EMP_EMAIL' => $postData['emp_email'],
            'EMP_ADDRESS' => $postData['address'],
            'EMP_GENDER' => $postData['emp_gender'],
            'EMP_CELL' => $postData['emp_cell'],
            'CREATED_DATE' => date("Y-m-d"),
            // 'CREATED_USERID'=>$this->session->user_data('user_id'),
        );
        $where = array('EMP_ID' => $postData['emp_id']);
        $response = $this->Main_model->update_record('pegawai', $data, $where);
        if (response == TRUE) {
            $this->session->set_flashdata('success', 'Data pegawai berhasil ditambahkan');
            redirect(base_url() . 'Pegawai');
        } else {
            $this->session->set_flashdata('info', 'Nothing updated');
            redirect(base_url() . 'Pegawai');
        }
    }

    public function hapus_pegawai($id)
    {
        $response = $this->Main_model->delete_record('pegawai', 'EMP_ID', $id);
        if ($response == TRUE) {
            $this->session->set_flashdata('success', "Record delection successfool");
            redirect(base_url() . 'Pegawai');
        } else {
            $this->session->set_flashdata('error', "Something Went Wrong");
            redirect(base_url() . 'Pegawai');
        }
    }

    public function aktifkan_pegawai($id)
    {
        $status = 1;
        $this->Main_model->ubahaktifPegawai($id, $status);
        redirect(base_url() . 'Pegawai');
    }

    public function nonaktifkan_pegawai($id)
    {
        $status = 0;
        $this->Main_model->ubahaktifPegawai($id, $status);
        redirect(base_url() . 'Pegawai');
    }

    public function detail_pegawai($id)
    {
        $data['empDetail'] = $this->Main_model->single_record('pegawai', array('EMP_ID' => $id));
        $this->header('Employee Details');
        $this->load->view('pegawai/detail_pegawai', $data);
        $this->footer();
    }
}
