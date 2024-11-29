<?php
//CONECCION A LA CLASE CON LA CONEXION A LA BD
include("connection.php");

$equipoRegistrado = false;

//GUARDAR LA INFORMACION EN LA BASE DE DATOS
if (isset($_POST['guardar'])) {
    if (strlen($_POST['id_inventario']) >= 1 &&
        !empty($_POST['fecha']) &&
        strlen($_POST['unidad']) >= 1 &&
        strlen($_POST['equipo']) >= 1 &&
        strlen($_POST['marca']) >= 1 &&
        strlen($_POST['modelo']) >= 1 &&
        strlen($_POST['serie']) >= 1 &&
        strlen($_POST['caracteristicas']) > 0) {

        $id = trim($_POST['id_inventario']);
        $fecha = date('Y-m-d', strtotime($_POST['fecha']));
        $unidad = trim($_POST['unidad']);
        $equipo = trim($_POST['equipo']);
        $marca = trim($_POST['marca']);
        $modelo = trim($_POST['modelo']);
        $serie = trim($_POST['serie']);
        $caracteristicas = trim($_POST['caracteristicas']);
        $Estado = trim($_POST['estado']);

        $consulta_verificar = "SELECT * FROM inventariof WHERE N_inventario = '$id'";
        $resultado_verificar = mysqli_query($conex, $consulta_verificar);
        if (mysqli_num_rows($resultado_verificar) > 0) {
            $equipoRegistrado = true;
        } else {
            $consulta = "INSERT INTO inventariof(N_inventario, fecha, Unidad, Tipo_equipo, Marca, Modelo, Serie, caracteristicas, estado) 
                VALUES ('$id','$fecha','$unidad','$equipo','$marca','$modelo','$serie','$caracteristicas', '$Estado')";
            $consulta_select = "SELECT * FROM inventariof";
            $resultado_select = mysqli_query($conex, $consulta_select);
            $filas = mysqli_fetch_all($resultado_select, MYSQLI_ASSOC);

            $resultado = mysqli_query($conex, $consulta);

            if ($resultado) {
                header("Location: index.php");
                exit;
                echo '<script>alert("Los datos se han guardado correctamente.");</script>';
            } else {
                ?>
                <h1>ha ocurrido un error</h1>
                <?php
            }
        }
    }
} elseif (isset($_POST['buscar'])) {
    if (strlen($_POST['id_inventario']) >= 1) {
        $serie_buscar = trim($_POST['id_inventario']);
        $consulta = "SELECT * FROM inventariof WHERE N_inventario = '$serie_buscar'";
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
}
?>

<script>
    //RESULTADO DE LA BUSQUEDA SIN RECARGAR LA PAGINA
    function buscarInventario(event) {
        event.preventDefault();

        var idInventario = document.getElementById("ID_V").value;

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);

                if (response.length > 0) {
                    var inventario = response[0];
                    document.getElementById("fecha").value = inventario.fecha;
                    document.getElementById("UE").value = inventario.Unidad;
                    document.getElementById("Tipo").value = inventario.Tipo_equipo;
                    document.getElementById("Marca").value = inventario.Marca;
                    document.getElementById("Modelo").value = inventario.Modelo;
                    document.getElementById("Serie").value = inventario.Serie;
                    document.getElementById("caracteristicas").value = inventario.caracteristicas;
                    document.getElementById("Estado").value = inventario.estado;
                } else {
                    alert("No se encontró ningún resultado");
                }
            }
        };
        xhr.send("buscar=1&id_inventario=" + idInventario);
    }
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="dark-mode.js"></script>
    <link rel="stylesheet" href="css/propios.css">
    <link rel="stylesheet" href="dark-mode.css">
    <title>Document</title>
