<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model{
  function getDataPegawai()
  {
    $sql = "SELECT * FROM `user` as `u`
            JOIN `hak_akses` as `ha`
            ON `ha`.`id_hak_akses` = `u`.`id_user`
          ";

    return $this->db->query($sql)->result_array();
  }
}
?>