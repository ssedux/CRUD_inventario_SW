<?php
//TOD EL CODIGO SE ENCUETRA EN EL MISMO ARCHIVO, LA CONECION ESTA PERFECTA
include("modelo/connection.php");
//GUARDAR REGISTRO
if(isset($_POST['guardar'])){
    if (!empty($_POST['fecha_inicio']) &&
        strlen($_POST['antivirus']) >= 1 &&
        strlen($_POST['ip_interna']) > 0 &&
        strlen($_POST['maclan']) >= 1 &&
        !empty($_POST['ID_equipo'])){

        $fecha_inicio = date('Y-m-d', strtotime($_POST['fecha_inicio']));
        $version_W = trim($_POST['ver_windows']);
        $key_w = trim($_POST['Key_W']);
        $version_OF = trim($_POST['ver_office']);
        $key_of = trim($_POST['Key_of']);
        $antivirus = trim($_POST['antivirus']);
        $ip_i = trim($_POST['ip_interna']);
        $OTRA_IP = trim($_POST['otra_ip']);
        $mclan = trim($_POST['maclan']);
        $MCWIFI = trim($_POST['macwifi']);
        $id_equipo = trim($_POST['ID_equipo']);
        $ip02 = trim($_POST['ip02']);
        $ip03 = trim($_POST['ip03']);
        $consulta_ = "INSERT INTO inventario_sw(ID_equipo, ver_windows, Key_W, ver_office, 
        Key_of, Antivirus, fecha_inicio, Ip_interna, otra_ip,ip02, ip03, maclan, macwifi) 
        VALUES ('$id_equipo','$version_W','$key_w','$version_OF',
        '$key_of','$antivirus','$fecha_inicio','$ip_i','$OTRA_IP','$mclan','$ip02','$ip03','$MCWIFI')";

        $resultado_ = mysqli_query($conex, $consulta_);

        if($resultado_){
            header("Location: Softwarefrm.php");
            exit;
        }else{
            ?>
            <script>
                alert("ERROR");
                location.href = "Softwarefrm.php"; 
            </script>
            <?php
        }
    }else{
        ?>
        <script>
            alert("ERROR");
        </script>
        <?php
    }
    //BUSCAR REGISTRO YA REGISTRADO EN LA BASE DE DATOS 


    
}elseif(isset($_POST['btnBuscar'])) {
    if (strlen($_POST['txtbuscar']) >= 1) {
        $serie_buscar = trim($_POST['txtbuscar']);
        $consulta = "SELECT * FROM inventario_sw WHERE ID = '$serie_buscar'";
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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Estilos Boostrab-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/efdbd9f540.js" crossorigin="anonymous"></script>
    <title>Inventario Software</title>
</head>
<body>
    <!--COMIENZO NAV-->
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
                                    <a class="nav-link active" aria-current="page" href="Softwarefrm.php">Inventario de Software</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="accesoriosDAO.php">Accesorios</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php">Inventario Fisico</a>
                                </li>
                                <a class="nav-link" href="tbSoftware.php">LISTA</a>
                            </ul>
                        </div>
                        <label class="switch">
                            <button type="button" onclick="toggleDarkMode()" class="slider"></button>
                        </label>
                    </div>
                
            </nav>
            
        </header>
    <!--FIN NAV-->

    <!--COMIENZO SECCION INICIO-->
    <section class="container-fluid" id="inicio">
        <div class="row text-center">
            <div class="col">
                <h1 class="mt-5">¡Bienvenido al Inventario de Software!</h1>
                <p class="lead">Aquí podrás gestionar la información de los equipos y su software instalado.</p>
            </div>
        </div>
    </section>
    <!--FIN SECCION INICIO-->

    <!--COMIENZO SECCION REGISTRAR NUEVO-->
    <div class="row text-center">
        <div >
            <h2 class="mt-5">Registrar Nuevo Equipo</h2>
            <p class="lead">Completa el siguiente formulario para registrar un nuevo equipo.</p>
        </div>
    </div>
    <div class="container-fluid row">
            
        <form class="col-3  p-3" method="POST">
            <div class="mb-3">
                <label for="VW" class="form-label">Versión de Windows</label>
                <input type="text" class="form-control" id="VW" name="ver_windows" required>
            </div>
            <div class="mb-3">
                <label for="KW" class="form-label">Key de Windows</label>
                <input type="text" class="form-control" id="KW" name="Key_W" required>
            </div>
            <div class="mb-3">
                <label for="VO" class="form-label">Versión de Office</label>
                <input type="text" class="form-control" id="VO" name="ver_office" required>
            </div>
            <div class="mb-3">
                <label for="KEYO" class="form-label">Key de Office</label>
                <input type="text" class="form-control" id="KEYO" name="Key_of" required>
            </div>
            <div class="mb-3">
                <label for="Antivirus" class="form-label">Antivirus</label>
                <input type="text" class="form-control" id="Antivirus" name="antivirus" required>
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha de Inicio</label>
                <input type="date" class="form-control" id="fecha" name="fecha_inicio" required>
            </div>
            <div class="mb-3">
                <label for="IP_I" class="form-label">IP Interna</label>
                <input type="text" class="form-control" id="IP_I" name="ip_interna" required>
            </div>
            <div class="mb-3">
                <label for="O_IP" class="form-label">Otra IP</label>
                <input type="text" class="form-control" id="O_IP" name="otra_ip" required>
            </div>
            <div class="mb-3">
                <label for="O_IP" class="form-label">IP02</label>
                <input type="text" class="form-control" id="IP02" name="ip02">
            </div>
            <div class="mb-3">
                <label for="O_IP" class="form-label">IP03</label>
                <input type="text" class="form-control" id="IP03" name="ip03" >
            </div>
            <div class="mb-3">
                <label for="MACLAN" class="form-label">MAC LAN</label>
                <input type="text" class="form-control" id="MACLAN" name="maclan" required>
            </div>
            <div class="mb-3">
                <label for="MACWIFI" class="form-label">MAC Wi-Fi</label>
                <input type="text" class="form-control" id="MACWIFI" name="macwifi" required>
            </div>
            <div class="mb-3">
                <label for="ID_F" class="form-label">ID de Equipo</label>
                <input type="text" class="form-control" id="ID_F" name="ID_equipo" required>
            </div>
            <div class="col-12 d-1 justify-content-start mt-4">
            <button type="submit" class="btn btn-success" name="guardar">Registrar</button>
            <button type="button" class="btn btn-primary new-record-btn" onclick="confirmarNuevoRegistro()">Nuevo Registro</button>
            </div>
        </form>

        <div class="col-9 p-3">
            <table id="tabla" class="table table-striped">
                <thead class="bg-info">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">ID Equipo</th>
                        <th scope="col">Windows</th>
                        <th scope="col">key</th>
                        <th scope="col">Office</th>
                        <th scope="col">key</th>
                        <th scope="col">Antivirus</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Ip interna</th>
                        <th scope="col">Otra ip</th>
                        <th scope="col">MACLAN</th>
                        <th scope="col">MACWIFI</th>
                        <th scope="col"></th>
                    </tr>
                </thead>  
                <tbody>
                    <?php 
                    include "modelo/connection.php";
                    $query = 'SELECT * FROM inventario_sw';
                    $result = mysqli_query($conex, $query);
                    while ($row = mysqli_fetch_assoc($result)) { 
                    ?>
                    <tr>
                        <td><?php echo $row['ID'] ?></td>
                        <td><?php echo $row['ID_equipo'] ?></td>
                        <td><?php echo $row['ver_windows'] ?></td>
                        <td><?php echo $row['Key_W'] ?></td>
                        <td><?php echo $row['ver_office'] ?></td>
                        <td><?php echo $row['Key_of'] ?></td>
                        <td><?php echo $row['Antivirus'] ?></td>
                        <td><?php echo $row['fecha_inicio'] ?></td>
                        <td><?php echo $row['Ip_interna'] ?></td>
                        <td><?php echo $row['otra_ip'] ?></td>
                        <td><?php echo $row['maclan'] ?></td>
                        <td><?php echo $row['macwifi'] ?></td>
                        <td>
                            <a href="" class="btn btn small btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="" class="btn btn small btn-danger"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
                        
                        
    
    <!--FIN SECCION REGISTRAR NUEVO-->

    <!--COMIENZO SECCION BUSCAR POR ID-->
        <div class="row text-center">
            <div class="col">
                <h2 class="mt-5">Buscar Equipo por ID</h2>
                <p class="lead">Ingresa el ID del equipo para buscar su información.</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form>
                    <div class="mb-3">
                        <label for="ID" class="form-label">ID del Equipo</label>
                        <input type="text" class="form-control"name = "txtbuscar" id="ID" required>
                    </div>
                    <button type="button" class="btn btn-primary" name="btnBuscar" id="buscar" onclick="buscarInventario(event)">Buscar</button>
                </form>
            </div>
        </div>
        </body>
    <!--FIN SECCION BUSCAR POR ID-->

    <!--Scripts de Boostrab-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-pzjwq+3kUVo+MrEIdD8ns9bY3HtFaw5f5hxE6wqC5BNU8COuKCfGtgLvjvh/Kvcj" crossorigin="anonymous"></script>
    <script>
            function toggleDarkMode() {
    document.body.classList.toggle('dark-mode');
    }
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
    $(document).ready(function() {
        function buscarInventario(event) {
            event.preventDefault();
        
            var idInventario = document.getElementById("ID").value;
        
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "", true); // La URL está vacía para enviar la solicitud a la misma página
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        var response = JSON.parse(xhr.responseText);
        
                        if (response.length > 0) {
                            var inventario = response[0];
                            document.getElementById("VW").value = inventario.ver_windows;
                            document.getElementById("KW").value = inventario.Key_W;
                            document.getElementById("VO").value = inventario.ver_office;
                            document.getElementById("KEYO").value = inventario.Key_of;
                            document.getElementById("Antivirus").value = inventario.Antivirus;
                            document.getElementById("fecha").value = inventario.fecha_inicio;
                            document.getElementById("IP_I").value = inventario.Ip_interna;
                            document.getElementById("O_IP").value = inventario.otra_ip;
                            document.getElementById("MACLAN").value = inventario.maclan;
                            document.getElementById("MACWIFI").value = inventario.macwifi;
                            document.getElementById("ID_F").value = inventario.ID_equipo;  
                            document.getElementById("IP02").value = inventario.ip02;
                            document.getElementById("IP03").value = inventario.ip03;   
                        } else {
                            alert("No se encontró ningún resultado");
                        }
                    }
                }
            };
            xhr.send("btnBuscar=1&txtbuscar=" + idInventario);
        }
           // Asigna el evento click al botón de búsqueda
        document.getElementById("buscar").addEventListener("click", buscarInventario);
    });
</script>


<script>
function confirmarNuevoRegistro() {
        if (confirm("¿Estás seguro de que deseas iniciar un nuevo registro? Se borrarán los valores actuales")) {
            // Borrar los valores de las celdas del formulario.
            document.getElementById("VW").value = "";
            document.getElementById("KW").value = "";
            document.getElementById("VO").value = "";
            document.getElementById("KEYO").value = "";
            document.getElementById("Antivirus").value = "";
            document.getElementById("fecha").value = "";
            document.getElementById("IP_I").value = "";
            document.getElementById("O_IP").value = "";
            document.getElementById("MACLAN").value = "";
            document.getElementById("MACWIFI").value = "";
            document.getElementById("ID_F").value = "";
            document.getElementById("IP02").value = "";
            document.getElementById("IP03").value = "";
        }
    }
</script>


</html>

