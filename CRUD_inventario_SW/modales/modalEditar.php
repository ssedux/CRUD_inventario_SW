    <div class="modal fade" id="editarSoftwareModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                <option selected value="">Seleccione</option>
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
                            
                                // Suponiendo que tienes una variable con el valor ID_equipo actual (puede ser un valor de una sesión, un parámetro GET, etc.)
                                $selectedID = isset($selectedID) ? $selectedID : ""; // Puedes establecer esta variable a partir de un valor PHP o GET.
                            
                                // Consulta SQL para obtener los N_inventario que no tienen un ID_equipo asociado
                                $sql = "
                                    SELECT N_inventario 
                                    FROM inventariof
                                    WHERE N_inventario NOT IN (SELECT ID_equipo FROM inventario_sw WHERE ID_equipo IS NOT NULL)
                                ";
                            
                                $result = $conn->query($sql);
                            
                                // Si hay resultados, mostrarlos en el combo box
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        $isSelected = ($row["N_inventario"] == $selectedID) ? "selected" : "";
                                        echo "<option value='" . $row["N_inventario"] . "' " . $isSelected . ">" . $row["N_inventario"] . "</option>";
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
                            <label class="form-label">version Windows</label>
                            <select name="windows" ID="ver_windows" class="form-select" required>
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
                                foreach ($windowsLista as $ver_windows) {
                                    echo "<option value='$ver_windows'>$ver_windows</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Key de Windows</label>
                            <input type="text" name="Key_W" ID="Key_W" class="form-control" required/>
                        </div>
                        </div>
                        <!-- OFFICE -->
                        <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">version de Office </label>
                            <select name="ver_office" ID="ver_office" class="form-select" required>
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
                                foreach ($OfficeLista as $ver_office) {
                                    echo "<option value='$ver_office'>$ver_office</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Key de Office</label>
                            <input type="text" name="Key_of" ID="Key_of" class="form-control" />
                        </div>
                        </div>
                        <!-- Antivirus -->
                        <div class="mb-3">
                            <label class="form-label">Antivirus</label>
                            <input type="text" name="Antivirus" ID="Antivirus" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha de Inicio</label>
                            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
                            
                        </div>
                        <!-- ip_i -->
                        <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Ip interna </label>
                            <input type="text" name="ip_i" ID="ip_i" class="form-control" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">otra ip </label>
                            <input type="text" name="otra_ip" ID="otra_ip" class="form-control"/>
                        </div>
                        </div>
                        <!-- ip02 y 03 -->
                        <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">ip02</label>
                            <input type="text" name="ip02" ID="ip02" class="form-control" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">ip03</label>
                            <input type="text" name="ip03" ID="ip03" class="form-control" />
                        </div>
                        </div>
                        <!-- Maclan y MacWifi -->
                        <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Maclan</label>
                            <input type="text" name="maclan" ID="maclan" class="form-control" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">MacWifi</label>
                            <input type="text" name="macwifi" ID="macwifi" class="form-control" />
                        </div>

                        <div class="d-grid gap-2 mt-3">
                            <button type="submit" class="btn btn-primary btn_add" onclick="actualizarSoftware(event)">
                               Actualizar datos del Software
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
