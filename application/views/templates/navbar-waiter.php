<nav class="navbar navbar-expand-lg bg-nav">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Areum <span>Cafe</span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url() ?>waiter/pesanan">Pesanan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url() ?>main/signOut" onclick="return confirm('Yakin ingin keluar?')">Keluar</a>
        </li>
      </ul>
    </div>
    <p class="username"><?= $user['nama']; ?></p>
  </div>
</nav>