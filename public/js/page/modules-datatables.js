"use strict";

$("[data-checkboxes]").each(function() {
  var me = $(this),
    group = me.data('checkboxes'),
    role = me.data('checkbox-role');

  me.change(function() {
    var all = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"])'),
      checked = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"]):checked'),
      dad = $('[data-checkboxes="' + group + '"][data-checkbox-role="dad"]'),
      total = all.length,
      checked_length = checked.length;

    if(role == 'dad') {
      if(me.is(':checked')) {
        all.prop('checked', true);
      }else{
        all.prop('checked', false);
      }
    }else{
      if(checked_length >= total) {
        dad.prop('checked', true);
      }else{
        dad.prop('checked', false);
      }
    }
  });
});

$("#table-1").dataTable({
  "columnDefs": [
    { "sortable": false, "targets": [2, 3], "width": "30%" },
    // { "targets": [0, 1, 2, 5], "width": "5000px" }
  ]
});

$(document).ready(function () {
  $("#table-1").css("width", '2000px');
  $("#table-1 th:nth-child(2), #table-1 td:nth-child(2)").css("width", "170px");
  $("#table-1 th:nth-child(3), #table-1 td:nth-child(3)").css("width", "150px");
  $("#table-1 th:nth-child(4), #table-1 td:nth-child(4)").css("width", "150px");
  $("#table-1 th:nth-child(5), #table-1 td:nth-child(5)").css("width", "100px");
  $("#table-1 th:nth-child(6), #table-1 td:nth-child(6)").css("width", "200px");
  $("#table-1 th:nth-child(7), #table-1 td:nth-child(7)").css("width", "150px");
  $("#table-1 th:nth-child(15), #table-1 td:nth-child(15)").css("width", "150px");
  $("#table-1 th:nth-child(16), #table-1 td:nth-child(16)").css("width", "250px");
  $("#table-1 th:nth-child(17), #table-1 td:nth-child(17)").css("width", "200px");

});

$("#table-2").dataTable({
  "columnDefs": [
    { "sortable": false, "targets": [0,2,3] }
  ]
});
