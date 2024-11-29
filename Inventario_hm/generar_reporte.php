<?php
include("connection.php");
require_once('tcpdf/tcpdf.php');
    
if (isset($_GET['buscar'])) {
    $buscar = $_GET['buscar'];
    
    $query = "SELECT d.N_inventario, d.fecha, d.descripcion, i.Unidad, i.Tipo_equipo, i.Marca, i.Modelo FROM descarto AS d JOIN inventariof AS i ON d.N_inventario = i.N_inventario WHERE d.N_inventario = '$buscar'";
    $resultado = mysqli_query($conex, $query);

    if (mysqli_num_rows($resultado) > 0) {
        // Crear instancia de TCPDF
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');

        // Agregar una nueva página
        $pdf->AddPage();

        // Establecer el título del documento
        $pdf->SetTitle('Reporte de Descarto');

        // Establecer el tamaño y tipo de fuente predeterminados
        $pdf->SetFontSize(12);
        $pdf->SetFont('helvetica', 'B');

        // Obtener los datos del registro
        $registro = mysqli_fetch_assoc($resultado);

        // Generar el contenido del reporte
        $contenido = 'N° de Serie: ' . $registro['N_inventario'] . "\n";
        $contenido .= 'Fecha: ' . $registro['fecha'] . "\n";
        $contenido .= 'Descripción: ' . $registro['descripcion'] . "\n";
        $contenido .= 'Unidad: ' . $registro['Unidad'] . "\n";
        $contenido .= 'Tipo de equipo: ' . $registro['Tipo_equipo'] . "\n";
        $contenido .= 'Marca: ' . $registro['Marca'] . "\n";
        $contenido .= 'Modelo: ' . $registro['Modelo'] . "\n";

        // Agregar el contenido al documento PDF
        $pdf->Write(0, $contenido, '', 0, 'L', true, 0, false, false, 0);

        // Generar la salida del archivo PDF
        $pdf->Output('reporte.pdf', 'I');
        exit;
    }
}
?>
