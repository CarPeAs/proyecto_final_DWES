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
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_EMAIL);

   $editar_perfil = $conex->prepare("UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?");
   $editar_perfil->execute([$nombre, $email, $id_usuario]);
   $mensaje[] = 'usuario actualizado correctamente';

   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $pass_nuevo = sha1($_POST['pass_nuevo']);
   $pass_nuevo = filter_var($pass_nuevo, FILTER_SANITIZE_STRING);
   $cpass_nuevo = sha1($_POST['cpass_nuevo']);
   $cpass_nuevo = filter_var($cpass_nuevo, FILTER_SANITIZE_STRING);

   if($pass_nuevo != $cpass_nuevo){
    $mensaje[] = 'La confirmación de contraseña no coincide!';
   }else{
    if($pass_nuevo != $empty_pass){
        $actualizar_pass_usuario = $conex->prepare("UPDATE usuarios SET clave = ? WHERE id = ?");
        $actualizar_pass_usuario->execute([$cpass_nuevo, $id_usuario]);
        $mensaje[] = 'contraseña usuario actualizada correctamente!';
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
      $selecc_usuario = $conex->prepare("SELECT * FROM usuarios WHERE id = ?");
      $selecc_usuario->execute([$id]);
      if($selecc_usuario->rowCount() > 0){
         while($fetch_usuario = $selecc_usuario->fetch(PDO::FETCH_ASSOC)){ 
   ?>

   <form action="" method="post" >
   <h3>Actualizar datos usuario</h3>
      <input type="hidden" name="id_usuario" value="<?= $fetch_usuario['id']; ?>">
      
      <input type="text" name="nombre" required placeholder="nombre usuario" maxlength="20"  class="box" value="<?= $fetch_usuario["nombre"]; ?>">
      <input type="email" name="email" required placeholder="email usuario" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')" value="<?= $fetch_usuario["email"]; ?>">
      <input type="password" name="pass_nuevo" placeholder="nueva contraseña" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass_nuevo" placeholder="repita nueva contraseña" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      
      <div class="flex-btn">
         <input type="submit" name="editar" class="btn" value="editar">
         <a href="cuentas_usuarios.php" class="option-btn">regresar</a>
      </div>
   </form>

   <?php
         }
      }else{
         echo '<p class="empty">No se ha encontrado ningún usuario</p>';
      }
   ?>


</section>



<script src="../js/admin_script.js"></script>

</body>
</html>