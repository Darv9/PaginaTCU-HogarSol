document.addEventListener('DOMContentLoaded', function () {
    const logoutEmergencyButton = document.getElementById('logoutEmergencyButton');

    // Solo agregar el evento si el botón existe en la página
    if (logoutEmergencyButton) {
        logoutEmergencyButton.addEventListener('click', function(event) {
            event.preventDefault();  // Evitar que el enlace realice la acción predeterminada

            // Mostrar un SweetAlert de confirmación
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Estás a punto de cerrar sesión.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, cerrar sesión',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirma, hacer la solicitud de cierre de sesión
                    fetch('../src/routes/logout.php', {
                        method: 'GET',  // O puedes usar 'POST' dependiendo de cómo manejes la solicitud
                    })
                    .then(response => {
                        if (response.ok) {
                            // Si la respuesta es exitosa (código 200), redirigir a la página de login
                            window.location.href = '../public/index.php'; // Cambia 'login.php' por la página a la que desees redirigir
                        } else {
                            // Si la respuesta no es exitosa
                            Swal.fire('Error', 'Error al cerrar sesión', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error al realizar la solicitud:', error);
                        Swal.fire('Error', 'Hubo un problema con el cierre de sesión', 'error');
                    });
                }
            });
        });
    }
});
