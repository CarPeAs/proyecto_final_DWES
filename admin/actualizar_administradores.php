<?php

include '../config/conectar_bd.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['editar'])){
    $id_usuario = $_POST['id_usuario'];
   $nombre = $_POST['nombre'];
   $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);

   $editar_perfil = $conex->prepare("UPDATE administradores SET nombre = ? WHERE id = ?");
   $editar_perfil->execute([$nombre, $id_usuario]);
   $mensaje[] = 'nombre actualizado correctamente';

   $pass_vacio = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   /*esto es para reforzar que no dejen en blanco el apartado*/
   $pass_nuevo = sha1($_POST['pass_nuevo']);
   $pass_nuevo = filter_var($pass_nuevo, FILTER_SANITIZE_STRING);
   $cpass_nuevo = sha1($_POST['cpass_nuevo']);
   $cpass_nuevo = filter_var($cpass_nuevo, FILTER_SANITIZE_STRING);

   if($pass_nuevo != $cpass_nuevo){
    $mensaje[] = 'La confirmación de contraseña no coincide!';
   }else{
    if($pass_nuevo != $pass_vacio){
        $actualizar_pass = $conex->prepare("UPDATE administradores SET clave = ? WHERE id = ?");
        $actualizar_pass->execute([$cpass_nuevo, $id_usuario]);
        $mensaje[] = 'contraseña actualizada correctamente!';
     }else{
        $mensaje[] = 'por favor introduce una nueva contraseña!';
     }
   }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>actualizar</title>
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   
   <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
   
<?php include '../views/admin/admin_header.php'; ?>

<section class="form-container">

    <?php
      $id = $_GET['actualizar'];
      $selecc_perfil = $conex->prepare("SELECT * FROM administradores WHERE id = ?");
      $selecc_perfil->execute([$id]);
      if($selecc_perfil->rowCount() > 0){
         while($fetch_perfil = $selecc_perfil->fetch(PDO::FETCH_ASSOC)){
            if($fetch_perfil["rol"]=='editor'){
   ?>

   <form action="" method="post" >
   <h3>Actualizar datos empleado</h3>
      <input type="hidden" name="id_usuario" value="<?= $fetch_perfil['id']; ?>">
      
      <input type="text" name="nombre" required placeholder="nombre usuario" maxlength="20"  class="box" value="<?= $fetch_perfil["nombre"]; ?>">
      <input type="password" name="pass_nuevo" placeholder="nueva contraseña" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')"><!--para elminar los espacios en blanco y no me de errores-->
      <input type="password" name="cpass_nuevo" placeholder="repita nueva contraseña" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      
      <div class="flex-btn">
         <input type="submit" name="editar" class="btn" value="editar">
         <a href="cuentas_empleados.php" class="option-btn">regresar</a>
      </div>
   </form>

   <?php
            }else{
    ?>

    <form action="" method="post" >
   <h3>Actualizar datos administrador</h3>
      <input type="hidden" name="id_usuario" value="<?= $fetch_perfil['id']; ?>">
      
      <input type="text" name="nombre" required placeholder="nombre usuario" maxlength="20"  class="box" value="<?= $fetch_perfil["nombre"]; ?>">
      <input type="password" name="pass_nuevo" placeholder="nueva contraseña" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass_nuevo" placeholder="repita nueva contraseña" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      
      <div class="flex-btn">
         <input type="submit" name="editar" class="btn" value="editar">
         <a href="cuentas_admin.php" class="option-btn">regresar</a>
      </div>
   </form>  
            
    <?php }
         }
      }else{
         echo '<p class="empty">No se ha encontrado ningún usuario</p>';
      }
   ?>


</section>



<script src="../js/admin_script.js"></script>

</body>
</html>