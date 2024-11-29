<?php
include("connection.php");
$query = "SELECT d.N_inventario, d.fecha, d.descripcion, i.Unidad, i.Tipo_equipo, i.Marca, i.Modelo FROM descarto AS d JOIN inventariof AS i ON d.N_inventario = i.N_inventario";
$resultado = mysqli_query($conex, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>

    <title>Lista de Descartos</title>
</head>
<body>
    <div class="container">
        <h1>Hoja de descarte</h1>
        <table id="tabla" class="table table-striped">
            <thead>
                <tr>
                    <th>N° de Serie</th>
                    <th>Fecha</th>
                    <th>Descripción</th>
                    <th>Unidad</th>
                    <th>Tipo de equipo</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($fila = mysqli_fetch_assoc($resultado)){
                    echo "<tr>";
                    echo "<td>".$fila['N_inventario']."</td>";
                    echo "<td>".$fila['fecha']."</td>";
                    echo "<td>".$fila['descripcion']."</td>";
                    echo "<td>".$fila['Unidad']."</td>";
                    echo "<td>".$fila['Tipo_equipo']."</td>";
                    echo "<td>".$fila['Marca']."</td>";
                    echo "<td>".$fila['Modelo']."</td>";
                    echo '<td><button onclick="imprimirRegistro(\''.$fila['N_inventario'].'\', \''.$fila['fecha'].'\', \''.$fila['descripcion'].'\', \''.$fila['Unidad'].'\', \''.$fila['Tipo_equipo'].'\', \''.$fila['Marca'].'\', \''.$fila['Modelo'].'\')">Imprimir</button></td>';
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

    </div>
    <div>
    <button class="btn btn-success" onclick="exportarExcel()">Exportar a Excel</button>
    </div>

    <script>
        function imprimirRegistro(N_inventario, fecha, descripcion, Unidad, Tipo_equipo, Marca, Modelo) {
            var contenido = `
                <div class="hoja-descarte">
                    <h1 style="text-align: center;">Hoja de Descarte</h1>
                    <img src="img/LOGO-min.png" alt="Logo" style="display: block; margin: 0 auto; max-width: 200px;">
                    <div class="registro">
                        <div class="titulo-registro">N° de Serie:</div>
                        <div class="contenido-registro">${N_inventario}</div>
                    </div>
                    <div class="registro">
                        <div class="titulo-registro">Fecha:</div>
                        <div class="contenido-registro">${fecha}</div>
                    </div>
                    <div class="registro">
                        <div class="titulo-registro">Descripción:</div>
                        <div class="contenido-registro">${descripcion}</div>
                    </div>
                    <div class="registro">
                        <div class="titulo-registro">Unidad:</div>
                        <div class="contenido-registro">${Unidad}</div>
                    </div>
                    <div class="registro">
                        <div class="titulo-registro">Tipo de equipo:</div>
                        <div class="contenido-registro">${Tipo_equipo}</div>
                    </div>
                    <div class="registro">
                        <div class="titulo-registro">Marca:</div>
                        <div class="contenido-registro">${Marca}</div>
                    </div>
                    <div class="registro">
                        <div class="titulo-registro">Modelo:</div>
                        <div class="contenido-registro">${Modelo}</div>
                    </div>
                </div>
                </div>
            `;

            var ventana = window.open('', '_blank');
            ventana.document.write('<link rel="stylesheet" type="text/css" href="print.css">'); // Enlace al archivo de estilos "print.css"
            ventana.document.write(contenido);
            ventana.document.close();

            ventana.onload = function() {
                ventana.print();
                ventana.close();
            };
        }

        $(document).ready(function() {
            $('#tabla').DataTable({
                "language": {
                    "search": "Buscar:"
                }
            });
        });
        function exportarExcel() {
            var tabla = document.getElementById('tabla');
            var libro = XLSX.utils.table_to_book(tabla);
            XLSX.writeFile(libro, 'Descarto.xlsx');
        }
    </script>
</body>
</html>
