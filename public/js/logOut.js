// Obtener el botón de cierre de sesión
document.getElementById('logoutButton').addEventListener('click', function(event) {
    event.preventDefault();  // Evitar que el enlace realice la acción predeterminada

    // Hacer una solicitud al archivo logout.php
    fetch('../../src/routes/logout.php', {
        method: 'GET',  // O puedes usar 'POST' dependiendo de cómo manejes la solicitud
    })
    .then(response => {
        if (response.ok) {
            // Si la respuesta es exitosa (código 200), redirigir a la página de login
            window.location.href = '../../public/login.php'; // Cambia 'login.php' por la página a la que desees redirigir
        } else {
            // Si la respuesta no es exitosa
            alert('Error al cerrar sesión');
        }
    })
    .catch(error => {
        console.error('Error al realizar la solicitud:', error);
        alert('Hubo un problema con el cierre de sesión');
    });
});
