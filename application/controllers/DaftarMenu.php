<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class DaftarMenu extends CI_Controller {
  function __construct()
  {
    parent::__construct();
    $this->load->model('DaftarMenu_model', 'dm');
  }

  function menu_coffee()
  {
    $data = [
      'title' => 'Kopi | Areum Cafe',
      'jenis' => 'Kopi',
      'menu'  => $this->dm->menu_coffee(),
      'css'   => 'waiter.css',
      'js'    => ''
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar-menu');
    $this->load->view('waiter/daftar_menu', $data);
    $this->load->view('templates/footer', $data);
  }
}

?>