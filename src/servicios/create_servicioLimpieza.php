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
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
        <title>SANMEX</title>
        <style>
            .leaflet-container {
                height: 400px;
                width: 100%;
                max-width: 100%;
                max-height: 100%;
            }
        </style>
    </head>

    <body>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar -->
            <div class="fondo__sidebar" id="sidebar-wrapper">
                <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">SANMEX
                </div>
                <div class="list-group list-group-flush my-3">
                    <a href="../../src/sanitarios/sanitarios.php" class="list-group-item list-group-item-action second-text fw-bold active">Sanitarios</a>
                    <a href="../../src/operadores/operadores.php" class="list-group-item list-group-item-action second-text fw-bold">Operadores</a>
                    <a href="../../src/usuario/usuarios.php" class="list-group-item list-group-item-action second-text fw-bold">Usuarios</a>
                    <a href="../../src/direcciones/direcciones.php" class="list-group-item list-group-item-action second-text fw-bold ">Direcciones</a>
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
                        <h2 class="fs-2 m-0">SERVICIOS</h2>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user me-2"></i> <?php echo $_SESSION['nom_usu']; ?>
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
                                        <a href="tipoServicio.php" class="btn btn-default"><i class="fas fa-arrow-left"></i></a>
                                        <h1 style="text-align: center;">Crear Servicio</h1>
                                        <p class="text-center">Campos obligatorios<strong style="color: red;">*</strong></p>
                                    </div>
                                    <form class="row g-3" id="formularioADDServicio" method="post">
                                        <h2 class="text-center">Formulario Alta Servicio</h2>
                                        <h3 class="text-center">Informacion del Servicio</h3>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="tipSer">Tipo de Servicio <strong style="color: red;">*</strong></label>
                                                <select class="form-select" name="tipSer" id="tipSer" required></select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="fecEnt">Fecha de entrega <strong style="color: red;">*</strong></label>
                                                <input type="date" class="form-control" name="fecEnt" id="fecEnt" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="horEnt">Hora de entrega <strong style="color: red;">*</strong></label>
                                                <input type="time" class="form-control" name="horEnt" id="horEnt" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="cosSer">Costo de Servicio <strong style="color: red;">*</strong></label>
                                                <input type="number" step="any" class="form-control" name="cosSer" id="cosSer" placeholder="Ingrese el costo del servicio" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="tipPag">Tipo de pago <strong style="color: red;">*</strong></label>
                                                <select class="form-select" name="tipPag" id="tipPag" required>
                                                    <option value="" selected>Seleccione un tipo de pago</option>
                                                    <option value="EFECTIVO">EFECTIVO</option>
                                                    <option value="TRANSFERENCIA">TRANSFERENCIA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <h3 class="text-center">Informacion del cliente</h3>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="buscarCli">Buscar Cliente</label>
                                                <input type="text" class="form-control" id="buscarCli" placeholder="Escriba el nombre del cliente/razon social/rfc" onkeyup="buscadorInfoCliente()">
                                                <small>De no exitir el cliente lo puedes dar de alta <a href="../clientes/clientes.php">aqui</a></small>
                                            </div>
                                        </div>

                                        <div class="col-md-12" id="mensajeBusClie">
                                        </div>
                                        <input type="hidden" id="idCli">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nomCli">Nombre del cliente <strong style="color: red;">*</strong></label>
                                                <input type="text" class="form-control" name="nomCli" id="nomCli" placeholder="Nombre del cliente" disabled readonly required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="rfcCli">RFC del Cliente <strong style="color: red;">*</strong></label>
                                                <input type="text" class="form-control" name="rfcCli" id="rfcCli" placeholder="RFC del Cliente" disabled readonly required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="razoSocCli">Razon Social <strong style="color: red;">*</strong></label>
                                                <input type="text" class="form-control" name="razoSocCli" id="razoSocCli" placeholder="Razon social del Cliente" disabled readonly required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="conctPag">Contacto de Pago <strong style="color: red;">*</strong></label>
                                                <input type="text" class="form-control" name="conctPag" id="conctPag" placeholder="Nombre del cliente" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="telConPag">Telefono del contacto de pago <strong style="color: red;">*</strong></label>
                                                <input type="text" class="form-control" name="telConPag" id="telConPag" placeholder="Nombre del cliente" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="corConPag">Correo del contacto de pago <strong style="color: red;">*</strong></label>
                                                <input type="email" class="form-control" name="corConPag" id="corConPag" placeholder="Nombre del cliente" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="NomConRec">Nombre del contacto que recibe <strong style="color: red;">*</strong></label>
                                                <input type="text" class="form-control" name="NomConRec" id="NomConRec" placeholder="Nombre del contacto que recibe" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="telConRec">Telefono del contacto que recibe <strong style="color: red;">*</strong></label>
                                                <input type="text" class="form-control" name="telConRec" id="telConRec" placeholder="Telefono del conctato que recibe" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="diaPag">Dia en que se realizaran los pagos <strong style="color: red;">*</strong></label>
                                                <select class="form-select" name="diaPag" id="diaPag" required>
                                                    <option value="" selected>Seleccione un dia</option>
                                                    <option value="01">1 </option>
                                                    <option value="02">2 </option>
                                                    <option value="03">3 </option>
                                                    <option value="04">4 </option>
                                                    <option value="05">5 </option>
                                                    <option value="06">6 </option>
                                                    <option value="07">7 </option>
                                                    <option value="08">8 </option>
                                                    <option value="09">9 </option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    <option value="13">13</option>
                                                    <option value="14">14</option>
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>
                                                    <option value="21">21</option>
                                                    <option value="22">22</option>
                                                    <option value="23">23</option>
                                                    <option value="24">24</option>
                                                    <option value="25">25</option>
                                                    <option value="26">26</option>
                                                    <option value="27">27</option>
                                                    <option value="28">28</option>
                                                    <option value="29">29</option>
                                                    <option value="30">30</option>
                                                    <option value="31">31</option>
                                                </select>
                                            </div>
                                        </div>
                                        <h3 class="text-center">Direccion del Cliente (Direccion Fiscal)</h3>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="dirEst">Estado <strong style="color: red;">*</strong></label>
                                                <input type="text" class="form-control" name="dirEst" id="dirEst" placeholder="Estado" disabled readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="dirMun">Municipio <strong style="color: red;">*</strong></label>
                                                <input type="text" class="form-control" name="dirMun" id="dirMun" placeholder="Municipio" disabled readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="dirCol">Colonia <strong style="color: red;">*</strong></label>
                                                <input type="text" class="form-control" name="dirCol" id="dirCol" placeholder="Colonia" disabled readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="dirCalle">Calle <strong style="color: red;">*</strong></label>
                                                <input type="text" class="form-control" name="dirCalle" id="dirCalle" placeholder="Calle" disabled readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="dirNumExt">Num Ext <strong style="color: red;">*</strong></label>
                                                <input type="text" class="form-control" name="dirNumExt" id="dirNumExt" placeholder="Numero Exterior" disabled readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="dirNumInt">Num Int <strong style="color: red;">*</strong></label>
                                                <input type="text" class="form-control" name="dirNumInt" id="dirNumInt" placeholder="Numero Interior" disabled readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="dirCP">CP <strong style="color: red;">*</strong></label>
                                                <input type="text" class="form-control" name="dirCP" id="dirCP" placeholder="Codigo Postal" disabled readonly>
                                            </div>
                                        </div>
                                        <h3 class="text-center">Direccion de entrega de servicio</h3>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="dirEntEst">Estado <strong style="color: red;">*</strong></label>
                                                <input type="text" class="form-control" name="dirEntEst" id="dirEntEst" placeholder="Estado">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="dirEntMun">Municipio <strong style="color: red;">*</strong></label>
                                                <input type="text" class="form-control" name="dirEntMun" id="dirEntMun" placeholder="Municipio">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="dirEntCol">Colonia <strong style="color: red;">*</strong></label>
                                                <input type="text" class="form-control" name="dirEntCol" id="dirEntCol" placeholder="Colonia">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="dirEntCalle">Calle <strong style="color: red;">*</strong></label>
                                                <input type="text" class="form-control" name="dirEntCalle" id="dirEntCalle" placeholder="Calle">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="dirEntNumExt">Num Ext <strong style="color: red;">*</strong></label>
                                                <input type="text" class="form-control" name="dirEntNumExt" id="dirEntNumExt" placeholder="Numero Exterior">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="dirEntNumInt">Num Int <strong style="color: red;">*</strong></label>
                                                <input type="text" class="form-control" name="dirEntNumInt" id="dirEntNumInt" placeholder="Numero Interior">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="dirEntCP">CP <strong style="color: red;">*</strong></label>
                                                <input type="text" class="form-control" name="dirEntCP" id="dirEntCP" placeholder="Codigo Postal">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="dirEntCoord">Coordenadas <strong style="color: red;">*</strong></label>
                                                <input type="text" class="form-control" name="dirEntCoord" id="dirEntCoord" placeholder="Coordenadas">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <p style="text-align: center; margin: 0px; padding: 0px; font-size: 20px;">Para obtner las coordenas use el mapa y haga click sobre el lugar del cual desea obtner las coordendas</p>
                                        </div>
                                            <div id="map" style="width: 100%; height: 400px;"></div>

                                        <h2 class="text-center">Consideraciones</h2>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="obser">Observaciones</label>
                                                <textarea class="form-control" name="obser" id="obser" row="1" required placeholder="Ingrese observaciones a tomar en cuenta para realizar el servicio, como; accesos, equipo necesario, etc..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12" style="display: flex; justify-content: right;">
                                            <button type="submit" class="btn btn-primary">Aceptar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="../../static/js/jquery-3.6.3.min.js"></script>
        <script src="../../static/js/bootstrap.bundle.min.js"></script>
        <script src="../../static/js/bootstrap.min.js"></script>
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="../../static/js/servicio/create_servicioLimpVarios.js"></script>
    </body>

    </html>
<?php
else :
    header('location: ../../include/logout.php');
endif;
?>