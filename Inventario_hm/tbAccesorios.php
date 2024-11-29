<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.10.0/jspdf.umd.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>

    <title>Lista Accesorios</title>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Lista de Accesorios</h1>
        <table id="tabla" class="table table-striped">
            <thead>
                <tr>
                    <th>N° de Serie</th>
                    <th>Marca</th>
                    <th>Descripción</th>
                    <th>Tipo de equipo</th>
                    <th>Modelo</th>
                    <th>ID equipo fisico</th>
                </tr>
            </thead>
            <tbody>
    <?php
    $conex = mysqli_connect("localhost", "root", "123456", "inventario");
    $query = 'SELECT * FROM accesorios';
    $result = mysqli_query($conex, $query);
    while($fila = mysqli_fetch_assoc($result)){
        echo "<tr>";
        echo "<td>".$fila['Serie']."</td>";
        echo "<td>".$fila['marca']."</td>";
        echo "<td>".$fila['Modelo']."</td>";
        echo "<td>".$fila['tipo']."</td>";
        echo "<td>".$fila['Descripcion']."</td>";
        echo "<td>".$fila['ID_equipo']."</td>";
        echo "</tr>";
    }
    ?>
</tbody>
        </table>

        <div class="text-center mt-3">
            <button class="btn btn-primary" onclick="abrirVentanaImprimir()">Imprimir</button>
            <button class="btn btn-success" onclick="exportarExcel()">Exportar a Excel</button>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#tabla').DataTable({
                "language": {
                    "search": "Buscar:"
                }
            });
        });

        function cargarTabla() {
            var contenidoTabla = `
                <thead>
                    <tr>
                        <th>N° de Serie</th>
                        <th>Marca</th>
                        <th>Descripción</th>
                        <th>Tipo de equipo</th>
                        <th>Modelo</th>
                        <th>ID equipo fisico</th>
                    </tr>
                </thead>
                <tbody>
            `;

            <?php
            $result = mysqli_query($conex, $query);
            while($fila = mysqli_fetch_assoc($result)){
                echo "contenidoTabla += '<tr>';";
                echo "contenidoTabla += '<td>".$fila['Serie']."</td>';";
                echo "contenidoTabla += '<td>".$fila['marca']."</td>';";
                echo "contenidoTabla += '<td>".$fila['Modelo']."</td>';";
                echo "contenidoTabla += '<td>".$fila['tipo']."</td>';";
                echo "contenidoTabla += '<td>".$fila['Descripcion']."</td>';";
                echo "contenidoTabla += '<td>".$fila['ID_equipo']."</td>';";
                echo "contenidoTabla += '</tr>';";
            }
            ?>

            contenidoTabla += `
                </tbody>
            `;

            document.getElementById('tabla').innerHTML = contenidoTabla;
        }

        function abrirVentanaImprimir() {
            var nuevaVentana = window.open('', '_blank');
            nuevaVentana.document.write('<html><head><title>Tabla de Accesorios</title>');
            nuevaVentana.document.write('<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">');
            nuevaVentana.document.write('</head><body>');
            nuevaVentana.document.write('<h1 class="text-center">Lista de Accesorios</h1>');
            nuevaVentana.document.write('<table class="table table-striped">');
            cargarTabla();
            nuevaVentana.document.write(document.getElementById('tabla').innerHTML);
            nuevaVentana.document.write('</table>');
            nuevaVentana.document.write('</body></html>');
            nuevaVentana.document.close();

            setTimeout(function() {
                nuevaVentana.print();
            }, 500); // Espera 500 milisegundos (0.5 segundos) para asegurar que los estilos se apliquen.

            return false; // Evita que la ventana emergente se cierre inmediatamente en algunos navegadores.
        }

        function exportarExcel() {
            var tabla = document.getElementById('tabla');
            var libro = XLSX.utils.table_to_book(tabla);
            XLSX.writeFile(libro, 'tabla_accesorios.xlsx');
        }
    </script>
</body>
</html>
