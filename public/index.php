<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asociación Infantil Hogar Sol</title>
    <link rel="stylesheet" href="../public/header-footer/css/headerStyle.css">
    <link rel="stylesheet" href="../public/header-footer/css/footerStyle.css">
    <link rel="stylesheet" href="../public/css/index.css">
    <script src="https://kit.fontawesome.com/186b29df68.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Nos traemos el header prefab -->
    <?php 
        include("../public/header-footer/header.html"); 
    ?>
    <!-- Todo el contenido de la pagina -->
    <div class="content">
        <section id="gallery">
            <img src="../public/images/indexImage1.png" alt="indexImage1">
            <img src="../public/images/indexImage2.png" alt="indexImage2">
            <img src="../public/images/indexImage3.png" alt="indexImage3">
            <img src="../public/images/indexImage4.png" alt="indexImage4">
            <img src="../public/images/indexImage5.png" alt="indexImage5">
        </section>
        <h1>Somos una entidad sin ánimo de lucro dedicada a la protección y cuidado de la infancia</h1>
        <div id="donaciones">
            <a href="../public/comoAyudar.php"><img src="../public/images/imgDonation2.png" alt="imgDonation1"></a>
            <a href="../public/comoAyudar.php"><img src="../public/images/imgDonation1.png" alt="imgDonation2"></a>
        </div>
    </div>
    <!-- Nos tramos el footer prefab -->
    <?php 
        include("../public/header-footer/footer.html"); 
    ?>
</body>
</html>