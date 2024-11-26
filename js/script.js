document.addEventListener("DOMContentLoaded", () => {
    if (sessionStorage.getItem("buttonClicked") === "true") {
        document.querySelector('.session').style.animation = "none";
        document.querySelector('.left').style.animation = "none";
        document.querySelector('.log-in').style.animation = "none";
    }
});

const botonLogin = document.getElementById("log");
botonLogin.addEventListener("click", () => {
    sessionStorage.setItem("buttonClicked", "true");
});

