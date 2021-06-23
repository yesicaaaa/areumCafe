<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item bc"><a href="javascript:void(0)">Pesanan</a></li>
    </ol>
</nav>
  <div class="alert-cus">
    <?= $this->session->flashdata('message'); ?>
  </div>
  <div class="row data-pesanan">
    <div class="col-md-2">
      <h6>Nama Pelanggan</h6>
      <h6>No. Meja</h6>
    </div>
    <div class="col-md-3">
      <h6>: <?= $this->session->userdata('nama_pelanggan'); ?></h6>
      <h6>: <?= $this->session->userdata('no_meja'); ?></h6>
    </div>
    <div class="col-md-2">
      <h6>Nama Pelayan</h6>
      <h6>Tanggal Pesanan</h6>
    </div>
    <div class="col-md-3">
      <h6>: <?= $waiter['nama']; ?></h6>
      <h6>: <?= $this->session->userdata('tanggal'); ?></h6>
    </div>
  </div>
  <?php if ($cart != null) : ?>
    <?php foreach ($cart as $c) : ?>
      <div class="row daftar-pesanan">
        <div class="col-md-3">
          <p class="menu"><?= $c['qty'] ?>x <?= $c['name'] ?></p>
        </div>
        <div class="col-md-6 titik">
          <?php for ($i = 0; $i <= 69; $i++) : ?>
            .
          <?php endfor; ?>
        </div>
        <div class="col-md-2">
          <p class="harga-cart"><?= number_format($c['price'], 0, ',', '.') ?></p>
        </div>
      </div>
    <?php endforeach; ?>
    <div class="divider-jumlah"></div>
    <div class="row">
      <div class="col-md-4 total-item">
        <p><span style="font-weight: bold;"><?= $this->cart->total_items(); ?></span> Items</p>
      </div>
      <div class="col-md-4 subtotal">
        <div class="row">
          <div class="col-md-4">
            <p>Total</p>
            <p>Pajak </p>
            <p>Subtotal</p>
          </div>
          <div class="col-md-6">
            <p style="font-weight: bold;">: Rp<?= number_format($this->cart->total(), 0, ',', '.') ?></p>
            <p style="font-weight: bold;">: Rp<?= number_format($this->cart->total() * 0.1, 0, ',', '.') ?></p>
            <p style="font-weight: bold;">: Rp<?= number_format($this->cart->total() + ($this->cart->total() * 0.1), 0, ',', '.') ?></p>
          </div>
        </div>
      </div>
    </div>
    <form action="<?= base_url() ?>waiter/add_pesanan" method="POST">
      <?php foreach ($cart as $c) : ?>
        <input type="hidden" name="id_pelanggan[]" value="<?= $this->session->userdata('id_pelanggan'); ?>">
        <input type="hidden" name="id_menu[]" value="<?= $c['id']; ?>">
        <input type="hidden" name="qty[]" value="<?= $c['qty']; ?>">
        <input type="hidden" name="rowid[]" value="<?= $c['rowid']; ?>">
        <input type="hidden" name="subtotal[]" value="<?= $c['price'] * $c['qty'] ?>">
        <input type="hidden" name="status[]" value="Dipesan">
      <?php endforeach; ?>
      <button type="submit" class="btn btn-success btn-pesanan" onclick="return confirm('Yakin ingin membuat pesanan?')">Buat Pesanan</button>
    <?php else : ?>
      <div class="alert alert-danger" role="alert">
        Tidak ada pesanan.
      </div>
    <?php endif; ?>
    </form>
</div>