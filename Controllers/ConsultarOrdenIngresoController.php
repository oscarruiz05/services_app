<?php
namespace Controllers;

require_once ('../Models/Token.php');
require_once ("../Models/UsuarioManager.php");

use Models\Token;
use Models\UsuarioManager;

header('Access-Control-Allow-Origin: *');

$tokenClass = new Token;
$usuarioManager = new UsuarioManager();
$token=$tokenClass->getToken();
$empresa=$_GET["empresa"];

$cod_cli=$_GET["cod_cli"];
$method = "cod_cli=$cod_cli&empresa=$empresa&token=$token";

$ordenIngreso = $usuarioManager->callWebServiceOrdenIngresoRbiConsultar($method);

if($ordenIngreso["Correcto"]==1  && count($ordenIngreso["ordingreso"])>0){
    $ordenIngreso=$ordenIngreso["ordingreso"];
}else{
    $ordenIngreso=null;
}

echo json_encode(["orden_ingreso"=>$ordenIngreso]);


?>