<?php

include '../config/conectar_bd.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['borrar'])){
   $delete_id = $_GET['borrar'];
   $delete_admins = $conn->prepare("DELETE FROM administradores WHERE id = ?");
   $delete_admins->execute([$delete_id]);
   header('location:cuentas_admin.php');
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>cuentas admin</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../views/admin/admin_header.php'; ?>

<section class="accounts">

   <h1 class="heading">cuentas administradores</h1>

   <div class="box-container">

   <div class="box">
      <p>añadir nuevo administrador</p>
      <a href="registrar_admin.php" class="option-btn">registrar admin</a>
   </div>

   <?php
      $select_accounts = $conex->prepare("SELECT * FROM administradores ");
      $select_accounts->execute();
      if($select_accounts->rowCount() > 0){
         while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){   
   ?>
   <div class="box">
      <p> id admin : <span><?= $fetch_accounts['id']; ?></span> </p>
      <p> nombre admin : <span><?= $fetch_accounts['nombre']; ?></span> </p>
      <div class="flex-btn">
      <!--<a href="admin_accounts.php?delete=<?= $fetch_accounts['id']; ?>" onclick="return confirm('delete this account?')" class="delete-btn">delete</a>-->
         <?php
            if($fetch_accounts['id'] == $admin_id){
               echo '<a href="editar_perfil_admin.php" class="option-btn">actualizar</a>';
            }else{
               echo '<a href="editar_perfil_admin.php" class="option-btn">actualizar</a>';
               echo '<a href="cuentas_admin.php" class="delete-btn">borrar</a>';
            }
         ?>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no hay cuentas disponibles</p>';
      }
   ?>

   </div>

</section>












<script src="../js/admin_script.js"></script>
   
</body>
</html>