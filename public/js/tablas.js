$(document).ready(function () {
  $("#tabla").DataTable({
    paging: true,
    dom: "Bfrtip",

    language: {
      emptyTable: "No hay información",
      info: "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
      infoEmpty: "Mostrando 0 to 0 of 0 Entradas",
      infoFiltered: "(Filtrado de _MAX_ total entradas)",
      infoPostFix: "",
      thousands: ",",
      lengthMenu: "Mostrar _MENU_ Entradas",
      loadingRecords: "Cargando...",
      processing: "Procesando...",
      search: "Buscar:",
      zeroRecords: "Sin resultados encontrados",
      paginate: {
        first: "Primero",
        last: "Ultimo",
        next: "Siguiente",
        previous: "Anterior",
      },
    },
    buttons: [
      {
        extend: "excel",
        text: "Exportar a Excel",
        messageTop: "REPORTE",
        filename: "Reportes",
        exportOptions: {
          columns: [0, 1, 2, 4, 5, 6, 7, 11],
        },
      },
    ],
  });
});

/*table.buttons().container()
    .appendTo( $('.col-sm-6:eq(0)', table.table().container() ) );*/
