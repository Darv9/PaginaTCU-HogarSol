<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asociación Infantil Hogar Sol</title>
    <link rel="stylesheet" href="../public/header-footer/css/headerStyle.css">
    <link rel="stylesheet" href="../public/header-footer/css/footerStyle.css">
    <link rel="stylesheet" href="../public/css/contactenos.css">
    <script src="https://kit.fontawesome.com/186b29df68.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Nos traemos el header prefab -->
    <?php 
        include("../public/header-footer/header.html"); 
    ?>
    <!-- Todo el contenido de la pagina -->
    <div class="content">
         <!-- Informacion de Contacto Encabezado -->
        <div id="headerContactInfo">
            <h1>Contáctenos</h1>
            <p>Estamos a su disposición:</p>
        </div>
        <div id="containerFirstSection-contactInfo">
            <!-- Informacion de Contacto Telefonos -->
            <div id="contactInfo-Telephone">
                <h2>Teléfonos:</h2>
                <ul>
                    <li>(+506)2270-4281</li>
                    <li>(+506)2270-2200</li>
                </ul>
            </div>
            <!-- Informacion de Contacto Telefonos -->

            <!-- Informacion de Contacto Correos -->
            <div id="contactInfo-Mail">
                <h2>Correo electrónico:</h2>
                <p>contacto@hogarsol.org</p>
            </div>
            <!-- Informacion de Contacto Correos -->

            <!-- Informacion de Contacto Facebook -->
            <div id="contacSocialmedia-facebook">
                <h2>Síguenos en Facebook</h2>
                <a href="https://www.facebook.com/hogarsolcr/?fref=ts"><i class="fa-brands fa-square-facebook"></i></a>
            </div>
            <!-- Informacion de Contacto Facebook -->

        </div>
            <!-- Informacion de Contacto Direccion y Codigo Postal -->
            <div id="contactInfo-addressPostalCode">
                <h2>Dirección:</h2>
                <p>Higuito, San Miguel de Desamparados.</p>
                <p>De la Iglesia Católica de Higuito 800 metros Este,
                   frente a Urbanización el Lince. San José, Costa Rica.</p>
                <h2>Apartado Postal:</h2>
                <p>826-2400 Código postal: 10302 Desamparados, San José. CR.</p>
            </div>
             <!-- Informacion de Contacto Direccion y Codigo Postal -->
        <div id="mapSection">
        <iframe src="https://www.google.com/maps/embed?pb=!1m19!1m8!1m3!1d7861.723830261006!2d-84.0480486!3d9.8619503!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x8fa0e26ff19a8f69%3A0x75faa7964fa3b678!2sHogar%20Sol%20VX62%2BFM7%2C%20Higuito%2C%20San%20Miguel%20de%20Desamparados.%20De%20la%20Iglesia%20Cat%C3%B3lica%20de%20Higuito%20800%20metros%20este%2C%20frente%20a%20Urbanizaci%C3%B3n%20el%20Lince.%20San%20Jos%C3%A9%2C%20Costa%20Rica.%20San%20Jos%C3%A9%2C%20Higuito%20Costa%20Rica!3m2!1d9.8619529!2d-84.04815769999999!5e0!3m2!1ses-419!2scr!4v1730401458515!5m2!1ses-419!2scr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
    <!-- Nos tramos el footer prefab -->
    <?php 
        include("../public/header-footer/footer.html"); 
    ?>
</body>
</html>