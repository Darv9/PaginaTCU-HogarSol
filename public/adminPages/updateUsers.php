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
    <link rel="stylesheet" href="css/updateUsers.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/186b29df68.js" crossorigin="anonymous"></script>
    <script src="../../public/js/editUser.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
     <!-- Para incluir la barra del menú lateral -->
    <?php 
        include("sidebarAdmin/sidebar.html"); 
    ?>
    <div class="content">
        <div id="container">
            <div id="updateUser">
                <h2>Actualización de Usuario</h2>
                <form id="updateForm">
                    <label for="userMail">Correo Electrónico</label>
                    <input type="email" name="userMail" id="userMail">
                    <div id="userMailError" class="error-message" style="color: red;"></div>

                    <label for="userName">Nombre</label>
                    <input type="text" name="userName" id="userName">
                    <div id="userNameError" class="error-message" style="color: red;"></div>

                    <label for="userLastname1">Primer Apellido</label>
                    <input type="text" name="userLastname1" id="userLastname1">
                    <div id="userLastname1Error" class="error-message" style="color: red;"></div>

                    <label for="userLastname2">Segundo Apellido</label>
                    <input type="text" name="userLastname2" id="userLastname2">
                    <div id="userLastname2Error" class="error-message" style="color: red;"></div>

                    <label for="userPass">Contraseña</label>
                    <input type="password" name="userPass" id="userPass">
                    <div id="userPassError" class="error-message" style="color: red;"></div>
                    <p id="passwordInfo" style="font-size: 0.9em; color: gray;">
                    Si dejas este campo vacío, la contraseña actual permanecerá sin cambios.
                    </p>

                    <label for="userRole">Rol de Usuario</label>
                    <select name="userRole" id="userRole" required>
                        <option value="1">Administrador</option>
                        <option value="2">Usuario</option>
                    </select>
                    <div id="userRoleError" class="error-message" style="color: red;"></div>

                    <label for="userStatus">Estado de Usuario</label>
                    <select name="userStatus" id="userStatus" required>
                        <option value="1">Activo</option>
                        <option value="0">Desactivado</option>
                    </select>
                    <div id="userStatusError" class="error-message" style="color: red;"></div>

                    <input type="hidden" name="action" value="updateUser">

                    <button type="submit">Confirmar Actualización</button>
                </form>
            </div>
        </div>
        <a href="../adminPages/indexAdmin.php" class="btn-link">Volver</a>
    </div>
</body>
</html>