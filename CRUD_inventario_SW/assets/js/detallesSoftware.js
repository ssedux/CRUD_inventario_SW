/**
 * Función para mostrar la modal de detalles del Software
 */
async function verDetallesSoftware(IDSoftware) {
  try {
    // Ocultar la modal si está abierta
    const existingModal = document.getElementById("detalleSoftwareModal");
    if (existingModal) {
      const modal = bootstrap.Modal.getInstance(existingModal);
      if (modal) {
        modal.hide();
      }
      existingModal.remove(); // Eliminar la modal existente
    }

    // Buscar la Modal de Detalles
    const response = await fetch("modales/modalDetalles.php");
    if (!response.ok) {
      throw new Error("Error al cargar la modal de detalles del Software");
    }
    // response.text() es un método en programación que se utiliza para obtener el contenido de texto de una respuesta HTTP
    const modalHTML = await response.text();

    // Crear un elemento div para almacenar el contenido de la modal
    const modalContainer = document.createElement("div");
    modalContainer.innerHTML = modalHTML;

    // Agregar la modal al documento actual
    document.body.appendChild(modalContainer);

    // Mostrar la modal
    const myModal = new bootstrap.Modal(
      modalContainer.querySelector("#detalleSoftwareModal")
    );
    myModal.show();

    await cargarDetalleSoftware(IDSoftware);
  } catch (error) {
    console.error(error);
  }
}

/**
 * Función para cargar y mostrar los detalles del Software en la modal
 */
async function cargarDetalleSoftware(IDSoftware) {
  try {
    const response = await axios.get(
      `acciones/detallesSoftware.php ? ID=${IDSoftware}`
    );
    if (response.status === 200) {
      console.log(response.data);
      const {ver_windows,Key_W,ver_office,Key_of,Antivirus,fecha_inicio,Ip_interna,otra_ip,ip02,ip03,maclan,macwifi,ID_equipo} =
        response.data;

      // Limpiar el contenido existente de la lista ul

      const ulDetalleSoftware = document.querySelector("#detalleSoftwareContenido ul");

      ulDetalleSoftware.innerHTML = ` 
        <li class="list-group-item"><b>ID del equipo:</b> 
          ${ID_equipo ? ID_equipo : "No disponible"}
        </li>
        <li class="list-group-item"><b>Version de Windows:</b> 
          ${ver_windows ? ver_windows : "No disponible"}
        </li>
        <li class="list-group-item"><b>Key de Windows:</b> 
          ${Key_W ? Key_W : "No disponible"}
        </li>
        <li class="list-group-item"><b>Version de Office:</b> 
          ${ver_office ? ver_office : "No disponible"}
        </li>
        <li class="list-group-item"><b>Key de Office:</b> 
          ${Key_of ? Key_of : "No disponible"}
        </li>
        <li class="list-group-item"><b>Antivirus:</b> 
          ${Antivirus ? Antivirus : "No disponible"}
        </li>
        <li class="list-group-item"><b>fecha inicio:</b> 
          ${fecha_inicio ? fecha_inicio : "No disponible"}
        </li>
        <li class="list-group-item"><b>IP interna:</b> 
          ${Ip_interna ? Ip_interna : "No disponible"}
        </li>
        <li class="list-group-item"><b>otra IP:</b> 
          ${otra_ip ? otra_ip : "No disponible"}
        </li><li class="list-group-item"><b>IP02:</b> 
          ${ip02 ? ip02 : "No disponible"}
        </li>
        <li class="list-group-item"><b>IP03:</b> 
          ${ip03 ? ip03 : "No disponible"}
        </li>
        <li class="list-group-item"><b>Maclan:</b> 
          ${maclan ? maclan : "No disponible"}
        </li>
        <li class="list-group-item"><b>Macwifi:</b> 
          ${macwifi ? macwifi : "No disponible"}
        </li>
        
      `;
    } else {
      alert(`Error al cargar los detalles del Software con ID ${IDSoftware}`);
    }
  } catch (error) {
    console.error(error);
    alert("Hubo un problema al cargar los detalles del Software");
  }
}
