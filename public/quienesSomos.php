<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asociación Infantil Hogar Sol</title>
    <link rel="stylesheet" href="../public/header-footer/css/headerStyle.css">
    <link rel="stylesheet" href="../public/header-footer/css/footerStyle.css">
    <link rel="stylesheet" href="../public/css/qSomos.css">
    <script src="https://kit.fontawesome.com/186b29df68.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Nos traemos el header prefab -->
    <?php 
        include("../public/header-footer/header.php"); 
    ?>
    <!-- Todo el contenido de la pagina -->
    <div class="content">
        <main>
            <article>
                <h2 id="tituloQSomos">¿Quiénes somos?</h2>
                <p>La Asociación Infantil Hogar Sol es una Organización No Gubernamental que trabaja en estrecha colaboración con el gobierno de Costa Rica atendiendo a niños en riesgo social y 
                    en estado de vulnerabilidad. Protegemos a los niños en situaciones de abandono, maltrato, agresión sexual y física.</p>
                <p>Somos una institución de bien social, ecuménico, de carácter privado y sin fines de lucro. Desde su fundación, en el año de 1990, la Asociación ha tenido la firme convicción 
                    que los niños en riesgo social tienen derechos, necesidades específicas y requieren de una protección especial de parte de la sociedad civil.</p>
            </article>
            <section>
                <div id="sectionMission">
                    <h2>Misión</h2>
                    <p>"Dar atención integral a niños en situación de riesgo social, en un ambiente familiar con el apoyo conjunto de la comunidad e instituciones públicas."</p>
                </div>
            </section>
        </main>
        <section id="Image">
            <h2>Trabajando con Amor</h2>
            <img src="../public/images/qSomos.png" alt="Imagen de quienes somos">
        </section>
        <section id="juntaDirectiva">
            <h2>Junta Directiva</h2>
            <p>La Dirección de la Asociación está constituida por una Junta Directiva que dona su trabajo con el fin de conseguir los objetivos de la Asociación:</p>
            <ul>
                <li>Presidente: Adriana Durán Bermúdez</li>
                <li>Vicepresidente: Mayela Varela Chacón</li>
                <li>Secretaria: Zaida Camacho Ulate</li>
                <li>Vocal Uno: Jurgen Freer Bolaños</li>
                <li>Vocal Dos: Shirlene Santillán Aguilar</li>
                <li>Fiscal Propietario: Daniel Azofeifa Alvarado</li>
                <li>Fiscal Suplente: Fabiola De Bernardi Rodríguez</li>
            </ul>
        </section>
    </div>
    <!-- Nos traemos el footer prefab -->
    <?php 
        include("../public/header-footer/footer.html"); 
    ?>
</body>
</html>
