var el = document.getElementById("wrapper");
var toggleButton = document.getElementById("menu-toggle");

toggleButton.onclick = function () {
  el.classList.toggle("toggled");
};

function buscador() {
  let key = document.getElementById("key").value;
  let html = "";
  if (key.length == 0) {
    document.getElementById("clienteInfo").innerHTML = "";
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
              html += `
              <div class="card">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-8 mt-2">
                            <p>Nombre del cliente: ${element.nom_clie}. RFC del cliente: ${element.rfc}. Razon social del cliente  ${element.razon_social}</p>
                        </div>
                        <div class="col-md-4 mt-2">
                            <button class="btn btn-primary"  onclick="infoClient('${element.id_clie}', '${element.nom_clie}', '${element.rfc}', '${element.razon_social}', '${element.nom_con}', '${element.num_con}')" >Seleccionar</button>
                        </div>
                    </div>
                </div>
            </div><br/>`;
            } else {
                document.getElementById(
                    "clienteInfo"
                    ).innerHTML = `Sin informacion`;
                }
            document.getElementById("clienteInfo").innerHTML = html; 
        });
      },
      error: function (error) {
        console.log(error);
      },
    });
  }
}

function buscador_dire() {
  let key_dire = document.getElementById("key_dire").value;
  let html = "";
  if (key_dire.length == 0) {
    document.getElementById("direInfo").innerHTML = "";
  } else {
    $.ajax({
      type: "POST",
      url: "./back/buscarDirecciones.php",
      data: {
        key: key_dire,
      },
      async: true,
      beforeSend: function () {},
      success: function (response) {
        response.forEach((element) => {
          if (element.resultado == true) {
            html += `
            <div class="card">
                <div class="card-body">  
                    <div class="row g-3">
                        <div class="col-md-8 mt-2">
                            <p>Estado: ${element.estado}. Municipio: ${element.municipio}. Colonia: ${element.colonia}. Calle: ${element.calle}. Num_ext: ${element.num_ext}. Num_int: ${element.num_int}.</p>
                        </div>
                        <div class="col-md-4 mt-2">
                            <button class="btn btn-primary" onclick="infoDire('${element.id_dire}', '${element.estado}', '${element.municipio}', '${element.colonia}', '${element.calle}', '${element.num_ext}', '${element.num_int}', '${element.cp}')" >Seleccionar</button>
                        </div>
                    </div>
                </div>
            </div><br/>`;
          } else {
            document.getElementById("direInfo").innerHTML = `Sin informacion`;
          }
        });
        document.getElementById("direInfo").innerHTML = html;
      },
      error: function (error) {
        console.log(error);
      },
    });
  }
}


function infoClient(id, nomClie, rfc, razSoc, nom_con, num_con) {
    document.getElementById('infoClient').innerHTML = `
    <li class="list-group-item" style = "background-color: white;"><strong>Nombre:</strong> ${nomClie}. <strong>RFC:</strong> ${rfc}</li>
    <li class="list-group-item" style = "background-color: white;"><strong>Razon Social:</strong> ${razSoc}. <strong>Nombre Contacto:</strong> ${nom_con}</li>
    <li class="list-group-item" style = "background-color: white;"><strong>Numero Contacto:</strong> ${num_con}</li>
    `;
    document.getElementById('id_clie').value = id;
}

function infoDire(id, estado, municipio, colonia, calle, num_ext, num_int, cp){
    document.getElementById('infoDire').innerHTML = `
    <li class="list-group-item" style = "background-color: white;"><strong>Estado:</strong> ${estado}. <strong>Municipio:</strong> ${municipio}.</li>
    <li class="list-group-item" style = "background-color: white;"><strong>Colonia:</strong> ${colonia}. <strong>Calle:</strong> ${calle}.</li>
    <li class="list-group-item" style = "background-color: white;"><strong>Núm Ext:</strong> ${num_ext}. <strong>Núm Int:</strong> ${num_int}. <strong>Código Postal:</strong> ${cp}</li>
    `;
    document.getElementById('id_dire').value = id;
}

