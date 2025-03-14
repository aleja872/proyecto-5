document.addEventListener("DOMContentLoaded", () => {
    const productForm = document.getElementById("productForm");
    const inventoryTable = document.getElementById("inventoryTable");
    let editingId = null;

    productForm.addEventListener("submit", async (event) => {
        event.preventDefault();

        const formData = {
            action: editingId ? 'update' : 'create',
            id: editingId,
            name: document.getElementById("name").value,
            quantity: parseInt(document.getElementById("quantity").value),
            price: parseFloat(document.getElementById("price").value),
            category: document.getElementById("category").value,
            datetime: document.getElementById("datetime").value
        };

        try {
            console.log('Sending data:', formData); // Debug line
            const response = await fetch("productos.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(formData)
            });

            const result = await response.json();
            console.log('Server response:', result); // Debug line

            if (result.message) {
                alert(result.message);
                productForm.reset();
                editingId = null;
                document.querySelector('button[type="submit"]').textContent = "Agregar Producto";
                loadProducts();
            } else {
                alert(result.error || "Error en la operación");
            }
        } catch (error) {
            console.error("Error:", error);
            alert("Error en la operación");
        }
    });

    async function loadProducts() {
        try {
            const response = await fetch("productos.php");
            const products = await response.json();
            inventoryTable.innerHTML = "";

            products.forEach(product => {
                const row = document.createElement("tr");
                row.setAttribute('data-id', product.id);
                row.innerHTML = `
                    <td>${product.nombre}</td>
                    <td>${product.cantidad}</td>
                    <td>${product.precio}</td>
                    <td>${product.categoria}</td>
                    <td>${product.fecha_hora}</td>
                    <td>
                        <button type="button" class="edit-btn" data-id="${product.id}">Editar</button>
                        <button type="button" class="delete-btn" data-id="${product.id}">Eliminar</button>
                    </td>
                `;
                inventoryTable.appendChild(row);
            });

            // Agregar event listeners a los botones
            attachButtonListeners();
        } catch (error) {
            console.error("Error al cargar productos:", error);
        }
    }

    function attachButtonListeners() {
        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const row = this.closest('tr');
                fillFormForEdit(row, id);
            });
        });

        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                deleteProduct(id);
            });
        });
    }

    function fillFormForEdit(row, id) {
        const cells = row.getElementsByTagName('td');
        editingId = id;
        
        document.getElementById("name").value = cells[0].textContent;
        document.getElementById("quantity").value = cells[1].textContent;
        document.getElementById("price").value = cells[2].textContent;
        document.getElementById("category").value = cells[3].textContent;
        document.getElementById("datetime").value = cells[4].textContent.replace(' ', 'T');
        
        document.querySelector('button[type="submit"]').textContent = "Actualizar Producto";
    }

    async function deleteProduct(id) {
        if (!confirm('¿Está seguro de que desea eliminar este producto?')) {
            return;
        }

        try {
            console.log('Deleting product:', id); // Debug line
            const response = await fetch("productos.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    action: 'delete',
                    id: parseInt(id)
                })
            });

            const result = await response.json();
            console.log('Server response:', result); // Debug line

            if (result.message) {
                alert(result.message);
                loadProducts();
            } else {
                alert(result.error || "Error al eliminar el producto");
            }
        } catch (error) {
            console.error("Error:", error);
            alert("Error al eliminar el producto");
        }
    }

    // Cargar productos al iniciar
    // Remove the duplicate PDF download code and keep only one instance
    document.getElementById("downloadPDF").addEventListener("click", () => {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        
        // Configure text settings
        doc.setFont("helvetica");
        doc.setFontSize(16);
        
        // Add title
        doc.text("REPORTE DE INVENTARIO", 20, 20);
        
        // Add date
        doc.setFontSize(12);
        doc.text(`Fecha: ${new Date().toLocaleDateString()}`, 20, 30);
        doc.text(`Hora: ${new Date().toLocaleTimeString()}`, 20, 40);
        
        // Add inventory items
        doc.setFontSize(10);
        let yPosition = 60;
        
        document.querySelectorAll("#inventoryTable tr").forEach((row, index) => {
            const cells = row.getElementsByTagName("td");
            if (cells.length > 0) {
                const text = `Producto: ${cells[0].textContent}\n` +
                            `Cantidad: ${cells[1].textContent}\n` +
                            `Precio: $${cells[2].textContent}\n` +
                            `Categoría: ${cells[3].textContent}\n` +
                            `Fecha y Hora: ${cells[4].textContent}\n` +
                            "----------------------------------------";
                
                // Add new page if needed
                if (yPosition > 250) {
                    doc.addPage();
                    yPosition = 20;
                }
                
                doc.text(text, 20, yPosition);
                yPosition += 40;
            }
        });
        
        // Save the PDF
        doc.save(`Inventario_${new Date().toISOString().split('T')[0]}.pdf`);
    });

    // Make sure loadProducts is called when page loads
    loadProducts();
});
