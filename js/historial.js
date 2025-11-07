document.addEventListener("DOMContentLoaded", () => {
  fetch("../php/historial.php")
    .then(res => res.json())
    .then(data => {
      if (!data.error) {
        const tabla = document.getElementById("tablaHistorial");
        data.forEach(mov => {
          const fila = document.createElement("tr");
          fila.innerHTML = `
            <td>${mov.fecha}</td>
            <td>${mov.tipo}</td>
            <td>${mov.categoria}</td>
            <td>$${parseFloat(mov.monto).toFixed(2)}</td>
          `;
          tabla.appendChild(fila);
        });
      }
    });
});