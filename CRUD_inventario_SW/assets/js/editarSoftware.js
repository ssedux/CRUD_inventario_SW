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
      const { ID,ID_equipo,ver_windows,Key_W,ver_office,Key_of,Antivirus,ip_i,otra_ip ,ip02,ip03,maclan,macwifi} =
      response.data;

      console.log(ID,ID_equipo,ver_windows,Key_W,ver_office,Key_of,Antivirus,ip_i,otra_ip ,ip02,ip03,maclan,macwifi);
      document.querySelector("#IDSoftware").value = ID;
      document.querySelector("#ID_equipo").value = ID_equipo;
      document.querySelector("#Key_W").value = Key_W; 
      document.querySelector("#Key_of").value = Key_of;
      document.querySelector("#Antivirus").value = Antivirus;
      document.querySelector("#ip_i").value = ip_i;
      document.querySelector("#otra_ip").value = otra_ip;
      document.querySelector("#ip02").value = ip02;
      document.querySelector("#ip03").value = ip03;
      document.querySelector("#maclan").value = maclan;
      document.querySelector("#macwifi").value = macwifi;
      seleccionarOffice(ID_equipo)
      seleccionarwindows(ver_windows);
      seleccionarOffice(ver_office);
    } else {
      console.log("Error al cargar el Software a editar");
    }
  } catch (error) {
    console.error(error);
    alert("Hubo un problema al cargar los detalles del Software");
  }
}

/**
 * Función para seleccionar del Software
 */
function seleccionarOffice(select_equipo) {
  const selectID_equipo = document.querySelector("#ID_equipo");
  selectID_equipo.value = select_equipo;
}
function seleccionarwindows(windowsSoftware) {
  const selectwindows = document.querySelector("#ver_windows");
  selectwindows.value = windowsSoftware;
}
function seleccionarOffice(OfficeSoftware) {
  const selectOffice = document.querySelector("#ver_office");
  selectOffice.value = OfficeSoftware;
}

// Función para validar antes de enviar
async function actualizarSoftware(event) {
  event.preventDefault(); // Evitar que la página se recargue al enviar el formulario

  const formulario = document.querySelector("#formularioSoftwareEdit");
  const formData = new FormData(formulario);

  // Validación: Revisar si algún campo requerido está vacío
  let camposVacios = false;

  formulario.querySelectorAll("input[required], select[required]").forEach(function(input) {
      if (!input.value.trim()) {
          camposVacios = true;
          input.classList.add("is-invalid"); // Resalta el campo vacío
      } else {
          input.classList.remove("is-invalid"); // Quita el resaltado si el campo no está vacío
      }
  });

  // Si hay campos vacíos, mostrar alerta y evitar el envío
  if (camposVacios) {
      toastr.options = window.toastrOptions;
      toastr.error("Por favor, complete todos los campos requeridos.");
      return; // Salir de la función y no enviar el formulario
  }

  try {
    // Enviar los datos del formulario al backend usando Axios
    const response = await axios.post("acciones/updateSoftware.php", formData);

    // Verificar la respuesta del backend
    if (response.status === 200) {
      console.log("Software actualizado exitosamente");

      // Llamar a la función para actualizar la tabla de Software
      window.actualizarSoftwareEdit(formData.get("ID"));

      // Llamar a la función para mostrar un mensaje de éxito
      toastr.options = window.toastrOptions;
      toastr.success("¡El Software se actualizó correctamente!");

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

