$(document).ready(function () {
  //$("#datatable").DataTable();
  $("#tableServicios").DataTable({
    ajax: {
      url: "./back/get_listServicios.php",
    },
    deferRender: true,
    scrollY: 340,
    scrollX: true,
    stateSave: true,
    paging: true,
    /* select: true, */
    orderCellsTop: true,
    fixedHeader: true,
    lengthMenu: [
      [10, 20, 1000, -1],
      [10, 20, 1000, "Todos"],
    ],
    dom:
      "<'row'<'col-sm-6'B><'col-sm-6'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-4'i><'col-sm-4 text-center'l><'col-sm-4'p>>",
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json",
    },
    order: [[0, "asc"]],
    columns: [
      {
        bSortable: false,
        mRender: function (data, type, row) {
          return `${row.cliente.nom_clie}, ${row.cliente.razon_social}, ${row.cliente.rfc} `;
        },
      },
      {
        bSortable: false,
        mRender: function (data, type, row) {
          return `${row.direccion.estado}, ${row.direccion.municipio}, ${row.direccion.colonia}, ${row.direccion.calle}, ${row.direccion.num_ext}, ${row.direccion.num_int}, ${row.direccion.cp}`;
        },
      },
      {
        data: "cost_unit",
      },
      {
        data: "num_san",
      },
      {
        data: "cost_tot",
      },
      {
        mRender: function (data, type, row) {
          return `<p style = "background-color: ${row.color}; padding: 2px; border-radius: 5px; margin: 0px;" >${row.estatus}</p>`;
        },
      },
      {
        data: "id_ser",
        bSortable: false,
        mRender: function (data, type, row) {
          return `<div class="btn-group" role="group" aria-label="Basic example">
               <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalUpdate" title="Editar" onclick="get_info(${data}, 'update')" ><i class="fas fa-edit" ></i></button>
               <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalDelete" title="Eliminar" onclick="get_info(${data}, 'delete')"><i class="fas fa-trash"></i></button>
               <button type="button" class="btn btn-secondary btn-sm" title="Ver Servicio" onclick="verServicio(${data})"><i class="fas fa-file"></i></button>
             </div>`;
        },
      },
    ],
    buttons: [
      {
        extend: "excelHtml5",
        title: "Lista de Servicios",
        text: '<i class="fas fa-file-excel"></i>',
        className: "btn-sm",
      },
      {
        extend: "csvHtml5",
        title: "Lista de Servicios",
        text: '<i class="fa-solid fa-file-csv"></i>',
        className: "btn-sm",
      },
      {
        extend: "pdfHtml5",
        title: "Lista de Servicios",
        text: '<i class="fas fa-file-pdf"></i>',
        className: "btn-sm",
        orientation: "landscape",
        footer: "true",
        exportOptions: {
          columns: ":visible",
        },
      },
      {
        extend: "print",
        title: "Lista de Servicios",
        className: "btn-sm",
        text: '<i class="fa-solid fa-print"></i>',
        footer: "true",
        exportOptions: {
          columns: ":visible",
        },
      },
      {
        extend: "copy",
        title: "Lista de Servicios",
        className: "btn-sm",
        text: '<i class="fas fa-copy"></i>',
      },
      {
        extend: "colvis",
        className: "btn-sm",
        text: '<i class="fas fa-eye"></i>',
      },
      {
        extend: "print",
        text: '<i class="fas fa-print"></i>',
        className: "btn-sm",
        exportOptions: {
          modifier: {
            selected: null,
          },
        },
      },
    ],
  });
});



var el = document.getElementById("wrapper");
var toggleButton = document.getElementById("menu-toggle");

toggleButton.onclick = function () {
  el.classList.toggle("toggled");
};

const verServicio = (id) => {
  window.location.href = `detallesServicio.php?id=${id}`;
};
