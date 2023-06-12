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
   <title>buscador</title>
   

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/main.css">

</head>
<body>
   
<?php include 'views/usuario/usuario_header.php'; ?>

<section class="search-form">
   <form action="" method="post">
      <input type="text" name="busqueda" placeholder="buscar aquí..." maxlength="100" class="box" required>
      <button type="submit" class="fas fa-search" name="btn_busqueda"></button>
   </form>
</section>

<section class="products" style="padding-top: 0; min-height:100vh;">

   <div class="box-container">

   <?php
     if(isset($_POST['busqueda']) OR isset($_POST['btn_busqueda'])){
     $busqueda = $_POST['busqueda'];
     $selecc_productos = $conex->prepare("SELECT * FROM articulos WHERE nombre LIKE '%{$busqueda}%'AND disponible = 1"); 
     $selecc_productos->execute();
     if($selecc_productos->rowCount() > 0){
      while($fetch_productos = $selecc_productos->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="id_producto" value="<?= $fetch_productos['id']; ?>">
      <input type="hidden" name="nombre" value="<?= $fetch_productos['nombre']; ?>">
      <input type="hidden" name="precio" value="<?= $fetch_productos['precio']; ?>">
      <input type="hidden" name="imagen" value="<?= $fetch_productos['imagen_01']; ?>">
      
      
      <img src="img_catalogo/<?= $fetch_productos['imagen_01']; ?>" alt="">
      <div class="name"><?= $fetch_productos['nombre']; ?></div>
      <div class="flex">
         <div class="price"><span>€</span><?= $fetch_productos['precio']; ?><span>/-</span></div>
         <input type="number" name="cantidad" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="submit" value="añadir a la cesta" class="btn" name="agregar_cesta">
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">no se han encontrado productos</p>';
      }
   }
   ?>

   </div>

</section>












<?php include 'views/usuario/usuario_footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>