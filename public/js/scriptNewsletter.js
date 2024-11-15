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

// Función para inicializar el modal y la lógica de desactivación
function initializeDeactivateUserModal() {
    // Mostrar el modal al hacer clic en el botón de apertura
    document.getElementById('openModalBtn').addEventListener('click', function() {
        document.getElementById('modal').style.display = 'block';
    });

    // Cerrar el modal al hacer clic en la "X"
    document.querySelector('.close').addEventListener('click', function() {
        document.getElementById('modal').style.display = 'none';
    });

    // Lógica para la llamada AJAX al hacer clic en el botón de desactivación dentro del modal
    document.getElementById('confirmDeactivateBtn').addEventListener('click', function() {
        const userMail = document.getElementById('userMailInput').value;

        // Validar que el correo no esté vacío
        if (!userMail) {
            Swal.fire({
                icon: 'warning',
                title: 'Advertencia',
                text: 'Por favor, ingrese un correo electrónico válido.',
            });
            return;
        }

        // Mostrar swal de "cargando"
        Swal.fire({
            title: 'Desactivando...',
            text: 'Por favor, espere un momento.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Realizar la llamada AJAX
        fetch('../src/routes/deactivateUserNLRoutes.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                action: 'deactivateUserNL',
                userMail: userMail
            })
        })
        .then(response => response.json())
        .then(data => {
            Swal.close(); // Cerrar el swal de "cargando"
            
            if (data.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: 'Usuario desactivado exitosamente de la newsletter',
                });
                document.getElementById('modal').style.display = 'none'; // Cerrar el modal en caso de éxito
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message,
                });
            }
        })
        .catch(error => {
            console.error('Error en la solicitud AJAX:', error);
            Swal.close(); // Cerrar el swal de "cargando"
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un error al intentar desactivar al usuario.',
            });
        });
    });
}


