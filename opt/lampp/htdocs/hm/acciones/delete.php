<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("../config/config.php");

    // Leer el cuerpo de la solicitud JSON
    $json_data = file_get_contents("php://input");
    // Decodificar los datos JSON en un array asociativo
    $data = json_decode($json_data, true);


    // Verificar si los datos se decodificaron correctamente
    if ($data !== null) {
        $ID = $data['ID'];

        $sql = "DELETE FROM inventario_sw WHERE ID=$ID";
        if ($conexion->query($sql) === TRUE) {
            echo json_encode(array("success" => true, "message" => "Software eliminado correctamente"));
        } else {
            echo json_encode(array("success" => false, "message" => "El parámetro 'ID' no se proporcionó"));
        }
    } else {
        // Si no se proporcionó el parámetro 'action', devolver un mensaje de error
        echo json_encode(array("success" => false, "message" => "La acción no se proporcionó"));
    }
}
