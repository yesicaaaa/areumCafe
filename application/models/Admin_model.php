<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model{
  function getDataPegawai()
  {
    $sql = "SELECT * FROM `user` as `u`
            JOIN `hak_akses` as `ha`
            ON `ha`.`id_hak_akses` = `u`.`hak_akses`
          ";

    return $this->db->query($sql)->result_array();
  }

  function add_pegawai()
  {
    $data = [
      'nama'  => htmlspecialchars($this->input->post('nama')),
      'email' => htmlspecialchars($this->input->post('email')),
      'password'  => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
      'hak_akses' => 3,
      'date_created'  => date('Y-m-d')
    ];
    $this->db->insert('user', $data);
  }

  function pegawai_delete($id)
  {
    return $this->db->delete('user', ['id_user' => $id]);
  }

  function editPegawai()
  {
    $data = [
      'nama'  => htmlspecialchars($this->input->post('nama')),
      'email' => htmlspecialchars($this->input->post('email')),
      'hak_akses' => htmlspecialchars($this->input->post('hak_akses'))
    ];

    $this->db->where('id_user', $this->input->post('id_user'));
    $this->db->update('user', $data);
  }

  function getPegawaiRow($id_user)
  {
    $sql = "SELECT * from `user` as `u`
            JOIN `hak_akses` as `ha`
            ON `ha`.`id_hak_akses` = `u`.`hak_akses`
            WHERE `u`.`id_user` = $id_user
            ";

    return $this->db->query($sql)->row_array();
  }
}
?>