<?php

include 'config/conectar_bd.php';

session_start();

if(isset($_SESSION['user_id'])){
   $id_usuario = $_SESSION['user_id'];
}else{
   $id_usuario = '';
   header('location:usuario_login.php');
};

if(isset($_POST['borrar'])){
   $cart_id = $_POST['cart_id'];
   $delete_cart_item = $conex->prepare("DELETE FROM cesta WHERE id = ?");
   $delete_cart_item->execute([$cart_id]);
}

if(isset($_GET['borrar_todo'])){
   $delete_cart_item = $conex->prepare("DELETE FROM cesta WHERE id_usuario = ?");
   $delete_cart_item->execute([$id_usuario]);
   header('location:cart.php');
}

if(isset($_POST['actualizar_cantidad'])){
   $cart_id = $_POST['cart_id'];
   $qty = $_POST['cantidad'];
   $qty = filter_var($qty, FILTER_SANITIZE_STRING);
   $update_qty = $conex->prepare("UPDATE cesta SET cantidad = ? WHERE id = ?");
   $update_qty->execute([$qty, $cart_id]);
   $message[] = 'cantidad del carrito actualizada';
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>cesta compra</title>
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'views/usuario/usuario_header.php'; ?>

<section class="products shopping-cart">

   <h3 class="heading">carro de la compra</h3>

   <div class="box-container">

   <?php
      $grand_total = 0;
      $select_cart = $conex->prepare("SELECT * FROM cesta WHERE id_usuario = ?");
      $select_cart->execute([$id_usuario]);
      if($select_cart->rowCount() > 0){
         while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
      <a href="quick_view.php?pid=<?= $fetch_cart['id_pedido']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_cart['imagen']; ?>" alt="">
      <div class="name"><?= $fetch_cart['nombre']; ?></div>
      <div class="flex">
         <div class="price">€<?= $fetch_cart['precio']; ?>/-</div>
         <input type="number" name="cantidad" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="<?= $fetch_cart['cantidad']; ?>">
         <button type="submit" class="fas fa-edit" name="actualizar_cantidad"></button>
      </div>
      <div class="sub-total"> Sub total : <span>€<?= $sub_total = ($fetch_cart['precio'] * $fetch_cart['cantidad']); ?>/-</span> </div>
      <input type="submit" value="eliminar producto" onclick="return confirm('¿Quieres eliminar este producto de la cesta?');" class="delete-btn" name="borrar">
   </form>
   <?php
   $grand_total += $sub_total;
      }
   }else{
      echo '<p class="empty">tu carro esta vacio</p>';
   }
   ?>
   </div>

   <div class="cart-total">
      <p>total : <span>€<?= $grand_total; ?>/-</span></p>
      <a href="catalogo.php" class="option-btn">continuar comprando</a>
      <a href="cesta.php?borrar_todo" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('¿Quiere eliminar todos los articulos de la cesta?');">borrar todos los artículos</a>
      <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">proceder a la compra</a>
   </div>

</section>













<?php include 'views/usuario/usuario_footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>