<div class="main">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-md-6 timeimg">
      <img src="<?= base_url('assets/img/time.png') ?>" alt="illustrator">
    </div>
    <div class="col-md-6 timezone">
      <div class="row">
        <div class="col-md-6">
          <div class="calendar"><?= $calendar ?></div>
        </div>
        <div class="col-md-6">
          <h5><?= date('l, d M Y') ?></h5>
          <h1 id="timestamp"></h1>
        </div>
      </div>
    </div>
  </div>
  <div class="grafik">
    <div class="row">
      <div class="col-md-6 gf-pegawai">
        <h6>Grafik Pegawai</h6>
        <div class="divider-grafik"></div>
        <canvas id="pegawaiGrafik" width="700" height="250"></canvas>
      </div>
      <div class="col-md-6 chartimg">
        <img src="<?= base_url('assets/img/chart.png') ?>" alt="ilustrator">
      </div>
    </div>
    <h6>Grafik Menu Cafe</h6>
    <div class="divider-grafik"></div>
    <div class="row">
      <div class="col-md-4">
        <p>Jumlah Jenis Menu</p>
        <canvas id="menuGrafik" width="350" height="200"></canvas>
      </div>
      <div class="col-md-4">
        <p>Data Menu Terjual</p>
        <canvas id="menuTerjualGrafik" width="350" height="200"></canvas>
      </div>
      <div class="col-md-4">
        <p>Data Stok Menu</p>
        <canvas id="stokMenuGrafik" width="350" height="200"></canvas>
      </div>
    </div>
  </div>
  <?php
  //grafik pegawai
  $aksesPegawai = null;
  $totalPegawai = null;
  foreach ($pegawaiGrafik as $pg) {
    $aksesP = $pg['nama_akses'];
    $aksesPegawai .= "'$aksesP'" . ', ';
    $totalP = $pg['total'];
    $totalPegawai .= "'$totalP'" . ', ';
  }

  //grafik menu
  $jenisMenu = null;
  $totalMenu = null;
  foreach ($menuGrafik as $mg) {
    $jenisM = $mg['jenis'];
    $jenisMenu .= "'$jenisM'" . ', ';
    $totalM = $mg['total'];
    $totalMenu .= "'$totalM'" . ', ';
  }

  //grafik menu terjual
  $namaMenu = null;
  $totalTerjual = null;
  foreach ($menuTerjualGrafik as $mt) {
    $namaM = $mt['jenis'];
    $namaMenu .= "'$namaM'" . ', ';
    $totalT = $mt['total'];
    $totalTerjual .= "'$totalT'" . ', ';
  }

  //grafik stok menu
  $stokMenu = null;
  $totalStok = null;
  foreach ($stokMenuGrafik as $sm) {
    $stokM = $sm['jenis'];
    $stokMenu .= "'$stokM'" . ', ';
    $totalS = $sm['total'];
    $totalStok .= "'$totalS'" . ', ';
  }
  ?>
</div>

<script>
  //chart pegawai
  var ctx_pegawai = document.getElementById('pegawaiGrafik').getContext('2d');
  var chart_pegawai = new Chart(ctx_pegawai, {
    type: 'line',
    data: {
      labels: [<?= $aksesPegawai; ?>],
      datasets: [{
        label: 'Jumlah Pegawai',
        borderColor: "rgb(55, 73, 57)",
        data: [<?= $totalPegawai ?>]
      }]
    },
    options: {
      responsive: false
    }
  });

  //chart menu
  var ctx_menu = document.getElementById('menuGrafik').getContext('2d');
  var chart_menu = new Chart(ctx_menu, {
    type: 'polarArea',
    data: {
      labels: [<?= $jenisMenu ?>],
      datasets: [{
        data: [<?= $totalMenu ?>],
        backgroundColor: [
          'rgb(59, 80, 61)',
          'rgb(178, 115, 62)',
          'rgb(97, 60, 61)',
          'rgb(103, 130, 141)',
          'rgb(124, 116, 97)'
        ]
      }]
    },
    options: {
      responsive: false
    }
  });

  //chart menu terjual
  var ctx_terjual = document.getElementById('menuTerjualGrafik').getContext('2d');
  var chart_terjual = new Chart(ctx_terjual, {
    type: 'doughnut',
    data: {
      labels: [<?= $namaMenu ?>],
      datasets: [{
        data: [<?= $totalTerjual ?>],
        backgroundColor: [
          'rgb(59, 80, 61)',
          'rgb(178, 115, 62)',
          'rgb(97, 60, 61)',
          'rgb(103, 130, 141)',
          'rgb(124, 116, 97)'
        ]
      }]
    },
    options: {
      responsive: false
    }
  });

  //chart stok menu
  var ctx_stok = document.getElementById('stokMenuGrafik').getContext('2d');
  var chart_stok = new Chart(ctx_stok, {
    type: 'polarArea',
    data: {
      labels: [<?= $stokMenu ?>],
      datasets: [{
        data: [<?= $totalStok ?>],
        backgroundColor: [
          'rgb(59, 80, 61)',
          'rgb(178, 115, 62)',
          'rgb(97, 60, 61)',
          'rgb(103, 130, 141)',
          'rgb(124, 116, 97)'
        ]
      }]
    },
    options: {
      responsive: false
    }
  })

  var base_url = '<?= base_url() ?>';
  $(function() {
    setInterval(timestamp, 1000);
  });

  function timestamp() {
    $.ajax({
      url: base_url + 'main/time',
      success: function(data) {
        $('#timestamp').html(data);
      }
    });
  }
</script>