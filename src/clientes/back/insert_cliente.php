<?php
if (!$_POST) {
  echo 'Don t exiat method post';
} else {
    header('Content-Type: application/json; charset=utf-8');
  $nom_clie_add  = $_POST['nom_clie_add'];
  $tel_clie_add = $_POST['tel_clie_add'];
  $rfc_clie_add = $_POST['rfc_clie_add'];
  $razsoc_clie_add  = $_POST['razsoc_clie_add'];
  $id_dire = $_POST['idDir'];

  date_default_timezone_set('america/mexico_city');
  $hoy = date('Y-m-d h:i:s');

include("../../../include/conexion.php");
  $sql = " INSERT INTO `clientes` (
    `id_clie`, 
    `nom_clie`, 
    `tel_clie`,
    `rfc`, 
    `razon_social`, 
    `fec_cre`,
    `id_dire`, 
    `estatus`) VALUES (
        NULL, 
        '$nom_clie_add', 
        '$tel_clie_add',
        '$rfc_clie_add', 
        '$razsoc_clie_add', 
        '$hoy', 
        '$id_dire', 
        'ACTIVO');";
  $resultado = mysqli_query($enlace, $sql);

  if (!$resultado) {
    echo "Error: " . $sql . "<br>" . mysqli_error($enlace);
    $data = array(
        "resultado" => false,
        "mensaje" => "No se pudo hacer el registro",
        "url" => "../sanitarios.php"
    );
  } else {
        $data = array(
            "resultado" => true,
            "mensaje" => "Registro insertado correctamente",
            "url" => "../sanitarios.php"
        );
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit();
  } 
}