<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Laporan Penjualan</li>
    </ol>
  </nav>
  <form action="<?= base_url('admin/laporanPenjualan') ?>" method="POST">
    <div class="input-group mb-3 input-cari">
      <input type="text" class="form-control" placeholder="Cari...." name="keyword" autocomplete="off">
      <input class="btn btn-cari" type="submit" name="cari"></input>
      <a href="<?= base_url('admin/refreshLaporanPenjualan') ?>" class="refresh"><i class="fa fa-refresh"></i></a>
    </div>
  </form>
  <table class="table">
    <thead class="table-color">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Tanggal</th>
        <th scope="col">Menu</th>
        <th scope="col">Terjual</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; ?>
      <?php foreach ($penjualan as $p) : ?>
        <tr>
          <th scope="row"><?= $i++ ?></th>
          <td><?= $p['tanggal'] ?></td>
          <td><?= $p['nama'] ?></td>
          <td><?= $p['terjual'] ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>