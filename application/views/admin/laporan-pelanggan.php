<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Laporan Pelanggan</li>
    </ol>
  </nav>
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
          <td><?= $p['subtotal'] ?></td>
          <td><?= $p['nama'] ?></td>
          <td><?= $p['status'] ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>