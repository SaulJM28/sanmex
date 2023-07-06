<?php
include "../../../include/config.php";
include "../../../include/utils.php";
$dbConn =  connect($db);
/*
  listar todos los posts/gets o solo uno
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $limite = $_GET['limite'];
    $id_ope = $_GET['id_ope'];

    //header para hacer formato JSON
    header('Content-Type: application/json; charset=utf-8');
    header("HTTP/1.1 200 OK");
    $sql1 = $dbConn->prepare("SELECT COUNT(*) as TotalRegis FROM `servicio`");
    $sql1->execute();
    $results1 = $sql1->fetchAll(PDO::FETCH_OBJ);
    if ($sql1->rowCount() > 0) {
        foreach ($results1 as $result1) {
            //datos
            $totalRegis = $result1->TotalRegis;
        }
    }
    //Mostrar un GET
    $sql = $dbConn->prepare("SELECT S.id_ser, S.num_ser, S.tip_ser, S.num_san,  S.nom_conrec, S.tel_conrec, S.estado, S.municipio, S.colonia, S.calle, S.num_ext, S.num_int, S.cp, S.obser, S.estatus, C.nom_clie, C.rfc, C.razon_social, U.tip_usu, O.id_ope, O.nom, O.ap1, O.ap2 from servicio S 
    LEFT JOIN rutas R ON S.id_rut = R.id_rut
    INNER JOIN operadores O ON R.id_ope = O.id_ope
    INNER JOIN usuarios U ON O.id_ope = U.id_ope
    INNER JOIN clientes C ON C.id_clie = S.id_clie 
    WHERE S.tip_ser = 'DESAZOLVES DE FOSAS SEPTICAS' OR S.tip_ser =  'LIMPIEZAS PROFUNDAS' OR S.tip_ser = 'SONDEOS' OR S.tip_ser = 'INSPECCION DE CAMARAS'  AND S.estatus <> 'INACTIVO' AND O.id_ope = '$id_ope' LIMIT 10 OFFSET " . $limite . "");
    $sql->execute();
    $results = $sql->fetchAll(PDO::FETCH_OBJ);
    $data = [];
    if ($sql->rowCount() > 0) {
        foreach ($results as $result) {
            if ($result->estatus == 'ACTIVO') {
                $color = '#279b37';
            } else if ($result->estatus == 'FINALIZADO') {
                $color = '#ffdd00';
            }
            //datos
            $data[] = array(
                "resultado" => true,
                "id_ser" => $result->id_ser,
                "num_ser" => $result->num_ser,
                "tip_ser" => $result->tip_ser,
                "num_san" => $result->num_san,
                "nom_conrec" => $result->nom_conrec,
                "tel_conrec" => $result->tel_conrec,
                "nom_ope" => $result->nom . ' ' . $result->ap1 . ' ' . $result->ap2,
                "direccion" => $result->estado . ' ' . $result->municipio . ' ' . $result->colonia . ' ' . $result->calle . ' ' . $result->num_ext . ' ' . $result->num_int . ' ' . $result->cp,
                "cliente" => $result->nom_clie .", ". $result->rfc .", ". $result->razon_social,
                "obser" => $result->obser,
                "color" => $color,
                "estatus" => $result->estatus
            );
        }
    } else {
        $data = array(
            "resultado" => false,
            "mensaje" => "No hay servicios"
        );
    }
    $json = json_encode($data, JSON_UNESCAPED_UNICODE);
    echo $json;
    exit();
}
//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");
