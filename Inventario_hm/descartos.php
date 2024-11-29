<?php
include("connection.php");

if(isset($_POST['guardar'])){
    if(strlen($_POST['serie']) >= 1 &&
        !empty($_POST['fecha']) &&
        strlen($_POST['desc']) >= 1){

        $id = trim($_POST['serie']);
        $fecha = date('Y-m-d', strtotime($_POST['fecha']));
        $desc = trim($_POST['desc']);

        $query = "INSERT INTO descarto(N_inventario, fecha, descripcion)
                VALUES('$id', '$fecha', '$desc')";
        $resultado = mysqli_query($conex, $query);

        if($resultado){
            header("Location: descartos.php");
            exit;
            echo '<script>alert("Los datos se han guardado correctamente.");</script>';
        }else{
            echo '<h1>Ha ocurrido un error</h1>';
        }
    }else{
        echo '<script>alert("COMPLETE LOS CAMPOS");</script>';
    }
}elseif(isset($_POST['ls'])){
    $query = "SELECT descarto.*, inventariof.* FROM descarto
              INNER JOIN inventariof ON descarto.N_inventario = inventariof.N_inventario";
    $resultado = mysqli_query($conex, $query);

    if(mysqli_num_rows($resultado) > 0){
        echo "<h1>Lista de datos</h1>";
        echo "<table class='table'>";
        echo "<thead><tr><th>N° de Serie</th><th>Fecha</th><th>Descripción</th><th>Unidad</th><th>Tipo de equipo</th><th>Marca</th><th>Modelo</th></tr></thead>";
        echo "<tbody>";

        while($fila = mysqli_fetch_assoc($resultado)){
            echo "<tr>";
            echo "<td>".$fila['N_inventario']."</td>";
            echo "<td>".$fila['fecha']."</td>";
            echo "<td>".$fila['descripcion']."</td>";
            echo "<td>".$fila['Unidad']."</td>";
            echo "<td>".$fila['Tipo_equipo']."</td>";
            echo "<td>".$fila['Marca']."</td>";
            echo "<td>".$fila['Modelo']."</td>";
            echo "</tr>";
        }

        echo "</tbody></table>";
    }else{
        echo "<h1>No se encontraron datos</h1>";
    }

    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="dark-mode.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="col">
            <form method="POST">
                <div class="mb-3">
                    <label for="serie" class="form-label">N° de Serie</label>
                    <input type="text" class="form-control" name="serie" placeholder="Serie">
                </div>
                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" class="form-control" name="fecha">
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Descripción</label>
                    <input type="text" class="form-control" name="desc">
                </div>
                <div class="btn-container">   
                    <button type="submit" class="btn btn-primary" name="guardar">GUARDAR</button>
                    <button type="button" class="btn btn-primary" onclick="openListaPage()">Lista</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function openListaPage() {
            var elem = document.documentElement;

            if (elem.requestFullscreen) {
                elem.requestFullscreen();
            } else if (elem.mozRequestFullScreen) { /* Firefox */
                elem.mozRequestFullScreen();
            } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
                elem.webkitRequestFullscreen();
            } else if (elem.msRequestFullscreen) { /* IE/Edge */
                elem.msRequestFullscreen();
            }

            // Navegar a la página "descartosLS.php"
            window.location.href = "descartosLS.php";
        }
    </script>
</body>
</html>
