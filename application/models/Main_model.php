<?php

class Main_model extends CI_Model
{

  public function select_record($table, $where = '')
  {

    $this->db->select()->from($table);
    if ($where) {
      $this->db->where($where);
    }
    $query = $this->db->get();
    return $query->result();
  }

  public function save_record($table, $data)
  {
    $this->db->insert($table, $data);
    if ($query = $this->db->affected_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function delete_record($table, $field_name, $id)
  {
    $query = $this->db->where($field_name, $id);
        $this->db->delete($table);
        if ($query != NULL)
            return $query;
        else
            return false;
  }

  public function single_record($table, $where = '')
  {
    $this->db->select()->from($table);
    if ($where) {
      $this->db->where($where);
    }
    $query = $this->db->get();
    return $query->row();
  }

  public function update_record($table, $data, $where)
  {
    $this->db->where($where);
    $query = $this->db->update($table, $data);
    if ($this->db->affected_rows() > 0) 
      return TRUE;
     else 
      return FALSE;
    
  }

  // fetching records by single column
  public function fetch_bysinglecol($col, $tbl, $id)
  {
    $where = array(

      $col => $id

    );


    $this->db->select()->from($tbl)->where($where);

    $query = $this->db->get();

    return $result = $query->result();
  }

  //get user details
  public function getUserDetails($user_id)
  {
    $this->db->select("e.nama_petugas,e.no_telepon,e.gambar_petugas,g.GROUP_NAME as jabatan");
    $this->db->from('petugas as e, usr_user as u', 'usr_group as g');
    $this->db->join('usr_group as g', 'g.GROUP_ID = u.GROUP_ID');
    $this->db->where('u.USER_ID = e.USER_ID');
    $this->db->where('u.GROUP_ID   = g.GROUP_ID ');
    $this->db->where('u.USER_ID', $user_id);
    $query = $this->db->get();
    return $query->row();
  }

  public function create_record($data, $tbl)
  {
    $this->db->set($data);

    $this->db->insert($tbl);
  }

  public function select($table)
    {
        $this->db->select();
        $this->db->from($table);
        $query = $this->db->get();
        return $query->result();
    }

    public function item_cat()
    {
        {
            $sql = $this->db->select("*")
                ->FROM('barang AS b,kategori as k')
                ->where('b.id_kategori = k.id_kategori')
                ->get();
    
            return $sql->result();
        }
    
    }

    public function insertData($gambar)
	{
        $data = [
            'nama_barang'=>$this->input->post('nama_barang', true),
            'merek'=>$this->input->post('merek', true),
            // 'jumlah'=>$this->input->post('jumlah', true),
            'gambar'=>$this->_uploadImage(),
            'keterangan'=>$this->input->post('keterangan', true),
            'id_kategori'=>$this->input->post('id_kategori', true)
        ];

        $this->db->insert('barang', $data);
    }

    private function _uploadImage()
	{
			$config['upload_path'] = './assets_user/img/';
			$config['file_name'] = $this-> nama;
			$config['allowed_types'] = 'jpg|png';
			$config['max_size'] = 2000;

			$this->load->library('upload', $config);
		if($this->upload->do_upload('gambar')){
			return $this->upload->data("file_name");
		}
		return "default.jpg";
	}

    public function getUserById($id_barang) {
			
		return $this->db->get_where('barang', ['id_barang' => $id_barang ])->row_array();

	}

	public function updateData($id_barang) {

        $nama_barang = $this->input->post('nama_barang');
        $merek = $this->input->post('merek');
        // $jumlah = $this->input->post('jumlah');
        $keterangan = $this->input->post('keterangan');
        $id_kategori = $this->input->post('id_kategori');

		//cek jika ada gambar yang akan diupload
		$upload_image = $_FILES['gambar']['name'];

		if($upload_image) {
			$config['allowed_types'] 	= 'gif|jpg|jpeg|png';
			
			$config['upload_path']		= './assets_user/img/';

			$this->load->library('upload', $config);

			if($this->upload->do_upload('gambar')) {
				//untuk menghapus gambar lama ketika user mengganti gambarnya
				$old_image = $data['buku']['gambar'];
				if($old_image != 'default.png') {
					unlink(FCPATH . './assets_user/img/' . $old_image);
				}

				//mengambil nama file yang baru
				$new_image = $this->upload->data('file_name');
				$this->db->set('gambar', $new_image);
			}

			else {
				echo $this->upload->display_errors();
			}

		}
      $this->db->set('nama_barang', $nama_barang);
      $this->db->set('merek', $merek);
      // $this->db->set('jumlah', $jumlah);
      $this->db->set('keterangan', $keterangan);
      $this->db->set('id_kategori', $id_kategori);
      $this->db->where('id_barang', $id_barang);
      $this->db->update('barang');

	}
  function add_record($table, $array_data)
  {
      $query = $this->db->insert($table, $array_data);
      if ($query == 1)
          return $query;
      else
          return false;
  }
}
