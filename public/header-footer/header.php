<?php
session_start(); 
?>

<header>
    <div class="logo">
        <a href="../public/index.php"><img src="../public/images/logo.png" alt="Logo"></a>
    </div>
    <div class="description">
        <h1>Asociación Infantil Hogar Sol</h1>
        <h2>Hogar Transitorio</h2>
        <h4>San José, Costa Rica</h4>
    </div>
    <div class="login-dropdown">
        <button>Ingresar al Sistema</button>
        <div class="content-login-dropdown">
            <a href="../public/login.php">Iniciar Sesión</a>
            <a href="../public/register.php">Registrarse</a>
            <?php if (isset($_SESSION['USER_ID'])): ?>
                <a id="logoutEmergencyButton">Cerrar Sesión</a>
            <?php endif; ?>
        </div>
    </div>
</header>

<nav class="navbar">
    <ul>
        <li><a href="../public/index.php">Inicio</a></li>
        <li><a href="../public/quienesSomos.php">¿Quiénes somos?</a></li>
        <li><a href="../public/queHacemos.php">Qué hacemos</a></li>
        <li><a href="../public/comoAyudar.php">Cómo ayudar</a></li>
        <li><a href="../public/elAlbergue.php">El albergue</a></li>
        <li><a href="../public/contactenos.php">Contáctenos</a></li>
    </ul>
</nav>


<script src="../public/js/logOutEmergency.js"></script>
