document.addEventListener("DOMContentLoaded", () => {
    if (sessionStorage.getItem("buttonClicked2") === "true") {
        document.querySelector('.session').style.animation = "none";
        document.querySelector('.left').style.animation = "none";
        document.querySelector('.log-in').style.animation = "none";
    }
});


const botonRegister = document.getElementById("reg");
botonRegister.addEventListener("click", () => {
    sessionStorage.setItem("buttonClicked2", "true");
});