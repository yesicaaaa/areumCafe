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
  <?php if ($this->session->flashdata('msg_error')) : ?>
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
      <?= $this->session->flashdata('msg_error'); ?>
    </div>
  <?php endif; ?>
  <table class="table pegawai">
    <thead class="table-color">
      <tr>
        <th scope="col">
          <input type="checkbox" id="checkall">
        </th>
        <th scope="col">Nama Lengkap</th>
        <th scope="col">Email</th>
        <th scope="col">Hak Akses</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($pegawai as $p) : ?>
        <tr>
          <td class="idUser">
            <input type="checkbox" class="id-checkbox checkpart" name="id" data-iduser="<?= $p['id_user'] ?>">
          </td>
          <td><?= $p['nama'] ?></td>
          <td><?= $p['email'] ?></td>
          <td><?= $p['nama_akses'] ?></td>
          <td>
            <a href="<?= base_url() . "admin/detailPegawai?id_user=" . $p['id_user'] ?>" class="badge bg-success bg-edit-pegawai">Detail</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

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