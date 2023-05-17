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
        <?php include '../componentes/sidebar.php' ?>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg fixed-top navbar-dark px-4"
                style="background-color:  #222059; color: white;">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" style="color: white;" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Tipo de Servicios</h2>
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
                                    <h1 style="text-align: center;">Lista de Tipos de Servicios</h1>
                                </div>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Agregar <i class="fas fa-plus"> </i></button>
                                <br>
                                <br>
                                <div class="row g-3">
                                    <div class="col-md-12 mt-2">
                                        <table id="tablaTipServicios" class="table table-striped nowrap"
                                            style="width:100%;">
                                            <thead style="background-color: #222059; color: white;">
                                                <tr>
                                                    <th>Tipo</th>
                                                    <th>Fecha Creacion</th>
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
                    <h4 class="modal-title">Agregar Tipo</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form method="POST" id="formularioADDTipServicio">
                        <div class="mb-3 mt-3">
                            <label for="tipSerAdd" class="form-label">Tipo:</label>
                            <input type="text" class="form-control" id="tipSerAdd"
                                placeholder="Ingrese el nombre del tipo de servicio" name="tipSerAdd" minlength="1"
                                maxlength="100" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
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
                    <h4 class="modal-title">Editar</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div id="mensajeUP">
                    </div>
                    <form method="POST" id="formularioUpdateCargTipServicioo">
                        <div class="mb-3 mt-3">
                            <label for="tipSerUp" class="form-label">Tipo: </label>
                            <input type="hidden" id="idSerUp" name="idSerUp">
                            <input type="text" class="form-control" id="tipSerUp"
                                placeholder="Ingrese el nombre del tipo de servicio" name="tipSerUp" onkeyup="javascript:this.value=this.value.toUpperCase();">
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
                    <h4 class="modal-title">Eliminar </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form method="POST" id="formularioDeleteTipServicioo">
                    <div class="mb-3 mt-3">
                            <label for="tipSerDe" class="form-label">Tipo: </label>
                            <input type="hidden" id="idSerDe" name="idSerDe">
                            <input type="text" class="form-control" id="tipSerDe"
                                placeholder="Ingrese el nombre del tipo de servicio" name="tipSerDe" readonly>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../static/js/tipoServicios/tipoServicios.js"></script>
</body>

</html>

<?php
else :
    header('location: ../../include/logout.php');
endif;
?>