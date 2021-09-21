<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Data Pegawai</li>
    </ol>
  </nav>
  <div class="row btn-group-pegawai">
    <div class="col-md-2">
      <button type="button" class="btn btn-danger delete-pegawai"><i class="fa fa-fw fa-minus-circle"></i> Hapus</button>
    </div>
    <div class="col-md-2">
      <button type="button" class="btn btn-edit edit-pegawai"><i class="fa fa-fw fa-edit"></i> Edit</button>
    </div>
    <div class="col-md-2">
      <a href="<?= base_url('admin/printExcelPegawai/') . $this->session->userdata('keyword'); ?>" class="btn btn-success btn-excel" onclick="return confirm('Yakin ingin mengexport data ini?')"><i class="fa fa-fw fa-download"></i> Export Excel</a>
    </div>
    <div class="col-md-2">
      <a href="<?= base_url('admin/printPdfPegawai/') . $this->session->userdata('keyword'); ?>" class="btn btn-danger btn-pdf" onclick="return confirm('Yakin ingin mengexport data ini?')"><i class="fa fa-fw fa-download"></i> Export PDF</a>
    </div>
  </div>
  <?= $this->session->flashdata('message'); ?>
  <table class="table pegawai">
    <thead class="table-color">
      <tr>
        <th scope="col">
          <input type="checkbox" id="checkall">
        </th>
        <th scope="col">#</th>
        <th scope="col">Nama Lengkap</th>
        <th scope="col">Email</th>
        <th scope="col">Hak Akses</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($pegawai as $p) : ?>
        <tr>
          <td class="idUser">
            <input type="checkbox" class="id-checkbox checkpart" name="id" data-idUser="<?= $p['id_user'] ?>">
          </td>
          <th scope="row"><?= ++$start ?></th>
          <td><?= $p['nama'] ?></td>
          <td><?= $p['email'] ?></td>
          <td><?= $p['nama_akses'] ?></td>
          <td>
            <a href="javascript:getData(<?= $p['id_user'] ?>);" class="badge bg-success bg-edit-pegawai">Edit</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <p class="total-rows">Total Data : <?= $total_rows ?></p>
  <div class="pagination">
    <?= $this->pagination->create_links(); ?>
  </div>

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

<div class="modal" id="modalDeletePegawai" tabindex="-1">
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
        <button type="button" class="btn btn-hapus-pegawai">Hapus</button>
      </div>
    </div>
  </div>
</div>

<script>
  var base_url = '<?= base_url(); ?>';
</script>