<?php

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menus');
        if ($this->session->userdata('user_id')) {
        } else {
            redirect(base_url());
        }
        $this->load->model('Main_model');
        if ($this->session->userdata('user_id')) {
        } else {
            redirect(base_url());
        }
    }
    public function header($title)
    {
        $data['title'] = $title;
        $data['MY_Controller'] = $this;
        $data['parent_nav'] = $this->Menus->fetch_parent_navi();
        $this->load->view('__template/header', $data);
    }

    public function footer()
    {
        $this->load->view('__template/footer');
    }

    public function fetchsidebarChildMenuById($child_id)
    {
        if ($this->session->userdata('group_id') == 1) {

            $query = $this->db->query("SELECT * FROM usr_menu WHERE PARENT_ID =$child_id AND SHOW_IN_MENU = 1 ORDER BY SORT_ORDER ASC");
        }


        if ($this->session->userdata('group_id') != 1) {

            $group = $this->session->userdata('group_id');

            $query = $this->db->query("SELECT * FROM usr_menu AS UM , usr_permission UP

                                        WHERE

                                        UM.MENU_ID = UP.MENU_ID

                                        AND 

                                        UP.PER_SELECT =1 

                                        AND

                                        UP.GROUP_ID = $group

                                        AND

                                        UM.PARENT_ID =$child_id AND SHOW_IN_MENU = 1 ORDER BY SORT_ORDER ASC");
        }


        return $query->result();
    }
    //SET SAVE, DELETE, UPDATE, PERMISSIONS FOR PAGES.........................
    public function Getsave_up_delPermissions()
    {


        $menu_id = $this->session->userdata("MENU_ID");
        if (!empty($menu_id) && $this->session->userdata("group_id") != 1) {

            $group_id = $this->session->userdata("group_id");

            $permissionResult = $this->Menus->fetch_CoustomQuery("SELECT * FROM `usr_permission`

    											  WHERE GROUP_ID=$group_id AND 

    											  MENU_ID=$menu_id");

            foreach ($permissionResult as $permissionResults) {


                //SET SAVE BUTTON PERMISSION...............................................................

                if ($permissionResults->PER_INSERT == 1) {


                    $this->savePermission = "<input type='submit' value='Save' class='btn btn-success btn-large' >";
                } elseif ($permissionResults->PER_INSERT == 0) {


                    $this->savePermission = "<input type='button' value='Restricted' class='btn btn-warning' >";
                }


                //SET UPDATE BUTTON PERMISSION...............................................................

                if ($permissionResults->PER_UPDATE == 1) {


                    $this->editPermission = "";
                } elseif ($permissionResults->PER_UPDATE == 0) {


                    $this->editPermission = "style='display:none;'";
                }


                //SET DELETE BUTTON PERMISSION...............................................................

                if ($permissionResults->PER_DELETE == 1) {


                    $this->deletePermission = "";
                } elseif ($permissionResults->PER_DELETE == 0) {


                    $this->deletePermission = "style='display:none;'";
                }
            }
        } elseif ($this->session->userdata("group_id") == 1) {


            $this->savePermission = "<input type='submit' value='save' class='btn btn-success' >";

            $this->editPermission = "";

            $this->deletePermission = "";
        } //End Condition......


    }
}
