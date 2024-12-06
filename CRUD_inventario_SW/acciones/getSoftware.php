<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    include("../config/config.php");

    // Verificar si el parámetro 'ID' está presente y es un número entero
    if (isset($_GET['ID']) && is_numeric($_GET['ID'])) {
        $IDSoftware = (int)$_GET['ID']; // Convertir a entero

        // Realizar la consulta para obtener los detalles del Software con el ID proporcionado
        $sql = "SELECT * FROM inventario_sw WHERE ID = $IDSoftware LIMIT 1";
        $resultado = $conexion->query($sql);

        // Verificar si la consulta se ejecutó correctamente
        if (!$resultado) {
            // Manejar el error aquí si la consulta no se ejecuta correctamente
            echo json_encode(["error" => "Error al obtener los detalles del Software: " . $conexion->error]);
            exit();
        }

        // Verificar si el software con ese ID existe
        if ($resultado->num_rows > 0) {
            // Obtener los detalles del Software como un array asociativo
            $Software = $resultado->fetch_assoc();

            // Devolver los detalles del Software como un objeto JSON
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($Software);
        } else {
            // Si no se encuentra el software, devolver un error
            echo json_encode(["error" => "Software no encontrado"]);
        }
    } else {
        // Si el parámetro 'ID' no está presente o no es un número válido
        echo json_encode(["error" => "ID de Software inválido o no proporcionado"]);
    }

    exit;
}
?>
