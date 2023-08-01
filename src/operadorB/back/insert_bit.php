<?php
if (!$_POST) {
    echo "Don't exist method POST";
} else {

    if ($_POST["tipo"] == 'INCIDENCIA') {
        $operador = $_POST['operadorADD'];
        $servicio = $_POST['servicioADD'];
        $cliente = $_POST['clienteADD'];
        $tipSer = $_POST['tipSerADD'];
        $comentario = $_POST['comentarioADD'];
        //archivo 
        $file_name_fileEvidencia = $_FILES['fileEvidencia']['name'];
        $file_size_fileEvidencia = $_FILES['fileEvidencia']['size'];
        $file_tmp_fileEvidencia = $_FILES['fileEvidencia']['tmp_name'];
        $file_type_fileEvidencia = $_FILES['fileEvidencia']['type'];
        $tmp_fileEvidencia = (explode('.', $_FILES['fileEvidencia']['name']));
        $file_ext_fileEvidencia = end($tmp_fileEvidencia);
        /* asignamos un nombre al archivo que vamos guardar */
        $nameArch = 'Evidencia-incidencia-' . $servicio . '.' . $file_ext_fileEvidencia;
        date_default_timezone_set('america/mexico_city');
        $hoy = date('Y-m-d h:i:s');

        include("../../../include/conexion.php");
        $sql = " INSERT INTO `bitacora_servicio` (`id_bit`, `servicio`, `cliente`, `sanitario`, `operador`, `tipser`, `fecha`, `evidencia`, `comentario`, `estatus`) 
        VALUES (NULL, '$servicio', '$cliente', NULL, '$operador', '$tipSer', '$hoy', '$nameArch', '$comentario', 'INCIDENCIA');";
        $resultado = mysqli_query($enlace, $sql);
        if (!$resultado) {
            echo "Error: " . $sql . "<br>" . mysqli_error($enlace);
        } else {
            move_uploaded_file($file_tmp_fileEvidencia, "../../../static/img/evidenciasBitacoras/" . $nameArch);
            echo "<script> 
            setTimeout(function(){
                alert('Reorte de incidencia realizado correctamente');
                location.href='../listaServicios.php'
            } , 100);   
            </script>";
        }
    } else if ($_POST["tipo"] == 'REALIZACION') {
        $operador = $_POST['operadorSerRea'];
        $servicio = $_POST['servicioSerRea'];
        $cliente = $_POST['clienteSerRea'];
        $tipSer = $_POST['tipSerRea'];
        $comentario = $_POST['comentarioSerRea'];
        //file
        $file_name_fileEvidenciaSerRea = $_FILES['fileEvidenciaSerRea']['name'];
        $file_size_fileEvidenciaSerRea = $_FILES['fileEvidenciaSerRea']['size'];
        $file_tmp_fileEvidenciaSerRea = $_FILES['fileEvidenciaSerRea']['tmp_name'];
        $file_type_fileEvidenciaSerRea = $_FILES['fileEvidenciaSerRea']['type'];
        $tmp_fileEvidenciaSerRea = (explode('.', $_FILES['fileEvidenciaSerRea']['name']));
        $file_ext_fileEvidenciaSerRea = end($tmp_fileEvidenciaSerRea);

        /* asignamos un nombre al archivo que vamos guardar */
        $nameArch = 'Evidencia-Servicio-Realizado' . $servicio . '.' . $file_ext_fileEvidenciaSerRea;
        date_default_timezone_set('america/mexico_city');
        $hoy = date('Y-m-d h:i:s');

        include("../../../include/conexion.php");
        $sql = " INSERT INTO `bitacora_servicio` (`id_bit`, `servicio`, `cliente`, `sanitario`, `operador`, `tipser`, `fecha`, `evidencia`, `comentario`, `estatus`) 
        VALUES (NULL, '$servicio', '$cliente', null, '$operador', '$tipSer', '$hoy', '$nameArch', '$comentario', 'REALIZADO');";
        $resultado = mysqli_query($enlace, $sql);
        if (!$resultado) {
            echo "Error: " . $sql . "<br>" . mysqli_error($enlace);
        } else {
            move_uploaded_file($file_tmp_fileEvidenciaSerRea, "../../../static/img/evidenciasBitacoras/" . $nameArch);  
            echo "<script> 
            setTimeout(function(){
                alert('Servicio realizado correctamente');
                location.href='../listaServicios.php'
            } , 100);   
            </script>";
        }
    }
    exit();
}
