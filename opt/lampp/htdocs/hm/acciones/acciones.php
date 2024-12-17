<?php
/*
ini_set('display_errors', 1);
error_reporting(E_ALL);
*/


if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include("../config/config.php");
        $inventarioSW= "inventario_sw";

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
        $sql = "INSERT INTO inventario_sw(ID_equipo, ver_windows, Key_W, ver_office, 
                Key_of, Antivirus, fecha_inicio, ip_i, otra_ip,ip02, ip03, maclan, macwifi) 
                VALUES ('$id_equipo','$version_W','$key_w','$version_OF','$key_of','$antivirus','$fecha_inicio','$ip_i','$otra_ip','$ip02','$ip03','$mclan','$MCWIFI')";
    
                if ($conexion->query($sql) === TRUE) {
                    header("location:../");
                } else {
                    echo "Error al crear el registro: " . $conexion->error;
                }
            
}

/**
 * Función para obtener todos los Software 
 */

function obtenerSoftware($conexion)
{
    $sql = "SELECT * FROM inventario_sw ORDER BY ID ASC";
    $resultado = $conexion->query($sql);
    if (!$resultado) {
        return false;
    }
    return $resultado;
}
