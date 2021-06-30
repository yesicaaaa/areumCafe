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
    $this->session->unset_userdata('keyword');
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
      'js'    => 'pegawai_add.js'
    ];

    if ($this->input->post('cari')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    if (!$this->input->post('cari')) {
      $this->form_validation->set_rules('nama', 'Nama', 'required');
      $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
      $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
      $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]');
    }

    $data['pegawai']  = $this->am->getDataPegawai($data['keyword']);

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

  function pegawai_delete()
  {
    foreach ($_POST['id'] as $id) {
      $this->am->pegawai_delete($id);
    }
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data pegawai berhasil dihapus.</div>');
    redirect('admin/pegawai');
  }

  function getPegawaiRow()
  {
    $id_user = $this->input->post('id_user');
    $user = $this->am->getPegawaiRow($id_user);

    echo json_encode($user);
  }

  function editPegawai()
  {
    $data = [
      'user'  => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'hak_akses' => $this->db->get('hak_akses')->result_array(),
      'title' => 'Pegawai | Areum Cafe',
      'css'   => 'admin.css',
      'js'    => 'pegawai_add.js'
    ];
    if ($this->input->post('cari')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    if (!$this->input->post('cari')) {
      $this->form_validation->set_rules('nama', 'Nama', 'required');
      $this->form_validation->set_rules('hak_akses', 'Hak Akses', 'required');
    }

    $data['pegawai'] = $this->am->getDataPegawai($data['keyword']);

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/side-navbar', $data);
      $this->load->view('admin/pegawai', $data);
      $this->load->view('templates/footer', $data);
    } else {
      $this->am->editPegawai();
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data pegawai berhasil diubah.</div>');
      redirect('admin/pegawai');
    }
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
      $this->am->addMenu();
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu baru berhasil ditambahkan.</div>');
      redirect('admin/menuCafe');
    }
  }

  function menu_delete()
  {
    foreach ($_POST['id'] as $id) {
      $this->am->menu_delete($id);
    }
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu berhasil dihapus.</div>');
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

    $data['penjualan'] = $this->am->getPenjualan($data['keyword']);

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

    $data['keuangan'] = $this->am->getKeuangan($data['keyword']);

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

    $data['pelanggan'] = $this->am->getPelanggan($data['keyword']);

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

    foreach($menuCafe as $mc){
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
    foreach($pegawai as $p){
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
    foreach($menuCafe as $mc){
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
}
