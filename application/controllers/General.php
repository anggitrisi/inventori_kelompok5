<?php

class General extends MY_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  //GET PAGE/CONTROLLER/CONTROLLER-FUNCTION NAME............................
  public function getpage($page)
  {
    $this->session->set_userdata('Menu_ID', $page);
    $group_id = $this->session->userdata('group_id');
    $page = $this->Main_model->fetch_bysinglecol('Menu_ID', 'usr_menu', $page);
    foreach ($page as $pagerow) {
      $getPage = $pagerow->MENU_URL;
      //SET SESSION FOR PAGE ID................................................
      $this->session->set_userdata("menu_id", $pagerow->MENU_ID);
    }
    redirect(base_url() . $getPage);
  }
}
