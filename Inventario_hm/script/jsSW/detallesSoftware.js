/**
 * Función para mostrar la modal de detalles del Software
 */
async function eliminarSoftware(IDSoftware) {
  try {
    await cargarModalConfirmacion();

    // Establecer el ID del Software en el botón de confirmación
    document.getElementById("confirmDeleteBtn").setAttribute("data-id", IDSoftware);

    document
      .getElementById("confirmDeleteBtn")
      .addEventListener("click", async function () {
        var IDSoftware = this.getAttribute("data-id");

        try {
          const response = await axios.post("acciones/delete.php", {
            id: IDSoftware,  // Enviar como 'id'
          });

          if (response.status === 200) {
            document.querySelector(`#Software_${IDSoftware}`).remove();

            if (window.toastrOptions) {
              toastr.options = window.toastrOptions;
              toastr.error("¡El Software se eliminó correctamente!");
            }
          } else {
            alert(`Error al eliminar el Software con ID ${IDSoftware}`);
          }
        } catch (error) {
          console.error(error);
          alert("Hubo un problema al eliminar el Software");
        } finally {
          var confirmModal = bootstrap.Modal.getInstance(
            document.getElementById("confirmModal")
          );
          confirmModal.hide();
        }
      });
  } catch (error) {
    console.error(error);
    alert("Hubo un problema al cargar la modal de confirmación");
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
      const {ver_windows,Key_W,ver_office,Key_of,Antivirus,fecha_inicio,ip_i,otra_ip,ip02,ip03,maclan,macwifi,ID_equipo} =
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
          ${ip_i ? ip_i : "No disponible"}
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
