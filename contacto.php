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
      <textarea name="msg" class="box" placeholder="escribe tu mensaje" cols="30" rows="10"></textarea>
      <input type="submit" value="enviar" name="enviar" class="btn"><!--value="send message"-->
   </form>

</section>