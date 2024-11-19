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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Correo Masivo</title>
    <link rel="stylesheet" href="sidebarAdmin/sidebar.css">
    <link rel="stylesheet" href="css/sendEmail.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/186b29df68.js" crossorigin="anonymous"></script>
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
        <div class="email-container">
            <h2>Enviar Correo Masivo</h2>
            <div class="form-group">
                <label for="subject">Asunto</label>
                <input type="text" id="subject" name="subject" placeholder="Escribe el asunto del correo">
            </div>
            <div class="form-group">
                <label for="message">Mensaje</label>
                <textarea id="message" name="message" placeholder="Escribe el mensaje aquí..."></textarea>
            </div>
            <div class="form-group">
                <label for="imageUpload">Subir Imagen</label>
                <input type="file" id="imageUpload" name="imageUpload" accept="image/*" onchange="previewImage()">
                <div id="imagePreview"></div>
            </div>
            <button onclick="sendMassEmail()">Enviar</button>
            <div id="responseMessage" style="margin-top: 15px;"></div>
        </div>
    </div>
    <script src="../../public/js/massEmailScript.js"></script>
</body>
</html>