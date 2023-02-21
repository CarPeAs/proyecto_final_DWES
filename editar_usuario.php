<?php

include 'config/conectar_bd.php';

if(isset($_SESSION['user_id'])){
    $id_usuario = $_SESSION['user_id'];
}else{
   $id_usuario = '';
};

if(isset($_POST['enviar'])){

   $nombre = $_POST['nombre'];
   $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_EMAIL);

   $editar_perfil = $conex->prepare("UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?");
   $editar_perfil->execute([$nombre, $email, $id_usuario]);

   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $pass_previo = $_POST['pass_previo'];
   $pass_antiguo = sha1($_POST['pass_antiguo']);
   $pass_antiguo = filter_var($pass_antiguo, FILTER_SANITIZE_STRING);
   $pass_nuevo = sha1($_POST['pass_nuevo']);
   $pass_nuevo = filter_var($pass_nuevo, FILTER_SANITIZE_STRING);
   $cpass_nuevo = sha1($_POST['cpass_nuevo']);
   $cpass_nuevo = filter_var($cpass_nuevo, FILTER_SANITIZE_STRING);

   if($pass_antiguo == $empty_pass){
      $mensaje[] = 'por favor introduce la antigua contraseña!';
   }elseif($pass_antiguo != $pass_previo){
      $mensaje[] = 'la antigua contraseña no coincide!';
   }elseif($pass_nuevo != $cpass_nuevo){
      $mensaje[] = 'confirmar contraseña no coincidente!';
   }else{
      if($pass_nuevo != $empty_pass){
         $actualizar_pass_usuario = $conex->prepare("UPDATE usuarios SET clave = ? WHERE id = ?");
         $actualizar_pass_usuario->execute([$cpass_nuevo, $id_usuario]);
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
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'views/usuario/usuario_header.php'; ?>

<section class="form-container">

   <form action="" method="post">
      <h3>Actualiza tus datos</h3>
      <input type="hidden" name="pass_previo" value="<?= $fetch_profile["clave"]; ?>">
      <input type="text" name="nombre" required placeholder="enter your username" maxlength="20"  class="box" value="<?= $fetch_profile["nombre"]; ?>">
      <input type="email" name="email" required placeholder="enter your email" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')" value="<?= $fetch_profile["email"]; ?>">
      <input type="password" name="pass_antiguo" placeholder="introduce tu antigua contraseña" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass_nuevo" placeholder="introduce tu nueva contraseña" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass_nuevo" placeholder="repite tu nueva contraseña" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="actualizar" class="btn" name="enviar">
   </form>

</section>













<?php include 'views/usuario/usuario_footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>