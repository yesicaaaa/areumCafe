<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Data Pegawai</li>
    </ol>
  </nav>
  <?= $this->session->flashdata('message'); ?>
  <div class="form-tambah">
    <h6>
      Tambah Pegawai
      <span>
        <button class="badge bg-success" id="pegawai-collapse" type="button" data-bs-toggle="collapse" data-bs-target="#tambahPegawaiCollapse" aria-expanded="false" aria-controls="tambahPegawaiCollapse">+</button>
      </span>
    </h6>
    <form action="<?= base_url('admin/pegawai') ?>" method="post" class="form-pegawai " id="tambahPegawaiCollapse">
      <div class="row" id="formAdd">
        <div class="col-md-5">
          <div class="mb-3 row">
            <label for="inputNama" class="col-sm-2 col-form-label">Nama Lengkap<span>*</span></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nama" id="inputNama" autocomplete="off" value="<?= set_value('nama') ?>">
              <?= form_error('nama', '<div class="invalid-feedback">', '</div>'); ?>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="inputEmail" class="col-sm-2 col-form-label">Email<span>*</span></label>
            <div class="col-sm-10">
              <input type="email" class="form-control" name="email" id="inputEmail" autocomplete="off" value="<?= set_value('email') ?>">
              <?= form_error('email', '<div class="invalid-feedback">', '</div>'); ?>
            </div>
          </div>
        </div>
        <div class="col-md-5 col-tambah2">
          <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Password<span>*</span></label>
            <div class="col-sm-10">
              <input type="password" class="form-control" name="password" id="inputPassword" required>
              <?= form_error('password', '<div class="invalid-feedback">', '</div>'); ?>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="inputConfirmPassword" class="col-sm-2 col-form-label">Konfirmasi Password<span>*</span></label>
            <div class="col-sm-10">
              <input type="password" class="form-control" name="confirm_password" id="inputConfirmPassword" required>
              <?= form_error('confirm_password', '<div class="invalid-feedback">', '</div>'); ?>
            </div>
          </div>
        </div>
      </div>
      <button type="submit" id="validasi" class="btn btn-primary" onclick="return confirm('Yakin ingin menambahkan data?')">Tambah</button>
    </form>
  </div>
  <table class="table">
    <thead class="table-color">
      <tr>
        <th scope="col"></th>
        <th scope="col">#</th>
        <th scope="col">Nama Lengkap</th>
        <th scope="col">Email</th>
        <th scope="col">Hak Akses</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <form action="<?= base_url() ?>admin/pegawai_delete" method="post">
        <?php $i = 1 ?>
        <?php foreach ($pegawai as $p) : ?>
          <tr>
            <td>
              <input type="checkbox" name="id[]" value="<?= $p['id_user'] ?>">
            </td>
            <th scope="row"><?= $i++ ?></th>
            <td><?= $p['nama'] ?></td>
            <td><?= $p['email'] ?></td>
            <td><?= $p['nama_akses'] ?></td>
            <td>
              <a href="javascript:getData(<?= $p['id_user'] ?>);" class="badge bg-success">Edit</a>
            </td>
          </tr>
        <?php endforeach; ?>
    </tbody>
  </table>
  <button type="submit" class="btn btn-danger my-2" onclick="return confirm('Yakin ingin menghapus?')"><i class="fa fa-fw fa-minus-circle"></i> Hapus</button>
  </form>

  <!-- modal edit pegawai -->
  <div class="modal" id="editPegawai" tabindex="-1">
    <div class="modal-dialog">
      <form action="<?= base_url() ?>admin/editPegawai" method="POST">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Data Pegawai</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="id_userEdit" name="id_user">
            <div class="form-group">
              <label for="namaEdit">Nama<span>*</span></label>
              <input type="text" class="form-control" id="namaEdit" name="nama">
              <?= form_error('nama', '<div class="invalid-feedback">', '</div>'); ?>
            </div>
            <div class="form-group">
              <label for="emailEdit">Email<span>*</span></label>
              <input type="email" class="form-control" id="emailEdit" name="email" disabled>
              <?= form_error('email', '<div class="invalid-feedback">', '</div>'); ?>
            </div>
            <label for="aksesEdit">Hak Akses<span>*</span></label>
            <select class="form-select" id="aksesEdit" name="hak_akses">
              <option value="">Pilih Hak Akses</option>
              <?php foreach ($hak_akses as $ha) : ?>
                <option value="<?= $ha['id_hak_akses'] ?>"><?= $ha['nama_akses'] ?></option>
              <?php endforeach; ?>
            </select>
            <?= form_error('hak_akses', '<div class="invalid-feedback">', '</div>'); ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary" onclick="return confirm('Yakin ingin mengubah data?')">Simpan</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  var base_url = '<?= base_url(); ?>';

  function getData(id_user) {
    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: base_url + 'admin/getPegawaiRow',
      data: {
        id_user: id_user
      },
      success: function(data) {
        $('#id_userEdit').val(data.id_user),
          $('#namaEdit').val(data.nama),
          $('#emailEdit').val(data.email),
          $('#aksesEdit').val(data.hak_akses),
          $('#editPegawai').modal('show')
      }
    });
  }
</script>