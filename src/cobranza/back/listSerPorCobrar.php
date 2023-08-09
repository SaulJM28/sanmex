<?php
include "../../../include/config.php";
include "../../../include/utils.php";

$dbConn =  connect($db);
/*
  listar todos los posts/gets o solo uno
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    date_default_timezone_set('America/Mexico_City');
    header('Content-Type: application/json; charset=utf-8');
    //Mostrar un GET
    $sql = $dbConn->prepare("SELECT S.*, C.nom_clie, C.rfc, C.razon_social FROM servicio S INNER JOIN clientes C ON S.id_clie = C.id_clie WHERE S.estatus = 'ACTIVO';");
    $sql->execute();
    $results = $sql->fetchAll(PDO::FETCH_OBJ);

    $data = [];
    if ($sql->rowCount() > 0) {
        header("HTTP/1.1 200 OK");
        foreach ($results as $result) {
            //obtenes la fecha de l dia
            $hoy = date("d");
            //obtenes los dias que faltan para el pago
            $diaFaltPag = $result->dia_pag - $hoy;
            //echo $diaFaltPag . "<br>";
            //empezamos haciendo las condiciones
            if($diaFaltPag == 5){
                $colorPago = "#FFD700";
                $estatusPago = "Por vencer";
            }else if($diaFaltPag == 0 ){
                $colorPago = "#FFA500";
                $estatusPago = "Dia de pago";
            }else if($diaFaltPag < 0 ){
                $colorPago = "#B22222";
                $estatusPago = "Vencido";
            }else{
                $colorPago = "#006400";
                $estatusPago = "A tiempo";
            }

            //Hay que validar lo de la fecha para hacer el cobro
            $data[] = array(
                "id_ser" => $result->id_ser,
                "num_ser" => $result->num_ser,
                "tip_ser" => $result->tip_ser,
                "num_san" => $result->fec_ent,
                "fec_ent" => $result->hor_ent,
                "cost_ser" => $result->cost_ser,
                "tip_pag" => $result->tip_pag,
                "conct_pag" => $result->conct_pag,
                "tel_conpag" => $result->tel_conpag,
                "cor_conpag" => $result->cor_conpag,
                "nom_conrec" => $result->nom_conrec,
                "tel_conrec" => $result->tel_conrec,
                "dia_pag" => $result->dia_pag,
                "estatusPago" => $estatusPago,
                "colorEstPag" => $colorPago,
                "cliente" => $result->nom_clie . ', ' . $result->razon_social . ', ' . $result->rfc,
                "obser" => $result->obser,
                "estatus_serv" => $result->estatus,
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
