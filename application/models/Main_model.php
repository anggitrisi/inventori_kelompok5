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

  public function delete_record($table, $where)
  {
    $this->db->delete($table, $where);
    if ($this->db->affected_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
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
    $this->db->update($where);
    $this->db->update($table, $data);
    if ($this->db->affected_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
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
}