formularioADDServicio.addEventListener("submit", (e) =>  {
    e.preventDefault();
    let id_clie = document.getElementById('id_clie').value; 
    let id_dire = document.getElementById('id_dire').value;
    let num_san = document.getElementById('num_san').value;
    let cost_unit = document.getElementById('cost_unit').value;
    let cost_tot = document.getElementById('cost_tot').value;
    let tip_pag = document.getElementById('tip_pag').value;  
    let dia_de_pag = document.getElementById('dia_de_pag').value;
    /* variables de checkbox */
    let CheckboxL = document.getElementById('CheckboxL').checked;
    let CheckboxM = document.getElementById('CheckboxM').checked;
    let CheckboxMI = document.getElementById('CheckboxMI').checked;
    let CheckboxJ = document.getElementById('CheckboxJ').checked;
    let CheckboxV = document.getElementById('CheckboxV').checked;
    let CheckboxS = document.getElementById('CheckboxS').checked;
    let CheckboxD = document.getElementById('CheckboxD').checked;
    /* variables de consideraciones */
    let hora_aten = document.getElementById('hora_aten').value;
    let obser = document.getElementById('obser').value;  
    
    let error = [];

    if(id_clie.length == 0){
          Mensaje("Debe de seleccionar un cliente", "danger");
      error.push("You don't select any costv  mer");
    }

      if(id_dire.length == 0){
          Mensaje("Debe de seleccionar una direccion", "danger");
      error.push("You don't select any location");
    }

    let dias = {};

    //Validar checkbox
    if(!CheckboxL && !CheckboxM && !CheckboxMI && !CheckboxJ && !CheckboxV && !CheckboxS && !CheckboxD){
        Mensaje("Debe de seleccionar por lo menos un dia de pago", "danger");
        error.push("You don't select any checkbox");
    }else {
      (CheckboxL ?  Object.assign(dias, {Lunes: true})  : null);
      (CheckboxM ?  Object.assign(dias, {Martes: true}) : null);
      (CheckboxMI ? Object.assign(dias, {Miercoles: true}) : null);
      (CheckboxJ ? Object.assign(dias, {Jueves: true}) : null);
      (CheckboxV ? Object.assign(dias, {Viernes: true}) : null);
      (CheckboxS ? Object.assign(dias, {Sabado: true}) : null);
      (CheckboxD ? Object.assign(dias, {Domingo: true}) : null);
    }

    if(num_san.length == 0){
        Mensaje("Debe de ingresar un numero de sanitarios a rentar", "danger");
        error.push("Without numbers sanitarios");
    }

    if(cost_unit.length == 0){
        Mensaje("Debe de ingresar el costo unitario", "danger");
        error.push("Without unit cost");
    }

    if(tip_pag.length == 0){
        Mensaje("Debe seleccionar el tipo de pago", "danger");
        error.push("Without kind of pay");
    }

    if(dia_de_pag.length == 0){
        Mensaje("Debe de seleccionar el dia de pago", "danger");
        error.push("You don't select a day of pay");
    }

    if(error.length > 0){
        Mensaje("Campos vacio, favor de revisar que los campos esten correctamente llenos", "danger");
    }else{
      $.ajax({
        type: "POST",
        url: "./back/insert_servicio.php",
        data: {
          id_clie: id_clie,
          id_dire: id_dire,
          num_san: num_san,
          cost_unit: cost_unit,
          cost_tot: cost_tot, 
          tip_pag: tip_pag, 
          dia_de_pag: dia_de_pag,
          diasServicio: dias,
          hora_aten: hora_aten,
          obser: obser 
        },
        async: true,
        beforeSend: function () {},
        success: function (response) {
          Swal.fire(
            'Alerta',
            `${response.mensaje}`,
            'success'
          )
        },
        error: function (error) {
          console.log(error);
        },
      });
    }
});


const calcularTotal = () => {
      let costTotal = document.getElementById('num_san').value * document.getElementById('cost_unit').value;
      document.getElementById('cost_tot').value = costTotal;
}

const Mensaje = (mensaje, color) => {
  document.getElementById('mensaje').innerHTML = `  
  <div class="alert alert-${color} alert-dismissible">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong>¡Aviso!</strong> ${mensaje}.
  </div>
  `
}