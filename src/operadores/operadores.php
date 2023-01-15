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
                    <i class="fas fa-toilet me-2"></i>operadors</a>
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
                    <h2 class="fs-2 m-0">OPERADORES</h2>
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
                    <div class="col-md-12 mt-3">
                        <div class="card">
                            <div class="card-body">
                                <h1 style="text-align: center;">Lista de Operadores</h1>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Agregar <i class="fas fa-plus"> </i></button>
                                    <br>
                                    <br>
                                <div class="row g-3">
                                    <div class="col-md-12 mt-2">
                                        <table id="tablaOperadores" class="table table-striped  nowrap" style="width:100%;">
                                            <thead style="background-color: #222059; color: white;">
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Primer Apellido</th>
                                                    <th>Segundo Apellido</th>
                                                    <th>Teléfono</th>
                                                    <th>Fecha creación</th>
                                                    <th>Estatus</th>
                                                    <th>Acciones</th>
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
            
        </div>
    </div>
    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Agregar operador</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div id="mensajeADD">
                    </div>
                    <form method="POST" id="formularioADDOperador">
                        <div class="mb-3 mt-3">
                            <label for="nom_ope_add" class="form-label">Nombre de operador:</label>
                            <input type="text" class="form-control" id="nom_ope_add" placeholder="Ingrese el nombre del operador" name="nom_ope_add" required>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="ap1_ope_add" class="form-label">Primer Apellido:</label>
                            <input type="text" class="form-control" id="ap1_ope_add" placeholder="Ingrese el primer apellido del operador" name="ap1_ope_add" required>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="ap2_ope_add" class="form-label">Segundo Apellido:</label>
                            <input type="text" class="form-control" id="ap2_ope_add" placeholder="Ingrese el segundo apellido del operador" name="ap2_ope_add" required>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="tel_add" class="form-label">Teléfono:</label>
                            <input type="text" class="form-control" id="tel_ope_add" placeholder="Ingrese el teléfono del operador" name="tel_ope_add">
                            <small>Campo opcional</small>
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
                    <h4 class="modal-title">Editar operador</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div id="mensajeUP">
                    </div>
                    <form method="POST" id="formularioUpdateoperador">
                        <div class="mb-3 mt-3">
                            <label for="nombre_up" class="form-label">Nombre:</label>
                            <input type="hidden" id="id_ope_up" name="id_ope_up">
                            <input type="text" class="form-control" id="nombre_ope_up" placeholder="Ingrese el nombre del operador" name="nombre_ope_up" required>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="ap1_ope_up" class="form-label">Primer Apellido:</label>
                            <input type="text" class="form-control" id="ap1_ope_up" placeholder="Ingrese el primer apellido del operador" name="ap1_ope_up" required>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="ap2_ope_up" class="form-label">Segundo Apellido:</label>
                            <input type="text" class="form-control" id="ap2_ope_up" placeholder="Ingrese el segundo apellido del operador" name="ap2_ope_up" required>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="tel_op_up" class="form-label">Teléfono:</label>
                            <input type="text" class="form-control" id="tel_op_up" placeholder="Ingrese el teléfono del operador" name="tel_op_up" required>
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
                    <h4 class="modal-title">Eliminar operador</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div id="mensajeDE">
                    </div>
                    <form method="POST" id="formularioDeleteoperador">
                        <div class="mb-3 mt-3">
                            <label for="num_san_de" class="form-label">Nombre del operador:</label>
                            <input type="hidden" id="id_ope_de" name="id_ope_de">
                            <input type="text" class="form-control" id="nom_ope_de" placeholder="Ingrese el numero del saniatraio" name="nom_ope_de" readonly>
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
    <script src="../../static/js/operadores/operador.js"></script>
</body>
</html>