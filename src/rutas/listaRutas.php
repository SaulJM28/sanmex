<?php
session_start();
if (isset($_SESSION['nom_usu']) && $_SESSION['tip_usu'] == "ADMINISTRADOR") :
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
            <div class="fondo__sidebar" id="sidebar-wrapper">
                <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">SANMEX</div>
                <div class="list-group list-group-flush my-3">
                    <a href="../../src/sanitarios/sanitarios.php" class="list-group-item list-group-item-action second-text fw-bold">Sanitarios</a>
                    <a href="../../src/operadores/operadores.php" class="list-group-item list-group-item-action second-text fw-bold">Operadores</a>
                    <a href="../../src/usuario/usuarios.php" class="list-group-item list-group-item-action second-text fw-bold">Usuarios</a>
                    <a href="../../src/direcciones/direcciones.php" class="list-group-item list-group-item-action second-text fw-bold ">Direcciones</a>
                    <a href="../../src/clientes/clientes.php" class="list-group-item list-group-item-action second-text fw-bold">Clientes</a>
                    <a href="../../src/servicios/servicios.php" class="list-group-item list-group-item-action second-text fw-bold">Generar Servicio</a>
                    <a href="../../src/bitacoraSerRea/listaBitacoraServRea.php" class="list-group-item list-group-item-action second-text fw-bold">Bitacora de Servicios</a>
                    <a href="../../src/rutas/listaRutas.php" class="list-group-item list-group-item-action second-text fw-bold active">Rutas</a>
                    <a href="../../include/logout.php" class="list-group-item list-group-item-action text-danger fw-bold"><i class="fas fa-power-off me-2"></i>Cerrar Sesion</a>
                </div>
            </div>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg fixed-top navbar-dark px-4" style="background-color:  #222059; color: white;">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-align-left primary-text fs-4 me-3" style="color: white;" id="menu-toggle"></i>
                        <h2 class="fs-2 m-0">RUTAS</h2>
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

                <div class="container-fluid px-4" style="margin-top: 80px;">
                    <div class="row g-3">
                        <div class="col-md-12 mt-3">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <a href="../../home.php" class="btn btn-default"><i class="fas fa-arrow-left"></i></a>
                                        <h1 style="text-align: center;">Lista de Rutas</h1>
                                    </div>

                                    <form class="row g-3" method="POST" enctype="multipart/form-data" id="formularioADDRuta">
                                        <div class="col-md-4 col-auto">
                                            <label for="nom_ruta_add" class="visually-hidden">Nombre de la ruta</label>
                                            <input type="text" class="form-control" id="nom_ruta_add" placeholder="Ingrese el nombre de la ruta" required onkeyup="javascript:this.value=this.value.toUpperCase();">
                                        </div>

                                        <div class="col-md-4 col-auto">
                                            <label for="nom_ope_add" class="visually-hidden">Operador</label>
                                            <select class="form-select" name="nom_ope_add" id="nom_ope_add" required></select>
                                        </div>

                                        <div class="col-md-4 col-auto">
                                            <button type="submit" class="btn btn-primary mb-3">Agregar Ruta</button>
                                        </div>
                                    </form>

                                    <div class="row g-3">
                                        <div class="col-md-12 mt-2">
                                            <table id="tableRutas" class="table table-striped  nowrap" style="width:100%;">
                                                <thead style="background-color: #222059; color: white;">
                                                    <tr>
                                                        <th>Ruta</th>
                                                        <th>Operador Asignado</th>
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
        <!-- modal actualizar -->
        <div class="modal fade" id="ModalUpdate">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Editar Ruta</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <form method="POST" id="formularioUpdateRuta">
                            <div class="mb-3 mt-3">
                                <label for="nom_rut_up" class="form-label">Nombre Ruta:</label>
                                <input type="hidden" id="id_rut_up" name="id_rut_up">
                                <input type="text" class="form-control" id="nom_rut_up" placeholder="Ingrese el nombre del operador" name="nom_rut_up" required onkeyup="javascript:this.value=this.value.toUpperCase();">
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="nom_rut_up" class="form-label">Operador:</label>
                                <select class="form-select" name="nom_ope_up" id="nom_ope_up" required></select>
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
                        <h4 class="modal-title">Eliminar Ruta</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <form method="POST" id="formularioDeleteRuta">
                            <div class="mb-3 mt-3">
                                <label for="nom_rut_de" class="form-label">Nombre de la Ruta:</label>
                                <input type="hidden" id="id_rut_de" name="id_rut_de">
                                <input type="text" class="form-control" id="nom_rut_de" placeholder="Ingrese el numero del saniatraio" name="nom_rut_de" readonly>
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
        <script src="../../static/js/rutas/ruta.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
    </html>
<?php
else :
    header('location: ../../include/logout.php');
endif;
?>