<?php
$conex = mysqli_connect("localhost", "root", "123456", "inventario");
$query = 'SELECT * FROM inventariof';
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
            .table,
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
                
                width: 100%;
                
            }
        }
    </style>
</head>
<body>
    <?php
    $conex = mysqli_connect("localhost", "root", "123456", "inventario");
    $query = 'SELECT * FROM inventariof';
    $result = mysqli_query($conex, $query);
    ?>

    <table id="tabla" class="table table-striped">
        <thead>
            <tr>
                <th>N° Inventario</th>
                <th>Fecha</th>
                <th>Unidad</th>
                <th>Equipo Tipo</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Serie</th>
                <th>Caracteristicas</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['N_inventario'] ?></td>
                <td><?php echo $row['fecha'] ?></td>
                <td><?php echo $row['Unidad'] ?></td>
                <td><?php echo $row['Tipo_equipo'] ?></td>
                <td><?php echo $row['Marca'] ?></td>
                <td><?php echo $row['Modelo'] ?></td>
                <td><?php echo $row['Serie'] ?></td>
                <td><?php echo $row['caracteristicas'] ?></td>
                <td><?php echo $row['estado'] ?></td>
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
        filename: "Reporte de Fisicio",
        sheetname: "Reporte de fisico",
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
