<?php 
include_once('Veritrans.php');

// Use sandbox account
Veritrans_Config::$isProduction = false;

// Set our server key
Veritrans_Config::$serverKey = 'VT-server-ZJqkcuil1Mee47mCBXpD9CQo';

// Fill transaction data
$transaction = array(
    "vtweb" => array (
          "credit_card_3d_secure" => true,
        ),
    'transaction_details' => array(
        'order_id' => rand(),
        'gross_amount' => 10000,
        )
    );

$vtweb_url = Veritrans_Vtweb::getRedirectionUrl($transaction);
echo $vtweb_url;

// Redirect 
header('Location: ' . $vtweb_url);
?>
