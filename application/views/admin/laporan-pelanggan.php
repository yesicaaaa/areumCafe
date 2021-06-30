<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Laporan Pelanggan</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-2">
      <a href="<?= base_url('admin/printExcelLaporanPelanggan/') . $this->session->userdata('keyword'); ?>" class="btn btn-success btn-excel" onclick="return confirm('Yakin ingin mengexport data ini?')"><i class="fa fa-fw fa-download"></i> Export Excel</a>
    </div>
    <div class="col-md-2">
      <a href="<?= base_url('admin/printPdfLaporanPelanggan/') . $this->session->userdata('keyword'); ?>" class="btn btn-danger btn-pdf" onclick="return confirm('Yakin ingin mengexport data ini?')"><i class="fa fa-fw fa-download"></i> Export PDF</a>
    </div>
    <div class="col-md-6">
      <form action="<?= base_url('admin/laporanPelanggan') ?>" method="POST">
        <div class="input-group mb-3 input-cari">
          <input type="text" class="form-control" placeholder="Cari...." name="keyword" autocomplete="off">
          <input class="btn btn-cari" type="submit" name="cari"></input>
          <a href="<?= base_url('admin/refreshLaporanPelanggan') ?>" class="refresh"><i class="fa fa-refresh"></i></a>
        </div>
      </form>
    </div>
  </div>
  <table class="table">
    <thead class="table-color">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Id Pelanggan</th>
        <th scope="col">Tanggal</th>
        <th scope="col">Nama Pelanggan</th>
        <th scope="col">Jumlah Pesanan</th>
        <th scope="col">Subtotal</th>
        <th scope="col">Nama Pelayan</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; ?>
      <?php foreach ($pelanggan as $p) : ?>
        <tr>
          <th scope="row"><?= $i++ ?></th>
          <td><?= $p['id_pelanggan'] ?></td>
          <td><?= $p['tanggal'] ?></td>
          <td><?= $p['nama_pelanggan'] ?></td>
          <td><?= $p['qty'] ?></td>
          <td>Rp<?= number_format($p['subtotal'], 0, ',', '.') ?></td>
          <td><?= $p['nama'] ?></td>
          <td><?= $p['status'] ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php if ($pelanggan == null) : ?>
    <div class="alert alert-danger">
      Tidak ada data!
    </div>
  <?php endif; ?>
</div>