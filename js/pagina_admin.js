function mostrarSeccion(seccionID) {
    // Ocultar todas las secciones
    const secciones = document.querySelectorAll('main section');
    secciones.forEach(seccion => seccion.classList.add('hidden'));

    // Mostrar la sección específica
    const seccionActiva = document.getElementById(seccionID);
    if (seccionActiva) {
        seccionActiva.classList.remove('hidden');
    }
}