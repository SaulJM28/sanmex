<?php
include "../../../include/config.php";
include "../../../include/utils.php";


$dbConn =  connect($db);

/*
  listar todos los posts o solo uno
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['id_ope'])) {
    header('Content-Type: application/json; charset=utf-8');
    header("HTTP/1.1 200 OK");
    $id_ope = $_POST['id_ope'];
    //Mostrar un post
    $sql = $dbConn->prepare("SELECT * FROM operadores WHERE id_ope = '$id_ope'");
    $sql->execute();
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    header("HTTP/1.1 200 OK");
    echo json_encode($sql->fetch(), JSON_UNESCAPED_UNICODE);
    exit();
  }
}

//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");