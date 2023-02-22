<?php

if(isset($_POST['agregar_cesta'])){

   if($id_usuario == ''){
      header('location:usuario_login.php');
   }else{

      $pid = $_POST['id_producto'];
      $pid = filter_var($pid, FILTER_SANITIZE_STRING);
      $nombre = $_POST['nombre'];
      $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
      $precio = $_POST['precio'];
      $precio = filter_var($precio, FILTER_SANITIZE_STRING);
      $imagen = $_POST['imagen'];
      $imagen = filter_var($imagen, FILTER_SANITIZE_STRING);
      $cantidad = $_POST['cantidad'];
      $cantidad = filter_var($cantidad, FILTER_SANITIZE_STRING);

      $numero_articulos_cesta = $conex->prepare("SELECT * FROM cesta WHERE nombre = ? AND id_usuario = ?");
      $numero_articulos_cesta->execute([$nombre, $id_usuario]);

      if($numero_articulos_cesta->rowCount() > 0){
         $mensaje[] = 'ya añadido a la cesta';
      }else{

        
         $agregar_cesta = $conex->prepare("INSERT INTO cesta (id_usuario, id_producto, nombre, precio, cantidad, imagen) VALUES(?,?,?,?,?,?)");
         $agregar_cesta->execute([$id_usuario, $pid, $nombre, $precio, $cantidad, $imagen]);
         $mensaje[] = 'añadido a la cesta';
         
      }

   }

}

?>