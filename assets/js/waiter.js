$(document).ready(function(){
  $('#nama_pelanggan').on('keyup', function(){
    if($('#nama_pelanggan').val() == ""){
      $('#nama_pelanggan').addClass('is-invalid');
    }else{
      $('#nama_pelanggan').removeClass('is-invalid');
    }
  });
  $('#phone').on('keyup', function(){
    if($('#phone').val() == ""){
      $('#phone').addClass('is-invalid');
    }else{
      $('#phone').removeClass('is-invalid');
    }
  });
  $('#no_meja').on('keyup', function(){
    if($('#no_meja').val() == ""){
      $('#no_meja').addClass('is-invalid');
    }else{
      $('#no_meja').removeClass('is-invalid');
    }
  });
  $('#tanggal').on('keyup', function(){
    if($('#tanggal').val() == ""){
      $('#tanggal').addClass('is-invalid');
    }else{
      $('#tanggal').removeClass('is-invalid');
    }
  });
});