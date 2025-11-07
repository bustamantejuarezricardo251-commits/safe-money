document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("formAlerta");
  const lista = document.getElementById("listaAlertas");

  if (!form || !lista) {
    console.error("Formulario o contenedor de alertas no encontrado.");
    alert("Error interno: no se pudo inicializar el módulo de alertas.");
    return;
  }

  form.addEventListener("submit", e => {
    e.preventDefault();
    const datos = new FormData(form);

    fetch("../php/guardar_alerta.php", {
      method: "POST",
      body: datos,
      credentials: "include" // 🔑 Enviar cookies de sesión
    })
    .then(res => res.json())
    .then(data => {
      if (data.estado === "ok") {
        form.reset();
        cargarAlertas();
      } else {
        console.warn("Respuesta inesperada:", data);
        alert("Error al guardar la alerta: " + (data.error || "Respuesta inválida."));
      }
    })
    .catch(err => {
      console.error("Error al guardar alerta:", err);
      alert("Hubo un problema al conectar con el servidor.");
    });
  });

  function cargarAlertas() {
    fetch("../php/listar_alertas.php", {
      credentials: "include" // 🔑 Enviar cookies de sesión
    })
    .then(res => res.json())
    .then(alertas => {
      if (!Array.isArray(alertas)) {
        throw new Error("Respuesta inválida del servidor.");
      }

      lista.innerHTML = "";
      alertas.forEach(alerta => {
        const tarjeta = document.createElement("div");
        tarjeta.className = "tarjeta-alerta";
        tarjeta.innerHTML = `
          <p><strong>${alerta.mensaje}</strong></p>
          <p>📅 ${alerta.fecha}</p>
        `;
        lista.appendChild(tarjeta);
      });
    })
    .catch(err => {
      console.error("Error al cargar alertas:", err);
      alert("No se pudieron cargar las alertas.");
    });
  }

  cargarAlertas();
});