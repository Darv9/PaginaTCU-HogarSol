document.addEventListener('DOMContentLoaded', function () {
    populateForm();
    document.getElementById('updateForm').addEventListener('submit', function(event){
        event.preventDefault();
        if(validateForm()){
            updateUserMainNL(); // Función para actualizar el usuario mediante AJAX
        }
    });
});

function validateForm(){
    // Limpiar mensajes de error
    clearErrors();

    // Captura los valores de los campos del formulario y quita los espacios en blanco
    const email = document.getElementById('userMail').value.trim();
    const username = document.getElementById('userName').value.trim();
    const lastname1 = document.getElementById('userLastname1').value.trim();
    const lastname2 = document.getElementById('userLastname2').value.trim();

    let isValid = true;

    // Validar el correo electrónico
    if (email === '' || !validateEmail(email)) {
        document.getElementById('userMailError').textContent = 'Por favor, ingrese un correo electrónico válido.';
        isValid = false;
    }

    // Validar el nombre de usuario
    if (username === '') {
        document.getElementById('userNameError').textContent = 'Por favor, ingrese un nombre de usuario.';
        isValid = false;
    }

    // Validar el primer apellido
    if (lastname1 === '') {
        document.getElementById('userLastname1Error').textContent = 'Por favor, ingrese su primer apellido.';
        isValid = false;
    }

    // Validar el segundo apellido
    if (lastname2 === '') {
        document.getElementById('userLastname2Error').textContent = 'Por favor, ingrese su segundo apellido.';
        isValid = false;
    }

    return isValid;
}

function clearErrors() {
    document.getElementById('userMailError').textContent = '';
    document.getElementById('userNameError').textContent = '';
    document.getElementById('userLastname1Error').textContent = '';
    document.getElementById('userLastname2Error').textContent = '';
}

function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Expresión regular para validar el formato del correo electrónico
    return re.test(String(email).toLowerCase());
}

function populateForm(){
    const userId = new URLSearchParams(window.location.search).get('user_id');  // Obtiene el user_id de la URL

    // Verificar que se ha obtenido un ID de usuario
    if (!userId) {
        console.error('No se ha proporcionado el ID del usuario en la URL.');
        return;
    }

    // Enviar el ID de usuario en la solicitud
    fetch(`../../src/routes/getUserByIdNLRoutes.php?action=getUserByIdNL&userId=${userId}`)
    .then(response => response.json()) // Parsear la respuesta a JSON
    .then(data => {
        if (data.status === 'success' && data.user && Array.isArray(data.user.data) && data.user.data.length > 0) {
            // Si la respuesta es exitosa y contiene el usuario en un arreglo 'data'
            const user = data.user.data[0];  // Aquí accedemos al primer usuario del arreglo

            // Rellenar el formulario con los datos del usuario
            document.getElementById('userMail').value = user.USERMAIL || '';
            document.getElementById('userName').value = user.USERNAME || '';
            document.getElementById('userLastname1').value = user.USERLASTNAME1 || '';
            document.getElementById('userLastname2').value = user.USERLASTNAME2 || '';
            console.log(user.USER_ACTIVE)
            document.getElementById('userStatus').value = user.USER_ACTIVE ? '1' : '0';

        } else {
            // Si hubo un error (por ejemplo, no se encontró el usuario o la estructura es incorrecta)
            console.error('Error:', data.message || 'Estructura de datos incorrecta');
        }
    })
    .catch(error => {
        // Manejar cualquier error que pueda ocurrir durante la solicitud
        console.error('Error en la solicitud:', error);
    });
}


function updateUserMainNL(){
    // Mostrar el swal de carga
    Swal.fire({
        title: 'Cargando...',
        text: 'Estamos procesando su solicitud, por favor espere',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading(); // Muestra el ícono de carga
        }
    });

    // Captura los valores de los campos del formulario
    const email = document.getElementById('userMail').value.trim();
    const username = document.getElementById('userName').value.trim();
    const lastname1 = document.getElementById('userLastname1').value.trim();
    const lastname2 = document.getElementById('userLastname2').value.trim();
    const userActive = document.getElementById('userStatus').value;
    const userId = new URLSearchParams(window.location.search).get('user_id');  // Captura el ID de la URL

    // Se realiza la llamada fetch con los datos del formulario
    fetch('../../src/routes/editUserRoutesNL.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            user_id: userId,
            action: 'updateUserNL',
            userName: username,
            userLastname1: lastname1,
            userLastname2: lastname2,
            userMail: email,
            user_active: userActive,
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
                title: "Actualización exitosa!",
                text: "El usuario ha sido actualizado correctamente.",
                icon: "success"
            }).then(() => {
                // Redirige a otra página después de cerrar el swal
                window.location.href = '../../public/adminPages/newsletterCRUD.php'; 
            });
        } else {
            // Muestra el mensaje de error específico devuelto por el servidor
            Swal.fire({
                title: "Error al actualizar el usuario!",
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
