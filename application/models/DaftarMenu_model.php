<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class DaftarMenu_model extends CI_Model {
  function menu_coffee()
  {
    $sql = "SELECT * FROM `menu`
            WHERE `jenis` = 'kopi'
          ";
    
    return $this->db->query($sql)->result_array();
  }

  function menu_tea()
  {
    $sql = "SELECT * FROM `menu`
            WHERE `jenis` = 'teh'
          ";

    return $this->db->query($sql)->result_array();
  }

  function menu_juice()
  {
    $sql = "SELECT * FROM `menu`
            WHERE `jenis` = 'jus'
          ";

    return $this->db->query($sql)->result_array();
  }

  function menu_milk()
  {
    $sql = "SELECT * FROM `menu`
            WHERE `jenis` = 'susu'
          ";

    return $this->db->query($sql)->result_array();
  }

  function menu_soda()
  {
    $sql = "SELECT * FROM `menu`
            WHERE `jenis` = 'soda'
          ";

    return $this->db->query($sql)->result_array();
  }

  function menu_rice()
  {
    $sql = "SELECT * FROM `menu`
            WHERE `jenis` = 'nasi'
          ";

    return $this->db->query($sql)->result_array();
  }

  function menu_noodle()
  {
    $sql = "SELECT * FROM `menu`
            WHERE `jenis` = 'mie'
          ";

    return $this->db->query($sql)->result_array();
  }

  function menu_pastry()
  {
    $sql = "SELECT * FROM `menu`
            WHERE `jenis` = 'pastry'
          ";

    return $this->db->query($sql)->result_array();
  }

  function menu_cake()
  {
    $sql = "SELECT * FROM `menu`
            WHERE `jenis` = 'bolu'
          ";

    return $this->db->query($sql)->result_array();
  }

  function menu_dessert()
  {
    $sql = "SELECT * FROM `menu`
            WHERE `jenis` = 'dessert'
          ";

    return $this->db->query($sql)->result_array();
  }
}
