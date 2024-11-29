/**
 * Función para mostrar la modal de detalles del Software
 */
async function verDetallesSoftware(idSoftware) {
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

    await cargarDetalleSoftware(idSoftware);
  } catch (error) {
    console.error(error);
  }
}

/**
 * Función para cargar y mostrar los detalles del Software en la modal
 */
async function cargarDetalleSoftware(idSoftware) {
  try {
    const response = await axios.get(
      `acciones/detallesSoftware.php ? ID=${idSoftware}`
    );
    if (response.status === 200) {
      console.log(response.data);
      const {windows,Key_W,ver_office,Key_of,Antivirus,fecha_inicio,Ip_interna,otra_ip,ip02,ip03,maclan,macwifi,ID_equipo} =
        response.data;

      // Limpiar el contenido existente de la lista ul

      const ulDetalleSoftware = document.querySelector("#detalleSoftwareContenido ul");

      ulDetalleSoftware.innerHTML = ` 
        <li class="list-group-item"><b>Version de Windows:</b> 
          ${Key_W ? Key_W : "No disponible"}
        </li>
      `;
    } else {
      alert(`Error al cargar los detalles del Software con ID ${idSoftware}`);
    }
  } catch (error) {
    console.error(error);
    alert("Hubo un problema al cargar los detalles del Software");
  }
}
