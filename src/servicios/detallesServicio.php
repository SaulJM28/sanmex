<?php
session_start();
if (isset($_SESSION['nom_usu']) && ($_SESSION['tip_usu'] == "ADMINISTRADOR" || $_SESSION['tip_usu'] == "EJECUTIVO VENTAS")) :
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
                                        <div>
                                            <a href="listaServicios.php" class="btn btn-default"><i class="fas fa-arrow-left"></i></a>
                                            <h1 style="text-align: center;">Detalles del Servicio</h1>
                                            <p id ="infoServ" class="text-center"></p>
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-md-12 mt-2" style="display: flex; justify-content: right;">
                                                <button class="btn btn-warning" onclick="finalizarServ()">Finalizar servicio <i class="fas fa-check"></i></button>
                                            </div>
                                        </div>
                                        <h2 class="text-center">Informacion de sanitarios</h2>
                                        <p class="text-center" id="tittleSanAsig"></p>
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

        <!-- MODAL AGREGAR SANITARIO -->
        <!-- The Modal -->
        <div class="modal fade" id="modalADDSAN">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalTitle">Agregar Sanitario</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <!-- formulario para el almacen -->
                        <form class="row g-3" id="formularioADDInfoSanServ">
                            <div class="col-md-12">
                                <div class="mb-3 mt-3">
                                    <label for="text" class="form-label">Tipo: </label>
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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="buscarDir">Buscar Direccion</label>
                                    <input type="text" class="form-control" id="buscarDir" placeholder="Escriba el nombre de la calle/colonia" onkeyup="buscadorInfoDireClie()" required>
                                    <small>De no exitir la direccion la puedes dar de alta <a href="../direcciones/direcciones.php">aqui</a></small>
                                </div>
                            </div>

                            <div class="col-md-12" id="mensajeBusDire">
                            </div>
                            <input type="hidden" id="idDir">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dirEst">Estado</label>
                                    <input type="text" class="form-control" name="dirEst" id="dirEst" placeholder="Estado" disabled readonly>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dirMun">Municipio</label>
                                    <input type="text" class="form-control" name="dirMun" id="dirMun" placeholder="Municipio" disabled readonly>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dirCol">Colonia</label>
                                    <input type="text" class="form-control" name="dirCol" id="dirCol" placeholder="Colonia" disabled readonly>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dirCalle">Calle</label>
                                    <input type="text" class="form-control" name="dirCalle" id="dirCalle" placeholder="Calle" disabled readonly>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dirNumExt">Num Ext</label>
                                    <input type="text" class="form-control" name="dirNumExt" id="dirNumExt" placeholder="Numero Exterior" disabled readonly>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dirNumInt">Num Int</label>
                                    <input type="text" class="form-control" name="dirNumInt" id="dirNumInt" placeholder="Numero Interior" disabled readonly>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dirCP">CP</label>
                                    <input type="text" class="form-control" name="dirCP" id="dirCP" placeholder="Codigo Postal" disabled readonly>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="coord">Coordenadas</label>
                                    <input type="text" class="form-control" name="coord" id="coord" placeholder="Coordenadas" disabled readonly>
                                </div>
                            </div>
                            <div class="col-md-12" style="display: flex; justify-content: right;">
                                <button class="btn btn-success" id="btnADDInfoSan">Agregar <i class = "fas fa-plus"></i></button>
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