<?php

include '../config/conectar_bd.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['borrar'])){
   $delete_id = $_GET['borrar'];
   $delete_user = $conex->prepare("DELETE FROM usuarios WHERE id = ?");
   $delete_user->execute([$delete_id]);
   $delete_orders = $conex->prepare("DELETE FROM pedidos WHERE id_usuario = ?");
   $delete_orders->execute([$delete_id]);
   $delete_messages = $conex->prepare("DELETE FROM mensajes WHERE id_usuario = ?");
   $delete_messages->execute([$delete_id]);
   $delete_cart = $conex->prepare("DELETE FROM cesta WHERE id_usuario = ?");
   $delete_cart->execute([$delete_id]);
   /*$delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE user_id = ?");
   $delete_wishlist->execute([$delete_id]);*/
   header('location:cuentas_usuarios.php');
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>cuentas usuarios</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../views/admin/admin_header.php'; ?>

<section class="accounts">

   <h1 class="heading">cuentas usuarios</h1>

   <div class="box-container">

   <?php
      $select_accounts = $conex->prepare("SELECT * FROM usuarios ");
      $select_accounts->execute();
      if($select_accounts->rowCount() > 0){
         while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){   
   ?>
   <div class="box">
      <p> id usuario : <span><?= $fetch_accounts['id']; ?></span> </p>
      <p> nombre usuario : <span><?= $fetch_accounts['nombre']; ?></span> </p>
      <p> email : <span><?= $fetch_accounts['email']; ?></span> </p>
      <a href="cuentas_usuarios.php?borrar=<?= $fetch_accounts['id']; ?>" onclick="return confirm('¿Quiere eliminar esta cuenta? la información relacionada con el usuario también se suprimirá')" class="delete-btn">eliminar</a>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">¡no hay cuentas disponibles!</p>';
      }
   ?>

   </div>

</section>












<script src="../js/admin_script.js"></script>
   
</body>
</html>