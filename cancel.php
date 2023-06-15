<?php

include 'config/conectar_bd.php';

session_start();

if(isset($_SESSION['id_usuario'])){
   $id_usuario = $_SESSION['id_usuario'];
}else{
   $id_usuario = '';
   header('location:usuario_login.php');
};

function getOrderId($conex, $id_usuario){
   $ref_pedido = $conex->prepare("SELECT id FROM pedidos WHERE id_usuario = ? AND fecha_pedido = ?");
   $ref_pedido->execute([$id_usuario, date('Y-m-d')]);

      if ($ref_pedido->rowCount() > 0) {
         $row = $ref_pedido->fetch(PDO::FETCH_ASSOC);
         $id_pedido = $row['id'];
         $id_pedido_string = strval($id_pedido);
     }
     return $id_pedido_string;
}

$id_pedido = getOrderId($conex, $id_usuario);


?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Gracias por su pedido</title>
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/main.css">

</head>
<body>
   
<?php include 'views/usuario/usuario_header.php'; ?>

<section class="orders">

   <h1 class="heading">PAGO NO EXITOSO - DATOS PEDIDO</h1>
    <p>Ponganse en contacto con nuestro personal de atención al cliente</p>

   <div class="box-container">

   <?php
      if($id_usuario == ''){
         echo '<p class="empty">inicie sesión para ver sus pedidos</p>';
      }else{
         $selecc_pedido = $conex->prepare("SELECT * FROM pedidos WHERE id = ?");
         $selecc_pedido->execute([$id_pedido]);
         if($selecc_pedido->rowCount() > 0){
            while($fetch_pedido = $selecc_pedido->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p>fecha pedido : <span><?= $fetch_pedido['fecha_pedido']; ?></span></p>
      <p>nombre : <span><?= $fetch_pedido['nombre']; ?></span></p>
      <p>email : <span><?= $fetch_pedido['email']; ?></span></p>
      <p>numero : <span><?= $fetch_pedido['numero']; ?></span></p>
      <p>dirección : <span><?= $fetch_pedido['direccion']; ?></span></p>
      <p>metodo de pago: <span><?= $fetch_pedido['metodo_pago']; ?></span></p>
      <p>sus pedidos : <span><?= $fetch_pedido['total_articulos']; ?></span></p>
      <p>precio total : <span>€<?= $fetch_pedido['precio_total']; ?>/-</span></p>
      <p>estatus de pago: <span style="color:<?php if($fetch_pedido['estatus_pago'] == 'pendiente'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_pedido['estatus_pago']; ?></span> </p>
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