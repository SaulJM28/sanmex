<?php
session_start();
if (isset($_SESSION['nom_usu']) && ($_SESSION['tip_usu'] == "JEFE OPERACIONES" || $_SESSION['tip_usu'] == "ADMINISTRADOR")) :
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="../../static/css/bootstrap.min.css" />
        <link rel="stylesheet" href="../../static/css/style.css" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        <script src="https://kit.fontawesome.com/937f402df2.js" crossorigin="anonymous"></script>
        <title>SANMEX</title>
    </head>
    <style>
        .ocultar {
            display: none;
        }

        #map {
            height: 600px;
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
                                        <a href="../home/homeJefeOperaciones.php" class="btn btn-default"><i class="fas fa-arrow-left"></i></a>
                                        <h1 class="text-center">Asignacion de rutas</h1>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-12 mt-3">
                                            <form id="formularioAddRuta">
                                                <div class="mb-3">
                                                    <label for="ruta" class="form-label">Ruta</label>
                                                    <select class="form-select" name="ruta" id="ruta">
                                                    </select>
                                                </div>
                                                <label for="dias" class="form-label">Dias en los que se hara el servicio</label>
                                                <div class="mb-3 form-check">
                                                    <input type="checkbox" name="dias[]" value="lunes">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Lunes
                                                    </label>
                                                    <input type="checkbox" name="dias[]" value="Martes">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Martes
                                                    </label>
                                                    <input type="checkbox" name="dias[]" value="Miercoles">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Miercoles
                                                    </label>
                                                    <input type="checkbox" name="dias[]" value="Jueves">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Jueves
                                                    </label>
                                                    <input type="checkbox" name="dias[]" value="Viernes">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Viernes
                                                    </label>
                                                    <input type="checkbox" name="dias[]" value="Sabado">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Sabado
                                                    </label>
                                                    <input type="checkbox" name="dias[]" value="Domingo">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Domingo
                                                    </label>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Agregar Ruta</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <h2 class="text-center">Direcciones de entrega</h2>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="map"></div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script src="../../static/js/jquery-3.6.3.min.js"></script>
        <script src="../../static/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
        <script src="../../static/js/jefeOperaciones/jefeOperaciones.js"></script>
    </body>

    </html>
<?php
else :
    header('location: ../../include/logout.php');
endif;
?>