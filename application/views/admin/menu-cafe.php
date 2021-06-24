<div class="main">
  <?= $this->session->flashdata('message'); ?>
  <div class="form-tambah">
    <h6>
      Tambah Menu
      <span>
        <button class="badge bg-success" id="pegawai-collapse" type="button" data-bs-toggle="collapse" data-bs-target="#tambahMenuCollapse" aria-expanded="false" aria-controls="tambahMenuCollapse">+</button>
      </span>
    </h6>
    <form action="<?= base_url('admin/menuCafe') ?>" method="post" class="form-pegawai " id="tambahMenuCollapse" enctype="multipart/form-data">
      <div class="row" id="formAdd">
        <div class="col-md-5">
          <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Nama Menu<span>*</span></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nama" id="nama" autocomplete="off" value="<?= set_value('nama') ?>">
              <?= form_error('nama', '<div class="invalid-feedback">', '</div>'); ?>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="harga" class="col-sm-2 col-form-label">Harga<span>*</span></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="harga" id="harga" autocomplete="off" value="<?= set_value('harga') ?>" onkeypress="return event.charCode >=48 && event.charCode <=58">
              <?= form_error('harga', '<div class="invalid-feedback">', '</div>'); ?>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi<span>*</span></label>
            <div class="col-sm-10">
              <textarea type="text" class="form-control" name="deskripsi" id="deskripsi" autocomplete="off"></textarea>
              <?= form_error('deskripsi', '<div class="invalid-feedback">', '</div>'); ?>
            </div>
          </div>
        </div>
        <div class="col-md-5 col-tambah2">
          <div class="mb-3 row">
            <label for="foto" class="col-sm-2 col-form-label">Foto<span>*</span></label>
            <div class="col-sm-10">
              <input type="file" class="form-control" name="foto" id="foto" autocomplete="off" value="<?= set_value('foto') ?>">
              <?= form_error('foto', '<div class="invalid-feedback">', '</div>'); ?>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="jenis" class="col-sm-2 col-form-label">Jenis Menu<span>*</span></label>
            <select class="form-select form-jenis" id="jenis" name="jenis">
              <option value="">Pilih Jenis Menu</option>
              <option value="kopi">kopi</option>
              <option value="teh">teh</option>
              <option value="jus">jus</option>
              <option value="susu">susu</option>
              <option value="soda">soda</option>
              <option value="nasi">nasi</option>
              <option value="mie">mie</option>
              <option value="pastry">pastry</option>
              <option value="cake">cake</option>
              <option value="dessert">dessert</option>
            </select>
          </div>
          <div class="mb-3 row">
            <label for="stok" class="col-sm-2 col-form-label">Stok<span>*</span></label>
            <div class="col-sm-10">
              <input type="number" class="form-control" name="stok" id="stok" autocomplete="off" value="<?= set_value('stok') ?>">
              <?= form_error('stok', '<div class="invalid-feedback">', '</div>'); ?>
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
        <th scope="col">Nama Menu</th>
        <th scope="col">Harga</th>
        <th scope="col" width="30%">Deskripsi</th>
        <th scope="col" width="10%">Foto</th>
        <th scope="col">Jenis</th>
        <th scope="col">Stok</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <form action="<?= base_url() ?>admin/menu_delete" method="post">
        <?php $i = 1 ?>
        <?php foreach ($menu as $m) : ?>
          <tr>
            <td>
              <input type="checkbox" name="id[]" value="<?= $m['id_menu'] ?>">
            </td>
            <th scope="row"><?= $i++ ?></th>
            <td><?= $m['nama'] ?></td>
            <td><?= $m['harga'] ?></td>
            <td><?= $m['deskripsi'] ?></td>
            <td>
              <img src="<?= base_url('assets/img/menu/') . $m['foto'] ?>" alt="menu" width="90%">
            </td>
            <td><?= $m['jenis'] ?></td>
            <td><?= $m['stok'] ?></td>
            <td>
              <a href="javascript:getData(<?= $m['id_menu'] ?>);" class="badge bg-success">Edit</a>
            </td>
          </tr>
        <?php endforeach; ?>
    </tbody>
  </table>
  <?php if ($menu == null) : ?>
    <div class="alert alert-danger" role="alert">
      Tidak ada data!
    </div>
  <?php endif; ?>
  <button type="submit" class="btn btn-danger my-2" onclick="return confirm('Yakin ingin menghapus?')"><i class="fa fa-fw fa-minus-circle"></i> Hapus</button>
  </form>

  <!-- modal edit pegawai -->
  <div class="modal" id="editMenu" tabindex="-1">
    <div class="modal-dialog">
      <form action="<?= base_url() ?>admin/editMenu" method="POST" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Data Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="id_menuEdit" name="id_menu">
            <div class="form-group">
              <label for="namaEdit">Nama Menu<span>*</span></label>
              <input type="text" class="form-control" id="namaEdit" name="nama">
              <?= form_error('nama', '<div class="invalid-feedback">', '</div>'); ?>
            </div>
            <div class="form-group">
              <label for="hargaEdit">Harga Menu<span>*</span></label>
              <input type="text" class="form-control" id="hargaEdit" name="harga" onkeypress="return event.charCode >= 48 && event.charCode <= 58">
              <?= form_error('harga', '<div class="invalid-feedback">', '</div>'); ?>
            </div>
            <div class="form-group">
              <label for="deskripsiEdit">Deskripsi<span>*</span></label>
              <textarea type="text" class="form-control" id="deskripsiEdit" name="deskripsi"></textarea>
              <?= form_error('deskripsi', '<div class="invalid-feedback">', '</div>'); ?>
            </div>
            <div class="form-group">
              <label for="fotoEdit">Foto<span>*</span></label>
              <input type="file" class="form-control" id="fotoEdit" name="foto">
              <?= form_error('foto', '<div class="invalid-feedback">', '</div>'); ?>
            </div>
            <div class="form-group">
              <label for="jenisEdit">Jenis Menu<span>*</span></label>
              <input type="text" class="form-control" id="jenisEdit" name="jenis">
              <?= form_error('jenis', '<div class="invalid-feedback">', '</div>'); ?>
            </div>
            <div class="form-group">
              <label for="stokEdit">Stok<span>*</span></label>
              <input type="text" class="form-control" id="stokEdit" name="stok">
              <?= form_error('stok', '<div class="invalid-feedback">', '</div>'); ?>
            </div>
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

  function getData(id_menu) {
    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: base_url + 'admin/getMenuRow',
      data: {
        id_menu: id_menu
      },
      success: function(data) {
        $('#id_menuEdit').val(data.id_menu),
          $('#namaEdit').val(data.nama),
          $('#hargaEdit').val(data.harga),
          $('#deskripsiEdit').val(data.deskripsi),
          // $('#fotoEdit').val(data.foto),
          $('#jenisEdit').val(data.jenis),
          $('#stokEdit').val(data.stok),
          $('#editMenu').modal('show')
      }
    });
  }
</script>