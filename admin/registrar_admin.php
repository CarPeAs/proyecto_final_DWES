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
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_admin = $conn->prepare("SELECT * FROM administradores WHERE nombre = ?");
   $select_admin->execute([$name]);

   if($select_admin->rowCount() > 0){
      $mensaje[] = 'El nombre de usuario ya existe';
   }else{
      if($pass != $cpass){
         $mensaje[] = 'Confirmar contraseña no coincide';
      }else{
         $insert_admin = $conex->prepare("INSERT INTO administradores (nombre, clave) VALUES(?,?)");
         $insert_admin->execute([$name, $cpass]);
         $mensaje[] = 'Nuevo administrador registrado con éxito';
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
      <h3>alta nuevo administrador</h3>
      <input type="text" name="nombre" required placeholder="introduce nombre" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="introduce contraseña" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" required placeholder="confirma contraseña" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="registrar" class="btn" name="enviar">
   </form>

</section>












<script src="../js/admin_script.js"></script>
   
</body>
</html>