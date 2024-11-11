<?php

header('Cache-Control: no-store, no-cache, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

session_start(); // Esto es necesario para acceder a $_SESSION

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['USER_ID'])) {
    // Si no ha iniciado sesión, redirigir a la página de login
    header("Location: http://localhost/hogarsolweb/PaginaTCU-HogarSol/public/index.php"); 
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
</head>
<body>
    <?php 
        include("sidebarAdmin/sidebar.html"); 
    ?>
    <div class="content">
    <div class="table-container">
        <h2>Lista de Usuarios Registrados</h2>

        <!-- Tabla original (para dispositivos grandes) -->
        <table>
            <thead>
                <tr>
                    <th>USER_ID</th>
                    <th>USERNAME</th>
                    <th>USERPASS</th>
                    <th>USERLASTNAME1</th>
                    <th>USERLASTNAME2</th>
                    <th>USERMAIL</th>
                    <th>CONFIRMATION_CODE</th>
                    <th>USER_CONFIRMATION</th>
                    <th>ROLE_ID</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>johndoe</td>
                    <td>password123</td>
                    <td>Doe</td>
                    <td>Smith</td>
                    <td>johndoe@example.com</td>
                    <td>abc123</td>
                    <td>false</td>
                    <td>2</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>janedoe</td>
                    <td>password456</td>
                    <td>Doe</td>
                    <td>Johnson</td>
                    <td>janedoe@example.com</td>
                    <td>xyz789</td>
                    <td>true</td>
                    <td>1</td>
                </tr>
                <!-- Más filas de datos... -->
            </tbody>
        </table>

        <!-- Tarjetas (para pantallas pequeñas) -->
        <div class="card">
            <h3>Usuario: johndoe</h3>
            <div><span>USER_ID:</span> 1</div>
            <div><span>USERPASS:</span> password123</div>
            <div><span>USERLASTNAME1:</span> Doe</div>
            <div><span>USERLASTNAME2:</span> Smith</div>
            <div><span>USERMAIL:</span> johndoe@example.com</div>
            <div><span>CONFIRMATION_CODE:</span> abc123</div>
            <div><span>USER_CONFIRMATION:</span> false</div>
            <div><span>ROLE_ID:</span> 2</div>
        </div>

        <div class="card">
            <h3>Usuario: janedoe</h3>
            <div><span>USER_ID:</span> 2</div>
            <div><span>USERPASS:</span> password456</div>
            <div><span>USERLASTNAME1:</span> Doe</div>
            <div><span>USERLASTNAME2:</span> Johnson</div>
            <div><span>USERMAIL:</span> janedoe@example.com</div>
            <div><span>CONFIRMATION_CODE:</span> xyz789</div>
            <div><span>USER_CONFIRMATION:</span> true</div>
            <div><span>ROLE_ID:</span> 1</div>
        </div>

        <!-- Más tarjetas de usuarios aquí... -->
    </div>
</div>
<script src="../../public/js/logOut.js"></script>
</body>
</html>