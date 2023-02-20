<?php

include 'config/conectar_bd.php';

session_start();

if(isset($_SESSION['user_id'])){
    $id_usuario = $_SESSION['user_id'];
}else{
    $id_usuario = '';
};

//include 'models/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>inicio</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'views/usuario/usuario_header.php'; ?>

<h1>HOLA USUARIO</h1>

<?php include 'views/usuario/usuario_footer.php'; ?>