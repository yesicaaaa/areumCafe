<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url('admin/pegawai') ?>">Data Pegawai</a></li>
      <li class="breadcrumb-item active" aria-current="page">Detail Pegawai</li>
    </ol>
  </nav>
  <div class="row detail-pegawai3">
    <input type="hidden" id="idPegawai" value="<?= $pegawai['id_user'] ?>">
    <div class="col-md-6">
      <table>
        <tr>
          <td>Nama</td>
          <td class="detail-pegawai2">:</td>
          <th><?= $pegawai['nama'] ?></th>
        </tr>
        <tr>
          <td>&nbsp</td>
        </tr>
        <tr>
          <td>Email</td>
          <td class="detail-pegawai2">:</td>
          <th><?= $pegawai['email'] ?></th>
        </tr>
      </table>
    </div>
    <div class="col-md-6">
      <table>
        <tr>
          <td>Hak Akses</td>
          <td class="detail-pegawai2">:</td>
          <th><?= $pegawai['nama_akses'] ?></th>
        </tr>
        <tr>
          <td>&nbsp</td>
        </tr>
        <tr>
          <td>Deskripsi</td>
          <td class="detail-pegawai2">:</td>
          <th><?= $pegawai['deskripsi'] ?></th>
        </tr>
      </table>
    </div>
  </div>
  <h6 class="info-detail">&nbsp Informasi Detail</h6>
  <div class="col-md-2">
    <button type="button" class="btn btn-danger delete-detail-pegawai"><i class="fa fa-fw fa-minus-circle"></i> Hapus</button>
  </div>
  <div class="row detail-pegawai">
    <div class="col-md-1">
      <input type="checkbox" id="checkall">
    </div>
    <div class="col-md-6">
      <p>Nama Saudara Kandung</p>
    </div>
    <div class="col-md-5">
      <p>Deskripsi</p>
    </div>
  </div>
  <?php foreach ($detailPegawai as $dp) : ?>
    <div class="row after-add-more control-group saudara-pegawai">
      <div class="col-md-1">
        <input type="checkbox" class="id-checkbox checkpart checkbox-detail-pegawai" name="id" data-iduser="<?= $dp['id'] ?>">
      </div>
      <div class="col-md-6">
        <input value="<?= $dp['nama_saudara'] ?>" disabled>
      </div>
      <div class="col-md-5">
        <input value="<?= $dp['deskripsi'] ?>" disabled>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<div class="modal" id="modalDeleteDetailPegawai" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Konfirmasi Hapus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Apakah kamu yakin ingin menghapus data pegawai?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-batal-hapus" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-hapus-detail-pegawai btn-hapus-pegawai">Hapus</button>
      </div>
    </div>
  </div>
</div>