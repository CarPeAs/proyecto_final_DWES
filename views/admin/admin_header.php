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

      <a href="../admin/panel_control.php" class="logo">Panel<span>Admin</span></a>

      <nav class="navbar">
         <a href="../admin/panel_control.php">home</a>
         <a href="../admin/catalogo_admin.php">productos</a>
         <a href="../admin/pedidos_realizados.php">pedidos</a>
         <a href="../admin/cuentas_admin.php">administradores</a>
         <a href="../admin/cuentas_empleados.php">empleados</a>
         <a href="../admin/cuentas_usuarios.php">usuarios</a>
         <a href="../admin/mensajes.php">mensajes</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
            $selecc_perfil = $conex->prepare("SELECT * FROM administradores WHERE id = ?");
            $selecc_perfil->execute([$admin_id]);
            $fetch_perfil = $selecc_perfil->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_perfil['nombre']; ?></p>
         <a href="../admin/editar_perfil_admin.php" class="btn">editar perfil</a>
         <div class="flex-btn">
            <!--<a href="../admin/register_admin.php" class="option-btn">registrar</a>
            <a href="../admin/admin_login.php" class="option-btn">acceder</a>-->
         </div>
         <a href="../views/admin/admin_logout.php" class="delete-btn" onclick="return confirm('¿Quiere salir de la web?');">salir</a> 
      </div>

   </section>

</header>