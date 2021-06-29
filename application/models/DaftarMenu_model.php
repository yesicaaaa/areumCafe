<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DaftarMenu_model extends CI_Model
{
  function menu_coffee($keyword = null)
  {
    $sql = "SELECT * FROM `menu`
            WHERE `jenis` = 'kopi'
            AND `nama` LIKE '%$keyword%'
          ";

    return $this->db->query($sql)->result_array();
  }

  function menu_tea($keyword = null)
  {
    $sql = "SELECT * FROM `menu`
            WHERE `jenis` = 'teh'
            AND `nama` LIKE '%$keyword%'
          ";

    return $this->db->query($sql)->result_array();
  }

  function menu_juice($keyword = null)
  {
    $sql = "SELECT * FROM `menu`
            WHERE `jenis` = 'jus'
            AND `nama` LIKE '%$keyword%'
          ";

    return $this->db->query($sql)->result_array();
  }

  function menu_milk($keyword = null)
  {
    $sql = "SELECT * FROM `menu`
            WHERE `jenis` = 'susu'
            AND `nama` LIKE '%$keyword%'
          ";

    return $this->db->query($sql)->result_array();
  }

  function menu_soda($keyword = null)
  {
    $sql = "SELECT * FROM `menu`
            WHERE `jenis` = 'soda'
            AND `nama` LIKE '%$keyword%'
          ";

    return $this->db->query($sql)->result_array();
  }

  function menu_rice($keyword = null)
  {
    $sql = "SELECT * FROM `menu`
            WHERE `jenis` = 'nasi'
            AND `nama` LIKE '%$keyword%'
          ";

    return $this->db->query($sql)->result_array();
  }

  function menu_noodle($keyword = null)
  {
    $sql = "SELECT * FROM `menu`
            WHERE `jenis` = 'mie'
            AND `nama` LIKE '%$keyword%'
          ";

    return $this->db->query($sql)->result_array();
  }

  function menu_pastry($keyword = null)
  {
    $sql = "SELECT * FROM `menu`
            WHERE `jenis` = 'pastry'
            AND `nama` LIKE '%$keyword%'
          ";

    return $this->db->query($sql)->result_array();
  }

  function menu_cake($keyword = null)
  {
    $sql = "SELECT * FROM `menu`
            WHERE `jenis` = 'bolu'
            AND `nama` LIKE '%$keyword%'
          ";

    return $this->db->query($sql)->result_array();
  }

  function menu_dessert($keyword = null)
  {
    $sql = "SELECT * FROM `menu`
            WHERE `jenis` = 'dessert'
            AND `nama` LIKE '%$keyword%'
          ";

    return $this->db->query($sql)->result_array();
  }
}
