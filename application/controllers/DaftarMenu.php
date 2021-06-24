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
      'cart'  => $this->cart->contents(),
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

  function menu_tea()
  {
    $data = [
      'cart'  => $this->cart->contents(),
      'title' => 'Teh | Areum Cafe',
      'jenis' => 'Teh',
      'menu'  => $this->dm->menu_tea(),
      'css'   => 'waiter.css',
      'js'    => ''
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar-menu');
    $this->load->view('waiter/daftar_menu', $data);
    $this->load->view('templates/footer', $data);
  }

  function menu_juice()
  {
    $data = [
      'cart'  => $this->cart->contents(),
      'title' => 'Jus | Areum Cafe',
      'jenis' => 'Jus',
      'menu'  => $this->dm->menu_juice(),
      'css'   => 'waiter.css',
      'js'    => ''
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar-menu');
    $this->load->view('waiter/daftar_menu', $data);
    $this->load->view('templates/footer', $data);
  }

  function menu_milk()
  {
    $data = [
      'cart'  => $this->cart->contents(),
      'title' => 'Susu | Areum Cafe',
      'jenis' => 'Susu',
      'menu'  => $this->dm->menu_milk(),
      'css'   => 'waiter.css',
      'js'    => ''
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar-menu');
    $this->load->view('waiter/daftar_menu', $data);
    $this->load->view('templates/footer', $data);
  }

  function menu_soda()
  {
    $data = [
      'cart'  => $this->cart->contents(),
      'title' => 'Soda | Areum Cafe',
      'jenis' => 'Soda',
      'menu'  => $this->dm->menu_soda(),
      'css'   => 'waiter.css',
      'js'    => ''
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar-menu');
    $this->load->view('waiter/daftar_menu', $data);
    $this->load->view('templates/footer', $data);
  }

  function menu_rice()
  {
    $data = [
      'cart'  => $this->cart->contents(),
      'title' => 'Nasi | Areum Cafe',
      'jenis' => 'Nasi',
      'menu'  => $this->dm->menu_rice(),
      'css'   => 'waiter.css',
      'js'    => ''
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar-menu');
    $this->load->view('waiter/daftar_menu', $data);
    $this->load->view('templates/footer', $data);
  }

  function menu_noodle()
  {
    $data = [
      'cart'  => $this->cart->contents(),
      'title' => 'Mie | Areum Cafe',
      'jenis' => 'Mie',
      'menu'  => $this->dm->menu_noodle(),
      'css'   => 'waiter.css',
      'js'    => ''
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar-menu');
    $this->load->view('waiter/daftar_menu', $data);
    $this->load->view('templates/footer', $data);
  }

  function menu_pastry()
  {
    $data = [
      'cart'  => $this->cart->contents(),
      'title' => 'Kue Kering | Areum Cafe',
      'jenis' => 'Kue Kering',
      'menu'  => $this->dm->menu_pastry(),
      'css'   => 'waiter.css',
      'js'    => ''
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar-menu');
    $this->load->view('waiter/daftar_menu', $data);
    $this->load->view('templates/footer', $data);
  }

  function menu_cake()
  {
    $data = [
      'cart'  => $this->cart->contents(),
      'title' => 'Bolu | Areum Cafe',
      'jenis' => 'Bolu',
      'menu'  => $this->dm->menu_cake(),
      'css'   => 'waiter.css',
      'js'    => ''
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar-menu');
    $this->load->view('waiter/daftar_menu', $data);
    $this->load->view('templates/footer', $data);
  }

  function menu_dessert()
  {
    $data = [
      'cart'  => $this->cart->contents(),
      'title' => 'Dessert | Areum Cafe',
      'jenis' => 'Dessert',
      'menu'  => $this->dm->menu_dessert(),
      'css'   => 'waiter.css',
      'js'    => ''
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar-menu');
    $this->load->view('waiter/daftar_menu', $data);
    $this->load->view('templates/footer', $data);
  }
}
