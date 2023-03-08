<?php
include "../../../include/config.php";
include "../../../include/utils.php";

$dbConn =  connect($db);
/*
  listar todos los posts/gets o solo uno
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom_usu = $_POST['nom_usu'];
    header('Content-Type: application/json; charset=utf-8');
    //Mostrar un GET
    $sql = $dbConn->prepare("SELECT * FROM bitacora_servicio WHERE operador = '$nom_usu' ORDER BY fecha desc");
    $sql->execute();
    $results = $sql->fetchAll(PDO::FETCH_OBJ);

    $data = [];
    if ($sql->rowCount() > 0) {
        header("HTTP/1.1 200 OK");
        foreach ($results as $result) {

            if($result->estatus == 'REALIZADO' ){
                $color = '#279b37';
                $icono = 'fas fa-check';
                $san = $result->sanitario;
            }else if($result->estatus == 'INCIDENCIA'){
                $color = '#be0027';
                $icono = 'fas fa-times';
                $san = 'No se pudo realizar el servicio';
            }

            //datos
            $data[] = array(
                "id_bit" => $result->id_bit,
                "servicio" => $result->servicio,
                "cliente" => $result->cliente,
                "sanitario" => $san,
                "fecha" => $result->fecha,
                "comentario" => $result->comentario,
                "estatus" => $result->estatus,
                "color" => $color,
                "icono" => $icono
            );
        }
    }
    $objeto = array('data' => $data);
    $json = json_encode($objeto, JSON_UNESCAPED_UNICODE);
    echo $json;
    exit();
} 

//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");


