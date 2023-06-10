<?php

require_once 'vendor/autoload.php';
require_once 'secrets.php';

\Stripe\Stripe::setApiKey('sk_test_51NFvMxCPuZzMRu6fVusSxnDPZIc4yd6TgZ2zwfB13xMS7lkeVDL0fCczNcwgBGt9nVtifE8eMt4WKQinn7mADsbf002KazM2fJ');
header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost/xampp/practicasPHP8/proyecto_final_DWES';


$checkout_session = \Stripe\Checkout\Session::create([
  'line_items' => [[
    # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
    'price' => 'price_1NGTtMCPuZzMRu6fSoBdMcjQ',
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '/success.php',
  'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);
