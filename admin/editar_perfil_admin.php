<?php

include '../config/conectar_bd.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['editar'])){

   $nombre = $_POST['nombre'];
   $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);

   $editar_nombre = $conex->prepare("UPDATE administradores SET nombre = ? WHERE id = ?");
   $editar_nombre->execute([$nombre, $admin_id]);

   $pass_vacio = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $pass_previo = $_POST['prev_pass'];
   $pass_antiguo = sha1($_POST['old_pass']);
   $pass_antiguo = filter_var($pass_antiguo, FILTER_SANITIZE_STRING);
   $pass_nuevo = sha1($_POST['new_pass']);
   $pass_nuevo = filter_var($pass_nuevo, FILTER_SANITIZE_STRING);
   $confirm_pass = sha1($_POST['confirm_pass']);
   $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

   if($pass_antiguo == $pass_vacio){
      $mensaje[] = 'por favot introduzca la antigua contraseña!';
   }elseif($pass_antiguo != $pass_previo){
      $mensaje[] = 'no coincide con la antigua contraseña!';
   }elseif($pass_nuevo != $confirm_pass){
      $mensaje[] = 'la confirmación de la contraseña no es correcta!';
   }else{
      if($pass_nuevo != $pass_vacio){
         $editar_admin_pass = $conex->prepare("UPDATE administradores SET clave = ? WHERE id = ?");
         $editar_admin_pass->execute([$confirm_pass, $admin_id]);
         $mensaje[] = 'contraseña actualizada correctamente!';
      }else{
         $mensaje[] = 'por favor introduzca una nueva contraseña!';
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
   <title>editar administrador</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../views/admin/admin_header.php'; ?>

<section class="form-container">

   <form action="" method="post">
      <h3>actualizar perfil</h3>
      <input type="hidden" name="prev_pass" value="<?= $fetch_perfil['clave']; ?>">
      <input type="text" name="nombre" value="<?= $fetch_perfil['nombre']; ?>" required placeholder="enter your username" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="old_pass" placeholder="introduzca antigua contraseña" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="new_pass" placeholder="introduzca nueva contraseña" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="confirm_pass" placeholder="confirma nueva contraseña" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="editar" class="btn" name="editar">
   </form>

</section>












<script src="../js/admin_script.js"></script>
   
</body>
</html>