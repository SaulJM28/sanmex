<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="static/css/bootstrap.min.css" />
    <link rel="stylesheet" href="static/css/estilo__login.css" />
    <link rel="stylesheet" href="static/css/normalize.css" />
    <!-- <link rel="manifest" href="manifest.json"/> -->
    <meta name="theme-color">
    <!-- link de iconos -->
    <script src="https://kit.fontawesome.com/937f402df2.js" crossorigin="anonymous"></script>
    <title>sanmex</title>
    <script type="text/javascript">
        if ("serviceWorker" in navigator) {
            navigator.serviceWorker.register("sw.js");
        }
    </script>
</head>

<body>
    <section class="h-100 gradient-form">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black border__decoration sombra">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <img src="./static/img/logo_sanmex.webp" style="width: 185px;" loading="lazy"
                                            alt="logo_sanmex_login">
                                        <h4 class="mt-1 mb-5 pb-1">Grupo SANMEX desde 1990</h4>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="mensaje"></div>
                                        </div>
                                    </div>

                                    <form method="post" id="formularioIniciarSesion">
                                        <div class="mb-3 mt-3">
                                            <label for="nom_usu" class="form-label"><b>Nombre de usuario:</b></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fas fa-user"></i></div>
                                                <input type="text" class="form-control" id="nom_usu" required
                                                    placeholder="Ingrese su nombre de usuario" name="nom_usu"
                                                    maxlength="8" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="pwd" class="form-label"><b>Contraseña:</b></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fas fa-lock"></i></div>
                                                <input type="password" class="form-control" id="pwd" required
                                                    placeholder="Ingrese la contraseña" name="pswd" maxlength="8">
                                            </div>
                                        </div>
                                        <div class="d-grid gap-2 col-6 mx-auto">
                                            <button type="submit" class="btn btn__personalizado"><i
                                                    class="fa-solid fa-right-to-bracket"></i> Iniciar
                                                Sesión</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">SANMEX</h4>
                                    <p class="small mb-0">Somos una empresa con más de 30 años de experiencia ofreciendo
                                        soluciones en ingeniería sanitaria. Tenemos presencia a nivel nacional en las
                                        ciudades más importantes de nuestro país.</p>
                                    <p class="small mb-0">© 1990-2022 SANMEX</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="static/js/jquery-3.6.3.min.js"></script>
    <script src="static/js/bootstrap.min.js"></script>
    <script src="static/js/inicioSesion/inicioSesion.js"></script>
</body>
</html>
