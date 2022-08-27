<?php
namespace Controllers;
require_once ('../Models/Token.php');
require_once ("../Models/UsuarioManager.php");
use Models\Token;
use Models\UsuarioManager;
header('Access-Control-Allow-Origin: *');

$tokenClass = new Token;
$token = $tokenClass->getToken();
$usuarioManager = new UsuarioManager();

/* validar si existe parametro empresa */
if(isset($_GET['empresa'])){
    $method = "Empresa=".$_GET['empresa']."&token=".$token;
}else{
    echo json_encode([
        'Correcto' => 0,
        'Error' => 'Error al obtener Tipos de contrato'
    ]);
    return;
}

/* llamado a la web service */
$perfilWebService = $usuarioManager->callWebServiceOrdenIngresoRbiTiposContratos($method);
echo  json_encode($perfilWebService);
?>