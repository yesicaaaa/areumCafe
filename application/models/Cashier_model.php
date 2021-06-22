<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Cashier_model extends CI_Model {
  function getPesanan()
  {
    $sql = "SELECT * FROM `pelanggan` as `pl`
            JOIN `pesanan` as `ps` ON `ps`.`id_pelanggan` = `pl`.`id_pelanggan`
            JOIN `user` as `u` ON `u`.`id_user` = `pl`.`id_waiter`
            ";

    return $this->db->query($sql)->result_array();
  }
}
?>