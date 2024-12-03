<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    include("../config/config.php");

    // Obtener el ID de Software de la solicitud GET y asegurarse de que sea un entero
    $IDSoftware = (int)$_GET['ID'];

    // Realizar la consulta para obtener los detalles del Software con el ID proporcionado
    $sql = "SELECT * FROM inventario_sw WHERE ID = $IDSoftware LIMIT 1";
    $resultado = $conexion->query($sql);

    // Verificar si la consulta se ejecutó correctamente
    if (!$resultado) {
        // Manejar el error aquí si la consulta no se ejecuta correctamente
        echo json_encode(["error" => "Error al obtener los detalles del Software: " . $conexion->error]);
        exit();
    }

    // Obtener los detalles del Software como un array asociativo
    $Software = $resultado->fetch_assoc();

    // Devolver los detalles del Software como un objeto JSON
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($Software);
    exit;
}
