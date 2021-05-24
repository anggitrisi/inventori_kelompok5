<?php

class Dashboard extends MY_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->header('Dashboard');
        $this->load->view('__template/main');
        $this->footer();
    }
}