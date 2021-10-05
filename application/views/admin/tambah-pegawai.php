<div class="main">
  <div class="form-tambah-pegawai">
    <h6>Tambah Pegawai</h6>
    <form id="form-add" class="form-pegawai">
      <div class="row" id="formAdd">
        <div class="col-md-5">
          <div class="mb-3 row form-group">
            <label for="inputNama" class="col-sm-3 col-form-label">Nama Lengkap <span>*</span></label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="nama" id="inputNama" required="">
            </div>
          </div>
          <div class="mb-3 row form-group">
            <label for="inputEmail" class="col-sm-3 col-form-label">Email <span>*</span></label>
            <div class="col-sm-9">
              <input type="email" class="form-control" name="email" id="inputEmail" required="">
            </div>
          </div>
          <div class="mb-3 row form-group">
            <label for="inputRole" class="col-sm-3 col-form-label">Hak Akses <span>*</span></label>
            <div class="col-sm-9">
              <select class="form-select input-role" id="inputRole" name="hak_akses" required="">
                <option value="">--Hak Akses--</option>
                <option value="2">Cashier</option>
                <option value="3">Waiter</option>
              </select>
            </div>
          </div>
        </div>
        <div class="col-md-5 col-tambah2">
          <div class="mb-3 row form-group">
            <label for="inputDeskripsi" class="col-sm-3 col-form-label">Deskripsi <span>*</span></label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="deskripsi_user" id="inputDeskripsiUser" required="" placeholder="Cont. Anak ke-?">
            </div>
          </div>
          <div class="mb-3 row form-group">
            <label for="inputPassword" class="col-sm-3 col-form-label">Password <span>*</span></label>
            <div class="col-sm-9">
              <input type="password" class="form-control" name="password" id="inputPassword" required="">
            </div>
          </div>
          <div class="mb-3 row form-group">
            <label for="inputConfirmPassword" class="col-sm-3 col-form-label">Konfirmasi Password <span>*</span></label>
            <div class="col-sm-9">
              <input type="password" class="form-control" name="confirm_password" id="inputConfirmPassword" required="">
            </div>
          </div>
        </div>
      </div>
  </div>
  <h6 class="info-detail">&nbsp Informasi Detail</h6>
  <div class="row detail-pegawai">
    <div class="col-md-6">
      <p>Nama Saudara Kandung</p>
    </div>
    <div class="col-md-6">
      <p>Deskripsi</p>
    </div>
  </div>
  <div class="row after-add-more control-group">
    <div class="col-md-6">
      <input type="text" name="nama_saudara[]" class="nama-saudara">
    </div>
    <div class="col-md-6">
      <input type="text" name="deskripsi[]" class="deskripsi" placeholder="cont. Anak ke-?">
    </div>
  </div>
  <div class="copy-inputan invisible">
    <div class="row copy control-group">
      <div class="col-md-6">
        <input type="text" name="nama_saudara[]" class="nama-saudara">
      </div>
      <div class="col-md-6">
        <input type="text" name="deskripsi[]" class="deskripsi" placeholder="cont. Anak ke-?">
      </div>
      <button type="button" class="btn btn-danger remove">Hapus</button>
    </div>
  </div>
  <button type="button" class="btn btn-success btn-tambah-inputan add-more"><i class="fa fa-fw fa-plus"></i> Tambah Inputan</button>
  <div class="button-simpan-pegawai">
    <button type="button" class="btn btn-success" id="btn_batal_input">Batal</button>
    <button type="button" class="btn btn-success" id="btn_simpan_pegawai"><i class="fa fa-fw fa-save"></i> Simpan</button>
  </div>
  </form>
</div>