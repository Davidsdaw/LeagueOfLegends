
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
