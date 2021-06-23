<?php 
defined('BASEPATH') or exit ('No direct script access allowed');

class Waiter_model extends CI_Model {
  function getPesanan()
  {
    $sql = "SELECT * FROM `pelanggan` AS `pl`
            JOIN `pesanan` AS `ps` ON `ps`.`id_pelanggan` = `pl`.`id_pelanggan`
            JOIN `user` AS `u` ON `u`.`id_user` = `pl`.`id_waiter`
            GROUP BY `pl`.`nama_pelanggan`
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
    foreach($_POST['id_pelanggan'] as $key => $val){
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

    $this->cart->destroy();
  }

  function delete_pesanan($id)
  {
    return $this->db->delete('pelanggan', ['id_pelanggan' => $id]);
  }
}

?>