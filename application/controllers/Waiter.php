<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Waiter extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('waiter_model', 'wm');
    is_logged_in_waiter();
    $this->session->unset_userdata('keyword');
  }

  function pesanan()
  {
    $id_waiter = $this->session->userdata('id_user');
    $data = [
      'user'  => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'title' => 'Pesanan | Areum Cafe',
      'css'   => 'waiter.css',
      'js'    => 'waiter.js'
    ];
    if ($this->input->post('cari')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    if (!$this->input->post('cari')) {
      $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required');
      $this->form_validation->set_rules('phone', 'No. Telepon', 'required|max_length[13]');
      $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
      $this->form_validation->set_rules('no_meja', 'No. Meja', 'required');
    }

    $data['pesanan'] = $this->wm->getPesanan($id_waiter, $data['keyword']);

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/navbar-waiter', $data);
      $this->load->view('waiter/pesanan', $data);
      $this->load->view('templates/footer', $data);
    } else {
      $this->wm->addPelanggan();
      redirect('DaftarMenu/menu_coffee');
    }
  }

  function refreshPesanan()
  {
    $this->session->unset_userdata('keyword');
    redirect('waiter/pesanan');
  }

  function add_to_cart($id)
  {
    $this->wm->add_to_cart($id);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Ditambahkan ke pesanan</div>');
    redirect('waiter/cart');
  }

  function delete_pelanggan($id)
  {
    if($_POST['id']){
      $data = array();
      foreach ($_POST['id'] as $key => $val) {
        $menu = $this->db->get_where('menu',  ['id_menu' => $_POST['id'][$key]])->row_array();
        $data[] = array(
          'id_menu' => $_POST['id'][$key],
          'stok'  => $menu['stok'] + $_POST['stok'][$key]
        );
      }
      $this->db->update_batch('menu', $data, 'id_menu');
    }
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
    foreach ($_POST['id'] as $id) {
      $this->wm->delete_pesanan($id);
    }
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pesanan berhasil dihapus</div>');
    redirect('waiter/pesanan');
  }

  function pesanan_view($id_pelanggan)
  {
    $id_waiter = $this->session->userdata('id_user');
    $data = [
      'user'  => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'pelanggan' => $this->wm->getDataPelanggan($id_pelanggan, $id_waiter),
      'pesanan'  => $this->wm->getPesananPelanggan($id_pelanggan),
      'dataPesanan' => $this->wm->getPesanan($id_waiter),
      'total_pesanan' => $this->wm->getTotalPesanan($id_pelanggan),
      'title' => 'Pesanan | Areum Cafe',
      'css'   => 'waiter.css',
      'js'    => 'waiter.js'
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/navbar-waiter', $data);
    $this->load->view('waiter/pesanan-view', $data);
    $this->load->view('templates/footer', $data);
  }

  function antarkan_pesanan($id_pelanggan)
  {
    $this->wm->antarkan_pesanan($id_pelanggan);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pesanan berhasil diantarkan</div>');
    redirect('waiter/pesanan');
  }

  function history_pesanan($id_pelanggan)
  {
    $id_waiter = $this->session->userdata('id_user');
    $data = [
      'user'  => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'pelanggan' => $this->wm->getDataPelanggan($id_pelanggan, $id_waiter),
      'pesanan'  => $this->wm->getHistoryPesananPelanggan($id_pelanggan),
      'dataPesanan' => $this->wm->getHistoryPesanan($id_waiter),
      'total_pesanan' => $this->wm->getTotalPesanan($id_pelanggan),
      'title' => 'History Pesanan | Areum Cafe',
      'css'   => 'waiter.css',
      'js'    => 'waiter.js'
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/navbar-waiter', $data);
    $this->load->view('waiter/history-pesanan', $data);
    $this->load->view('templates/footer', $data);
  }

  function history_pesanan_all()
  {
    $id_waiter = $this->session->userdata('id_user');
    $data = [
      'user'  => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'title' => 'History Pesanan | Areum Cafe',
      'css'   => 'waiter.css',
      'js'    => 'waiter.js'
    ];
    if ($this->input->post('cari')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword');
    } else {
      $data['keyword'] = $this->session->unset_userdata('keyword');
    }

    $data['dataPesanan'] = $this->wm->getHistoryPesanan($id_waiter, $data['keyword']);

    $this->load->view('templates/header', $data);
    $this->load->view('templates/navbar-waiter', $data);
    $this->load->view('waiter/history-pesanan-all', $data);
    $this->load->view('templates/footer', $data);
  }

  function refreshHistoryPesananAll()
  {
    $this->session->unset_userdata('keyword');
    redirect('waiter/history_pesanan_all');
  }

  function delete_cart($rowid, $id, $qty)
  {
    $menu = $this->db->get_where('menu', ['id_menu' => $id])->row_array();
    $stok = [
      'stok'  => $menu['stok'] + $qty
    ];
    $this->db->where('id_menu', $id);
    $this->db->update('menu', $stok);

    $data = [
      'rowid' => $rowid,
      'qty'   => 0
    ];
    $this->cart->update($data);

    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pesanan dihapus!</div>');
    redirect('waiter/cart');
  }
}
