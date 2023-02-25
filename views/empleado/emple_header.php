<?php
   if(isset($mensaje)){
      foreach($mensaje as $mensaje){
         echo '
         <div class="mensaje">
            <span>'.$mensaje.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<header class="header">

   <section class="flex">

      <a href="../empleado/panel_control_emp.php" class="logo">Panel<span>Editor</span></a>

      <nav class="navbar">
         <a href="../empleado/panel_control_emp.php">home</a>
         <a href="../empleado/catalogo_emple.php">productos</a>
         <a href="../empleado/pedidos_realizados.php">pedidos</a>
         <a href="../empleado/mensajes.php">mensajes</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conex->prepare("SELECT * FROM administradores WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile['nombre']; ?></p>
         <a href="../empleado/editar_perfil_emple.php" class="btn">editar perfil</a>
         <div class="flex-btn"></div>
         <a href="../views/empleado/emple_logout.php" class="delete-btn" onclick="return confirm('¿Quiere salir de la web?');">salir</a> 
      </div>

   </section>

</header>