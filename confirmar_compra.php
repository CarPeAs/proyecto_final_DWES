<?php

include 'config/conectar_bd.php';
require_once('vendor/stripe/stripe-php/init.php');



session_start();

if(isset($_SESSION['id_usuario'])){
   $id_usuario = $_SESSION['id_usuario'];
}else{
   $id_usuario = '';
   header('location:usuario_login.php');
};

if(isset($_POST['pedido'])){

   $nombre = $_POST['nombre'];
   $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
   $telefono = $_POST['telefono'];
   $telefono = filter_var($telefono, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $metodo_pago = $_POST['metodo_pago'];
   $metodo_pago = filter_var($metodo_pago, FILTER_SANITIZE_STRING);
   $domicilio =  $_POST['piso'] .', '. $_POST['calle'] .', '. $_POST['ciudad'] .', '. $_POST['provincia'] .', '. $_POST['pais'] .' - '. $_POST['cd_postal'];
   $domicilio = filter_var($domicilio, FILTER_SANITIZE_STRING);
   $total_productos = $_POST['total_productos'];
   $total_precio = $_POST['total_precio'];

   $articulos_cesta = $conex->prepare("SELECT * FROM cesta WHERE id_usuario = ?");
   $articulos_cesta->execute([$id_usuario]);

   if($articulos_cesta->rowCount() > 0){

      $realizar_pedido = $conex->prepare("INSERT INTO pedidos (nombre, direccion, email, metodo_pago, numero, precio_total,  total_articulos, id_usuario ) VALUES(?,?,?,?,?,?,?,?)");
      $realizar_pedido->execute([$nombre, $domicilio, $email, $metodo_pago, $telefono, $total_precio, $total_productos, $id_usuario]);

      $vaciar_cesta = $conex->prepare("DELETE FROM cesta WHERE id_usuario = ?");
      $vaciar_cesta->execute([$id_usuario]);

      $mensaje[] = 'pedido realizado con éxito!';
      header('refresh:2;location:index.php');
   }else{
      $mensaje[] = 'tu carro esta vacio';
   }

}

?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>comprobación</title>
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'views/usuario/usuario_header.php'; ?>

<section class="checkout-orders">

   <form action="" method="POST">

   <h3>sus pedidos</h3>

      <div class="display-orders">
      <?php
         $total = 0;
         $articulos_cesta = '';
         $selecc_cesta = $conex->prepare("SELECT * FROM cesta WHERE id_usuario = ?");
         $selecc_cesta->execute([$id_usuario]);
         if($selecc_cesta->rowCount() > 0){
            while($fetch_cesta = $selecc_cesta->fetch(PDO::FETCH_ASSOC)){
               $articulos_cesta = $fetch_cesta['nombre'].' ('.$fetch_cesta['precio'].' x '. $fetch_cesta['cantidad'].') - ';
               $total_articulos = $articulos_cesta;
               $total += ($fetch_cesta['precio'] * $fetch_cesta['cantidad']);
      ?>
         <p> <?= $fetch_cesta['nombre']; ?> <span>(<?= '€'.$fetch_cesta['precio'].'/- x '. $fetch_cesta['cantidad']; ?>)</span> </p>
      <?php
            }
         }else{
            echo '<p class="empty">¡su cesta está vacía!</p>';
         }
      ?>
         <input type="hidden" name="total_productos" value="<?= $total_articulos; ?>">
         <input type="hidden" name="total_precio" value="<?= $total; ?>" value="">
         <div class="grand-total">Total : <span>€<?= $total; ?>/-</span></div>
      </div>

      <h3>realice sus pedidos</h3>

      <div class="flex">
         <div class="inputBox">
            <span>tu nombre :</span>
            <input type="text" name="nombre" placeholder="introduce tu nombre" class="box" maxlength="20" required>
         </div>
         <div class="inputBox">
            <span>tu numero :</span>
            <input type="number" name="telefono" placeholder="introduce tu numero" class="box" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;" required>
         </div>
         <div class="inputBox">
            <span>tu email :</span>
            <input type="email" name="email" placeholder="introduce tu email" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>metodo de pago :</span>
            <select name="metodo_pago" class="box" required>
               <option value="pago contra reembolso">efectivo</option>
               <option value="tarjeta de credito">tarjeta de credito</option>
               <option value="paypal">paypal</option>
            </select>
         </div>
         <div class="inputBox">
            <span>dirección línea 01 :</span>
            <input type="text" name="piso" placeholder="e.g. planta baja" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>dirección línea 02 :</span>
            <input type="text" name="calle" placeholder="e.g. Carrer Illueca, 28" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>ciudad :</span>
            <input type="text" name="ciudad" placeholder="e.g. elche" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>provincia :</span>
            <input type="text" name="provincia" placeholder="e.g. alicante" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>pais :</span>
            <input type="text" name="pais" placeholder="e.g. España" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>codigo postal :</span>
            <input type="number" min="0" name="cd_postal" placeholder="e.g. 03206" min="0" max="999999" onkeypress="if(this.value.length == 6) return false;" class="box" required>
         </div>
      </div>

      <input type="submit" name="pedido" class="btn <?= ($total > 1)?'':'disabled'; ?>" value="realizar pedido">

   </form>

</section>













<?php include 'views/usuario/usuario_footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>