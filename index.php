<?php

include 'config/conectar_bd.php';

session_start();

if(isset($_SESSION['id_usuario'])){
    $id_usuario = $_SESSION['id_usuario'];
}else{
    $id_usuario = '';
};

include 'modelo_cesta.php';

?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>inicio</title>
   
   <!-- <link rel="stylesheet" href="css/style.css"> -->
   <link rel="stylesheet" href="css/main.css">
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
         <a href="https://www.vecteezy.com/free-png/wine"><img src="img/home-img-1.png" alt="una botella de vino y dos copas"></a>
         </div>
         <div class="content">
            <span>Una copa de</span>
            <h3>los mejores vinos</h3>
            <a href="catalogo.php" class="btn">comprar ahora</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
         <a href="https://www.vecteezy.com/free-png/bread"><img src="img/home-img-2.png" alt="una barra de pan"></a>
         </div>
         <div class="content">
            <span>Directo del horno</span>
            <h3>panader&iacute;a y boller&iacute;a</h3>
            <a href="catalogo.php" class="btn">comprar ahora</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <a href="https://www.vecteezy.com/free-png/fruits"><img src="img/home-img-3.png" alt="una cesta con frutas"></a>
         </div>
         <div class="content">
            <span>Las m&aacute;s frescas</span>
            <h3>frutas y vegetales</h3>
            <a href="catalogo.php" class="btn">comprar ahora</a>
         </div>
      </div>

   </div>

      <!-- <div class="swiper-pagination"></div> -->
      <!-- Flechas laterlas desplazamiento -->
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>

   </div>

</section>

</div>

<section class="category">

   <h1 class="heading">comprar por categoría</h1>

   <div class="swiper category-slider">

   <div class="swiper-wrapper">

   <a href="categorias.php?categoria=vino" class="swiper-slide slide">
      <img src="img/categoria/icon-11.png" alt="botella de vino y copa">
      <h3>vinos</h3>
   </a>

   <a href="categorias.php?categoria=pescado" class="swiper-slide slide">
      <img src="img/categoria/icon-23.png" alt="imagen de un pez">
      <h3>pescader&iacute;a</h3>
   </a>

   <a href="categorias.php?categoria=pan" class="swiper-slide slide">
      <img src="img/categoria/icon-13.png" alt="cesta con articulos de panadería">
      <h3>panader&iacute;a</h3>
   </a>

   <a href="categorias.php?categoria=carniceria" class="swiper-slide slide">
      <img src="img/categoria/icon-14.png" alt="una silueta de un pollo en una balanza">
      <h3>carnicer&iacute;a</h3>
   </a>

   <a href="categorias.php?categoria=limpieza" class="swiper-slide slide">
      <img src="img/categoria/icon-15.png" alt="un envase de detergente">
      <h3>limpieza</h3>
   </a>

   <a href="categorias.php?categoria=frutas" class="swiper-slide slide">
      <img src="img/categoria/icon-16.png" alt="una cesta con manzanas">
      <h3>frutas</h3>
   </a>

   <a href="categorias.php?categoria=verduras" class="swiper-slide slide">
      <img src="img/categoria/icon-17.png" alt="una cesta con zanahorias">
      <h3>verduras</h3>
   </a>

   <a href="categorias.php?categoria=mascotas" class="swiper-slide slide">
      <img src="img/categoria/icon-22.png" alt="una huella de un gato">
      <h3>mascotas</h3>
   </a>

   </div>

   <!-- <div class="swiper-pagination"></div> -->
   <!-- Flechas laterlas desplazamiento -->
   <div class="swiper-button-next"></div>
   <div class="swiper-button-prev"></div>

   </div>

</section>

<section class="home-products">

   <h1 class="heading">artículos más recientes</h1>

   <div class="swiper products-slider">

   <div class="swiper-wrapper">

   <?php
     $selecc_articulos = $conex->prepare("SELECT * FROM articulos WHERE disponible = 1  LIMIT 6"); 
     $selecc_articulos ->execute();
     if($selecc_articulos ->rowCount() > 0){
      while($fetch_articulo = $selecc_articulos ->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="swiper-slide slide">
      <input type="hidden" name="id_producto" value="<?= $fetch_articulo['id']; ?>">
      <input type="hidden" name="nombre" value="<?= $fetch_articulo['nombre']; ?>">
      <input type="hidden" name="precio" value="<?= $fetch_articulo['precio']; ?>">
      <input type="hidden" name="imagen" value="<?= $fetch_articulo['imagen_01']; ?>">
      

      <img src="img_catalogo/<?= $fetch_articulo['imagen_01']; ?>" alt="">
      <div class="name"><?= $fetch_articulo['nombre']; ?></div>
      <div class="flex">
         <div class="price"><span>€</span><?= $fetch_articulo['precio']; ?><span>/-</span></div>
         <input type="number" name="cantidad" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="submit" value="añadir al carro" class="btn" name="agregar_cesta">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">aún no hay productos añadidos!</p>';
   }
   ?>

   </div>

   <!-- <div class="swiper-pagination"></div> -->
   <!-- Flechas laterlas desplazamiento -->
   <div class="swiper-button-next"></div>
   <div class="swiper-button-prev"></div>
   </div>

</section>

<?php include 'views/usuario/usuario_footer.php'; ?>

<script src="js/script.js"></script>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<!-- Libreria SWIPER para la paginación -->

<script>
   //  Inicializar Swiper
  var homeSwiper = new Swiper(".home-slider", {
    loop: true,
    spaceBetween: 20,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });

  var categorySwiper = new Swiper(".category-slider", {
    loop: true,
    spaceBetween: 20,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
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

  var productsSwiper = new Swiper(".products-slider", {
    loop: true,
    spaceBetween: 20,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
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
