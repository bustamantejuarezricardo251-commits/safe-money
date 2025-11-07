document.addEventListener("DOMContentLoaded", () => {
  fetch("../php/resumen.php")
    .then(res => res.json())
    .then(data => {
      if (!data.error) {
        document.getElementById("ingresosHoy").textContent = parseFloat(data.ingresos).toFixed(2);
        document.getElementById("gastosHoy").textContent = parseFloat(data.gastos).toFixed(2);
        document.getElementById("balanceHoy").textContent = parseFloat(data.balance).toFixed(2);
      }
    });

  // Historial y gráficas pueden ir aquí también con AJAX
});