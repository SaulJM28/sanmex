<?php
session_start();
if (isset($_SESSION['nom_usu']) && ($_SESSION['tip_usu'] == "ADMINISTRADOR" || $_SESSION['tip_usu'] == 'EJECUTIVO VENTAS')) :
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
                <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">SANMEX
                </div>
                <div class="list-group list-group-flush my-3">
                    <a href="../../src/sanitarios/sanitarios.php" class="list-group-item list-group-item-action second-text fw-bold">Sanitarios</a>
                    <a href="../../src/operadores/operadores.php" class="list-group-item list-group-item-action second-text fw-bold">Operadores</a>
                    <a href="../../src/usuario/usuarios.php" class="list-group-item list-group-item-action second-text fw-bold">Usuarios</a>
                    <a href="../../src/direcciones/direcciones.php" class="list-group-item list-group-item-action second-text fw-bold">Direcciones</a>
                    <a href="../../src/clientes/clientes.php" class="list-group-item list-group-item-action second-text fw-bold active">Clientes</a>
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
                        <h2 class="fs-2 m-0">CLIENTES</h2>
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
                                        <h1 style="text-align: center;">Lista de Clientes</h4>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-12" style="display: flex; justify-content: left;">
                                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalADD">Agregar <i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <br>
                                    <table id="datatableListClient" class="table table-striped  nowrap" style="width:100%;">
                                        <thead style="background-color: #222059; color: white;">
                                            <tr>
                                                <th>NOMBRE</th>
                                                <th>TEL_ClIE</th>
                                                <th>RFC</th>
                                                <th>RAZON SOCIAL</th>
                                                <th>DIRECCION</th>
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
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar Cliente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" method="POST" id="formularioADDCliente">
                            <div class="col-md-12 mt-3">
                                <h6><b>Informacion del responsable que contrata el servicio</b></h6>
                                <div class="mb-3 mt-3">
                                    <label for="nom_clie_add" class="form-label">Nombre del cliente:</label>
                                    <input type="text" class="form-control" id="nom_clie_add" name="nom_clie_add" placeholder="Ingrese el nombre del cliente" required onkeyup="javascript:this.value=this.value.toUpperCase();">
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="tel_clie_add" class="form-label">Teléfono del cliente:</label>
                                    <input type="text" class="form-control" id="tel_clie_add" name="tel_clie_add" placeholder="Ingrese el nombre del cliente" required>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="rfc_clie_add" class="form-label">RFC:</label>
                                    <input type="text" class="form-control" id="rfc_clie_add" name="rfc_clie_add" placeholder="Ingrese el RFC del cliente" minlength="12" maxlength="13" required>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="razsoc_clie_add" class="form-label">Razon Social:</label>
                                    <input type="text" class="form-control" id="razsoc_clie_add" name="razsoc_clie_add" placeholder="Ingrese la razon social del cliente" required onkeyup="javascript:this.value=this.value.toUpperCase();">
                                </div>
                            </div>
                            <div style="display: flex; justify-content: center;">
                                <h6><b>Direccion del cliente (Fiscal)</b></h6>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="buscarDir">Buscar Direccion</label>
                                    <input type="text" class="form-control" id="buscarDir" placeholder="Escriba el nombre de la calle/colonia" onkeyup="buscadorInfoDireClie('insert')" required>
                                    <small>De no exitir la direccion la puedes dar de alta <a href="../direcciones/direcciones.php">aqui</a></small>
                                </div>
                            </div>

                            <div class="col-md-12" id="mensajeBusDire">
                            </div>
                            <input type="hidden" id="idDir">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dirEst">Estado</label>
                                    <input type="text" class="form-control" name="dirEst" id="dirEst" placeholder="Estado" disabled readonly>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dirMun">Municipio</label>
                                    <input type="text" class="form-control" name="dirMun" id="dirMun" placeholder="Municipio" disabled readonly>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dirCol">Colonia</label>
                                    <input type="text" class="form-control" name="dirCol" id="dirCol" placeholder="Colonia" disabled readonly>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dirCalle">Calle</label>
                                    <input type="text" class="form-control" name="dirCalle" id="dirCalle" placeholder="Calle" disabled readonly>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dirNumExt">Num Ext</label>
                                    <input type="text" class="form-control" name="dirNumExt" id="dirNumExt" placeholder="Numero Exterior" disabled readonly>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dirNumInt">Num Int</label>
                                    <input type="text" class="form-control" name="dirNumInt" id="dirNumInt" placeholder="Numero Interior" disabled readonly>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dirCP">CP</label>
                                    <input type="text" class="form-control" name="dirCP" id="dirCP" placeholder="Codigo Postal" disabled readonly>
                                </div>
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
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Cliente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" method="POST" id="formularioUPDATECliente">
                            <div class="col-md-12">
                                <h6><b>Informacion del responsable que contrata el servicio</b></h6>
                                <div class="mb-3 mt-3">
                                    <input type="hidden" id="id_up" name="id_up">
                                    <label for="nom_clie_up" class="form-label">Nombre del cliente:</label>
                                    <input type="text" class="form-control" id="nom_clie_up" name="nom_clie_up" placeholder="Ingrese el nombre del cliente" required onkeyup="javascript:this.value=this.value.toUpperCase();">
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="tel_clie_up" class="form-label">Teléfono del cliente:</label>
                                    <input type="text" class="form-control" id="tel_clie_up" name="tel_clie_up" placeholder="Ingrese el nombre del cliente" required>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="rfc_clie_up" class="form-label">RFC:</label>
                                    <input type="text" class="form-control" id="rfc_clie_up" name="rfc_clie_up" placeholder="Ingrese el RFC del cliente" minlength="12" maxlength="13" required>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="razsoc_clie_up" class="form-label">Razon Social:</label>
                                    <input type="text" class="form-control" id="razsoc_clie_up" name="razsoc_clie_up" placeholder="Ingrese la razon social del cliente" required onkeyup="javascript:this.value=this.value.toUpperCase();">
                                </div>
                            </div>
                            <div style="display: flex; justify-content: center;">
                                <h6><b>Direccion del cliente (Fiscal)</b></h6>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="buscarDirUp">Buscar Direccion</label>
                                    <input type="text" class="form-control" id="buscarDirUp" placeholder="Escriba el nombre de la calle/colonia" onkeyup="buscadorInfoDireClie('update')" required>
                                    <small>De no exitir la direccion la puedes dar de alta <a href="../direcciones/direcciones.php">aqui</a></small>
                                </div>
                            </div>

                            <div class="col-md-12" id="mensajeBusDireUP">
                            </div>
                            <input type="hidden" id="idDirUp">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dirEstUP">Estado</label>
                                    <input type="text" class="form-control" name="dirEstUp" id="dirEstUp" placeholder="Estado" disabled readonly>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dirMunUp">Municipio</label>
                                    <input type="text" class="form-control" name="dirMunUp" id="dirMunUp" placeholder="Municipio" disabled readonly>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dirColUp">Colonia</label>
                                    <input type="text" class="form-control" name="dirColUp" id="dirColUp" placeholder="Colonia" disabled readonly>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dirCalleUp">Calle</label>
                                    <input type="text" class="form-control" name="dirCalleUp" id="dirCalleUp" placeholder="Calle" disabled readonly>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dirNumExtUp">Num Ext</label>
                                    <input type="text" class="form-control" name="dirNumExtUp" id="dirNumExtUp" placeholder="Numero Exterior" disabled readonly>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dirNumIntUp">Num Int</label>
                                    <input type="text" class="form-control" name="dirNumIntUp" id="dirNumIntUp" placeholder="Numero Interior" disabled readonly>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="dirCPUp">CP</label>
                                    <input type="text" class="form-control" name="dirCPUp" id="dirCPUp" placeholder="Codigo Postal" disabled readonly>
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
                                <input type="text" class="form-control" id="nom_clie_de" name="nom_clie_de" placeholder="Ingrese el nombre del cliente" required readonly>
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="../../static/js/clientes/cliente.js"></script>
    </body>

    </html>
<?php
else :
    header('location: ../../include/logout.php');
endif;
?>