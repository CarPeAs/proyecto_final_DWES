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

<?php include '../views/empleado/emple_header.php'; ?>

<section class="dashboard">

   <h1 class="heading">panel de control</h1>

   <div class="box-container">

      <div class="box">
         <h3>Bienvenido(a)</h3>
         <p><?= $fetch_profile['nombre']; ?></p>
         <a href="editar_perfil_emple.php" class="btn">actualizar perfil</a>
      </div>

      <div class="box">
         <?php
            $total_pendientes = 0;
            $selecc_pendientes = $conex->prepare("SELECT * FROM pedidos WHERE estatus_pago = ?");
            $selecc_pendientes->execute(['pendiente']);
            if($selecc_pendientes->rowCount() > 0){
               while($fetch_pendientes = $selecc_pendientes->fetch(PDO::FETCH_ASSOC)){
                  $total_pendientes += $fetch_pendientes['precio_total'];
               }
            }
         ?>
         <h3><span>€</span><?= $total_pendientes; ?><span>/-</span></h3>
         <p>total pendientes</p>
         <a href="pedidos_realizados.php" class="btn">ver pedidos</a>
      </div>

      <div class="box">
         <?php
            $total_completados = 0;
            $selecc_completados = $conex->prepare("SELECT * FROM pedidos WHERE estatus_pago = ? ");
            $selecc_completados->execute(['completado']);
            if($selecc_completados->rowCount() > 0){
               while($fetch_completado = $selecc_completados->fetch(PDO::FETCH_ASSOC)){
                  $total_completados += $fetch_completado['precio_total'];
               }
            }
         ?>
         <h3><span>€</span><?= $total_completados; ?><span>/-</span></h3>
         <p>historico pedidos finalizados</p>
         <a href="pedidos_realizados.php" class="btn">ver pedidos</a>
      </div>

      <div class="box">
         <?php
            $selecc_pedidos = $conex->prepare("SELECT * FROM pedidos ");
            $selecc_pedidos->execute();
            $numero_pedidos = $selecc_pedidos->rowCount()
         ?>
         <h3><?= $numero_pedidos; ?></h3>
         <p>historico pedidos totales realizados</p>
         <a href="pedidos_realizados.php" class="btn">ver pedidos</a>
      </div>


      <div class="box">
         <?php
            $selecc_articulos = $conex->prepare("SELECT * FROM articulos ");
            $selecc_articulos->execute();
            $numero_articulos = $selecc_articulos->rowCount()
         ?>
         <h3><?= $numero_articulos; ?></h3>
         <p>productos añadidos</p>
         <a href="catalogo_emple.php" class="btn">ver productos</a>
      </div>


      <div class="box">
         <?php
            $selecc_mensajes = $conex->prepare("SELECT * FROM mensajes WHERE borrado = 1");
            $selecc_mensajes->execute();
            $numero_mensajes = $selecc_mensajes->rowCount()
         ?>
         <h3><?= $numero_mensajes; ?></h3>
         <p>nuevos mensajes</p>
         <a href="mensajes.php" class="btn">ver mensajes</a>
      </div>

   
   </div>

</section>












<script src="../js/admin_script.js"></script>
   
</body>
</html>