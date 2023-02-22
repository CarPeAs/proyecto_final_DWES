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

<section class="category">

   <h1 class="heading">comprar por categoría</h1>

   <div class="swiper category-slider">

   <div class="swiper-wrapper">

   <a href="categorias.php?categoria=laptop" class="swiper-slide slide">
      <img src="img/icon-1.png" alt="">
      <h3>portátiles</h3>
   </a>

   <a href="categorias.php?categoria=tv" class="swiper-slide slide">
      <img src="img/icon-2.png" alt="">
      <h3>televisión</h3>
   </a>

   <a href="categorias.php?categoria=camera" class="swiper-slide slide">
      <img src="img/icon-3.png" alt="">
      <h3>camara</h3>
   </a>

   <a href="categorias.php?categoia=mouse" class="swiper-slide slide">
      <img src="img/icon-4.png" alt="">
      <h3>raton</h3>
   </a>

   <a href="categorias.php?categoria=fridge" class="swiper-slide slide">
      <img src="img/icon-5.png" alt="">
      <h3>frigoríficos</h3>
   </a>

   <a href="categorias.php?categoria=washing" class="swiper-slide slide">
      <img src="img/icon-6.png" alt="">
      <h3>lavadoras</h3>
   </a>

   <a href="categorias.php?categoria=smartphone" class="swiper-slide slide">
      <img src="img/icon-7.png" alt="">
      <h3>smartphone</h3>
   </a>

   <a href="categorias.php?categoria=watch" class="swiper-slide slide">
      <img src="img/icon-8.png" alt="">
      <h3>smartwatch</h3>
   </a>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>

<section class="home-products">

   <h1 class="heading">artículos más recientes</h1>

   <div class="swiper products-slider">

   <div class="swiper-wrapper">

   <?php
     $productos_selecc = $conex->prepare("SELECT * FROM articulos LIMIT 6"); 
     $productos_selecc ->execute();
     if($productos_selecc ->rowCount() > 0){
      while($fetch_product = $productos_selecc ->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="swiper-slide slide">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['nombre']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['precio']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['imagen_01']; ?>">
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_product['imagen_01']; ?>" alt="">
      <div class="name"><?= $fetch_product['nombre']; ?></div>
      <div class="flex">
         <div class="price"><span>€</span><?= $fetch_product['precio']; ?><span>/-</span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="submit" value="añadir al carro" class="btn" name="add_to_cart">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">aún no hay productos añadidos!</p>';
   }
   ?>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>

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
var swiper = new Swiper(".category-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
         slidesPerView: 2,
       },
      650: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 4,
      },
      1024: {
        slidesPerView: 5,
      },
   },
});

var swiper = new Swiper(".products-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      550: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
   },
});


</script>