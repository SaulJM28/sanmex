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
    <link rel="stylesheet" href="../../static/css/normalize.css" />
    <link rel="manifest" href="../../manifest.json" />
    <meta name="theme-color">
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
                <a href="../../src/sanitarios/sanitarios.php" class="list-group-item list-group-item-action second-text fw-bold ">Sanitarios</a>
                <a href="../../src/operadores/operadores.php" class="list-group-item list-group-item-action second-text fw-bold">Operadores</a>
                <a href="../../src/usuario/usuarios.php" class="list-group-item list-group-item-action second-text fw-bold active">Usuarios</a>
                <a href="../../src/direcciones/direcciones.php" class="list-group-item list-group-item-action second-text fw-bold ">Direcciones</a>
                <a href="../../src/clientes/clientes.php" class="list-group-item list-group-item-action second-text fw-bold">Clientes</a>
                <a href="../../src/servicios/servicios.php" class="list-group-item list-group-item-action second-text fw-bold">Generar Servicio</a>
                <a href="../../src/bitacoraSerRea/listaBitacoraServRea.php" class="list-group-item list-group-item-action second-text fw-bold">Bitacora de Servicios</a>
                <a href="../../src/rutas/listaRutas.php" class="list-group-item list-group-item-action second-text fw-bold">Rutas</a>
                <a href="../../include/logout.php" class="list-group-item list-group-item-action text-danger fw-bold"><i
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
                    <h2 class="fs-2 m-0">Usuarios</h2>
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
                                    <h1 style="text-align: center;">Lista de Usuarios</h1>
                                </div>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Agregar
                                    usuario <i class="fas fa-user-plus"> </i></button>
                                <br>
                                <br>
                                <div class="row g-3">
                                    <div class="col-md-12 mt-2">
                                        <table id="tablaUsuarios" class="table table-striped  nowrap"
                                            style="width:100%;">
                                            <thead style="background-color: #222059; color: white;">
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Usuario</th>
                                                    <th>Contraseña</th>
                                                    <th>Tipo</th>
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
                    <h4 class="modal-title">Agregar Usuario</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div id="mensajeADD">
                    </div>
                    <form method="POST" id="formularioADDUsuario">
                        <div class="mb-3 mt-3">
                            <label for="nom_ope_add" class="form-label">Operador:</label>

                            <select class="form-select" name="nom_ope_add" id="nom_ope_add" required>
                                <option value="" selected>Seleccione una opcion</option>
                                <?php
                                $mysqli = new mysqli("localhost", "root", "", "sanmex");
                                /* comprobar la conexión */
                                if ($mysqli->connect_errno) {
                                    printf("Falló la conexión: %s\n", $mysqli->connect_error);
                                    exit();
                                }
                                /* consulta SELECT */
                                if ($resultado = $mysqli->query("SELECT * FROM `operadores` WHERE estatus = 'ACTIVO'")) {
                                    /* recorrer los resultados  */
                                    while ($fila = $resultado->fetch_assoc()):
                                        ?>
                                        <option value="<?= $fila["id_ope"] ?>">
                                            <?= $fila["nom"] ?>         <?= $fila["ap1"] ?>
                                            <?= $fila["ap2"] ?>
                                        </option>
                                        <?php
                                    endwhile;
                                } ?>
                            </select>


                        </div>
                        <div class="mb-3 mt-3">
                            <label for="nom_usu_add" class="form-label">Nombre Usuario:</label>
                            <input type="text" class="form-control" id="nom_uso_add"
                                placeholder="Ingrese un nombre de usuario" name="nom_uso_add" minlength="3"
                                maxlength="8" required>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="pwd_usu_add" class="form-label">Contraseña Usuario:</label>
                            <input type="password" class="form-control" id="pwd_usu_add"
                                placeholder="Ingrese una contraseña" name="pwd_usu_add" minlength="3" maxlength="8"
                                required>
                            <small>La contraseña debe tener 8 caracteres, entre ellos debe haber mayusculas, minusculas,
                                numeros y simbolos (!-@-?-¿-$)</small>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="tip_usu_add" class="form-label">Tipo de usuario:</label>
                            <select id="tip_usu_add" name="tip_usu_add" class="form-select" required>
                                <option value="" selected>seleccione una opcion</option>
                                <option value="OPERADOR">Operador</option>
                                <option value="ALMACENISTA">Almacenista</option>
                                <option value="ADMINISTRADOR">Administrador</option>
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
                    <h4 class="modal-title">Editar usuario</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div id="mensajeUP">
                    </div>
                    <form method="POST" id="formularioUpdateUsuario">
                        <div class="mb-3 mt-3">
                            <label for="nombre_ope_up" class="form-label">Nombre Operador: </label>
                            <input type="hidden" id="id_usu_up" name="id_usu_up">
                            <input type="text" class="form-control" id="nombre_ope_up"
                                placeholder="Ingrese el nombre del operador" name="nombre_ope_up" readonly>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="nom_usu_up" class="form-label">Nombre Usuario: </label>
                            <input type="text" class="form-control" id="nom_usu_up"
                                placeholder="Ingrese el primer apellido del operador" name="nom_usu_up" required>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="pwd_usu_up" class="form-label">Contraseña Usuario: </label>
                            <input type="password" class="form-control" id="pwd_usu_up"
                                placeholder="Ingrese el segundo apellido del operador" name="pwd_usu_up" required>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="tip_usu_up" class="form-label">Tipo de usuario:</label>
                            <select id="tip_usu_up" name="tip_usu_up" class="form-select" required>
                                <option value="" selected>seleccione una opcion</option>
                                <option value="OPERADOR">Operador</option>
                                <option value="ALMACENISTA">Almacenista</option>
                                <option value="ADMINISTRADOR">Administrador</option>
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
                    <h4 class="modal-title">Eliminar Usuario</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div id="mensajeDE">
                    </div>
                    <form method="POST" id="formularioDeleteUsuario">
                        <div class="mb-3 mt-3">
                            <label for="num_san_de" class="form-label">Nombre de Usuario:</label>
                            <input type="hidden" id="id_usu_de" name="id_usu_de">
                            <input type="text" class="form-control" id="nom_usu_de"
                                placeholder="Ingrese el numero del saniatraio" name="nom_usu_de" readonly>
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
    <script src="../../static/js/usuarios/usuario.js"></script>
</body>

</html>

<?php
else :
    header('location: ../../include/logout.php');
endif;
?>