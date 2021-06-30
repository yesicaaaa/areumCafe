<?php
defined('BASEPATH') or exit('No direct script access allowed');
require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Cashier extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('cashier_model', 'cm');
    is_logged_in_cashier();
  }

  function transaksi()
  {
    $data = [
      'user'  => $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
      'title' => 'Transaksi | Areum Cafe',
      'css'   => 'cashier.css',
      'js'    => 'cashier.js'
    ];
    if ($this->input->post('cari')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    $data['dataPelanggan'] = $this->cm->getDataPelanggan($data['keyword']);

    $this->load->view('templates/header', $data);
    $this->load->view('templates/navbar', $data);
    $this->load->view('cashier/transaksi', $data);
    $this->load->view('templates/footer', $data);
  }

  function refreshTransaksi()
  {
    $this->session->unset_userdata('keyword');
    redirect('cashier/transaksi');
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
      'title' => 'Transaksi | Areum Cafe',
      'css'   => 'cashier.css',
      'js'    => 'cashier.js'
    ];
    if ($this->input->post('cari')) {
      $data['keyword'] = $this->input->post('keyword');
      $this->session->set_userdata('keyword', $data['keyword']);
    } else {
      $data['keyword'] = $this->session->userdata('keyword');
    }

    $data['dataPelanggan'] = $this->cm->getAllDataPelanggan($id_cashier, $data['keyword']);


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

  function refreshHistoryTransaksi()
  {
    $this->session->unset_userdata('keyword');
    redirect('cashier/history_transaksi');
  }

  function strukPembelian($id_pelanggan)
  {
    $id_cashier = $this->session->userdata('id_user');
    $data = [
      'dataPelanggan' => $this->cm->getAllDataPelanggan($id_cashier),
      'pelanggan' => $this->db->get_where('pelanggan', ['id_pelanggan' => $id_pelanggan])->row_array(),
      'pesanan' => $this->cm->getPesananPelanggan($id_pelanggan),
      'total_pesanan' => $this->db->get_where('total_pesanan', ['id_pelanggan' => $id_pelanggan])->row_array(),
      'transaksi' => $this->cm->getDataTransaksi($id_pelanggan)
    ];
$this->load->view('cashier/struk-pembayaran', $data);
    // $this->pdfdom->setPaper('A4', 'potrait');
    // $this->pdfdom->load_view('cashier/struk-pembayaran', $data);
  }
}
