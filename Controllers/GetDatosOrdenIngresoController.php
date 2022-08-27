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

if(!isset($_GET['cod_conv'])){
    $cod_cli=$_GET["cod_cli"];
    $method = "cod_cli=$cod_cli&empresa=$empresa&token=$token";
    
    $convenio =$usuarioManager->callWebServiceOrdenIngresoRbiConvenios($method);
    
    if($convenio["Correcto"]==1  && count($convenio["convenios"])>0){
        $convenio=$convenio["convenios"];
    }else{
        $convenio=null;
    }
    
    echo json_encode(['convenios'=>$convenio]);
    return;

}else{
    
    $cod_conv=$_GET["cod_conv"];
    $method = "cod_conv=$cod_conv&empresa=$empresa&token=$token";
    
    $centroCostos=$usuarioManager->callWebServiceOrdenIngresoRbiCentroCostos($method);
    $cargo =$usuarioManager->callWebServiceOrdenIngresoRbiCargos($method);

    if($centroCostos["Correcto"]==1  && count($centroCostos["centros"])>0){
        $centroCostos=$centroCostos["centros"];
    }else{
        $centroCostos=null;
    }
    
    if($cargo["Correcto"]==1  && count($cargo["cargos"])>0){
        $cargo=$cargo["cargos"];
    }else{
        $cargo=null;
    }
    
    $response=array(
        "centro_costos"=>$centroCostos,
        "cargos"=>$cargo,
    );
    
    echo json_encode($response);
    return;
}

?>