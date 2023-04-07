<?php
session_start();
if (isset($_SESSION['nom_usu']) && ($_SESSION['tip_usu'] == "ALMACENISTA" || $_SESSION['tip_usu'] == "ADMINISTRADOR")):
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="static/css/bootstrap.min.css" />
        <link rel="stylesheet" href="static/css/style.css" />
        <script src="https://kit.fontawesome.com/937f402df2.js" crossorigin="anonymous"></script>
        <title>SANMEX</title>
    </head>
    <style>
        .ocultar {
            display: none;
        }
    </style>

    <script>
        var id_ope = <?php echo $_SESSION['id_ope']; ?> 
    </script>

    <body>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar -->
            <div class="fondo__sidebar" id="sidebar-wrapper">
                <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">SANMEX
                </div>
                <div class="list-group list-group-flush my-3">
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
                        <h2 class="fs-2 m-0">Servicio</h2>
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
                <div class="container-fluid" style="margin-top: 80px; padding: 25px;">
                <div>
                    <a href="homeAlmacenista.php" style="color: black; text-decoration: none;"><i class = "fas fa-arrow-left"></i> Volver</a>
                </div>
                <div id = "titleSanSer" >
                </div>
                    <div class="row g-3" id="infoSanAsig">
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="modalADDSAN">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Agregar un sanitario para el servicio</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <!-- formulario para el vendedor -->
                        <form class="row g-3" id="formularioADDSanServ">
                            <div class="row g-3">
                                <p style="font-size: 25px; text-align: center;">Por favor escanea el código QR.</p>
                            </div>
                            <div class="row g-3">
                                <div id="qr-reader" style="width: 100%;"></div>
                            </div>
                            <div class="row g-3">
                                <p style="font-size: 20px; text-align: center;">Informacion del sanitario.</p>
                            </div>
                            <input type="hidden" readonly class="form-control" disabled id="id_san" name="id_san">
                            <input type="hidden" readonly class="form-control" disabled id="id_serQr" name="id_serQr">
                            <input type="hidden" readonly class="form-control" disabled id="id_sersan" name="id_sersan">
                            <div class="col-md-6">
                                <div class="mb-3 mt-3">
                                    <label for="text" class="form-label"><strong>Número de Sanitario: </strong></label>
                                    <input type="text" readonly class="form-control" disabled id="num_san" name="num_san">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 mt-3">
                                    <label for="tip_sanQR" class="form-label"><strong>Tipo de Sanitario: </strong></label>
                                    <input type="text" readonly class="form-control" disabled id="tip_sanQR" name="tip_sanQR">
                                </div>
                            </div>
                            <div class="col-md-12" style="display: flex; justify-content: right;">
                                <button type="submit" class="btn btn-success" id="botonADDSan" disabled>Agregar</button>
                            </div>
                        </form>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>


        <script src="static/js/jquery-3.6.3.min.js"></script>
        <script src="static/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>
        <script src="static/js/home/asignarSanAlm.js"></script>
    </body>

    </html>
    <?php
else:
    header('location: ../../include/logout.php');
endif;
?>