<div class="row">
  <div class="col-md-7">
    <table class="table">
      <thead class="table-brown">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Tanggal</th>
          <th scope="col">Nama Pelanggan</th>
          <th scope="col">No. Telepon</th>
          <th scope="col">No. Meja</th>
          <th scope="col">Nama Pelayan</th>
          <th scope="col">Status</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1 ?>
        <?php foreach ($dataPelanggan as $dp) : ?>
          <tr>
            <th scope="row"><?= $i++ ?></th>
            <td><?= $dp['tanggal'] ?></td>
            <td><?= $dp['nama_pelanggan'] ?></td>
            <td><?= $dp['phone'] ?></td>
            <td><?= $dp['no_meja'] ?></td>
            <td><?= $dp['nama'] ?></td>
            <td><?= $dp['status'] ?></td>
            <td>
              <a href="<?= base_url('cashier/history_transaksi_view/') . $dp['id_pelanggan'] ?>" class="badge bg-success">Lihat</a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <?php if ($dataPelanggan == null) : ?>
        <div class="alert alert-danger">
          Tidak ada history transaksi
        </div>
      <?php endif; ?>
  </div>
</div>