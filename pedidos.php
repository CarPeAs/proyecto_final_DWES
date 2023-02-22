<?php

include 'config/conectar_bd.php';

session_start();

if(isset($_SESSION['user_id'])){
   $id_usuario = $_SESSION['user_id'];
}else{
   $id_usuario = '';
};

?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>pedidos</title>
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'views/usuario/usuario_header.php'; ?>

<section class="orders">

   <h1 class="heading">pedidos realizados</h1>

   <div class="box-container">

   <?php
      if($id_usuario == ''){
         echo '<p class="empty">inicie sesión para ver sus pedidos</p>';
      }else{
         $selecc_pedidos = $conex->prepare("SELECT * FROM pedidos WHERE id_usuario = ?");
         $selecc_pedidos->execute([$id_usuario]);
         if($selecc_pedidos->rowCount() > 0){
            while($fetch_pedidos = $selecc_pedidos->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p>fecha pedido : <span><?= $fetch_pedidos['fecha_pedido']; ?></span></p>
      <p>nombre : <span><?= $fetch_pedidos['nombre']; ?></span></p>
      <p>email : <span><?= $fetch_pedidos['email']; ?></span></p>
      <p>numero : <span><?= $fetch_pedidos['numero']; ?></span></p>
      <p>dirección : <span><?= $fetch_pedidos['direccion']; ?></span></p>
      <p>metodo de pago: <span><?= $fetch_pedidos['metodo_pago']; ?></span></p>
      <p>sus pedidos : <span><?= $fetch_pedidos['total_articulos']; ?></span></p>
      <p>precio total : <span>€<?= $fetch_pedidos['precio_total']; ?>/-</span></p>
      <p>estatus de pago: <span style="color:<?php if($fetch_pedidos['estatus_pago'] == 'pendiente'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_pedidos['estatus_pago']; ?></span> </p>
   </div>
   <?php
      }
      }else{
         echo '<p class="empty">aún no se han realizado pedidos!</p>';
      }
      }
   ?>

   </div>

</section>













<?php include 'views/usuario/usuario_footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>