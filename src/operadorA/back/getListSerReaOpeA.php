<?php
include "../../../include/config.php";
include "../../../include/utils.php";
$dbConn =  connect($db);
/*
  listar todos los posts/gets o solo uno
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    /* Headers */
    header('Content-Type: application/json; charset=utf-8');
    header("HTTP/1.1 200 OK");
    session_start();
    $limite = $_GET['limite'];
    $nombre = $_SESSION['nombre'];
    $sql1 = $dbConn->prepare("SELECT COUNT(*) as TotalRegis FROM bitacora_servicio WHERE operador = '$nombre' AND estatus <> 'INACTIVO';");
    //echo "<pre>". print_r($sql1); die();
    $sql1->execute();
    $results1 = $sql1->fetchAll(PDO::FETCH_OBJ);
    if ($sql1->rowCount() > 0) {
        foreach ($results1 as $result1) {
            //datos
            $totalRegis = $result1->TotalRegis;
        }
    }
    //Mostrar un GET
    $sql = $dbConn->prepare("SELECT BS.*, S.tip_ser FROM bitacora_servicio BS INNER JOIN servicio S ON S.num_ser = BS.servicio where operador = '$nombre' AND BS.estatus <> 'INACTIVO' LIMIT 10 OFFSET " . $limite . "");
    $sql->execute();
    $results = $sql->fetchAll(PDO::FETCH_OBJ);
    $data = [];
    if ($sql->rowCount() > 0) {
        //echo $diaActual;
        foreach ($results as $result) {
            if($result->estatus == 'REALIZADO'){
                $color = '#279b37';
            }
            if($result->estatus == 'INCIDENCIA'){
                $color = '#ffdd00';
            }

            $obj[] = array(
                "resultado" => true,
                "servicio" => $result->servicio,
                "cliente" => $result->cliente,
                "operador" => $result->operador,
                "evidencia" => $result->evidencia,
                "comentario" => $result->comentario,
                "color" => $color,
                "tip_ser" => $result->tip_ser,
                "estatus" => $result->estatus,
                "totalRe" => $totalRegis
            );
        }
        $data = array(
            "resultado" => true,
            "data" => $obj
        );
    } else {
        $data = array(
            "resultado" => false,
            "mensaje" => "Sin servicios asignados"
        );
    }
    $json = json_encode($data, JSON_UNESCAPED_UNICODE);
    echo $json;
    exit();
}
//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");
