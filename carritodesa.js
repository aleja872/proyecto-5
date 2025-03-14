// Add at the start of your existing JavaScript file
document.addEventListener('DOMContentLoaded', function() {
    // Fetch quantities from database
    fetch('obtener_cantidades.php')
        .then(response => response.json())
        .then(cantidades => {
            // Update existing product displays with quantities
            document.querySelectorAll('.producto').forEach(producto => {
                const nombreProducto = producto.querySelector('h3').textContent;
                const cantidad = cantidades[nombreProducto] || 0;
                
                // Add quantity display
                const precioElement = producto.querySelector('.precio');
                const cantidadElement = document.createElement('p');
                cantidadElement.className = 'cantidad';
                cantidadElement.textContent = `Disponible: ${cantidad}`;
                precioElement.after(cantidadElement);
                
                // Update button state based on availability
                const button = producto.querySelector('.agregar-carrito');
                if (cantidad <= 0) {
                    button.disabled = true;
                    button.textContent = 'No disponible';
                }
            });
        })
        .catch(error => console.error('Error:', error));
});

document.addEventListener('DOMContentLoaded', function() {
    const botonesAgregar = document.querySelectorAll('.agregar-carrito');
    const listaCarrito = document.getElementById('lista-carrito');
    const totalCarrito = document.getElementById('total-carrito');
    const vaciarCarritoBtn = document.getElementById('vaciar-carrito');
    const realizarPedidoBtn = document.getElementById('realizar-pedido');
    const btnVaciarCarrito = document.getElementById('vaciar-carrito');
    const btnRealizarPedido = document.getElementById('realizar-pedido');
    const formularioPedido = document.getElementById('formulario-pedido');
    const btnCerrarFormulario = document.getElementById('cerrar-formulario');
    const formPedido = document.getElementById('form-pedido');
    let carrito = [];

    // Verificar disponibilidad inicial
    fetch('obtener_cantidades.php')
        .then(response => response.json())
        .then(cantidades => {
            document.querySelectorAll('.producto').forEach(producto => {
                const nombreProducto = producto.querySelector('h3').textContent;
                const cantidad = cantidades[nombreProducto] || 0;
                const button = producto.querySelector('.agregar-carrito');
                
                if (button && cantidad <= 0) {
                    button.disabled = true;
                    button.textContent = 'No disponible';
                }
            });
        })
        .catch(error => console.error('Error:', error));

    botonesAgregar.forEach(boton => {
        boton.addEventListener('click', function() {
            const nombre = this.dataset.nombre;
            const precio = parseFloat(this.dataset.precio);
            const cantidadDisponible = parseInt(this.dataset.cantidad);

            if (cantidadDisponible > 0) {
                agregarAlCarrito(nombre, precio);
                mostrarMensaje('Producto agregado al carrito');
            }
        });
    });

    function actualizarCarrito() {
        listaCarrito.innerHTML = "";
        let total = 0;

        carrito.forEach((producto, index) => {
            const li = document.createElement("li");
            li.innerHTML = `
                ${producto.nombre} - ${producto.cantidad} x $${producto.precio}
                <button class="eliminar" data-index="${index}">❌</button>
            `;
            listaCarrito.appendChild(li);
            total += producto.cantidad * producto.precio;
        });

        totalCarrito.textContent = `Total: $${total}`;
        localStorage.setItem("carrito", JSON.stringify(carrito));
    }

    document.querySelectorAll(".agregar-carrito").forEach(boton => {
        boton.addEventListener("click", (e) => {
            const nombre = e.target.getAttribute("data-nombre");
            const precio = parseInt(e.target.getAttribute("data-precio"));
            const index = carrito.findIndex(item => item.nombre === nombre);
            if (index !== -1) {
                carrito[index].cantidad++;
            } else {
                carrito.push({ nombre, precio, cantidad: 1 });
            }
            actualizarCarrito();
            alert(`${nombre} agregado al carrito 🛒`);
        });
    });

    listaCarrito.addEventListener("click", (e) => {
        if (e.target.classList.contains("eliminar")) {
            const index = e.target.getAttribute("data-index");
            carrito.splice(index, 1);
            actualizarCarrito();
        }
    });

    btnVaciarCarrito.addEventListener("click", () => {
        carrito = [];
        actualizarCarrito();
    });

    btnRealizarPedido.addEventListener("click", () => {
        formularioPedido.classList.add("visible");
    });

    btnCerrarFormulario.addEventListener("click", () => {
        formularioPedido.classList.remove("visible");
    });

    formPedido.addEventListener("submit", (e) => {
        e.preventDefault();
        const nombre = document.getElementById("nombre").value;
        const direccion = document.getElementById("direccion").value;
        const telefono = document.getElementById("telefono").value;
        const total = document.getElementById("total").value;
        const fecha = document.getElementById("fecha").value;

        let mensaje = `Hola, quiero realizar un pedido.\n\n`;
        mensaje += `Nombre: ${nombre}\n`;
        mensaje += `Dirección: ${direccion}\n`;
        mensaje += `Teléfono: ${telefono}\n`;
        mensaje += `Fecha: ${fecha}\n`;
        mensaje += `Total: $${total}\n\n`;
        mensaje += `🛒 Productos:\n`;
        carrito.forEach(producto => {
            mensaje += `${producto.cantidad}x ${producto.nombre} - $${producto.precio * producto.cantidad}\n`;
        });

        const numeroWhatsapp = "573222797810"; // Reemplaza con tu número de WhatsApp
        const url = `https://wa.me/${numeroWhatsapp}?text=${encodeURIComponent(mensaje)}`;
        window.location.href = url;
    }); 

    actualizarCarrito();
});



