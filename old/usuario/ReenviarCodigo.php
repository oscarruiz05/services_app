<?php
require('elibom/elibom.php');

$elibom = new ElibomClient('Analistadesistemas@grupologis.co', 'Iemr9108*');
$digits = 4;
$codigo = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
$deliveryId = $elibom->sendMessage('57'.$_POST['telefono'], 'Bienvenido a GRUPOLOGIS su codigo es: '.$codigo );
$response=array(
    id=>$deliveryId,
    code=>$codigo
);
echo json_encode($response);
?>