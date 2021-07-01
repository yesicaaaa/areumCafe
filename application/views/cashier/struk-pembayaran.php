<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/struk.css') ?>">
  <link href="<?= base_url() ?>assets/img/sign.png" rel="shortcut icon">
  <title>Struk Pembayaran</title>
</head>

<body>
  <div class="container">
    <center>
      <h1>Terima Kasih</h1>
    </center>
    <h2>Struk Pembayaran</h2>
    <p>Nama Pelanggan : <?= $pelanggan['nama_pelanggan'] ?></p>
    <p>No. Telepon : <?= $pelanggan['phone'] ?></p>
    <p>No. Meja : <?= $pelanggan['no_meja'] ?></p>
    <p>Tanggal Pemesanan : <?= $pelanggan['tanggal'] ?></p>
    <h3><b>Daftar Pesanan</b></h3>
    <?php foreach ($pesanan as $p) : ?>
      <p><b><?= $p['qty'] ?></b>x <?= $p['nama'] ?> Rp<b><?= number_format($p['subtotal'], 0, ',', '.') ?></b></p>
    <?php endforeach; ?>
    <div class="row">
      <div class="col-md-3">
        <p><b><?= $total_pesanan['total_items'] ?></b> Item</p>
      </div>
      <div class="col-md-6">
        <p>Total : Rp<b><?= number_format($total_pesanan['total'], 0, ',', '.') ?></b></p>
        <p>Pajak : Rp<b><?= number_format($total_pesanan['tax'], 0, ',', '.') ?></b></p>
        <p>Subtotal : Rp<b><?= number_format($total_pesanan['subtotal'], 0, ',', '.') ?></b></p>
      </div>
    </div>
    <h3><b>Bayar Pesanan</b></h3>
    <p>Nama Kasir : <?= $transaksi['nama'] ?></p>
    <p>Tanggal Bayar : <?= $transaksi['tanggal_transaksi'] ?></p>
    <p>Total Harga : Rp<b><?= number_format($transaksi['total_harga'], 0, ',', '.') ?></b></p>
    <p>Total Bayar : Rp<b><?= number_format($transaksi['total_bayar'], 0, ',', '.') ?></b></p>
    <p>Kembalian : Rp<b><?= number_format($transaksi['kembalian'], 0, ',', '.') ?></b></p>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>

</html>