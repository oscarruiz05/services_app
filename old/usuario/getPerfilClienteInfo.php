<?php
header('Access-Control-Allow-Origin: *');
include('../dbmanagers/class_conexion.php');
$BD = new class_conexion(); 
/*foreach ($_GET as $c => $v){
  echo $c." = ".$v."<br>";
}*/
$perfil="";
$perfilWebService = "";
require_once "../dbmanagers/UsuarioManager.php";
$usuarioManager = new UsuarioManager();
$Empresa = $_GET["empresaId"];
$NitCliente = $_GET["identificacionId"];
//$method = "CodEmpleado=".$CodEmpleado."&Empresa=".$Empresa;
$method = "NitCliente=".$NitCliente;
//$perfilWebService = $usuarioManager->callWebServicePerfil($method);
$perfilWebService = $usuarioManager->callWebServicePerfilCliente($method);
//print_r($perfilWebService);
$perfilArray = $perfilWebService["Perfil"];
//print_r($perfilArray);
$sqlA = "SELECT u.foto
		FROM usuarios AS u
		WHERE u.identificacion = '".$_GET["identificacionId"]."'";
		$resultA = $BD->ejecutar_sql($sqlA);
		$filaA = $BD->fetch_array($resultA);
$foto 	    = $filaA["foto"];
$perfilArray['foto'] = $foto ;
echo json_encode($perfilArray);			  
?>