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
      `./include/getListServicios.php?limite=${limite}`
    );
    // Si la respuesta es correcta
    if (respuesta.status === 200) {
      const datos = await respuesta.json();
      datos.forEach((element) => {
        if (element.estatus == "ACTIVO") {
          color = element.color;
          botones = `<div class="btn-group">
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#myModal" onclick = "getInfoServById(${element.id_ser}, '${element.cliente.razon_social} - ${element.dirreccion.colonia} - ${element.dirreccion.calle}', '${element.cliente.nom_clie}' )">Incidencias</button>
            <a href="servicio.php?id_ser=${element.id_ser}" class="btn btn-success">Realizar Servicio</a>
          </div>`;
        } else if (element.estatus == "FINALIZADO") {
          color = element.color;
          botones = `Ya no puedes realizar limpiezas, el servcio ha terminado`;
        }
        servicios += `
                    <div class="card sombra" style = "margin-top: 10px; background-color: ${color}">
                        <div class="card-body">
                            <h5 class="card-title">Nombre del servicio: ${element.cliente.razon_social} - ${element.dirreccion.colonia} - ${element.dirreccion.calle}  </h5>
                            <h6 class="card-subtitle mb-2"><strong>Razón Social:</strong>${element.cliente.nom_clie}. </h6>
                            	<p class="card-text"><strong>Estado:</strong> ${element.dirreccion.estado}. <strong>Municipio:</strong> ${element.dirreccion.municipio} <strong>Colonia:</strong> ${element.dirreccion.colonia} <strong>Calle:</strong> ${element.dirreccion.calle}</p>
                                <p class="card-text" style="text-align: right;">Sanitarios a limpiar: ${element.san_soli}</p>
                                <div style="display: flex; justify-content: right">
                                    ${botones}
                                </div>
                        </div>
                    </div>
				`;
      });
      document.getElementById("contenedor").innerHTML = servicios;

      if (limite <= datos[0].totalRe) {
        if (ultimoServicio) {
          observador.unobserve(ultimoServicio);
        }
        const serviciosEnPantalla =
          document.querySelectorAll(".contenedor .card");
        ultimoServicio = serviciosEnPantalla[serviciosEnPantalla.length - 1];
        observador.observe(ultimoServicio);
      }
    } else if (respuesta.resultado === false) {
      console.log("no hay resultados");
    }
  } catch (error) {
    /* console.log(error); */
    document.getElementById(
      "contenedor"
    ).innerHTML += `<p class = "text-center">Ya no hay servicios<p>`;
  }
};
cargarServicios();

//SECCION DE INCIDENCIAS
const getInfoServById = (id_ser, servicio, cliente) => {
  document.getElementById("id_serADD").value = id_ser;
  document.getElementById("servicioADD").value = servicio;
  document.getElementById("clienteADD").value = cliente;
}

formularioADDSerBit.addEventListener('submit', (e) => {
  e.preventDefault();
  let id_serADD = document.getElementById('id_serADD').value;
  let operadorADD = document.getElementById('operadorADD').value;
  let tipo = document.getElementById('tipo').value;
  let servicioADD = document.getElementById('servicioADD').value;
  let clienteADD = document.getElementById('clienteADD').value;
  let comentarios = document.getElementById('comentarioADD').value;

  if(comentarios.length == 0){
    Swal.fire(
      'Aviso',
      'El campo de comentario esta vacio',
      'error'
    )
    document.getElementById('comentarioADD').classList.add('is-invalid');
  }else{
    document.getElementById('comentarioADD').classList.remove('is-invalid');
    formularioADDSerBit.submit();
  }
});