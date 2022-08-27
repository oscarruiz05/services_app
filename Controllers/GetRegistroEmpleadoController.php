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
if(isset($_GET['empresa'])){
    $method = "codempleado=".$_GET['cod_emp']."&Empresa=".$_GET['empresa']."&token=".$token;
}else{
    $headers = apache_request_headers();
    if(!isset($headers['Authorization'])||$headers['Authorization']!=="QCpHUlVQT0xPR0lTMjAyMiE"){
        echo json_encode(['Correcto'=>0,'Error'=>'No Auth']);
        return;
    }
    // echo "sa";
    echo $empresas=$usuarioManager->callWebServiceResgisroEmpleado("CodEmpleado=".$_GET['cod_emp']."&token=$token");
    if(isset($empresas['Empresas'])){
        $empresas=$empresas['Empresas'];
    }
    $empresaKey=array_search(1,array_column($empresas,"Estado"));
    if($empresaKey!==false){
        $method = "codempleado=".$_GET['cod_emp']."&Empresa=".$empresas[$empresaKey]['Empresa']."&token=".$token;
    }else{
        echo json_encode(['Correcto'=>0,'Error'=>'No se encontró el empleado en nuestra base de datos']);
        return;
    }
}
$perfilWebService = $usuarioManager->callWebServicePerfil($method);
echo  json_encode($perfilWebService);
?>