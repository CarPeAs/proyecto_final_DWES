<?php

include '../config/conectar_bd.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_GET['borrar'])){
   $id_borrado = $_GET['borrar'];
   $borrar_mensaje = $conex->prepare("DELETE FROM mensajes WHERE id = ?");
   $borrar_mensaje->execute([$id_borrado]);
   header('location:mensajes.php');
}

if(isset($_GET['baja'])){
   $id_borrado = $_GET['baja'];
   $borrar=false;
   $borrar_mensaje = $conex->prepare("UPDATE mensajes SET borrado = ? WHERE id = ?");
   $borrar_mensaje->execute([$borrar, $id_borrado]);
   header('location:mensajes.php');
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>mensajes</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../views/admin/admin_header.php'; ?>

<section class="contacts">

<h1 class="heading">mensajes</h1>

<div class="box-container">

   <?php
      $selecc_mensaje = $conex->prepare("SELECT * FROM mensajes WHERE borrado = 1");
      $selecc_mensaje->execute();
      if($selecc_mensaje->rowCount() > 0){
         while($fetch_mensaje = $selecc_mensaje->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
   <p> nombre : <span><?= $fetch_mensaje['nombre']; ?></span></p>
   <p> email : <span><?= $fetch_mensaje['email']; ?></span></p>
   <p> telefono : <span><?= $fetch_mensaje['numero']; ?></span></p>
   <p> mensaje : <span><?= $fetch_mensaje['mensaje']; ?></span></p>
   <a href="mensajes.php?baja=<?= $fetch_mensaje['id']; ?>" onclick="return confirm('¿Quiere borrar este mensaje?');" class="delete-btn">borrar</a>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">usted no tiene mensajes</p>';
      }
   ?>

</div>

</section>












<script src="../js/admin_script.js"></script>
   
</body>
</html>