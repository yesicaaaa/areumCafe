<?php
defined('BASEPATH') or exit('No direct script access allowed');
require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('Admin_model', 'am');
    is_logged_in_admin();
  }

  function index($year = null, $month = null)
  {
    $data = [
      'user'  => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'pegawaiGrafik' => $this->am->getPegawaiGrafik(),
      'menuGrafik'  => $this->am->getMenuGrafik(),
      'menuTerjualGrafik' => $this->am->getMenuTerjualGrafik(),
      'stokMenuGrafik'  => $this->am->getStokMenuGrafik(),
      'title' => 'Dashboard | Areum Cafe',
      'css'   => 'admin.css',
      'js'    => ''
    ];

    $config = [
      'start_day' => 'Sunday',
      'show_next_prev'  => true,
      'next_prev_url' => base_url() . 'admin/index'
    ];
    $this->calendar->initialize($config);
    $data['calendar'] = $this->calendar->generate($year, $month);

    $this->load->view('templates/header', $data);
    $this->load->view('templates/side-navbar', $data);
    $this->load->view('admin/index', $data);
    $this->load->view('templates/footer', $data);
  }

  function pegawai()
  {
    $data = [
      'user'  => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'hak_akses' => $this->db->get('hak_akses')->result_array(),
      'title' => 'Pegawai | Areum Cafe',
      'css'   => 'admin.css',
      'js'    => 'pegawai.js'
    ];

    if ($this->input->post('cari')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    $config['base_url'] = 'http://localhost/areumCafe/admin/pegawai';
    $this->db->like('user.nama', $data['keyword']);
    $this->db->or_like('user.email', $data['keyword']);
    $this->db->or_like('hak_akses.nama_akses', $data['keyword']);
    $this->db->from('user');
    $this->db->join('hak_akses', 'hak_akses.id_hak_akses = user.hak_akses');
    $config['total_rows'] = $this->db->count_all_results();
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 10;

    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);
    $start = ($data['start'] > 0) ? $data['start'] : 0;

    $data['pegawai']  = $this->am->getDataPegawai($config['per_page'], $start, $data['keyword']);

    if (!$this->input->post('cari')) {
      $this->form_validation->set_rules('nama', 'Nama', 'required');
      $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
      $this->form_validation->set_rules('hak_akses', 'Hak Akses', 'required');
      $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
      $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]');
    }

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/side-navbar', $data);
      $this->load->view('admin/pegawai', $data);
      $this->load->view('templates/footer', $data);
    } else {
      $this->am->add_pegawai();
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data pegawai berhasil ditambah.</div>');
      redirect('admin/pegawai');
    }
  }

  function tambahPegawai()
  {
    $data = [
      'user'  => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'title' => 'Tambah Pegawai | Areum Cafe',
      'css'   => 'admin.css',
      'js'    => 'tambahPegawai.js'
    ];
    $this->load->view('templates/header', $data);
    $this->load->view('templates/side-navbar', $data);
    $this->load->view('admin/tambah-pegawai', $data);
    $this->load->view('templates/footer', $data);
  }

  function pegawai_delete()
  {
    if(isset($_POST['id_user'])) {
      $this->ajax = true;
      $user_id = explode(',', $this->input->post('id_user'));
      $res = $this->am->pegawai_delete($user_id);

      if($res) {
        $result = true;
        $message = 'Data berhasil dihapus';
      } else {
        $result = false;
        $message = 'Data gagal dihapus';
      }
      
      $data = array();
      $data['res_status'] = $result;
      $data['res_message'] = $message;
      echo json_encode($data); 
    }
  }

  function getPegawaiRow()
  {
    $id_user = $this->input->post('id_user');
    $user = $this->am->getPegawaiRow($id_user);

    echo json_encode($user);
  }

  function editPegawai()
  {
    $id_user = $this->input->get('id_user');

    if($id_user == '' || $id_user == '0') {
      $this->session->set_flashdata('msg_error', 'Data tidak ditemukan!');
      redirect('admin/pegawai');
    }

    $data = [
      'user'  => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'row' => $this->am->getUserRow($id_user),
      'title' => 'Edit Pegawai | Areum Cafe',
      'css'   => 'admin.css',
      'js'    => 'editPegawai.js'
    ];

    if(!$data['row']) {
      $this->session->set_flashdata('msg_error', 'Data tidak ditemukan!');
      redirect('admin/pegawai');
    }

    $this->load->view('templates/header', $data);
    $this->load->view('templates/side-navbar', $data);
    $this->load->view('admin/edit-pegawai', $data);
    $this->load->view('templates/footer', $data);
  }

  function refreshPegawai()
  {
    $this->session->unset_userdata('keyword');
    redirect('admin/pegawai');
  }

  function menuCafe()
  {
    $data = [
      'user'  => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'title' => 'Menu Cafe | Areum Cafe',
      'css'   => 'admin.css',
      'js'    => 'menuCafe.js'
    ];
    if ($this->input->post('cari')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    $config['base_url'] = 'http://localhost/areumCafe/admin/menuCafe';
    $this->db->like('nama', $data['keyword']);
    $this->db->or_like('harga', $data['keyword']);
    $this->db->or_like('jenis', $data['keyword']);
    $this->db->or_like('stok', $data['keyword']);
    $this->db->from('menu');
    $config['total_rows'] = $this->db->count_all_results();
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 10;

    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);
    $start = ($data['start'] > 0) ? $data['start'] : 0;

    $data['menu'] = $this->am->getDataMenu($config['per_page'], $start, $data['keyword']);

    if (!$this->input->post('cari')) {
      $this->form_validation->set_rules('nama', 'Nama Menu', 'required');
      $this->form_validation->set_rules('harga', 'Harga', 'required');
      $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
      $this->form_validation->set_rules('jenis', 'Jenis Menu', 'required');
      $this->form_validation->set_rules('stok', 'Stok Menu', 'required');
    }

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/side-navbar', $data);
      $this->load->view('admin/menu-cafe', $data);
      $this->load->view('templates/footer', $data);
    } else {
      $this->am->addMenu();
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu baru berhasil ditambahkan.</div>');
      redirect('admin/menuCafe');
    }
  }

  function menu_delete()
  {
    if ($_POST['id'] != null) {
      foreach ($_POST['id'] as $id) {
        $this->am->menu_delete($id);
      }
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu berhasil dihapus.</div>');
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tidak ada data yang dipilih!</div>');
    }
    redirect('admin/menuCafe');
  }

  function getMenuRow()
  {
    $id_menu = $this->input->post('id_menu');
    $menu = $this->db->get_where('menu', ['id_menu' => $id_menu])->row_array();

    echo json_encode($menu);
  }

  function editMenu()
  {
    $data = [
      'user'  => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'title' => 'Menu Cafe | Areum Cafe',
      'css'   => 'admin.css',
      'js'    => 'menuCafe.js'
    ];
    if ($this->input->post('cari')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    if (!$this->input->post('cari')) {
      $this->form_validation->set_rules('nama', 'Nama Menu', 'required');
      $this->form_validation->set_rules('harga', 'Harga', 'required');
      $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
      $this->form_validation->set_rules('jenis', 'Jenis Menu', 'required');
      $this->form_validation->set_rules('stok', 'Stok Menu', 'required');
    }

    $data['menu'] = $this->am->getDataMenu($data['keyword']);

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/side-navbar', $data);
      $this->load->view('admin/menu-cafe', $data);
      $this->load->view('templates/footer', $data);
    } else {
      $this->am->editMenu();
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu baru berhasil diubah.</div>');
      redirect('admin/menuCafe');
    }
  }

  function refreshMenuCafe()
  {
    $this->session->unset_userdata('keyword');
    redirect('admin/menuCafe');
  }

  function laporanPenjualan()
  {
    $data = [
      'user'  => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'title' => 'Laporan Penjualan | Areum Cafe',
      'css'   => 'admin.css',
      'js'    => 'menuCafe.js'
    ];
    if ($this->input->post('cari')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    $config['base_url'] = 'http://localhost/areumCafe/admin/laporanPenjualan';
    $this->db->select('pelanggan.tanggal, menu.nama')
      ->like('pelanggan.tanggal', $data['keyword'])
      ->or_like('menu.nama', $data['keyword'])
      ->from('pesanan')
      ->join('menu', 'menu.id_menu = pesanan.id_menu')
      ->join('pelanggan', 'pelanggan.id_pelanggan = pesanan.id_pelanggan')
      ->group_by('pelanggan.tanggal, menu.nama')
      ->order_by('pelanggan.tanggal', 'desc');
    $config['total_rows'] = $this->db->count_all_results();
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 10;

    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);
    $start = ($data['start'] > 0) ? $data['start'] : 0;

    $data['penjualan'] = $this->am->getPenjualan($config['per_page'], $start, $data['keyword']);

    $this->load->view('templates/header', $data);
    $this->load->view('templates/side-navbar', $data);
    $this->load->view('admin/laporan-penjualan', $data);
    $this->load->view('templates/footer', $data);
  }

  function refreshLaporanPenjualan()
  {
    $this->session->unset_userdata('keyword');
    redirect('admin/laporanPenjualan');
  }

  function laporanKeuangan()
  {
    $data = [
      'user'  => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'title' => 'Laporan Keuangan | Areum Cafe',
      'css'   => 'admin.css',
      'js'    => 'menuCafe.js'
    ];
    if ($this->input->post('cari')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    $config['base_url'] = 'http://localhost/areumCafe/admin/laporanKeuangan';
    $this->db->select('pelanggan.tanggal', 'user.nama')
      ->like('pelanggan.tanggal', $data['keyword'])
      ->or_like('user.nama', $data['keyword'])
      ->from('transaksi')
      ->join('pelanggan', 'pelanggan.id_pelanggan = transaksi.id_pelanggan')
      ->join('user', 'user.id_user = transaksi.id_pegawai')
      ->group_by('pelanggan.tanggal, transaksi.id_pegawai')
      ->order_by('pelanggan.tanggal', 'desc');
    $config['total_rows'] = $this->db->count_all_results();
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 2;

    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);
    $start = ($data['start'] > 0) ? $data['start'] : 0;

    $data['keuangan'] = $this->am->getKeuangan($config['per_page'], $start, $data['keyword']);

    $this->load->view('templates/header', $data);
    $this->load->view('templates/side-navbar', $data);
    $this->load->view('admin/laporan-keuangan', $data);
    $this->load->view('templates/footer', $data);
  }

  function refreshLaporanKeuangan()
  {
    $this->session->unset_userdata('keyword');
    redirect('admin/laporanKeuangan');
  }

  function laporanPelanggan()
  {
    $data = [
      'user'  => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'title' => 'Laporan Pelanggan | Areum Cafe',
      'css'   => 'admin.css',
      'js'    => 'menuCafe.js'
    ];
    if ($this->input->post('cari')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    $config['base_url'] = 'http://localhost/areumCafe/admin/laporanPelanggan';
    $this->db->select('pelanggan.id_pelanggan as ip, pelanggan.tanggal, pelanggan.nama_pelanggan, user.nama, pesanan.status')
      ->like('pelanggan.id_pelanggan', $data['keyword'])
      ->or_like('pelanggan.tanggal', $data['keyword'])
      ->or_like('pelanggan.nama_pelanggan', $data['keyword'])
      ->or_like('user.nama', $data['keyword'])
      ->or_like('pesanan.status', $data['keyword'])
      ->from('pelanggan')
      ->join('pesanan', 'pesanan.id_pelanggan = pelanggan.id_pelanggan')
      ->join('user', 'user.id_user = pelanggan.id_waiter')
      ->group_by('pelanggan.tanggal, pesanan.id_pelanggan')
      ->order_by('pelanggan.tanggal', 'desc');
    $config['total_rows'] = $this->db->count_all_results();
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 10;

    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);
    $start = ($data['start'] > 0) ? $data['start'] : 0;

    $data['pelanggan'] = $this->am->getPelanggan($config['per_page'], $start, $data['keyword']);

    $this->load->view('templates/header', $data);
    $this->load->view('templates/side-navbar', $data);
    $this->load->view('admin/laporan-pelanggan', $data);
    $this->load->view('templates/footer', $data);
  }

  function refreshLaporanPelanggan()
  {
    $this->session->unset_userdata('keyword');
    redirect('admin/laporanPelanggan');
  }

  function printExcelPegawai()
  {
    $keyword = $this->uri->segment(3);
    $pegawai = $this->am->getDataExportPegawai($keyword);

    $spreadsheet = new Spreadsheet;
    $spreadsheet->setActiveSheetIndex(0)
      ->setCellValue('A1', 'Data Pegawai | Areum Cafe')
      ->setCellValue('A2', 'No')
      ->setCellValue('B2', 'Nama Lengkap')
      ->setCellValue('C2', 'Email')
      ->setCellValue('D2', 'Hak Akses');
    $column = 3;
    $number = 1;

    foreach ($pegawai as $p) {
      $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A' . $column, $number)
        ->setCellValue('B' . $column, $p['nama'])
        ->setCellValue('C' . $column, $p['email'])
        ->setCellValue('D' . $column, $p['nama_akses']);
      $column++;
      $number++;
    }

    $dataPegawai = new Xlsx($spreadsheet);

    header('Content-type: application/vnd.ms.excel');
    header('Content-disposition: attachment;filename="Data Pegawai.xlsx"');
    $dataPegawai->save('php://output');
  }

  function printExcelMenuCafe()
  {
    $keyword = $this->uri->segment(3);
    $menuCafe = $this->am->getDataExportMenuCafe($keyword);
    $spreadsheet = new Spreadsheet;

    $spreadsheet->setActiveSheetIndex(0)
      ->setCellValue('A1', 'Data Menu Cafe | Areum Cafe')
      ->setCellValue('A2', 'No.')
      ->setCellValue('B2', 'Nama Menu')
      ->setCellValue('C2', 'Harga')
      ->setCellValue('D2', 'Deskripsi')
      ->setCellValue('E2', 'Jenis')
      ->setCellValue('F2', 'Stok');
    $column = 3;
    $number = 1;

    foreach ($menuCafe as $mc) {
      $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A' . $column, $number)
        ->setCellValue('B' . $column, $mc['nama'])
        ->setCellValue('C' . $column, 'Rp' . number_format($mc['harga'], 0, ',', '.'))
        ->setCellValue('D' . $column, $mc['deskripsi'])
        ->setCellValue('E' . $column, $mc['jenis'])
        ->setCellValue('F' . $column, $mc['stok']);
      $column++;
      $number++;
    }
    $dataMenuCafe = new Xlsx($spreadsheet);

    header('Content-type: application/vnd.ms.excel');
    header('Content-disposition: attachment;filename="Data Menu Cafe.xlsx"');
    $dataMenuCafe->save('php://output');
  }

  function printExcelLaporanPenjualan()
  {
    $keyword = $this->uri->segment(3);
    $laporanPenjualan = $this->am->getDataExportLaporanPenjualan($keyword);
    $spreadsheet = new Spreadsheet;

    $spreadsheet->setActiveSheetIndex(0)
      ->setCellValue('A1', 'Laporan Penjualan | Areum Cafe')
      ->setCellValue('A2', 'No.')
      ->setCellValue('B2', 'Tanggal')
      ->setCellValue('C2', 'Nama Menu')
      ->setCellValue('D2', 'Terjual');
    $column = 3;
    $number = 1;

    foreach ($laporanPenjualan as $lp) {
      $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A' . $column, $number)
        ->setCellValue('B' . $column, $lp['tanggal'])
        ->setCellValue('C' . $column, $lp['nama'])
        ->setCellValue('D' . $column, $lp['terjual']);
      $column++;
      $number++;
    }
    $dataLaporanPenjualan = new Xlsx($spreadsheet);

    header('Content-type: application/vnd.ms.excel');
    header('Content-disposition: attachment;filename="Laporan Penjualan.xlsx"');
    $dataLaporanPenjualan->save('php://output');
  }

  function printExcelLaporanPelanggan()
  {
    $keyword = $this->uri->segment(3);
    $laporanPelanggan = $this->am->getDataExportLaporanPelanggan($keyword);
    $spreadsheet = new Spreadsheet;

    $spreadsheet->setActiveSheetIndex(0)
      ->setCellValue('A1', 'Laporan Pelanggan | Areum Cafe')
      ->setCellValue('A2', 'No.')
      ->setCellValue('B2', 'ID Pelanggan')
      ->setCellValue('C2', 'Tanggal')
      ->setCellValue('D2', 'Nama Pelanggan')
      ->setCellValue('E2', 'Jumlah Pesanan')
      ->setCellValue('F2', 'Subtotal')
      ->setCellValue('G2', 'Nama Pelayan')
      ->setCellValue('H2', 'Status');
    $column = 3;
    $number = 1;

    foreach ($laporanPelanggan as $lp) {
      $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A' . $column, $number)
        ->setCellValue('B' . $column, $lp['id_pelanggan'])
        ->setCellValue('C' . $column, $lp['tanggal'])
        ->setCellValue('D' . $column, $lp['nama_pelanggan'])
        ->setCellValue('E' . $column, $lp['qty'])
        ->setCellValue('F' . $column, 'Rp' . number_format($lp['subtotal'], 0, ',', '.'))
        ->setCellValue('G' . $column, $lp['nama'])
        ->setCellValue('H' . $column, $lp['status']);
      $column++;
      $number++;
    }
    $dataLaporanPelanggan = new Xlsx($spreadsheet);

    header('Content-type: application/vnd.ms.excel');
    header('Content-disposition: attachment;filename="Laporan Pelanggan.xlsx"');
    $dataLaporanPelanggan->save('php://output');
  }

  function printExcelLaporanKeuangan()
  {
    $keyword = $this->uri->segment(3);
    $laporanKeuangan = $this->am->getDataExportLaporanKeuangan($keyword);
    $spreadsheet = new Spreadsheet;

    $spreadsheet->setActiveSheetIndex(0)
      ->setCellValue('A1', 'Laporan Pelanggan | Areum Cafe')
      ->setCellValue('A2', 'No.')
      ->setCellValue('B2', 'Tanggal')
      ->setCellValue('C2', 'Nama Kasir')
      ->setCellValue('D2', 'Pendapatan/Hari');
    $column = 3;
    $number = 1;

    foreach ($laporanKeuangan as $lk) {
      $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A' . $column, $number)
        ->setCellValue('B' . $column, $lk['tanggal'])
        ->setCellValue('C' . $column, $lk['nama'])
        ->setCellValue('D' . $column, 'Rp' . number_format($lk['pendapatan'], 0, ',', '.'));
      $column++;
      $number++;
    }
    $dataLaporanKeuangan = new Xlsx($spreadsheet);

    header('Content-type: application/vnd.ms.excel');
    header('Content-disposition: attachment;filename="Laporan Keuangan.xlsx"');
    $dataLaporanKeuangan->save('php://output');
  }

  function printPdfPegawai()
  {
    $pdf = new FPDF('l', 'mm', 'A5');
    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', '18');
    $pdf->Cell(190, 7, 'Data Pegawai | Areum Cafe', 0, 1, 'C');
    $pdf->Cell(10, 7, '', 0, 1);

    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(15, 6, 'No.', 1, 0);
    $pdf->Cell(70, 6, 'Nama Lengkap', 1, 0);
    $pdf->Cell(70, 6, 'Email', 1, 0);
    $pdf->Cell(40, 6, 'Hak Akses', 1, 1);

    $pdf->SetFont('Arial', '', 12);
    $keyword = $this->uri->segment(3);
    $pegawai = $this->am->getDataExportPegawai($keyword);
    $i = 1;
    foreach ($pegawai as $p) {
      $pdf->Cell(15, 6, $i++, 1, 0);
      $pdf->Cell(70, 6, $p['nama'], 1, 0);
      $pdf->Cell(70, 6, $p['email'], 1, 0);
      $pdf->Cell(40, 6, $p['nama_akses'], 1, 1);
    }

    $pdf->Output();
  }

  function printPdfMenuCafe()
  {
    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', '18');
    $pdf->cell(190, 7, 'Data Menu Cafe | Areum Cafe', 0, 1, 'C');
    $pdf->Cell(10, 7, '', 0, 1);

    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(10, 6, 'No.', 1, 0);
    $pdf->Cell(70, 6, 'Nama Menu', 1, 0);
    $pdf->Cell(30, 6, 'Harga', 1, 0);
    // $pdf->Cell(90, 6, 'Deskripsi', 1, 0);
    // $pdf->Cell(70, 6, 'Foto', 1, 0);
    $pdf->Cell(50, 6, 'Jenis', 1, 0);
    $pdf->Cell(50, 6, 'Stok', 1, 1);

    $pdf->SetFont('Arial', '', 12);
    $keyword = $this->uri->segment(3);
    $menuCafe = $this->am->getDataExportMenuCafe($keyword);
    $i = 1;
    foreach ($menuCafe as $mc) {
      $pdf->Cell(10, 6, $i++, 1, 0);
      $pdf->Cell(70, 6, $mc['nama'], 1, 0);
      $pdf->Cell(30, 6, 'Rp' . number_format($mc['harga'], 0, ',', '.'), 1, 0);
      // $pdf->Cell(90, 6, $mc['deskripsi'], 1, 0, 'L', true);
      // $pdf->Image('latte.jpg', 10, 6, 30);
      $pdf->Cell(50, 6, $mc['jenis'], 1, 0);
      $pdf->Cell(50, 6, $mc['stok'], 1, 1);
    }

    $pdf->Output();
  }

  function printPdfLaporanPenjualan()
  {
    $pdf = new FPDF('l', 'mm', 'A5');
    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', '18');
    $pdf->Cell(190, 7, 'Laporan Penjualan | Areum Cafe', 0, 1, 'C');
    $pdf->Cell(10, 7, '', 0, 1);

    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(15, 6, 'No.', 1, 0);
    $pdf->Cell(70, 6, 'Tanggal', 1, 0);
    $pdf->Cell(70, 6, 'Nama Menu', 1, 0);
    $pdf->Cell(40, 6, 'Terjual', 1, 1);

    $pdf->SetFont('Arial', '', 12);
    $keyword = $this->uri->segment(3);
    $laporanPenjualan = $this->am->getDataExportLaporanPenjualan($keyword);
    $i = 1;
    foreach ($laporanPenjualan as $lp) {
      $pdf->Cell(15, 6, $i++, 1, 0);
      $pdf->Cell(70, 6, $lp['tanggal'], 1, 0);
      $pdf->Cell(70, 6, $lp['nama'], 1, 0);
      $pdf->Cell(40, 6, $lp['terjual'], 1, 1);
    }

    $pdf->Output();
  }

  function printPdfLaporanPelanggan()
  {
    $pdf = new FPDF('l', 'mm', 'A4');
    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', '18');
    $pdf->Cell(190, 7, 'Laporan Pelanggan | Areum Cafe', 0, 1, 'C');
    $pdf->Cell(10, 7, '', 0, 1);

    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(15, 6, 'No.', 1, 0);
    $pdf->Cell(35, 6, 'ID Pelanggan', 1, 0);
    $pdf->Cell(30, 6, 'Tanggal', 1, 0);
    $pdf->Cell(55, 6, 'Nama Pelanggan', 1, 0);
    $pdf->Cell(30, 6, 'Pesanan', 1, 0);
    $pdf->Cell(30, 6, 'Subtotal', 1, 0);
    $pdf->Cell(55, 6, 'Nama Pelayan', 1, 0);
    $pdf->Cell(30, 6, 'Status', 1, 1);

    $pdf->SetFont('Arial', '', 12);
    $keyword = $this->uri->segment(3);
    $laporanPelanggan = $this->am->getDataExportLaporanPelanggan($keyword);
    $i = 1;
    foreach ($laporanPelanggan as $lp) {
      $pdf->Cell(15, 6, $i++, 1, 0);
      $pdf->Cell(35, 6, $lp['id_pelanggan'], 1, 0);
      $pdf->Cell(30, 6, $lp['tanggal'], 1, 0);
      $pdf->Cell(55, 6, $lp['nama_pelanggan'], 1, 0);
      $pdf->Cell(30, 6, $lp['qty'], 1, 0);
      $pdf->Cell(30, 6, 'Rp' . number_format($lp['subtotal'], 0, ',', '.'), 1, 0);
      $pdf->Cell(55, 6, $lp['nama'], 1, 0);
      $pdf->Cell(30, 6, $lp['status'], 1, 1);
    }

    $pdf->Output();
  }

  function printPdfLaporanKeuangan()
  {
    $pdf = new FPDF('l', 'mm', 'A4');
    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', '18');
    $pdf->Cell(190, 7, 'Laporan Keuangan | Areum Cafe', 0, 1, 'C');
    $pdf->Cell(10, 7, '', 0, 1);

    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(15, 6, 'No.', 1, 0);
    $pdf->Cell(30, 6, 'Tanggal', 1, 0);
    $pdf->Cell(55, 6, 'Nama Kasir', 1, 0);
    $pdf->Cell(55, 6, 'Pendapatan/Hari', 1, 1);

    $pdf->SetFont('Arial', '', 12);
    $keyword = $this->uri->segment(3);
    $laporanKeuangan = $this->am->getDataExportLaporanKeuangan($keyword);
    $i = 1;
    foreach ($laporanKeuangan as $lk) {
      $pdf->Cell(15, 6, $i++, 1, 0);
      $pdf->Cell(30, 6, $lk['tanggal'], 1, 0);
      $pdf->Cell(55, 6, $lk['nama'], 1, 0);
      $pdf->Cell(55, 6, 'Rp' . number_format($lk['pendapatan'], 0, ',', '.'), 1, 1);
    }

    $pdf->Output();
  }

  function tambahDataPegawai()
  {
    $email = $this->input->post('email');

    $cek_email = $this->am->cekEmail($email);
    if ($cek_email > 0) {
      $result = false;
      $message = 'Email sudah pernah digunakan!';
    } else {
      $user = $this->am->tambahDataPegawai();
      if ($user['user_id']) {
        $result = true;
        $message = 'Data berhasil disimpan';
      } else {
        $result = false;
      }
    }

    $data = array();
    $data['res_status'] = $result;
    $data['res_message'] = $message;

    echo json_encode($data);
  }
}
