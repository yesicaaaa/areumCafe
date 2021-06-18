<div class="main">
  <div class="form-tambah">
    <h6>Tambah Pegawai</h6>
    <form action="" method="post" class="form-pegawai">
      <div class="row">
        <div class="col-md-5">
          <div class="mb-3 row">
            <label for="inputNama" class="col-sm-2 col-form-label">Nama Lengkap<span>*</span></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nama" id="inputNama">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="inputEmail" class="col-sm-2 col-form-label">Email<span>*</span></label>
            <div class="col-sm-10">
              <input type="email" class="form-control" name="email" id="inputEmail">
            </div>
          </div>
        </div>
        <div class="col-md-5">
          <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Password<span>*</span></label>
            <div class="col-sm-10">
              <input type="password" class="form-control" name="password" id="inputPassword">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="inputConfirmPassword" class="col-sm-2 col-form-label">Password Lengkap<span>*</span></label>
            <div class="col-sm-10">
              <input type="password" class="form-control" name="confirm_password" id="inputConfirmPassword">
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
  <table class="table">
    <thead class="table-color">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nama Lengkap</th>
        <th scope="col">Email</th>
        <th scope="col">Hak Akses</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1 ?>
      <?php foreach ($pegawai as $p) : ?>
        <tr>
          <th scope="row"><?= $i++ ?></th>
          <td><?= $p['nama'] ?></td>
          <td><?= $p['email'] ?></td>
          <td><?= $p['nama_akses'] ?></td>
          <td>
            <a href="" class="badge bg-success">Edit</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>