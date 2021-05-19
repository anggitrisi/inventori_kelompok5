<?php

class Dashboard extends MY_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->header();
        $this->sidebar();
        $this->load->view('__template/dashboard');
        $this->footer();
    }
}