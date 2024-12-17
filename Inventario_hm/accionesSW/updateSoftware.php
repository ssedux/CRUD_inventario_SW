<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("../config/config.php");

    $ID = trim($_POST['ID']); // Asegurase de recibir el ID del Software que se actualizará
    $id_equipo = trim($_POST['ID_equipo']);
    $version_W = trim($_POST['windows']);
    $key_w = trim($_POST['Key_W']);
    $version_OF = trim($_POST['ver_office']);
    $key_of = trim($_POST['Key_of']);
    $antivirus = trim($_POST['Antivirus']);
    $fecha_inicio = date('Y-m-d', strtotime($_POST['fecha_inicio']));
    $ip_i = trim($_POST['ip_i']);
    $otra_ip = trim($_POST['otra_ip']);
    $ip02 = trim($_POST['ip02']);
    $ip03 = trim($_POST['ip03']);
    $mclan = trim($_POST['maclan']);
    $MCWIFI = trim($_POST['macwifi']);
    
    

    // Actualiza los datos en la base de datos
    $sql = "UPDATE inventario_sw SET 
            ID_equipo='$id_equipo',
            ver_windows='$version_W', 
            key_W='$key_w', 
            ver_office='$version_OF', 
            Key_of='$key_of', 
            Antivirus='$antivirus', 
            fecha_inicio='$fecha_inicio',
            ip_i='$ip_i', 
            otra_ip='$otra_ip', 
            ip02='$ip02', 
            ip03='$ip03',
            maclan='$mclan', 
            macwifi='$MCWIFI' 
            WHERE ID='$ID'";

    if ($conexion->query($sql) === TRUE) {
        header("location:../");
    } else {
        echo "Error al actualizar el registro: " . $conexion->error;
    }
}
