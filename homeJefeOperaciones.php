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
    <body>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar -->
            <div class="fondo__sidebar" id="sidebar-wrapper">
                <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">SANMEX
                </div>
                <div class="list-group list-group-flush my-3">
                    <a href="./include/logout.php" class="list-group-item list-group-item-action text-danger fw-bold"><i class="fas fa-power-off me-2"></i>Cerrar Sesion</a>
                </div>
            </div>
            <!-- /#sidebar-wrapper -->
            <!-- Page Content -->
            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg fixed-top navbar-dark px-4" style="background-color:  #222059; color: white;">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-align-left primary-text fs-4 me-3" style="color: white;" id="menu-toggle"></i>
                        <h2 class="fs-2 m-0">Servicio</h2>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user me-2"></i>
                                    <?php echo $_SESSION['nom_usu']; ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid" style="margin-top: 80px; padding: 25px;">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 style="text-align: center;">Lista de servicios</h1>
                            <p style="text-align: center;">Aqui es donde se van a asignar la ruta y los dias que se haran las limpiezas</p>
                        </div>
                        <div class="col-md-12">
                        <table id="tableListSer" class="table table-striped  table-hover table-sm nowrap" style="width:100%;">
                                        <thead style="background-color: #222059; color: white;">
                                            <tr>
                                                <th>NUM SER</th>
                                                <th>TIPO SERVICIO</th>
                                                <th>NUM SAN</th>
                                                <th>CLIENTE</th>
                                                <th>DIRECCION ENTREGA</th>
                                                <th>FECHA DE ENTREGA</th>
                                                <th>HORA DE ENTREGA</th>
                                                <th>DIA DE PAGO</th>
                                                <th>NOMBRE CONTACT PAGO</th>
                                                <th>TEL CONTACT PAGO</th>
                                                <th>CORREO CONTACT PAGO</th>
                                                <th>NOMBRE CONTACT RECIBE</th>
                                                <th>TELEFONO CONTACT RECIBE</th>
                                                <th>RUTA</th>
                                                <th>OPERADOR</th>
                                                <th>DIAS REA SERV</th>
                                                <th>OBSERVACIONES</th>
                                                <th>ESTATUS</th>
                                                <th>ACCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="static/js/jquery-3.6.3.min.js"></script>
        <script src="static/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="static/js/home/almacenista.js"></script>
    </body>
    </html>
<?php
else :
    header('location: ../../include/logout.php');
endif;
?>