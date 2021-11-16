// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({ 
   "language":{
    "lengthMenu":"Số dòng hiển thị: _MENU_",
    "search":"Tìm:",
    "emptyTable":"Chưa có dữ liệu!",
    "info":"Hiển thị _END_ của tổng _TOTAL_ dữ liệu",
    "infoEmpty":"Dữ liệu trống",
    "infoFiltered":"trên tổng _MAX_ dữ liệu đang có",
    "zeroRecords":"Không tìm thấy dữ liệu",
    "paginate":{
      "previous":"Trang trước",
      "next":"Trang kế",
    }
   },
 });
});

$(document).ready(function() {
  $('#dataTable1').DataTable({ 
   "language":{
    "lengthMenu":"Số dòng hiển thị: _MENU_",
    "search":"Tìm:",
    "emptyTable":"Chưa có dữ liệu!",
    "info":"Hiển thị _END_ của tổng _TOTAL_ dữ liệu",
    "infoEmpty":"Dữ liệu trống",
    "infoFiltered":"trên tổng _MAX_ dữ liệu đang có",
    "zeroRecords":"Không tìm thấy dữ liệu",
    "paginate":{
      "previous":"Trang trước",
      "next":"Trang kế",
    }
   },
 });
});

$(document).ready(function() {
  $('#dataTable3').DataTable({ 
   "language":{
    "lengthMenu":"Số dòng hiển thị: _MENU_",
    "search":"Tìm:",
    "emptyTable":"Chưa có dữ liệu!",
    "info":"Hiển thị _END_ của tổng _TOTAL_ dữ liệu",
    "infoEmpty":"Dữ liệu trống",
    "infoFiltered":"trên tổng _MAX_ dữ liệu đang có",
    "zeroRecords":"Không tìm thấy dữ liệu",
    "paginate":{
      "previous":"Trang trước",
      "next":"Trang kế",
    }
   },
 });
});

$(document).ready(function() {
  $('#dataTable4').DataTable({ 
   "language":{
    "lengthMenu":"Số dòng hiển thị: _MENU_",
    "search":"Tìm:",
    "emptyTable":"Chưa có dữ liệu!",
    "info":"Hiển thị _END_ của tổng _TOTAL_ dữ liệu",
    "infoEmpty":"Dữ liệu trống",
    "infoFiltered":"trên tổng _MAX_ dữ liệu đang có",
    "zeroRecords":"Không tìm thấy dữ liệu",
    "paginate":{
      "previous":"Trang trước",
      "next":"Trang kế",
    }
   },
 });
});

$(document).ready(function() {
  $('#dataTable5').DataTable({ 
   "language":{
    "lengthMenu":"Số dòng hiển thị: _MENU_",
    "search":"Tìm:",
    "emptyTable":"Chưa có dữ liệu!",
    "info":"Hiển thị _END_ của tổng _TOTAL_ dữ liệu",
    "infoEmpty":"Dữ liệu trống",
    "infoFiltered":"trên tổng _MAX_ dữ liệu đang có",
    "zeroRecords":"Không tìm thấy dữ liệu",
    "paginate":{
      "previous":"Trang trước",
      "next":"Trang kế",
    }
   },
 });
});

$(document).ready(function() {
  $('#dataTableIndex').DataTable({
  "pageLength": 5, 
   "language":{
    "lengthMenu": 'Hiển thị 5 <select hidden>'+
      '<option value="5" selected>5</option>'+
      '</select> dữ liệu',
    "search":"Tìm:",
    "emptyTable":"Chưa có dữ liệu!",
    "info":"Hiển thị _END_ của tổng _TOTAL_ dữ liệu",
    "infoEmpty":"Dữ liệu trống",
    "infoFiltered":"trên tổng _MAX_ dữ liệu đang có",
    "zeroRecords":"Không tìm thấy dữ liệu",
    "paginate":{
      "previous":"Trang trước",
      "next":"Trang kế",
    }
   },
 });
});


$(document).ready(function() {
  $('#dataTableThu').DataTable({
    "sort":false,
    "info":false,
  'searching':false,
  "paginate":false, 
   dom: 'Bfrtip',
        buttons: [
            'csv', 'excel',
        ]
   });
 });