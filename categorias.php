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
     $selecc_articulo = $conex->prepare("SELECT * FROM articulos WHERE nombre LIKE '%{$categoria}%' AND disponible = 1 "); 
     $selecc_articulo->execute();
     if($selecc_articulo->rowCount() > 0){
      while($fetch_articulo = $selecc_articulo->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
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
      <input type="submit" value="añadir a la cesta" class="btn" name="agregar_cesta">
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