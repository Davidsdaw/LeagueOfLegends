
const userIcon = document.getElementById('userIcon');
const dropdownMenu = document.getElementById('dropdownMenu');

userIcon.addEventListener('click', () => {
    dropdownMenu.classList.toggle('show-dropdown');
});

// Cerrar el menú si se hace clic fuera del mismo
document.addEventListener('click', (event) => {
    if (!userIcon.contains(event.target) && !dropdownMenu.contains(event.target)) {
        dropdownMenu.classList.remove('show-dropdown');
    }
});


document.querySelectorAll('.faq-question').forEach(button => {
    button.addEventListener('click', () => {
        const faqItem = button.parentElement;
        faqItem.classList.toggle('active');
    });
});

function mostrarSeccion(idSeccion) {
    // Oculta todas las secciones excepto el menú de tarjetas
    const secciones = document.querySelectorAll('main section');
    secciones.forEach((seccion) => {
        seccion.classList.add('hidden');
    });


    // Muestra la sección seleccionada
    const seccionSeleccionada = document.getElementById(idSeccion);
    if (seccionSeleccionada) {
        seccionSeleccionada.classList.remove('hidden');
    }
}


function mostrarSeccion(idSeccion) {
    // Oculta todas las secciones excepto el menú de tarjetas
    const secciones = document.querySelectorAll('main section');
    secciones.forEach((seccion) => {
        seccion.classList.add('hidden');
    });


    // Muestra la sección seleccionada
    const seccionSeleccionada = document.getElementById(idSeccion);
    if (seccionSeleccionada) {
        seccionSeleccionada.classList.remove('hidden');
    }
}
