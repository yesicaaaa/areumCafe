$(document).ready(function() {
  $('.table-menu-cafe').dataTable({
    "ordering": false
  });

  $('.tambah-menu').click(function() {
    window.location = base_url +  'admin/tambahMenu'
  });
})