function addDataTable(tableId) {
    $(function () {
        $("#"+tableId).DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#'+tableId+'_wrapper .col-md-6:eq(0)');
      });
}

function showMessage(type, message) {
  if(type == 'success') {
    toastr.success(message);
  } else {
    toastr.error(message);
  }
  
}