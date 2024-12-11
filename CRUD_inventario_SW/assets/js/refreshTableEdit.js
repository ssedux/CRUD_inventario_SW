window.actualizarSoftwareEdit = async function (IDSoftware) {
  try {
    const response = await axios.get(`acciones/getSoftware.php?id=${IDSoftware}`);
    if (response.status === 200) {
      const infoSoftware = response.data; // Obtener los datos del Software desde la respuesta
      console.log(infoSoftware); // Verifica que los datos están llegando correctamente

      let tr = document.querySelector(`#Software_${IDSoftware}`);
      if (tr) {
        console.log("Fila encontrada:", tr); // Verifica que la fila fue encontrada

        // Actualizar las celdas de la fila con los nuevos datos
        tr.querySelector('th').textContent = infoSoftware.ID;
        tr.querySelector('td:nth-child(2)').textContent = infoSoftware.ID_equipo;
        tr.querySelector('td:nth-child(3)').textContent = infoSoftware.ver_windows;
        tr.querySelector('td:nth-child(4)').textContent = infoSoftware.ver_office;
        tr.querySelector('td:nth-child(5)').textContent = infoSoftware.Antivirus;
        tr.querySelector('td:nth-child(6)').textContent = infoSoftware.fecha_inicio;

        // Actualizar los enlaces en la última columna
        tr.querySelector('a[title="Ver detalles del Software"]').setAttribute('onclick', `verDetallesSoftware(${infoSoftware.ID})`);
        tr.querySelector('a[title="Editar datos del Software"]').setAttribute('onclick', `editarSoftware(${infoSoftware.ID})`);
        tr.querySelector('a[title="Eliminar datos del Software"]').setAttribute('onclick', `eliminarSoftware(${infoSoftware.ID})`);
      } else {
        console.log("Fila no encontrada con ID:", IDSoftware); // Si no encuentra la fila
      }
    }
  } catch (error) {
    console.error("Error al obtener la información del Software", error);
  }
};
