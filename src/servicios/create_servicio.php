<?php
session_start();
if (isset($_SESSION['nom_usu']) && $_SESSION['tip_usu'] == "ADMINISTRADOR"):
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
                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text active">
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
                    <h2 class="fs-2 m-0">SERVICIOS</h2>
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
                                    <a href="../../home.php" class="btn btn-default"><i
                                            class="fas fa-arrow-left"></i></a>
                                    <h1 style="text-align: center;">Crear Servicio</h1>
                                    <p class = "text-center">Campos obligatorios<strong style="color: red;">*</strong></p>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-12 mt-2">
                                        <label>Cliente<strong style="color: red;">*</strong></label>
                                        <input type="text" class="form-control" onkeyup="buscador()" id="key" name="key"
                                            placeholder="Buscar cliente por RFC o Razon Social">
                                        <small>De no encontrar el cliente, registralo <a
                                                href="../clientes/clientes.php">aqui</a></small>
                                    </div>
                                    <div class="col-md-12 mt-2" id="clienteInfo">
                                    </div>
                                </div>
                                <br>
                                <div class="row g-3">
                                    <div class="col-md-12 mt-2">
                                        <label>Direccion<strong style="color: red;">*</strong></label>
                                        <input type="text" class="form-control" onkeyup="buscador_dire()" id="key_dire"
                                            name="key_dire" placeholder="Buscar direccion por Colonia o Calle">
                                        <small>De no encontrar la direccion, registrala <a
                                                href="../direcciones/direcciones.php">aqui</a></small>
                                    </div>
                                    <div class="col-md-12 mt-2" id="direInfo">
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <h2 class = "text-center">Datos del cliente</h2>
                                    <div class="col-md-12">
                                        <ul class="list-group" id="infoClient">
                                        </ul>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <h2 class = "text-center">Datos de la direccion</h2>
                                    <div class="col-md-12">
                                        <ul class="list-group" id="infoDire">
                                        </ul>
                                    </div>
                                </div>
                                <form class="row g-3" id="formularioADDServicio" method="post">
                                    <div id='mensaje'></div>
                                    <h2 class = "text-center">Datos del servicio</h2>
                                    <input type="hidden"  class="form-control" id="id_clie">
                                    <input type="hidden"  class="form-control" id="id_dire">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="num_san">Numero de Sanitarios <strong style="color: red;">*</strong></label>
                                            <input type="number" step="any" class="form-control" id="num_san"
                                                placeholder="Ingrese el numero de sanitarios a rentar" onChange="calcularTotal()">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="cost_unit">Costo Unitario <strong style="color: red;">*</strong></label>
                                            <input type="number" step="any" class="form-control" id="cost_unit"
                                                placeholder="Ingrese el unitario por sanitario" onChange="calcularTotal()">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="cost_tot">Costo Total <strong style="color: red;">*</strong></label>
                                            <input type="number" step="any" class="form-control" id="cost_tot"
                                                placeholder="Ingrese el costo total" readonly>
                                            <small>El costo total se calcula al ingresar el numero de sanitarios y el
                                                costo unitario</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tip_pag">Tipo de pago <strong style="color: red;">*</strong></label>
                                            <select class="form-select" name="tip_pag" id="tip_pag">
                                                <option value="" selected>Seleccione un tipo de pago</option>
                                                <option value="EFECTIVO">EFECTIVO</option>
                                                <option value="TRANSFERENCIA">TRANSFERENCIA</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="dia_de_pag">Dia en que se realizaran los pagos <strong style="color: red;">*</strong></label>
                                            <select class="form-select" name="dia_de_pag" id="dia_de_pag">
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

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="dia_ser">Dias que se realizara el servicio <strong style="color: red;">*</strong></label>
                                            <br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="CheckboxL"
                                                    value="LUNES">
                                                <label class="form-check-label" for="inlineCheckbox1">L</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="CheckboxM"
                                                    value="MARTES">
                                                <label class="form-check-label" for="inlineCheckbox1">M</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="CheckboxMI"
                                                    value="MIERCOLES">
                                                <label class="form-check-label" for="inlineCheckbox1">MI</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="CheckboxJ"
                                                    value="JUEVES">
                                                <label class="form-check-label" for="inlineCheckbox1">J</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="CheckboxV"
                                                    value="VIERNES">
                                                <label class="form-check-label" for="inlineCheckbox1">V</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="CheckboxS"
                                                    value="SABADO">
                                                <label class="form-check-label" for="inlineCheckbox1">S</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="CheckboxD"
                                                    value="DOMINGO">
                                                <label class="form-check-label" for="inlineCheckbox1">D</label>
                                            </div>
                                        </div>
                                    </div>
                                    <h2 class = "text-center">Consideraciones</h2>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="hora_aten">Horario y fecha de atencion</label>
                                            <input type="text" name = "hora_aten" id="hora_aten" class = "form-control" placeholder="Ingrese el horar y fecha de atencion en el que se puede brindar el servico">
                                            <small>Ejemplo: de lunes a viernes de 8:00 am a 5:00 pm</small>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="obser">Observaciones</label>
                                            <textarea class = "form-control" name="obser" id="obser" row = "1" placeholder="Ingrese observaciones a tomar en cuenta para realizar el servicio, como; accesos, equipo necesario, etc..." ></textarea>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    <script src="../../static/js/servicio/create_servicio.js"></script>
</body>
</html>
<?php
else:
    header('location: ../../include/logout.php');
endif;
?>