<?php
session_start();
if (isset($_SESSION['nom_usu']) && ($_SESSION['tip_usu'] == "ADMINISTRADOR" || $_SESSION['tip_usu'] == 'EJECUTIVO VENTAS')) :
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="../../static/css/bootstrap.min.css" />
        <link rel="stylesheet" href="../../static/css/style.css" />
        <link rel="stylesheet" href="../../static/css/datatables.min.css">
        <script src="https://kit.fontawesome.com/937f402df2.js" crossorigin="anonymous"></script>
        <title>SANMEX</title>
    </head>

    <body>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar -->
            <div class="fondo__sidebar" id="sidebar-wrapper">
                <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">SANMEX
                </div>
                <div class="list-group list-group-flush my-3">
                    <a href="../../src/sanitarios/sanitarios.php" class="list-group-item list-group-item-action second-text fw-bold active">Sanitarios</a>
                    <a href="../../src/operadores/operadores.php" class="list-group-item list-group-item-action second-text fw-bold">Operadores</a>
                    <a href="../../src/usuario/usuarios.php" class="list-group-item list-group-item-action second-text fw-bold">Usuarios</a>
                    <a href="../../src/direcciones/direcciones.php" class="list-group-item list-group-item-action second-text fw-bold ">Direcciones</a>
                    <a href="../../src/clientes/clientes.php" class="list-group-item list-group-item-action second-text fw-bold">Clientes</a>
                    <a href="../../src/servicios/servicios.php" class="list-group-item list-group-item-action second-text fw-bold">Generar Servicio</a>
                    <a href="../../src/bitacoraSerRea/listaBitacoraServRea.php" class="list-group-item list-group-item-action second-text fw-bold">Bitacora de Servicios</a>
                    <a href="../../src/rutas/listaRutas.php" class="list-group-item list-group-item-action second-text fw-bold">Rutas</a>
                    <a href="../../include/logout.php" class="list-group-item list-group-item-action text-danger fw-bold"><i class="fas fa-power-off me-2"></i>Cerrar Sesion</a>
                </div>
            </div>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg fixed-top navbar-dark px-4" style="background-color:  #222059; color: white;">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-align-left primary-text fs-4 me-3" style="color: white;" id="menu-toggle"></i>
                        <h2 class="fs-2 m-0">SERVICIOS</h2>
                    </div>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user me-2"></i> <?php echo $_SESSION['nom_usu']; ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <div class="container-fluid px-4" style="margin-top: 80px;">
                    <div class="row g-3">
                        <div class="col-md-12 mt-3">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <a href="tipoServicio.php" class="btn btn-default"><i class="fas fa-arrow-left"></i></a>
                                        <h1 style="text-align: center;">Crear Servicio</h1>
                                        <p class="text-center">Campos obligatorios<strong style="color: red;">*</strong></p>
                                    </div>
                                    <h2 style="text-align: center;">Sanitarios Disponibles</h2>
                                    <div class="row g-3" style="margin: .5rem;">
                                        <div class="col-md-12">
                                            <ul class="list-group" id="listSanDisp">
                                            </ul>
                                        </div>
                                    </div>

                                    <form class="row g-3" id="formularioADDServicio" method="post">
                                        <h2 class="text-center">Formulario Alta Servicio</h2>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="tipSer">Tipo de Servicio <strong style="color: red;">*</strong></label>
                                                <input type="text" class="form-control" name="tipSer" id="tipSer" value="LIMPIEZA SANITARIOS" placeholder="Ingrese el numero de sanitarios a rentar" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="numSan">Numero de Sanitarios <strong style="color: red;">*</strong></label>
                                                <input type="number" step="any" class="form-control" name="numSan" id="numSan" placeholder="Ingrese el numero de sanitarios a rentar">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fecEnt">Fecha de entrega <strong style="color: red;">*</strong></label>
                                                <input type="date" class="form-control" name="fecEnt" id="fecEnt">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="horEnt">Hora de entrega <strong style="color: red;">*</strong></label>
                                                <input type="time" class="form-control" name="horEnt" id="horEnt">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="cosSer">Costo de Servicio <strong style="color: red;">*</strong></label>
                                                <input type="number" step="any" class="form-control" name="cosSer" id="cosSer" placeholder="Ingrese el costo del servicio">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="tipPag">Tipo de pago <strong style="color: red;">*</strong></label>
                                                <select class="form-select" name="tipPag" id="tipPag">
                                                    <option value="" selected>Seleccione un tipo de pago</option>
                                                    <option value="EFECTIVO">EFECTIVO</option>
                                                    <option value="TRANSFERENCIA">TRANSFERENCIA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                Aqui va la info del cliente
                                                <label for="cost_tot">Buscar Cliente<strong style="color: red;">*</strong></label>
                                                <input type="text" step="any" class="form-control" id="cost_tot" placeholder="Ingrese el costo total" onkeyup="buscadorInfoCliente()">
                                                <small>El costo total se calcula al ingresar el numero de sanitarios y el
                                                    costo unitario</small>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="conctPag">Contacto de Pago <strong style="color: red;">*</strong></label>
                                                <input type="text" class="form-control" name="conctPag" id="conctPag" placeholder="Nombre del cliente" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="telConPag">Telefono del contacto de pago <strong style="color: red;">*</strong></label>
                                                <input type="text" class="form-control" name="telConPag" id="telConPag" placeholder="Nombre del cliente" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="corConPag">Correo del contacto de pago <strong style="color: red;">*</strong></label>
                                                <input type="email" class="form-control" name="corConPag" id="corConPag" placeholder="Nombre del cliente" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="corConPag">Nombre del contacto que recibe <strong style="color: red;">*</strong></label>
                                                <input type="email" class="form-control" name="corConPag" id="corConPag" placeholder="Nombre del cliente" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="dia_de_pag">Dia en que se realizaran los pagos <strong style="color: red;">*</strong></label>
                                                <select class="form-select" name="dia_de_pag" id="dia_de_pag">
                                                    <option value="" selected>Seleccione un dia</option>
                                                    <option value="01">1 </option>
                                                    <option value="02">2 </option>
                                                    <option value="03">3 </option>
                                                    <option value="04">4 </option>
                                                    <option value="05">5 </option>
                                                    <option value="06">6 </option>
                                                    <option value="07">7 </option>
                                                    <option value="08">8 </option>
                                                    <option value="09">9 </option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    <option value="13">13</option>
                                                    <option value="14">14</option>
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>
                                                    <option value="21">21</option>
                                                    <option value="22">22</option>
                                                    <option value="23">23</option>
                                                    <option value="24">24</option>
                                                    <option value="25">25</option>
                                                    <option value="26">26</option>
                                                    <option value="27">27</option>
                                                    <option value="28">28</option>
                                                    <option value="29">29</option>
                                                    <option value="30">30</option>
                                                    <option value="31">31</option>
                                                </select>
                                            </div>
                                        </div>
                                        <h2 class="text-center">Consideraciones</h2>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="hora_aten">Horario y fecha de atencion</label>
                                                <input type="text" name="hora_aten" id="hora_aten" class="form-control" placeholder="Ingrese el horar y fecha de atencion en el que se puede brindar el servico">
                                                <small>Ejemplo: de lunes a viernes de 8:00 am a 5:00 pm</small>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="obser">Observaciones</label>
                                                <textarea class="form-control" name="obser" id="obser" row="1" placeholder="Ingrese observaciones a tomar en cuenta para realizar el servicio, como; accesos, equipo necesario, etc..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12" style="display: flex; justify-content: right;">
                                            <button type="submit" class="btn btn-primary">Aceptar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="../../static/js/jquery-3.6.3.min.js"></script>
        <script src="../../static/js/bootstrap.bundle.min.js"></script>
        <script src="../../static/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="../../static/js/servicio/create_servicioLimpiezaSan.js"></script>
    </body>

    </html>
<?php
else :
    header('location: ../../include/logout.php');
endif;
?>