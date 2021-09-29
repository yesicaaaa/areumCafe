$(document).ready(function() {
  $('#checkall').click(function() {
    checkAll();
  });

  $('.saudara-pegawai input[type=checkbox]').each(function(){
    checkRow($(this));
  });

  $('.saudara-pegawai input[type=checkbox]').click(function(){
    checkRow($(this));
  });

  $('.delete-detail-pegawai').click(function() {
    konfirmasiHapus();
  });

  $('.btn-hapus-detail-pegawai').click(function() {
    deleteDetailPegawai();
  });
});

function checkAll() {
  if($('#checkall').prop('checked') == true) {
    $('.id-checkbox').prop('checked', true);
    $('.id-checkbox').parent().parent().addClass('success');
  } else {
    $('.id-checkbox').prop('checked', false);
    $('.id-checkbox').parent().parent().removeClass('success');
  }
}

function checkRow(row) {
  if(row.is(':checked')) {
    row.closest('.saudara-pegawai').addClass('success');
  } else {
    row.closest('.saudara-pegawai').removeClass('success');
  }
}

function konfirmasiHapus() {
  var id_user = $('input:checkbox[name=id]:checked').map(function(){ return $(this).data('iduser')}).get();

  if(id_user.length != 0) {
    $('#modalDeleteDetailPegawai').modal('show');
  } else {
    $.gritter.add({
      title: 'Proses Error',
      text: 'Pilih minimal 1 data untuk dihapus!',
      class_name: 'with-icon times-circle danger'
    });
  }
}

function deleteDetailPegawai() {
  var base_url = 'http://localhost/areumCafe/';
  var id_user = $('input:checkbox[name=id]:checked').map(function(){ return $(this).data('iduser')}).get();
  var id_pegawai = $('#idPegawai').val();

  if(id_user.length != 0) {
    $('.btn-hapus-detail-pegawai').html('Mohon Tunggu <i class="fa fa-fw fa-spinner"></i>');
    $('.btn-hapus-detail-pegawai').attr('disabled', 'disabled');
    $.ajax({
      type: 'post',
      dataType: 'json',
      url: base_url + 'admin/deleteDetailPegawai',
      data: {id_user: id_user.toString()},
      success: function(data) {
        $('.btn-hapus-detail-pegawai').html('Hapus');
        $('.btn-hapus-detail-pegawai').removeAttr('disabled');
        $('#modalDeleteDetailPegawai').modal('hide');

        if(data.res_status) {
          $.gritter.add({
            title: 'Proses Berhasil',
            text: data.res_message,
            class_name: 'with-icon check-circle success'
          });

          setTimeout(function(e) {
            window.location = base_url + 'admin/detailPegawai?id_user=' + id_pegawai;
          }, 1500);
        } else {
          $.gritter.add({
            title: 'Proses Error',
            text: data.res_message,
            class_name: 'with-icon times-circle danger'
          });
        }
      },
      error: function(jqXHR, textStatus, errorThrown) {
        $.gritter.add({
          title: 'Proses Error',
          text: 'Data gagal dihapus',
          class_name: 'with-icon times-circle danger'
        });

        $('#modalDeleteDetailPegawai').modal('hide');
        $('.btn-hapus-detail-pegawai').html('Hapus');
        $('.btn-hapus-detail-pegawai').removeAttr('disabled');
      }
    });
  }
}