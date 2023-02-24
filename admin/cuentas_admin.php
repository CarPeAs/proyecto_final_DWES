<?php

include '../config/conectar_bd.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['borrar'])){
   $borrar_id = $_GET['borrar'];
   $borrar_admin = $conex->prepare("DELETE FROM administradores WHERE id = ?");
   $borrar_admin->execute([$borrar_id]);
   header('location:cuentas_admin.php');
}

if(isset($_GET['baja'])){
   $baja_id = $_GET['baja'];
   $baja = false;
   if($baja_id == $admin_id){
      $mensaje[] = 'no puede eliminar su propia cuenta';
   }else{
      $baja_administrador = $conex->prepare("UPDATE administradores SET estatus = ? WHERE id = ?");
      $baja_administrador->execute([$baja, $baja_id]);
      header('location:cuentas_admin.php');
   }
   
}

if(isset($_GET['reactivar'])){
   $alta_id = $_GET['reactivar'];
   $alta=true;
   $alta_administrador = $conex->prepare("UPDATE administradores SET estatus = ? WHERE id = ?");
   $alta_administrador->execute([$alta, $alta_id]);
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
      <p>Añadir nuevo administrador</p>
      <a href="registrar_admin.php" class="option-btn">registrar admin</a>
   </div>

   <?php
      $selecc_cuentas = $conex->prepare("SELECT * FROM administradores WHERE rol = 'admin' ");
      $selecc_cuentas->execute();
      if($selecc_cuentas->rowCount() > 0){
         while($fetch_cuentas = $selecc_cuentas->fetch(PDO::FETCH_ASSOC)){   
   ?>
   <div class="box">
      <p> id admin : <span><?= $fetch_cuentas['id']; ?></span> </p>
      <p> nombre admin : <span><?= $fetch_cuentas['nombre']; ?></span> </p>
      <p>estatus: <span style="color:<?php if($fetch_cuentas['estatus'] == '0'){ echo 'red'; }else{ echo 'green'; }; ?>">
      <?php if($fetch_cuentas['estatus'] == '0'){ echo 'Admin inactivo'; }else{ echo 'Admin activo'; }; ?></span> </p>
      <div class="flex-btn">
         <a href="actualizar_administradores.php?actualizar=<?= $fetch_cuentas['id']; ?>" class="option-btn">editar</a>
         <a href="cuentas_admin.php?baja=<?= $fetch_cuentas['id']; ?>" class="delete-btn" onclick="return confirm('¿Quiere dar de baja a este administrador?');">baja</a>
      </div>
      <div class="flex-btn">
      <a href="cuentas_admin.php?reactivar=<?= $fetch_cuentas['id']; ?>" onclick="return confirm('¿Quiere reactivar esta cuenta?')" class="update-btn">reactivar</a>
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