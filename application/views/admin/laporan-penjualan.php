<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Laporan Penjualan</li>
    </ol>
  </nav>
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