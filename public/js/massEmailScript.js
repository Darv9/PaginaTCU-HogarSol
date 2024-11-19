function sendMassEmail() {
    const subject = document.getElementById('subject').value.trim();
    const message = document.getElementById('message').value.trim();
    const responseMessage = document.getElementById('responseMessage');
    const imageUpload = document.getElementById('imageUpload').files[0]; // Obtener la imagen seleccionada

    // Validación simple de los campos
    if (!subject || !message) {
        responseMessage.textContent = 'Por favor, completa todos los campos.';
        responseMessage.style.color = 'red';
        return;
    }

    // Datos a enviar en la solicitud
    const formData = new FormData();
    formData.append('action', 'sendMassEmail');
    formData.append('subject', subject);
    formData.append('message', message);
    
    // Si hay una imagen, agregarla al FormData
    if (imageUpload) {
        formData.append('imageUpload', imageUpload); 
        console.log("Imagen a enviar:", imageUpload.name);  // Verificar imagen en la consola
    } else {
        console.log("No se seleccionó imagen.");  // Mensaje si no se seleccionó una imagen
    }

    // Solicitud AJAX
    fetch('../../src/routes/massEmailRoutes.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.text())  
    .then(text => {
        console.log('Respuesta del servidor:', text);  // Ver lo que se recibe del servidor

        try {
            const data = JSON.parse(text);  
            if (data.status === 'success') {
                responseMessage.textContent = data.message;
                responseMessage.style.color = 'green';
                Swal.fire("Éxito", "Correo enviado a todos los usuarios.", "success");
            } else {
                responseMessage.textContent = data.message;
                responseMessage.style.color = 'red';
                Swal.fire("Error", data.message, "error");
            }
        } catch (e) {
            console.error('Error al parsear JSON:', e);
            responseMessage.textContent = 'Error en la respuesta del servidor. Inténtalo de nuevo.';
            responseMessage.style.color = 'red';
            Swal.fire("Error", "Ocurrió un problema con la respuesta del servidor.", "error");
        }
    })
    .catch(error => {
        console.error('Error en la solicitud:', error);
        responseMessage.textContent = 'Error en la solicitud. Inténtalo de nuevo.';
        responseMessage.style.color = 'red';
        Swal.fire("Error", "Ocurrió un problema al enviar el correo.", "error");
    });
}

function previewImage() {
    const file = document.getElementById('imageUpload').files[0];
    const previewContainer = document.getElementById('imagePreview');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            previewContainer.innerHTML = `<img src="${event.target.result}" alt="Previsualización de imagen" style="max-width: 300px; max-height: 300px;">`; 
        };
        reader.readAsDataURL(file);
    } else {
        previewContainer.innerHTML = '';
    }
}
