$(document).ready(function(){
  $('#nama').on('keyup', function() {
    if($('#nama').val() == ""){
      $('#nama').addClass('is-invalid');
    }else{
      $('#nama').removeClass('is-invalid  ')
    }
  });
  $('#harga').on('keyup', function() {
    if($('#harga').val() == ""){
      $('#harga').addClass('is-invalid');
    }else{
      $('#harga').removeClass('is-invalid  ')
    }
  });
  
  $('#deskripsi').on('keyup', function() {
    if($('#deskripsi').val() == ""){
      $('#deskripsi').addClass('is-invalid');
    }else{
      $('#deskripsi').removeClass('is-invalid  ')
    }
  });
  $('#jenis').on('keyup', function() {
    if($('#jenis').val() == ""){
      $('#jenis').addClass('is-invalid');
    }else{
      $('#jenis').removeClass('is-invalid  ')
    }
  });
  $('#stok').on('keyup', function() {
    if($('#stok').val() == ""){
      $('#stok').addClass('is-invalid');
    }else{
      $('#stok').removeClass('is-invalid  ')
    }
  });
});