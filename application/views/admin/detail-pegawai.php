<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url('admin/pegawai') ?>">Data Pegawai</a></li>
      <li class="breadcrumb-item active" aria-current="page">Detail Pegawai</li>
    </ol>
  </nav>
  <div class="row detail-pegawai3">
    <div class="col-md-6">
      <table>
        <tr>
          <td>Nama</td>
          <td class="detail-pegawai2">:</td>
          <th><?= $pegawai['nama'] ?></th>
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
          <td>Deskripsi</td>
          <td class="detail-pegawai2">:</td>
          <th><?= $pegawai['deskripsi'] ?></th>
        </tr>
      </table>
    </div>
  </div>
</div>