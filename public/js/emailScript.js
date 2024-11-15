function sendMassEmail() {
    const subject = document.getElementById('subject').value.trim();
    const message = document.getElementById('message').value.trim();
    const responseMessage = document.getElementById('responseMessage');

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

    // Solicitud AJAX
    fetch('path/to/emailRoutes.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            responseMessage.textContent = data.message;
            responseMessage.style.color = 'green';
            swal("Éxito", "Correo enviado a todos los usuarios.", "success");
        } else {
            responseMessage.textContent = data.message;
            responseMessage.style.color = 'red';
            swal("Error", data.message, "error");
        }
    })
    .catch(error => {
        console.error('Error en la solicitud:', error);
        responseMessage.textContent = 'Error en la solicitud. Inténtalo de nuevo.';
        responseMessage.style.color = 'red';
        swal("Error", "Ocurrió un problema al enviar el correo.", "error");
    });
}
