window.addEventListener("load", () => {
  get_infoSanBySer();
});
var el = document.getElementById("wrapper");
var toggleButton = document.getElementById("menu-toggle");
toggleButton.onclick = function () {
  el.classList.toggle("toggled");
};
var queryString = window.location.search;
var urlParams = new URLSearchParams(queryString);
var id = urlParams.get("id");
var cliente = urlParams.get("cliente");
var sanSol = urlParams.get("sanSol");
document.getElementById(
  "infoServ"
).innerHTML = `<strong>Nombre del cliente:</strong> ${cliente}`;
const get_infoSanBySer = () => {
  $.ajax({
    type: "POST",
    url: "./back/get_listSanByServ.php",
    data: {
      id_ser: id,
    },
    async: true,
    beforeSend: function () {},
    success: function (response) {
      let html = "";
      document.getElementById(
        "tittleSanAsig"
      ).innerHTML = `Sanitarios asignados ${response.totalRe} de ${sanSol}`;
      if (response.totalRe >= sanSol) {
        document.getElementById("btnAddSan").setAttribute("disabled", "");
      } else {
        document.getElementById("btnAddSan").removeAttribute("disabled", "");
      }
      response.data.map((element) => {
        console.log(element);
        if (element.estatus_sesa == "FINALIZADO") {
          html += `
            <div class="col-md-4 mt-12">
              <div class="card">
                <img src="../../static/img/sanitarioServ.png" style="width: 150px; height: 180px;" loading="lazy" class="card-img-top img-fluid" alt="sanitario-${element.num_san}-${element.tipo}">
                <div class="card-body">
                  <div>
                    <p class="card-text"><strong>Tipo de Sanitario</strong> ${element.tipo} <br>
                    <p class="card-text"><strong>Numero de sanitario asignado:</strong> ${element.num_san} <br>
                      <small class="card-text">Esto lo debe asignar el encargado del almacen</small>
                    </p>
                    <div>
                      <p><strong>Direccion de entrega:</strong>${element.direccionEntrega}</p>
                    </div>
                  <div style="display: flex; justify-content: right;">
                  <button class="btn btn-danger btn-sm" disabled onclick="removeSanInfo(${element.id_sersan} )">Remover <i class="fas fa-trash"></i></button>
                </div>
              </div>
                </div>
              </div>
            </div>`;
        }
        if (element.estatus_sesa == "ACTIVO") {
          html += `
            <div class="col-md-4 mt-12">
              <div class="card">
                <img src="../../static/img/sanitarioServ.png" style="width: 150px; height: 180px;" loading="lazy" class="card-img-top img-fluid" alt="sanitario-${element.num_san}-${element.tipo}">
                <div class="card-body">
                  <div>
                    <p class="card-text"><strong>Tipo de Sanitario</strong> ${element.tipo} <br>
                    <p class="card-text"><strong>Numero de sanitario asignado:</strong> ${element.num_san} <br>
                      <small class="card-text">Esto lo debe asignar el encargado del almacen</small>
                    </p>
                    <div>
                    <p><strong>Direccion de entrega:</strong>${element.direccionEntrega}</p>
                  </div>
                  <div style="display: flex; justify-content: right;">
                  <button class="btn btn-danger btn-sm" onclick="removeSanInfo(${element.id_sersan} )">Remover <i class="fas fa-trash"></i></button>
                </div>
              </div>
                </div>
              </div>
            </div>`;
        }
      });
      document.getElementById("infoSanAsig").innerHTML = html;
    },
    error: function (error) {
      console.log(error);
    },
  });
};

function removeSanInfo(id) {
  $.ajax({
    type: "POST",
    url: "./back/removeSanBySer.php",
    data: {
      id: 0,
      id_ser: 0,
      id_sersan: id,
      tipo: "REMOVERINFO",
    },
    async: true,
    beforeSend: function () {},
    success: function (response) {
      if (response.resultado == true) {
        get_infoSanBySer();
        Swal.fire({
          title: "Alerta",
          text: `${response.mensaje}`,
          icon: "success",
          confirmButtonText: "Aceptar",
        });
      }
    },
    error: function (error) {
      console.log(error);
    },
  });
}

