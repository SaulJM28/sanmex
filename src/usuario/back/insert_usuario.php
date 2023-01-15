<?php
if (!$_POST) {
  echo 'Don t exiat method post';
} else {
    header('Content-Type: application/json; charset=utf-8');
  $nom_ope_add  = $_POST['nom_ope_add'];
  $nom_uso_add = $_POST['nom_uso_add'];
  $pwd_usu_add  = $_POST['pwd_usu_add'];
  $tip_usu_add = $_POST['tip_usu_add'];

  date_default_timezone_set('america/mexico_city');
  $hoy = date('Y-m-d h:i:s');

include("../../../include/conexion.php");
  $sql = " INSERT INTO `usuarios` (`id_usu`, `nom_usu`, `pwd_usu`, `tip_usu`, `estatus`, `fec_cre`, `id_ope`) 
  VALUES (NULL, '$nom_uso_add', '$pwd_usu_add', '$tip_usu_add', 'ACTIVO', '$hoy', '$nom_ope_add');";
  $resultado = mysqli_query($enlace, $sql);

  if (!$resultado) {
    echo "Error: " . $sql . "<br>" . mysqli_error($enlace);
    $data = array(
        "resultado" => false,
        "mensaje" => "No se pudo hacer el registro",
        "url" => "../usuarios.php"
    );
  } else {
        $data = array(
            "resultado" => true,
            "mensaje" => "Registro insertado correctamente",
            "url" => "../usuarios.php"
        );
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit();
  } 
}