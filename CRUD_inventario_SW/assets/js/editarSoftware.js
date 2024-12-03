/**
 * Función para mostrar la modal de editar el Software
 */
async function editarSoftware(IDSoftware) {
  try {
    // Ocultar la modal si está abierta
    const existingModal = document.getElementById("editarSoftwareModal");
    if (existingModal) {
      const modal = bootstrap.Modal.getInstance(existingModal);
      if (modal) {
        modal.hide();
      }
      existingModal.remove(); // Eliminar la modal existente
    }

    const response = await fetch("modales/modalEditar.php");
    if (!response.ok) {
      throw new Error("Error al cargar la modal de editar el Software");
    }
    const modalHTML = await response.text();

    // Crear un elemento div para almacenar el contenido de la modal
    const modalContainer = document.createElement("div");
    modalContainer.innerHTML = modalHTML;

    // Agregar la modal al documento actual
    document.body.appendChild(modalContainer);

    // Mostrar la modal
    const myModal = new bootstrap.Modal(
      modalContainer.querySelector("#editarSoftwareModal")
    );
    myModal.show();

    await cargarDatosSoftwareEditar(IDSoftware);
  } catch (error) {
    console.error(error);
  }
}

/**
 * Función buscar información del Software seleccionado y cargarla en la modal
 */
async function cargarDatosSoftwareEditar(IDSoftware) {
  try {
    const response = await axios.get(
      `acciones/detallesSoftware.php ? ID=${IDSoftware}`
    );
    if (response.status === 200) {
      const { ID,ID_equipo,ver_windows,Key_W,ver_office,Key_of,Antivirus,Ip_interna,otra_ip ,ip02,ip03,maclan,macwifi} =
      response.data;

      console.log(ID,ID_equipo,ver_windows,Key_W,ver_office,Key_of,Antivirus,Ip_interna,otra_ip ,ip02,ip03,maclan,macwifi);
      document.querySelector("#IDSoftware").value = ID;
      document.querySelector("#ID_equipo").value = ID_equipo;
      document.querySelector("#Key_W").value = Key_W; 
      document.querySelector("#Key_of").value = Key_of;
      document.querySelector("#Antivirus").value = Antivirus;
      document.querySelector("#Ip_interna").value = Ip_interna;
      document.querySelector("#otra_ip").value = otra_ip;
      document.querySelector("#ip02").value = ip02;
      document.querySelector("#ip03").value = ip03;
      document.querySelector("#maclan").value = maclan;
      document.querySelector("#macwifi").value = macwifi;
      seleccionarwindows(windowsSoftware);
      seleccionarOffice(OfficeSoftware);
    } else {
      console.log("Error al cargar el Software a editar");
    }
  } catch (error) {
    console.error(error);
    alert("Hubo un problema al cargar los detalles del Software");
  }
}

/**
 * Función para seleccionar windows del Software
 */
function seleccionarwindows(windowsSoftware) {
  const selectwindows = document.querySelector("#ver_windows");
  selectwindows.value = windowsSoftware;
}
function seleccionarOffice(OfficeSoftware) {
  const selectOffice = document.querySelector("#ver_office");
  selectOffice.value = OfficeSoftware;
}

async function actualizarSoftware(event) {
  try {
    event.preventDefault();

    const formulario = document.querySelector("#formularioSoftwareEdit");
    // Crear un objeto FormData para enviar los datos del formulario
    const formData = new FormData(formulario);
    const IDSoftware = formData.get("ID");

    // Enviar los datos del formulario al backend usando Axios
    const response = await axios.post("acciones/updateSoftware.php", formData);

    // Verificar la respuesta del backend
    if (response.status === 200) {
      console.log("Software actualizado exitosamente");

      // Llamar a la función para actualizar la tabla de Software
      window.actualizarSoftwareEdit(IDSoftware);

      //Llamar a la función para mostrar un mensaje de éxito
      if (window.toastrOptions) {
        toastr.options = window.toastrOptions;
        toastr.success("¡El Software se actualizo correctamente!.");
      }

      setTimeout(() => {
        $("#editarSoftwareModal").css("opacity", "");
        $("#editarSoftwareModal").modal("hide");
      }, 600);
    } else {
      console.error("Error al actualizar el Software");
    }
  } catch (error) {
    console.error("Error al enviar el formulario", error);
  }
}
