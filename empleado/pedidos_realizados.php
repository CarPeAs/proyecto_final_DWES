<?php

include '../config/conectar_bd.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['actualizar_pago'])){
   $pedido_id = $_POST['id_pedido'];
   $estatus_pago = $_POST['estatus_pago'];
   $estatus_pago  = filter_var($estatus_pago , FILTER_SANITIZE_STRING);
   $actualizar_pago = $conex->prepare("UPDATE pedidos SET estatus_pago = ? WHERE id = ?");
   $actualizar_pago->execute([$estatus_pago, $pedido_id]);
   $mensaje[] = 'Estado del pago actualizado';
}

if(isset($_GET['borrar'])){
   $borrar_id = $_GET['borrar'];
   $borrar_pedido = $conex->prepare("DELETE FROM pedidos WHERE id = ?");
   $borrar_pedido->execute([$borrar_id ]);
   header('location:pedidos_realizados.php');
}

if(isset($_GET['baja'])){
   $baja= true;
   $baja_id = $_GET['baja'];
   $baja_pedido = $conex->prepare("UPDATE pedidos SET historial = ? WHERE id = ? ");
   $baja_pedido->execute([$baja, $baja_id]);
   header('location:pedidos_realizados.php');
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>pedidos realizados</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../views/empleado/emple_header.php'; ?>

<section class="orders">

<h1 class="heading">pedidos realizados</h1>

<div class="box-container">

   <?php
      $selecc_pedidos = $conex->prepare("SELECT * FROM pedidos WHERE historial = 0 AND estatus_pago = 'pendiente'");
      $selecc_pedidos->execute();
      if($selecc_pedidos->rowCount() > 0){
         while($fetch_pedidos = $selecc_pedidos->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p> fecha pedido : <span><?= $fetch_pedidos['fecha_pedido']; ?></span> </p>
      <p> nombre : <span><?= $fetch_pedidos['nombre']; ?></span> </p>
      <p> numero : <span><?= $fetch_pedidos['numero']; ?></span> </p>
      <p> dirección : <span><?= $fetch_pedidos['direccion']; ?></span> </p>
      <p> total productos : <span><?= $fetch_pedidos['total_articulos']; ?></span> </p>
      <p> total precio : <span>€<?= $fetch_pedidos['precio_total']; ?>/-</span> </p>
      <p> metodo de pago  : <span><?= $fetch_pedidos['metodo_pago']; ?></span> </p>
      <form action="" method="post">
         <input type="hidden" name="id_pedido" value="<?= $fetch_pedidos['id']; ?>">
         <select name="estatus_pago" class="select">
            <option selected disabled><?= $fetch_pedidos['estatus_pago']; ?></option>
            <option value="pendiente">pendiente</option>
            <option value="completado">completado</option>
         </select>
        <div class="flex-btn">
         <input type="submit" value="editar" class="option-btn" name="actualizar_pago">
         <a href="pedidos_realizados.php?baja=<?= $fetch_pedidos['id']; ?>" class="delete-btn" onclick="return confirm('¿Quiere borrar este pedido?');">borrar</a>
        </div>
      </form>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">aún no se han hecho pedidos</p>';
      }
   ?>

</div>

</section>

</section>












<script src="../js/admin_script.js"></script>
   
</body>
</html>