<?php

include '../config/conectar_bd.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['borrar'])){
   $borrar_id = $_GET['borrar'];
   $borrar_empleados = $conex->prepare("DELETE FROM administradores WHERE id = ?");
   $borrar_empleados->execute([$borrar_id]);
   header('location:cuentas_empleados.php');
}

if(isset($_GET['baja'])){
   $baja_id = $_GET['baja'];
   $baja=0;
   $baja_empleados = $conex->prepare("UPDATE administradores SET estatus = ? WHERE id = ?");
   $baja_empleados->execute([$baja, $baja_id]);
   header('location:cuentas_empleados.php');
}

if(isset($_GET['reactivar'])){
   $alta_id = $_GET['reactivar'];
   $alta=1;
   $alta_empleados = $conex->prepare("UPDATE administradores SET estatus = ? WHERE id = ?");
   $alta_empleados->execute([$alta, $alta_id]);
   header('location:cuentas_empleados.php');
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

   <h1 class="heading">cuentas empleados</h1>

   <div class="box-container">

   <div class="box">
      <p>Añadir nuevo empleado/editor</p>
      <a href="registrar_empleado.php" class="option-btn">registrar empleado</a>
   </div>

   <?php
      $selecc_empleados = $conex->prepare("SELECT * FROM administradores WHERE rol='editor'");
      $selecc_empleados->execute();
      if($selecc_empleados->rowCount() > 0){
         while($fetch_empleados = $selecc_empleados->fetch(PDO::FETCH_ASSOC)){   
   ?>
   <div class="box" style="background-color:<?php if($fetch_empleados['estatus'] == '0'){ echo 'yellow'; }; ?>">
      <p> id empleado : <span><?= $fetch_empleados['id']; ?></span> </p>
      <p> nombre empleado : <span><?= $fetch_empleados['nombre']; ?></span> </p>
      <p> estatus: <span style="color:<?php if($fetch_empleados['estatus'] == '0'){ echo 'red'; }else{ echo 'green'; }; ?>">
      <?php if($fetch_empleados['estatus'] == '0'){ echo 'Empleado inactivo'; }else{ echo 'Empleado activo'; }; ?></span> </p>
      <div class="flex-btn">
         <a href="actualizar_administradores.php?actualizar=<?= $fetch_empleados['id']; ?>" class="option-btn">editar</a>
         <a href="cuentas_empleados.php?baja=<?= $fetch_empleados['id']; ?>" class="delete-btn" onclick="return confirm('¿Quiere dar de baja a este empleado/editor?');">baja</a>
      </div>
      <div class="flex-btn">
      <a href="cuentas_empleados.php?reactivar=<?= $fetch_empleados['id']; ?>" onclick="return confirm('¿Quiere reactivar esta cuenta?')" class="update-btn">reactivar</a>
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