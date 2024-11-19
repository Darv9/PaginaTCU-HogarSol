<?php

header('Cache-Control: no-store, no-cache, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

session_start(); 

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['USER_ID'])) {
    // Si no ha iniciado sesión, redirigir a la página de login
    header("Location: ../../public/index.php"); 
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Administrador</title>
    <link rel="stylesheet" href="sidebarAdmin/sidebar.css">
    <link rel="stylesheet" href="css/indexAdmin.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/186b29df68.js" crossorigin="anonymous"></script>
    <script src="../../public/js/getAllNewsletterUsers.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <!-- Este div se muestra si el usuario ha iniciado sesión -->
    <div id="userGreeting" class="user-greeting">
        <?php
        if (isset($_SESSION['USERMAIL'])) {
            echo 'Ingresado como: ' . htmlspecialchars($_SESSION['USERMAIL']);
        } else {
            echo 'No se ha iniciado sesión.';
        }
        ?>
    </div>
     <!-- Para incluir la barra del menú lateral -->
    <?php 
        include("sidebarAdmin/sidebar.html"); 
    ?>
   <div class="content">
    <div class="table-container">
        <h2>Lista de Usuarios Registrados en el Boletín Informativo</h2>

        <!-- Tabla original (para dispositivos grandes) -->
        <table id="userTable">
            <thead>
                <tr>
                    <th>Correo Electrónico</th>
                    <th>Nombre</th>
                    <th>Primer Apellido</th>
                    <th>Segundo Apellido</th>
                    <th>Estado Suscripción</th>
                    <th>Editar</th>
                    <th>Desactivar</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
                <!-- Las filas de usuario se añadirán dinámicamente aquí -->
            </tbody>
        </table>

        <!-- Contenedor de Tarjetas (para responsive) -->
        <div id="userCardsContainer">
            <!-- Las tarjetas de usuario se añadirán dinámicamente aquí -->
        </div>
    </div>
</div>

<script src="../../public/js/logOut.js"></script>
</body>
</html>