const menuLinks = document.querySelectorAll('.sidebar nav a');
const contentSections = document.querySelectorAll('main section');

menuLinks.forEach(menuLink => {
    menuLink.addEventListener('click', (event) => {
        event.preventDefault();
        menuLinks.forEach(link => link.classList.remove('active'));
        contentSections.forEach(section => section.classList.add('hidden'));
        menuLink.classList.add('active');
        const targetSection = document.querySelector(menuLink.getAttribute('href'));
        targetSection.classList.remove('hidden');
    });
});
