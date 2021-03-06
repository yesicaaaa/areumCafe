<div class="row">
  <div class="col-md-7">
    <form action="<?= base_url('cashier/history_transaksi') ?>" method="POST">
      <div class="input-group mb-3 input-cari">
        <input type="text" class="form-control" placeholder="Cari...." name="keyword" autocomplete="off">
        <input class="btn btn-cari" type="submit" name="cari"></input>
        <a href="<?= base_url('cashier/refreshHistoryTransaksi') ?>" class="refresh"><i class="fa fa-refresh"></i></a>
      </div>
    </form>
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
        <?php if ($dataPelanggan == null) : ?>
          <div class="alert alert-danger">
            Tidak ada data!
          </div>
        <?php endif; ?>
        <?php foreach ($dataPelanggan as $dp) : ?>
          <tr>
            <th scope="row"><?= ++$start ?></th>
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
    <p class="total-rows">Total Data : <?= $total_rows ?></p>
    <div class="pagination">
      <?= $this->pagination->create_links(); ?>
    </div>
  </div>
  <div class="col-md-4 proses-transaksi">
    <?= $this->session->flashdata('message'); ?>
    <div class="row">
      <div class="col-md-6">
        <div class="mb-3">
          <label for="nama_pelanggan" class="form-label nama-pelanggan">Nama Pelanggan</label>
          <input type="text" class="form-control" value="<?= $pelanggan['nama_pelanggan'] ?>" readonly>
        </div>
        <div class="mb-3">
          <label for="phone" class="form-label">No. Telepon</label>
          <input type="text" class="form-control" value="<?= $pelanggan['phone'] ?>" readonly>
        </div>
      </div>
      <div class="col-md-6">
        <div class="mb-3">
          <label for="no_meja" class="form-label no-meja">No. Meja</label>
          <input type="text" class="form-control" value="<?= $pelanggan['no_meja'] ?>" readonly>
        </div>
        <div class="mb-3">
          <label for="tanggal" class="form-label">Tanggal Pemesanan</label>
          <input type="date" class="form-control" value="<?= $pelanggan['tanggal'] ?>" readonly>
        </div>
      </div>
    </div>
    <h6>Daftar Pesanan</h6>
    <?php foreach ($pesanan as $p) : ?>
      <div class="row daftar-pesanan">
        <div class="col-md-9">
          <p><b><?= $p['qty'] ?></b>x <?= $p['nama'] ?></p>
        </div>
        <div class="col-md-3">
          <b><?= number_format($p['subtotal'], 0, ',', '.') ?></b>
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
    <h6>Bayar Pesanan</h6>
    <p class="kasir">Kasir : <?= $transaksi['nama'] ?></p>
    <p class="tgl-bayar">Tanggal Bayar : <?= $transaksi['tanggal_transaksi'] ?></p>
    <div class="form-floating mb-3">
      <input type="text" class="form-control" id="total_harga" value="Rp<?= number_format($transaksi['total_harga'], 0, ',', '.') ?>" readonly>
      <label for="total_harga">Total Harga</label>
    </div>
    <div class="form-floating mb-3">
      <input type="text" class="form-control" id="total_bayar" value="Rp<?= number_format($transaksi['total_bayar'], 0, ',', '.') ?>" readonly>
      <label for="total_bayar">Total Bayar</label>
    </div>
    <div class="form-floating mb-3">
      <input type="text" class="form-control" id="total_bayar" value="Rp<?= number_format($transaksi['kembalian'], 0, ',', '.') ?>" readonly>
      <label for="total_bayar">Total kembalian</label>
    </div>
    <a href="<?= base_url('cashier/strukPembelian/') . $pelanggan['id_pelanggan'] ?>" class="btn btn-success btn-struk" onclick="return confirm('Yakin ingin mengunduh struk pembayaran?')"><i class="fa fa-fw fa-download"></i>Struk Pembayaran</a>
  </div>
</div>