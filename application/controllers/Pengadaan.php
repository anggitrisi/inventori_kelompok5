<?php


class Pengadaan extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $data['pengadaan'] = $this->Main_model->get_pengadaan(); //pengadaan adalah nama tabel database
    $this->header('Data Pengadaan');
    $this->load->view('pengadaan/data_pengadaan', $data);
    $this->footer();
  }

  public function data_pengadaan()
  {
    $data['pengadaan'] = $this->Main_model->get_pengadaan();   //pengadaan join

    $this->header('Data pengadaan');
    $this->load->view('pengadaan/data_pengadaan', $data);
    $this->footer();
  }

  public function tambah_pengadaan()
  {
    $data['barang'] = $this->Main_model->select_record('barang');
    $data['supplier'] = $this->Main_model->select_record('supplier');

    $this->header('Tambah Pengadaan');
    $this->load->view('pengadaan/tambah_pengadaan', $data);
    $this->footer();
  }


  /*
insert ke tabel pengadaan id_pengadaan, tanggal_permintaan, id_supplier, USER_ID
keterangan status di tabel pengadaan (0-belum disetujui manager, 1-disetujui manager,2-ditolak manager)
keterangan _diproses : saat petugas menyetujui _diproses = 1, lalu data barang di tabel pengadaan dengan id_pengadaan yang disetujui akan masuk dari data
*/

  public function insert_pengadaan()
  {

    $data['supplier'] = $this->Main_model->select_record('supplier');

    //mengambil usert data untuk diinput sebagai USER_ID
    $user_id = $this->session->userdata('user_id');
    //generate untuk id_pengadaan dengan MSK + tanggal + jlh row data pengadaan 
    $back = $this->db->get('pengadaan')->num_rows() + 1;
    $id_pengadaan = 'MSK-' . date('ymd') . $back;

    $data = array(
      'id_pengadaan' => $id_pengadaan,
      'tgl_permintaan' => $this->input->post('date'),
      'id_supplier' => $this->input->post('id_supplier'),
      'USER_ID' => $user_id,
      'status' => 0,
      '_dibayar' => 0,
    );

    $response = $this->Main_model->save_record('pengadaan', $data);

    /*beberapa data perlu di kirim ke file tambah_pengadaan_item
    */
    //mengambil data id_pengadaan yang baru diinput
    $id_pengadaan = $id_pengadaan;
    //mengambil data supplier yang baru diinput
    $id_supplier = $this->input->post('id_supplier');
    //obj perlu diubah ke array dulu denga fungsi json_decode
    $data['supplier_input'] = json_decode(json_encode($this->Main_model->single_record('supplier', array('id_supplier' => $id_supplier))), true);
    //mengambil data barang untuk drop down pilihan input
    $data['barang'] = $this->Main_model->select_record('barang');

    if ($response == TRUE) {
      $this->header('Tambah Pengadaan');
      $this->load->view('pengadaan/tambah_pengadaan_item', $data);
      $this->footer();
    }
  }

  /*memasukkan multiple item ke tabel permintaan_item 
    setelah id_pengadaan masuk ke tabel pengadaan 
    masukkan item-item barang yang diinput user
    ke dalam tabel permintaan_item_barang
  */

  public function insert_pengadaan_item()
  {
    //data untuk ke tabel permintaan_item berupa array (karena multiple input)

    $id_barang = $_POST['id_barang'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga'];
    $id_pengadaan = $_POST['id_pengadaan'];

    //update tabel pengadaan masukkan total_harga untuk id_pengadaan=$id_pengadaan
    $total_harga = array_sum($harga);
    $data_pengadaan = array(
      'total_harga' => $total_harga,
    );
    $this->db->where('id_pengadaan', $id_pengadaan);
    $this->db->update('pengadaan', $data_pengadaan);


    $data_item = array();
    for ($index = 0; $index < count($id_barang); $index++) { // Kita buat perulangan berdasarkan id_barang sampai data terakhir
      array_push($data_item, array(
        'id_barang' => $id_barang[$index], //mengubah array menjadi string
        'id_pengadaan' => $id_pengadaan,
        'jumlah' => $jumlah[$index],  // Ambil dan set data nama sesuai index array dari $index
        'harga' => $harga[$index],
      ));

      $index++;
    }


    //simpan ke tabel permintaan_item
    $response = $this->Main_model->save_batch_permintaan($data_item);


    if ($response == TRUE) {

      $this->session->set_flashdata('success', 'Data pengadaan Berhasil Ditambahkan');
      redirect(base_url() . 'Pengadaan/data_pengadaan');
    } else { // Jika gagal
      $this->session->set_flashdata('alert', 'Data pengadaan Gagal Ditambahkan');
      redirect(base_url() . 'Pengadaan/data_pengadaan');
    }
  }

  /* yang dibutuhkan dari detail pengadaan :
  
  |--join 3 tabel = $data['detail_pengadaan']
  1. detail petugas peminta, petugas penyetuju
  2. detail supplier
  3. detail pengadaan : tgl_permintaan, tgl disutujui, tgl masuk, status disetujui
  --.

  |--
  4. detail barang-barang yang diminta dari (id_pengadaan) di tabel permintaan_pengadaan_item
  */

  public function detail_pengadaan($id)
  {
    //mengambil detail pengadaan
    $data['detail_pengadaan'] = $this->Main_model->get_detail_pengadaan($id);
    //mengambil semua data barang dengan id_pengadaan yang sama
    $data['barang'] = $this->Main_model->get_detail_pengadaan_item($id);


    $this->header('Detail Pengadaan Barang');
    $this->load->view('pengadaan/detail_pengadaan', $data);
    $this->footer();
  }

  public function hapus_pengadaan($id)
  {
    $response = $this->Main_model->delete_pengadaan($id);
    $this->session->set_flashdata('success', "Data pengadaan berhasil dihapus");
    redirect(base_url() . 'Pengadaan');
  }

  public function bayar_pengadaan($id)
  {
    $_dibayar = 1;
    $this->Main_model->ubahStatusBayar($id, $_dibayar);
    redirect(base_url() . 'Pengadaan/invoice_pengadaan');
  }

  public function invoice_pengadaan()
  {
    $data['pengadaan'] = $this->Main_model->get_invoice_pengadaan();   //pengadaan join

    $this->header('Data pengadaan');
    $this->load->view('pengadaan/invoice_pengadaan', $data);
    $this->footer();
  }
  public function detail_invoice_pengadaan($id)
  {
    $data['detail_pengadaan'] = $this->Main_model->get_detail_pengadaan($id);   //pengadaan join
    $data['barang'] = $this->Main_model->get_detail_pengadaan_item($id);   //pengadaan join

    $this->header('Data pengadaan');
    $this->load->view('pengadaan/detail_invoice_pengadaan', $data);
    $this->footer();
  }
  public function bayar_pengadaan_old($id)
  {
    $postData = $this->input->post();

    $data = array(
      '_dibayar' => 1,
      'dibayar_oleh' =>  $this->session->userdata('user_id'),
    );
    $where = array('id_pengadaan' => $id);

    $response = $this->Main_model->update_record('pegawai', $data, $where);
  }
}
