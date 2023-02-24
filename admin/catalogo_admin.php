<?php

include '../config/conectar_bd.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['añadir_articulo'])){

   $nombre = $_POST['nombre'];
   $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
   $precio = $_POST['precio'];
   $precio = filter_var($precio, FILTER_SANITIZE_STRING);
   $descripcion = $_POST['descripcion'];
   $descripcion = filter_var($descripcion, FILTER_SANITIZE_STRING);

   $imagen_01 = $_FILES['imagen_01']['name'];
   $imagen_01 = filter_var($imagen_01, FILTER_SANITIZE_STRING);
   $tam_imagen_01 = $_FILES['imagen_01']['size'];
   $nom_imagen_tmp_01 = $_FILES['imagen_01']['tmp_name'];
   $carpeta_imagen_01 = '../img_catalogo/'.$imagen_01;

   $imagen_02 = $_FILES['imagen_02']['name'];
   $imagen_02 = filter_var($imagen_02, FILTER_SANITIZE_STRING);
   $tam_imagen_02 = $_FILES['imagen_02']['size'];
   $nom_imagen_tmp_02 = $_FILES['imagen_02']['tmp_name'];
   $carpeta_imagen_02 = '../img_catalogo/'.$imagen_02;

   $imagen_03 = $_FILES['imagen_03']['name'];
   $imagen_03 = filter_var($imagen_03, FILTER_SANITIZE_STRING);
   $tam_imagen_03 = $_FILES['imagen_03']['size'];
   $nom_imagen_tmp_03 = $_FILES['imagen_03']['tmp_name'];
   $carpeta_imagen_03 = '../img_catalogo/'.$imagen_03;

   $selecc_articulos = $conex->prepare("SELECT * FROM articulos WHERE nombre = ?");
   $selecc_articulos->execute([$nombre]);

   if($selecc_articulos->rowCount() > 0){
      $mensaje[] = 'el nombre del producto ya existe';
   }else{

      $agregar_articulo = $conex->prepare("INSERT INTO articulos (nombre, descripcion, precio, imagen_01, imagen_02, imagen_03) VALUES(?,?,?,?,?,?)");
      $agregar_articulo->execute([$nombre, $descripcion, $precio, $imagen_01, $imagen_02, $imagen_03]);

      if($agregar_articulo){
         if($tam_imagen_01 > 2000000 OR $tam_imagen_02 > 2000000 OR $tam_imagen_03 > 2000000){
            $mensaje[] = 'el tamaño de la imagen es muy grande';
         }else{
            move_uploaded_file($nom_imagen_tmp_01, $carpeta_imagen_01);
            move_uploaded_file($nom_imagen_tmp_02, $carpeta_imagen_02);
            move_uploaded_file($nom_imagen_tmp_03, $carpeta_imagen_03);
            $mensaje[] = 'nuevo producto añadido';
         }

      }

   }  

};

/*Artículo no disponible en stock - Baja logica*/
if(isset($_GET['baja'])){
   $baja_id = $_GET['baja'];
   $baja=false;
   $baja_articulo = $conex->prepare("UPDATE articulos SET disponible = ? WHERE id = ?");
   $baja_articulo->execute([$baja, $baja_id]);
   header('location:catalogo_admin.php');
}

if(isset($_GET['alta'])){
   $alta_id = $_GET['alta'];
   $alta=true;
   $alta_articulo = $conex->prepare("UPDATE articulos SET disponible = ? WHERE id = ?");
   $alta_articulo->execute([$alta, $alta_id]);
   $mensaje[]='El articulo ahora esta disponible en la web';
   
}

/**Borrado permanente */
if(isset($_GET['borrar'])){
   $id_articulo = $_GET['borrar'];
   $borrar_imagen_articulo = $conex->prepare("SELECT * FROM articulos WHERE id = ?");
   $borrar_imagen_articulo->execute([$id_articulo]);
   $fetch_borrar_imagen = $borrar_imagen_articulo->fetch(PDO::FETCH_ASSOC);
   unlink('../img_catalogo/'.$fetch_borrar_imagen['imagen_01']);
   unlink('../img_catalogo/'.$fetch_borrar_imagen['imagen_02']);
   unlink('../img_catalogo/'.$fetch_borrar_imagen['imagen_03']);
   $borrar_articulo = $conex->prepare("DELETE FROM articulos WHERE id = ?");
   $borrar_articulo->execute([$id_articulo]);
   $borrar_cesta = $conex->prepare("DELETE FROM cesta WHERE id_pedido = ?");
   $borrar_cesta->execute([$id_articulo]);
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
            <input type="text" class="box" required maxlength="100" placeholder="introduzca nombre" name="nombre">
         </div>
         <div class="inputBox">
            <span>precio producto (requerido)</span>
            <input type="number" min="0" class="box" required max="9999999999" placeholder="introduzca precio" onkeypress="if(this.value.length == 10) return false;" name="precio">
         </div>
        <div class="inputBox">
            <span>imagen 01 (requerido)</span>
            <input type="file" name="imagen_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
        <div class="inputBox">
            <span>imagen 02 (requerido)</span>
            <input type="file" name="imagen_02" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
        <div class="inputBox">
            <span>imagen 03 (requerido)</span>
            <input type="file" name="imagen_03" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
         <div class="inputBox">
            <span>caracteristicas producto (requerido)</span>
            <textarea name="descripcion" placeholder="introduzca caracteristicas" class="box" required maxlength="500" cols="30" rows="10"></textarea>
         </div>
      </div>
      
      <input type="submit" value="añadir" class="btn" name="añadir_articulo">
   </form>

</section>

<section class="show-products">

   <h1 class="heading">productos añadidos</h1>

   <div class="box-container">

   <?php
      $selecc_articulos = $conex->prepare("SELECT * FROM articulos ");
      $selecc_articulos->execute();
      if($selecc_articulos->rowCount() > 0){
         while($fetch_articulos = $selecc_articulos->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <div class="box">
      <img src="../img_catalogo/<?= $fetch_articulos['imagen_01']; ?>" alt="">
      <div class="name"><?= $fetch_articulos['nombre']; ?></div>
      <div class="price">€<span><?= $fetch_articulos['precio']; ?></span>/-</div>
      <div class="details"><span><?= $fetch_articulos['descripcion']; ?></span></div>
      <div class="details"><span style="color:<?php if($fetch_articulos['disponible'] == 0){ echo 'red'; }else{ echo 'green'; }; ?>">
         <?php if($fetch_articulos['disponible'] == 0 ){ echo 'Artículo agotado'; }else{ echo 'Artículo disponible'; }; ?></span></div>
      
      <div class="flex-btn">
         <a href="actualizar_articulo.php?actualizar=<?= $fetch_articulos['id']; ?>" class="option-btn">editar</a>
         <a href="catalogo_admin.php?baja=<?= $fetch_articulos['id']; ?>" class="delete-btn" onclick="return confirm('¿Quiere dar de baja este artículo?');">baja</a>
      </div>
      <div class="flex-btn">
         <a href="catalogo_admin.php?alta=<?= $fetch_articulos['id']; ?>" class="btn" onclick="return confirm('¿Quiere dar de alta este artículo?');">alta</a>
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