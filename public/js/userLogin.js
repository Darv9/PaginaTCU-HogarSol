document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('loginForm').addEventListener('submit', function(event){
        event.preventDefault();
        if(validateForm()){
            loginUserMain(); //funcion de registrar de registrar el usuario mediante ajax
        }
    });
});

function validateForm(){
    // Limpiar mensajes de error
    clearErrors();

    //captura valores de los campos del formulario y quita los espacios en blanco
    const email = document.getElementById('userMail').value.trim();
    const userpass = document.getElementById('userPass').value.trim();

    let isValid = true;

    // Validar el correo electrónico
    if (email === '' || !validateEmail(email)) {
        document.getElementById('userMailError').textContent = 'Por favor, ingrese un correo electrónico válido.';
        isValid = false;
    }

    //Validar Contrasena
    if(userpass === ''){
        document.getElementById('userPassError').textContent = 'Por favor ingrese la contraseña.';
    }

    return isValid;
}

function clearErrors() {
    document.getElementById('userMailError').textContent = '';
    document.getElementById('userPassError').textContent = '';
}


function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Expresión regular para validar el formato del correo electrónico
    return re.test(String(email).toLowerCase());
}

function loginUserMain(){
    //Mostrar el swal de carga
    Swal.fire({
        title: 'Cargando...',
        text: 'Estamos procesando su solicitud, por favor espere',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading(); // Muestra el ícono de carga
        }
    });

    //Captura los valores de los campos del formulario
    const email = document.getElementById('userMail').value.trim();
    const userpass = document.getElementById('userPass').value.trim();

    //Se realiza la llamada fetch con los datos del formulario
    fetch('../src/routes/loginRoutes.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            action: 'loginUser',
            userPass: userpass,
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
                title: "Inicio Sesión exitoso!",
                text: "Bienvenido al Sistema",
                icon: "success"
            }).then(() => {
                // Redirige a la página de inicio
                window.location.href = 'http://localhost/hogarsolweb/PaginaTCU-HogarSol/public/adminPages/indexAdmin.php';  
            });
        } else {
            // Muestra el mensaje de error específico devuelto por el servidor
            Swal.fire({
                title: "Error al iniciar sesión!",
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