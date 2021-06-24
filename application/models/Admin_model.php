<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
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

  function getDataMenu()
  {
    return $this->db->get('menu')->result_array();
  }

  function addMenu()
  {
    $data = [
      'nama'  => htmlspecialchars($this->input->post('nama')),
      'harga' => htmlspecialchars($this->input->post('harga')),
      'deskripsi' => htmlspecialchars($this->input->post('deskripsi')),
      'foto'  => $this->_do_uploadMenu(),
      'jenis' => htmlspecialchars($this->input->post('jenis')),
      'stok'  => htmlspecialchars($this->input->post('stok')),
      'date_created'  => date('Y-m-d')
    ];

    $this->db->insert('menu', $data);
  }

  private function _do_uploadMenu()
  {
    $config = [
      'upload_path'   => './assets/img/menu/',
      'allowed_types' => 'jpg|png',
      'max_size'      => 2048,
      'overwrite'     => true,
      'file_name'     => $this->input->post('nama')
    ];
    $this->upload->initialize($config);

    if ($this->upload->do_upload('foto')) {
      return $this->upload->data('file_name');
    } else {
      return 'default.jpg';
    }
  }

  private function _menuImg_delete($id)
  {
    $menuImg = $this->db->get_where('menu', ['id_menu' => $id])->row_array();
    if ($menuImg['foto'] != 'default.png') {
      $filename = explode('.', $menuImg['foto'])[0];
      return array_map('unlink', glob(FCPATH .  "assets/img/menu/$filename.*"));
    }
  }

  function menu_delete($id)
  {
    $this->_menuImg_delete($id);
    return $this->db->delete('menu', ['id_menu' => $id]);
  }

  function editMenu()
  {
    $data = [
      'nama'  => htmlspecialchars($this->input->post('nama')),
      'harga' => htmlspecialchars($this->input->post('harga')),
      'deskripsi' => htmlspecialchars($this->input->post('deskripsi')),
      // 'foto'  => $this->_do_uploadMenu(),
      'jenis' => htmlspecialchars($this->input->post('jenis')),
      'stok'  => htmlspecialchars($this->input->post('stok')),
      'date_created'  => date('Y-m-d')
    ];

    $this->db->insert('menu', $data);
  }
}
