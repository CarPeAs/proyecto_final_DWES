<?php

include 'config/conectar_bd.php';

session_start();

if(isset($_SESSION['user_id'])){
    $id_usuario = $_SESSION['user_id'];
}else{
    $id_usuario = '';
};

if(isset($_POST['enviar'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $selec_usuario = $conex->prepare("SELECT * FROM usuarios WHERE email = ? AND clave = ?");
   $selec_usuario->execute([$email, $pass]);
   $fila = $selec_usuario->fetch(PDO::FETCH_ASSOC);

   if($selec_usuario->rowCount() > 0){
      $_SESSION['user_id'] = $fila['id'];
      header('location:index.php');
   }else{
      $mensaje[] = 'usuario o contraseña incorrecta!';
   }

}

?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'views/usuario/usuario_header.php'; ?>

<section class="form-container">

   <form action="" method="post">
      <h3>Acceso</h3>
      <p>username de prueba= <span>user@gmail.com</span> & contraseña = <span>user1</span></p>
      <input type="email" name="email" required placeholder="escribe tu email" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="escriba tu contraseña" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="accede ahora" class="btn" name="enviar">
      <p>¿No tienes una cuenta?</p>
      <a href="registro_usuario.php" class="option-btn">registrate ahora</a>
   </form>

</section>













<?php include 'views/usuario/usuario_footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>