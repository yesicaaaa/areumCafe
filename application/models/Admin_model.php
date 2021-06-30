<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
  function getDataPegawai($keyword = null)
  {
    $sql = "SELECT * FROM `user` as `u`
            JOIN `hak_akses` as `ha`
            ON `ha`.`id_hak_akses` = `u`.`hak_akses`
            WHERE `u`.`nama` LIKE '%$keyword%'
            OR `u`.`email` LIKE '%$keyword%'
            OR `ha`.`nama_akses` LIKE '%$keyword%'
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

  function getDataMenu($keyword = null)
  {
    $sql = "SELECT * FROM `menu`
            WHERE `nama` LIKE '%$keyword%'
            OR `harga` LIKE '$keyword%%'
            OR `jenis` LIKE '%$keyword%'
            OR `stok` LIKE '%$keyword%'
          ";
    return $this->db->query($sql)->result_array();
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
      return 'default.png';
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
    $id_menu = $this->input->post('id_menu');
    $data = [
      'nama'  => htmlspecialchars($this->input->post('nama')),
      'harga' => htmlspecialchars($this->input->post('harga')),
      'deskripsi' => htmlspecialchars($this->input->post('deskripsi')),
      'foto'  => $this->_do_uploadEditMenu($this->input->post('foto'), $id_menu),
      'jenis' => htmlspecialchars($this->input->post('jenis')),
      'stok'  => htmlspecialchars($this->input->post('stok')),
      'date_created'  => date('Y-m-d')
    ];
    $this->db->where('id_menu', $id_menu);
    $this->db->update('menu', $data);
  }

  private function _do_uploadEditMenu($foto, $id_menu)
  {
    $menu = $this->db->get_where('menu', ['id_menu' => $id_menu])->row_array();
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
      return $menu['foto'];
    }
  }

  function getPenjualan($keyword = null)
  {
    $sql = "SELECT SUM(`ps`.`qty`) AS `terjual`, `pl`.`tanggal`, `m`.`nama`  FROM `pesanan` AS `ps`
            JOIN `pelanggan` AS `pl` ON `pl`.`id_pelanggan` = `ps`.`id_pelanggan`
            JOIN `menu` AS `m` ON `m`.`id_menu` = `ps`.`id_menu`
            WHERE `pl`.`tanggal` LIKE '%$keyword%'
            OR `m`.`nama` LIKE '%$keyword%'
            GROUP BY `pl`.`tanggal`, `ps`.`id_menu`
            ORDER BY `pl`.`tanggal` DESC
          ";
    return $this->db->query($sql)->result_array();
  }

  function getKeuangan($keyword = null)
  {
    $sql = "SELECT `pl`.`tanggal`, `tr`.`id_transaksi`, `u`.`nama`, SUM(`tr`.`total_harga`) AS `pendapatan` 
            FROM `transaksi` AS `tr` 
            JOIN `pelanggan` AS `pl` ON `pl`.`id_pelanggan` = `tr`.`id_pelanggan`
            JOIN `user` AS `u` ON `u`.`id_user` = `tr`.`id_pegawai`
            WHERE `pl`.`tanggal` LIKE '%$keyword%'
            OR `u`.`nama` LIKE '%$keyword%'
            GROUP BY `pl`.`tanggal`, `tr`.`id_pegawai`
            ORDER BY `pl`.`tanggal` DESC
          ";
    return $this->db->query($sql)->result_array();
  }

  function getPelanggan($keyword = null)
  {
    $sql = "SELECT `pl`.`id_pelanggan`, `pl`.`nama_pelanggan`, SUM(`ps`.`qty`) AS `qty`, SUM(`ps`.`subtotal`) AS `subtotal`, `u`.`nama`, `ps`.`status`, `pl`.`tanggal`
            FROM `pelanggan` AS `pl`
            JOIN `pesanan` AS `ps` ON `ps`.`id_pelanggan` = `pl`.`id_pelanggan`
            JOIN `user` AS `u` ON `u`.`id_user` = `pl`.`id_waiter`
            WHERE `pl`.`id_pelanggan` LIKE '%$keyword%'
            OR `pl`.`tanggal` LIKE '%$keyword%'
            OR `pl`.`nama_pelanggan` LIKE '%$keyword%'
            OR `u`.`nama` LIKE '%$keyword%'
            OR `ps`.`status` LIKE '%$keyword%'
            GROUP BY `pl`.`tanggal`, `pl`.`id_pelanggan`
            ORDER BY `pl`.`tanggal` DESC
          ";
    return $this->db->query($sql)->result_array();
  }

  function getPegawaiGrafik()
  {
    $sql = "SELECT `ha`.`nama_akses`, COUNT(*) AS `total`
            FROM `user` AS `u` 
            JOIN `hak_akses` AS `ha` ON `u`.`hak_akses` = `ha`.`id_hak_akses`
            GROUP BY `ha`.`nama_akses`
          ";
    return $this->db->query($sql)->result_array();
  }

  function getMenuGrafik()
  {
    $sql = "SELECT `jenis`, COUNT(*) AS `total` FROM `menu`
            GROUP BY `jenis`
          ";
    return $this->db->query($sql)->result_array();
  }

  function getMenuTerjualGrafik()
  {
    $sql = "SELECT `menu`.`jenis`, SUM(`pesanan`.`qty`) AS `total`
            FROM `pesanan` 
            JOIN `menu` ON `menu`.`id_menu` = `pesanan`.`id_menu`
            GROUP BY `menu`.`jenis`
            ";
    return $this->db->query($sql)->result_array();
  }

  function getStokMenuGrafik()
  {
    $sql = "SELECT `jenis`, SUM(`stok`) AS `total`
            FROM `menu`
            GROUP BY `jenis`
          ";
    return $this->db->query($sql)->result_array();
  }

  function getDataExportPegawai($keyword = null)
  {
    $sql = "SELECT * FROM `user`
            JOIN `hak_akses` ON `hak_akses`.`id_hak_akses` = `user`.`hak_akses`
            WHERE `user`.`nama` LIKE '%$keyword%'
            OR `user`.`email` LIKE '%$keyword%'
            OR `hak_akses`.`nama_akses` LIKE '%$keyword%'
          ";
    return $this->db->query($sql)->result_array();
  }

  function getDataExportMenuCafe($keyword = null)
  {
    $sql = "SELECT * FROM `menu`
            WHERE `nama` LIKE '%$keyword%'
            OR `harga` LIKE '%$keyword%'
            OR `jenis` LIKE '%$keyword%'
            OR `stok` LIKE '%$keyword%'
          ";
    return $this->db->query($sql)->result_array();
  }

  function getDataExportLaporanPenjualan($keyword = null)
  {
    $sql = "SELECT `pl`.`tanggal`, `m`.`nama`, SUM(`ps`.`qty`) AS `terjual`
            FROM `pesanan` AS `ps`
            JOIN `pelanggan` AS `pl` ON `pl`.`id_pelanggan` = `ps`.`id_pelanggan`
            JOIN `menu` AS `m` ON `m`.`id_menu` = `ps`.`id_menu`
            WHERE `pl`.`tanggal` LIKE '%$keyword%'
            OR `m`.`nama` LIKE '%$keyword%'
            GROUP BY `pl`.`tanggal`, `ps`.`id_menu`
            ORDER BY `pl`.`tanggal` DESC
          ";
    return $this->db->query($sql)->result_array();
  }

  function getDataExportLaporanPelanggan($keyword = null)
  {
    $sql = "SELECT `pl`.`id_pelanggan`, `pl`.`tanggal`, `pl`.`nama_pelanggan`, SUM(`ps`.`qty`) AS `qty`, SUM(`ps`.`subtotal`) AS `subtotal`, `u`.`nama`, `ps`.`status`
            FROM `pelanggan` AS `pl`
            JOIN `pesanan` AS `ps` ON `pl`.`id_pelanggan` = `ps`.`id_pelanggan`
            JOIN `user` AS `u` ON `u`.`id_user` = `pl`.`id_waiter`
            WHERE `pl`.`id_pelanggan` LIKE '%$keyword%'
            OR `pl`.`tanggal` LIKE '%$keyword%'
            OR `pl`.`nama_pelanggan` LIKE '%$keyword%'
            OR `u`.`nama` LIKE '%$keyword%'
            OR `ps`.`status` LIKE '%$keyword%'
            GROUP BY `pl`.`tanggal`, `pl`.`id_pelanggan`
            ORDER BY `pl`.`tanggal` DESC
          ";
    return $this->db->query($sql)->result_array();
  }

  function getDataExportLaporanKeuangan($keyword = null)
  {
    $sql = "SELECT `pl`.`tanggal`, `u`.`nama`, SUM(`tr`.`total_harga`) AS `pendapatan`
            FROM `transaksi` AS `tr` 
            JOIN `pelanggan` AS `pl` ON `pl`.`id_pelanggan` = `tr`.`id_pelanggan`
            JOIN `user` AS `u` ON `u`.`id_user` = `tr`.`id_pegawai`
            WHERE `pl`.`tanggal` LIKE '%$keyword%'
            OR `u`.`nama` LIKE '%$keyword%'
            GROUP BY `pl`.`tanggal`, `tr`.`id_pegawai`
            ORDER BY `pl`.`tanggal` DESC
          ";
    return $this->db->query($sql)->result_array();
  }
}
