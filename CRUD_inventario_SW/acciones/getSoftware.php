<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    include("../config/config.php");

    // Verificar si el parámetro 'ID' está presente y es un número entero
    if (isset($_GET['ID']) && is_numeric($_GET['ID'])) {
        $IDSoftware = (int)$_GET['ID']; // Convertir a entero

        // Preparar la consulta para obtener los detalles del Software con el ID proporcionado
        $sql = "SELECT * FROM inventario_sw WHERE ID = ? LIMIT 1";
        
        // Preparar la consulta para evitar inyección SQL
        if ($stmt = $conexion->prepare($sql)) {
            $stmt->bind_param("i", $IDSoftware); // Asociar el parámetro con la consulta

            // Ejecutar la consulta
            $stmt->execute();
            $resultado = $stmt->get_result();

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

            // Cerrar la declaración preparada
            $stmt->close();
        } else {
            // Si no se pudo preparar la consulta, devolver un error
            echo json_encode(["error" => "Error al preparar la consulta"]);
        }
    } else {
        // Si el parámetro 'ID' no está presente o no es un número válido
        echo json_encode(["error" => "ID de Software inválido o no proporcionado"]);
    }

    exit;
}
?>
