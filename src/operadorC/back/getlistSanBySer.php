<?php
include "../../../include/config.php";
include "../../../include/utils.php";

$dbConn =  connect($db);
/*
  listar todos los posts/gets o solo uno
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header("HTTP/1.1 200 OK");
    header('Content-Type: application/json; charset=utf-8');
    $id_ser = $_POST['id_ser'];
    //header para hacer formato JSON
    $sql = $dbConn->prepare("SELECT S.id_ser, SS.id_san, SS.tipo, S.num_ser, S.tip_ser, S.id_rut, D.estado, D.municipio, D.colonia, D.calle, D.num_ext, D.num_int, D.cp, D.coordenadas FROM `servicio_sani`SS INNER JOIN servicio S ON SS.id_ser = S.id_ser INNER JOIN direcciones D ON SS.id_dire = D.id_dire WHERE SS.id_ser = '$id_ser' AND S.estatus = 'ACTIVO'");
    $sql->execute();
    $results = $sql->fetchAll(PDO::FETCH_OBJ);
    $data = [];
    if ($sql->rowCount() > 0) {
        foreach ($results as $result) {
            //datos
            $data[] = array(
                "id_ser" => $result->id_ser,
                "id_san" => $result->id_san,
                "tipo" => $result->tipo,
            );
        }
    } else {
        $data = array(
            "resultado" => false,
            "mensaje" => "Error de consulta"  
        );
    }
    $json = json_encode($data, JSON_UNESCAPED_UNICODE);
    echo $json;
    exit();
} 


//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");