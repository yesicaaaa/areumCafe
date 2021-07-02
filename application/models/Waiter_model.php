<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Waiter_model extends CI_Model
{
  function getPesanan($limit, $start, $id_waiter, $keyword = null)
  {
    $sql = "SELECT * FROM `pelanggan` AS `pl`
            JOIN `pesanan` AS `ps` ON `ps`.`id_pelanggan` = `pl`.`id_pelanggan`
            JOIN `user` AS `u` ON `u`.`id_user` = `pl`.`id_waiter`
            WHERE `pl`.`id_waiter` = $id_waiter
            -- AND `pl`.`tanggal` LIKE '%$keyword%'
            AND `pl`.`nama_pelanggan` LIKE '%$keyword%'
            -- OR `pl`.`phone` LIKE '%$keyword%'
            -- OR `pl`.`no_meja` LIKE '%$keyword%'
            -- OR `u`.`nama` LIKE '%$keyword%'
            AND `ps`.`status` = 'Dipesan'
            GROUP BY `pl`.`nama_pelanggan`
            LIMIT $start, $limit
          ";

    return $this->db->query($sql)->result_array();
  }

  function getHistoryPesanan($limit, $start, $id_waiter, $keyword = null)
  {
    $sql = "SELECT * FROM `pelanggan` AS `pl`
            JOIN `pesanan` AS `ps` ON `ps`.`id_pelanggan` = `pl`.`id_pelanggan`
            JOIN `user` AS `u` ON `u`.`id_user` = `pl`.`id_waiter`
            WHERE `pl`.`id_waiter` = $id_waiter
            AND `pl`.`nama_pelanggan` LIKE '%$keyword%'
            AND `ps`.`status` != 'Dipesan'
            GROUP BY `pl`.`nama_pelanggan`
            LIMIT $start, $limit
          ";

    return $this->db->query($sql)->result_array();
  }

  function addPelanggan()
  {
    $data = [
      'id_pelanggan'    => time(),
      'nama_pelanggan'  => htmlspecialchars($this->input->post('nama_pelanggan')),
      'phone'           => htmlspecialchars($this->input->post('phone')),
      'tanggal'         => htmlspecialchars($this->input->post('tanggal')),
      'no_meja'         => htmlspecialchars($this->input->post('no_meja')),
      'id_waiter'       => htmlspecialchars($this->input->post('id_waiter'))
    ];

    $this->db->insert('pelanggan', $data);
    $this->session->set_userdata($data);
  }

  function add_to_cart($id)
  {
    $menu = $this->db->get_where('menu', ['id_menu' => $id])->row_array();
    $data = [
      'id'      => $menu['id_menu'],
      'qty'     => 1,
      'price'   => $menu['harga'],
      'name'    => $menu['nama']
    ];
    $this->cart->insert($data);

    $stok = [
      'stok'  => $menu['stok'] - 1
    ];
    $this->db->where('id_menu', $id);
    $this->db->update('menu', $stok);
  }

  function delete_pelanggan($id)
  {
    $data = [
      'id_pelanggan'    => $this->session->userdata('id_pelanggan'),
      'nama_pelanggan'  => $this->session->userdata('nama_pelanggan'),
      'phone'           => $this->session->userdata('phone'),
      'tanggal'         => $this->session->userdata('tanggal'),
      'no_meja'         => $this->session->userdata('no_meja'),
      'id_waiter'       => $this->session->userdata('id_waiter')
    ];
    $this->session->unset_userdata($data);
    $this->db->delete('pelanggan', ['id_pelanggan' => $id]);
    $this->cart->destroy();
  }

  function add_pesanan()
  {
    $pesan = array();
    foreach ($_POST['id_pelanggan'] as $key => $val) {
      $pesan[] = array(
        'id_pelanggan'  => $_POST['id_pelanggan'][$key],
        'id_menu'       => $_POST['id_menu'][$key],
        'qty'           => $_POST['qty'][$key],
        'rowid'         => $_POST['rowid'][$key],
        'subtotal'      => $_POST['subtotal'][$key],
        'status'        => $_POST['status'][$key]
      );
    }
    $this->db->insert_batch('pesanan', $pesan);

    $cart = [
      'id_pelanggan'  => $this->session->userdata('id_pelanggan'),
      'total_items' => $this->cart->total_items(),
      'total'    => $this->cart->total(),
      'tax'         => $this->cart->total() * 0.1,
      'subtotal'    => $this->cart->total() + ($this->cart->total() * 0.1)
    ];

    $this->db->insert('total_pesanan', $cart);

    $this->cart->destroy();
  }

  function delete_pesanan($id)
  {
    return $this->db->delete('pelanggan', ['id_pelanggan' => $id]);
  }

  function getPesananPelanggan($id_pelanggan)
  {
    $sql = "SELECT * FROM `pesanan` 
            JOIN `menu` ON `menu`.`id_menu` = `pesanan`.`id_menu`
            WHERE `pesanan`.`id_pelanggan` = $id_pelanggan 
            AND `pesanan`.`status` = 'Dipesan'
          ";

    return $this->db->query($sql)->result_array();
  }

  function getHistoryPesananPelanggan($id_pelanggan)
  {
    $sql = "SELECT * FROM `pesanan` 
            JOIN `menu` ON `menu`.`id_menu` = `pesanan`.`id_menu`
            WHERE `pesanan`.`id_pelanggan` = $id_pelanggan 
            AND `pesanan`.`status` != 'Dipesan'
          ";

    return $this->db->query($sql)->result_array();
  }

  function getDataPelanggan($id_pelanggan, $id_waiter)
  {
    return $this->db->get_where('pelanggan', ['id_pelanggan' => $id_pelanggan, 'id_waiter' => $id_waiter])->row_array();
  }

  function getTotalPesanan($id_pelanggan)
  {
    return $this->db->get_where('total_pesanan', ['id_pelanggan' => $id_pelanggan])->row_array();
  }

  function antarkan_pesanan($id_pelanggan)
  {
    $data = [
      'status' => 'Belum Dibayar'
    ];

    $this->db->where('id_pelanggan', $id_pelanggan);
    $this->db->update('pesanan', $data);
  }
}
