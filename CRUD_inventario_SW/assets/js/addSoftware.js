/**
 * Modal para agregar un nuevo Software
 */
async function modalRegistrarSoftware() {
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

    const response = await fetch("modales/modalAdd.php");

    if (!response.ok) {
      throw new Error("Error al cargar la modal");
    }

    // response.text() es un método en programación que se utiliza para obtener el contenido de texto de una respuesta HTTP
    const data = await response.text();

    // Crear un elemento div para almacenar el contenido de la modal
    const modalContainer = document.createElement("div");
    modalContainer.innerHTML = data;

    // Agregar la modal al documento actual
    document.body.appendChild(modalContainer);

    // Mostrar la modal
    const myModal = new bootstrap.Modal(
      modalContainer.querySelector("#agregarSoftwareModal")
    );
    myModal.show();
  } catch (error) {
    console.error(error);
  }
}

/**
 * Función para enviar el formulario al backend
 */
async function registrarSoftware(event) {
  try {
    event.preventDefault(); // Evitar que la página se recargue al enviar el formulario
    
    const formulario = document.querySelector("#formularioSoftware");
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

    // Si todos los campos son válidos, enviar los datos al backend
    const response = await axios.post("acciones/acciones.php", formData);

    if (response.status === 200) {
      // Llamar a la función insertSoftwareTable para insertar el nuevo registro en la tabla
      window.insertSoftwareTable();

      setTimeout(() => {
        $("#agregarSoftwareModal").css("opacity", "");
        $("#agregarSoftwareModal").modal("hide");

        // Mensaje de éxito
        toastr.options = window.toastrOptions;
        toastr.success("¡El Software se registró correctamente!");
      }, 600);
    } else {
      console.error("Error al registrar el Software");
    }
  } catch (error) {
    console.error("Error al enviar el formulario", error);
  }
}
