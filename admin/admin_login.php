<?php

include '../config/conectar_bd.php';

session_start();

if(isset($_POST['enviar'])){

   $nombre = $_POST['nombre'];
   $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['clave']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $selecc_admin = $conex->prepare("SELECT * FROM administradores WHERE nombre = ? AND clave = ?");
   $selecc_admin->execute([$nombre, $pass]);
   $fetch_admin = $selecc_admin->fetch(PDO::FETCH_ASSOC);

   if($selecc_admin->rowCount() >0){
      if($fetch_admin ['rol']=='admin'){
         $_SESSION['admin_id'] = $fetch_admin ['id'];
         header('location:panel_control.php');
      }else{
         $_SESSION['admin_id'] = $fetch_admin ['id'];
         header('location:../empleado/panel_control_emp.php');
      }
     
   }else{
      
      $mensaje[] = 'usuario o contraseña incorrecta';
   }

}

?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login administradores</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

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

<section class="form-container">

   <form action="" method="post">
      <h3>acceso administradores</h3>
      <p>username de prueba= <span>admin</span> & contraseña = <span>111</span></p>
      <input type="text" name="nombre" required placeholder="introduce tu username" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="clave" required placeholder="introduce tu contraseña" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="acceder" class="btn" name="enviar">
   </form>

</section>
   
</body>
</html>