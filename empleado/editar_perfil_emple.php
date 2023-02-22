<?php

include '../config/conectar_bd.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['enviar'])){

   $name = $_POST['nombre'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);

   $update_profile_name = $conex->prepare("UPDATE administradores SET nombre = ? WHERE id = ?");
   $update_profile_name->execute([$name, $admin_id]);

   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $prev_pass = $_POST['prev_pass'];
   $old_pass = sha1($_POST['old_pass']);
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
   $new_pass = sha1($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $confirm_pass = sha1($_POST['confirm_pass']);
   $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

   if($old_pass == $empty_pass){
      $mensaje[] = 'por favot introduzca la antigua contraseña!';
   }elseif($old_pass != $prev_pass){
      $mensaje[] = 'no coincide con la antigua contraseña!';
   }elseif($new_pass != $confirm_pass){
      $mensaje[] = 'la confirmación de la contraseña no es correcta!';
   }else{
      if($new_pass != $empty_pass){
         $update_admin_pass = $conex->prepare("UPDATE administradores SET clave = ? WHERE id = ?");
         $update_admin_pass->execute([$confirm_pass, $admin_id]);
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

<?php include '../views/empleado/emple_header.php'; ?>

<section class="form-container">

   <form action="" method="post">
      <h3>actualizar perfil</h3>
      <input type="hidden" name="prev_pass" value="<?= $fetch_profile['clave']; ?>">
      <input type="text" name="nombre" value="<?= $fetch_profile['nombre']; ?>" required placeholder="enter your username" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="old_pass" placeholder="introduzca antigua contraseña" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="new_pass" placeholder="introduzca nueva contraseña" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="confirm_pass" placeholder="confirma nueva contraseña" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="editar" class="btn" name="enviar">
   </form>

</section>












<script src="../js/admin_script.js"></script>
   
</body>
</html>