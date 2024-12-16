/**
 * Función para mostrar la modal de editar el Software
 */
async function editarSoftware(IDSoftware) {
  try {
    // Ocultar la modal si está abierta
    const existingModal = document.getElementById("editarSoftwareModal");
    if (existingModal) {
      const modal = bootstrap.Modal.getInstance(existingModal);
      modal.hide(); // Cerrar la modal
      // Eliminar el modal del DOM
      existingModal.remove();
    }

    // Cargar la modal desde el servidor
    const response = await fetch("modales/modalEditar.php");
    if (!response.ok) {
      throw new Error("Error al cargar la modal de editar el Software");
    }
    const modalHTML = await response.text();

    // Crear un contenedor para la modal
    const modalContainer = document.createElement("div");
    modalContainer.innerHTML = modalHTML;
    document.body.appendChild(modalContainer); // Agregar al body

    const myModal = new bootstrap.Modal(modalContainer.querySelector("#editarSoftwareModal"));
    myModal.show(); // Mostrar la modal

    await cargarDatosSoftwareEditar(IDSoftware);
  } catch (error) {
    console.error(error);
  }
}
// Limpiar los campos al cerrar el modal
const modalElement = document.getElementById("editarSoftwareModal");
if (modalElement) {
  modalElement.addEventListener('hidden.bs.modal', function () {
    // Limpiar los campos del formulario al cerrar el modal
    document.querySelector("#formularioSoftwareEdit").reset();
    // También puedes asegurarte de que las clases de error se eliminen
    document.querySelectorAll("input, select").forEach(input => {
      input.classList.remove("is-invalid");
    });
  });
}

/**
 * Función para cargar los datos del software en la modal
 */
/**
 * Función para cargar los datos del software en la modal
 */
async function cargarDatosSoftwareEditar(IDSoftware) {
  try {
    const response = await axios.get(`acciones/detallesSoftware.php?ID=${IDSoftware}`);
    if (response.status === 200) {
      const { ID, ID_equipo, ver_windows, Key_W, ver_office, Key_of, Antivirus, ip_i, otra_ip, ip02, ip03, maclan, macwifi } = response.data;

      // Asignar los valores a los campos del formulario
      document.querySelector("#IDSoftware").value = ID;
      document.querySelector("#ID_equipo").value = ID_equipo; // Aquí asignamos el ID_equipo
      document.querySelector("#Key_W").value = Key_W;
      document.querySelector("#Key_of").value = Key_of;
      document.querySelector("#Antivirus").value = Antivirus;
      document.querySelector("#ip_i").value = ip_i;
      document.querySelector("#otra_ip").value = otra_ip;
      document.querySelector("#ip02").value = ip02;
      document.querySelector("#ip03").value = ip03;
      document.querySelector("#maclan").value = maclan;
      document.querySelector("#macwifi").value = macwifi;

      // Seleccionar el equipo y otros valores
      await cargarEquipos(ID_equipo);  // Cargar los equipos disponibles y resaltar el seleccionado
      seleccionarEquipo(ID_equipo);
      seleccionarWindows(ver_windows);
      seleccionarOfficeVersion(ver_office);
    } else {
      console.log("Error al cargar el Software a editar");
    }
  } catch (error) {
    console.error(error);
    alert("Hubo un problema al cargar los detalles del Software");
  }
}

/**
 * Función para cargar los equipos disponibles en el select
 */
async function cargarEquipos(ID_equipo) {
  const selectIDequipo = document.querySelector("#ID_equipo");
  try {
    const response = await fetch("acciones/cargarEquipos.php");  // Asume que esta ruta devuelve los equipos
    const equipos = await response.json();

    if (equipos.length > 0) {
      selectIDequipo.innerHTML = "<option value=''>Seleccione</option>";
      equipos.forEach(equipo => {
        const selected = equipo.N_inventario === ID_equipo ? "selected" : "";
        selectIDequipo.innerHTML += `<option value="${equipo.N_inventario}" ${selected}>${equipo.N_inventario}</option>`;
      });
    } else {
      selectIDequipo.innerHTML = "<option>No se encontraron equipos</option>";
    }
  } catch (error) {
    console.error("Error al cargar los equipos: ", error);
  }
}




/**
 * Función para seleccionar el ID del equipo
 */
function seleccionarEquipo(select_equipo) {
  const selectID_equipo = document.querySelector("#ID_equipo");
  selectID_equipo.value = select_equipo;
}

/**
 * Función para seleccionar la versión de Windows
 */
function seleccionarWindows(windowsSoftware) {
  const selectwindows = document.querySelector("#ver_windows");
  selectwindows.value = windowsSoftware;
}

/**
 * Función para seleccionar la versión de Office
 */
function seleccionarOfficeVersion(OfficeSoftware) {
  const selectOffice = document.querySelector("#ver_office");
  selectOffice.value = OfficeSoftware;
}

/**
 * Función para validar antes de enviar el formulario
 */
async function actualizarSoftware(event) {
  event.preventDefault(); // Evitar la recarga de la página al enviar el formulario

  const formulario = document.querySelector("#formularioSoftwareEdit");
  const formData = new FormData(formulario);

  // Validación de campos requeridos
  let camposVacios = false;

  formulario.querySelectorAll("input[required], select[required]").forEach(function(input) {
    if (!input.value.trim()) {
      camposVacios = true;
      input.classList.add("is-invalid"); // Resaltar campo vacío
    } else {
      input.classList.remove("is-invalid");
    }
  });

  if (camposVacios) {
    toastr.options = window.toastrOptions;
    toastr.error("Por favor, complete todos los campos requeridos.");
    return;
  }

  try {
    const response = await axios.post("acciones/updateSoftware.php", formData);
    if (response.status === 200) {
      toastr.success("¡El Software se actualizó correctamente!");
      setTimeout(() => {
        const modal = bootstrap.Modal.getInstance(document.getElementById("editarSoftwareModal"));
        modal.hide(); // Ocultar la modal
      }, 600);
    } else {
      console.error("Error al actualizar el Software");
    }
  } catch (error) {
    console.error("Error al enviar el formulario", error);
  }
}



