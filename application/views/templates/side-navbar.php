<nav class="navbar sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= base_url() ?>admin">Areum <span>Cafe</span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <p><?= $user['nama'] ?></p>
  </div>
</nav>
<div class="sidenav">
  <div>
    <div class="divider-first"></div>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('admin'); ?>"><i class="fa fa-fw fa-home"></i><span>Dashboard</span></a></li>
    </ul>
    <div class="divider"></div>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('admin/pegawai'); ?>"><i class="fa fa-fw fa-users"></i><span>Pegawai</span></a></li>
    </ul>
    <!-- <div class="divider"></div>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('petugas/my_profile'); ?>"><i class="fa fa-fw fa-users"></i><span>Pelanggan</span></a></li>
    </ul> -->
    <div class="divider"></div>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('admin/menuCafe'); ?>"><i class="fa fa-fw fa-coffee"></i><span>Menu Cafe</span></a></li>
    </ul>
    <div class="divider"></div>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('petugas/my_profile'); ?>"><i class="fa fa-fw fa-file"></i><span>Laporan</span></a></li>
    </ul>
    <div class="divider"></div>
    <div class="divider-end"></div>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('main/signout'); ?>" onclick="return confirm('Yakin ingin keluar?')"><i class="fa fa-fw fa-arrow-left"></i><span>Keluar</span></a></li>
    </ul>
    <div class="divider"></div>
  </div>
</div>