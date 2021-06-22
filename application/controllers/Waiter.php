<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Waiter extends CI_Controller{
  function __construct()
  {
    parent::__construct();
    $this->load->model('waiter_model', 'wm');
  }

  function index()
  {
    $data = [
      'user'  => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'title' => 'Beranda | Areum Cafe',
      'css'   => 'waiter.css',
      'js'    => 'waiter.js'
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/navbar-waiter', $data);
    $this->load->view('waiter/index', $data);
    $this->load->view('templates/footer', $data);
  }

  function pesanan()
  {
    $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required');
    $this->form_validation->set_rules('phone', 'No. Telepon', 'required|max_length[13]');
    $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
    $this->form_validation->set_rules('no_meja', 'No. Meja', 'required');

    if($this->form_validation->run() == false){
      $data = [
        'user'  => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
        'pesanan' => $this->wm->getPesanan(),
        'title' => 'Beranda | Areum Cafe',
        'css'   => 'waiter.css',
        'js'    => 'waiter.js'
      ];
  
      $this->load->view('templates/header', $data);
      $this->load->view('templates/navbar-waiter', $data);
      $this->load->view('waiter/pesanan', $data);
      $this->load->view('templates/footer', $data);
    } else {
      $this->wm->addPelanggan();
      redirect('waiter/add_pesanan');
    }
  }

  function add_pesanan()
  {
    $data = [
      'title' => 'Daftar Menu | Areum Cafe',
      'css'   => 'waiter.css',
      'js'    => 'waiter.js'
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar-menu');
    $this->load->view('waiter/daftar_menu');
    $this->load->view('templates/footer', $data);
  }
}
?>