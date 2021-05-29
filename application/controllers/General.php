<?php

/**
 * Class dashboard
 *
 * @property CI_Session session
 * @property General General
 * @property Menus Menus
 */

class General extends MY_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  //GET PAGE/CONTROLLER/CONTROLLER-FUNCTION NAME............................
  public function getpage($page)
  {
    $this->session->set_userdata('MENU_ID', $page);
    $group_id = $this->session->userdata('group_id');
    $page = $this->Main_model->fetch_bysinglecol('Menu_ID', 'usr_menu', $page);
    $this->create_breadcrums();
    foreach ($page as $pagerow) {
      $getPage = $pagerow->MENU_URL;
      //SET SESSION FOR PAGE ID................................................
      $this->session->set_userdata("menu_id", $pagerow->MENU_ID);
    }
    redirect(base_url() . $getPage);
  }

  // Creating breadcrumbs
  public function create_breadcrums()
  {

    $row = $this->Main_model->fetch_bysinglecol("MENU_ID", "usr_menu", $this->session->userdata("MENU_ID"));

    foreach ($row as $row_r) {

      if ($row_r->PARENT_ID != 0) {

        $this->session->set_userdata("child_name", $row_r->MENU_TEXT);
        $this->session->set_userdata("child_url", base_url() . $row_r->MENU_URL);

        $row2 = $this->Main_model->fetch_bysinglecol("MENU_ID", "usr_menu", $row_r->PARENT_ID);

        foreach ($row2 as $row_r2) {

          $this->session->set_userdata("parent_name", $row_r2->MENU_TEXT);
        }
      } else {
        $this->session->set_userdata("parent_name", $row_r->MENU_TEXT);
      }
    }
  }
}
