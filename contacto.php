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
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $numero = $_POST['numero'];
   $numero = filter_var($numero, FILTER_SANITIZE_STRING);
   $msj = $_POST['msj'];
   $msj = filter_var($msj, FILTER_SANITIZE_STRING);

   $selec_mensaje = $conex->prepare("SELECT * FROM mensajes WHERE nombre = ? AND email = ? AND numero = ? AND mensaje = ?");
   $selec_mensaje->execute([$nombre, $email, $numero, $msj]);

   if($selec_mensaje->rowCount() > 0){
      $mensaje[] = 'mensaje ya enviado';
   }else{

      $enviar_mensaje = $conex->prepare("INSERT INTO mensajes (id_usuario, nombre, email, numero, mensaje) VALUES(?,?,?,?,?)");
      $enviar_mensaje->execute([$id_usuario, $nombre, $email, $numero, $msj]);

      $mensaje[] = '¡mensaje enviado correctamente!';

   }

}

?>


<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contacto</title>

   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   
   

</head>
<body>
   
<?php include 'views/usuario/usuario_header.php'; ?>

<section class="contacto">

   <form action="" method="post">
      <h3>Contactanos</h3>
      <input type="text" name="nombre" placeholder="escriba tu nombre" required maxlength="20" class="box">
      <input type="email" name="email" placeholder="escriba tu email" required maxlength="50" class="box">
      <input type="number" name="numero" min="0" max="9999999999" placeholder="escribe tu numero" required onkeypress="if(this.value.length == 10) return false;" class="box">
      <textarea name="msj" class="box" placeholder="escribe tu mensaje" cols="30" rows="10"></textarea>
      <input type="submit" value="enviar" name="enviar" class="btn">
   </form>

</section>



<?php include 'views/usuario/usuario_footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>