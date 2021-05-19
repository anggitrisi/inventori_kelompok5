<?php

class MY_Controller extends CI_Controller{
    public function header()
    {
        $this->load->view('__template/header');
    }

    public function sidebar()
    {
        $this->load->view('__template/sidebar');
    }

    public function footer()
    {
        $this->load->view('__template/footer');
    }
}
