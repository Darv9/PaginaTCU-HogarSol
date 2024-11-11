<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asociación Infantil Hogar Sol</title>
    <link rel="stylesheet" href="../public/header-footer/css/headerStyle.css">
    <link rel="stylesheet" href="../public/header-footer/css/footerStyle.css">
    <link rel="stylesheet" href="../public/css/qHacemos.css">
    <script src="https://kit.fontawesome.com/186b29df68.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../public/js/scriptNewsletter.js"></script>
</head>
<body>
    <!-- Nos traemos el header prefab -->
    <?php 
        include("../public/header-footer/header.php"); 
    ?>
    <!-- Todo el contenido de la pagina -->
    <div class="content">
        <div id="containerFirstSection">
            <img src="../public/images/manosQHacemos.png" alt="Manos con Corazon">
            <h1>¿Qué hacemos?</h1>
            <h2>¡Sembramos amor!
                Los niños amados se convierten
                    en adultos que saben amar</h2>
            <p>Somos un albergue de carácter transitorio, es decir los niños permanecen por un lapso no mayor a los seis meses, durante el cual su situación social y legal debe ser resuelta. 
                Sin embargo en algunos casos la estadía se prolonga por razones primordialmente legales. Algunos pueden volver con sus familias de origen o con otro familiar que muestre deseos y 
                condiciones para acogerlos. En otros casos, el PANI los ubica con familias adoptivas, nacionales o internacionales, que le brindará el amor y condiciones adecuadas para un excelente futuro.</p>
            <p>Los niños llegan al albergue por referencia del Patronato Nacional de la Infancia (PANI), quien identifica las situaciones de riesgo, en donde sus derechos están siendo claramente violentados. 
                Muchos de ellos carecen de atención médica, educación, alimentación y vivienda digna, siendo víctimas también de abusos físicos y emocionales.</p>
            <p>Durante su estadía atendemos las necesidades básicas, físicas y afectivas de la población, tratando de compensar sus carencias brindándoles un entorno hogareño. 
                Atendemos una población aproximada de veinte niños, cuyas edades oscilan entre los cero y los doce años de edad.</p>
        </div>
        <div id="containerSecondSection">
            <img src="../public/images/estadoFinanciero.png" alt="Estados Financieros Imagen">
            <div id="containerTextSecondSection">
                <p>Las fundaciones o entidades sin
                    fines de lucro están obligadas a
                    presentar ante la Administración
                    Tributaria una “Memoria Anual”,
                    que incluye los estados financieros.</p>
                <p>Para conocer nuestra transparencia puede descargar aquí el Estado Financiero auditado:</p>
                <a href="../public/images/estadoFinancieroDescarga.png" download="estadoFinancieroDescarga.png" class="download-button">
                    <div class="button" data-tooltip="Size: 124Kb">
                        <div class="button-wrapper">
                        <div class="text">Estado Financiero</div>
                            <span class="icon">                            
                                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="2em" height="2em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15V3m0 12l-4-4m4 4l4-4M2 17l.621 2.485A2 2 0 0 0 4.561 21h14.878a2 2 0 0 0 1.94-1.515L22 17"></path></svg>
                            </span>
                        </div>
                    </div>
                </a>      
            </div>
        </div>
        <div id="registerNewsletter">
            <h2>Regístrese para nuestro boletín informativo</h2>
            <p>Esta es una nueva función que tenemos disponible, en donde los usuarios podrán registrarse para el envío de noticias acerca del hogar.</p>
            <form id="newsletterForm">
                <label for="emailNewsletter">Correo Electrónico</label>
                <input type="email" name="emailNewsletter" id="emailNewsletter" required>
                <div id="emailError" class="error-message" style="color: red;"></div> <!-- Contenedor para mensajes de error -->

                <label for="usernameNewsletter">Nombre del Usuario</label>
                <input type="text" name="usernameNewsletter" id="usernameNewsletter" required>
                <div id="usernameError" class="error-message" style="color: red;"></div>

                <label for="userlastname1Newsletter">Primer Apellido</label>
                <input type="text" name="userlastname1Newsletter" id="userlastname1Newsletter" required>
                <div id="lastname1Error" class="error-message" style="color: red;"></div>

                <label for="userlastname2Newsletter">Segundo Apellido</label>
                <input type="text" name="userlastname2Newsletter" id="userlastname2Newsletter" required>
                <div id="lastname2Error" class="error-message" style="color: red;"></div>

                <input type="hidden" name="action" value="registerNewsletter">

                <button type="submit">Confirmar Registro</button>
            </form>
        </div>

    </div>
    <!-- Nos tramos el footer prefab -->
    <?php 
        include("../public/header-footer/footer.html");
    ?>
</body>
</html>