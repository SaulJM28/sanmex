var el = document.getElementById("wrapper");
var toggleButton = document.getElementById("menu-toggle");

toggleButton.onclick = function () {
  el.classList.toggle("toggled");
};

function getLisTipSer() {
  fetch("../tiposServicios/back/tiposServicios.php")
    .then(response => {
      if (response.ok) {
        return response.json();
      } else {
        throw new Error('Error en la respuesta de la API');
      }
    })
    .then(data => {
      // Hacer algo con los datos de la API
      let html = `<option value = "" selected>SELECCIONE EL TIPO DE SERVICIO</option>`;
      data.data.forEach(element => {
        if(element.tipo != 'LIMPIEZA SANITARIOS'){
          html += `<option value = "${element.tipo}" >${element.tipo}</option>`;
        }
      });
      document.getElementById("tipSer").innerHTML = html;
    })
    .catch(error => {
      // Manejar el error en caso de que ocurra
      console.error(error);
    });
  }
  getLisTipSer();

function buscadorInfoCliente() {
  let key = document.getElementById("buscarCli").value;
  let html = "";
  if (key.length == 0) {
    document.getElementById("mensajeBusClie").innerHTML = ``;
    document.getElementById("nomCli").value = "";
    document.getElementById("rfcCli").value = "";
    document.getElementById("razoSocCli").value = "";
    document.getElementById("idCli").value = "";
    document.getElementById("nomCli").value = "";
    document.getElementById("rfcCli").value = "";
    document.getElementById("razoSocCli").value = "";
    document.getElementById("idCli").value = "";
    document.getElementById("dirEst").value = "";
    document.getElementById("dirMun").value = "";
    document.getElementById("dirCol").value = "";
    document.getElementById("dirCalle").value = "";
    document.getElementById("dirNumExt").value = "";
    document.getElementById("dirNumInt").value = "";
    document.getElementById("dirCP").value = "";
  } else {
    $.ajax({
      type: "POST",
      url: "./back/buscarClientes.php",
      data: {
        key: key,
      },
      async: true,
      beforeSend: function () {},
      success: function (response) {
        response.forEach((element) => {
          if (element.resultado == true) {
            document.getElementById("nomCli").value = `${element.nom_clie}`;
            document.getElementById("rfcCli").value = `${element.rfc}`;
            document.getElementById("idCli").value = `${element.id_clie}`;
            document.getElementById(
              "razoSocCli"
            ).value = `${element.razon_social}`;
            document.getElementById("dirEst").value = `${element.estado}`;
            document.getElementById("dirMun").value = `${element.municipio}`;
            document.getElementById("dirCol").value = `${element.colonia}`;
            document.getElementById("dirCalle").value = `${element.calle}`;
            document.getElementById("dirNumExt").value = `${element.num_ext}`;
            document.getElementById("dirNumInt").value = `${element.num_int}`;
            document.getElementById("dirCP").value = `${element.cp}`;
          } else {
            document.getElementById(
              "mensajeBusClie"
            ).innerHTML = ` <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>¡Alerta!</strong> No se pudo encontrar informacion del cliente.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`;
            document.getElementById("nomCli").value = "";
            document.getElementById("rfcCli").value = "";
            document.getElementById("razoSocCli").value = "";
            document.getElementById("idCli").value = "";
            document.getElementById("dirEst").value = "";
            document.getElementById("dirMun").value = "";
            document.getElementById("dirCol").value = "";
            document.getElementById("dirCalle").value = "";
            document.getElementById("dirNumExt").value = "";
            document.getElementById("dirNumInt").value = "";
            document.getElementById("dirCP").value = "";
          }
        });
      },
      error: function (error) {
        console.log(error);
      },
    });
  }
}

