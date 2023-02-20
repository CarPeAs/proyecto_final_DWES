<?php

include 'config/conectar_bd.php';

session_start();

if(isset($_SESSION['user_id'])){
   $id_usuario = $_SESSION['user_id'];
}else{
   $id_usuario = '';
};

if(isset($_POST['enviar'])){

   $nombre = $_POST['nombre'];
   $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
   /*Para eliminar las etiquetas y eliminar caracteres no deseados o codificados*/
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_EMAIL);//FILTER_SANITIZE_STRING
   /** Para eliminar todos los caracteres menos letras, dígitos y !#$%&'*+-=?^_`{|}~@.[].*/
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
   /*la contraseña la guardamos encriptada con una función sha1 ya que usando hash daba errores
   al hacer el proceso inverson en el login*/

   $selec_usuario = $conex->prepare("SELECT * FROM usuarios WHERE email = ?");
   $selec_usuario->execute([$email,]);
   $fila = $selec_usuario->fetch(PDO::FETCH_ASSOC);

   if($selec_usuario->rowCount() > 0){
      $mensaje[] = 'el correo electrónico ya existe';
   }else{
      if($pass != $cpass){
         $mensaje[] = 'la contraseña no coincide';
      }else{
         $insert_usuario = $conex->prepare("INSERT INTO usuarios (nombre, email, clave) VALUES(?,?,?)");
         $insert_usuario->execute([$nombre, $email, $cpass]);
         $mensaje[] = 'registrado con éxito, ¡conéctese ahora por favor!';
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
   <title>registro usuario</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'views/usuario/usuario_header.php'; ?>

<section class="form-container">

   <form action="" method="post">
      <h3>registrate ahora</h3>
      <input type="text" name="nombre" required placeholder="escriba tu nombre" maxlength="20"  class="box">
      <input type="email" name="email" required placeholder="escriba tu email" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="escriba tu contraseña" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" required placeholder="repite tu contraseña" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="registrarse" class="btn" name="enviar">
      <p>¿Ya tienes una cuenta?</p>
      <a href="usuario_login.php" class="option-btn">accede ahora</a>
   </form>

</section>

<!--Pedimos el correo electrónico, nombre, contraseña y confirmación de la contraseña.
Datos muy básicos para que se registren lo más rápido y fácilmente posible, luego, si compran, 
ya les pedimos los demás datos necesarios.-->











<?php include 'views/usuario/usuario_footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>