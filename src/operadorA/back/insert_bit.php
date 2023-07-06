<?php
if (!$_POST) {
    echo "Don't exist method POST";
} else {

    if($_POST["tipo"] == 'INCIDENCIA'){
        $operador = $_POST['operadorADD'];
        $servicio = $_POST['servicioADD'];
        $cliente = $_POST['clienteADD'];
      /*   $coord = $_POST['coordADD']; */
        $comentario = $_POST['comentarioADD'];
        /* asignamos un nombre al archivo que vamos guardar */ 
        date_default_timezone_set('america/mexico_city');
        $hoy = date('Y-m-d h:i:s');
    
     include("../../../include/conexion.php");    
        $sql = " INSERT INTO `bitacora_servicio` (`id_bit`, `servicio`, `cliente`, `sanitario`, `operador`, `fecha`, `evidencia`, `comentario`, `estatus`) 
        VALUES (NULL, '$servicio', '$cliente', NULL, '$operador', '$hoy', NULL, '$comentario', 'INCIDENCIA');";
        $resultado = mysqli_query($enlace, $sql);
        if (!$resultado) {
            echo "Error: " . $sql . "<br>" . mysqli_error($enlace);
        } else {
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo "<script> 
            setTimeout(function(){
                alert('Reorte de incidencia realizado correctamente');
                location.href=' ../listaServicios.php'
            } , 100);   
            </script>";
        }

    }else if($_POST["tipo"] == 'REALIZACION'){
        $operador = $_POST['operadorADD'];
        $servicio = $_POST['servicioADD'];
        $cliente = $_POST['clienteADD'];
        $sanitario = $_POST['sanitarioADD'];
        $coord = $_POST['coordADD'];
        $comentario = $_POST['comentarioADD'];
        //file
        $file_name_evidencia = $_FILES['evidenciaADD']['name'];
        $file_size_evidencia = $_FILES['evidenciaADD']['size'];
        $file_tmp_evidencia = $_FILES['evidenciaADD']['tmp_name'];
        $file_type_evidencia = $_FILES['evidenciaADD']['type'];
        $tmp_evidencia = (explode('.', $_FILES['evidenciaADD']['name']));
        $file_ext_evidencia = end($tmp_evidencia);
    
        /* asignamos un nombre al archivo que vamos guardar */ 
        $nameArch = 'Evidencia-'. $sanitario . '-'. $servicio .'.' . $file_ext_evidencia ;
        date_default_timezone_set('america/mexico_city');
        $hoy = date('Y-m-d h:i:s');
    
     include("../../../include/conexion.php");    
        $sql = " INSERT INTO `bitacora_servicio` (`id_bit`, `servicio`, `cliente`, `sanitario`, `operador`, `fecha`, `evidencia`, `comentario`, `estatus`) 
        VALUES (NULL, '$servicio', '$cliente', '$sanitario', '$operador', '$hoy', '$nameArch', '$comentario', 'REALIZADO');";
        $resultado = mysqli_query($enlace, $sql);
        if (!$resultado) {
            echo "Error: " . $sql . "<br>" . mysqli_error($enlace);
        } else {
            move_uploaded_file($file_tmp_evidencia, "../static/img/evidenciasBitacoras/" . $nameArch);
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo "<script> 
            setTimeout(function(){
                alert('Servicio realizado correctamente');
                location.href=' ../servicio.php'
            } , 100);   
            </script>";
        }
    }
    exit();
}
