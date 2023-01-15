<?php
include "../../../include/config.php";
include "../../../include/utils.php";


$dbConn =  connect($db);

/*
  listar todos los posts o solo uno
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['id_usu'])) {
    header('Content-Type: application/json; charset=utf-8');
    header("HTTP/1.1 200 OK");
    $id_usu = $_POST['id_usu'];
    //Mostrar un post
    $sql = $dbConn->prepare("SELECT id_usu, nom_usu, pwd_usu, tip_usu, U.estatus, U.fec_cre, nom, ap1, ap2 FROM usuarios U JOIN operadores O ON U.id_ope = O.id_ope WHERE  id_usu = '$id_usu'  AND U.estatus = 'ACTIVO';");
    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    header("HTTP/1.1 200 OK");
    echo json_encode($sql->fetch(), JSON_UNESCAPED_UNICODE);
    exit();
  }
}

//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");