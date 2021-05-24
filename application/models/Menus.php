<?php
class Menus extends CI_Model {

public function fetch_parent_navi()
{
    return $this->db->select()->from('usr_menu')->where("PARENT_ID",0)->get()->result();
}

public function fetchChildMenus($parent_id)
{
    $group_id = $this->session->userdata('group_id');
    if($group_id == 1):
        $query = $this->db->select()->from('usr_menu')
        ->where('PARENT_ID',$parent_id)
        ->where('SHOW_IN_MENU', 1)
        ->ORDER_BY('SORT_ORDER','ASC')->get();
        return $query->result();
    else:
        $query = $this->db->select()->from('usr_menu as um','usr_permission as up')
            ->where('um.MENU_ID = up.MENU_ID')
            ->where('up.PER_SELECT', 1)
            ->where('up.GROUP_ID',$group_id)
            ->where('um.PARENT_UD',$parent_id)
            ->where('um.SHOW_IN_MENU',1)
            ->group_by('um.SORT_ORDER', 'ASC')->get();

    endif;


}
}
