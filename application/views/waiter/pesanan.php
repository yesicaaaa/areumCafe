<div class="row">
  <div class="col-md-7">
    <form action="<?= base_url() ?>waiter/delete_pesanan" method="POST">
      <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus pesanan?')"><i class="fa fa-fw fa-minus-circle"></i> Hapus Pesanan</button>
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
          <?php foreach ($pesanan as $p) : ?>
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
    <?php if ($pesanan == null) : ?>
      <div class="alert alert-danger" role="alert">
        Tidak ada pesanan!
      </div>
    <?php endif; ?>
  </div>
  <div class="col-md-4 form-pemesanan">
    <?= $this->session->flashdata('message'); ?>
    <h6>Tulis Pesanan</h6>
    <form action="<?= base_url() ?>waiter/pesanan" method="POST">
      <input type="hidden" name="id_pelanggan">
      <div class="mb-3">
        <label for="nama_pelanggan" class="form-label">Nama Pelanggan<span>*</span></label>
        <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="<?= set_value('nama_pelanggan') ?>" required autocomplete="off">
        <?= form_error('nama_pelanggan', '<div class="invalid-feedback">', '</div>'); ?>
      </div>
      <div class="mb-3">
        <label for="phone" class="form-label">No. Telepon<span>*</span></label>
        <input type="text" class="form-control" id="phone" name="phone" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?= set_value('phone') ?>" required autocomplete="off">
        <?= form_error('phone', '<div class="invalid-feedback">', '</div>'); ?>
      </div>
      <div class="mb-3">
        <label for="no_meja" class="form-label">No. Meja<span>*</span></label>
        <input type="text" class="form-control" id="no_meja" name="no_meja" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="<?= set_value('no_meja') ?>" required autocomplete="off">
        <?= form_error('no_meja', '<div class="invalid-feedback">', '</div>'); ?>
      </div>
      <div class="mb-3">
        <label for="tanggal" class="form-label">Tanggal Pemesanan<span>*</span></label>
        <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= set_value('tanggal') ?>" required autocomplete="off">
        <?= form_error('tanggal', '<div class="invalid-feedback">', '</div>'); ?>
      </div>
      <input type="hidden" name="id_waiter" value="<?= $this->session->userdata('id_user'); ?>">
      <button type="submit" class="btn btn-success" onclick="return confirm('Yakin ingin melanjutkan pemesanan?')">Selanjutnya</button>
    </form>
  </div>
</div>