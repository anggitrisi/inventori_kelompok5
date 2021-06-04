<?php


class Supplier extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['supplier'] = $this->Main_model->select_record('supplier'); //supplier adalah nama tabel database
        $this->header('Data Supplier');
        $this->load->view('supplier/data_supplier', $data);
        $this->footer();
    }

    public function data_supplier()
    {
        $data['supplier'] = $this->Main_model->select_record('supplier'); //supplier adalah nama tabel database
        $this->header('Data Supplier');
        $this->load->view('supplier/data_supplier', $data);
        $this->footer();
    }

    public function tambah_supplier()
    {
        $this->header('Tambah Supplier');

        $this->load->view('supplier/tambah_supplier');

        $this->footer();
    }
    public function insert_supplier()
    {
        $data = array(
            'nama_supplier' => $this->input->post("nama_supplier"),
            'nama_perusahaan' => $this->input->post("nama_perusahaan"),
            'email' => $this->input->post("email"),
            'no_telp' => $this->input->post("no_telp"),
            'alamat' => $this->input->post("alamat"),
            'id_supplier' => $this->input->post("id_supplier")
        );

        $this->form_validation->set_rules('nama_supplier', 'Nama supplier', 'trim|required');
        $this->form_validation->set_rules('nama_perusahaan', 'Nama Perusahaan', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'valid_email|required');
        $this->form_validation->set_rules('no_telp', 'No Telepon', 'numeric|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->header('Tambah Supplier');
            $this->load->view('supplier/tambah_supplier');
            $this->footer();
        } else {
            $response = $this->Main_model->save_record('supplier', $data);
            if ($response == TRUE) {
                $this->session->set_flashdata('success', 'Data Supplier Berhasil Ditambahkan');
                redirect(base_url() . 'Supplier/data_supplier');
            }
        }
    }

    public function edit_supplier($id_supplier)
    {
        $data['edit_supplier'] = $this->Main_model->single_record('supplier', array('id_supplier' => $id_supplier));
        $this->header('Edit Supplier');
        $this->load->view('supplier/edit_supplier', $data);
        $this->footer();
    }

    public function update_supplier()
    {
        $postData = $this->input->post();

        $data = array(
            'nama_supplier' => $this->input->post("nama_supplier"),
            'nama_perusahaan' => $this->input->post("nama_perusahaan"),
            'email' => $this->input->post("email"),
            'no_telp' => $this->input->post("no_telp"),
            'alamat' => $this->input->post("alamat"),
            'id_supplier' => $this->input->post("id_supplier"),
        );
        $where = array('id_supplier' => $postData['id_supplier']);
        $response = $this->Main_model->update_record('supplier', $data, $where);
        if ($response == TRUE) {
            $this->session->set_flashdata('success', 'Data supplier berhasil diupdate');
            redirect(base_url() . 'Supplier');
        } else {
            $this->session->set_flashdata('info', 'Nothing updated');
            redirect(base_url() . 'Supplier');
        }
    }

    public function hapus_supplier($id)
    {
        $response = $this->Main_model->delete_record('supplier', 'id_supplier', $id);
        if ($response == TRUE) {
            $this->session->set_flashdata('success', "Record delection successfool");
            redirect(base_url() . 'Supplier');
        } else {
            $this->session->set_flashdata('error', "Something Went Wrong");
            redirect(base_url() . 'Supplier');
        }
    }

    public function aktifkan_supplier($id)
    {
        $status = 1;
        $this->Main_model->ubahaktifsupplier($id, $status);
        redirect(base_url() . 'Supplier');
    }

    public function nonaktifkan_supplier($id)
    {
        $status = 0;
        $this->Main_model->ubahaktifsupplier($id, $status);
        redirect(base_url() . 'Supplier');
    }
    public function detail_supplier($id){
        $data['empDetail']= $this->Main_model->single_record('supplier', array('id_supplier'=> $id));
        $this->header('Detail Supplier');
        $this->load->view('supplier/detail_supplier', $data);
        $this->footer();

    }
}
