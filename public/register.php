<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asociación Infantil Hogar Sol</title>
    <link rel="stylesheet" href="../public/header-footer/css/headerStyle.css">
    <link rel="stylesheet" href="../public/css/register.css">
    <script src="https://kit.fontawesome.com/186b29df68.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../public/js/userRegister.js"></script>
</head>
<body>
    <div class="content">
        <div id="container">
            <div id="image1">
                <img src="../public/images/logo.png" alt="ImagenLogoRegistro1">
            </div>
            <div id="registerUser">
                <h2>Registro de Usuario</h2>
                <p>Este registro es únicamente para colaboradores del hogar, así como personas autorizadas directamente por la Asociación Infantil Hogar Sol.</p>
                <form id="registerForm">
                    <label for="userMail">Correo Electrónico</label>
                    <input type="email" name="userMail" id="userMail" required>
                    <div id="userMailError" class="error-message" style="color: red;"></div>

                    <label for="userName">Nombre</label>
                    <input type="text" name="userName" id="userName" required>
                    <div id="userNameError" class="error-message" style="color: red;"></div>

                    <label for="userLastname1">Primer Apellido</label>
                    <input type="text" name="userLastname1" id="userLastname1" required>
                    <div id="userLastname1Error" class="error-message" style="color: red;"></div>

                    <label for="userLastname2">Segundo Apellido</label>
                    <input type="text" name="userLastname2" id="userLastname2" required>
                    <div id="userLastname2Error" class="error-message" style="color: red;"></div>

                    <label for="userPass">Contraseña</label>
                    <input type="password" name="userPass" id="userPass" required>
                    <div id="userPassError" class="error-message" style="color: red;"></div>

                    <label for="confirmPassword">Confirmar Contraseña</label>
                    <input type="password" name="confirmPassword" id="confirmPassword" required>
                    <div id="confirmPasswordError" class="error-message" style="color: red;"></div>

                    <input type="hidden" name="action" value="registerUser">

                    <button type="submit">Confirmar Registro</button>
                </form>
            </div>
            <div id="image2">
                <img src="../public/images/logo.png" alt="ImagenLogoRegistro2">
            </div>
        </div>
        <a href="../public/index.php" class="btn-link">Volver</a>
    </div>
</body>
</html>
