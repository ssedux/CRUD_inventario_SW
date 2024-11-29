<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    include("../config/config.php");

    // Realizar la consulta para obtener los detalles del Software con el ID proporcionado
    $sql = "SELECT * FROM inventario_sw ORDER BY ID DESC LIMIT 1";
    $resultado = $conexion->query($sql);

    // Verificar si la consulta se ejecutó correctamente
    if (!$resultado) {
        echo json_encode(["error" => "Error al obtener los detalles del Software: " . $conexion->error]);
        exit();
    }

    // Obtener los detalles del ultimo Software registrado, como un array asociativo
    $Software = $resultado->fetch_assoc();

    // Devolver los detalles del Software como un objeto JSON
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($Software);
    exit;
}
