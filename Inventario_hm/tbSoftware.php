<?php
$conex = mysqli_connect("localhost", "root", "", "inventario");
$query = 'SELECT * FROM inventario_sw';
$result = mysqli_query($conex, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
    crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.bootstrap5.min.js"></script>
    <!-- links para exportar a excel -->
    <script src="https://unpkg.com/xlsx@0.16.9/dist/xlsx.full.min.js"></script>
    <script src="https://unpkg.com/moment@2.29.1/moment.min.js"></script>
    <script src="https://unpkg.com/file-saverjs@latest/FileSaver.min.js"></script>
    <script src="https://unpkg.com/tableexport@latest/dist/js/tableexport.min.js"></script>
    <style>
        @media print {
        body * {
            visibility: hidden;
        }
        .table * {
            visibility: visible;
        }
        .dataTables_empty {
            display: none;
        }
        
        /* Ajustar tamaño de página al imprimir */
        @page {
            size: auto;
        }
        
        /* Estilo de la tabla para impresión */
        table.dataTable {
            table-layout: auto; /* Ajusta el ancho de las columnas automáticamente */
            width: 100%;
        }
        
        /* Ajuste para las celdas */
        table.dataTable td, table.dataTable th {
            white-space: nowrap; /* Evita el salto de línea en las celdas */
        }
        
        /* Ajuste de ancho para la columna de fecha */
        table.dataTable td:nth-child(8), table.dataTable th:nth-child(8) {
            width: 150px; /* Ajusta el ancho según sea necesario */
        }
    }
    </style>
</head>
<body>
    <table id="tabla" class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Equipo</th>
                <th>Windows</th>
                <th>key</th>
                <th>Office</th>
                <th>key</th>
                <th>Antivirus</th>
                <th>Fecha</th>
                <th>Ip interna</th>
                <th>Otra ip</th>
                <th>MACLAN</th>
                <th>MACWIFI</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['ID'] ?></td>
                <td><?php echo $row['ID_equipo'] ?></td>
                <td><?php echo $row['ver_windows'] ?></td>
                <td><?php echo $row['Key_W'] ?></td>
                <td><?php echo $row['ver_office'] ?></td>
                <td><?php echo $row['Key_of'] ?></td>
                <td><?php echo $row['Antivirus'] ?></td>
                <td><?php echo $row['fecha_inicio'] ?></td>
                <td><?php echo $row['ip_i'] ?></td>
                <td><?php echo $row['otra_ip'] ?></td>
                <td><?php echo $row['maclan'] ?></td>
                <td><?php echo $row['macwifi'] ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="container">
        <button id="print-button" class="btn btn-info" type="button">IMPRIMIR</button>
        <button id="btnExportar" class="btn btn-success">
                <i class="fas fa-file-excel"></i> Exportar datos a Excel
            </button>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#tabla').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: 'EXCEL',
                        className: 'btn btn-success'
                    }
                ]
            });
            
            $('#print-button').click(function() {
                window.print();
            });
            
            $('#excel-button').click(function() {
                table.button('.buttons-excel').trigger();
            });
        });
    </script>
    <!-- script para exportar a excel -->
    <script>
        const $btnExportar = document.querySelector("#btnExportar"),
    $tabla = document.querySelector("#tabla");

$btnExportar.addEventListener("click", function() {
    let tableExport = new TableExport($tabla, {
        exportButtons: false,
        filename: "Reporte de Software",
        sheetname: "Reporte de software",
        formats: ["xlsx"],
        exportOptions: {
            format: {
                body: function (value, row, column, node) {
                    if (column === 1) {
                        let parts = value.split('/');
                        if (parts.length === 3) {
                            return parts[0].padStart(2, '0') + '/' + parts[1].padStart(2, '0') + '/' + parts[2];
                        }
                    }
                    return value;
                }
            }
        }
    });
    let datos = tableExport.getExportData();
    let preferenciasDocumento = datos.tabla.xlsx;
    tableExport.export2file(preferenciasDocumento.data, preferenciasDocumento.mimeType, preferenciasDocumento.filename, preferenciasDocumento.fileExtension, preferenciasDocumento.merges, preferenciasDocumento.RTL, preferenciasDocumento.sheetname);
});

    </script>
</body>
</html>
