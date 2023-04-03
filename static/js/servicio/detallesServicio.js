window.addEventListener("load", () => {
  get_datos();
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

if(tipo == "ALMACENISTA"){
  document.getElementById("formularioADDInfoSanServ").classList.add("ocultar");
  document.getElementById("divAddSan").classList.add("ocultar");
}

if(tipo == "VENDEDOR"){
  document.getElementById("formularioADDSanServ").classList.add("ocultar");
}

const get_datos = () => {
  $.ajax({
    type: "POST",
    url: "./back/get_servicioDetalleById.php",
    data: {
      id_ser: id,
    },
    async: true,
    beforeSend: function () {},
    success: function (response) {

      if(tipo == "ALMACENISTA"){
        document.getElementById("viewVendedor").classList.add("ocultar");
      }

      if(tipo == "VENDEDOR"){
        document.getElementById("viewAlmacenista").classList.add("ocultar");
      }


      /* informacion del cliente */
      document.getElementById("nom_clie").value = response.cliente.nom_clie;
      document.getElementById("raz_soc").value = response.cliente.razon_social;
      document.getElementById("rfc").value = response.cliente.rfc;
      document.getElementById("nom_con").value = response.cliente.nom_con;
      document.getElementById("num_con").value = response.cliente.num_con;
      /* informacion de la direccion */
      document.getElementById("datosDireccion").innerHTML = `
      <div class="row g-0">
      <div class="col-md-4">
          <iframe width="100%" height="100%" frameborder="0" scrolling="no"
              marginheight="0" marginwidth="0" loading="lazy"
              src="https://maps.google.com/maps?width=100%25&amp;height=100%&amp;hl=es&amp;q=${response.direccion.coordenadas}&amp;t=&amp;z=15&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
      </div>
      <div class="col-md-8">
          <div class="card-body">
              <h5 class="card-title">Direccion del Cliente ${response.cliente.nom_clie}</h5>
              <p class="card-text"><strong>Estado:</strong> ${response.direccion.estado}.</p> 
              <p class="card-text"><strong>Municipio:</strong> ${response.direccion.municipio}.</p>  
              <p class="card-text"><strong>Colonia:</strong> ${response.direccion.colonia}.</p> 
              <p class="card-text"><strong>Calle:</strong> ${response.direccion.calle}.</p> 
              <p class="card-text"><strong>Número Exterior:</strong> ${response.direccion.num_ext}.</p>  
              <p class="card-text"><strong>Número Int:</strong> ${response.direccion.num_int}.</p>  
              <p class="card-text"><strong>CP:</strong> ${response.direccion.cp}.</p> 
          </div>
      </div>
  </div>
      `;
      /* informacion del servicio */
      document.getElementById("id_ser").value = response.id_ser;
      document.getElementById("num_sans").value = response.num_san;
      document.getElementById("cost_unit").value = response.cost_unit;
      document.getElementById("cost_tot").value = response.cost_tot;
      document.getElementById("tip_pag").value = response.tip_pag;
      document.getElementById("dia_pag").value = response.dia_de_pag;
      document.getElementById("dias_serv").value = response.dias_serv;
      document.getElementById("operador").value = response.operador;
      document.getElementById("ruta").value = response.ruta;
    },
    error: function (error) {
      console.log(error);
    },
  });
};

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
      let totalAllenar = document.getElementById("num_sans").value;

      if(tipo == "ALMACENISTA" || tipo == "ADMINISTRADOR"){
        if (response.totalRe >= totalAllenar) {
          document
            .getElementById("btnAddSan")
            .setAttribute("disabled", "disabled");
        }
      }

      if(tipo == "VENDEDOR" || tipo == "ADMINISTRADOR"){
        if (response.totalRe >= totalAllenar) {
          document
            .getElementById("btnAddSan")
            .setAttribute("disabled", "disabled");
          document
            .getElementById("btnADDInfoSan")
            .setAttribute("disabled", "disabled");
        }
      }

      document.getElementById(
        "tittleSanAsig"
      ).innerHTML = `Informacion de los sanitarios asignados ${response.totalRe} de ${totalAllenar}`;
      let html = "";
      response.data.map((element) => {
        if (element.estatus == "FINALIZADO") {
          vendedor = "";
          almacenista = "";
          if (tipo == "ADMINISTRADOR" || tipo == "VENDEDOR") {
            vendedor = `
            <div>
              <p class="card-text"><strong>Tipo de sanitario:</strong> ${element.tipo}</p>
              <p class="card-text"><strong>Costo de renta:</strong>$ ${element.costo}</p>
                <div style="display: flex; justify-content: right;">
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" disabled data-bs-target="#modalREMOVESAN" onclick="removeSan(${element.num_san})">Remover <i class="fas fa-times"></i></button>
                </div>
            </div>`;
          }
          if (tipo == "ADMINISTRADOR" || tipo == "ALMACENISTA") {
            almacenista = `
            <div>
              <p class="card-text"><strong>Numero de sanitario:</strong> ${element.num_san}</p>
              <div style="display: flex; justify-content: right;">
                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" disabled data-bs-target="#modalREMOVESAN" onclick="removeSan(${element.num_san})">Remover <i class="fas fa-times"></i></button>
              </div>
            </div>`;
          }
          html += `
          <div class="col-md-4 mt-12">
            <div class="card">
              <img src="../../static/img/sanitarioServ.png" style="width: 150px; height: 180px;" loading="lazy" class="card-img-top img-fluid" alt="sanitario-${element.num_san}-${element.tipo}">
              <div class="card-body">
                ${vendedor}
                ${almacenista}
              </div>
            </div>
          </div>`;
        } else {
          vendedor = "";
          almacenista = "";
          if (tipo == "ADMINISTRADOR" || tipo == "VENDEDOR") {
            vendedor = `
            <div>
              <p class="card-text"><strong>Tipo de sanitario:</strong> ${element.tipo}</p>
              <p class="card-text"><strong>Costo de renta:</strong>$ ${element.costo}</p>
                <div style="display: flex; justify-content: right;">
                    <button class="btn btn-danger btn-sm" onclick="removeSanInfo(${element.id_sersan})">Remover <i class="fas fa-trash"></i></button>
                </div>
            </div>`;
          }
          if (tipo == "ADMINISTRADOR" || tipo == "ALMACENISTA") {
            boton = `<button 
            class="btn btn-primary btn-sm" 
            data-bs-toggle="modal" 
            data-bs-target="#modalADDSAN" 
            onclick="addSan(${element.id_ser}, ${element.id_sersan})" 
            id = "hola">Agregar Sanitario <i class="fas fa-plus"></i></button>`;
            //validamos que ya se haya registrado un sanitario
            if (element.id_san != "Sin sanitario asignado") {
              boton = "";
            }
            almacenista = `
            <div>
              <p class="card-text"><strong>Numero de sanitario:</strong> ${element.num_san}</p>
              <div style="display: flex; justify-content: right;">
                <button class="btn btn-danger btn-sm" onclick="removeSan(${element.id_san}, ${element.id_ser})">Remover <i class="fas fa-trash"></i></button>
                ${boton}
              </div>
            </div>`;
          }
          html += `
          <div class="col-md-4 mt-12">
            <div class="card">
              <img src="../../static/img/sanitarioServ.png" style="width: 150px; height: 180px;" loading="lazy" class="card-img-top img-fluid" alt="sanitario-${element.num_san}-${element.tipo}">
              <div class="card-body">
                ${vendedor}
                ${almacenista}
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

function addSan(id_ser, id_sersan) {
  document.getElementById("id_serQr").value = id_ser;
  document.getElementById("id_sersan").value = id_sersan;
  html5QrcodeScanner.render(onScanSuccess);
}

function removeSanInfo(id) {
  $.ajax({
    type: "POST",
    url: "./back/removeSanBySer.php",
    data: {
      id: id,
      id_ser: 0,
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

function removeSan(id, id_ser) {
  $.ajax({
    type: "POST",
    url: "./back/removeSanBySer.php",
    data: {
      id: id,
      id_ser: id_ser,
      tipo: "REMOVERSAN",
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

/* ESCANEAR QR DE SANITARIO */
var html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", {
  fps: 10,
  qrbox: 200,
});

function onScanSuccess(decodedText, decodedResult) {
  html5QrcodeScanner.clear();
  $.ajax({
    type: "POST",
    url: "./back/disponibilidadSan.php",
    data: {
      id_san: decodedText,
    },
    async: true,
    beforeSend: function () {},
    success: function (response) {
      if (response.resultado == true) {
        $("#modalADDSAN").modal("hide");
        Swal.fire({
          title: "Alerta",
          text: `${response.mensaje}`,
          icon: "error",
          confirmButtonText: "Aceptar",
        });
      } else {
        $.ajax({
          type: "POST",
          url: "./back/get_sanitarioById.php",
          data: {
            num_san: decodedText,
          },
          async: true,
          beforeSend: function () {},
          success: function (response) {
            if (response.resultado == true) {
              Swal.fire({
                title: "Alerta",
                text: `Codigo Qr escaneado Correctamente`,
                icon: "success",
                confirmButtonText: "Aceptar",
              });
              document.getElementById("botonADDSan").disabled = false;
              document.getElementById("id_san").value = response.id_san;
              document.getElementById("num_san").value = response.num_san;
              document.getElementById("tip_sanQR").value = response.tip_san;
            } else {
              $("#modalADDSAN").modal("hide");
              Swal.fire({
                title: "Error!",
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
    },
    error: function (error) {
      console.log(error);
    },
  });
}




formularioADDInfoSanServ.addEventListener("submit", (e) => {
  e.preventDefault();
  let precio_san = document.getElementById("precio_san").value;
  let tip_san = document.getElementById("tip_san").value;
  let coord_san = document.getElementById("coord_san").value;
  if (precio_san.length == 0 && tip_san.length == 0 && coord_san.length == 0) {
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
        precio: precio_san,
        tipo: tip_san,
        coord: coord_san,
      },
      async: true,
      beforeSend: function () {},
      success: function (response) {
        if (response.resultado == true) {
          get_infoSanBySer();
          Swal.fire({
            title: "Alerta",
            text: `${response.mensaje}`,
            confirmButtonText: "Aceptar",
          });
        } else {
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

/* This function send data by method POST to file PHP */

formularioADDSanServ.addEventListener("submit", (e) => {
  e.preventDefault();
  let id_san = document.getElementById("id_san").value;
  let id_ser = document.getElementById("id_serQr").value;
  let id_sersan = document.getElementById("id_sersan").value;
  $.ajax({
    type: "POST",
    url: "./back/insert_sersan.php",
    data: {
      id_san: id_san,
      id_ser: id_ser,
      id_sersan: id_sersan,
    },
    async: true,
    beforeSend: function () {},
    success: function (response) {
      if (response.resultado == true) {
        $("#modalADDSAN").modal("hide");
        get_infoSanBySer();
        document.getElementById("id_san").value = "";
        document.getElementById("id_serQr").value = "";
        document.getElementById("id_sersan").value = "";
        document.getElementById("num_san").value = "";
        document.getElementById("tip_sanQR").value = "";
        Swal.fire({
          title: "Alerta",
          text: `${response.mensaje}`,
          confirmButtonText: "Aceptar",
        });
      } else {
        $("#modalADDSAN").modal("hide");
        get_infoSanBySer();
        document.getElementById("id_san").value = "";
        document.getElementById("id_serQr").value = "";
        document.getElementById("id_sersan").value = "";
        document.getElementById("num_san").value = "";
        document.getElementById("tip_sanQR").value = "";
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
