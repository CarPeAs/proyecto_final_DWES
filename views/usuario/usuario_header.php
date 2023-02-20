<?php
   if(isset($mensaje)){
      foreach($mensaje as $mensaje){
         echo '
         <div class="message">
            <span>'.$mensaje.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<header class="header">

   <section class="flex">

      <a href="home.php" class="logo">DWES<span>.</span></a>

      <nav class="navbar">
         <a href="index.php">Inicio</a>
         <!--<a href="about.php">about</a>-->
         <a href="pedidos.php">pedidos</a>
         <a href="shop.php">comprar</a>
         <a href="contacto.php">contacto</a>
      </nav>

      <div class="icons">
         <?php
            $articulos_cesta = $conex->prepare("SELECT * FROM cesta WHERE id_usuario = ?");
            $articulos_cesta->execute([$id_usuario]);
            $total_articulos_cesta = $articulos_cesta->rowCount();
         ?>
         <div id="menu-btn" class="fas fa-bars"></div>
         <a href="search_page.php"><i class="fas fa-search"></i></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_articulos_cesta; ?>)</span></a>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php          
            $selec_usuario = $conex->prepare("SELECT * FROM usuarios WHERE id = ?");
            $selec_usuario->execute([$id_usuario]);
            if($selec_usuario->rowCount() > 0){
            $fetch_usuario = $selec_usuario->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_usuario["nombre"]; ?></p>
         <a href="editar_usuario.php" class="btn">actualizar datos</a>
         <a href="usuario_logout.php" class="delete-btn" onclick="return confirm('¿Quieres salir de la web?');">salir</a> 
         <?php
            }else{
         ?>
         <p>por favor accede o registrate primero!</p>
         <div class="flex-btn">
            <a href="registro_usuario.php" class="option-btn">registro</a>
            <a href="usuario_login.php" class="option-btn">acceso</a>
         </div>
         <?php
            }
         ?>      
         
         
      </div>

   </section>

</header>