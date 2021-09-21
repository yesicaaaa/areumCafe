$(document).ready(function() {
    $('.add-more').on('click', function() {
      var html = $('.copy-inputan').html();
      $('.after-add-more').after(html);
    });

    $('body').on('click', '.remove', function() {
      $(this).parents(".control-group").remove();
    });

    $('#btn_simpan_pegawai').click(function() {
      onSavePegawai();
    });

    $('#form-add').validate({
      rules: {
        nama: {
          maxlength: 100
        },
        email: {
          email: true,
          maxlength: 100
        },
        hak_akses: {
          maxlength: 1
        },
        password: {
          minlength: 6,
        },
        confirm_password: {
          minlength: 6,
          equalTo: '#inputPassword'
        }
      },
      messages: {
        nama: {
          maxlength: "Panjang maksimal inputan sampai 100 karakter"
        },
        email: {
          email: "Penulisan email harus valid",
          maxlength: "Panjang maksimal inputan sampai 100 karakter"
        },
        hak_akses: {
          maxlength: "Panjang maksimal inputan sampai 1 karakter"
        },
        password: {
          minlength: "Panjang minimal inputan 6 karakter"
        },
        confirm_password: {
          minlength: "Panjang minimal inputan 6 karakter",
          equalTo: 'Password tidak sama'
        } 
      },
      errorElement: 'div',
      errorClass: 'help-block',
      focusInvalid: false,
      ignore: '',
      highlight: function(e) {
        $(e).closest('.form-group').addClass('has-error');
      },
      success: function(e) {
        $(e).closest('.form-group').removeClass('has-error');
        $(e).remove();
      },
      errorPlacement: function(error, element){
        error.insertAfter(element);
      }
    });
  });

  function onSavePegawai() {
    if($('#form-add').valid()) {
      var base_url = 'http://localhost/areumCafe/';
      var arr = [];
      var i = 0;
      $('.nama-saudara').each(function(index, element) {
        if ($(element).val() != '') {
          arr.push({
            nama_saudara: $(element).val(),
            deskripsi: $(element).parents('.row').find('.deskripsi').val()
          });
          i++;
        }
      });
      $.ajax({
        type: 'POST',
        dataType: 'json',
        url: base_url + 'admin/tambahDataPegawai',
        data: {
          nama: $('#inputNama').val(),
          email: $('#inputEmail').val(),
          hak_akses: $('#inputRole').val(),
          password: $('#inputPassword').val(),
          confirm_password: $('#inputConfirmPassword').val(),
          detailPegawai: arr
        },
        beforeSend: function() {
          $('#btn_simpan_pegawai').html('Mohon tunggu <i class="fa fa-fw fa-spinner"></i>');
          $('#btn_simpan_pegawai').attr('disabled', 'disabled');
        },
        success: function(data) {
          $('#btn_simpan_pegawai').html('<i class="fa fa-fw fa-save"></i> Simpan');
          $('#btn_simpan_pegawai').removeAttr('disabled');
          if(data.res_status == false) {
            $.gritter.add({
              title: 'Proses gagal',
              text: data.res_message,
              class_name: 'with-icon times-circle danger'
            });
          } else {
            $.gritter.add({
              title: 'Proses berhasil',
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
            title: 'Proses error',
            text: 'Data gagal disimpan!',
            class_name: 'with-icon times-circle danger'
          });
        }
      });
    } else {
      $.gritter.add({
        title: 'Proses error',
        text: 'Mohon isi semua inputan berbintang',
        class_name: 'with-icon times-circle danger'
      });
    }
  }