// Define la función globalmente adjuntándola al objeto window
window.insertSoftwareTable = async function () {
  try {
    const response = await axios.get(`acciones/getUltimoSoftware.php`);
    if (response.status === 200) {
      const infoSoftware = response.data; // Obtener los datos del Software desde la respuesta
      let tableBody = document.querySelector("#table_Software tbody");

      let tr = document.createElement("tr");
      tr.ID = `Software_${infoSoftware.ID}`;
      tr.innerHTML = `
        <th class="dt-type-numeric sorting_1" scope="row">${infoSoftware.ID}</th>
        <td>${infoSoftware.ID_equipo}</td>
        <td>${infoSoftware.ver_windows}</td>
        <td>${infoSoftware.ver_office}</td>
        <td>${infoSoftware.Antivirus}</td>
        <td>${infoSoftware.fecha_inicio}</td>
        
        <td>
          <a title="Ver detalles del Software" href="#" onclick="verDetallesSoftware(${infoSoftware.ID})" class="btn btn-success">
          <i class="bi bi-binoculars"></i></a>
          <a title="Editar datos del Software" href="#" onclick="editarSoftware(${
            infoSoftware.ID
          })" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
          <a title="Eliminar datos del Software" href="#" onclick="eliminarSoftware(${
            infoSoftware.ID
          })" class="btn btn-danger"><i class="bi bi-trash"></i></a>
        </td>
      `;

      // Insertar el nuevo elemento al final de la tabla
      tableBody.appendChild(tr);
    }
  } catch (error) {
    console.error("Error al obtener la información del Software", error);
  }
};
