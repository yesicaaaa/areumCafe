<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Laporan Keuangan</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-2">
      <a href="<?= base_url('admin/printExcelLaporanKeuangan/') . $this->session->userdata('keyword'); ?>" class="btn btn-success btn-excel" onclick="return confirm('Yakin ingin mengexport data ini?')"><i class="fa fa-fw fa-download"></i> Export Excel</a>
    </div>
    <div class="col-md-2">
      <a href="<?= base_url('admin/printPdfLaporanKeuangan/') . $this->session->userdata('keyword'); ?>" class="btn btn-danger btn-pdf" onclick="return confirm('Yakin ingin mengexport data ini?')"><i class="fa fa-fw fa-download"></i> Export PDF</a>
    </div>
    <div class="col-md-6">
      <form action="<?= base_url('admin/laporanKeuangan') ?>" method="POST">
        <div class="input-group mb-3 input-cari">
          <input type="text" class="form-control" placeholder="Cari...." name="keyword" autocomplete="off">
          <input class="btn btn-cari" type="submit" name="cari"></input>
          <a href="<?= base_url('admin/refreshLaporanKeuangan') ?>" class="refresh"><i class="fa fa-refresh"></i></a>
        </div>
      </form>
    </div>
  </div>
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
      <?php foreach ($keuangan as $k) : ?>
        <tr>
          <th scope="row"><?= ++$start ?></th>
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
  <p class="total-rows">Total Data : <?= $total_rows ?></p>
  <div class="pagination">
    <?= $this->pagination->create_links(); ?>
  </div>
</div>