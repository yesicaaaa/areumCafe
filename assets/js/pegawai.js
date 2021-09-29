$(document).ready(function() {
  // $('.delete-pegawai').click(function() {
  //   swal({
  //     title: 'Konfirmasi Hapus',
  //     text: 'Apakah kamu yakin ingin menghapus data pegawai?',
  //     showCancelButton: true,
  //     confirmButtonText: 'Hapus',
  //     confirmButtonColor: 'rgba(217, 83, 79, 0.9)',
  //     cancelButtonColor: '#C9CCD5'
  //   });
  // });

  $('.pegawai').DataTable({
    "ordering": false
  });

  $('.delete-pegawai').click(function() {
    konfirmasiHapus();
  });

  $('table tr td:first-child input[type=checkbox]').each(function() {
    checkRow($(this));
  })

  $('table tr td:first-child input[type=checkbox]').click(function() {
    checkRow($(this));
  })

  $('#checkall').click(function() {
    checkAll();
  });

  $('.checkpart').click(function() {
    checkPart();
  });

  $('.btn-hapus-pegawai').click(function() {
    deletePegawai();
  })

  $('.edit-pegawai').click(function() {
    onEdit();
  });
});

function checkRow(row) {
  if(row.is(':checked')) {
    row.closest('tr').addClass('success')
  } else {
    row.closest('tr').removeClass('success');
  }
}

function getData(id_user) {
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: base_url + 'admin/getPegawaiRow',
    data: {
      id_user: id_user
    },
    success: function(data) {
      $('#id_userEdit').val(data.id_user),
      $('#namaEdit').val(data.nama),
      $('#emailEdit').val(data.email),
      $('#aksesEdit').val(data.hak_akses),
      $('#editPegawai').modal('show')
    }
  });
}

function konfirmasiHapus() {
  var id_user = $('input:checkbox[name=id]:checked').map(function(){return $(this).data('iduser');}).get();
  if(id_user.length != 0) {
    $('#modalDeletePegawai').modal('show');
  } else {
    $.gritter.add({
      title: 'Proses Error',
      text: 'Tidak ada data yang dipilih',
      class_name: 'with-icon times-circle danger'
    });
  }
}

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

function deletePegawai() {
  var id_user = $('input:checkbox[name=id]:checked').map(function(){return $(this).data('iduser');}).get();
  
  if(id_user.length != 0) {
    $('.btn-hapus-pegawai').html('Mohon Tunggu <i class="fa fa-fw fa-spinner"></i>');
    $('.btn-hapus-pegawai').attr('disabled', 'disabled');
    $.ajax({
      type: 'post',
      url: base_url + 'admin/pegawai_delete',
      data: {id_user:id_user.toString()},
      dataType: 'json',
      success: function(data) {
        $('.btn-hapus-pegawai').html('Hapus');
        $('.btn-hapus-pegawai').removeAttr('disabled');
        $('#modalDeletePegawai').modal('hide');

        if(data.res_status) {
          $.gritter.add({
            title: 'Proses Berhasil',
            text: data.res_message,
            class_name: 'with-icon check-circle success'
          }); 

          setTimeout(function(e){
            window.location = base_url + 'admin/pegawai';
          }, 1500);
        } else {
          $.gritter.add({
            title: 'Proses Error',
            text: data.res_message,
            class_name: 'with-icon times-circle danger'
          })
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

function onEdit() {
  var base_url = 'http://localhost/areumCafe/';
  var id_user = $('input:checkbox[name=id]:checked').map(function(){return $(this).data('iduser');}).get();

  if(id_user.length == 1) {
    window.location = base_url + "admin/editPegawai?id_user=" + id_user.toString();
  } else {
    $.gritter.add({
      title: 'Proses Error',
      text: 'Mohon pilih satu data untuk diedit',
      class_name: 'with-icon times-circle danger'
    });
  }
}