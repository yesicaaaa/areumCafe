<div class="sidenav daftar-menu">
  <h5>DAFTAR MENU</h5>
  <div class="divider"></div>
  <div>
    <ul class="nav nav-pills nav-stacked">
      <h4>Minuman</h4>
    </ul>
    <div class="divider"></div>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('DaftarMenu/menu_coffee'); ?>"><img src="<?= base_url() ?>assets/img/coffee.png"><span>Kopi</span></a></li>
    </ul>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('DaftarMenu/menu_tea'); ?>"><img src="<?= base_url() ?>assets/img/tea.png"><span>Teh</span></a></li>
    </ul>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('DaftarMenu/menu_juice'); ?>"><img src="<?= base_url() ?>assets/img/juice.png"><span>Jus</span></a></li>
    </ul>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('DaftarMenu/menu_milk'); ?>"><img src="<?= base_url() ?>assets/img/milk.png"><span>Susu</span></a></li>
    </ul>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('DaftarMenu/menu_soda'); ?>"><img src="<?= base_url() ?>assets/img/soda.png"><span>Soda</span></a></li>
    </ul>
    <div class="divider-end"></div>
    <ul class="nav nav-pills nav-stacked">
      <h4>Makanan</h4>
    </ul>
    <div class="divider"></div>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('DaftarMenu/menu_rice'); ?>"><img src="<?= base_url() ?>assets/img/rice.png"><span>Nasi</span></a></li>
    </ul>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('DaftarMenu/menu_noodle'); ?>"><img src="<?= base_url() ?>assets/img/noodles.png"><span>Mie</span></a></li>
    </ul>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('DaftarMenu/menu_pastry'); ?>"><img src="<?= base_url() ?>assets/img/cookie.png"><span>Kue Kering</span></a></li>
    </ul>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('DaftarMenu/menu_cake'); ?>"><img src="<?= base_url() ?>assets/img/cake.png"><span>Bolu</span></a></li>
    </ul>
    <ul class="nav nav-pills nav-stacked">
      <li><a href="<?= base_url('DaftarMenu/menu_dessert'); ?>"><img src="<?= base_url() ?>assets/img/sweets.png"><span>Dessert</span></a></li>
    </ul>
    <div class="divider-delete"></div>
    <ul class="nav nav-pills nav-stacked delete-pelanggan">
      <form action="<?= base_url('waiter/delete_pelanggan/') . $this->session->userdata('id_pelanggan');?>" method="POST">
        <?php foreach ($cart as $c) : ?>
          <input type="hidden" name="id[]" value="<?= $c['id'] ?>">
          <input type="hidden" name="stok[]" value="<?= $c['qty'] ?>">
        <?php endforeach; ?>
        <li><button type="submit" onclick="return confirm('Yakin ingin membatalkan pesanan?')">BATALKAN</button></li>
      </form>
    </ul>
  </div>
</div>