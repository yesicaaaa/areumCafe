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
        <?php if ($dataPelanggan == null) : ?>
          <div class="alert alert-danger">
            Tidak ada data!
          </div>
        <?php endif; ?>
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
              <a href="<?= base_url('cashier/proses_transaksi/') . $dp['id_pelanggan'] ?>" class="badge bg-danger">Bayar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
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
    <h6>Bayar Pesanan</h6>
    <form action="<?= base_url('cashier/bayar_transaksi/') . $pelanggan['id_pelanggan'] ?>" method="POST">
      <input type="hidden" name="id_transaksi">
      <input type="hidden" name="id_pegawai" value="<?= $this->session->userdata('id_user'); ?>">
      <input type="hidden" name="id_pelanggan" value="<?= $pelanggan['id_pelanggan'] ?>">
      <input type="hidden" name="total_harga" value="<?= $total_pesanan['subtotal'] ?>">
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="total_harga" value="Rp<?= number_format($total_pesanan['subtotal'], 0, ',', '.') ?>" readonly>
        <label for="total_harga">Total Harga</label>
      </div>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="total_bayar" name="total_bayar" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Total Bayar" value="<?= set_value('total_bayar') ?>" autocomplete="off">
        <?= form_error('total_bayar', '<div class="invalid-feedback">', '</div>'); ?>
        <label for="total_bayar">Total Bayar</label>
      </div>
      <button type="submit" class="btn btn-success" onclick="return confirm('Yakin ingin membayar?')">Bayarkan</button>
    </form>
  </div>
</div>