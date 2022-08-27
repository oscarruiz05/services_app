<?php
header('Access-Control-Allow-Origin: *');
include('../dbmanagers/class_conexion.php');
$BD = new class_conexion(); 
/*foreach ($_POST as $c => $v){
  echo $c." = ".$v."<br>";
}*/
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
$sqlA = "SELECT u.foto
		FROM usuarios AS u
		WHERE u.identificacion = '".$_GET["identificacionId"]."'";
		$resultA = $BD->ejecutar_sql($sqlA);
		$filaA = $BD->fetch_array($resultA);
        $foto 	    = $filaA["foto"];
echo $perfilArray["nomb_emp"];				  
?>