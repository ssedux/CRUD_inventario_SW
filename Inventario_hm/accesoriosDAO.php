<?php
// GUARDAR EN LA BASE DE DATOS
include("connection.php");

include("connection.php");

if (isset($_POST['guardar'])) {
    if (strlen($_POST['serie']) >= 1 &&
        strlen($_POST['marca']) >= 1 &&
        strlen($_POST['modelo']) >= 1 &&
        strlen($_POST['tipo']) >= 1 &&
        strlen($_POST['ID']) > 0) {

        $serie = trim($_POST['serie']);
        $marca = trim($_POST['marca']);
        $modelo = trim($_POST['modelo']);
        $tipo = trim($_POST['tipo']);
        $descripcion = trim($_POST['descripcion']);
        $ID = trim($_POST['ID']);

        
        $consultaDescartado = "SELECT * FROM inventariof WHERE N_inventario = '$ID' AND estado = 'descartado'";
        $resultadoDescartado = mysqli_query($conex, $consultaDescartado);
        
        if ($resultadoDescartado && mysqli_num_rows($resultadoDescartado) > 0) {
            echo "<h3 class='text-center'>No se puede guardar el registro porque el estado está marcado como 'descartado'</h3>";
        } else {
            // Realizar la inserción en la tabla "accesorios"
            $consulta = "INSERT INTO accesorios (Serie, marca, Modelo, tipo, Descripcion, ID_equipo) 
                VALUES ('$serie', '$marca', '$modelo', '$tipo', '$descripcion', '$ID')";

            $resultado = mysqli_query($conex, $consulta);

            if ($resultado) {
                echo "<script>alert('Se guardó con éxito');</script>";
            } else {
                echo "<h1 class='text-center'>Ha ocurrido un error</h1>";
            }
        }
    } else {
        echo "<h3 class='text-center'>Complete los campos</h3>";
    }
}
elseif (isset($_POST['btnBuscar'])) {
    if (strlen($_POST['serie'] >= 1)) {
        $serie_buscar = trim($_POST['serie']);
        $consulta = "SELECT * FROM accesorios WHERE Serie = '$serie_buscar'";
        $resultado = mysqli_query($conex, $consulta);
        if (mysqli_num_rows($resultado) > 0) {
            $filas = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
            echo json_encode($filas);
            exit;

        } else {
            echo "[]";
            exit;
        }
    }
}?>

<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
    crossorigin="anonymous">
    <script src="dark-mode.js"></script>
   <link rel="stylesheet" href="dark-mode.css">
    <link rel="stylesheet" href="css/propios2.css">
    <style>
        body{
            color: white;
        }
        .container {
            margin-top: 100px;
        }
        .card {
            background-color:black;
            margin-top: 20px;
            padding: 20px;
        }
    </style>
    <title>ACCESORIOS</title>
</head>
<body>
    <!-- HEADER NAV -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light menu">
        
            <script src="scrip/index.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function(){
                    var altura = $('.menu').offset().top;

                    $(window).on('scroll', function(){
                        if ($(window).scrollTop() > altura){
                            $('.menu').addClass('menu-fixed');
                        } else {
                            $('.menu').removeClass('menu-fixed');
                        }
                    });
                });
            </script>
            <div class="container-fluid">
            <img src="img/LOGO-min.png" alt="" style="width: 100px; height: auto;">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="Softwarefrm.php">Inventario de Software</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="accesoriosDAO.php">Accesorios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Inventario Fisico</a>
                        </li>
                        <a class="nav-link" href="tbAccesorios.php">LISTA</a>

                    </ul>
                </div>
                <label class="switch">
                    <button type="button" onclick="toggleDarkMode()" class="slider"></button>
                </label>
            </div>
        </nav>
    </header>
    

    <!-- FORMULARIO -->
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center mb-4">Registrar Accesorio</h1>
                    <form method="post">
                        <div class="mb-3">
                            <label for="serie" class="form-label">N° de serie</label>
                            <input type="text" class="form-control" id="serie" name="serie" required>
                        </div>
                        <div class="mb-3">
                            <label for="marca" class="form-label">Marca</label>
                            <input type="text" class="form-control" id="marca" name="marca" required>
                        </div>
                        <div class="mb-3">
                            <label for="tipo" class="form-label">Tipo</label>
                            <input type="text" class="form-control" id="tipo" name="tipo" required>
                        </div>
                        <div class="mb-3">
                            <label for="modelo" class="form-label">Modelo</label>
                            <input type="text" class="form-control" id="modelo" name="modelo" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion">
                        </div>
                        <div class="mb-3">
                            <label for="ID" class="form-label">ID del Equipo</label>
                            <input type="text" class="form-control" id="ID" name="ID" required>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary" name="guardar">Guardar</button>
                            <button type="submit" class="btn btn-primary" name="btnBuscar" onclick="buscarInventario(event)">Buscar</button>
                            <button type="button" class="btn btn-primary new-record-btn" onclick="confirmarNuevoRegistro()">Nuevo Registro</button>
                
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPTS -->
<script>
    function buscarInventario(event) {
        event.preventDefault();

        var serie = document.getElementById("serie").value;

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);

                    if (response.length > 0) {
                        var accesorio = response[0];
                        document.getElementById("marca").value = accesorio.marca;
                        document.getElementById("tipo").value = accesorio.tipo;
                        document.getElementById("modelo").value = accesorio.modelo;
                        document.getElementById("descripcion").value = accesorio.descripcion;
                        document.getElementById("ID").value = accesorio.ID_equipo;
                    } else {
                        alert("No se encontró ningún resultado");
                    }
                }
            }
        };
        xhr.send("btnBuscar=1&serie=" + serie);
    }

    function confirmarNuevoRegistro() {
        if (confirm("¿Estás seguro de que deseas iniciar un nuevo registro? Se borrarán los valores actuales")) {
            // Borrar los valores de las celdas del formulario.
            document.getElementById("serie").value = "";
            document.getElementById("marca").value = "";
            document.getElementById("tipo").value = "";
            document.getElementById("modelo").value = "";
            document.getElementById("descripcion").value = "";
            document.getElementById("ID").value = "";
        }
    }
</script>
</body>
</html>