</head>
<body>
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
                            <a class="nav-link" href="accesoriosDAO.php">Accesorios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">Inventario Fisico</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="tbFisico.php">LISTA</a>
                        </li>
                    </ul>
                </div>
                <label class="switch">
                    <button type="button" onclick="toggleDarkMode()" class="slider"></button>
                </label>
            </div>
        </nav>
        
    </header>
    <div class="container">
        <div class="form-container">
            <h2 class="form-title">Formulario de Registro de Inventario</h2>
            <form method="POST">
            <?php if ($equipoRegistrado) { ?>
        <div class="alert alert-danger" id="equipoRegistradoAlert">
            Equipo con numero de inventario ya registrado.
        </div>
    <?php } ?>
                <div class="mb-3">
                    <label for="ID_V" class="form-label">ID del Inventario</label>
                    <input type="text" class="form-control" id="ID_V" placeholder="ID" name="id_inventario" required>
                </div>
                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="DATE" class="form-control" id="fecha" placeholder="Fecha" name="fecha" required>
                </div>
                <div class="mb-3">
                    <label for="UE" class="form-label">Unidad del Equipo</label>
                    <input type="text" class="form-control" id="UE" placeholder="Unidad" name="unidad" required>
                </div>
                <div class="mb-3">
                    <label for="Tipo" class="form-label">Tipo de Equipo</label>
                    <input type="text" class="form-control" id="Tipo" placeholder="Tipo" name="equipo" required>
                </div>
                <div class="mb-3">
                    <label for="Marca" class="form-label">Marca del Equipo</label>
                    <input type="text" class="form-control" name="marca" placeholder="Marca" id="Marca" required>
                </div>
                <div class="mb-3">
                    <label for="Modelo" class="form-label">Modelo del Equipo</label>
                    <input type="text" class="form-control" name="modelo" placeholder="Modelo" id="Modelo" required>
                </div>
                <div class="mb-3">
                    <label for="Serie" class="form-label">Número de Serie</label>
                    <input type="text" class="form-control" name="serie" placeholder="Serie" id="Serie" required>
                </div>
                <div class="mb-3">
                    <label for="caracteristicas" class="form-label">Características del equipo</label>
                    <textarea class="form-control" name="caracteristicas" id="caracteristicas" placeholder="Características" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                <label for="Serie" class="form-label">Estado</label>
                <input type="text" class="form-control" name="estado" id="Estado" readonly value="EN USO">
                </div> 

                
                <div class="btn-container">
                    <button type="submit" class="btn btn-primary" name="guardar">GUARDAR</button>                    <button type="button" class="btn btn-primary" name="buscar" onclick="buscarInventario(event)">BUSCAR</button>
                    <button type="button" class="btn btn-primary new-record-btn" onclick="confirmarNuevoRegistro()">Nuevo Registro</button>
                    <button type="submit" class="btn btn-primary" name="guardar">MODIFICAR</button>
                    <button class="btn btn-primary" onclick="abrirPaginaEmergente(event)">DESCARTES</button>

            
        
                </div>
            </form>
        </div>
    </div>
    

<script>
    
</script>

        <script type="text/javascript">
            function abrirPaginaEmergente() {
                event.preventDefault();
                window.open('descartos.php', '_blank', 'width=500,height=500');
            }
        </script>
    <script>
        function confirmarNuevoRegistro(){
            if(confirm("¿Desea agregar un nuevo registro? se borran los valores actuales")){
                document.getElementById("ID_V").value = "";
                document.getElementById("fecha").value = "";
                document.getElementById("UE").value = "";
                document.getElementById("Tipo").value = "";
                document.getElementById("Marca").value = "";
                document.getElementById("Modelo").value = "";
                document.getElementById("Serie").value = "";
                document.getElementById("caracteristicas").value ="";
                document.getElementById("Estado").value = "EN USO";
            }
        }
    </script>
    <script>
    //RESULTADO DE LA BUSQUEDA SIN RECARGAR LA PAGINA
    function buscarInventario(event) {
        event.preventDefault();

        var idInventario = document.getElementById("ID_V").value;

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);

                if (response.length > 0) {
                    var inventario = response[0];
                    document.getElementById("ID_V").value = inventario.N_inventario;
                    document.getElementById("fecha").value = inventario.fecha;
                    document.getElementById("fecha").value = inventario.fecha;
                    document.getElementById("UE").value = inventario.Unidad;
                    document.getElementById("Tipo").value = inventario.Tipo_equipo;
                    document.getElementById("Marca").value = inventario.Marca;
                    document.getElementById("Modelo").value = inventario.Modelo;
                    document.getElementById("Serie").value = inventario.Serie;
                    document.getElementById("caracteristicas").value = inventario.caracteristicas;
                    document.getElementById("Estado").value = inventario.estado;
                } else {
                    alert("No se encontró ningún resultado");
                }
            }
        };
        xhr.send("buscar=1&id_inventario=" + idInventario);
    }
</script>
</body>
</html>





