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
            $_SESSION['nom_usu'] = $result['nom_usu'];
            $_SESSION['tip_usu'] = $result['tip_usu'];
            $_SESSION['estatus'] = $result['estatus'];
            //validamos que tipo de usuario es y cual sera su url
            if ($result['tip_usu'] == 'ADMIN') {
                $data = array(
                    "resultado" => true,
                    "mensaje" => "Usuario y contraseña correctos",
                    "rol" => $result['tip_usu'],
                    "url" => "./home.php"
                );
            } else if ($result['tip_usu'] == 'OPERADOR') {
                $data = array(
                    "resultado" => true,
                    "mensaje" => "Usuario y contraseña correctos",
                    "rol" => $result['tip_usu'],
                    "url" => './home_ope.php'
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
