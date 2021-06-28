<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
    $this->form_validation->set_rules('nama', 'Nama', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
    $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
    $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]');

    if ($this->form_validation->run() == false) {
      $data = [
        'user'  => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
        'pegawai' => $this->am->getDataPegawai(),
        'hak_akses' => $this->db->get('hak_akses')->result_array(),
        'title' => 'Pegawai | Areum Cafe',
        'css'   => 'admin.css',
        'js'    => 'pegawai_add.js'
      ];

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
    $this->form_validation->set_rules('nama', 'Nama', 'required');
    $this->form_validation->set_rules('hak_akses', 'Hak Akses', 'required');

    if ($this->form_validation->run() == false) {
      $data = [
        'user'  => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
        'pegawai' => $this->am->getDataPegawai(),
        'hak_akses' => $this->db->get('hak_akses')->result_array(),
        'title' => 'Pegawai | Areum Cafe',
        'css'   => 'admin.css',
        'js'    => 'pegawai_add.js'
      ];

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

  function menuCafe()
  {
    $this->form_validation->set_rules('nama', 'Nama Menu', 'required');
    $this->form_validation->set_rules('harga', 'Harga', 'required');
    $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
    $this->form_validation->set_rules('jenis', 'Jenis Menu', 'required');
    $this->form_validation->set_rules('stok', 'Stok Menu', 'required');

    if ($this->form_validation->run() == false) {
      $data = [
        'user'  => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
        'menu'  => $this->am->getDataMenu(),
        'title' => 'Menu Cafe | Areum Cafe',
        'css'   => 'admin.css',
        'js'    => 'menuCafe.js'
      ];

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
    $this->form_validation->set_rules('nama', 'Nama Menu', 'required');
    $this->form_validation->set_rules('harga', 'Harga', 'required');
    $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
    $this->form_validation->set_rules('jenis', 'Jenis Menu', 'required');
    $this->form_validation->set_rules('stok', 'Stok Menu', 'required');

    if ($this->form_validation->run() == false) {
      $data = [
        'user'  => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
        'menu'  => $this->am->getDataMenu(),
        'title' => 'Menu Cafe | Areum Cafe',
        'css'   => 'admin.css',
        'js'    => 'menuCafe.js'
      ];

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

  function laporanPenjualan()
  {
    $data = [
      'user'  => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'penjualan' => $this->am->getPenjualan(),
      'title' => 'Laporan Penjualan | Areum Cafe',
      'css'   => 'admin.css',
      'js'    => 'menuCafe.js'
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/side-navbar', $data);
    $this->load->view('admin/laporan-penjualan', $data);
    $this->load->view('templates/footer', $data);
  }

  function laporanKeuangan()
  {
    $data = [
      'user'  => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'keuangan' => $this->am->getKeuangan(),
      'title' => 'Laporan Keuangan | Areum Cafe',
      'css'   => 'admin.css',
      'js'    => 'menuCafe.js'
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/side-navbar', $data);
    $this->load->view('admin/laporan-keuangan', $data);
    $this->load->view('templates/footer', $data);
  }

  function laporanPelanggan()
  {
    $data = [
      'user'  => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'pelanggan' => $this->am->getPelanggan(),
      'title' => 'Laporan Pelanggan | Areum Cafe',
      'css'   => 'admin.css',
      'js'    => 'menuCafe.js'
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/side-navbar', $data);
    $this->load->view('admin/laporan-pelanggan', $data);
    $this->load->view('templates/footer', $data);
  }
}