formularioADDInfoSanServ.addEventListener("submit", (e) => {
  e.preventDefault();
  let tip_san = document.getElementById("tip_san").value;
  let idDire = document.getElementById("idDir").value;
  if (idDire.length == 0 && tip_san.length == 0) {
    Swal.fire({
      title: "Alerta",
      text: `Todos los campos vacios`,
      confirmButtonText: "Aceptar",
    });
  } else {
    $.ajax({
      type: "POST",
      url: "./back/insert_sanser.php",
      data: {
        id_ser: id,
        idDire: idDire,
        tipo: tip_san,
      },
      async: true,
      beforeSend: function () {},
      success: function (response) {
        if (response.resultado == true) {
          get_infoSanBySer();
          $("#modalADDSAN").modal("hide");
          document.getElementById("formularioADDInfoSanServ").reset();
          Swal.fire({
            title: "Alerta",
            text: `${response.mensaje}`,
            confirmButtonText: "Aceptar",
          });
        } else {
          get_infoSanBySer();
          $("#modalADDSAN").modal("hide");
          document.getElementById("formularioADDInfoSanServ").reset();
          Swal.fire({
            title: "Alerta",
            text: `${response.mensaje}`,
            icon: "error",
            confirmButtonText: "Aceptar",
          });
        }
      },
      error: function (error) {
        console.log(error);
      },
    });
  }
});

function finalizarServ() {
  Swal.fire({
    title: "¿Desea finalizar servicio?",
    text: "Al aceptar se liberaran los sanitarios y no podras hacer mas modificaciones",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Aceptar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: "./back/finalizarServicio.php",
        data: {
          id_ser: id,
        },
        async: true,
        beforeSend: function () {},
        success: function (response) {
          if (response.resultado == true) {
            get_infoSanBySer();
            Swal.fire("Alerta", `${response.mensaje}`, "success");
          } else {
            get_infoSanBySer();
            Swal.fire("Alerta", `${response.mensaje}`, "success");
          }
        },
        error: function (error) {
          console.log(error);
        },
      });
      /* poner el ajax */
    }
  });
}

function buscadorInfoDireClie() {
  let key_dire = document.getElementById("buscarDir").value;
  let html = "";
  if (key_dire.length == 0) {
    document.getElementById("mensajeBusDire").innerHTML = ``;
    document.getElementById("dirEst").value = "";
    document.getElementById("dirMun").value = "";
    document.getElementById("dirCol").value = "";
    document.getElementById("dirCalle").value = "";
    document.getElementById("dirNumExt").value = "";
    document.getElementById("dirNumInt").value = "";
    document.getElementById("dirCP").value = "";
    document.getElementById("idDir").value = "";
    document.getElementById("coord").value = "";
  } else {
    $.ajax({
      type: "POST",
      url: "../servicios/back/buscarDirecciones.php",
      data: {
        key: key_dire,
      },
      async: true,
      beforeSend: function () {},
      success: function (response) {
        response.forEach((element) => {
          if (element.resultado == true) {
            document.getElementById("dirEst").value = `${element.estado}`;
            document.getElementById("dirMun").value = `${element.municipio}`;
            document.getElementById("dirCol").value = `${element.colonia}`;
            document.getElementById("dirCalle").value = `${element.calle}`;
            document.getElementById("dirNumExt").value = `${element.num_ext}`;
            document.getElementById("dirNumInt").value = `${element.num_int}`;
            document.getElementById("dirCP").value = `${element.cp}`;
            document.getElementById("idDir").value = `${element.id_dire}`;
            document.getElementById("coord").value = `${element.coordenadas}`;
          } else {
            document.getElementById(
              "mensajeBusDire"
            ).innerHTML = ` <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>¡Alerta!</strong> No se pudo encontrar informacion de la direccion.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>`;
            document.getElementById("dirEst").value = "";
            document.getElementById("dirMun").value = "";
            document.getElementById("dirCol").value = "";
            document.getElementById("dirCalle").value = "";
            document.getElementById("dirNumExt").value = "";
            document.getElementById("dirNumInt").value = "";
            document.getElementById("dirCP").value = "";
            document.getElementById("idDir").value = "";
            document.getElementById("coord").value = "";
          }
        });
      },
      error: function (error) {
        console.log(error);
      },
    });
  }
}
