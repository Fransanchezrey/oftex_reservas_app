document.addEventListener("DOMContentLoaded", () => {
    const tablaBody = document.querySelector("#tablaReservas tbody");
    const inputBuscar = document.getElementById("busqueda");
    const btnDescargar = document.getElementById("descargarJson");
    const btnLimpiar = document.getElementById("btnLimpiar");


 
    let reservasFiltradas = [];

    console.log("Elemento tablaBody:", tablaBody);

    function mostrarReservas(lista) {
        tablaBody.innerHTML = "";
        lista.forEach(reserva => {
            const fila = document.createElement("tr");
            for (const campo in reserva) {
                const celda = document.createElement("td");
                celda.textContent = reserva[campo];
                fila.appendChild(celda);
            }
            tablaBody.appendChild(fila);
        });
    }

    function filtrarReservas(texto) {
        const textoMin = texto.toLowerCase();
        const filtradas = RESERVAS.filter(reserva =>
            Object.values(reserva).some(campo =>
                campo.toLowerCase().includes(textoMin)
            )
        );
        mostrarReservas(filtradas);
        return filtradas;
    }

    inputBuscar.addEventListener("input", () => {
        reservasFiltradas = filtrarReservas(inputBuscar.value);
    });

    btnLimpiar.addEventListener("click", () => {
        inputBuscar.value = ""; // Limpia el campo de búsqueda
        mostrarReservas(RESERVAS); // Muestra todas las reservas
    });

    btnDescargar.addEventListener("click", () => {
        const dataAExportar = reservasFiltradas.length > 0 ? reservasFiltradas : RESERVAS;
    
        const dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(dataAExportar, null, 2));
        const enlace = document.createElement("a");
        enlace.setAttribute("href", dataStr);
        enlace.setAttribute("download", "reservas.json");
        enlace.click();
    });

    // Mostrar todas las reservas al cargar la página
    mostrarReservas(RESERVAS);
});
