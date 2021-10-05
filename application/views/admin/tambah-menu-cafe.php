<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page"><a href="<?= base_url('admin/menuCafe') ?>">Menu Cafe</a></li>
      <li class="breadcrumb-item active" aria-current="page">Tambah</li>
    </ol>
  </nav>
  <div class="form-tambah" style="margin-top: -16px !important;">
    <h6>Tambah Menu</h6>
    <form enctype="multipart/form-data" id="form-add" method="post" class="form-pegawai">
      <div class="row" id="formAdd">
        <div class="col-md-5">
          <div class="mb-3 row form-group">
            <label for="nama" class="col-sm-2 col-form-label">Nama Menu<span>*</span></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nama" id="nama" required="">
            </div>
          </div>
          <div class="mb-3 row form-group">
            <label for="harga" class="col-sm-2 col-form-label">Harga<span>*</span></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="harga" id="harga" required="" onkeypress="return event.charCode >=48 && event.charCode <=58">
            </div>
          </div>
          <div class="mb-3 row form-group">
            <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi<span>*</span></label>
            <div class="col-sm-10">
              <textarea type="text" class="form-control" name="deskripsi" id="deskripsi" required=""></textarea>
            </div>
          </div>
        </div>
        <div class="col-md-5 col-tambah2">
          <div class="mb-3 row form-group">
            <label for="jenis" class="col-sm-2 col-form-label">Jenis Menu<span>*</span></label>
            <select class="form-select form-jenis" id="jenis" name="jenis" required="">
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
          <div class="mb-3 row form-group">
            <label for="stok" class="col-sm-2 col-form-label">Stok<span>*</span></label>
            <div class="col-sm-10">
              <input type="number" class="form-control" name="stok" id="stok" required="">
            </div>
          </div>
          <div class="mb-3 row form-group">
            <label for="foto" class="col-sm-2 col-form-label">Foto<span></span></label>
            <div class="col-sm-10">
              <input type="file" class="form-control" name="foto" id="foto" accept=".jpg,.jpeg,.png">
              <p><small class="text-danger">* Format file : jpg | jpeg | png</small></p>
            </div>
          </div>
        </div>
      </div>
      <div class="btn-tambah-menu">
        <button class="btn btn-success" id="btn_batal_input">Batal</button>
        <button type="button" class="btn btn-success" id="btn_simpan_menu"><i class="fa fa-fw fa-save"></i> Simpan</button>
      </div>
    </form>
  </div>
</div>