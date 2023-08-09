<?php
session_start();
if (isset($_SESSION['nom_usu']) && ($_SESSION['tip_usu'] == "COBRANZA" || $_SESSION['tip_usu'] == "ADMINISTRADOR")) :
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="../../static/css/bootstrap.min.css" />
        <link rel="stylesheet" href="../../static/css/style.css" />
        <link rel="stylesheet" href="../../static/css/datatables.css" />
        <link rel="stylesheet" href="../../static/css/datatables.min.css" />

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
            <?php include '../../src/componentes/sidebar.php' ?>
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
                            <h1 style="text-align: center;">Lista de servicios por cobrar</h1>
                            <p style="text-align: center;"></p>
                        </div>
                        <div class="col-md-12">
                        <table id="tableListSer" class="table table-striped  table-hover table-sm nowrap" style="width:100%; text-align: center;">
                                        <thead style="background-color: #222059; color: white;">
                                            <tr>
                                                <th>NUM SERV</th>
                                                <th>TIP SERV</th>
                                                <th>CLIENTE</th>
                                                <th>COSTO</th>
                                                <th>TIP PAGO</th>
                                                <th>DIA PAG</th>
                                                <th>ESTATUS PAG</th>
                                                <th>CONCT PAG</th>
                                                <th>TEl CONCT PAG</th>
                                                <th>CORR CONCT PAG</th>
                                                <th>ESTATUS SERV</th>
                                                <th>OPCIONES</th>
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
        <script src="../../static/js/jquery-3.6.3.min.js"></script>
        <script src="../../static/js/bootstrap.min.js"></script>
        <script src="../../static/js/bootstrap.bundle.min.js"></script>
        <script src="../../static/js/datatables.js"></script>
        <script src="../../static/js/datatables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="../../static/js/cobranza/cobranza.js"></script>
    </body>
    </html>
<?php
else :
    header('location: ../../include/logout.php');
endif;
?>