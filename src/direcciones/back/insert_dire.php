<?php
if (!$_POST) {
  echo 'Don t exiat method post';
} else {
    header('Content-Type: application/json; charset=utf-8');
  $estado_add  = $_POST['estado_add'];
  $municipio_add = $_POST['municipio_add'];
  $colonia_add  = $_POST['colonia_add'];
  $calle_add = $_POST['calle_add'];
  $num_ext_add = $_POST['num_ext_add'];
  $num_int_add = $_POST['num_int_add'];
  $cp_add = $_POST['cp_add'];
  $coordenadas_add = $_POST['coordenadas_add'];

include("../../../include/conexion.php");
  $sql = " INSERT INTO `direcciones` (
    `id_dire`, 
    `estado`, 
    `municipio`, 
    `colonia`, 
    `calle`, 
    `num_ext`, 
    `num_int`,
    `cp`,
    `coordenadas`, 
    `estatus`) VALUES (
        NULL, 
        '$estado_add', 
        '$municipio_add', 
        '$colonia_add', 
        '$calle_add', 
        '$num_ext_add',
        '$num_int_add',
        '$cp_add',
        '$coordenadas_add',
        'ACTIVO');";
  $resultado = mysqli_query($enlace, $sql);

  if (!$resultado) {
    echo "Error: " . $sql . "<br>" . mysqli_error($enlace);
    $data = array(
        "resultado" => false,
        "mensaje" => "No se pudo hacer el registro",
        "url" => "../direcciones.php"
    );
  } else {
        $data = array(
            "resultado" => true,
            "mensaje" => "Registro insertado correctamente",
            "url" => "../direcciones.php"
        );
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit();
  } 

}