document.addEventListener("DOMContentLoaded", () => {
  const contenedor = document.getElementById("listaMetas");
  const formMeta = document.getElementById("formMeta");

  formMeta.addEventListener("submit", e => {
    e.preventDefault();
    const datos = new FormData(formMeta);
    fetch("../php/guardar_meta.php", {
      method: "POST",
      body: datos,
      credentials: "include"
    })
    .then(res => res.json())
    .then(data => {
      if (data.estado === "ok") {
        formMeta.reset();
        cargarMetas();
      } else {
        alert("Error al guardar meta: " + (data.error || "Error desconocido"));
      }
    })
    .catch(err => {
      console.error("Error al guardar meta:", err);
      alert("No se pudo guardar la meta.");
    });
  });

  function cargarMetas() {
    fetch("../php/listar_metas.php", { credentials: "include" })
      .then(res => res.json())
      .then(metas => {
        contenedor.innerHTML = "";
        metas.forEach(meta => {
          const porcentaje = Math.min(100, Math.round((meta.cantidad_acumulada / meta.cantidad) * 100));
          const tarjeta = document.createElement("div");
          tarjeta.className = "tarjeta-meta";
          tarjeta.innerHTML = `
            <h3>${meta.nombre_meta} (${meta.categoria})</h3>
            <p>${meta.descripcion_meta}</p>
            <p>Objetivo: $${meta.cantidad}</p>
            <p>Acumulado: $${meta.cantidad_acumulada}</p>
            <div class="barra-progreso">
              <div class="relleno" style="width:${porcentaje}%"></div>
            </div>
            <form class="formAhorro" data-id="${meta.id}">
              <input type="number" name="monto" placeholder="Agregar ahorro" required min="1">
              <button type="submit">Sumar</button>
            </form>
          `;
          contenedor.appendChild(tarjeta);
        });

        document.querySelectorAll(".formAhorro").forEach(form => {
          form.addEventListener("submit", e => {
            e.preventDefault();
            const datos = new FormData(form);
            datos.append("meta_id", form.dataset.id);
            fetch("../php/agregar_meta_ahorro.php", {
              method: "POST",
              body: datos,
              credentials: "include"
            })
            .then(res => res.json())
            .then(data => {
              if (data.estado === "ok") {
                cargarMetas();
              } else {
                alert("Error al agregar ahorro: " + (data.error || "Error desconocido"));
              }
            });
          });
        });
      })
      .catch(err => {
        console.error("Error al cargar metas:", err);
        alert("No se pudieron cargar las metas.");
      });
  }

  cargarMetas();
});