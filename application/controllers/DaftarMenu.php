<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DaftarMenu extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('DaftarMenu_model', 'dm');
    isset_pelanggan();
    $this->session->unset_userdata('keyword');
  }

  function search($jenis)
  {
    if($jenis == 'Kopi'){
      $this->menu_coffee();
    }elseif($jenis == 'Teh'){
      $this->menu_tea();
    }elseif($jenis == 'Jus'){
      $this->menu_juice();
    }elseif($jenis == 'Susu'){
      $this->menu_milk();
    }elseif($jenis == 'Soda'){
      $this->menu_soda();
    }elseif($jenis == 'Nasi'){
      $this->menu_rice();
    }elseif($jenis == 'Mie'){
      $this->menu_noodle();
    }elseif($jenis == 'Kue Kering'){
      $this->menu_pastry();
    }elseif($jenis == 'Bolu'){
      $this->menu_cake();
    }elseif($jenis == 'Dessert'){
      $this->menu_dessert();
    }
  }

  function menu_coffee()
  {
    $data = [
      'cart'  => $this->cart->contents(),
      'title' => 'Kopi | Areum Cafe',
      'group' => 'Minuman',
      'jenis' => 'Kopi',
      'css'   => 'waiter.css',
      'js'    => ''
    ];
    if($this->input->post('cari')){
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    }else{
      $data['keyword'] = $this->session->userdata('keyword');
    }

    $data['menu'] = $this->dm->menu_coffee($data['keyword']);

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
      'group' => 'Minuman',
      'jenis' => 'Teh',
      'menu'  => $this->dm->menu_tea(),
      'css'   => 'waiter.css',
      'js'    => ''
    ];
    if ($this->input->post('cari')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    $data['menu'] = $this->dm->menu_tea($data['keyword']);

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
      'group' => 'Minuman',
      'jenis' => 'Jus',
      'menu'  => $this->dm->menu_juice(),
      'css'   => 'waiter.css',
      'js'    => ''
    ];
    if ($this->input->post('cari')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    $data['menu'] = $this->dm->menu_juice($data['keyword']);

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
      'group' => 'Minuman',
      'jenis' => 'Susu',
      'menu'  => $this->dm->menu_milk(),
      'css'   => 'waiter.css',
      'js'    => ''
    ];
    if ($this->input->post('cari')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    $data['menu'] = $this->dm->menu_milk($data['keyword']);

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
      'group' => 'Minuman',
      'jenis' => 'Soda',
      'menu'  => $this->dm->menu_soda(),
      'css'   => 'waiter.css',
      'js'    => ''
    ];
    if ($this->input->post('cari')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    $data['menu'] = $this->dm->menu_soda($data['keyword']);

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
      'group' => 'Makanan',
      'jenis' => 'Nasi',
      'menu'  => $this->dm->menu_rice(),
      'css'   => 'waiter.css',
      'js'    => ''
    ];
    if ($this->input->post('cari')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    $data['menu'] = $this->dm->menu_rice($data['keyword']);

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
      'group' => 'Makanan',
      'jenis' => 'Mie',
      'menu'  => $this->dm->menu_noodle(),
      'css'   => 'waiter.css',
      'js'    => ''
    ];
    if ($this->input->post('cari')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    $data['menu'] = $this->dm->menu_noodle($data['keyword']);

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
      'group' => 'Makanan',
      'jenis' => 'Kue Kering',
      'menu'  => $this->dm->menu_pastry(),
      'css'   => 'waiter.css',
      'js'    => ''
    ];
    if ($this->input->post('cari')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    $data['menu'] = $this->dm->menu_pastry($data['keyword']);

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
      'group' => 'Makanan',
      'jenis' => 'Bolu',
      'menu'  => $this->dm->menu_cake(),
      'css'   => 'waiter.css',
      'js'    => ''
    ];
    if ($this->input->post('cari')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    $data['menu'] = $this->dm->menu_cake($data['keyword']);

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
      'group' => 'Makanan',
      'jenis' => 'Dessert',
      'menu'  => $this->dm->menu_dessert(),
      'css'   => 'waiter.css',
      'js'    => ''
    ];
    if ($this->input->post('cari')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    $data['menu'] = $this->dm->menu_dessert($data['keyword']);

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar-menu');
    $this->load->view('waiter/daftar_menu', $data);
    $this->load->view('templates/footer', $data);
  }

  function refresh($jenis)
  {
    if ($jenis == 'Kopi') {
      $this->refresh_coffee();
    } elseif ($jenis == 'Teh') {
      $this->refresh_tea();
    } elseif ($jenis == 'Jus') {
      $this->refresh_juice();
    } elseif ($jenis == 'Susu') {
      $this->refresh_milk();
    } elseif ($jenis == 'Soda') {
      $this->refresh_soda();
    } elseif ($jenis == 'Nasi') {
      $this->refresh_rice();
    } elseif ($jenis == 'Mie') {
      $this->refresh_noodle();
    } elseif ($jenis == 'Kue Kering') {
      $this->refresh_pastry();
    } elseif ($jenis == 'Bolu') {
      $this->refresh_cake();
    } elseif ($jenis == 'Dessert') {
      $this->refresh_dessert();
    }
  }

  function refresh_coffee()
  {
    $this->session->unset_userdata('keyword');
    redirect('daftarMenu/menu_coffee');
  }

  function refresh_tea()
  {
    $this->session->unset_userdata('keyword');
    redirect('daftarMenu/menu_tea');
  }

  function refresh_juice()
  {
    $this->session->unset_userdata('keyword');
    redirect('daftarMenu/menu_juice');
  }

  function refresh_milk()
  {
    $this->session->unset_userdata('keyword');
    redirect('daftarMenu/menu_milk');
  }

  function refresh_soda()
  {
    $this->session->unset_userdata('keyword');
    redirect('daftarMenu/menu_soda');
  }

  function refresh_rice()
  {
    $this->session->unset_userdata('keyword');
    redirect('daftarMenu/menu_rice');
  }

  function refresh_noodle()
  {
    $this->session->unset_userdata('keyword');
    redirect('daftarMenu/menu_noodle');
  }

  function refresh_pastry()
  {
    $this->session->unset_userdata('keyword');
    redirect('daftarMenu/menu_pastry');
  }

  function refresh_cake()
  {
    $this->session->unset_userdata('keyword');
    redirect('daftarMenu/menu_cake');
  }

  function refresh_dessert()
  {
    $this->session->unset_userdata('keyword');
    redirect('daftarMenu/menu_dessert');
  }
}
