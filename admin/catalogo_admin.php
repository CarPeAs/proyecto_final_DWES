<?php

include '../config/conectar_bd.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['añadir_articulo'])){

   $name = $_POST['nombre'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['precio'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $details = $_POST['descripcion'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);

   $image_01 = $_FILES['imagen_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['imagen_01']['size'];
   $image_tmp_name_01 = $_FILES['imagen_01']['tmp_name'];
   $image_folder_01 = '../img_catalogo/'.$image_01;

   $image_02 = $_FILES['imagen_02']['name'];
   $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
   $image_size_02 = $_FILES['imagen_02']['size'];
   $image_tmp_name_02 = $_FILES['imagen_02']['tmp_name'];
   $image_folder_02 = '../img_catalogo/'.$image_02;

   $image_03 = $_FILES['imagen_03']['name'];
   $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
   $image_size_03 = $_FILES['imagen_03']['size'];
   $image_tmp_name_03 = $_FILES['imagen_03']['tmp_name'];
   $image_folder_03 = '../img_catalogo/'.$image_03;

   $select_products = $conex->prepare("SELECT * FROM articulos WHERE nombre = ?");
   $select_products->execute([$name]);

   if($select_products->rowCount() > 0){
      $message[] = 'el nombre del producto ya existe';
   }else{

      $insert_products = $conex->prepare("INSERT INTO articulos (nombre, descripcion, precio, imagen_01, imagen_02, imagen_03) VALUES(?,?,?,?,?,?)");
      $insert_products->execute([$name, $details, $price, $image_01, $image_02, $image_03]);

      if($insert_products){
         if($image_size_01 > 2000000 OR $image_size_02 > 2000000 OR $image_size_03 > 2000000){
            $message[] = 'el tamaño de la imagen es muy grande';
         }else{
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            move_uploaded_file($image_tmp_name_02, $image_folder_02);
            move_uploaded_file($image_tmp_name_03, $image_folder_03);
            $message[] = 'nuevo producto añadido';
         }

      }

   }  

};

if(isset($_GET['borrar'])){

   $delete_id = $_GET['borrar'];
   $delete_product_image = $conex->prepare("SELECT * FROM articulos WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../img_catalogo/'.$fetch_delete_image['imagen_01']);
   unlink('../img_catalogo/'.$fetch_delete_image['imagen_02']);
   unlink('../img_catalogo/'.$fetch_delete_image['imagen_03']);
   $delete_product = $conex->prepare("DELETE FROM articulos WHERE id = ?");
   $delete_product->execute([$delete_id]);
   $delete_cart = $conex->prepare("DELETE FROM cesta WHERE id_pedido = ?");
   $delete_cart->execute([$delete_id]);
   $delete_wishlist = $conex->prepare("DELETE FROM wishlist WHERE id_pedido = ?");
   $delete_wishlist->execute([$delete_id]);
   header('location:catalogo_admin.php');
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>productos</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../views/admin/admin_header.php'; ?>

<section class="add-products">

   <h1 class="heading">añadir producto</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <div class="flex">
         <div class="inputBox">
            <span>nombre producto (requerido)</span>
            <input type="text" class="box" required maxlength="100" placeholder="introduzca nombre" name="name">
         </div>
         <div class="inputBox">
            <span>precio producto (requerido)</span>
            <input type="number" min="0" class="box" required max="9999999999" placeholder="introduzca precio" onkeypress="if(this.value.length == 10) return false;" name="price">
         </div>
        <div class="inputBox">
            <span>imagen 01 (requerido)</span>
            <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
        <div class="inputBox">
            <span>imagen 02 (requerido)</span>
            <input type="file" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
        <div class="inputBox">
            <span>imagen 03 (requerido)</span>
            <input type="file" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
         <div class="inputBox">
            <span>caracteristicas producto (requerido)</span>
            <textarea name="details" placeholder="introduzca caracteristicas" class="box" required maxlength="500" cols="30" rows="10"></textarea>
         </div>
      </div>
      
      <input type="submit" value="añadir" class="btn" name="añadir_articulo">
   </form>

</section>

<section class="show-products">

   <h1 class="heading">productos añadidos</h1>

   <div class="box-container">

   <?php
      $select_products = $conex->prepare("SELECT * FROM articulos ");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <div class="box">
      <img src="../img_catalogo/<?= $fetch_products['imagen_01']; ?>" alt="">
      <div class="name"><?= $fetch_products['nombre']; ?></div>
      <div class="price">€<span><?= $fetch_products['precio']; ?></span>/-</div>
      <div class="details"><span><?= $fetch_products['descripcion']; ?></span></div>
      <div class="flex-btn">
         <a href="actualizar_articulo.php?actualizar=<?= $fetch_products['id']; ?>" class="option-btn">editar</a>
         <a href="catalogo_admin.php?borrar=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('¿Borrar este producto?');">eliminar</a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">aún no se han añadido productos</p>';
      }
   ?>
   
   </div>

</section>








<script src="../js/admin_script.js"></script>
   
</body>
</html>