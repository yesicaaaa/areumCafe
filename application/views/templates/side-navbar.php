<div class="sidenav">
  <nav class="navbar navbar-admin">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?= base_url() ?>admin">Areum <span>Cafe</span></a>
    </div>
  </nav>
  <div>
    <div class="divider-first"></div>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('admin'); ?>"><i class="fa fa-fw fa-home"></i><span>Dashboard</span></a></li>
    </ul>
    <div class="divider"></div>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('admin/pegawai'); ?>"><i class="fa fa-fw fa-users"></i><span>Pegawai</span></a></li>
    </ul>
    <div class="divider"></div>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('admin/menuCafe'); ?>"><i class="fa fa-fw fa-coffee"></i><span>Menu Cafe</span></a></li>
    </ul>
    <div class="divider"></div>
    <h6>Laporan</h6>
    <div class="divider"></div>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('admin/laporanPelanggan'); ?>"><i class="fa fa-fw fa-users"></i><span>Pelanggan</span></a></li>
    </ul>
    <div class="divider"></div>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('admin/laporanPenjualan'); ?>"><i class="fa fa-fw fa-file"></i><span>Penjualan</span></a></li>
    </ul>
    <div class="divider"></div>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('admin/laporanKeuangan'); ?>"><i class="fa fa-fw fa-money"></i><span>Keuangan</span></a></li>
    </ul>
    <div class="divider"></div>
    <div class="divider-end"></div>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('main/signout'); ?>" onclick="return confirm('Yakin ingin keluar?')"><i class="fa fa-fw fa-arrow-left"></i><span>Keluar</span></a></li>
    </ul>
    <div class="divider"></div>
  </div>
</div>