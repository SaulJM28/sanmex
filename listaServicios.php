<?php
session_start();
if (isset($_SESSION['nom_usu']) && $_SESSION['tip_usu'] == "OPERADOR") :
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
            <?php  include './src/componentes/sidebar.php' ?>
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
                            <a href="home_ope.php" style="color: black; text-decoration: none;"><i class = "fas fa-arrow-left"> Volver</i></a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h1 style="text-align: center;">Lista de servicios por hacer</h1>
                        </div>
                    </div>
                    <div class="contenedor" id="contenedor"></div>
                </div>
            </div>
        </div>
        <!-- MODAL PARA INCIDENCIAS -->
        <!-- The Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content modal-lg">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Reportar Incidencias</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="./include/insert_bit.php" id="formularioADDSerBit" method="POST" enctype="multipart/form-data">
                            <input type="hidden" class="form-control" id="id_serADD" name="id_serADD" value="<?php echo $_SESSION['nombre']; ?>">
                            <input type="hidden" class="form-control" id="operadorADD" name="operadorADD" value="<?php echo $_SESSION['nombre']; ?>">
                            <input type="hidden" class="form-control" id="tipo" name="tipo" value="INCIDENCIA">
                            <input type="hidden" class="form-control" id="servicioADD" name="servicioADD">
                            <input type="hidden" class="form-control" id="clienteADD" name="clienteADD">
                            <div class="mb-3 mt-3">
                                <label for="comentarioADD" class="form-label">Comentarios:</label>
                                <textarea class="form-control" rows="5" id="comentarioADD" name="comentarioADD" placeholder="escriba las incidencias por lo cual no pudo realizar el servicio" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                            </div>
                            <div style="display: flex; justify-content: right;">
                                <button type="submit" class="btn btn-success">Reportar incidencias</button>
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
        <script src="static/js/servicio/listServiciosOpe.js"></script>
    </body>
    </html>
<?php
else :
    header('location: ../../include/logout.php');
endif;
?>