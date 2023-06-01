var el = document.getElementById("wrapper");
var toggleButton = document.getElementById("menu-toggle");

toggleButton.onclick = function () {
  el.classList.toggle("toggled");
};

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

const listSanDisp = async () => {
  try {
    const res = await fetch("../sanitarios/back/getSanNumDisp.php");
    const data = await res.json();
    let listaHtml = "";
    data.forEach((element) => {
      listaHtml += `
          <li class="list-group-item bg-white d-flex justify-content-between align-items-center">${element.tip_san} <span class="badge bg-primary rounded-pill">${element.total}</span></li>
          `;
    });
    listaHtml += `
      <li class="list-group-item bg-white d-flex justify-content-between align-items-center">Ver lista completa  <button class = "btn btn-info btn-sm" >Ir <i class='fas fa-arrow-right'></i></button></li>
      `;
    document.getElementById("listSanDisp").innerHTML = listaHtml;
  } catch (e) {
    console.log(e);
  }
};
listSanDisp();

formularioADDServicio.addEventListener("submit", (e) => {
  e.preventDefault();
  let idCli = document.getElementById("idCli").value;
  let tipSer = document.getElementById("tipSer").value;
  let numSan = document.getElementById("numSan").value;
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
/*   let dirEst = document.getElementById("dirEst").value;
  let dirMun = document.getElementById("dirMun").value;
  let dirCol = document.getElementById("dirCol").value;
  let dirCalle = document.getElementById("dirCalle").value;
  let dirNumExt = document.getElementById("dirNumExt").value;
  let dirNumInt = document.getElementById("dirNumInt").value;
  let dirCP  = document.getElementById("dirCP").value; */
  let obser = document.getElementById("obser").value;

  if (tipSer.length == 0) {
    Swal.fire("Alerta", "Campo Tipo de Servicio Vacio ", "warning");
  } else if (numSan.length == 0) {
    Swal.fire("Alerta", "Campo Numeros de Sanitarios Vacio ", "warning");
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
  } else if (obser.length == 0) {
    Swal.fire("Alerta", "Campo Observaciones Vacio ", "warning");
  } else {
    $.ajax({
      type: "POST",
      url: "./back/insert_servicio.php",
      data: {
        id_clie: idCli,
        tipSer: tipSer,
        numSan: numSan,
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
/*         dirEst: dirEst,
        dirMun: dirMun,
        dirCol: dirCol,
        dirCalle: dirCalle,
        dirNumExt: dirNumExt,
        dirNumInt: dirNumInt,
        dirCP: dirCP, */
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
