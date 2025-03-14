document.querySelector('.search-box')

document.querySelector('#search-icon').onclick = () =>{
    search.classList.toggle('active');
    navbar.classList.remove('active');

}


let navbar = document.querySelector('.navbar');

document.querySelector('#menu-icon').onclick = () => {
    navbar.classList.toggle('active');
    search.classList.remove('active');

}

window.onscroll = () => {
    navbar.classList.remove('active');
    search.classList.remove('active');

}





let header = document.querySelector('header');

window.addEventListener('scroll' , () =>{
    header.classList.toggle('shadow', window.scrollY > 0);
});
// Abrir y cerrar el modal de inicio de sesión
document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("login-modal");
    const openBtn = document.getElementById("open-login-btn");
    const closeBtn = document.querySelector(".close-btn");

    // Asegurarse de que el modal esté oculto al cargar la página
    modal.style.display = "none";

    openBtn.addEventListener("click", function () {
        modal.style.display = "flex";
    });

    closeBtn.addEventListener("click", function () {
        modal.style.display = "none";
    });

    window.addEventListener("click", function (event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });

    // Manejo del formulario de inicio de sesión
    document.getElementById("login-form").addEventListener("submit", function (event) {
        event.preventDefault();
        const username = document.getElementById("username").value;
        const password = document.getElementById("password").value;

        // Aquí puedes hacer una petición AJAX a tu backend en PHP para validar el usuario
        console.log("Usuario:", username, "Contraseña:", password);
        
        alert("Inicio de sesión exitoso (simulado)");
        modal.style.display = "none";
    });
});

document.getElementById("login-form").addEventListener("submit", function (event) {
    event.preventDefault();

    const formData = new FormData(this);

    fetch("inicioboton.php", {
        method: "POST",
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        if (data.success) {
            window.location.href = "dashboard.php"; // Redirigir a otra página si es necesario
        }
    })
    .catch(error => console.error("Error:", error));
});












