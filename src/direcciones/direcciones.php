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
                    <a href="../../src/direcciones/direcciones.php" class="list-group-item list-group-item-action second-text fw-bold active">Direcciones</a>
                    <a href="../../src/clientes/clientes.php" class="list-group-item list-group-item-action second-text fw-bold">Clientes</a>
                    <a href="../../src/servicios/servicios.php" class="list-group-item list-group-item-action second-text fw-bold">Generar Servicio</a>
                    <a href="../../src/bitacoraSerRea/listaBitacoraServRea.php" class="list-group-item list-group-item-action second-text fw-bold">Bitacora de Servicios</a>
                    <a href="../../src/rutas/listaRutas.php" class="list-group-item list-group-item-action second-text fw-bold">Rutas</a>
                    <a href="../../include/logout.php" class="list-group-item list-group-item-action text-danger fw-bold"><i class="fas fa-power-off me-2"></i>Cerrar Sesion</a>
                </div>
            </div>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg fixed-top navbar-dark px-4" style="background-color:  #222059; color: white;">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-align-left primary-text fs-4 me-3" style="color: white;" id="menu-toggle"></i>
                        <h2 class="fs-2 m-0">DIRECCIONES</h2>
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
                            <div class="card sombra">
                                <div class="card-body">
                                    <div>
                                        <a href="../../home.php" class="btn btn-default"><i class="fas fa-arrow-left"></i></a>
                                        <h1 style="text-align: center;">Lista de Direcciones</h1>
                                    </div>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Agregar <i class="fas fa-plus"> </i></button>
                                    <br>
                                    <br>
                                    <table id="tableDirecciones" class="table table-striped  nowrap" style="width:100%;">
                                        <thead style="background-color: #222059; color: white;">
                                            <tr>
                                                <th>ESTADO</th>
                                                <th>MUNICIPIO</th>
                                                <th>COLONIA</th>
                                                <th>CALLE</th>
                                                <th>NUM_EXT</th>
                                                <th>NUM_INT</th>
                                                <th>CP</th>
                                                <th>COORDENADAS</th>
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


        <!-- modal para agregar -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar Dirección</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="mensajeADD"></div>
                        <form class="row g-3" method="POST" id="formularioADDDireccion">
                            <div class="col-md-6 mt-2">
                                <div class="mb-3 mt-3">
                                    <label for="est_dir_add" class="form-label">Estado:</label>
                                    <input type="text" class="form-control" id="est_dir_add" placeholder="Ingrese el estado" name="est_dir_add" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="mun_dir_add" class="form-label">Municipio:</label>
                                    <input type="text" class="form-control" id="mun_dir_add" placeholder="Ingrese el municipio" name="mun_dir_add" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="col_dir_add" class="form-label">Colonia:</label>
                                    <input type="text" class="form-control" id="col_dir_add" placeholder="Ingrese la colonia" name="col_dir_add" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="call_dir_add" class="form-label">Calle:</label>
                                    <input type="text" class="form-control" id="call_dir_add" placeholder="Ingrese la calle" name="call_dir_add" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <div class="mb-3 mt-3">
                                    <label for="numext_dir_add" class="form-label">num_ext:</label>
                                    <input type="text" class="form-control" id="numext_dir_add" placeholder="Ingrese el numero ext" name="numext_dir_add" required>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="numint_dir_add" class="form-label">num_int:</label>
                                    <input type="text" class="form-control" id="numint_dir_add" placeholder="Ingrese el numero int" name="numint_dir_add" required>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="cp_dir_add" class="form-label">cp:</label>
                                    <input type="text" class="form-control" id="cp_dir_add" placeholder="Codigo Postal" name="cp_dir_add" required>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="coord_dir_add" class="form-label">coordenadas:</label>
                                    <input type="text" class="form-control" id="coord_dir_add" placeholder="Coordenadas" name="coord_dir_add" required>
                                </div>
                            </div>
                            <div style="display: flex; justify-content: right;">
                                <button type="submit" class="btn btn-primary">Aceptar <i class="fas fa-plus"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        <!-- modal para editar -->
        <div class="modal fade" id="ModalUpdate" tabindex="-1" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Dirección</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="mensajeUP"></div>
                        <form class="row" method="POST" id="formularioUPDireccion">
                            <div class="col-md-6">
                                <div class="mb-3 mt-3">
                                    <label for="est_dir_up" class="form-label">Estado:</label>
                                    <input type="hidden" class="form-control" id="id_dire_up" name="id_dire_up">
                                    <input type="text" class="form-control" id="est_dir_up" placeholder="Ingrese el estado" name="est_dir_up" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="mun_dir_up" class="form-label">Municipio:</label>
                                    <input type="text" class="form-control" id="mun_dir_up" placeholder="Ingrese el municipio" name="mun_dir_up" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="col_dir_up" class="form-label">Colonia:</label>
                                    <input type="text" class="form-control" id="col_dir_up" placeholder="Ingrese la colonia" name="col_dir_up" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="call_dir_up" class="form-label">Calle:</label>
                                    <input type="text" class="form-control" id="call_dir_up" placeholder="Ingrese la calle" name="call_dir_up" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 mt-3">
                                    <label for="numext_dir_up" class="form-label">num_ext:</label>
                                    <input type="text" class="form-control" id="numext_dir_up" placeholder="Ingrese el numero ext" name="numext_dir_up" required>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="numint_dir_up" class="form-label">num_int:</label>
                                    <input type="text" class="form-control" id="numint_dir_up" placeholder="Ingrese el numero int" name="numint_dir_up" required>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="cp_dir_up" class="form-label">cp:</label>
                                    <input type="text" class="form-control" id="cp_dir_up" placeholder="Codigo Postal" name="cp_dir_up" required>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="coord_dir_up" class="form-label">coordenadas:</label>
                                    <input type="text" class="form-control" id="coord_dir_up" placeholder="Coordenadas" name="coord_dir_up" required>
                                </div>
                            </div>
                            <div style="display: flex; justify-content: right;">
                                <button type="submit" class="btn btn-warning">Aceptar <i class="fas fa-edit"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal para eliminar registro -->
        <div class="modal fade" id="ModalDelete" tabindex="-1" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar Dirección</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="mensajeDE"></div>
                        <form method="POST" id="formularioDeleteDireccion">
                            <input type="hidden" class="form-control" id="id_dire_de" name="id_dire_de">
                            <div class="mb-3 mt-3">
                                <p>¿Desea eliminar el registo?</p>
                            </div>
                            <div style="display: flex; justify-content: right;">
                                <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn btn-secondary">Cancelar <i class="fas fa-times"></i></button>
                                <button type="submit" class="btn btn-danger">Aceptar <i class="fas fa-trash"></i></button>
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
        <script src="../../static/js/direcciones/direcciones.js"></script>


    </body>

    </html>

<?php
else :
    header('location: ../../include/logout.php');
endif;
?>