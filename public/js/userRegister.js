document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('registerForm').addEventListener('submit', function(event){
        event.preventDefault();
        if(validateForm()){
            registerUserMain(); //funcion de registrar de registrar el usuario mediante ajax
        }
    });
});

function validateForm(){
        // Limpiar mensajes de error
        clearErrors();

        //captura valores de los campos del formulario y quita los espacios en blanco
        const email = document.getElementById('userMail').value.trim();
        const username = document.getElementById('userName').value.trim();
        const lastname1 = document.getElementById('userLastname1').value.trim();
        const lastname2 = document.getElementById('userLastname2').value.trim();
        const userpass = document.getElementById('userPass').value.trim();
        const confirmPass = document.getElementById('confirmPassword').value.trim();

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

        if(userpass === ''){
            document.getElementById('userPassError').textContent = 'Por favor ingrese la contraseña.';
        }

        if(confirmPass !== userpass || confirmPass === ''){
            document.getElementById('confirmPasswordError').textContent = 'Las contraseñas no coinciden.';
        }

        return isValid;
}

function clearErrors() {
    document.getElementById('userMailError').textContent = '';
    document.getElementById('userNameError').textContent = '';
    document.getElementById('userLastname1Error').textContent = '';
    document.getElementById('userLastname2Error').textContent = '';
    document.getElementById('userPassError').textContent = '';
    document.getElementById('confirmPasswordError').textContent = '';
}

function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; 
    return re.test(String(email).toLowerCase());
}

function registerUserMain() {
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
    const userpass = document.getElementById('userPass').value.trim();

    // Realiza la llamada fetch con los datos del formulario
    fetch('../src/routes/userRoutes.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            action: 'registerUser',
            userName: username,
            userPass: userpass,
            userLastname1: lastname1,
            userLastname2: lastname2,
            userMail: email
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
            }).then(() => {
                // Llamada a la función clearForm para limpiar los campos
                clearForm();
                
                // Redireccionar a la página deseada
                window.location.href = '../public/login.php'; 
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

// Función para limpiar el formulario
function clearForm() {
    document.getElementById('userMail').value = '';
    document.getElementById('userName').value = '';
    document.getElementById('userLastname1').value = '';
    document.getElementById('userLastname2').value = '';
    document.getElementById('userPass').value = '';
}
