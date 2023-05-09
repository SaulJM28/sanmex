<?php
session_start();
if (isset($_SESSION['nom_usu']) && ($_SESSION['tip_usu'] == "ADMINISTRADOR" || $_SESSION['tip_usu'] == "VENDEDOR") ) :
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="static/css/bootstrap.min.css" />
    <link rel="stylesheet" href="static/css/style.css" />
    <link rel="stylesheet" href="static/css/datatables.min.css">
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
                <a href="./src/sanitarios/sanitarios.php" class="list-group-item list-group-item-action second-text fw-bold">Sanitarios</a>
                <a href="./src/operadores/operadores.php" class="list-group-item list-group-item-action second-text fw-bold">Operadores</a>
                <a href="./src/usuario/usuarios.php" class="list-group-item list-group-item-action second-text fw-bold">Usuarios</a>
                <a href="./src/direcciones/direcciones.php" class="list-group-item list-group-item-action second-text fw-bold">Direcciones</a>
                <a href="./src/clientes/clientes.php" class="list-group-item list-group-item-action second-text fw-bold">Clientes</a>
                <a href="./src/servicios/servicios.php" class="list-group-item list-group-item-action second-text fw-bold">Generar Servicio</a>
                <a href="./src/bitacoraSerRea/listaBitacoraServRea.php" class="list-group-item list-group-item-action second-text fw-bold">Bitacora de Servicios</a>
                <a href="./include/logout.php" class="list-group-item list-group-item-action text-danger fw-bold"><i
                        class="fas fa-power-off me-2"></i>Cerrar Sesion</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg fixed-top navbar-dark px-4"
                style="background-color:  #222059; color: white;">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" style="color: white;" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Dashboard</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fas fa-user me-2"></i> <?php  echo $_SESSION['nom_usu']; ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid" style="margin-top: 80px; padding: 10px;">
                <div class="row">
                    <h1>Lista de Módulos</h1>
                    <div class="col-md-4 mt-2 ">
                        <a href="./src/sanitarios/sanitarios.php" class="link__card">
                            <div class="card sombra">
                                <div class="card-body">
                                    <img src="static/img/iconos/bano.png" class="img-fluid" loading="lazy" width="60" height="60">
                                    <h4 class="card-title">Sanitarios</h4>
                                    <p class="card-text">Módulo para la gestión de sanitarios</p>
                                    <div style="display: flex; justify-content: right;">
                                        <a href="./src/sanitarios/sanitarios.php" class="btn btn-default"><i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 mt-2 ">
                        <a href="./src/operadores/operadores.php" class="link__card">
                            <div class="card sombra">
                                <div class="card-body">
                                    <img src="static/img/iconos/limpiador.png" class="img-fluid" loading="lazy" width="60" height="60">
                                    <h4 class="card-title">Operadores</h4>
                                    <p class="card-text">Módulo para la gestión de operadores</p>
                                    <div style="display: flex; justify-content: right;">
                                        <a href="./src/operadores/operadores.php" class="btn btn-default"><i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 mt-2 ">
                        <a href="./src/usuario/usuarios.php" class="link__card">
                            <div class="card sombra">
                                <div class="card-body">
                                    <img src="static/img/iconos/grupo.png" class="img-fluid" loading="lazy" width="60" height="60">
                                    <h4 class="card-title">Usuarios</h4>
                                    <p class="card-text">Módulo para la gestión de usuarios</p>
                                    <div style="display: flex; justify-content: right;">
                                        <a href="./src/usuario/usuarios.php" class="btn btn-default"><i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 mt-2 ">
                        <a href="./src/direcciones/direcciones.php" class="link__card">
                            <div class="card sombra">
                                <div class="card-body">
                                    <img src="static/img/iconos/localizacion.png" class="img-fluid" loading="lazy" width="60" height="60">
                                    <h4 class="card-title">Direcciones</h4>
                                    <p class="card-text">Módulo para la gestión de direcciones</p>
                                    <div style="display: flex; justify-content: right;">
                                        <a href="./src/direcciones/direcciones.php" class="btn btn-default"><i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 mt-2 ">
                        <a href="./src/clientes/clientes.php" class="link__card">
                            <div class="card sombra">
                                <div class="card-body">
                                    <img src="static/img/iconos/clasificacion.png" class="img-fluid" loading="lazy" width="60" height="60">
                                    <h4 class="card-title">Clientes</h4>
                                    <p class="card-text">Módulo para la gestión de clientes</p>
                                    <div style="display: flex; justify-content: right;">
                                        <a href="./src/clientes/clientes.php" class="btn btn-default"><i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 mt-2 ">
                        <a href="./src/servicios/servicios.php" class="link__card">
                            <div class="card sombra">
                                <div class="card-body">
                                    <img src="static/img/iconos/servicio.png" class="img-fluid" loading="lazy" width="60" height="60">
                                    <h4 class="card-title">Generar Servicio</h4>
                                    <p class="card-text">Módulo para generar un servicio</p>
                                    <div style="display: flex; justify-content: right;">
                                        <a href="./src/servicios/servicios.php" class="btn btn-default"><i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 mt-2 ">
                        <a href="./src/bitacoraSerRea/listaBitacoraServRea.php" class="link__card">
                            <div class="card sombra">
                                <div class="card-body">
                                    <img src="static/img/iconos/ser_rea.png" class="img-fluid" loading="lazy" width="60" height="60">
                                    <h4 class="card-title">Bitacora de Servicios Realizados</h4>
                                    <p class="card-text">Módulo para ver la bitacora de servicios realizados</p>
                                    <div style="display: flex; justify-content: right;">
                                        <a href="./src/bitacoraSerRea/listaBitacoraServRea.php" class="btn btn-default"><i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- RUTAS -->
                    <div class="col-md-4 mt-2 ">
                        <a href="./src/rutas/listaRutas.php" class="link__card">
                            <div class="card sombra">
                                <div class="card-body">
                                    <img src="static/img/iconos/truck.png" class="img-fluid" loading="lazy" width="60" height="60">
                                    <h4 class="card-title">Rutas</h4>
                                    <p class="card-text">Módulo para la gestión de rutas</p>
                                    <div style="display: flex; justify-content: right;">
                                        <a href="./src/rutas/listaRutas.php" class="btn btn-default"><i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
    </div>
    <script src="static/js/jquery-3.6.3.min.js"></script>
    <script src="static/js/datatables.min.js"></script>
    <script src="static/js/bootstrap.min.js"></script>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <script src="static/js/Home/home.js"></script>

</body>
</html>

<?php 
else : 
    header('location: ./include/logout.php'); 
endif;
?>