<div class="container-signup">
  <h1>Areum <span>Cafe</span></h1>
  <form action="<?= base_url() ?>main/signUp" method="post" class="form-signin">
    <div class="input-group mb-3">
      <span class="input-group-text"><i class="fa fa-fw fa-user"></i></span>
      <?php if (form_error('nama')) : ?>
        <input type="text" class="form-control is-invalid" name="nama" id="nama" placeholder="Nama Lengkap" value="<?= set_value('nama') ?>" autocomplete="off">
      <?php else : ?>
        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap" value="<?= set_value('nama') ?>" autocomplete="off">
      <?php endif; ?>
      <?= form_error('nama', '<div class="invalid-feedback">', '</div>'); ?>
    </div>
    <div class="input-group mb-3">
      <span class="input-group-text"><i class="fa fa-fw fa-envelope"></i></span>
      <?php if (form_error('email')) : ?>
        <input type="email" class="form-control is-invalid" name="email" id="email" placeholder="Email" value="<?= set_value('email') ?>" autocomplete="off">
      <?php else : ?>
        <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?= set_value('email') ?>" autocomplete="off">
      <?php endif; ?>
      <?= form_error('email', '<div class="invalid-feedback">', '</div>'); ?>
    </div>
    <div class="input-group mb-3">
      <span class="input-group-text"><i class="fa fa-fw fa-key"></i></span>
      <?php if (form_error('password')) : ?>
        <input type="password" class="form-control is-invalid" name="password" id="password" placeholder="Password">
      <?php else : ?>
        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
      <?php endif; ?>
      <?= form_error('password', '<div class="invalid-feedback">', '</div>'); ?>
    </div>
    <div class="input-group mb-3">
      <span class="input-group-text"><i class="fa fa-fw fa-key"></i></span>
      <?php if (form_error('confirm_password')) : ?>
        <input type="password" class="form-control is-invalid" name="confirm_password" id="confirm_password" placeholder="Konfirmasi Password">
      <?php else : ?>
        <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Konfirmasi Password">
      <?php endif; ?>
      <?= form_error('confirm_password', '<div class="invalid-feedback">', '</div>'); ?>
    </div>
    <button class="btn btn-masuk">Daftar</button>
    <p>Sudah punya akun? <span><a href="<?= base_url() ?>main/signIn">Masuk</a></span></p>
  </form>
</div>