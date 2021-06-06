<?php


class Pengaturan extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function profil()
    {
        $data['sig'] = $this->Main_model->get_sig($this->session->userdata('id'));
        $data['user'] = $this->Main_model->getUserWhere($this->session->userdata('user_id'));

        $this->header('Data pengadaan');
        $this->load->view('pengaturan/profil', $data);

        $this->footer();
    }

    public function insert_single_signature()
    {

        $img = $this->input->post('image');
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data1 = base64_decode($img);
        $file = './assets/signature-image/' . uniqid() . '.png';
        $success = file_put_contents($file, $data1);
        $image = str_replace('./', '', $file);

        $this->Main_model->insert_single_signature($image);
        echo '<img src="' . base_url() . $image . '">';
    }
}
