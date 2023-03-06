<?php
session_start();
if (isset($_SESSION['nom_usu']) && $_SESSION['tip_usu'] == "OPERADOR"):
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
                    <a href="./src/sanitarios/sanitarios.php"
                        class="list-group-item list-group-item-action bg-transparent second-text active">
                        <i class="fas fa-toilet me-2"></i>Sanitarios</a>
                    <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                            class="fas fa-project-diagram me-2"></i>Operadores</a>
                    <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                            class="fas fa-dollar me-2"></i>Vendedores</a>
                    <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                            class="fas fa-users me-2"></i>Clientes</a>
                    <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                            class="fas fa-chart-line me-2"></i>Reportes</a>
                    <a href="#" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
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
                        <h2 class="fs-2 m-0">Incidencias</h2>
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
                                    <i class="fas fa-user me-2"></i>
                                    <?php echo $_SESSION['nom_usu']; ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <div class="container-fluid" style="margin-top: 80px; padding: 10px;">

                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h1>Reportar incidencias</h1>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-12 mt-3 text-center">
                            <p>Buscar el servicio y realizar y reporta el problema del porque no se pudo realizar el
                                servicio</p>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-12 mt-3">
                            <input class="form-control" type="text"
                                placeholder="Puedes buscar servicio por nombre del cliente o razon social">
                        </div>
                    </div>

                    <div class="row g-3" style="margin-top: 5px;">
                        <div class="col-md-12 mt-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Servicio</h5>
                                    <form class="row" id = "formularioADDComentario">
                                        <div class="col-md-12 mt-2">
                                            <label>Cliente</label>
                                            <input type="text" readonly class="form-control-plaintext" id="clienteShow">
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <label>Direccion</label>
                                            <input type="text" readonly class="form-control-plaintext" id="dirreccionShow">
                                        </div>
                                            <input type="text" id = "servicio">
                                            <input type="text" id = "cliente">
                                            <input type="text" id = "operador">

                                        <div class = "col-md-12 mt-2">
                                            <textarea class="form-control" name="" id="" placeholder = "Ingrese sus observaciones del porque no se pudo realizar el servicio"></textarea>
                                        </div>
                                        <div class = "col-md-12 mt-2" style="display: flex; justify-content: right;">
                                            <button class="btn btn-primary" >Enviar comentarios</button>
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
        <script src="../../static/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="../../static/js/servicio/servicio.js"></script>
    </body>

    </html>
<?php
else:
    header('location: ../../include/logout.php');
endif;
?>