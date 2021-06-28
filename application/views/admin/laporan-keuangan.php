<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Laporan Keuangan</li>
    </ol>
  </nav>
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
</div>