document.getElementById("login-form").addEventListener("submit", function (event) {
    event.preventDefault();

    const formData = new FormData(this);

    fetch("inicioboton.php", {
        method: "POST",
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message); // Muestra el mensaje de inicio de sesión
        if (data.success) {
            window.location.href = data.redirect; // Redirige a interadmi.html
        }
    })
    .catch(error => console.error("Error:", error));
});

fetch("inicioboton.php", {
    method: "POST",
    body: formData,
})
.then(response => response.json())
.then(data => {
    console.log(data); // Agregado para depuración
    alert(data.message);
    if (data.success) {
        window.location.href = data.redirect;
    }
})
.catch(error => console.error("Error:", error));
