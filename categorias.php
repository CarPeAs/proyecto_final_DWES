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
   <title>categoria</title>
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'views/usuario/usuario_header.php'; ?>

<section class="products">

   <h1 class="heading">categoria</h1>

   <div class="box-container">

   <?php
     $categoria = $_GET['categoria'];
     $productos_selecc = $conex->prepare("SELECT * FROM articulos WHERE nombre LIKE '%{$categoria}%'"); 
     $productos_selecc->execute();
     if($productos_selecc->rowCount() > 0){
      while($fetch_producto = $productos_selecc->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_producto['id']; ?>">
      <input type="hidden" name="nombre" value="<?= $fetch_producto['nombre']; ?>">
      <input type="hidden" name="precio" value="<?= $fetch_producto['precio']; ?>">
      <input type="hidden" name="imagen" value="<?= $fetch_producto['imagen_01']; ?>">
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="quick_view.php?pid=<?= $fetch_producto['id']; ?>" class="fas fa-eye"></a>
      <img src="img_catalogo/<?= $fetch_product['imagen_01']; ?>" alt="">
      <div class="name"><?= $fetch_product['nombre']; ?></div>
      <div class="flex">
         <div class="price"><span>€</span><?= $fetch_product['precio']; ?><span>/-</span></div>
         <input type="number" name="cantidad" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="submit" value="añadir a la cesta" class="btn" name="add_to_cart">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">no se han encontrado productos!</p>';
   }
   ?>

   </div>

</section>













<?php include 'views/usuario/usuario_footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>