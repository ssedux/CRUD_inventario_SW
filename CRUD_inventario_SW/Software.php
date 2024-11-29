<div class="table-responsive">
    <table class="table table-hover" id="table_Software">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID_equipo</th>
                <th scope="col">Windows</th>
                <th scope="col">Office</th>
                <th scope="col">Antivirus</th>
                <th scope="col">fecha de inicio</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($Software as $Software) { ?>
                <tr id="Software_<?php echo $Software['ID']; ?>">
                    <th scope='row'><?php echo $Software['ID']; ?></th>
                    <td><?php echo $Software['ID_equipo']; ?></td>
                    <td><?php echo $Software['ver_windows']; ?></td>
                    <td><?php echo $Software['ver_office']; ?></td>
                    <td><?php echo $Software['Antivirus']; ?></td>
                    <td><?php echo $Software['fecha_inicio']; ?></td>
                    <td>
                        <a title="Ver detalles del Software" href="#" onclick="verDetallesSoftware(<?php echo $Software['ID']; ?>)" class="btn btn-success">
                            <i class="bi bi-binoculars"></i>
                        </a>
                        <a title="Editar datos del Software" href="#" onclick="editarSoftware(<?php echo $Software['ID']; ?>)" class="btn btn-warning">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a title="Eliminar datos del Software" href="#" onclick="eliminarSoftware(<?php echo $Software['ID']; ?>)" class="btn btn-danger">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>