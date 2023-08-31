<?php
include "../../../include/config.php";
include "../../../include/utils.php";
$dbConn =  connect($db);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['idUploadDoc'];
    $rfc = $_POST['rfcUploadDoc'];
    $file_name_docCot = $_FILES['docCot']['name'];
    $file_size_docCot = $_FILES['docCot']['size'];
    $file_tmp_docCot = $_FILES['docCot']['tmp_name'];
    $file_type_docCot = $_FILES['docCot']['type'];
    $tmp_docCot = (explode('.', $_FILES['docCot']['name']));
    $file_ext_docCot = end($tmp_docCot);
    $file_name_docSitFis = $_FILES['docSitFis']['name'];
    $file_size_docSitFis = $_FILES['docSitFis']['size'];
    $file_tmp_docSitFis = $_FILES['docSitFis']['tmp_name'];
    $file_type_docSitFis = $_FILES['docSitFis']['type'];
    $tmp_docSitFis = (explode('.', $_FILES['docSitFis']['name']));
    $file_ext_docSitFis = end($tmp_docSitFis);
    $nombreDocCot = 'DocCot_' . $rfc . '_' . $id . '.pdf';
    $nombreDocSitFis = 'DocSitFis_' . $rfc . '_' . $id . '.pdf';
    if ((move_uploaded_file($file_tmp_docCot, "./docs/cotizaciones/" . $nombreDocCot)) || (move_uploaded_file($file_tmp_docSitFis, "./docs/situacionFiscal/" . $nombreDocSitFis))) {
        $sql = $dbConn->prepare("UPDATE servicio SET cotzacion = :cot, sit_fis = :sitFis  WHERE id_ser = :id");
        $sql->bindValue(':id', $id, PDO::PARAM_INT);
        $sql->bindValue(':cot', $nombreDocCot, PDO::PARAM_STR);
        $sql->bindValue(':sitFis', $nombreDocSitFis, PDO::PARAM_STR);
        if ($sql->execute() !== false && $sql->rowCount() > 0) {
            echo '<script type="text/javascript">
        alert("Archivos subidos");
        window.location.href="../listaServicios.php";
        </script>';
        } else {
            $errorInfo = $sql->errorInfo();
            echo $errorInfo[2];
            echo '<script type="text/javascript">
                alert("Archivo Actualizado");
                window.location.href="../listaServicios.php";
            </script>';
        }
    } else {
        echo '<script type="text/javascript">
            alert("No se pudieron subir los archivos");
            window.location.href="../listaServicios.php";
        </script>';
    }


    exit();
}
//En caso de que ninguna de las opciones anteriores se haya ejecutado
/* header("HTTP/1.1 400 Bad Request"); */
