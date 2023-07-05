<?php
session_start();
if (isset($_SESSION['nom_usu']) && $_SESSION['tip_usu'] == "OPERADOR A") :
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
            <?php include '../../src/componentes/sidebar.php' ?>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg fixed-top navbar-dark px-4" style="background-color:  #222059; color: white;">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-align-left primary-text fs-4 me-3" style="color: white;" id="menu-toggle"></i>
                        <h2 class="fs-2 m-0">Dashboard</h2>
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

                <div class="container-fluid" style="margin-top: 80px; padding: 10px;">
                    <div class="row">
                        <h1>Lista de Módulos</h1>
                        <div class="col-md-4 mt-2 ">
                            <a href="../operadorA/listaServicios.php" class="link__card">
                                <div class="card sombra">
                                    <div class="card-body">
                                        <img src="../../static/img/iconos/bano.png" class="img-fluid" loading="lazy" width="60" height="60">
                                        <h4 class="card-title">Servicios</h4>
                                        <p>Lista de servicios</p>
                                        <div style="display: flex; justify-content: right;">
                                            <a href="listaServicios.php" class="btn btn-default"><i class="fas fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 mt-2 ">
                            <a href="./src/serviciosRea/servicios_rea.php" class="link__card">
                                <div class="card sombra">
                                    <div class="card-body">
                                        <img src="../../static/img/iconos/ser_rea.png" class="img-fluid" loading="lazy" width="60" height="60">
                                        <h4 class="card-title">Servicios Realizados</h4>
                                        <p>Lista de servicios que ya haz realizado</p>
                                        <div style="display: flex; justify-content: right;">
                                            <a href="./src/serviciosRea/servicios_rea.php" class="btn btn-default"><i class="fas fa-arrow-right"></i></a>
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
        <script src="../../static/js/jquery-3.6.3.min.js"></script>
        <script src="../../static/js/bootstrap.min.js"></script>
        <script src="../../static/js/operadorA/operadorA.js"></script>
    </body>

    </html>
<?php
else :
    header('location: ../../include/logout.php');
endif;
?>