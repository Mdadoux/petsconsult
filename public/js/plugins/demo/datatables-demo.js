// Call the dataTables jQuery plugin
$(document).ready(function () {
  $('#dataTable').DataTable(
    {
      "order": [[0, "desc"]]
    }
  );



  //gestion du modal 

  $('#delete-modal').on('show.bs.modal', function (e) {
    var $elem = $(e.relatedTarget);
    var elem_id = $elem.data('delete');
    var elem_titre = $elem.data('titre');
    var content = $(this);

    content.find(".modal-body #element-a-suppr").val(elem_id);
    content.find("#element-titre").text(elem_titre);


    console.log(content);

  })
});
