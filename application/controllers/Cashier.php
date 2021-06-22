<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Cashier extends CI_Controller{
  function __construct()
  {
    parent::__construct();
    $this->load->model('cashier_model', 'cm');
  }

  function index()
  {
    $data = [
      'user'  => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'title' => 'Beranda | Areum Cafe',
      'css'   => 'cashier.css',
      'js'    => ''
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/navbar',$data);
    $this->load->view('cashier/index');
    $this->load->view('templates/footer', $data);
  }

  function pesanan()
  {
    $data = [
      'user'  => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'pesanan' => $this->cm->getPesanan(),
      'title' => 'Pesanan | Areum Cafe',
      'css'   => 'cashier.css',
      'js'    => ''
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/navbar', $data);
    $this->load->view('cashier/pesanan');
    $this->load->view('templates/footer', $data);
  }
}
