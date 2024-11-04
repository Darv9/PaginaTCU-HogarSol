document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('newsletterForm').addEventListener('submit', function (event) {
        event.preventDefault(); 
        if (validateForm()) {
            registerUserForNewsletter(); 
        }
    });
});

function validateForm() {
    // Limpiar mensajes de error
    clearErrors();

    // Captura los valores de los campos del formulario y quita espacios en blanco
    const email = document.getElementById('emailNewsletter').value.trim();
    const username = document.getElementById('usernameNewsletter').value.trim();
    const lastname1 = document.getElementById('userlastname1Newsletter').value.trim();
    const lastname2 = document.getElementById('userlastname2Newsletter').value.trim();

    let isValid = true;

    // Validar el correo electrónico
    if (email === '' || !validateEmail(email)) {
        document.getElementById('emailError').textContent = 'Por favor, ingrese un correo electrónico válido.';
        isValid = false;
    }

    // Validar el nombre de usuario
    if (username === '') {
        document.getElementById('usernameError').textContent = 'Por favor, ingrese un nombre de usuario.';
        isValid = false;
    }

    // Validar el primer apellido
    if (lastname1 === '') {
        document.getElementById('lastname1Error').textContent = 'Por favor, ingrese su primer apellido.';
        isValid = false;
    }

    // Validar el segundo apellido
    if (lastname2 === '') {
        document.getElementById('lastname2Error').textContent = 'Por favor, ingrese su segundo apellido.';
        isValid = false;
    }

    return isValid;
}

function clearErrors() {
    document.getElementById('emailError').textContent = '';
    document.getElementById('usernameError').textContent = '';
    document.getElementById('lastname1Error').textContent = '';
    document.getElementById('lastname2Error').textContent = '';
}

function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Expresión regular para validar el formato del correo electrónico
    return re.test(String(email).toLowerCase());
}

function registerUserForNewsletter() {
    // Mostrar el swal de carga
    Swal.fire({
        title: 'Cargando...',
        text: 'Estamos procesando su solicitud, por favor espere.',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading(); // Muestra el ícono de carga
        }
    });

    // Captura los valores de los campos del formulario
    const email = document.getElementById('emailNewsletter').value.trim();
    const username = document.getElementById('usernameNewsletter').value.trim();
    const lastname1 = document.getElementById('userlastname1Newsletter').value.trim();
    const lastname2 = document.getElementById('userlastname2Newsletter').value.trim();

    // Realiza la llamada fetch con los datos del formulario
    fetch('../src/routes/newsletterRoutes.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            action: 'registerNewsletter',
            emailNewsletter: email,
            usernameNewsletter: username,
            userlastname1Newsletter: lastname1,
            userlastname2Newsletter: lastname2
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error en la respuesta del servidor'); // Maneja si la respuesta no es 200
        }
        return response.json(); // Esto solo se ejecutará si la respuesta fue correcta
    })
    .then(data => {
        // Cierra el swal de carga antes de mostrar el resultado
        Swal.close();

        if (data.status === 'success') {
            Swal.fire({
                title: "Registro exitoso!",
                text: "Revise su correo electrónico para confirmar!",
                icon: "success"
            });
        } else {
            // Muestra el mensaje de error específico devuelto por el servidor
            Swal.fire({
                title: "Error al registrar el usuario!",
                text: data.message || "Verifique que los datos ingresados sean válidos", // Mensaje del servidor
                icon: "error"
            });
        }
    })
    .catch(error => {
        // Cierra el swal de carga si hay un error
        Swal.close();

        console.error('Error en la solicitud:', error);
        Swal.fire({
            title: "Hubo un problema con la solicitud!",
            text: "Contacte con un administrador",
            icon: "error"
        });
    });
}
