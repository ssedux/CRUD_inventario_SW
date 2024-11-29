<?php
 include("connection.php");
$consulta_select = "SELECT * FROM inventariof";
$resultado_select = mysqli_query($conex, $consulta_select);
$filas = mysqli_fetch_all($resultado_select, MYSQLI_ASSOC);

?>
