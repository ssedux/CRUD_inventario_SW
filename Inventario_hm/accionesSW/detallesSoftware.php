<?php
require_once("../config/config.php");
$ID = $_GET['ID'];

// Consultar la base de datos para obtener los detalles del Software
$sql = "SELECT * FROM inventario_sw WHERE ID = $ID LIMIT 1";
$query = $conexion->query($sql);
$Software = $query->fetch_assoc();

// Devolver los detalles del Software como un objeto JSON
header('Content-type: application/json; charset=utf-8');
echo json_encode($Software);
exit;
