<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kategori extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Check if user is logged in or id exists in session
    }

    public function index(){
        $data['kategori'] = $this->Main_model->select_record('kategori'); //kategori adalah nama tabel database
    	$this->header('Data Kategori');
    	$this->load->view('kategori/data_kategori',$data);
    	$this->footer();
    }

    // List Categories
    public function data_kategori()
    {
       
        $data['kategori'] = $this->Main_model->select_record('kategori');
        $this->header($title = 'Data Kategori');

        $this->load->view('kategori/data_kategori', $data);

        $this->footer();

    }

    public function insert_kategori()
    {
    $data = array (
        'nama_kategori'=>$this->input->post('nama_kategori')
    );
    $response = $this->Main_model->save_record('kategori',$data);
    if ($response == TRUE) {
    $this->session->set_flashdata('success','Data kategori Berhasil Ditambahkan');
    redirect(base_url().'kategori/data_kategori');
    }

    }

    public function update_kategori()
    {
        $kategories = $this->input->post('i_kategori');

        $kategori = array(
            'nama_kategori' => $this->input->post('nama_kategori'),
        );
        $where = array('id_kategori' => $kategories);
        $this->load->model('Main_model');
        $response = $this->Main_model->update_record('kategori', $kategori, $where);
        if ($response) {
            $this->session->set_flashdata('info', 'Record Updated Successfully..!');
            redirect(base_url() . 'kategori/data_kategori');
        }
    }
    
    public function hapus_kategori($id){   
        $response = $this->Main_model->delete_record('kategori','id_kategori',$id);
        if($response == TRUE){
            $this->session->set_flashdata('success', "Record delection successfool");
            redirect(base_url().'Kategori'); 
        } else {
            $this->session->set_flashdata('error', "Something Went Wrong");
            redirect(base_url().'Kategori');
        }
    }

    
}
