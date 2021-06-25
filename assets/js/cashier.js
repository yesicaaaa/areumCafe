$(document).ready(function(){
  $('#total_bayar').on('keyup', function(){
    if($('#total_bayar').val() == ''){
      $('#total_bayar').addClass('is-invalid');
    }else{
      $('#total_bayar').removeClass('is-invalid');
    }
  });
});