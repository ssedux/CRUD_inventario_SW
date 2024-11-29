/**
 * Modal para confirmar la eliminación de un Software
 */
async function cargarModalConfirmacion() {
  try {
    const existingModal = document.getElementById("editarSoftwareModal");
    if (existingModal) {
      const modal = bootstrap.Modal.getInstance(existingModal);
      if (modal) {
        modal.hide();
      }
      existingModal.remove(); // Eliminar la modal existente
    }

    // Realizar una solicitud GET usando Fetch para obtener el contenido de la modal
    const response = await fetch("modales/modalDelete.php");

    if (!response.ok) {
      throw new Error("Error al cargar la modal de confirmación");
    }

    // Obtener el contenido de la modal
    const modalHTML = await response.text();

    // Crear un elemento div para almacenar el contenido de la modal
    const modalContainer = document.createElement("div");
    modalContainer.innerHTML = modalHTML;

    // Agregar la modal al documento actual
    document.body.appendChild(modalContainer);

    // Mostrar la modal
    const myModal = new bootstrap.Modal(modalContainer.querySelector(".modal"));
    myModal.show();
  } catch (error) {
    console.error(error);
  }
}

/**
 * Función para eliminar un Software desde la modal
 */
async function eliminarSoftware(idSoftware) {
  try {
    // Llamar a la función para cargar y mostrar la modal de confirmación
    await cargarModalConfirmacion();

    // Establecer el ID y la ruta del avatar del Software en el botón de confirmación
    document
      .getElementById("confirmDeleteBtn")
      .setAttribute("data-id", idSoftware);

    // Agregar un event listener al botón "Eliminar Software"
    document
      .getElementById("confirmDeleteBtn")
      .addEventListener("click", async function () {
        // Obtener el ID del Software a eliminar
        var idSoftware = this.getAttribute("data-id");

        try {
          const response = await axios.post("acciones/delete.php", {
            id: idSoftware,
          });

          if (response.status === 200) {
            // Eliminar la fila correspondiente a este Software de la tabla
            document.querySelector(`#Software_${idSoftware}`).remove();
            //Llamar a la función para mostrar un mensaje de éxito
            if (window.toastrOptions) {
              toastr.options = window.toastrOptions;
              toastr.error("¡El Software se elimino correctamente!.");
            }
          } else {
            alert(`Error al eliminar el Software con ID ${idSoftware}`);
          }
        } catch (error) {
          console.error(error);
          alert("Hubo un problema al eliminar al Software");
        } finally {
          // Cerrar la modal de confirmación
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
