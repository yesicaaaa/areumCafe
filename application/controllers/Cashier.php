<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cashier extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('cashier_model', 'cm');
  }

  function transaksi()
  {
    $data = [
      'user'  => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'dataPelanggan' => $this->cm->getDataPelanggan(),
      'title' => 'Transaksi | Areum Cafe',
      'css'   => 'cashier.css',
      'js'    => 'cashier.js'
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/navbar', $data);
    $this->load->view('cashier/transaksi', $data);
    $this->load->view('templates/footer', $data);
  }

  function proses_transaksi($id_pelanggan)
  {
    $data = [
      'user'  => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'dataPelanggan' => $this->cm->getDataPelanggan(),
      'pelanggan' => $this->db->get_where('pelanggan', ['id_pelanggan' => $id_pelanggan])->row_array(),
      'pesanan' => $this->cm->getPesananPelanggan($id_pelanggan),
      'total_pesanan' => $this->db->get_where('total_pesanan', ['id_pelanggan' => $id_pelanggan])->row_array(),
      'title' => 'Proses Transaksi | Areum Cafe',
      'css'   => 'cashier.css',
      'js'    => 'cashier.js'
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/navbar', $data);
    $this->load->view('cashier/proses-transaksi', $data);
    $this->load->view('templates/footer', $data);
  }

  function bayar_transaksi($id_pelanggan)
  {
    $this->form_validation->set_rules('total_bayar', 'Total Bayar', 'required');

    if ($this->form_validation->run() == false) {
      $data = [
        'user'  => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
        'dataPelanggan' => $this->cm->getDataPelanggan(),
        'pelanggan' => $this->db->get_where('pelanggan', ['id_pelanggan' => $id_pelanggan])->row_array(),
        'pesanan' => $this->cm->getPesananPelanggan($id_pelanggan),
        'total_pesanan' => $this->db->get_where('total_pesanan', ['id_pelanggan' => $id_pelanggan])->row_array(),
        'title' => 'Proses Transaksi | Areum Cafe',
        'css'   => 'cashier.css',
        'js'    => 'cashier.js'
      ];

      $this->load->view('templates/header', $data);
      $this->load->view('templates/navbar', $data);
      $this->load->view('cashier/proses-transaksi', $data);
      $this->load->view('templates/footer', $data);
    } else {
      $total_harga = $this->input->post('total_harga');
      $total_bayar = $this->input->post('total_bayar');
      if ($total_bayar < $total_harga) {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Total pembayaran kurang dari total harga.</div>');
        redirect('cashier/bayar_transaksi/' . $id_pelanggan);
      } else {
        $this->cm->bayar_transaksi();
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil dibayarkan.</div>');
        redirect('cashier/history_transaksi_view/' . $id_pelanggan);
      }
    }
  }

  function history_transaksi()
  {
    $id_cashier = $this->session->userdata('id_user');
    $data = [
      'user'  => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'dataPelanggan' => $this->cm->getAllDataPelanggan($id_cashier),
      'title' => 'Transaksi | Areum Cafe',
      'css'   => 'cashier.css',
      'js'    => 'cashier.js'
    ];

    $this->load->view('templates/header', $data);
    $this->load->view('templates/navbar', $data);
    $this->load->view('cashier/history-transaksi', $data);
    $this->load->view('templates/footer', $data);
  }

  function history_transaksi_view($id_pelanggan)
  {
    $id_cashier = $this->session->userdata('id_user');
    $data = [
      'user'  => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'dataPelanggan' => $this->cm->getAllDataPelanggan($id_cashier),
      'pelanggan' => $this->db->get_where('pelanggan', ['id_pelanggan' => $id_pelanggan])->row_array(),
      'pesanan' => $this->cm->getPesananPelanggan($id_pelanggan), 
      'total_pesanan' => $this->db->get_where('total_pesanan', ['id_pelanggan' => $id_pelanggan])->row_array(),
      'transaksi' => $this->cm->getDataTransaksi($id_pelanggan),
      'title' => 'History Transaksi | Areum Cafe',
      'css' => 'cashier.css',
      'js'  => 'cashier.js'
    ];


    $this->load->view('templates/header', $data);
    $this->load->view('templates/navbar', $data);
    $this->load->view('cashier/history-transaksi-view', $data);
    $this->load->view('templates/footer', $data);
  }
}
