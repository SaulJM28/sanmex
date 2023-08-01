<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header("HTTP/1.1 200 OK");
    header('Content-Type: application/json; charset=utf-8');

    include "config.php";
    include "utils.php";
    $dbConn =  connect($db);

    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = $dbConn->prepare("SELECT * FROM usuarios  WHERE nom_usu = '$username'");
    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);
    $data = array();
    if (!$result) {
        $data = array(
            "resultado" => false,
            "mensaje" => "Usuario o contraseña incorrectos"
        );
    } else {
        if ($password == $result['pwd_usu']) {
            $queryGetInfoUsu = $dbConn->prepare("SELECT OP.id_ope, nom, ap1, ap2 FROM usuarios USU INNER JOIN operadores OP ON USU.id_ope = OP.id_ope WHERE nom_usu = '$username'");
            $queryGetInfoUsu->execute();
        
            $resultResponse = $queryGetInfoUsu->fetch(PDO::FETCH_ASSOC);
                if(!$resultResponse){
                    echo "Error, no se pudo obtner el nombre";
                }else{
                    $nombre = $resultResponse['nom'] . " " .$resultResponse['ap1'] . " " .$resultResponse['ap2']; 
                }

            $_SESSION['nom_usu'] = $result['nom_usu'];
            $_SESSION['tip_usu'] = $result['tip_usu'];
            $_SESSION['estatus'] = $result['estatus'];
            $_SESSION['nombre'] = $nombre;
            $_SESSION['id_ope'] = $result['id_ope'];

            //validamos que tipo de usuario es y cual sera su url
            if ($result['tip_usu'] == 'ADMINISTRADOR' || $result['tip_usu'] == 'EJECUTIVO VENTAS' || $_SESSION['tip_usu'] == "DIRECTOR" || $_SESSION['tip_usu'] == "GERENTE") {
                $data = array(
                    "resultado" => true,
                    "mensaje" => "Usuario y contraseña correctos",
                    "rol" => $result['tip_usu'],
                    "url" => "./home.php"
                );
            } 
            if($result['tip_usu'] == 'ALMACENISTA'){
                $data = array(
                    "resultado" => true,
                    "mensaje" => "Usuario y contraseña correctos",
                    "rol" => $result['tip_usu'],
                    "url" => "./src/home/homeAlmacenista.php"
                );
            }

            if ($result['tip_usu'] == 'OPERADOR A') {
                $data = array(
                    "resultado" => true,
                    "mensaje" => "Usuario y contraseña correctos",
                    "rol" => $result['tip_usu'],
                    "url" => './src/home/homeOpeA.php'
                );
            }

            if ($result['tip_usu'] == 'OPERADOR B') {
                $data = array(
                    "resultado" => true,
                    "mensaje" => "Usuario y contraseña correctos",
                    "rol" => $result['tip_usu'],
                    "url" => './src/home/homeOpeB.php'
                );
            }

            if ($result['tip_usu'] == 'OPERADOR C') {
                $data = array(
                    "resultado" => true,
                    "mensaje" => "Usuario y contraseña correctos",
                    "rol" => $result['tip_usu'],
                    "url" => './src/home/homeOpeC.php'
                );
            }

            if ($result['tip_usu'] == 'JEFE OPERACIONES') {
                $data = array(
                    "resultado" => true,
                    "mensaje" => "Usuario y contraseña correctos",
                    "rol" => $result['tip_usu'],
                    "url" => './src/home/homeJefeOperaciones.php'
                );
            }
        } else {
            $data = array(
                "resultado" => false,
                "mensaje" => "Usuario o contraseña incorrectos",
            );
        }
    }

    $json = json_encode($data, JSON_UNESCAPED_UNICODE);
    echo $json;
} else {
    header("HTTP/1.1 400 Bad Request");
}
