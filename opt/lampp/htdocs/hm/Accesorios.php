<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventario Software</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.css">


    <!-- Libreria para alertas ----->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    <!-- diseño barra lateral -->
    <link rel="stylesheet" href="assets/css/navstyle.css">
    <link rel="stylesheet" href="assets/css/styleSW.css">    
    
    
        <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                        <?php
			    include("menu-lateral.php");
			    ?>
        </nav>
    </aside>
    <!-- /#left-panel -->
        <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./"><img src="images/LOGO-min.png" alt="Logo"></a>
                    <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
                   </header>
        <!-- /#header -->
   <!-- Right Panel -->
   
   
		  <div class="row">
		  
		      <?php
    include("config/config.php");
    include("acciones/acciones.php");

    $Software = obtenerSoftware($conexion);
    $totalSoftware = $Software->num_rows;
    ?>
		  <h1 class="text-center mt-5 mb-5 fw-bold">Inventario de Accesorios</h1>

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-12">
                <h1 class="text-center">
                    
                </h1>
                
                   <!-- Aqui el contenido de hardware -->
                
                
                
                
            </div>
        </div>
    </div>
		  
		  
		  
			
 
 
        <!-- /.content -->
        <div class="clearfix"></div>
        <!-- Footer -->
        <footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6">
                        Copyright &copy; 2024 Eduardo Sanchez
                    </div>
                    <div class="col-sm-6 text-right">
                        Designed by <a href="https://colorlib.com">SSEDUX</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/efdbd9f540.js" crossorigin="anonymous"></script>
    <script src="assets/js/navbar.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="assets/js/addSoftware.js"></script>
    <script src="assets/js/detallesSoftware.js"></script>
    <script src="assets/js/editarSoftware.js"></script>
    <script src="assets/js/eliminarSoftware.js"></script>
    <script src="assets/js/refreshTableAdd.js"></script>
    <script src="assets/js/refreshTableEdit.js"></script>
    <script src="assets/js/alertas.js"></script>

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



</body>

</html>







