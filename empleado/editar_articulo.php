<?php

include '../config/conectar_bd.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['actualizar'])){

   $pid = $_POST['pid'];
   $nombre = $_POST['nombre'];
   $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
   $precio = $_POST['precio'];
   $precio = filter_var($precio, FILTER_SANITIZE_STRING);
   $descripcion = $_POST['descripcion'];
   $descripcion = filter_var($descripcion, FILTER_SANITIZE_STRING);

   $editar_articulo = $conex->prepare("UPDATE articulos SET nombre = ?, precio = ?, descripcion = ? WHERE id = ?");
   $editar_articulo->execute([$nombre, $precio, $descripcion, $pid]);

   $mensaje[] = 'producto actualizado correctamente';

   $ant_imagen_01 = $_POST['ant_imagen_01'];
   $imagen_01 = $_FILES['imagen_01']['name'];
   $imagen_01 = filter_var($imagen_01, FILTER_SANITIZE_STRING);
   $tam_imagen_01 = $_FILES['imagen_01']['size'];
   $nom_imagen_tmp_01 = $_FILES['imagen_01']['tmp_name'];
   $carpeta_imagen_01 = '../img_catalogo/'.$imagen_01;

   if(!empty($imagen_01)){
      if($tam_imagen_01 > 2000000){
         $mensaje[] = 'El tamaño de la imagen es demasiado grande';
      }else{
         $editar_imagen_01 = $conex->prepare("UPDATE articulos SET imagen_01 = ? WHERE id = ?");
         $editar_imagen_01->execute([$imagen_01, $pid]);
         move_uploaded_file($nom_imagen_tmp_01, $carpeta_imagen_01);
         unlink('../img_catalogo/'.$ant_imagen_01);
         $mensaje[] = 'imagen 01 actualizada correctamente';
      }
   }

   $ant_imagen_02 = $_POST['ant_imagen_02'];
   $imagen_02 = $_FILES['imagen_02']['name'];
   $imagen_02 = filter_var($imagen_02, FILTER_SANITIZE_STRING);
   $tam_imagen_02 = $_FILES['imagen_02']['size'];
   $nom_imagen_tmp_02 = $_FILES['imagen_02']['tmp_name'];
   $carpeta_imagen_02 = '../img_catalogo/'.$imagen_02;

   if(!empty($imagen_02)){
      if($tam_imagen_02 > 2000000){
         $mensaje[] = 'El tamaño de la imagen es demasiado grande';
      }else{
         $editar_imagen_02 = $conex->prepare("UPDATE articulos SET imagen_02 = ? WHERE id = ?");
         $editar_imagen_02->execute([$imagen_02, $pid]);
         move_uploaded_file($nom_imagen_tmp_02, $carpeta_imagen_02);
         unlink('../img_catalogo/'.$ant_imagen_02);
         $mensaje[] = 'imagen 02 actualizada correctamente';
      }
   }

   $ant_imagen_03 = $_POST['ant_imagen_03'];
   $imagen_03 = $_FILES['imagen_03']['name'];
   $imagen_03 = filter_var($imagen_03, FILTER_SANITIZE_STRING);
   $tam_imagen_03 = $_FILES['imagen_03']['size'];
   $nom_imagen_tmp_03 = $_FILES['imagen_03']['tmp_name'];
   $carpeta_imagen_03 = '../img_catalogo/'.$imagen_03;

   if(!empty($imagen_03)){
      if($tam_imagen_03 > 2000000){
         $mensaje[] = 'El tamaño de la imagen es demasiado grande';
      }else{
         $editar_imagen_03 = $conex->prepare("UPDATE articulos SET imagen_03 = ? WHERE id = ?");
         $editar_imagen_03->execute([$imagen_03, $pid]);
         move_uploaded_file($nom_imagen_tmp_03, $carpeta_imagen_03);
         unlink('../img_catalogo/'.$ant_imagen_03);
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

<?php include '../views/empleado/emple_header.php'; ?>

<section class="update-product">

   <h1 class="heading">editar producto</h1>

   <?php
      $id_articulo = $_GET['actualizar'];
      $selecc_articulo = $conex->prepare("SELECT * FROM articulos WHERE id = ?");
      $selecc_articulo->execute([$id_articulo]);
      if($selecc_articulo->rowCount() > 0){
         while($fetch_articulo = $selecc_articulo->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="pid" value="<?= $fetch_articulo['id']; ?>">
      <input type="hidden" name="ant_imagen_01" value="<?= $fetch_articulo['imagen_01']; ?>">
      <input type="hidden" name="ant_imagen_02" value="<?= $fetch_articulo['imagen_02']; ?>">
      <input type="hidden" name="ant_imagen_03" value="<?= $fetch_articulo['imagen_03']; ?>">
      <div class="image-container">
         <div class="main-image">
            <img src="../img_catalogo/<?= $fetch_articulo['imagen_01']; ?>" alt="">
         </div>
         <div class="sub-image">
            <img src="../img_catalogo/<?= $fetch_articulo['imagen_01']; ?>" alt="">
            <img src="../img_catalogo/<?= $fetch_articulo['imagen_02']; ?>" alt="">
            <img src="../img_catalogo/<?= $fetch_articulo['imagen_03']; ?>" alt="">
         </div>
      </div>
      <span>Editar nombre</span>
      <input type="text" name="nombre" required class="box" maxlength="100" placeholder="nombre del producto" value="<?= $fetch_articulo['nombre']; ?>">
      <span>Editar precio</span>
      <input type="number" name="precio" required class="box" min="0" max="9999999999" placeholder="precio del producto" onkeypress="if(this.value.length == 10) return false;" value="<?= $fetch_articulo['precio']; ?>">
      <span>Editar caracteristicas</span>
      <textarea name="descripcion" class="box" required cols="30" rows="10"><?= $fetch_articulo['descripcion']; ?></textarea>
      <span>Editar imagen 01</span>
      <input type="file" name="imagen_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
      <span>Editar imagen 02</span>
      <input type="file" name="imagen_02" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
      <span>Editar imagen 03</span>
      <input type="file" name="imagen_03" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
      <div class="flex-btn">
         <input type="submit" name="actualizar" class="btn" value="editar">
         <a href="catalogo_emple.php" class="option-btn">regresar</a>
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