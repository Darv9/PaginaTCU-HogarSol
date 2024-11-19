<?php
// Iniciar sesión si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Eliminar todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

// Eliminar la cookie de sesión del navegador
if (isset($_COOKIE[session_name()])) {
    // Se establece una cookie con el mismo nombre que la de la sesión, con una fecha en el pasado
    setcookie(session_name(), '', time() - 3600, '/'); // Expiramos la cookie de sesión
}

// Redirigir al usuario a la página de login
header('Location: http://localhost/hogarsolweb/PaginaTCU-HogarSol/public/login.php');
exit(); 
?>
