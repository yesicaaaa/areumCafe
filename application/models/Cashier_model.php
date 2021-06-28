<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Cashier_model extends CI_Model {
  function getDataPelanggan()
  {
    $sql = "SELECT * FROM `pelanggan` AS `p`
            JOIN `pesanan` AS `ps` ON `ps`.`id_pelanggan` = `p`.`id_pelanggan`
            JOIN `user` AS `u` ON `u`.`id_user` = `p`.`id_waiter`
            WHERE `ps`.`status` = 'Belum Dibayar'
            GROUP BY `p`.`id_pelanggan`
          ";

    return $this->db->query($sql)->result_array();
  }

  function getPesananPelanggan($id_pelanggan)
  {
    $sql = "SELECT * FROM `pesanan` as `p`
            JOIN `menu` AS `m` ON `m`.`id_menu` = `p`.`id_menu`
            WHERE `p`.`id_pelanggan` = $id_pelanggan
          ";
    return $this->db->query($sql)->result_array();
  }

  function bayar_transaksi()
  {
    date_default_timezone_set('Asia/Jakarta');
    $data = [
      'id_transaksi'  => 'TR' . time(),
      'id_pegawai'    => htmlspecialchars($this->input->post('id_pegawai')),
      'id_pelanggan'  => htmlspecialchars($this->input->post('id_pelanggan')),
      'tanggal_transaksi' => date('Y-m-d H:i:s'),
      'total_harga'   => htmlspecialchars($this->input->post('total_harga')),
      'total_bayar'   => htmlspecialchars($this->input->post('total_bayar')),
      'kembalian'     => htmlspecialchars($this->input->post('total_bayar')) - htmlspecialchars($this->input->post('total_harga'))
    ];
    $this->db->insert('transaksi', $data);
    $status = [
      'status'  => 'Sudah Dibayar' 
    ];
    $this->db->where('id_pelanggan', $this->input->post('id_pelanggan'));
    $this->db->update('pesanan', $status);
  }

  function getAllDataPelanggan($id_cashier)
  {
    $sql = "SELECT * FROM `pelanggan` AS `p`
            JOIN `pesanan` AS `ps` ON `ps`.`id_pelanggan` = `p`.`id_pelanggan`
            JOIN `transaksi` AS `t` ON `t`.`id_pelanggan` = `p`.`id_pelanggan`
            JOIN `user` AS `u` ON `u`.`id_user` = `p`.`id_waiter`
            WHERE `t`.`id_pegawai` = $id_cashier
            AND `ps`.`status` = 'Sudah Dibayar'
            GROUP BY `p`.`nama_pelanggan`
          ";
  return $this->db->query($sql)->result_array();
  }

  function getDataTransaksi($id_pelanggan)
  {
    $sql = "SELECT * FROM `transaksi` AS `t`
          JOIN `user` AS `u` ON `u`.`id_user` = `t`.`id_pegawai`
          WHERE `t`.`id_pelanggan` = $id_pelanggan
          ";
    return $this->db->query($sql)->row_array();
  }
}
?>