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
                    <h2 class="fs-2 m-0">CLIENTES</h2>
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
                                <i class="fas fa-user me-2"></i>Usuario
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid px-4" style="margin-top: 80px;">
                <div class="row g-3">
                    <div class="col-md-12 mt-3">
                        <div class="card sombra">
                            <div class="card-body">
                                <div>
                                <a href="../../home.php" class="btn btn-default"><i class="fas fa-arrow-left"></i></a>
                                    <h1 style="text-align: center;">Lista de Clientes</h4>
                                </div>
                                    <div class="row g-3">
                                        <div class="col-md-12" style="display: flex; justify-content: left;">
                                            <button class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#ModalADD">Agregar <i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <br>
                                    <table id="datatableListClient" class="table table-striped  nowrap"
                                        style="width:100%;">
                                        <thead style="background-color: #222059; color: white;">
                                            <tr>
                                                <th>NOMBRE</th>
                                                <th>RFC</th>
                                                <th>RAZON SOCIAL</th>
                                                <th>NOM_CON</th>
                                                <th>NUM_CON</th>
                                                <th>FEC_CREA</th>
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
    <!-- MODAL PARA AGREGAR CLIENTE -->
    <div class="modal fade" id="ModalADD" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="mensajeADD"></div>
                    <form id="formularioADDCliente">
                        <div class="mb-3 mt-3">
                            <label for="nom_clie_add" class="form-label">Nombre del cliente:</label>
                            <input type="text" class="form-control" id="nom_clie_add" name="nom_clie_add"
                                placeholder="Ingrese el nombre del cliente" required onkeyup="javascript:this.value=this.value.toUpperCase();">
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="rfc_clie_add" class="form-label">RFC:</label>
                            <input type="text" class="form-control" id="rfc_clie_add" name="rfc_clie_add"
                                placeholder="Ingrese el RFC del cliente" minlength="12" maxlength="13" required>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="razsoc_clie_add" class="form-label">Razon Social:</label>
                            <input type="text" class="form-control" id="razsoc_clie_add" name="razsoc_clie_add"
                                placeholder="Ingrese la razon social del cliente" required onkeyup="javascript:this.value=this.value.toUpperCase();">
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="nomcon_clie_add" class="form-label">Nombre del contacto:</label>
                            <input type="text" class="form-control" id="nomcon_clie_add" name="nomcon_clie_add"
                                placeholder="Ingrese el nombre de contacto del cliente" required onkeyup="javascript:this.value=this.value.toUpperCase();">
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="numtel_clie_add" class="form-label">Número teléfonico del contacto:</label>
                            <input type="text" class="form-control" id="numtel_clie_add" name="numtel_clie_add"
                                placeholder="Ingrese el numero telefonico del contacto del cliente" minlength="10" maxlength="10" required>
                        </div>
                        <div style="display: flex; justify-content: right;">
                            <button type="submit" class="btn btn-primary">Agregar <i class="fas fa-plus"></i></button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL PARA editar CLIENTE -->
    <div class="modal fade" id="ModalUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="mensajeUP"></div>
                    <form id="formularioUPDATECliente">
                        <div class="mb-3 mt-3">
                            <input type="hidden" id="id_up" name="id_up">
                            <label for="nom_clie_up" class="form-label">Nombre del cliente:</label>
                            <input type="text" class="form-control" id="nom_clie_up" name="nom_clie_up"
                                placeholder="Ingrese el nombre del cliente" required onkeyup="javascript:this.value=this.value.toUpperCase();">
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="rfc_clie_up" class="form-label">RFC:</label>
                            <input type="text" class="form-control" id="rfc_clie_up" name="rfc_clie_up"
                                placeholder="Ingrese el RFC del cliente" minlength="12" maxlength="13" required>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="razsoc_clie_up" class="form-label">Razon Social:</label>
                            <input type="text" class="form-control" id="razsoc_clie_up" name="razsoc_clie_up"
                                placeholder="Ingrese la razon social del cliente" required onkeyup="javascript:this.value=this.value.toUpperCase();">
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="nomcon_clie_up" class="form-label">Nombre del contacto:</label>
                            <input type="text" class="form-control" id="nomcon_clie_up" name="nomcon_clie_up"
                                placeholder="Ingrese el nombre de contacto del cliente" required onkeyup="javascript:this.value=this.value.toUpperCase();">
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="numtel_clie_up" class="form-label">Número teléfonico del contacto:</label>
                            <input type="text" class="form-control" id="numtel_clie_up" name="numtel_clie_up"
                                placeholder="Ingrese el numero telefonico del contacto del cliente" required minlength="10" maxlength="10">
                        </div>
                        <div style="display: flex; justify-content: right;">
                            <button type="submit" class="btn btn-warning">Editar <i class="fas fa-edit"></i></button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
        <!-- MODAL PARA ELIMIAR CLIENTE -->
        <div class="modal fade" id="ModalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="mensajeDE"></div>
                    <form id="formularioDeleteCliente">
                        <div class="mb-3 mt-3">
                            <input type="hidden" id="id_de" name="id_de">
                            <label for="nom_clie_de" class="form-label">Nombre del cliente:</label>
                            <input type="text" class="form-control" id="nom_clie_de" name="nom_clie_de"
                                placeholder="Ingrese el nombre del cliente" required readonly>
                        </div>
                        <div style="display: flex; justify-content: right;">
                            <button type="submit" class="btn btn-danger">Eliminar <i class="fas fa-trash"></i></button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>


    <script src="../../static/js/jquery-3.6.3.min.js"></script>
    <script src="../../static/js/datatables.min.js"></script>
    <script src="../../static/js/bootstrap.min.js"></script>
    <script src="../../static/js/clientes/cliente.js"></script>
</body>

</html>