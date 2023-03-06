$(document).ready(function () {
    //$("#datatable").DataTable();
    $("#tableBitRea").DataTable({
      ajax: {
        url: "./back/getListBitSerRea.php",
      },
      deferRender: true,
      scrollY: true,
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
          data: "servicio",
        },
        {
          data: "cliente",
        },
        {
          data: "sanitario",
        },
        {
          data: "operador",
        },
        {
          data: "fecha",
        },
        {
          data: "id_bit",
          bSortable: false,
          mRender: function (data, type, row) {
            return `<div class="btn-group" role="group" aria-label="Basic example">
               <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalEvidencia" title="Ver Evidencia" onclick="showEvidencia('${row.evidencia}', '${row.comentario}')" ><i class="fas fa-camera" ></i></button>
             </div>`;
          },
        },
      ],
      buttons: [
        {
          extend: "excelHtml5",
          title: "Bitacora de servicios realizados",
          text: '<i class="fas fa-file-excel"></i>',
          className: "btn-sm",
        },
        {
          extend: "csvHtml5",
          title: "Bitacora de servicios realizados",
          text: '<i class="fa-solid fa-file-csv"></i>',
          className: "btn-sm",
        },
        {
          extend: "pdfHtml5",
          title: "Bitacora de servicios realizados",
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
          title: "Bitacora de servicios realizados",
          className: "btn-sm",
          text: '<i class="fa-solid fa-print"></i>',
          footer: "true",
          exportOptions: {
            columns: ":visible",
          },
        },
        {
          extend: "copy",
          title: "Bitacora de servicios realizados",
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
  
const  showEvidencia = (evi, coment) =>{
  document.getElementById("evidenciaSerReaBit").innerHTML = `
  <img src="../../static/img/evidenciasBitacoras/${evi}" alt="" srcset="" class="img-fluid"> 
  <p>${coment}</p> 
  `;

}