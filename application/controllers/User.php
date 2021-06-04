<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class User extends MY_Controller
{

  public function tambah_user()
  {
    $data['petugas_tanpa_account'] = $this->Main_model->get_petugas_tanpa_account();
    $data['list_jabatan'] = $this->Main_model->select_record('usr_group');
    $data['list_user'] = $this->Main_model->get_user_list();

    $this->header('Tambah User');
    $this->load->view('users/data_user', $data);
    $this->footer();
  }

  public function create_user()
  {
    $data['petugas_tanpa_account'] = $this->Main_model->get_petugas_tanpa_account();
    $data['list_jabatan'] = $this->Main_model->select_record('usr_group');
    $data['list_user'] = $this->Main_model->get_user_list();


    $this->form_validation->set_rules('id_petugas', 'Petugas', 'required');
    $this->form_validation->set_rules('id_group', 'Jabatan', 'required');
    $this->form_validation->set_rules(
      'username',
      'Username',
      'required|trim|min_length[4]|is_unique[usr_user.USER_NAME]',
      ['is_unique' => 'Username ini sudah dimiliki pengguna lain']
    );
    $this->form_validation->set_rules(
      'password',
      'Password',
      'required|trim|min_length[4]',
      ['min_length' => 'Password minimal terdiri dari 6 karakter, cek kembali password anda']
    );


    if ($this->form_validation->run() == FALSE) {
      $this->header('Tambah User');
      $this->load->view('users/data_user', $data);
      $this->footer();
    } else {
      $data = [
        'USER_NAME' => $this->input->post('username', true),
        'U_PASSWORD' => password_hash($this->input->post('password', true), PASSWORD_DEFAULT),
        'GROUP_ID' => $this->input->post('id_group', true)
      ];

      $id_petugas = $this->input->post('id_petugas', true);
      //dapatkan USER_ID dari create_user (dimodel USER_ID di returkan)
      $USER_ID = $this->Main_model->create_user('usr_user', $data);


      //update tabel petugas masukkan USER_ID untuk petugas yang dibuat
      $this->db->set('USER_ID', $USER_ID);
      $this->db->where('id_petugas', $id_petugas);
      $this->db->update('petugas');

      $this->session->set_flashdata('success', 'User baru berhasil ditambahkan!');
      redirect('User/tambah_user');
    }
  }

  public function edit_user($USER_ID)
  {
    $data['edit_user'] = $this->Main_model->single_record('usr_user', array('USER_ID' => $USER_ID));
    $data['list_jabatan'] = $this->Main_model->select_record('usr_group');


    var_dump($data['list_jabatan']);
    $this->header('Edit user');
    $this->load->view('users/edit_user', $data);
    $this->footer();
  }

  public function update_user()
  {
    $postData = $this->input->post();

    $data = array(
      'USER_NAME' => $this->input->post("USER_NAME"),
      'GROUP_ID' => $this->input->post("GROUP_ID"),
      'U_PASSWORD' => $this->input->post("password"),
    );
    $where = array('USER_ID' => $postData['USER_ID']);
    $response = $this->Main_model->update_record('usr_user', $data, $where);
    if (response == TRUE) {
      $this->session->set_flashdata('success', 'Data user berhasil diupdate');
      redirect(base_url() . 'user/tambah_user');
    } else {
      $this->session->set_flashdata('info', 'Nothing updated');
      redirect(base_url() . 'user/tambah_user');
    }
  }

  public function hapus_user($id)
  {
    $response = $this->Main_model->delete_record('usr_user', 'USER_ID', $id);
    if ($response == TRUE) {
      $this->session->set_flashdata('warning', "Data user berhasil dihapus");
      redirect(base_url() . 'user/tambah_user');
    } else {
      $this->session->set_flashdata('error', "Something Went Wrong");
      redirect(base_url() . 'user/tambah_user');
    }
  }

  public function aktifkan_user($id)
  {
    $status = 1;
    $this->Main_model->ubahaktifuser($id, $status);
    redirect(base_url() . 'user/tambah_user');
  }

  public function nonaktifkan_user($id)
  {
    $status = 0;
    $this->Main_model->ubahaktifuser($id, $status);
    redirect(base_url() . 'user/tambah_user');
  }
  public function detail_user($id)
  {
    $data['userDetail'] = $this->Main_model->getUserDetails($id);

    $this->header('Detail user');
    $this->load->view('users/detail_user', $data);
    $this->footer();
  }


  /// batasssss untuk naomi

  // List Categories
  public function grup_user()
  {
    $data['grup_user'] = $this->Main_model->get_record('usr_group');
  


    // var_dump($data['grup_user']);

    // var_dump($data['kategori']);

    $this->header('Grup User');
    $this->load->view('users/data_grup_user', $data);
    $this->footer();
  }

  public function insert_grup_user()
  {
    $data = array(
      'GROUP_NAME' => $this->input->post('GROUP_NAME')
    );
    $response = $this->Main_model->save_record('usr_group', $data);
    if ($response == TRUE) {
      $this->session->set_flashdata('success', 'Data Grup User Berhasil Ditambahkan');
      redirect(base_url() . 'user/grup_user');
    }
  }

  public function update_grup_user()
  {
    $grup_users = $this->input->post('id_grup');

    $data = array(
      'GROUP_NAME' => $this->input->post('GROUP_NAME'),
    );
    $where = array('GROUP_ID' => $grup_users);
    $this->load->model('Main_model');
    $response = $this->Main_model->update_record('usr_group', $data, $where);
    if ($response) {
      $this->session->set_flashdata('info', 'Record Updated Successfully..!');
      redirect(base_url() . 'user/grup_user');
    }
  }

  public function hapus_grup_user($id)
  {
    $response = $this->Main_model->delete_record('usr_group', 'GROUP_ID', $id);
    if ($response == TRUE) {
      $this->session->set_flashdata('warning', "Data Group User Berhasil Dihapus");
      redirect(base_url() . 'user/grup_user');
    } else {
      $this->session->set_flashdata('error', "Something Went Wrong");
      redirect(base_url() . 'user/grup_user');
    }
  }
}
