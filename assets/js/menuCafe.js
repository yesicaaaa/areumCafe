$(document).ready(function() {
  $('.table-menu-cafe').dataTable({
    "ordering": false,
    "lengthChange": false
  });

  $('.tambah-menu').click(function() {
    window.location = base_url +  'admin/tambahMenu'
  });

  $('#checkall').click(function() {
    checkAll();
  });

  $('.checkpart').click(function() {
    checkPart();
  });

  $('table tr td:first-child input[type=checkbox]').each(function(){
    checkRow($(this));
  });

  $('table tr td:first-child input[type=checkbox]').click(function() {
    checkRow($(this));
  });

  $('.delete-menu').click(function() {
    konfirmasiHapus();
  });

  $('.btn-hapus-pegawai').click(function() {
    deletePegawai();
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

function checkPart() {
  $('#checkall').prop('checked', false);
}

function checkRow(row) {
  if(row.is(':checked')) {
    row.closest('tr').addClass('success');
  }else{
    row.closest('tr').removeClass('success');
  }
}

function konfirmasiHapus() {
  var id_menu = $('input:checkbox[name=id]:checked').map(function(){ return $(this).data('iduser')}).get();

  if(id_menu.length != 0) {
    $('#modalDeletePegawai').modal('show');
  } else {
    $.gritter.add({
      title: 'Proses Error',
      text: 'Tidak ada data yang dipilih!',
      class_name: 'with-icon times-circle danger'
    });
  }
}

function deletePegawai() {
  var id_menu = $('input:checkbox[name=id]:checked').map(function(){ return $(this).data('iduser')}).get();

  if(id_menu.length != 0) {
    $('.btn-hapus-pegawai').html('Mohon Tunggu <i class="fa fa-fw fa-spinner"></i>');
    $('.btn-hapus-pegawai').attr('disabled', 'disabled');

    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: base_url + 'admin/hapusMenuCafe',
      data: {id_menu: id_menu.toString()},
      success: function(data) {
        $('.btn-hapus-pegawai').html('Hapus');
        $('.btn-hapus-pegawai').removeAttr('disabled');
        $('#modalDeletePegawai').hide();

        if(data.res_status) {
          $.gritter.add({
            title: 'Proses Berhasil',
            text: data.res_message,
            class_name: 'with-icon check-circle success'
          });

          setTimeout(function(e) {
            window.location = base_url + 'admin/menuCafe';
          }, 1500);
        } else{
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

        $('#modalDeletePegawai').modal('hide');
        $('.btn-hapus-pegawai').html('Hapus');
        $('.btn-hapus-pegawai').removeAttr('disabled');
      }
    })
  }
}