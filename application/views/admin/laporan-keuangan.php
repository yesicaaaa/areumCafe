<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Laporan Keuangan</li>
    </ol>
  </nav>
  <form action="<?= base_url('admin/laporanKeuangan') ?>" method="POST">
    <div class="input-group mb-3 input-cari">
      <input type="text" class="form-control" placeholder="Cari...." name="keyword" autocomplete="off">
      <input class="btn btn-cari" type="submit" name="cari"></input>
      <a href="<?= base_url('admin/refreshLaporanKeuangan') ?>" class="refresh"><i class="fa fa-refresh"></i></a>
    </div>
  </form>
  <table class="table">
    <thead class="table-color">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Tanggal</th>
        <th scope="col">Nama Kasir</th>
        <th scope="col">Pendapatan/Hari</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; ?>
      <?php foreach ($keuangan as $k) : ?>
        <tr>
          <th scope="row"><?= $i++ ?></th>
          <td><?= $k['tanggal'] ?></td>
          <td><?= $k['nama'] ?></td>
          <td>Rp<?= number_format($k['pendapatan'], 0, ',', '.') ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php if ($keuangan == null) : ?>
    <div class="alert alert-danger">
      Tidak ada data!
    </div>
  <?php endif; ?>
</div>