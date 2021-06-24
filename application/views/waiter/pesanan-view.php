<div class="row">
  <div class="col-md-7">
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
          <?php $i = 1; ?>
          <?php foreach ($dataPesanan as $p) : ?>
            <tr>
              <th>
                <input type="checkbox" name="id[]" value="<?= $p['id_pelanggan'] ?>">
              </th>
              <th scope="row"><?= $i++ ?></th>
              <td><?= $p['tanggal'] ?></td>
              <td><?= $p['nama_pelanggan'] ?></td>
              <td><?= $p['phone'] ?></td>
              <td><?= $p['no_meja'] ?></td>
              <td><?= $p['nama'] ?></td>
              <td><?= $p['status'] ?></td>
              <td>
                <a href="<?= base_url('waiter/pesanan_view/') . $p['id_pelanggan'] ?>" class="badge bg-success">Lihat Pesanan</a>
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
  </div>
  <div class="col-md-4 view-pesanan">
    <?= $this->session->flashdata('message'); ?>
    <div class="mb-3">
      <label for="nama_pelanggan" class="form-label nama-pelanggan">Nama Pelanggan</label>
      <input type="text" class="form-control" value="<?= $pelanggan['nama_pelanggan'] ?>" readonly>
    </div>
    <div class="mb-3">
      <label for="phone" class="form-label">No. Telepon</label>
      <input type="text" class="form-control" value="<?= $pelanggan['phone'] ?>" readonly>
    </div>
    <div class="mb-3">
      <label for="no_meja" class="form-label">No. Meja</label>
      <input type="text" class="form-control" value="<?= $pelanggan['no_meja'] ?>" readonly>
    </div>
    <div class="mb-3">
      <label for="tanggal" class="form-label">Tanggal Pemesanan</label>
      <input type="date" class="form-control" value="<?= $pelanggan['tanggal'] ?>" readonly>
    </div>
    <h6>Daftar Pesanan</h6>
    <?php foreach ($pesanan as $p) : ?>
      <div class="row daftar-pesanan">
        <div class="col-md-9">
          <p><b><?= $p['qty'] ?></b>x <?= $p['nama'] ?></p>
        </div>
        <div class="col-md-3">
          <b><?= $p['subtotal'] ?></b>
        </div>
      </div>
    <?php endforeach; ?>
    <div class="divider-data-pesanan"></div>
    <div class="row">
      <div class="col-md-4">
        <p><b><?= $total_pesanan['total_items'] ?></b> Items</p>
      </div>
      <div class="col-md-8">
        <div class="row total-pesanan">
          <div class="col-md-3">
            <p>Total</p>
            <p>Pajak</p>
            <p>Subtotal</p>
          </div>
          <div class="col-md-9">
            <b>
              <p>: Rp<?= number_format($total_pesanan['total'], 0, ',', '.') ?></p>
              <p>: Rp<?= number_format($total_pesanan['tax'], 0, ',', '.') ?></p>
              <p>: Rp<?= number_format($total_pesanan['subtotal'], 0, ',', '.') ?></p>
            </b>
          </div>
        </div>
      </div>
    </div>
    <a href="<?= base_url('waiter/antarkan_pesanan/') . $pelanggan['id_pelanggan'] ?>" class="btn btn-success btn-antar" onclick="return confirm('Yakin ingin mengantarkan pesanan?')">Antarkan Pesanan</a>
  </div>
</div>