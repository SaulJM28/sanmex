<?php
include "../../../include/config.php";
include "../../../include/utils.php";
$dbConn =  connect($db);
header('Content-Type: application/json; charset=utf-8');
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = $dbConn->prepare("SELECT * FROM tip_usuarios  where estatus = 'ACTIVO';");
    $sql->execute();
    $results = $sql->fetchAll(PDO::FETCH_OBJ);
    $data = [];
    if ($sql->rowCount() > 0) {
        header("HTTP/1.1 200 OK");
        foreach ($results as $result) {
            //datos
            $data[] = array(
                "id_tipusu" => $result->id_tipusu,
                "cargo" => $result->cargo,
                "fec_cre" => $result->fec_cre,
                "estatus" => $result->estatus
            );
        }
    }
    $objeto = array('data' => $data);
    $json = json_encode($objeto, JSON_UNESCAPED_UNICODE);
    echo $json;
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['tipo'] == 'INSERTAR') {
        date_default_timezone_set('america/mexico_city');
        $cargo = $_POST['cargo'];
        $hoy = date('Y-m-d h:i:s');
        $estatus = 'ACTIVO';
        $sql = "INSERT INTO tip_usuarios(id_tipusu, cargo, fec_cre, estatus) values('', :cargo, :fec_cre, :estatus)";
        $sql = $dbConn->prepare($sql);
        $sql->bindParam(':cargo', $cargo, PDO::PARAM_STR);
        $sql->bindParam(':fec_cre', $hoy, PDO::PARAM_STR);
        $sql->bindParam(':estatus', $estatus, PDO::PARAM_STR);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $data = array(
                "resultado" => true,
                "mensaje" => 'Registro insertado correctamente'
            );
        } else {
            $data = array(
                "resultado" => false,
                "mensaje" => 'No se pudo realizar el registro'
            );
            echo $sql->errorInfo();
        }
        $json = json_encode($data, JSON_UNESCAPED_UNICODE);
        echo $json;
        exit();
    }
    if ($_POST['tipo'] == 'ACTUALIZAR') {
        $id = $_POST['id'];
        $cargo = $_POST['cargo'];
        $sql = $dbConn->prepare("UPDATE tip_usuarios SET cargo = :cargo WHERE id_tipusu = :id");
        $sql->bindValue(':id', $id, PDO::PARAM_INT);
        $sql->bindValue(':cargo', $cargo, PDO::PARAM_STR);
        if ($sql->execute() !== false && $sql->rowCount() > 0) {
            $data = array(
                "resultado" => true,
                "mensaje" => 'Se ha actualizado correctamente'
            );
        } else {
            $data = array(
                "resultado" => false,
                "mensaje" => 'No se pudo realizar los cambios'
            );
            echo $sql->errorInfo();
        }
        $json = json_encode($data, JSON_UNESCAPED_UNICODE);
        echo $json;
        exit();
    }
    if ($_POST['tipo'] == 'ELIMINAR') {
        $id = $_POST['id'];
        $estatus = 'INACTIVO';
        $sql = $dbConn->prepare("UPDATE tip_usuarios SET estatus = :estatus WHERE id_tipusu = :id");
        $sql->bindValue(':id', $id, PDO::PARAM_INT);
        $sql->bindValue(':estatus', $estatus, PDO::PARAM_STR);
        if ($sql->execute() !== false && $sql->rowCount() > 0) {
            $data = array(
                "resultado" => true,
                "mensaje" => 'Se ha eliminado correctamente'
            );
        } else {
            $data = array(
                "resultado" => false,
                "mensaje" => 'No se pudo eliminar el registro'
            );
            echo $sql->errorInfo();
        }
        $json = json_encode($data, JSON_UNESCAPED_UNICODE);
        echo $json;
        exit();
    }
    if ($_POST['tipo']  == 'GETBYID') {
        $id = $_POST['id'];
        $sql = $dbConn->prepare("SELECT * FROM tip_usuarios  where estatus = 'ACTIVO' AND id_tipusu = '$id';");
        $sql->execute();
        $results = $sql->fetchAll(PDO::FETCH_OBJ);
        $data = [];
        if ($sql->rowCount() > 0) {
            header("HTTP/1.1 200 OK");
            foreach ($results as $result) {
                //datos
                $data = array(
                    "id_tipusu" => $result->id_tipusu,
                    "cargo" => $result->cargo,
                    "fec_cre" => $result->fec_cre,
                    "estatus" => $result->estatus
                );
            }
        }
        $json = json_encode($data, JSON_UNESCAPED_UNICODE);
        echo $json;
        exit();
    }
}
//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");
