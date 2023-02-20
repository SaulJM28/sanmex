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
                <a href="./src/sanitarios/sanitarios.php" class="list-group-item list-group-item-action bg-transparent second-text active">
                    <i class="fas fa-toilet me-2"></i>Sanitarios</a>
                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-project-diagram me-2"></i>Operadores</a>
                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-dollar me-2"></i>Vendedores</a>
                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-users me-2"></i>Clientes</a>
                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-chart-line me-2"></i>Reportes</a>
                <a href="#" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i class="fas fa-power-off me-2"></i>Cerrar Sesion</a>
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
                                <i class="fas fa-user me-2"></i>Usuario
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid" style="margin-top: 80px; padding: 10px;">
                <div class="row">
                    <div class="col-md-12">
                        <h1 style="text-align: center;">Realizar Servicio</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div id="qr-reader" style="width: 100%;"></div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6 mt-2">
                        <div class="card" style="width: 100%;">
                            <div class="card-body">
                                <h5 class="card-title">Información del cliente.</h5>
                                <p class="card-text" id="nom_clieView"></p>
                                <p class="card-text" id="raz_socView"></p>
                                <p class="card-text" id="rfc_view"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="card" style="width: 100%;">
                            <div class="card-body">
                                <h5 class="card-title">Dirección</h5>
                                <p class="card-text" id="estadoView"></p>
                                <p class="card-text" id="municipioView"></p>
                                <p class="card-text" id="coloniaView"></p>
                                <p class="card-text" id="calleView"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Informacion del sanitario -->
                <br>
                <div class="row g-3">
                    <div class="col-md-12 mt-2">
                        <div class="card" style="width: 100%;">
                            <div class="card-body">
                                <h5 class="card-title">Informacion del sanitario</h5>
                                <p class="card-text" id="num_sanView"></p>
                                <p class="card-text" id="tip_sanView"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-3">
                    <div class="col-md-12 mt-2">
                        <div class="card" style="width: 100%;">
                            <div class="card-body">
                                <h5 class="card-title">Realizar Servicio</h5>
                                <form id="formularioADDSerBit">
                                        <input type="hidden" class="form-control" id="operadorADD" name="operadorADD" value="ejemplo">
                                        <input type="hidden" class="form-control" id="servicioADD" name="servicioADD">
                                        <input type="hidden" class="form-control" id="clienteADD" name="clienteADD">
                                        <input type="hidden" class="form-control" id="sanitarioADD" name="sanitarioADD">
                                        <input type="hidden" class="form-control" id="coordADD" name="coordADD">
                                    <div class="mb-3">
                                        <label for="comentarioADD" class="form-label">Comentario: </label>
                                        <textarea type="text" class="form-control" id="comentarioADD" name="comentarioADD"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="evidenciaADD" class="form-label">Evidencia: </label>
                                        <input type="file" capture="camera" class="form-control" id="evidenciaADD" name="evidenciaADD">
                                    </div>
                                    <div style="display: flex; justify-content: right;">
                                        <button type="submit" class="btn btn-primary">Realizar Servicio</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="static/js/jquery-3.6.3.min.js"></script>
    <script src="static/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>
    <script src="static/js/servicio/servicio.js"></script>
</body>

</html>