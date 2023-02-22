<?php

include '../config/conectar_bd.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>panel control</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../views/admin/admin_header.php'; ?>

<section class="dashboard">

   <h1 class="heading">panel de control</h1>

   <div class="box-container">

      <div class="box">
         <h3>Bienvenido(a)</h3>
         <p><?= $fetch_perfil['nombre']; ?></p>
         <a href="editar_perfil_admin.php" class="btn">actualizar perfil</a>
      </div>

      <div class="box">
         <?php
            $total_pendings = 0;
            $select_pendings = $conex->prepare("SELECT * FROM pedidos WHERE estatus_pago = ?");
            $select_pendings->execute(['pendiente']);
            if($select_pendings->rowCount() > 0){
               while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
                  $total_pendings += $fetch_pendings['precio_total'];
               }
            }
         ?>
         <h3><span>€</span><?= $total_pendings; ?><span>/-</span></h3>
         <p>total pendientes</p>
         <a href="pedidos_realizados.php" class="btn">ver pedidos</a>
      </div>

      <div class="box">
         <?php
            $total_completes = 0;
            $select_completes = $conex->prepare("SELECT * FROM pedidos WHERE estatus_pago = ?");
            $select_completes->execute(['completado']);
            if($select_completes->rowCount() > 0){
               while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
                  $total_completes += $fetch_completes['precio_total'];
               }
            }
         ?>
         <h3><span>€</span><?= $total_completes; ?><span>/-</span></h3>
         <p>pedidos finalizados</p>
         <a href="pedidos_realizados.php" class="btn">ver pedidos</a>
      </div>

      <div class="box">
         <?php
            $select_orders = $conex->prepare("SELECT * FROM pedidos ");
            $select_orders->execute();
            $number_of_orders = $select_orders->rowCount()
         ?>
         <h3><?= $number_of_orders; ?></h3>
         <p>pedidos realizados</p>
         <a href="pedidos_realizados.php" class="btn">ver pedidos</a>
      </div>

      <div class="box">
         <?php
            $select_products = $conex->prepare("SELECT * FROM articulos ");
            $select_products->execute();
            $number_of_products = $select_products->rowCount()
         ?>
         <h3><?= $number_of_products; ?></h3>
         <p>productos añadidos</p>
         <a href="catalogo_admin.php" class="btn">ver productos</a>
      </div>

      <div class="box">
         <?php
            $select_users = $conex->prepare("SELECT * FROM usuarios ");
            $select_users->execute();
            $number_of_users = $select_users->rowCount()
         ?>
         <h3><?= $number_of_users; ?></h3>
         <p>listado usuarios</p>
         <a href="cuentas_usuarios.php" class="btn">ver usuarios</a>
      </div>

      <div class="box">
         <?php
            $select_admins = $conex->prepare("SELECT * FROM administradores WHERE rol='admin'");
            $select_admins->execute();
            $number_of_admins = $select_admins->rowCount()
         ?>
         <h3><?= $number_of_admins; ?></h3>
         <p>listado administradores</p>
         <a href="cuentas_admin.php" class="btn">ver administradores</a>
      </div>

      <div class="box">
         <?php
            $select_messages = $conex->prepare("SELECT * FROM mensajes ");
            $select_messages->execute();
            $number_of_messages = $select_messages->rowCount()
         ?>
         <h3><?= $number_of_messages; ?></h3>
         <p>nuevos mensajes</p>
         <a href="mensajes.php" class="btn">ver mensajes</a>
      </div>

      <div class="box">
         <?php
            $select_admins = $conex->prepare("SELECT * FROM administradores WHERE rol='editor'");
            $select_admins->execute();
            $number_of_admins = $select_admins->rowCount()
         ?>
         <h3><?= $number_of_admins; ?></h3>
         <p>listado empleados</p>
         <a href="cuentas_empleados.php" class="btn">ver empleados</a>
      </div>
   </div>

</section>












<script src="../js/admin_script.js"></script>
   
</body>
</html>