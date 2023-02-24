<?php

include '../config/conectar_bd.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['borrar'])){
   $borrar_id = $_GET['borrar'];
   $borrar_usuario = $conex->prepare("DELETE FROM usuarios WHERE id = ?");
   $borrar_usuario->execute([$borrar_id]);
   $borrar_pedidos = $conex->prepare("DELETE FROM pedidos WHERE id_usuario = ?");
   $borrar_pedidos->execute([$borrar_id]);
   $borrar_mensajes = $conex->prepare("DELETE FROM mensajes WHERE id_usuario = ?");
   $borrar_mensajes->execute([$borrar_id]);
   $borrar_cesta = $conex->prepare("DELETE FROM cesta WHERE id_usuario = ?");
   $borrar_cesta->execute([$borrar_id]);
   header('location:cuentas_usuarios.php');
}

/*bajas lógicas*/
if(isset($_GET['baja'])){
   $baja_id = $_GET['baja'];
   $baja=false;
   $baja_usuario = $conex->prepare("UPDATE usuarios SET estatus = ? WHERE id = ?");
   $baja_usuario->execute([$baja, $baja_id]);
   header('location:cuentas_usuarios.php');
}

if(isset($_GET['reactivar'])){
   $alta_id = $_GET['reactivar'];
   $alta=true;
   $alta_usuario = $conex->prepare("UPDATE usuarios SET estatus = ? WHERE id = ?");
   $alta_usuario->execute([$alta, $alta_id]);
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

   <div class="box">
      <p>Añadir nuevo usuario</p>
      <a href="registrar_usuario.php" class="option-btn">registrar usuario</a>
   </div>

   <?php
      $cuentas_usuarios = $conex->prepare("SELECT * FROM usuarios ");
      $cuentas_usuarios->execute();
      if($cuentas_usuarios->rowCount() > 0){
         while($fetch_cuentas_usuarios = $cuentas_usuarios->fetch(PDO::FETCH_ASSOC)){   
   ?>
   <div class="box" style="background-color:<?php if($fetch_cuentas_usuarios['estatus'] == '0'){ echo 'yellow'; }; ?>">
      <p> id usuario : <span><?= $fetch_cuentas_usuarios['id']; ?></span> </p>
      <p> nombre usuario : <span><?= $fetch_cuentas_usuarios['nombre']; ?></span> </p>
      <p> email : <span><?= $fetch_cuentas_usuarios['email']; ?></span> </p>
      <p>estatus: <span style="color:<?php if($fetch_cuentas_usuarios['estatus'] == '0'){ echo 'red'; }else{ echo 'green'; }; ?>">
      <?php if($fetch_cuentas_usuarios['estatus'] == '0'){ echo 'Usuario inactivo'; }else{ echo 'Usuario activo'; }; ?></span> </p>
      <div class="flex-boton">
         <a href="actualizar_usuario.php?actualizar=<?= $fetch_cuentas_usuarios['id']; ?>" class="option-btn">editar</a>
         <a href="cuentas_usuarios.php?baja=<?= $fetch_cuentas_usuarios['id']; ?>" onclick="return confirm('¿Quiere dar de baja esta cuenta?')" class="delete-btn">baja</a>
      </div>
      <div class="flex-btn">
         <a href="cuentas_usuarios.php?reactivar=<?= $fetch_cuentas_usuarios['id']; ?>" onclick="return confirm('¿Quiere reactivar esta cuenta?')" class="update-btn">reactivar</a>
      </div>
      
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