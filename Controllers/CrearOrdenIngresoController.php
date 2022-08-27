<?php
namespace Controllers;

require_once ('../Models/Token.php');
require_once ("../Models/UsuarioManager.php");

use Models\Token;
use Models\UsuarioManager;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

$tokenClass = new Token;
$usuarioManager = new UsuarioManager();
$token=$tokenClass->getToken();
$jsonData = file_get_contents("php://input");
$_POST = json_decode($jsonData,true);
// var_dump ($_POST);
// echo $dataOrdenIngreso=json_decode(file_get_contents('php://input'),true);
// $dataOrdenIngreso['token']=$token;
$_POST['token']=$token;

$method = http_build_query($_POST);
// return;
$ordenIngreso =$usuarioManager->callWebServiceOrdenIngresoRbiCrear($method);

if($ordenIngreso["Correcto"]==1){
    $response=['data'=>$_POST,'message'=>'Orden de ingreso creada','status'=>true];
}else{
    $response=['data'=>null,'message'=>$ordenIngreso['Error'],'status'=>false];
}

echo json_encode($response);
?>