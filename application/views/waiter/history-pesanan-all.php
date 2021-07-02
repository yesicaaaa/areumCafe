<div class="row">
  <div class="col-md-7">
    <form action="<?= base_url('waiter/history_pesanan_all') ?>" method="POST">
      <div class="input-group mb-3 input-cari">
        <input type="text" class="form-control" placeholder="Cari...." name="keyword" autocomplete="off">
        <input class="btn btn-cari" type="submit" name="cari"></input>
        <a href="<?= base_url('waiter/refreshHistoryPesananAll') ?>" class="refresh"><i class="fa fa-refresh"></i></a>
      </div>
    </form>
    <form action="<?= base_url() ?>waiter/delete_pesanan" method="POST">
      <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus pesanan?')"><i class="fa fa-fw fa-minus-circle"></i> Hapus Pesanan</button>
      <span><a href="<?= base_url() ?>waiter/pesanan" class="btn btn-success btn-tambah-pesanan"><i class="fa fa-fw fa-plus-circle"></i>Tambah Pesanan</a></span>
      <table class="table">
        <thead class="table-orange">
          <tr>
            <th scope="col"></th>
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
          <?php foreach ($dataPesanan as $p) : ?>
            <tr>
              <th>
                <input type="checkbox" name="id[]" value="<?= $p['id_pelanggan'] ?>">
              </th>
              <th scope="row"><?= ++$start ?></th>
              <td><?= $p['tanggal'] ?></td>
              <td><?= $p['nama_pelanggan'] ?></td>
              <td><?= $p['phone'] ?></td>
              <td><?= $p['no_meja'] ?></td>
              <td><?= $p['nama'] ?></td>
              <td><?= $p['status'] ?></td>
              <td>
                <a href="<?= base_url('waiter/history_pesanan/') . $p['id_pelanggan'] ?>" class="badge bg-success">Lihat Pesanan</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </form>
    <?php if ($dataPesanan == null) : ?>
      <div class="alert alert-danger" role="alert">
        Tidak ada data!
      </div>
    <?php endif; ?>
    <p class="total-rows">Total Data : <?= $total_rows ?></p>
    <div class="pagination">
      <?= $this->pagination->create_links(); ?>
    </div>
  </div>
</div>