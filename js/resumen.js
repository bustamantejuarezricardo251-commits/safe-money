document.addEventListener("DOMContentLoaded", () => {
  fetch("../php/resumen.php")
    .then(res => res.json())
    .then(data => {
      if (!data.error) {
        document.getElementById("ingresosSemana").textContent = parseFloat(data.ingresos).toFixed(2);
        document.getElementById("gastosSemana").textContent = parseFloat(data.gastos).toFixed(2);
        document.getElementById("ahorroSemana").textContent = parseFloat(data.balance).toFixed(2);
      }
    });
});