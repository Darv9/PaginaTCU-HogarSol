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
</head>
<body>
    <!-- Nos traemos el header prefab -->
    <?php 
        include("../public/header-footer/header.html"); 
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
            <button id="buttonFinancialStatus"><a href="../public/images/estadoFinancieroDescarga.png" download="estadoFinancieroDescarga.png" class="download-button">Estado Financiero</a></button>
            </div>
        </div>
    </div>
    <!-- Nos tramos el footer prefab -->
    <?php 
        include("../public/header-footer/footer.html");
    ?>
</body>
</html>