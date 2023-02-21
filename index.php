<?php

include 'config/conectar_bd.php';

session_start();

if(isset($_SESSION['user_id'])){
    $id_usuario = $_SESSION['user_id'];
}else{
    $id_usuario = '';
};


?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>inicio</title>
   
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   

</head>
<body>
   
<?php include 'views/usuario/usuario_header.php'; ?>

<div class="home-bg">

<section class="home">

   <div class="swiper home-slider">
   
   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <div class="image">
            <img src="img/home-img-1.png" alt="">
         </div>
         <div class="content">
            <span>promociones</span>
            <h3>smartphones</h3>
            <a href="catalogo.php" class="btn">comprar ahora</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="img/home-img-2.png" alt="">
         </div>
         <div class="content">
            <span>hasta -30% </span>
            <h3>ultimos smartwatches</h3>
            <a href="catalogo.php" class="btn">comprar ahora</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="img/home-img-3.png" alt="">
         </div>
         <div class="content">
            <span>top ventas</span>
            <h3>consolas</h3>
            <a href="catalogo.php" class="btn">comprar ahora</a>
         </div>
      </div>

   </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

</div>

<?php include 'views/usuario/usuario_footer.php'; ?>

<script src="js/script.js"></script>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script>

var swiper = new Swiper(".home-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
    },
});


</script>