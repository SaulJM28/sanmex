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
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">SANMEX</div>
            <div class="list-group list-group-flush my-3">
                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text active">
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
                    <h2 class="fs-2 m-0">Dashboard</h2>
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

            <div class="container-fluid px-4" style="margin-top: 80px;">
                <div class="row g-3">
                    <div class="col-md-4 mt-3">
                        <div class="card sombra" style="border-left: 5px solid green;">
                            <div class="card-body" style="display:flex; justify-content:space-between;">
                                <h5>Sanitarios disponibles</h5>
                                <h5>50</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-3">
                        <div class="card sombra" style="border-left: 5px solid yellow;">
                            <div class="card-body" style="display:flex; justify-content:space-between;">
                                <h5>Sanitarios disponibles</h5>
                                <h5>50</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-3">
                        <div class="card sombra" style="border-left: 5px solid red;">
                            <div class="card-body" style="display:flex; justify-content:space-between;">
                                <h5>Sanitarios disponibles</h5>
                                <h5>50</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12 mt-3">
                        <div class="card sombra">
                            <div class="card-body">
                                <div id="chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-3">
                    <div class="col-md-12 mt-3">
                        <div class="card sombra">
                            <div class="card-body">
                                <h1 style="text-align: center;">Últimos 10 sanitarios atentidos</h4>
                                    <table id="datatable" class="table table-striped  nowrap" style="width:100%;">
                                        <thead style="background-color: #222059; color: white;">
                                            <tr>
                                                <th># SANITARIO</th>
                                                <th>DESC SANITARIO</th>
                                                <th>TIPO</th>
                                                <th>ESTATUS</th>
                                                <th>FEC_SER</th>
                                                <th>CLIENTE</th>
                                                <th>ACCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>NOM_USU</td>
                                                <td>PWD</td>
                                                <td>TIPO</th>
                                                <td>ESTATUS</td>
                                                <td>FEC_CRE</td>
                                                <td>ESTATUS</td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <button type="button" class="btn btn-sm btn-default"><i class="fas fa-edit"></i></button>
                                                        <button type="button" class="btn btn-sm btn-default"><i class="fas fa-trash"></i></button>
                                                        <button type="button" class="btn btn-sm btn-default" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="generateQRCode(255)"><i class="fas fa-qrcode"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
    </div>



    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Informacion del sanitario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Escanea el código QR para obtner información del servicio</p>
                    <div style="display:flex; justify-content: center;" id="show_qr">
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <script src="static/js/jquery-3.6.3.min.js"></script>
    <script src="static/js/datatables.min.js"></script>
    <script src="static/js/bootstrap.min.js"></script>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="static/js/Home/home.js"></script>

</body>

</html>