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
      redirect('DaftarMenu/menu_coffee');
    }
  }

  function add_to_cart($id)
  {
    $this->wm->add_to_cart($id);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Ditambahkan ke pesanan</div>');
    redirect('waiter/cart');
  }

  function delete_pelanggan($id)
  {
    $this->wm->delete_pelanggan($id);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pesanan berhasil dibatalkan</div>');
    redirect('waiter/pesanan');
  }

  function cart()
  {
    $data = [
      'waiter'  => $this->db->get_where('user', ['id_user' => $this->session->userdata('id_waiter')])->row_array(),
      'cart'  => $this->cart->contents(),
      'title' => 'Keranjang | Areum Cafe',
      'css'   => 'waiter.css',
      'js'    => 'waiter.js'
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar-menu', $data);
    $this->load->view('waiter/cart', $data);
    $this->load->view('templates/footer', $data);
  }

  function add_pesanan()
  {
    $this->wm->add_pesanan();
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pesanan berhasil dibuat</div>');
    redirect('waiter/pesanan');
  }

  function delete_pesanan()
  {
    foreach($_POST['id'] as $id){
      $this->wm->delete_pesanan($id);
    }
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pesanan berhasil dihapus</div>');
    redirect('waiter/pesanan');
  }
}
?>  