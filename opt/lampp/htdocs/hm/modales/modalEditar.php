<div class="modal fade" id="editarSoftwareModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 titulo_modal">Actualizar Información Software</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formularioSoftwareEdit" action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" name="ID" id="IDSoftware" />
                    <!-- ID_equipo -->
                    <div class="mb-3">
                    <label class="form-label">ID Equipo</label>
                    <select name="ID_equipo" id="ID_equipo" class="form-select" required>
                    <option value="">Seleccione</option>
                        <?php
                            // Conectar a la base de datos
                            $servername = "localhost";
                            $username = "root"; 
                            $password = "";
                            $dbname = "inventario";

                            // Crear conexión
                            $conn = new mysqli($servername, $username, $password, $dbname);

                            // Verificar la conexión
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                        
                            // Consulta SQL para obtener los N_inventario que no tienen un ID_equipo asignado
                            $sql = "
                                SELECT N_inventario 
                                FROM inventariof 
                                WHERE N_inventario NOT IN (
                                    SELECT ID_equipo 
                                    FROM inventario_sw 
                                    WHERE ID_equipo IS NOT NULL
                                )
                            ";
                        
                            // Ejecutar la consulta
                            $result = $conn->query($sql);
                        
                            
                            // Si hay resultados, mostrarlos en el combo box
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    // Verificar si el N_inventario es el del software editado
                                    $selected = ($row["N_inventario"] == $ID_equipo_software) ? "selected" : "";
                                    echo "<option value='" . $row["N_inventario"] . "' $selected>" . $row["N_inventario"] . "</option>";
                                }
                            } else {
                                echo "<option>No se encontraron registros</option>";
                            }
                        
                            // Cerrar la conexión
                            $conn->close();
                        ?>
                        
                    </select>



                    </div>   

                    <!-- Windows -->
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Versión Windows</label>
                            <select name="windows" id="ver_windows" class="form-select" required>
                                <option selected value="">Seleccione</option>
                                <?php
                                $windowsLista = array(
                                    "Windows 11",
                                    "Windows 10 X",
                                    "Windows 10 S",
                                    "Windows 8",
                                    "Windows 7",
                                    "Windows XP"
                                );
                                foreach ($windowsLista as $windows) {
                                    echo "<option value='$windows'>$windows</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Key de Windows</label>
                            <input type="text" name="Key_W" id="Key_W" class="form-control" required />
                        </div>
                    </div>

                    <!-- Office -->
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Versión de Office</label>
                            <select name="ver_office" id="ver_office" class="form-select" required>
                                <option selected value="">Seleccione</option>
                                <?php
                                $OfficeLista = array(
                                    "2021",
                                    "2019",
                                    "2016",
                                    "2013",
                                    "2010",
                                    "2007",
                                    "2003",
                                    "XP",
                                    "2000",
                                    "97",
                                    "95"
                                );
                                foreach ($OfficeLista as $Office) {
                                    echo "<option value='$Office'>$Office</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Key de Office</label>
                            <input type="text" name="Key_of" id="Key_of" class="form-control"   required/>
                        </div>
                    </div>

                    <!-- Antivirus -->
                    <div class="mb-3">
                        <label class="form-label">Antivirus</label>
                        <input type="text" name="Antivirus" id="Antivirus" class="form-control" required/>
                    </div>

                    <!-- Fecha de Inicio -->
                    <?php
                        // Obtener la fecha actual en formato YYYY-MM-DD
                        $fechaHoy = date('Y-m-d');
                        ?>
                        <div class="mb-3">
                            <label class="form-label">Fecha de Inicio</label>
                            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control"  value="<?php echo $fechaHoy; ?>"required>
                        </div>
                    <!-- Ip's -->
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Ip interna</label>
                            <input type="text" name="ip_i" id="ip_i" class="form-control" required/>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Otra Ip</label>
                            <input type="text" name="otra_ip" id="otra_ip" class="form-control" required/>
                        </div>
                    </div>

                    <!-- ip02 y 03 -->
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">ip02</label>
                            <input type="text" name="ip02" id="ip02" class="form-control" required/>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">ip03</label>
                            <input type="text" name="ip03" id="ip03" class="form-control" required/>
                        </div>
                    </div>

                    <!-- Maclan y MacWifi -->
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Maclan</label>
                            <input type="text" name="maclan" id="maclan" class="form-control" required/>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">MacWifi</label>
                            <input type="text" name="macwifi" id="macwifi" class="form-control" required/>
                        </div>
                    </div>

                    <!-- Botón de actualización -->
                    <div class="d-grid gap-2 mt-3">
                        <button type="submit" class="btn btn-primary btn_add" onclick="actualizarSoftware(event)">Actualizar datos del Software</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
