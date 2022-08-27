<?php
header('Access-Control-Allow-Origin: *');
include('../dbmanagers/class_conexion.php');
$zona = date_default_timezone_set('America/Bogota');
//echo $zona;
$BD = new class_conexion(); 
/*foreach ($_POST as $c => $v){
  echo $c." = ".$v."<br>";
}*/
/***************************/
function Mes($fecha)
{
	$fecharray = explode("/", $fecha);
	//print_r($fecharray);
	$dia = $fecharray[0];
	$nmes = $fecharray[1];
	$anio  = $fecharray[2];
	
	$fs = $nmes;
	return $fs;
}
/***************************/
function Dia($fecha)
{
	$fecharray = explode("/", $fecha);
	//print_r($fecharray);
	$dia = $fecharray[0];
	$nmes = $fecharray[1];
	$anio  = $fecharray[2];
	
	$fs = $dia;
	return $fs;
}
$perfil="";
$perfilWebService = "";
require_once "../dbmanagers/UsuarioManager.php";
$usuarioManager = new UsuarioManager();
$Empresa = $_GET["empresaId"];
$CodEmpleado = $_GET["identificacionId"];
$method = "CodEmpleado=".$CodEmpleado."&Empresa=".$Empresa;
$perfilWebService = $usuarioManager->callWebServicePerfil($method);
//print_r($perfilWebService);
$perfilArray = $perfilWebService["Perfil"];
//print_r($perfilArray);
//echo $perfilArray["fec_nac"];
//echo Dia($perfilArray["fec_nac"]);
$day = Dia($perfilArray["fec_nac"]);
$month = Mes($perfilArray["fec_nac"]);
//echo $month." ".$day;
/*$day = "17";
$month = "06";*/
//$fecha = new DateTimeZone('America/Bogota');
$dayAC = date("d");
$monthAC = date("m");
//echo $month." - ".$monthAC." - ".$dayAC." - ".$day; 
if($month == $monthAC){	
 if($dayAC == $day){
	echo "TRUE:#:".$perfilArray["nomb_emp"];
  }	
}
?>