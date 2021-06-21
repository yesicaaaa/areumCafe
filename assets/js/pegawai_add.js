$(document).ready(function(){
  $('#inputNama').on('keyup', function() {
    if($('#inputNama').val() == ""){
        $('#inputNama').addClass('is-invalid');
    }else{
        $('#inputNama').removeClass('is-invalid');
      }
  });

  
  
  $('#inputEmail').on('keyup', function() {
    if($('#inputEmail').val() == ""){
        $('#inputEmail').addClass('is-invalid');
    }else{
        $('#inputEmail').removeClass('is-invalid');
      }
  });
  $('#inputPassword, #inputConfirmPassword').on('keyup', function() {
    if($('#inputPassword').val() != $('#inputConfirmPassword').val() || $('#inputPassword').val() == "" || $('#inputConfirmPassword').val() == ""){
        $('#inputConfirmPassword').addClass('is-invalid');
        $('#inputPassword').addClass('is-invalid');
    }else{
        $('#inputConfirmPassword').removeClass('is-invalid');
        $('#inputPassword').removeClass('is-invalid');
      }
  });

  // if($('#pegawai-collapse').hasClass('collapsed')){
  //   $('#pegawai-collapse').html('-');
  // }else{
  //   $('#pegawai-collapse').html('+');
  // }
  // var base_url = 'http://localhost/areumCafe/';
  // $('#validasi').on('click', function(){
  //   var data = $('#formAdd').serialize();
  //   $.ajax({
  //     url: base_url + 'admin/pegawai_add',
  //     type: 'POST',
  //     dataType: 'json',
  //     data: data,
  //     success: function(data) {
  //       if(data != 'berhasil'){
  //         $('#inputNama').addClass('is-invalid');
  //         $('.nama-error').html(data.nama);
  //         $('#inputEmail').addClass('is-invalid');
  //         $('.email-error').html(data.email);
  //         $('#inputPassword').addClass('is-invalid');
  //         $('.password-error').html(data.password);
  //         $('#inputConfirmPassword').addClass('is-invalid');
  //         $('.confirm-password-error').html(data.confirm_password);
  //       }else{
  //         $('#inputNama').removeClass('is-invalid');
  //         $('#h1').html('berhasil');
  //       }
  //     }
  //   });
  // });
  // $('#namaEdit').on('keyup', function() {
  //   if($('#namaEdit').val() == ""){
  //     $('#namaEdit').addClass('is-invalid');
  //   }else{
  //     $('#namaEdit').removeClass('is-invalid');
  //   }
  // });
  $('#namaEdit').on('keyup', function() {
      if($('#namaEdit').val() == ""){
          $('#namaEdit').addClass('is-invalid');
      }else{
          $('#namaEdit').removeClass('is-invalid');
        }
  });

  $('#emailEdit').on('keyup', function() {
      if($('#emailEdit').val() == ""){
          $('#emailEdit').addClass('is-invalid');
      }else{
          $('#emailEdit').removeClass('is-invalid');
        }
  });
});