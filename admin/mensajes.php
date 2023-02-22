<?php

include '../config/conectar_bd.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_GET['borrar'])){
   $delete_id = $_GET['borrar'];
   $delete_message = $conex->prepare("DELETE FROM mensajes WHERE id = ?");
   $delete_message->execute([$delete_id]);
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
      $select_messages = $conex->prepare("SELECT * FROM mensajes ");
      $select_messages->execute();
      if($select_messages->rowCount() > 0){
         while($fetch_message = $select_messages->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
   <p> id usuario : <span><?= $fetch_message['user_id']; ?></span></p>
   <p> nombre : <span><?= $fetch_message['nombre']; ?></span></p>
   <p> email : <span><?= $fetch_message['email']; ?></span></p>
   <p> numero : <span><?= $fetch_message['numero']; ?></span></p>
   <p> mensaje : <span><?= $fetch_message['mensaje']; ?></span></p>
   <a href="mensajes.php?borrar=<?= $fetch_message['id']; ?>" onclick="return confirm('¿Quiere borrar este mensaje?');" class="delete-btn">borrar</a>
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