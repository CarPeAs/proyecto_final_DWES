<?php

include 'config/conectar_bd.php';

session_start();

if(isset($_SESSION['id_usuario'])){
   $id_usuario = $_SESSION['id_usuario'];
}else{
   $id_usuario = '';
   header('location:usuario_login.php');
};

if(isset($_POST['borrar'])){
   $id_cesta = $_POST['id_cesta'];
   $borrar_de_cesta = $conex->prepare("DELETE FROM cesta WHERE id = ?");
   $borrar_de_cesta->execute([$id_cesta]);
}

if(isset($_GET['borrar_todo'])){
   $borrar_de_cesta = $conex->prepare("DELETE FROM cesta WHERE id_usuario = ?");
   $borrar_de_cesta->execute([$id_usuario]);
   header('location:cesta.php');
}

if(isset($_POST['actualizar_cantidad'])){
   $id_cesta = $_POST['id_cesta'];
   $cantidad = $_POST['cantidad'];
   $cantidad = filter_var($cantidad, FILTER_SANITIZE_STRING);
   $editar_cantidad = $conex->prepare("UPDATE cesta SET cantidad = ? WHERE id = ?");
   $editar_cantidad->execute([$cantidad, $id_cesta]);
   $mensaje[] = 'cantidad de la cesta actualizada';
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

   <h3 class="heading">cesta de la compra</h3>

   <div class="box-container">

   <?php
      $total_compra = 0;
      $selecc_cesta = $conex->prepare("SELECT * FROM cesta WHERE id_usuario = ?");
      $selecc_cesta->execute([$id_usuario]);
      if($selecc_cesta->rowCount() > 0){
         while($fetch_cesta = $selecc_cesta->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="id_cesta" value="<?= $fetch_cesta['id']; ?>">
      
      <img src="img_catalogo/<?= $fetch_cesta['imagen']; ?>" alt="">
      <div class="name"><?= $fetch_cesta['nombre']; ?></div>
      <div class="flex">
         <div class="price">€<?= $fetch_cesta['precio']; ?>/-</div>
         <input type="number" name="cantidad" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="<?= $fetch_cesta['cantidad']; ?>">
         <button type="submit" class="fas fa-edit" name="actualizar_cantidad"></button>
      </div>
      <div class="sub-total"> Sub total : <span>€<?= $sub_total = ($fetch_cesta['precio'] * $fetch_cesta['cantidad']); ?>/-</span> </div>
      <input type="submit" value="eliminar producto" onclick="return confirm('¿Quieres eliminar este producto de la cesta?');" class="delete-btn" name="borrar">
   </form>
   <?php
   $total_compra += $sub_total;
      }
   }else{
      echo '<p class="empty">tu carro esta vacio</p>';
   }
   ?>
   </div>

   <div class="cart-total">
      <p>Total : <span>€<?= $total_compra; ?>/-</span></p>
      <a href="catalogo.php" class="option-btn">continuar comprando</a>
      <a href="cesta.php?borrar_todo" class="delete-btn <?= ($total_compra > 1)?'':'disabled'; ?>" onclick="return confirm('¿Quiere eliminar todos los articulos de la cesta?');">borrar todos los artículos</a>
      <a href="confirmar_compra.php" class="btn <?= ($total_compra > 1)?'':'disabled'; ?>">proceder a la compra</a>
   </div>

</section>













<?php include 'views/usuario/usuario_footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>