$(document).ready(function () {
  //$("#datatable").DataTable();
  $("#tableListSer").DataTable({
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
        data: "num_ser",
      },
      {
        data: "tip_ser",
      },
      {
        data: "num_san",
      },
      {
        data: "cliente",
      },
      {
        data: "direccion_entrega",
      },
      {
        data: "fec_ent",
      },
      {
        data: "hor_ent",
      },
      {
        data: "cost_ser",
      },
      {
        data: "tip_pag",
      },
      {
        data: "dia_pag",
      },
      {
        data: "conct_pag",
      },
      {
        data: "tel_conpag",
      },
      {
        data: "cor_conpag",
      },
      {
        data: "nom_conrec",
      },
      {
        data: "tel_conrec",
      },
      {
        data: "cotizacion",
        mRender: function(data) {
          if(data == null){
            return `No hay archivo`
          }else{
            return `<a target="_blank" href='./back/docs/cotizaciones/${data}' class = "btn btn-primary btn-sm">Ver <i class="fas fa-file"></i></a>`
          }
        }
      },
      {
        data: "sit_fis",
        mRender: function(data) {
          if(data == null){
            return `No hay archivo`
          }else{
            return `<a target="_blank" href='./back/docs/situacionFiscal/${data}' class = "btn btn-primary btn-sm">Ver <i class="fas fa-file"></i></a>`
          }
        }
      },
      {
        data: "obser",
      },
      {
        mRender: function (data, type, row) {
          return `<p style = "text-align: center; margin: 0px; padding: 2px; border-radius: 5px; background-color: ${row.color};">${row.estatus}</p>`;
        },
      },
      {
        data: "id_ser",
        bSortable: false,
        mRender: function (data, type, row) {
          return `
          <div class="dropdown"><a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">OPCIONES</a>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ModalUploadDoc" onclick = "sendInfDocs('${row.rfc_clie}', ${data})">Subir Documentos</a></li>
            <li><a class="dropdown-item" href="#">Agregar Sanitarios</a></li>
            <li><a class="dropdown-item" href="#">Editar</a></li>
            <li><a class="dropdown-item" href="#">Eliminar</a></li>
          </ul>
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

const sendInfDocs = (rfc, id) => {
  document.getElementById('rfcUploadDoc').value = rfc;
  document.getElementById('idUploadDoc').value = id;


}

/* formularioUploadDoc.addEventListener('submit', e =>{
e.preventDefault();
const data = Object.fromEntries(new FormData(e.target))

console.log(data.docCot.name);
}); */