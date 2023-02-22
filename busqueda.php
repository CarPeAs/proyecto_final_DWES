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
   <title>buscador</title>
   

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'views/usuario/usuario_header.php'; ?>

<section class="search-form">
   <form action="" method="post">
      <input type="text" name="search_box" placeholder="buscar aquí..." maxlength="100" class="box" required>
      <button type="submit" class="fas fa-search" name="search_btn"></button>
   </form>
</section>

<section class="products" style="padding-top: 0; min-height:100vh;">

   <div class="box-container">

   <?php
     if(isset($_POST['search_box']) OR isset($_POST['search_btn'])){
     $search_box = $_POST['search_box'];
     $selecc_productos = $conex->prepare("SELECT * FROM articulos WHERE nombre LIKE '%{$search_box}%'"); 
     $selecc_productos->execute();
     if($selecc_productos->rowCount() > 0){
      while($fetch_productos = $selecc_productos->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_productos['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_productos['nombre']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_productos['precio']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_productos['imagen_01']; ?>">
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="quick_view.php?pid=<?= $fetch_productos['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_productos['imagen_01']; ?>" alt="">
      <div class="name"><?= $fetch_productos['nombre']; ?></div>
      <div class="flex">
         <div class="price"><span>€</span><?= $fetch_productos['precio']; ?><span>/-</span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="submit" value="añadir al carro" class="btn" name="add_to_cart">
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