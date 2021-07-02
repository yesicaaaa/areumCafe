<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Waiter extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('waiter_model', 'wm');
    is_logged_in_waiter();
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

    $config['base_url'] = 'http://localhost/areumCafe/waiter/pesanan';
    $this->db->select('pelanggan.tanggal, pelanggan.nama_pelanggan, pelanggan.phone, pelanggan.no_meja, user.nama, pesanan.status')
      ->where('pelanggan.id_waiter', $id_waiter)
      // ->like('pelanggan.tanggal', $data['keyword'])
      ->like('pelanggan.nama_pelanggan', $data['keyword'])
      // ->or_like('pelanggan.phone', $data['keyword'])
      // ->or_like('pelanggan.no_meja', $data['keyword'])
      // ->or_like('user.nama', $data['keyword'])
      // ->or_like('pesanan.status', $data['keyword'])
      ->where('pesanan.status', 'Dipesan')
      ->from('pelanggan')
      ->join('pesanan', 'pesanan.id_pelanggan = pelanggan.id_pelanggan')
      ->join('user', 'user.id_user = pelanggan.id_waiter')
      ->group_by('pelanggan.nama_pelanggan');
    $config['total_rows'] = $this->db->count_all_results();
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 10;

    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);
    $start = ($data['start'] > 0) ? $data['start'] : 0;

    $data['pesanan'] = $this->wm->getPesanan($config['per_page'], $start, $id_waiter, $data['keyword']);

    if (!$this->input->post('cari')) {
      $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required');
      $this->form_validation->set_rules('phone', 'No. Telepon', 'required|max_length[13]');
      $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
      $this->form_validation->set_rules('no_meja', 'No. Meja', 'required');
    }

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
    if ($_POST['id']) {
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
      'total_pesanan' => $this->wm->getTotalPesanan($id_pelanggan),
      'title' => 'Pesanan | Areum Cafe',
      'css'   => 'waiter.css',
      'js'    => 'waiter.js'
    ];

    $config['base_url'] = 'http://localhost/areumCafe/waiter/pesanan_view/' . $id_pelanggan . '/';
    $this->db->select('pelanggan.tanggal, pelanggan.nama_pelanggan, pelanggan.phone, pelanggan.no_meja, user.nama, pesanan.status')
      ->where('pelanggan.id_waiter', $id_waiter)
      ->where('pesanan.status', 'Dipesan')
      ->from('pelanggan')
      ->join('pesanan', 'pesanan.id_pelanggan = pelanggan.id_pelanggan')
      ->join('user', 'user.id_user = pelanggan.id_waiter')
      ->group_by('pelanggan.nama_pelanggan');
    $config['total_rows'] = $this->db->count_all_results();
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 10;

    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(4);
    $start = ($data['start'] > 0) ? $data['start'] : 0;

    $data['dataPesanan'] = $this->wm->getPesanan($config['per_page'], $start, $id_waiter);

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
      'total_pesanan' => $this->wm->getTotalPesanan($id_pelanggan),
      'title' => 'History Pesanan | Areum Cafe',
      'css'   => 'waiter.css',
      'js'    => 'waiter.js'
    ];

    $config['base_url'] = 'http://localhost/areumCafe/waiter/history_pesanan/' . $id_pelanggan . '/';
    $this->db->select('pelanggan.tanggal, pelanggan.nama_pelanggan, pelanggan.phone, pelanggan.no_meja, user.nama, pesanan.status')
      ->where('pelanggan.id_waiter', $id_waiter)
      ->where('pesanan.status !=', 'Dipesan')
      ->from('pelanggan')
      ->join('pesanan', 'pesanan.id_pelanggan = pelanggan.id_pelanggan')
      ->join('user', 'user.id_user = pelanggan.id_waiter')
      ->group_by('pelanggan.nama_pelanggan');
    $config['total_rows'] = $this->db->count_all_results();
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 10;

    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(4);
    $start = ($data['start'] > 0) ? $data['start'] : 0;

    $data['dataPesanan'] = $this->wm->getHistoryPesanan($config['per_page'], $start, $id_waiter);

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

    $config['base_url'] = 'http://localhost/areumCafe/waiter/history_pesanan_all/';
    $this->db->select('pelanggan.tanggal, pelanggan.nama_pelanggan, pelanggan.phone, pelanggan.no_meja, user.nama, pesanan.status')
      ->where('pelanggan.id_waiter', $id_waiter)
      ->like('pelanggan.nama_pelanggan', $data['keyword'])
      ->where('pesanan.status !=', 'Dipesan')
      ->from('pelanggan')
      ->join('pesanan', 'pesanan.id_pelanggan = pelanggan.id_pelanggan')
      ->join('user', 'user.id_user = pelanggan.id_waiter')
      ->group_by('pelanggan.nama_pelanggan');
    $config['total_rows'] = $this->db->count_all_results();
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 10;

    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);
    $start = ($data['start'] > 0) ? $data['start'] : 0;

    $data['dataPesanan'] = $this->wm->getHistoryPesanan($config['per_page'], $start, $id_waiter, $data['keyword']);

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
