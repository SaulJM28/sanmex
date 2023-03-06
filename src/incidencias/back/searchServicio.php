<?php
include "../../../include/config.php";
include "../../../include/utils.php";

$dbConn =  connect($db);
/*
  listar todos los posts/gets o solo uno
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $key = $_POST['key'];
    //header para hacer formato JSON
    header('Content-Type: application/json; charset=utf-8');
    //Mostrar un GET
    $sql = $dbConn->prepare("SELECT SANI.num_san, SANI.tip_san, CLI.nom_clie, CLI.rfc, CLI.razon_social, CLI.nom_con, DIRE.estado, DIRE.municipio, DIRE.colonia, DIRE.calle, DIRE.num_ext, DIRE.num_int, DIRE.cp FROM servicio SE INNER JOIN servicio_sani SESAN ON SESAN.id_ser = SE.id_ser INNER JOIN clientes CLI ON CLI.id_clie = SE.id_clie INNER JOIN direcciones DIRE ON DIRE.id_dire = SE.id_dire INNER JOIN sanitarios SANI ON SANI.id_san = SESAN.id_san WHERE CLI.nom_clie like '$key%' OR CLI.razon_social like '$key%' LIMIT 1");
    $sql->execute();
    $results = $sql->fetchAll(PDO::FETCH_OBJ);
    $data = [];
    if ($sql->rowCount() > 0) {
        header("HTTP/1.1 200 OK");
        foreach ($results as $result) {
            //datos
            $data = array(
                "resultado" => true,
                "nom_clie" => $result->nom_clie,
                "rfc" => $result->rfc,
                "razon_social" => $result->razon_social,
                "nom_con" => $result->nom_con,
                "estado" => $result->estado,
                "municipio" => $result->municipio,
                "colonia" => $result->colonia,
                "calle" => $result->calle,
                "num_ext" => $result->num_ext,
                "num_int" => $result->num_int,
                "cp" => $result->cp,
            );
        }
    } else {
        header("HTTP/1.1 200 OK");
        $data = array(
            "resultado" => false,
            "mensaje" => "No se encontro sanitario con ese codigo QR"  
        );
    }
    $json = json_encode($data, JSON_UNESCAPED_UNICODE);
    echo $json;
    exit();
} 
//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");