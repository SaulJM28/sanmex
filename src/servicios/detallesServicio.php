<?php
session_start();
if (isset($_SESSION['nom_usu']) && ($_SESSION['tip_usu'] == "ADMINISTRADOR" || $_SESSION['tip_usu'] == "VENDEDOR")) :
    echo "<script> var tipo = " . json_encode($_SESSION['tip_usu']) . ";</script>";
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="../../static/css/bootstrap.min.css" />
        <link rel="stylesheet" href="../../static/css/style.css" />
        <script src="https://kit.fontawesome.com/937f402df2.js" crossorigin="anonymous"></script>
        <title>SANMEX</title>
    </head>
    <style>
        .ocultar {
            display: none;
        }
    </style>

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
                                    <i class="fas fa-user me-2"></i><?php echo $_SESSION['nom_usu']; ?>
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

                                    <div id="viewVendedor">
                                        <div>
                                            <a href="../../home.php" class="btn btn-default"><i class="fas fa-arrow-left"></i></a>
                                            <h1 style="text-align: center;">Detalles del Servicio</h1>
                                        </div>
                                        <br>
                                            <div class="row g-3">
                                                <div class="col-md-12 mt-2" style="display: flex; justify-content: right;">
                                                    <button class="btn btn-warning" onclick="finalizarServ()">Finalizar servicio <i class="fas fa-check"></i></button>
                                                </div>
                                            </div>
                                        <br>
                                        <div class="row g-3">
                                            <div class="col-md-12 mt-2">
                                                <h2 class="text__center">Información del cliente</h2>
                                            </div>
                                        </div>
                                        <br>
                                        <form class="row g-3" action="/action_page.php">
                                            <div class="col-md-4 mt-2">
                                                <div class="mb-3 mt-3">
                                                    <label for="nom_clie" class="form-label"><strong>Nombre del
                                                            cliente:</strong> </label>
                                                    <input type="text" readonly class="form-control" disabled id="nom_clie" name="nom_clie">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-2">
                                                <div class="mb-3 mt-3">
                                                    <label for="raz_soc" class="form-label"><strong>Razon social:</strong>
                                                    </label>
                                                    <input type="text" readonly class="form-control" disabled id="raz_soc" name="raz_soc">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-2">
                                                <div class="mb-3 mt-3">
                                                    <label for="rfc" class="form-label"><strong>RFC:</strong> </label>
                                                    <input type="text" readonly class="form-control" disabled id="rfc" name="rfc">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-2">
                                                <div class="mb-3 mt-3">
                                                    <label for="nom_con" class="form-label"><strong>Nombre del
                                                            contacto:</strong> </label>
                                                    <input type="text" readonly class="form-control" disabled id="nom_con" name="nom_con">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-2">
                                                <div class="mb-3 mt-3">
                                                    <label for="num_con" class="form-label"><strong>Número del
                                                            contacto:</strong> </label>
                                                    <input type="text" readonly class="form-control" disabled id="num_con" name="num_con">
                                                </div>
                                            </div>
                                        </form>
                                        <div class="row g-3">
                                            <div class="col-md-12 mt-2">
                                                <h2 class="text__center">Informacion de la dirección</h2>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card mb-3" id="datosDireccion">
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row g-3">
                                            <div class="col-md-12 mt-2">
                                                <h2 class="text__center">Informacion del servicio</h2>
                                            </div>
                                        </div>
                                        <form class="row g-3" action="/action_page.php">
                                            <div class="col-md-4 mt-2">
                                                <div class="mb-3 mt-3">
                                                    <label for="num_sans" class="form-label"><strong>Número de sanitarios a
                                                            rentar:</strong></label>
                                                    <input type="text" readonly class="form-control" disabled id="num_sans" name="num_sans">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-2">
                                                <div class="mb-3 mt-3">
                                                    <label for="cost_unit" class="form-label"><strong>Costo por
                                                            sanitario:</strong>
                                                    </label>
                                                    <input type="text" readonly class="form-control" disabled id="cost_unit" name="cost_unit">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-2">
                                                <div class="mb-3 mt-3">
                                                    <label for="cost_tot" class="form-label"><strong>Costo Total:</strong>
                                                    </label>
                                                    <input type="text" readonly class="form-control" disabled id="cost_tot" name="cost_tot">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-2">
                                                <div class="mb-3 mt-3">
                                                    <label for="tip_pag" class="form-label"><strong>Tipo de pago:</strong>
                                                    </label>
                                                    <input type="text" readonly class="form-control" disabled id="tip_pag" name="tip_pag">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-2">
                                                <div class="mb-3 mt-3">
                                                    <label for="dia_pag" class="form-label"><strong>Dia de pago:</strong>
                                                    </label>
                                                    <input type="text" readonly class="form-control" disabled id="dia_pag" name="dia_pag">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mt-2">
                                                <div class="mb-3 mt-3">
                                                    <label for="dias_serv" class="form-label"><strong>Dias que se realizara el
                                                            servicio:</strong> </label>
                                                    <input type="text" readonly class="form-control" disabled id="dias_serv" name="dias_serv">
                                                </div>
                                            </div>

                                            <div class="col-md-4 mt-2">
                                                <div class="mb-3 mt-3">
                                                    <label for="operador" class="form-label"><strong>Operador asignado</strong> </label>
                                                    <input type="text" readonly class="form-control" disabled id="operador" name="operador">
                                                </div>
                                            </div>

                                            <div class="col-md-4 mt-2">
                                                <div class="mb-3 mt-3">
                                                    <label for="ruta" class="form-label"><strong>Ruta asiganda</strong> </label>
                                                    <input type="text" readonly class="form-control" disabled id="ruta" name="ruta">
                                                </div>
                                            </div>

                                        </form>
                                        <div class="row g-3">
                                            <div class="col-md-12 mt-2">
                                                <h2 class="text__center" id="tittleSanAsig"></h2>
                                            </div>
                                        </div>
                                        <div class="row g-3" id="divAddSan">
                                            <div class="col-md-12 mt-2" style="display: flex; justify-content: right; margin: 5px;">
                                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalADDSAN" id="btnAddSan">Agregar sanitario<i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>
                                        <div class="row g-3" id="infoSanAsig">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL AGREGAR SANITARIO -->
        <!-- The Modal -->
        <div class="modal fade" id="modalADDSAN">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Agregar un sanitario para el servicio (Poner por JS)</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <!-- formulario para el almacen -->
                        <form class="row g-3" id="formularioADDInfoSanServ">
                            <input type="hidden" readonly class="form-control" disabled id="id_ser" name="id_ser">
                            <div class="col-md-6">
                                <div class="mb-3 mt-3">
                                    <label for="text" class="form-label"><strong>Precio: </strong></label>
                                    <input type="number" step="any" placeholder="Ingrese el precio con el que se va a rentar" class="form-control" id="precio_san" name="precio_san" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 mt-3">
                                    <label for="text" class="form-label"><strong>Tipo: </strong></label>
                                    <select class="form-select" id="tip_san" name="tip_san" required>
                                        <option value="ESTANDAR ROJO OBRA">ESTANDAR ROJO OBRA</option>
                                        <option value="ESTANDAR ROJO EVENTO">ESTANDAR ROJO EVENTO</option>
                                        <option value="ESTANDAR GRIS OBRA">ESTANDAR GRIS OBRA</option>
                                        <option value="LUJO ROJO LAVAMANOS">LUJO ROJO LAVAMANOS</option>
                                        <option value="LUJO GRIS LAVAMANOS WC FLUSH">LUJO GRIS LAVAMANOS WC FLUSH</option>
                                        <option value="DISCAPACITADOS">DISCAPACITADOS</option>
                                        <option value="LAVAMANOS OBRA">LAVAMANOS OBRA</option>
                                        <option value="LAVAMANOS EVENTO">LAVAMANOS EVENTO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 mt-3">
                                    <label for="text" class="form-label"><strong>Coordenadas: </strong></label>
                                    <input type="text" placeholder="ingrese las coordenadas de a donde se pondra el sanitario" class="form-control" id="coord_san" name="coord_san" required>
                                </div>
                            </div>
                            <div class="col-md-12" style="display: flex; justify-content: right;">
                                <button class="btn btn-success" id="btnADDInfoSan">Agregar</button>
                            </div>
                        </form>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        <script src="../../static/js/jquery-3.6.3.min.js"></script>
        <script src="../../static/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>
        <script src="../../static/js/servicio/detallesServicio.js"></script>
    </body>

    </html>
<?php
else :
    header('location: ../../include/logout.php');
endif;
?>