formularioADDServicio.addEventListener("submit", (e) => {
  e.preventDefault();
  let idCli = document.getElementById("idCli").value;
  let tipSer = document.getElementById("tipSer").value;
  let fecEnt = document.getElementById("fecEnt").value;
  let horEnt = document.getElementById("horEnt").value;
  let cosSer = document.getElementById("cosSer").value;
  let tipPag = document.getElementById("tipPag").value;
  let conctPag = document.getElementById("conctPag").value;
  let telConPag = document.getElementById("telConPag").value;
  let corConPag = document.getElementById("corConPag").value;
  let NomConRec = document.getElementById("NomConRec").value;
  let telConRec = document.getElementById("telConRec").value;
  let diaPag = document.getElementById("diaPag").value;
  let dirEst = document.getElementById("dirEntEst").value;
  let dirMun = document.getElementById("dirEntMun").value;
  let dirCol = document.getElementById("dirEntCol").value;
  let dirCalle = document.getElementById("dirEntCalle").value;
  let dirNumExt = document.getElementById("dirEntNumExt").value;
  let dirNumInt = document.getElementById("dirEntNumInt").value;
  let dirCP = document.getElementById("dirEntCP").value;
  let coord = document.getElementById("dirEntCoord").value;
  let obser = document.getElementById("obser").value;

  if (tipSer.length == 0) {
    Swal.fire("Alerta", "Campo Tipo de Servicio Vacio ", "warning");
   } else if (fecEnt.length == 0) {
    Swal.fire("Alerta", "Campo Fecha de Entrega Vacio ", "warning");
  } else if (horEnt.length == 0) {
    Swal.fire("Alerta", "Campo Hora de Entrega Vacio ", "warning");
  } else if (cosSer.length == 0) {
    Swal.fire("Alerta", "Campo Costo de Servicio Vacio ", "warning");
  } else if (tipPag.length == 0) {
    Swal.fire("Alerta", "Campo Tipo de Pago Vacio ", "warning");
  } else if (conctPag.length == 0) {
    Swal.fire("Alerta", "Campo Contacto de Pago Vacio ", "warning");
  } else if (telConPag.length == 0) {
    Swal.fire("Alerta", "Campo Telefono Contacto de Pago Vacio ", "warning");
  } else if (corConPag.length == 0) {
    Swal.fire("Alerta", "Campo Correo Contacto de Pago Vacio ", "warning");
  } else if (NomConRec.length == 0) {
    Swal.fire("Alerta", "Campo Nombre Contacto que Recibe Vacio ", "warning");
  } else if (telConRec.length == 0) {
    Swal.fire("Alerta", "Campo Telefono Contacto que Recibe Vacio ", "warning");
  } else if (diaPag.length == 0) {
    Swal.fire("Alerta", "Campo Dia de Pago Vacio ", "warning");
  } else if (dirEst.length == 0) {
    Swal.fire("Alerta", "Campo Dia de Pago Vacio ", "warning");
  } else if (dirMun.length == 0) {
    Swal.fire("Alerta", "Campo Dia de Pago Vacio ", "warning");
  } else if (dirCol.length == 0) {
    Swal.fire("Alerta", "Campo Dia de Pago Vacio ", "warning");
  } else if (dirCalle.length == 0) {
    Swal.fire("Alerta", "Campo Dia de Pago Vacio ", "warning");
  } else if (dirNumExt.length == 0) {
    Swal.fire("Alerta", "Campo Dia de Pago Vacio ", "warning");
  } else if (dirNumInt.length == 0) {
    Swal.fire("Alerta", "Campo Dia de Pago Vacio ", "warning");
  } else if (dirCP.length == 0) {
    Swal.fire("Alerta", "Campo Dia de Pago Vacio ", "warning");
  } else if (obser.length == 0) {
    Swal.fire("Alerta", "Campo Observaciones Vacio ", "warning");
  } else {
    $.ajax({
      type: "POST",
      url: "./back/insert_servicio_varios.php",
      data: {
        id_clie: idCli,
        tipSer: tipSer,
        fecEnt: fecEnt,
        horEnt: horEnt,
        cosSer: cosSer,
        tipPag: tipPag,
        conctPag: conctPag,
        telConPag: telConPag,
        corConPag: corConPag,
        NomConRec: NomConRec,
        telConRec: telConRec,
        diaPag: diaPag,
        dirEst: dirEst,
        dirMun: dirMun,
        dirCol: dirCol,
        dirCalle: dirCalle,
        dirNumExt: dirNumExt,
        dirNumInt: dirNumInt,
        dirCP: dirCP,
        coord: coord,
        obser: obser,
      },
      async: true,
      beforeSend: function () {},
      success: function (response) {
        if (response.resultado == true) {
          Swal.fire("Alerta", `${response.mensaje}`, "success");
          window.location.href = `${response.url}`;
        } else {
          Swal.fire("Alerta", `${response.mensaje}`, "error");
        }
      },
      error: function (error) {
        console.log(error);
      },
    });
  }
});

const map = L.map("map").setView([20.57237122303309, -100.28431903160978], 15);
const popup = L.popup();

const tiles = L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
  maxZoom: 19,
  attribution:
    '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
}).addTo(map);
function onMapClick(e) {
  document.getElementById(
    "dirEntCoord"
  ).value = `${e.latlng.lat},${e.latlng.lng}`;
  popup
    .setLatLng(e.latlng)
    .setContent(`You clicked the map at ${e.latlng.toString()}`)
    .openOn(map);
}
map.on("click", onMapClick);
