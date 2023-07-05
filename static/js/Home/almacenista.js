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
      `../../include/getListServiciosAlm.php?limite=${limite}`
    );
    // Si la respuesta es correcta
    if (respuesta.status === 200) {
      const datos = await respuesta.json();
      datos.forEach((element) => {
        console.log(element);
        if (element.estatus == "ACTIVO") {
          color = element.color;
          botones = `<div class="btn-group">
            <a href="../almacenista/asignarSanAlm.php?id_ser=${element.id_ser}&san_sol=${element.san_sol}" class="btn btn-success">Asignar Sanitarios</a>
          </div>`;
        } else if (element.estatus == "FINALIZADO") {
          color = element.color;
          botones = `Ya no puedes asignar sanitarios, el servcio ha terminado`;
        }
        servicios += `
                    <div class="card sombra" style = "margin-top: 10px; border-left: 5px solid  ${color}">
                        <div class="card-body">
                            <h5 class="card-title">Numero del servicio: ${element.num_ser}</h5>
                            <h6 class="card-subtitle mb-2"><strong>Tipo de servicio:</strong>${element.tip_ser}. </h6>
                              <p class="card-text"><strong>Nombre de Cliente:</strong> ${element.cliente}.</p>  
                              <p class="card-text" style="text-align: right;">Sanitarios asignados: ${element.san_reg} de ${element.san_sol}</p>
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
