document.getElementById("facturaForm").addEventListener("submit", function(event) {
    event.preventDefault();
    
    let formData = new FormData(this);
    
    fetch("regisfactu.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById("mensaje").innerText = data;
        document.getElementById("facturaForm").reset();
    })
    .catch(error => {
        console.error("Error:", error);
    });
});