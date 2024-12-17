<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Estilos Boostrab-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
   

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.css">

    <!-- diseño barra lateral -->
    <link rel="stylesheet" href="../css/navstyle.css">
    <link rel="stylesheet" href="../css/styleSW.css">

    <!-- Libreria para alertas ----->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <title>Inventario Software</title>
</head>

    
<body>
    <!-- Contenedor principal para barra lateral y contenido -->
    <div class="contenedor">
        <!-- Barra lateral -->
        <div class="barra-lateral">
            <img class="logonav" id="logo" src="../img/LOGO-min.png" alt=""> 
            <nav class="navegacion">
                <ul>
                    <li>
                        <a id="software" href="#">
                            <i class="fa-brands fa-uncharted"></i>
                            <span class="nav-item">Software</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-solid fa-computer"></i>
                            <span class="nav-item">Hardware</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-solid fa-keyboard"></i>
                            <span class="nav-item">Accesorios</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="linea"></div>
            <div class="modo-oscuro">
                <div class="info">
                    <i class="fa-regular fa-moon"></i>
                    <span>Modo Oscuro</span>
                </div>
                <div class="switch">
                    <div class="base">
                        <div class="circulo"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Contenido principal -->
        <div class="contenido-fondo">
        <?php
            include("../config/config.php");
            include("../accionesSW/acciones.php");

            $Software = obtenerSoftware($conexion);
            $totalSoftware = $Software->num_rows;
            ?>

            <h1 class="text-center mt-5 mb-5 fw-bold">Inventario Software</h1>

            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-md-12">
                        <h1 class="text-center">
                            <span class="float-start">
                                <a href="#" onclick="modalRegistrarSoftware()" class="btn btn-success" title="Registrar Nuevo Software">
                                <i class="fa-solid fa-folder-plus"></i>
                                </a>
                            </span>
                            Lista de Software (<?php echo $totalSoftware ?>)
                            <span class="float-end">
                                <a href="acciones/exportar.php" class="btn btn-success" title="Exportar a CSV" download="Software.csv"><i class="bi bi-filetype-csv"></i></a>
                            </span>
                            <hr>
                        </h1>
                        <?php
                        include("modeloSW/Software.php"); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
   


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="../script/jsSW/addSoftware.js"></script>
    <script src="../script/jsSW/detallesSoftware.js"></script>
    <script src="../script/jsSW/editarSoftware.js"></script>
    <script src="../script/jsSW/eliminarSoftware.js"></script>
    <script src="../script/jsSW/refreshTableAdd.js"></script>
    <script src="../script/jsSW/refreshTableEdit.js"></script>
    <script src="../script/jsSW/alertas.js"></script>

    <!-------------------------Librería  datatable para la tabla -------------------------->
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.js"></script>
    <script src="https://kit.fontawesome.com/efdbd9f540.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $("#inventario_sw").DataTable({
                pageLength: 12,
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json",
                },
            });
        });
    </script>

    <script src="../script/navbar.js"></script>

</body>

</html>