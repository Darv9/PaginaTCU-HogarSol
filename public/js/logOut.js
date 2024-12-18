document.addEventListener('DOMContentLoaded', function () {
    const logoutButton = document.getElementById('logoutButton');

    // Solo agregar el evento si el botón existe en la página
    if (logoutButton) {
        logoutButton.addEventListener('click', function(event) {
            event.preventDefault();  // Evitar que el enlace realice la acción predeterminada

            // Mostrar un swal de confirmación
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
                    fetch('../../src/routes/logout.php', {
                        method: 'GET',  
                    })
                    .then(response => {
                        if (response.ok) {
                            window.location.href = '../../public/index.php'; 
                        } else {
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
