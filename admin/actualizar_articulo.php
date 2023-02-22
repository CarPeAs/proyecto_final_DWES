<?php

include '../config/conectar_bd.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['actualizar'])){

   $pid = $_POST['pid'];
   $name = $_POST['nombre'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['precio'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $details = $_POST['descripcion'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);

   $update_product = $conex->prepare("UPDATE articulos SET nombre = ?, precio = ?, descripcion = ? WHERE id = ?");
   $update_product->execute([$name, $price, $details, $pid]);

   $mensaje[] = 'producto actualizado correctamente';

   $old_image_01 = $_POST['old_image_01'];
   $image_01 = $_FILES['imagen_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['imagen_01']['size'];
   $image_tmp_name_01 = $_FILES['imagen_01']['tmp_name'];
   $image_folder_01 = '../img_catalogo/'.$image_01;

   if(!empty($image_01)){
      if($image_size_01 > 2000000){
         $mensaje[] = 'El tamaño de la imagen es demasiado grande';
      }else{
         $update_image_01 = $conex->prepare("UPDATE articulos SET imagen_01 = ? WHERE id = ?");
         $update_image_01->execute([$image_01, $pid]);
         move_uploaded_file($image_tmp_name_01, $image_folder_01);
         unlink('../img_catalogo/'.$old_image_01);
         $mensaje[] = 'imagen 01 actualizada correctamente';
      }
   }

   $old_image_02 = $_POST['old_image_02'];
   $image_02 = $_FILES['imagen_02']['name'];
   $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
   $image_size_02 = $_FILES['imagen_02']['size'];
   $image_tmp_name_02 = $_FILES['imagen_02']['tmp_name'];
   $image_folder_02 = '../img_catalogo/'.$image_02;

   if(!empty($image_02)){
      if($image_size_02 > 2000000){
         $mensaje[] = 'El tamaño de la imagen es demasiado grande';
      }else{
         $update_image_02 = $conex->prepare("UPDATE articulos SET imagen_02 = ? WHERE id = ?");
         $update_image_02->execute([$image_02, $pid]);
         move_uploaded_file($image_tmp_name_02, $image_folder_02);
         unlink('../img_catalogo/'.$old_image_02);
         $mensaje[] = 'imagen 02 actualizada correctamente';
      }
   }

   $old_image_03 = $_POST['old_image_03'];
   $image_03 = $_FILES['imagen_03']['name'];
   $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
   $image_size_03 = $_FILES['imagen_03']['size'];
   $image_tmp_name_03 = $_FILES['imagen_03']['tmp_name'];
   $image_folder_03 = '../img_catalogo/'.$image_03;

   if(!empty($image_03)){
      if($image_size_03 > 2000000){
         $mensaje[] = 'El tamaño de la imagen es demasiado grande';
      }else{
         $update_image_03 = $conex->prepare("UPDATE articulos SET imagen_03 = ? WHERE id = ?");
         $update_image_03->execute([$image_03, $pid]);
         move_uploaded_file($image_tmp_name_03, $image_folder_03);
         unlink('../img_catalogo/'.$old_image_03);
         $mensaje[] = 'imagen 03 actualizada correctamente';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>editar producto</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../views/admin/admin_header.php'; ?>

<section class="update-product">

   <h1 class="heading">editar producto</h1>

   <?php
      $update_id = $_GET['actualizar'];
      $select_products = $conex->prepare("SELECT * FROM articulos WHERE id = ?");
      $select_products->execute([$update_id]);
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="old_image_01" value="<?= $fetch_products['imagen_01']; ?>">
      <input type="hidden" name="old_image_02" value="<?= $fetch_products['imagen_02']; ?>">
      <input type="hidden" name="old_image_03" value="<?= $fetch_products['imagen_03']; ?>">
      <div class="image-container">
         <div class="main-image">
            <img src="../img_catalogo/<?= $fetch_products['imagen_01']; ?>" alt="">
         </div>
         <div class="sub-image">
            <img src="../img_catalogo/<?= $fetch_products['imagen_01']; ?>" alt="">
            <img src="../img_catalogo/<?= $fetch_products['imagen_02']; ?>" alt="">
            <img src="../img_catalogo/<?= $fetch_products['imagen_03']; ?>" alt="">
         </div>
      </div>
      <span>Editar nombre</span>
      <input type="text" name="nombre" required class="box" maxlength="100" placeholder="nombre del producto" value="<?= $fetch_products['name']; ?>">
      <span>Editar precio</span>
      <input type="number" name="precio" required class="box" min="0" max="9999999999" placeholder="precio del producto" onkeypress="if(this.value.length == 10) return false;" value="<?= $fetch_products['price']; ?>">
      <span>Editar caracteristicas</span>
      <textarea name="descripcion" class="box" required cols="30" rows="10"><?= $fetch_products['details']; ?></textarea>
      <span>Editar imagen 01</span>
      <input type="file" name="imagen_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
      <span>Editar imagen 02</span>
      <input type="file" name="imagen_02" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
      <span>Editar imagen 03</span>
      <input type="file" name="imagen_03" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
      <div class="flex-btn">
         <input type="submit" name="actualizar" class="btn" value="editar">
         <a href="catalogo_admin.php" class="option-btn">regresar</a>
      </div>
   </form>
   
   <?php
         }
      }else{
         echo '<p class="empty">No se ha encontrado ningún producto</p>';
      }
   ?>

</section>












<script src="../js/admin_script.js"></script>
   
</body>
</html>