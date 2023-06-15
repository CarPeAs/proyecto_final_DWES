<?php

include 'config/conectar_bd.php';
require_once('vendor/stripe/stripe-php/init.php');

require 'vendor/autoload.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

require_once('vendor/tecnickcom/tcpdf/tcpdf.php');
require_once('mi_pdf.php');
require_once ('process_payment.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();

if(isset($_SESSION['id_usuario'])){
   $id_usuario = $_SESSION['id_usuario'];
}else{
   $id_usuario = '';
   header('location:usuario_login.php');
};

// Función de envío de correo electrónico de confirmación de pedido
function sendOrderConfirmationEmail($conex, $id_usuario, $email, $orderDetails,$id_pedido_string,$nombre,$domicilio,$total_precio) {
  
  $mail = new PHPMailer(true);

  try {
    //Configuracion servidor mail
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    //$mail->SMTPDebug  = 1;
    $mail->SMTPAuth   = true;
    $mail->Username   = 'prueba.daw8@gmail.com';
    $mail->Password   = 'password';
    $mail->SMTPSecure = 'ssl'; //Modifico tls por ssl
    $mail->Port       = 465; //Modifico el puerto 587 por el puerto 465
    //$mail->isHTML(true);

    // Remitente y destinatario
    $mail->setFrom('prueba.daw8@gmail.com', 'Supermercado Market');
    $mail->addAddress($email);

    // Asunto y cuerpo del e-mail
    $mail->Subject = 'Comprobante del pedido';
    $mail->Body    = 'Gracias por su pedido. Aquí están los detalles del pedido: '. $orderDetails;

    // Generar la factura PDF
    $pdf = generarFacturaPDF($conex,$id_usuario,$id_pedido_string,$nombre,$domicilio,$total_precio);
    $pdfContent = $pdf->Output('factura.pdf', 'S');

    // Adjuntar PDF al email
    $mail->addStringAttachment($pdfContent, 'factura.pdf');

    // Enviar el e-mail
    $mail->send();
    //echo 'Se ha enviado el correo electrónico de confirmación del pedido.';
    $mensaje[] = 'Se ha enviado el correo electrónico de confirmación del pedido.';
  } catch (Exception $e) {
    echo "No se ha podido enviar el correo electrónico de confirmación del pedido. Error: {$mail->ErrorInfo}";
  }
}


function generarFacturaPDF($conex,$id_usuario,$id_pedido_string,$nombre,$domicilio,$total_precio)
{
    $pdf = new MYPDF('P', 'mm', 'A4', true, 'UTF-8');

    // Información del documento
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Supermercado CYMARKET');
    $pdf->SetTitle('Factura');
    $pdf->SetSubject('Factura del pedido');

   
    $pdf->AddPage();

    // Nombre y domicilio del usuario
   $pdf->CreateTextBox('Don/Dña: '.$nombre, 0, 60, 80, 10, 10);
   $pdf->CreateTextBox('Domicilio: '.$domicilio, 0, 65, 80, 10, 10);
   
   // Fecha del pedido y id del pedido
   $pdf->CreateTextBox('Fecha: '.date('Y-m-d'), 0, 100, 0, 10, 10, '', 'R');
   $pdf->CreateTextBox('Ref. pedido: '.$id_pedido_string, 0, 105, 0, 10, 10, '', 'R');

   $pdf->CreateTextBox('Cantidad', 0, 128, 20, 10, 10, '', 'C');
   $pdf->CreateTextBox('Descripción', 20, 128, 20, 10, 10, '');
   $pdf->CreateTextBox('Precio UD', 100, 128, 30, 10, 10, '', 'R');
   $pdf->CreateTextBox('Total', 120, 128, 30, 10, 10, '', 'R');

   $currY = 138;
   $total = 0;
   $pdf->Line(20, $currY+2, 195, $currY+2);
   
   $selecc_cesta = $conex->prepare("SELECT * FROM cesta WHERE id_usuario = ?");
   $selecc_cesta->execute([$id_usuario]);

   if ($selecc_cesta->rowCount() > 0) {
   while ($fetch_cesta = $selecc_cesta->fetch(PDO::FETCH_ASSOC)) {
      $pdf->CreateTextBox($fetch_cesta['cantidad'], 0, $currY, 20, 10, 10, '', 'C');
      $pdf->CreateTextBox($fetch_cesta['nombre'], 20, $currY, 90, 10, 10, '');
      $pdf->CreateTextBox('€'.$fetch_cesta['precio'], 110, $currY, 30, 10, 10, '', 'R');
      
      $amount = $fetch_cesta['cantidad'] * $fetch_cesta['precio'];
      $pdf->CreateTextBox($amount.' €', 140, $currY, 30, 10, 10, '', 'R');
      
      $currY = $currY + 5;
      $total += $amount;
   }
}

   $pdf->Line(20, $currY+4, 195, $currY+4);

  
   $pdf->CreateTextBox('Total: ', 20, $currY+5, 135, 10, 10, 'B', 'R');
   $pdf->CreateTextBox('€'.number_format($total, 2, '.', ''), 140, $currY+5, 30, 10, 10, 'B', 'R');

  
   $pdf->setXY(20, $currY+30);
   $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 10);
   $pdf->MultiCell(175, 10, 'De acuerdo con lo establecido en el Reglamento Europeo 2016/679 y la normativa 
   nacional sobre protección de datos, se le informa que los datos personales que pudieran aparecer en la 
   presente factura serán tratados por el responsable del tratamiento SUPERMERCADO CYMARKET S.L. con la finalidad 
   de llevar a cabo la gestión económica, fiscal, contable, administrativa y de facturación.', 0, 'L', 0, 1, '', '', true, null, true);


    // Set font
   //  $pdf->SetFont('helvetica', '', 12);

    return $pdf;
}


if(isset($_POST['pedido'])){

   $nombre = $_POST['nombre'];
   $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
   $telefono = $_POST['telefono'];
   $telefono = filter_var($telefono, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $metodo_pago = $_POST['metodo_pago'];
   $metodo_pago = filter_var($metodo_pago, FILTER_SANITIZE_STRING);
   $domicilio =  $_POST['piso'] .', '. $_POST['calle'] .', '. $_POST['ciudad'] .', '. $_POST['provincia'] .', '. $_POST['pais'] .' - '. $_POST['cd_postal'];
   $domicilio = filter_var($domicilio, FILTER_SANITIZE_STRING);
   $total_productos = $_POST['total_productos'];
   $total_precio = $_POST['total_precio'];

   $articulos_cesta = $conex->prepare("SELECT * FROM cesta WHERE id_usuario = ?");
   $articulos_cesta->execute([$id_usuario]);

   if($articulos_cesta->rowCount() > 0){

      $realizar_pedido = $conex->prepare("INSERT INTO pedidos (nombre, direccion, email, metodo_pago, numero, precio_total,  total_articulos, id_usuario, fecha_pedido) VALUES(?,?,?,?,?,?,?,?,CURDATE())");
      $realizar_pedido->execute([$nombre, $domicilio, $email, $metodo_pago, $telefono, $total_precio, $total_productos, $id_usuario]);

      $ref_pedido = $conex->prepare("SELECT id FROM pedidos WHERE id_usuario = ? AND fecha_pedido = ? AND precio_total= ? ");
      $ref_pedido->execute([$id_usuario, date('Y-m-d'),$total_precio]);

      if ($ref_pedido->rowCount() > 0) {
         $row = $ref_pedido->fetch(PDO::FETCH_ASSOC);
         $id_pedido = $row['id'];
         $id_pedido_string = strval($id_pedido); 
     }
      
      // Redactar los detalles del pedido para el correo electrónico
      $orderDetails = "Nombre: {$nombre}\n";
      $orderDetails .= "Dirección: {$domicilio}\n";
      $orderDetails .= "Email: {$email}\n";
      $orderDetails .= "Método de Pago: {$metodo_pago}\n";
      $orderDetails .= "Teléfono: {$telefono}\n";
      $orderDetails .= "Total de Artículos: {$total_productos}\n";
      $orderDetails .= "Precio Total: €{$total_precio}\n";

      // Enviar correo electrónico de confirmación del pedido
      sendOrderConfirmationEmail($conex, $id_usuario, $email, $orderDetails,$id_pedido_string,$nombre,$domicilio,$total_precio);

      $vaciar_cesta = $conex->prepare("DELETE FROM cesta WHERE id_usuario = ?");
      $vaciar_cesta->execute([$id_usuario]);

      createStripeCheckoutSession();
      /*header('refresh:2;location:index.php');
      $mensaje[] = 'pedido realizado con éxito!';*/
   }else{
      $mensaje[] = 'tu carro esta vacio';
   }

}

?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>comprobación</title>
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/main.css">

</head>
<body>
   
<?php include 'views/usuario/usuario_header.php'; ?>

<section class="checkout-orders">

   <form action="" method="POST">

   <h3>sus pedidos</h3>

      <div class="display-orders">
      <?php
         $total = 0;
         $articulos_cesta = '';
         $selecc_cesta = $conex->prepare("SELECT * FROM cesta WHERE id_usuario = ?");
         $selecc_cesta->execute([$id_usuario]);
         
         if($selecc_cesta->rowCount() > 0){
            $total_articulos = ""; 
            while($fetch_cesta = $selecc_cesta->fetch(PDO::FETCH_ASSOC)){
               $articulos_cesta = $fetch_cesta['nombre'].' ('.$fetch_cesta['precio'].' x '.$fetch_cesta['cantidad'].')';
               $total_articulos .= $articulos_cesta . " - ";
               $total += ($fetch_cesta['precio'] * $fetch_cesta['cantidad']);
      ?>
         <p> <?= $fetch_cesta['nombre']; ?> <span>(<?= '€'.$fetch_cesta['precio'].'/- x '. $fetch_cesta['cantidad']; ?>)</span> </p>
      <?php
            }
            
         }else{
            echo '<p class="empty">¡su cesta está vacía!</p>';
         }
      ?>
         <input type="hidden" name="total_productos" value="<?= $total_articulos; ?>">
         <input type="hidden" name="total_precio" value="<?= $total; ?>" value="">
         <div class="grand-total">Total : <span>€<?= $total; ?>/-</span></div>
      </div>

      <h3>realice sus pedidos</h3>

      <div class="flex">
         <div class="inputBox">
            <span>tu nombre :</span>
            <input type="text" name="nombre" placeholder="introduce tu nombre" class="box" maxlength="20" required>
         </div>
         <div class="inputBox">
            <span>tu numero :</span>
            <input type="number" name="telefono" placeholder="introduce tu numero" class="box" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;" required>
         </div>
         <div class="inputBox">
            <span>tu email :</span>
            <input type="email" name="email" placeholder="introduce tu email" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>metodo de pago :</span>
            <select name="metodo_pago" class="box" required>
               <option value="tarjeta de credito">tarjeta de credito</option>
               <option value="paypal">paypal</option>
            </select>
         </div>
         <div class="inputBox">
            <span>dirección línea 01 :</span>
            <input type="text" name="piso" placeholder="e.g. planta baja" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>dirección línea 02 :</span>
            <input type="text" name="calle" placeholder="e.g. Carrer Illueca, 28" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>ciudad :</span>
            <input type="text" name="ciudad" placeholder="e.g. elche" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>provincia :</span>
            <input type="text" name="provincia" placeholder="e.g. alicante" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>pais :</span>
            <input type="text" name="pais" placeholder="e.g. España" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>codigo postal :</span>
            <input type="number" min="0" name="cd_postal" placeholder="e.g. 03206" min="0" max="999999" onkeypress="if(this.value.length == 6) return false;" class="box" required>
         </div>
      </div>

      <input type="submit" name="pedido" class="btn <?= ($total > 1)?'':'disabled'; ?>" value="realizar pedido">

   </form>

</section>













<?php include 'views/usuario/usuario_footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>