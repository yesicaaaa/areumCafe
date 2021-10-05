<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Menu Cafe</li>
    </ol>
  </nav>
  <div class="row btn-group-pegawai">
    <div class="col-md-2">
      <button type="button" class="btn btn-danger delete-menu"><i class="fa fa-fw fa-minus-circle"></i> Hapus</button>
    </div>
    <div class="col-md-2">
      <button type="button" class="btn btn-edit tambah-menu"><i class="fa fa-fw fa-plus"></i> Tambah</button>
    </div>
    <div class="col-md-2">
      <button type="button" class="btn btn-edit edit-menu"><i class="fa fa-fw fa-edit"></i> Edit</button>
    </div>
    <div class="col-md-2">
      <a href="<?= base_url('admin/printExcelMenuCafe/') . $this->session->userdata('keyword'); ?>" class="btn btn-success btn-excel" onclick="return confirm('Yakin ingin mengexport data ini?')"><i class="fa fa-fw fa-download"></i> Export Excel</a>
    </div>
    <div class="col-md-2">
      <a href="<?= base_url('admin/printPdfMenuCafe/') . $this->session->userdata('keyword'); ?>" class="btn btn-danger btn-pdf" onclick="return confirm('Yakin ingin mengexport data ini?')"><i class="fa fa-fw fa-download"></i> Export PDF</a>
    </div>
  </div>
  <table class="table table-menu-cafe">
    <thead class="table-color">
      <tr>
        <th scope="col">
          <input type="checkbox" id="checkall">
        </th>
        <th scope="col">Nama Menu</th>
        <th scope="col">Harga</th>
        <th scope="col" width="30%">Deskripsi</th>
        <th scope="col" width="10%">Foto</th>
        <th scope="col">Jenis</th>
        <th scope="col">Stok</th>
      </tr>
    </thead>
    <tbody>
      <form action="<?= base_url() ?>admin/menu_delete" method="post">
        <?php foreach ($menu as $m) : ?>
          <tr>
            <td>
              <input type="checkbox" name="id[]" class="checkbox-menucafe" value="<?= $m['id_menu'] ?>">
            </td>
            <td><?= $m['nama'] ?></td>
            <td><?= $m['harga'] ?></td>
            <td><?= $m['deskripsi'] ?></td>
            <td>
              <img src="<?= base_url('assets/img/menu/') . $m['foto'] ?>" alt="menu" width="90%">
            </td>
            <td><?= $m['jenis'] ?></td>
            <td><?= $m['stok'] ?></td>
          </tr>
        <?php endforeach; ?>
    </tbody>
  </table>
  </form>

  <script>
    var base_url = '<?= base_url(); ?>';
  </script>