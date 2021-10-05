$(document).ready(function() {
  $('#btn_simpan_menu').click(function() {
    onSaveMenu();
  });

  $('#btn_batal_input').click(function() {
    window.location = base_url + 'admin/menuCafe';
  });

  $('#form-add').validate({
    rules: {
      nama: {
        maxlength: 100
      }
    },
    messages: {
      nama: {
        maxlength: 'Inputan maksimal 100 karakter',
      }
    },
    highlight: function(e) {
      $(e).closest('.form-group').addClass('has-error');
    },
    success: function(e){
      $(e).closest('.form-group').removeClass('has-error');
      $(e).remove();
    },
    errorPlacement: function(error, element) {
      error.insertAfter(element);
    }
  });
});

var base_url = 'http://localhost/areumCafe/';

function onSaveMenu() {
  if($('#form-add').valid()) {
    var formData = new FormData($('#form-add')[0]);
    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: base_url + 'admin/tambahMenuCafe',
      data: formData,
      contentType: false,
      processData: false,
      beforeSend: function() {
        $('#btn_simpan_menu').html('Mohon Tunggu <i class="fa fa-fw fa-spinner"></i>');
        $('#btn_simpan_menu').attr( 'disabled', 'disabled');
      },
      success: function(data) {
        $('#btn_simpan_menu').html('<i class="fa fa-fw fa-save"></i> Simpan');
        $('#btn_simpan_menu').removeAttr('disabled');

        if(data.res_status == false) {
          $.gritter.add({
            title: 'Proses Gagal',
            text: data.res_message,
            class_name: 'with-icon times-circle danger'
          });
        } else {
          $.gritter.add({
            title: 'Proses Berhasil',
            text: data.res_message,
            class_name: 'with-icon check-circle success'
          });

          setTimeout(function(e) {
            window.location = base_url + 'admin/menuCafe';
          }, 1500);
        }
      },
      error: function(jqXHR, textStatus, errorThrown) {
        $('#btn_simpan_menu').html('<i class="fa fa-fw fa-save"></i> Simpan');
        $('#btn_simpan_menu').removeAttr('disabled');

        $.gritter.add({
          title: 'Proses Error',
          text: 'Data gagal disimpan',
          class_name: 'with-icon times-circle danger'
        });
      }
    });
  } else {
    $.gritter.add({
      title: 'Proses Error',
      text: 'Mohon isi semua inputan berbintang',
      class_name: 'with-icon times-circle danger'
    });
  }
}