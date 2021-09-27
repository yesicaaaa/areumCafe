<div class="container-signin">
  <h1>Areum <span>Cafe</span></h1>
  <?= $this->session->flashdata('message'); ?>
  <form action="" method="post" class="form-signin">
    <div class="input-group mb-3">
      <span class="input-group-text"><i class="fa fa-fw fa-envelope"></i></span>
      <?php if (form_error('email')) : ?>
        <input type="email" class="form-control is-invalid" name="email" id="email" placeholder="Email" value="<?= set_value('email') ?>">
      <?php else : ?>
        <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?= set_value('email') ?>">
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
    <button class="btn btn-masuk">Masuk</button>
    <!-- <p>Belum punya akun? <span><a href="<?= base_url(); ?>main/signUp">Daftar</a></span></p> -->
  </form>
</div>