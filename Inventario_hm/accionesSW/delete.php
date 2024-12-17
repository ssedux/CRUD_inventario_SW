<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("../config/config.php");

    // Leer el cuerpo de la solicitud JSON
    $json_data = file_get_contents("php://input");
    // Decodificar los datos JSON en un array asociativo
    $data = json_decode($json_data, true);

    // Verificar si los datos se decodificaron correctamente
    if ($data !== null && isset($data['id'])) {  // Cambia a 'id' en lugar de 'ID'
        $ID = $data['id'];

        $sql = "DELETE FROM inventario_sw WHERE ID = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $ID);

        if ($stmt->execute()) {
            echo json_encode(array("success" => true, "message" => "Software eliminado correctamente"));
        } else {
            echo json_encode(array("success" => false, "message" => "Error al eliminar el Software"));
        }

        $stmt->close();
    } else {
        echo json_encode(array("success" => false, "message" => "El parámetro 'id' no se proporcionó"));
    }
}

