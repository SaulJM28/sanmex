let el = document.getElementById("wrapper");
let toggleButton = document.getElementById("menu-toggle");
let limite = 0;
let servicios = "";
let ultimoServicio;

toggleButton.onclick = function () {
  el.classList.toggle("toggled");
};

/* creamos el observador */
let observador = new IntersectionObserver(
  (entradas, observador) => {
    entradas.forEach((entrada) => {
      if (entrada.isIntersecting) {
        limite = limite + 10;
        cargarServicios();
      }
    });
  },
  {
    rootMargin: "0px 0px 200px 0px",
    threshold: 1.0,
  }
);

const cargarServicios = async () => {
  try {
    const respuesta = await fetch(
      `./back/getListServiciosOpeB.php?limite=${limite}&id_ope=${id_ope}`
    );
    // Si la respuesta es correcta
    if (respuesta.status === 200) {
      const datos = await respuesta.json();
      if (datos.resultado == false) {
        document.getElementById("contenedor").innerHTML += `<p class = "text-center">${datos.mensaje}<p>`;
      }
      if (datos.resultado == true) {
        datos.data.forEach((element) => {
          document.getElementById(
            "nomOpeList"
          ).innerHTML = `${element.nom_ope}`;
          if (element.estatus == "ACTIVO") {
            color = element.color;
            botones = `<div class="btn-group">
              <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#myModal" onclick = "agregarInfoInci(${element.id_ser}, '${element.num_ser}', '${element.cliente}' )">Incidencias</button>
              <button onclick="agregarInfoSerRea(${element.id_ser}, '${element.num_ser}', '${element.cliente}')" data-bs-toggle="modal" data-bs-target="#modalReaSer" class="btn btn-success btn-sm">Realizar Servicio</button>
            </div>`;
          } else if (element.estatus == "FINALIZADO") {
            color = element.color;
            botones = `Ya no puedes realizar limpiezas, el servcio ha terminado`;
          }
          servicios += `
                      <div class="card sombra" style = "margin-top: 10px; border-left: 5px solid  ${color}">
                          <div class="card-body">
                            <div class="d-flex justify-content-between">
                              <h5 class="card-title">Numero de servicio: ${element.num_ser}</h5>
                              <h5 class="card-title">Dias de servicio: ${element.num_ser}</h5>
                            </div>
                              <ul class="list-group">
                              <li class="list-group-item bg-white"><strong>Nombre del contacto:</strong>. ${element.nom_conrec}</li>
                              <li class="list-group-item bg-white"><strong>Telefono del contacto:</strong>. ${element.tel_conrec}</li>
                              <li class="list-group-item bg-white"><strong>Tipo de servicio:</strong>. ${element.tip_ser}</li>
                              <li class="list-group-item bg-white"><strong>Direccion:</strong>. ${element.direccion}</li>
                              <li class="list-group-item bg-white"><strong>Observaciones:</strong>. ${element.tip_ser}</li>
                            </ul>
                                  <div style="display: flex; justify-content: right">
                                      ${botones}
                                  </div>
                          </div>
                      </div>
          `;
        });
        document.getElementById("contenedor").innerHTML = servicios;

        if (limite <= datos.data[0].totalRe) {
          if (ultimoServicio) {
            observador.unobserve(ultimoServicio);
          }
          const serviciosEnPantalla = document.querySelectorAll(
            ".contenedor .sombra"
          );
          ultimoServicio = serviciosEnPantalla[serviciosEnPantalla.length - 1];
          observador.observe(ultimoServicio);
        }
      }
    } else if (respuesta.resultado === false) {
      console.log("no hay resultados");
    }
  } catch (error) {
    console.log(error);
    document.getElementById(
      "contenedor"
    ).innerHTML += `<p class = "text-center">Ya no hay servicios<p>`;
  }
};
cargarServicios();

//SECCION DE INCIDENCIAS
const agregarInfoInci = (id_ser, servicio, cliente) => {
  document.getElementById("id_serADD").value = id_ser;
  document.getElementById("servicioADD").value = servicio;
  document.getElementById("clienteADD").value = cliente;
};

const agregarInfoSerRea = (id_ser, servicio, cliente) => {
  document.getElementById("id_serSerRea").value = id_ser;
  document.getElementById("servicioSerRea").value = servicio;
  document.getElementById("clienteSerRea").value = cliente;
};

formularioADDSerBit.addEventListener("submit", (e) => {
  e.preventDefault();
  let comentarios = document.getElementById("comentarioADD").value;

  if (comentarios.length == 0) {
    Swal.fire("Aviso", "El campo de comentario esta vacio", "error");
    document.getElementById("comentarioADD").classList.add("is-invalid");
  } else {
    document.getElementById("comentarioADD").classList.remove("is-invalid");
    formularioADDSerBit.submit();
  }
});
