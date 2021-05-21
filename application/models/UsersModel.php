<?php
class UsersModel extends CI_Model{
    function registerUser($data){
        $this->db->insert('usr_user', $data);
        if($response){
            return 1;
        } else {
            return 0;
        }
    }

    public function authenticateUser($email, $password){
        $pass = sha1(md5($password));
        $this->db->select("*");
        $this->db->from('usr_user');
        $this->db->where('USER_NAME', $email);
        $this->db->where('U_PASSWORD', $pass);
        $this->db->where('IS_ACTIVE', '1');
        $query = $this->db->get();

        return $query->first_row('array');
    }

    public function getLoggedInUserGroup($group_id)
    {
        $this->db->select('GROUP_NAME')->from('usr_group')->where('GROUP_ID',$group_id)->get()->row_array();
        return $query;
    }

    public function create_record($table,$data){
        $query = $this->db->insert($table,$data);
        if($this->db->affected_rows() > 0){
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }
}
?>