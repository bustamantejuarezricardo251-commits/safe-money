document.addEventListener("DOMContentLoaded", () => {
  fetch("../php/graficas.php")
    .then(res => res.json())
    .then(data => {
      if (!data.error) {
        const categorias = data.map(item => item.categoria);
        const montos = data.map(item => parseFloat(item.total));

        const ctx = document.getElementById("graficoCategorias").getContext("2d");
        new Chart(ctx, {
          type: "bar",
          data: {
            labels: categorias,
            datasets: [{
              label: "Gasto por categoría",
              data: montos,
              backgroundColor: "#4CAF50"
            }]
          },
          options: {
            responsive: true,
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
      }
    });
});