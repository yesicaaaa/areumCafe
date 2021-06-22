<div class="row">
  <div class="col-md-8">
    <button class="btn btn-danger"><i class="fa fa-fw fa-minus-circle"></i> Hapus Pesanan</button>
    <table class="table">
      <thead class="table-orange">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Tanggal</th>
          <th scope="col">Nama Pelanggan</th>
          <th scope="col">No. Telepon</th>
          <th scope="col">No. Meja</th>
          <th scope="col">Nama Pelayan</th>
          <th scope="col">Status</th>
          <th scope="col">Pesanan</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 0; ?>
        <?php foreach ($pesanan as $p) : ?>
          <tr>
            <th>
              <input type="checkbox" name="id[]" value="<?= $p['id_pesanan'] ?>">
            </th>
            <th scope="row"><?= $i++ ?></th>
            <td><?= $p['tanggal'] ?></td>
            <td><?= $p['nama_pelanggan'] ?></td>
            <td><?= $p['phone'] ?></td>
            <td><?= $p['no_meja'] ?></td>
            <td><?= $p['nama'] ?></td>
            <td><?= $p['status'] ?></td>
            <td>
              <a href="" class="badge bg-success">Lihat Pesanan</a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <?php if ($pesanan == null) : ?>
        <div class="alert alert-danger" role="alert">
          Tidak ada data!
        </div>
      <?php endif; ?>
  </div>
</div>