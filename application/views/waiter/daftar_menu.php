<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item bc"><a href="javascript:void(0)">Minuman</a></li>
      <li class="breadcrumb-item active" aria-current="page"><?= $jenis ?></li>
    </ol>
  </nav>
  <?php if($menu == null) : ?>
  <div class="alert alert-danger">
    Menu tidak tersedia!
  </div>
  <?php endif; ?>
  <?php foreach ($menu as $m) : ?>
    <div class="row row-menu">
      <div class="col-md-2">
        <img src="<?= base_url('assets/img/menu/') . $m['foto'] ?>" alt="menu">
      </div>
      <div class="col-md-5">
        <h5><?= $m['nama'] ?></h5>
        <p><?= $m['deskripsi'] ?></p>
      </div>
      <div class="col-md-1">
        <h6>Rp<?= number_format($m['harga'], 0, ',', '.'); ?></h6>
      </div>
      <div class="col-md-1">
        <span>Stok</span><br>
        <?php if ($m['stok'] > 0) : ?>
          <p class="h7"><?= $m['stok'] ?></p>
        <?php else : ?>
          <p class="h7">Habis</p>
        <?php endif; ?>
      </div>
      <div class="col-md-2">
        <?php if ($m['stok'] > 0) : ?>
          <a href="<?= base_url('waiter/add_to_cart/') . $m['id_menu'] ?>" class="badge bg-success" onclick="return confirm('Yakin ingin memesan?')">Tambahkan</a>
        <?php else : ?>
          <a class="badge bg-secondary" disabled>Tambahkan</a>
        <?php endif; ?>
      </div>
    </div>
  <?php endforeach; ?>
  <div class="footer-pesanan">
    <a href="<?= base_url() ?>waiter/cart"><i class="fa fa-fw fa-opencart"></i></a>
  </div>
</div>