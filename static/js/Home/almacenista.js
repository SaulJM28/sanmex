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
      `./include/getListServiciosAlm.php?limite=${limite}`
    );
    // Si la respuesta es correcta
    if (respuesta.status === 200) {
      const datos = await respuesta.json();
      datos.forEach((element) => {
        if (element.estatus == "ACTIVO") {
          color = element.color;
          botones = `<div class="btn-group">
            <a href="asignarSanAlm.php?id_ser=${element.id_ser}&san_sol=${element.san_soli}" class="btn btn-success">Realizar Servicio</a>
          </div>`;
        } else if (element.estatus == "FINALIZADO") {
          color = element.color;
          botones = `Ya no puedes asignar sanitarios, el servcio ha terminado`;
        }
        servicios += `
                    <div class="card sombra" style = "margin-top: 10px; border-left: 5px solid  ${color}">
                        <div class="card-body">
                            <h5 class="card-title">Nombre del servicio: ${element.cliente.razon_social} - ${element.dirreccion.colonia} - ${element.dirreccion.calle}  </h5>
                            <h6 class="card-subtitle mb-2"><strong>Nombre cliente:</strong>${element.cliente.nom_clie}. </h6>
                            	<p class="card-text"><strong>Estado:</strong> ${element.dirreccion.estado}. <strong>Municipio:</strong> ${element.dirreccion.municipio} <strong>Colonia:</strong> ${element.dirreccion.colonia} <strong>Calle:</strong> ${element.dirreccion.calle}</p>
                            	<p class="card-text"><strong>Operador:</strong> ${element.operador}. <strong>Ruta:</strong> ${element.ruta}  </p>  
                              <p class="card-text" style="text-align: right;">Sanitarios asignados: ${element.totalsan} de ${element.san_soli}</p>
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
        const serviciosEnPantalla = document.querySelectorAll(
          ".contenedor .sombra"
        );
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
