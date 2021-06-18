<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller{
  function __construct()
  {
    parent::__construct();
    $this->load->model('Admin_model', 'am');
  }

  function index()
  {
    $data = [
      'user'  => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'title' => 'Dashboard | Areum Cafe',
      'css'   => 'admin.css',
      'js'    => ''
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/side-navbar', $data);
    $this->load->view('admin/index');
    $this->load->view('templates/footer', $data);
  }

  function pegawai()
  {
    $data = [
      'user'  => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'pegawai' => $this->am->getDataPegawai(),
      'title' => 'Pegawai | Areum Cafe',
      'css'   => 'admin.css',
      'js'    => ''    
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/side-navbar', $data);
    $this->load->view('admin/pegawai', $data);
    $this->load->view('templates/footer', $data);
  }
}
?>