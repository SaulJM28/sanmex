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
                    <h2 class="fs-2 m-0">SANITARIOS</h2>
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

            <div class="container-fluid px-4" style="margin-top: 80px; height: 100vh;">
                <div class="row g-3">
                    <div class="col-md-12 mt-3">
                        <div class="card sombra">
                            <div class="card-body">
                                <h1 style="text-align: center;">Lista de sanitarios</h4>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Agregar <i class="fas fa-plus"> </i></button>
                                    <br>
                                    <br>
                                    <table id="tableSanitarios" class="table table-striped  nowrap" style="width:100%;">
                                        <thead style="background-color: #222059; color: white;">
                                            <tr>
                                                <th># SANITARIO</th>
                                                <th>TIPO</th>
                                                <th>FEC_REG</th>
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
            
        </div>
    </div>
    <!-- /#page-content-wrapper -->
    </div>


    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Agregar sanitario</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div id="mensajeADD">
                    </div>
                    <form method="POST" id="formularioADDSanitario">
                        <div class="mb-3 mt-3">
                            <label for="num_san_add" class="form-label">Numero de sanitario:</label>
                            <input type="text" class="form-control" id="num_san_add" placeholder="Ingrese el numero del saniatraio" name="num_san_add" required>
                        </div>
                        <div class="mb-3">
                            <label for="tip_san_add" class="form-label">Tipo de sanitario:</label>
                            <select class="form-select" id="tip_san_add" name="tip_san_add" required>
                                <option value="CHICO">CHICO</option>
                                <option value="MEDIANO">MEDIANO</option>
                                <option value="GRANDE">GRANDE</option>
                            </select>
                        </div>
                        <div style="display: flex; justify-content: right;">
                            <button type="submit" class="btn btn-primary">Aceptar <i class="fas fa-plus"></i></button>
                        </div>
                    </form>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                </div>

            </div>
        </div>
    </div>

    <!-- modal actualizar -->
    <div class="modal fade" id="ModalUpdate">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Editar sanitario</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div id="mensajeUP">
                    </div>
                    <form method="POST" id="formularioUpdateSanitario">
                        <div class="mb-3 mt-3">
                            <label for="num_san_up" class="form-label">Numero de sanitario:</label>
                            <input type="text" class="form-control" id="num_san_up" placeholder="Ingrese el numero del saniatraio" name="num_san_up" required>
                        </div>
                        <div class="mb-3">
                            <label for="tip_san_up" class="form-label">Tipo de sanitario:</label>
                            <select class="form-select" id="tip_san_up" name="tip_san_up" required>
                                <option value="CHICO">CHICO</option>
                                <option value="MEDIANO">MEDIANO</option>
                                <option value="GRANDE">GRANDE</option>
                            </select>
                        </div>
                        <div style="display: flex; justify-content: right;">
                            <button type="submit" class="btn btn-warning">Aceptar <i class="fas fa-edit"></i></button>
                        </div>
                    </form>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                </div>

            </div>
        </div>
    </div>
    <!-- MODAL ELIMINAR -->
    <div class="modal fade" id="ModalDelete">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar sanitario</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div id="mensajeDE">
                    </div>
                    <form method="POST" id="formularioDeleteSanitario">
                        <div class="mb-3 mt-3">
                            <label for="num_san_de" class="form-label">Numero de sanitario:</label>
                            <input type="text" class="form-control" id="num_san_de" placeholder="Ingrese el numero del saniatraio" name="num_san_de" required>
                        </div>
                        <div style="display: flex; justify-content: right;">
                            <button type="submit" class="btn btn-danger">Aceptar <i class="fas fa-trash"></i></button>
                        </div>
                    </form>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                </div>

            </div>
        </div>
    </div>

    <script src="../../static/js/jquery-3.6.3.min.js"></script>
    <script src="../../static/js/bootstrap.min.js"></script>
    <script src="../../static/js/datatables.min.js"></script>
    <script src="../../static/js/sanitarios/sanitario.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</body>

</html>