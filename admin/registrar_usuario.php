<?php

include '../config/conectar_bd.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['alta'])){

    $nombre = $_POST['nombre'];
    $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    /** Para eliminar todos los caracteres menos letras, dígitos y !#$%&'*+-=?^_`{|}~@.[].*/
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $cpass = sha1($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
 
    $selec_usuario = $conex->prepare("SELECT * FROM usuarios WHERE email = ?");
    $selec_usuario->execute([$email,]);
    $fetch_usuario = $selec_usuario->fetch(PDO::FETCH_ASSOC);
 
    if($selec_usuario->rowCount() > 0){
       $mensaje[] = 'El correo electrónico ya esta registrado';
    }else{
       if($pass != $cpass){
          $mensaje[] = 'La contraseña no coincide';
       }else{
          $agregar_usuario = $conex->prepare("INSERT INTO usuarios (nombre, email, clave) VALUES(?,?,?)");
          $agregar_usuario->execute([$nombre, $email, $cpass]);
          $mensaje[] = 'Usuario registrado con éxito';
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
   <title>registrar admin</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../views/admin/admin_header.php'; ?>


<section class="form-container">

   <form action="" method="post">
      <h3>alta nuevo usuario</h3>
      <input type="text" name="nombre" required placeholder="introduce nombre" maxlength="20"  class="box">
      <input type="email" name="email" required placeholder="introduce email" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="introduce contraseña" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" required placeholder="repita contraseña" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="registro" class="btn" name="alta">
   </form>

</section>












<script src="../js/admin_script.js"></script>
   
</body>
</html>