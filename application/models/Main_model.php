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
    $this->db->select("u.user_name, e.nama_petugas,e.no_telepon,e.gambar_petugas,g.GROUP_NAME as jabatan");
    $this->db->from('usr_user as u');
    $this->db->join('petugas as e', 'e.USER_ID = u.USER_ID', 'left');
    $this->db->join('usr_group as g', 'g.GROUP_ID = u.GROUP_ID');
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

  public function get_pengadaan()
  {

    $this->db->select('*');
    $this->db->from('pengadaan');
    $this->db->join('supplier', 'supplier.id_supplier = pengadaan.id_supplier');
    $this->db->join('petugas', 'petugas.USER_ID = pengadaan.USER_ID');

    $query = $this->db->get();
    return $query->result();
  }

  /*join tabel pengadaan dengan supplier 
  dengan petugas as petugas_peminta untuk mendapatkan nama dari USER_ID di tabel pengadaan (petugas peminta)
  dengan petugas as petugas_penyetuju untuk mendapatkan nama dari disetujui_oleh di tabel pengadaan
  */
  public function get_detail_pengadaan($id)
  {
    $this->db->select('pengadaan.*,supplier.nama_supplier,supplier.nama_perusahaan,supplier.email,supplier.no_telp as no_telpSupplier,supplier.alamat as alamatSupplier,petugas_peminta.nama_petugas as petugas_peminta,petugas_peminta.no_telepon as no_telpPetugasPeminta,petugas_peminta.alamat as alamatPetugasPeminta,petugas_penyetuju.nama_petugas as petugas_penyetuju,petugas_penyetuju.no_telepon as no_telpPetugasPenyetuju,petugas_penyetuju.alamat as alamatPetugasPenyetuju');
    $this->db->from('pengadaan');
    $this->db->join('supplier', 'supplier.id_supplier = pengadaan.id_supplier', 'left');
    $this->db->join('petugas as petugas_peminta', 'petugas_peminta.USER_ID = pengadaan.USER_ID', 'left');
    //left outer join perlu karena tidak semua barang yang diminta untuk diadakan sudah disetujui
    $this->db->join('petugas as petugas_penyetuju', 'petugas_penyetuju.USER_ID = pengadaan.disetujui_oleh', 'left');
    $this->db->join('petugas as petugas_pembayar', 'petugas_pembayar.USER_ID = pengadaan.dibayar_oleh', 'left');

    $this->db->where('id_pengadaan', $id);
    $query = $this->db->get();
    return $query->row();
  }

  /*dapatkan semua item yang diminta dengan id_pengadaan = $id
  join tabel permintaan_pengadaan_item dengan tabel barang
  untuk mendapatkan detail barang
  */
  public function get_detail_pengadaan_item($id)
  {
    $this->db->select('*');
    $this->db->from('permintaan_pengadaan_item');
    $this->db->join('barang', 'barang.id_barang = permintaan_pengadaan_item.id_barang');
    $this->db->having('id_pengadaan', $id);
    $query = $this->db->get();
    return $query->result();
  }

  //FUNGSI UNTUK MENGHAPUS PENGADAAN
  public function delete_pengadaan($id)
  {
    $this->db->where('id_pengadaan', $id);
    $this->db->delete('pengadaan');
  }

  public function save_batch_permintaan($data)
  {
    return $this->db->insert_batch('permintaan_pengadaan_item', $data);
  }

  //data invoice diambil dari data pengadaan yang sudah disetujui (id_bayar = 1)
  public function get_invoice_pengadaan()
  {

    $this->db->select('*');
    $this->db->from('pengadaan');
    $this->db->join('supplier', 'supplier.id_supplier = pengadaan.id_supplier');
    $this->db->join('petugas as petugas_peminta', 'petugas_peminta.USER_ID = pengadaan.USER_ID');
    //left outer join perlu karena tidak semua barang yang diminta untuk diadakan sudah disetujui
    $this->db->join('petugas as petugas_penyetuju', 'petugas_penyetuju.USER_ID = pengadaan.disetujui_oleh', 'left');
    $this->db->having('pengadaan.status', 1);
    $query = $this->db->get();
    return $query->result();
  }

  public function ubahStatusBayar($id, $status)
  {
    $atur = array(
      '_dibayar' => $status
    );

    $this->db->where('id_pengadaan', $id);
    $this->db->update('pengadaan', $atur);
  }
  public function get_penempatan()
  {

    $this->db->select('*');
    $this->db->from('penempatan');
    $this->db->join('lokasi', 'lokasi.id_lokasi = penempatan.id_lokasi');
    $this->db->join('petugas as petugas_peminta', 'petugas_peminta.USER_ID = penempatan.USER_ID', 'left');
    //left outer join perlu karena tidak semua barang yang diminta untuk diadakan sudah disetujui
    $this->db->join('petugas as petugas_penyetuju', 'petugas_penyetuju.USER_ID = penempatan.disetujui_oleh', 'left');
    $this->db->join('pegawai', 'pegawai.EMP_ID = penempatan.pegawai_penanggung_jawab', 'left');
    $query = $this->db->get();
    return $query->result();
  }

  public function get_detail_penempatan($id)
  {
    $this->db->select('penempatan.*,lokasi.*,petugas_peminta.nama_petugas as petugas_peminta,petugas_peminta.no_telepon as no_telpPetugasPeminta,petugas_peminta.alamat as alamatPetugasPeminta,petugas_penyetuju.nama_petugas as petugas_penyetuju,petugas_penyetuju.no_telepon as no_telpPetugasPenyetuju, petugas_penyetuju.alamat as alamatPetugasPenyetuju, penanggung_jawab.*');
    $this->db->from('penempatan');
    $this->db->join('lokasi', 'lokasi.id_lokasi = penempatan.id_lokasi', 'left');
    $this->db->join('petugas as petugas_peminta', 'petugas_peminta.USER_ID = penempatan.USER_ID', 'left');
    //left outer join perlu karena tidak semua barang yang diminta untuk diadakan sudah disetujui
    $this->db->join('petugas as petugas_penyetuju', 'petugas_penyetuju.USER_ID = penempatan.disetujui_oleh', 'left');
    $this->db->join('pegawai as penanggung_jawab', 'penanggung_jawab.EMP_ID = penempatan.pegawai_penanggung_jawab', 'left');
    $this->db->where('id_penempatan', $id);
    $query = $this->db->get();
    return $query->row();
  }

  /*dapatkan semua item yang diminta dengan id_penempatan = $id
  join tabel permintaan_penempatan_item dengan tabel barang
  untuk mendapatkan detail barang
  */
  public function get_detail_penempatan_item($id)
  {
    $this->db->select('*');
    $this->db->from('permintaan_penempatan_item');
    $this->db->join('barang', 'barang.id_barang = permintaan_penempatan_item.id_barang');
    $this->db->having('id_penempatan', $id);
    $query = $this->db->get();
    return $query->result();
  }

  public function save_batch_permintaan_penempatan($data)
  {
    return $this->db->insert_batch('permintaan_penempatan_item', $data);
  }

  //FUNGSI UNTUK MENGHAPUS PENEMPATAN
  public function delete_penempatan($id)
  {
    $this->db->where('id_penempatan', $id);
    $this->db->delete('penempatan');
  }

  public function select($table)
  {
    $this->db->select();
    $this->db->from($table);
    $query = $this->db->get();
    return $query->result();
  }

  public function item_cat()
  { {
      $sql = $this->db->select("*")
        ->FROM('barang AS b,kategori as k')
        ->where('b.id_kategori = k.id_kategori')
        ->get();

      return $sql->result();
    }
  }

  public function ubahaktifpegawai($id, $status)
  {
    $atur = array(
      'STATUS' => $status
    );

    $this->db->where('EMP_ID', $id);
    $this->db->update('pegawai', $atur);
  }

  public function ubahaktifpetugas($id, $status)
  {
    $atur = array(
      'STATUS' => $status
    );

    $this->db->where('id_petugas', $id);
    $this->db->update('petugas', $atur);
  }

  public function ubahaktifsupplier($id, $status)
  {
    $atur = array(
      'STATUS' => $status
    );

    $this->db->where('id_supplier', $id);
    $this->db->update('supplier', $atur);
  }

  public function group_id()
  { {
      $sql = $this->db->select("*")
        ->FROM('petugas AS p, usr_group as g')
        ->where('p.GROUP_ID = g.GROUP_ID')
        ->get();

      return $sql->result();
    }
  }


  public function insertData($gambar)
  {
    $data = [
      'nama_barang' => $this->input->post('nama_barang', true),
      'merek' => $this->input->post('merek', true),
      // 'jumlah'=>$this->input->post('jumlah', true),
      'gambar' => $this->_uploadImage(),
      'keterangan' => $this->input->post('keterangan', true),
      'id_kategori' => $this->input->post('id_kategori', true)
    ];

    $this->db->insert('barang', $data);
  }

  private function _uploadImage()
  {
    $config['upload_path'] = './assets_user/img/';
    $config['file_name'] = $this->nama;
    $config['allowed_types'] = 'jpg|png';
    $config['max_size'] = 2000;

    $this->load->library('upload', $config);
    if ($this->upload->do_upload('gambar')) {
      return $this->upload->data("file_name");
    }
    return "default.jpg";
  }

  public function getUserById_barang($id_barang)
  {

    return $this->db->get_where('barang', ['id_barang' => $id_barang])->row_array();
  }

  public function updateData($id_barang)
  {

    $nama_barang = $this->input->post('nama_barang');
    $merek = $this->input->post('merek');
    // $jumlah = $this->input->post('jumlah');
    $keterangan = $this->input->post('keterangan');
    $id_kategori = $this->input->post('id_kategori');

    //cek jika ada gambar yang akan diupload
    $upload_image = $_FILES['gambar']['name'];

    if ($upload_image) {
      $config['allowed_types']   = 'gif|jpg|jpeg|png';

      $config['upload_path']    = './assets_user/img/';

      $this->load->library('upload', $config);

      if ($this->upload->do_upload('gambar')) {
        //untuk menghapus gambar lama ketika user mengganti gambarnya
        $old_image = $data['buku']['gambar'];
        if ($old_image != 'default.png') {
          unlink(FCPATH . './assets_user/img/' . $old_image);
        }

        //mengambil nama file yang baru
        $new_image = $this->upload->data('file_name');
        $this->db->set('gambar', $new_image);
      } else {
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

  public function getUserById($id_petugas)
  {

    return $this->db->get_where('petugas', ['id_petugas' => $id_petugas])->row_array();
  }

  public function count_all($table)
  {
    return $this->db->count_all($table);
  }

  public function count_where_done($table)
  {
    $this->db->where('status', 1);
    $this->db->from($table);
    $query = $this->db->count_all_results();
    return $query;
  }

  public function count_pengadaan_where_done_bulan_ini()
  {
    $this->db->where('status', 1);
    $this->db->where('MONTH(tgl_masuk)', date('m')); //For current month
    $this->db->where('YEAR(tgl_masuk)', date('Y')); // For current year
    $this->db->from('pengadaan');
    $query = $this->db->count_all_results();
    return $query;
  }

  public function count_penempatan_where_done_bulan_ini()
  {
    $this->db->where('status', 1);
    $this->db->where('MONTH(tgl_ditempatkan)', date('m')); //For current month
    $this->db->where('YEAR(tgl_ditempatkan)', date('Y')); // For current year
    $this->db->from('penempatan');
    $query = $this->db->count_all_results();
    return $query;
  }

  public function count_all_pengadaan_sebulan($table)
  {
    $this->db->where('MONTH(tgl_permintaan)', date('m')); //For current month
    $this->db->where('YEAR(tgl_permintaan)', date('Y')); // For current year
    $this->db->from($table);
    $query = $this->db->count_all_results();
    return $query;
  }

  public function count_all_penempatan_sebulan($table)
  {
    $this->db->where('MONTH(tgl_permintaan_penempatan)', date('m')); //For current month
    $this->db->where('YEAR(tgl_permintaan_penempatan)', date('Y')); // For current year
    $this->db->from($table);
    $query = $this->db->count_all_results();
    return $query;
  }

  public function sum_all_masuk_item()
  {
    $this->db->select_sum('jumlah_masuk');
    $result = $this->db->get('masuk_item')->row();
    return $result->jumlah_masuk;
  }

  public function sum_all_keluar_item()
  {
    $this->db->select_sum('jumlah_keluar');
    $result = $this->db->get('keluar_item')->row();
    return $result->jumlah_keluar;
  }

  public function sum_all_masuk_item_bulan_ini()
  {
    $this->db->select_sum('jumlah_masuk');
    $this->db->where('MONTH(tgl_masuk)', date('m')); //For current month
    $this->db->where('YEAR(tgl_masuk)', date('Y')); // For current year
    $result = $this->db->get('masuk_item')->row();
    return $result->jumlah_masuk;
  }

  public function sum_all_keluar_item_bulan_ini()
  {
    $this->db->select_sum('jumlah_keluar');
    $this->db->where('MONTH(tgl_keluar)', date('m')); //For current month
    $this->db->where('YEAR(tgl_keluar)', date('Y')); // For current year
    $result = $this->db->get('keluar_item')->row();
    return $result->jumlah_keluar;
  }

  public function get_pengadaan_hari_ini()
  {
    $this->db->select('pengadaan.id_pengadaan, pengadaan.tgl_permintaan, pengadaan.tgl_disetujui, pengadaan.status, petugas_peminta.nama_petugas as petugas_peminta, petugas_penyetuju.nama_petugas as petugas_penyetuju');

    $this->db->from('pengadaan');

    // $this->db->join('supplier', 'supplier.id_supplier = pengadaan.id_supplier');
    $this->db->join('petugas as petugas_peminta', 'petugas_peminta.USER_ID = pengadaan.USER_ID', 'left');
    $this->db->join('petugas as petugas_penyetuju', 'petugas_penyetuju.USER_ID = pengadaan.disetujui_oleh', 'left');
    $this->db->where('DATE(tgl_permintaan) = CURDATE() or DATE(tgl_disetujui)');
    $query = $this->db->get();
    return $query->result();
  }

  public function get_penempatan_hari_ini()
  {
    $this->db->select('penempatan.id_penempatan, penempatan.tgl_permintaan_penempatan, penempatan.tgl_disetujui, penempatan.status, petugas_peminta.nama_petugas as petugas_peminta, petugas_penyetuju.nama_petugas as petugas_penyetuju');

    $this->db->from('penempatan');

    // $this->db->join('supplier', 'supplier.id_supplier = penempatan.id_supplier');
    $this->db->where('DATE(tgl_permintaan_penempatan) = CURDATE() or DATE(tgl_disetujui)');
    $this->db->join('petugas as petugas_peminta', 'petugas_peminta.USER_ID = penempatan.USER_ID', 'left');
    $this->db->join('petugas as petugas_penyetuju', 'petugas_penyetuju.USER_ID = penempatan.disetujui_oleh', 'left');
    $this->db->where('DATE(tgl_permintaan_penempatan) = CURDATE() or DATE(tgl_disetujui)');
    $query = $this->db->get();
    return $query->result();
  }
}
