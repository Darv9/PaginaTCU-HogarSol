<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asociación Infantil Hogar Sol</title>
    <link rel="stylesheet" href="../public/header-footer/css/headerStyle.css">
    <link rel="stylesheet" href="../public/header-footer/css/footerStyle.css">
    <link rel="stylesheet" href="../public/css/comoAyudar.css">
    <script src="https://kit.fontawesome.com/186b29df68.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Nos traemos el header prefab -->
    <?php 
        include("../public/header-footer/header.php"); 
    ?>
    <!-- Todo el contenido de la pagina -->
    <div class="content">
        <div id="container">
            <div id="firstSectionContainer">
                <img src="../public/images/manosComoAyudar.png" alt="Imagen manos ayudando">
                <h1>¿Como Ayudar?</h1>
                <p>Algunas ONG costarricenses recibimos aportes por parte de Instituciones Gubernamentales, como el caso del PANI que aporta el 45.95% del costo total de la manutención por cada niño que atendemos. 
                    La Junta de Protección Social (JPS) nos apoya en necesidades básicas y en el financiamiento de proyectos de construcción específicos.</p>
                <p>Para brindar una atención de calidad son muchas las carencias que se deben de atender y en muchas ocasiones los recursos no son suficientes.</p>
                <p>Por esta razón necesitamos la colaboración de personas físicas, instituciones y empresas que nos permitan continuar con nuestra labor.</p>
            </div>
            <div id="secondSectionContainer">
                <div id="donationSecondSectionContainer">
                    <img src="../public/images/imgDonation1.png" alt="Imagen de Donación Corazón Anaranjado">
                    <h2>Usted puede brindarnos su ayuda por medio de:</h2>
                    <ul>
                        <li>Donaciones directas a la cuenta corriente del Banco Nacional de Costa Rica nº 100-01-047 000916-2 a nombre de "Asociación Infantil Hogar Sol", 
                            cédula jurídica 3-002-118350, y para transferencias desde otra entidad al número cuenta cliente 151 047 100 100 091 61</li>
                        <li>Cuenta IBAN: CR24 0151 0471 0010 0091 61</li>
                        <li>Sinpe Movil: 6027-1658</li>
                        <li>SWIFT: BNCRCRSJ</li>
                        <li>Rebajo automático por tarjeta de débito o crédito.</li>
                        <li>Ayuda en especies</li>
                        <li>Trabajo de voluntariado</li>
                        <li>Pasantías o TCU (Trabajo Comunal Universitario) en el albergue</li>
                        <li>Trabajo Social</li>
                        <li>Acompañándonos en nuestras actividades especiales y a beneficio del Hogar Sol</li>
                    </ul>
                </div>
                <div id="volunteerSectionContainer">
                    <img src="../public/images/imgDonation2.png" alt="Imagen de voluntariado">
                    <h2>¿Desea formar parte de nuestro equipo de voluntariado?</h2>
                    <p>Durante su estadía como voluntario en el albergue trabajaremos juntos para atender las necesidades básicas, físicas y afectivas de nuestros niños, brindándoles un entorno hogareño.</p>
                    <h2>¿Qué pasos debe seguir?</h2>
                    <p>Para formar parte de nuestro equipo, simplemente descargue los siguientes tres formularios en formato word, llénelos con su información y envíelos al correo contacto@hogarsol.org, y nuestro personal se encargará de revisarlos y ponerse en contacto con usted.</p>
                    <a href="../public/images/estadoFinancieroDescarga.png" download="estadoFinancieroDescarga.png" class="download-button">
                    <div class="button" data-tooltip="Size: 28Kb">
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
            <div id="videoSecondSectionContainer">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/rSBFbbh3-Ww?si=Vu6k2QJgVqDs_4tA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
        </div>
    </div>
    <!-- Nos tramos el footer prefab -->
    <?php 
        include("../public/header-footer/footer.html"); 
    ?>
</body>
</html>