<?php 
defined('BASEPATH') or exit ('No direct script access allowed');

class Waiter_model extends CI_Model {
  function getPesanan()
  {
    $sql = "SELECT * FROM `pelanggan` AS `pl`
            JOIN `pesanan` AS `ps` ON `ps`.`id_pelanggan` = `pl`.`id_pelanggan`
            JOIN `user` AS `u` ON `u`.`id_user` = `pl`.`id_waiter`
          ";

    return $this->db->query($sql)->result_array();
  }

  private function _cekIdPelanggan()
  {
    $sql = "SELECT MAX(`id_pelanggan`) AS `id_pelanggan` FROM `pelanggan`";
    $id = $this->db->query($sql)->row_array();
    return $id['id_pelanggan'];
  }

  function addPelanggan()
  {
    $db = $this->_cekIdPelanggan();
    $nourut = substr($db, 4, 3);
    $nowId = $nourut + 1;
    $data = [
      'id_pelanggan'    => date('Y').$nowId,
      'nama_pelanggan'  => htmlspecialchars($this->input->post('nama_pelanggan')),
      'phone'           => htmlspecialchars($this->input->post('phone')),
      'tanggal'         => htmlspecialchars($this->input->post('tanggal')),
      'no_meja'         => htmlspecialchars($this->input->post('no_meja')),
      'id_waiter'       => htmlspecialchars($this->input->post('id_waiter'))
    ];

    $this->db->insert('pelanggan', $data);
    $this->session->set_userdata($data);
  }
}

?>