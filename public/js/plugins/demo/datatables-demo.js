// Call the dataTables jQuery plugin
$(document).ready(function () {
  $('#dataTable').DataTable(
    {
      "order": [[3, "desc"]] // odonner les enregistrement par date croissante
    }
  );

  $('#dataTable-patients').DataTable(
    {
      "order": [[0, "desc"]] // odonner les enregistrement par date croissante
    }
  );



});
