$(document).ready(function() {
  $('.add-more').on('click', function() {
    var html = $('.copy-inputan').html();
    $('.after-add-more').after(html);
  });

  $('body').on('click', '.remove', function() {
    $(this).parents('.control-group').remove();
  });

  $('#btn_simpan_pegawai').click(function() {
    onSavePegawai();
  });

  $('#form-add').validate({
    rules: {
      nama: {
        maxlength: 100
      },
      hak_akses: {
        maxlength: 1
      },
      deskrispi_user: {
        maxlength: 100
      }
    },
    messages: {
      nama: {
        maxlength: 'Panjang maksimal inputan 100 karakter'
      },
      hak_akses: {
        maxlength: 'Panjang maksimal inputan 1 karakter'
      },
      deskripsi_user: {
        maxlength: 'Panjang maksimal inputan 100 karakter'
      }
    },
    highlight: function(e) {
      $(e).closest('.form-group').addClass('has-error');
    },
    success: function(e) {
      $(e).closest('.form-group').removeClass('has-error');
      $(e).remove();
    },
    errorPlacement: function(error, element) {
      error.insertAfter(element);
    }
  });
});

function onSavePegawai() {
  if($('#form-add').valid()) {
    var base_url = 'http://localhost/areumCafe/';
    var arr = [];
    $('.nama-saudara').each(function(index, element) {
      if($(element).val() != '') {
        arr.push({
          nama_saudara: $(element).val(),
          deskripsi: $(element).parents('.row').find('.deskripsi').val(),
          id_user_detail: $(element).parents('.row').find('.id-user-detail').val()
        });
      }
    });
    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: base_url + 'admin/editDataPegawai',
      data: {
        id_user: $('#inputIdUser').val(),
        nama: $('#inputNama').val(),
        hak_akses: $('#inputRole').val(),
        deskripsi_user: $('#inputDeskripsiUser').val(),
        detailPegawai: arr
      },
      beforeSend: function() {
        $('#btn_simpan_pegawai').html('Mohon Tunggu <i class="fa fa-fw fa-spinner"></i>');
        $('#btn_simpan_pegawai').attr('disabled', 'disabled');
      },
      success: function(data) {
        $('#btn_simpan_pegawai').html('<i class="fa fa-fw fa-save"></i> Simpan');
        $('#btn_simpan_pegawai').removeAttr('disabled');

        if(data.res_status == false) {
          $.gritter.add({
            title: 'Proses Error',
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
            window.location = base_url + 'admin/pegawai'
          }, 1500);
        }
      }, 
      error: function(jqXHR, textStatus, errorThrown) {
        $('#btn_simpan_pegawai').html('<i class="fa fa-fw fa-save"></i> Simpan');
        $('#btn_simpan_pegawai').removeAttr('disabled');

        $.gritter.add({
          title: 'Proses Error',
          text: 'Data gagal disimpan!',
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