<?php
include('../dbmanagers/class_conexion.php');
header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
$BD = new class_conexion(); 
/*foreach ($_POST as $c => $v){
  echo $c." = ".$v."<br>";
}*/
$usuario = "";
$usuarioWebC = "";
$usuarioWebE = "";
$usuarioWebInsert = "";

$usu = "SELECT count(*) AS total 
	    FROM usuarios 
	    WHERE identificacion = '".$_POST['contactIdentificacionField']."' ";
$rusu = $BD->ejecutar_sql($usu);
$fila = $BD->fetch_array($rusu);
$total = $fila["total"];
//echo "sql1 = ".$usu."<br>";
//echo "sql1 = ".$total."<br>";
if($total > 0){
	echo "ERRORCORREO";
}if($total == 0){
	require_once "../dbmanagers/UsuarioManager.php";
$usuarioManager = new UsuarioManager();
//if($usuario == true){
   //echo "tipo usuario = ".$_POST['contactTipoClienteField'];
   if($_POST['contactTipoClienteField'] == 2){
	  $methodC = "NitCliente=".$_POST['contactIdentificacionField']." ";
	  $usuarioWebC = $usuarioManager->callWebServiceResgisroCliente($methodC);
	  //print_r($usuarioWebC);
	  $empresaArray = $usuarioWebC["Empresas"];
	  $empresaArrayExt = $usuarioWebC["Existe"];
	  $empresaArrayNom = $usuarioWebC["Nombre"];

	  if($empresaArrayExt == 1){
	  	  $usuario = $usuarioManager->saveUsuario($_POST['contactIdentificacionField'],strtoupper($_POST['contactEmailField']), 
                                        $_POST['contactTipoClienteField'],$_POST['contactClaveField'],$empresaArrayNom);
		  //echo $empresaArray = count($empresaArray);
		  foreach($empresaArray as $empresaArrayEmpresas){
				//print_r($empresaArrayEmpresas);
				$empresasResult= $empresaArrayEmpresas["Empresa"];
				$estadoResult= $empresaArrayEmpresas["Estado"];
				//echo "estado=".$estadoResult;
				if($empresasResult!="Pruebas_INNSer"){
					$usuarioWebInsert = $usuarioManager->saveEmpresaEmpleado($_POST['contactIdentificacionField'],$empresasResult,$estadoResult);
				}
				//echo $usuarioWebInsert;
				/*if($usuarioWebInsert == 1){
					echo true;
				}else{
					echo false;
				}*/
				
		  }
		  echo json_encode($usuario);
	  }else{
		  echo "ERROR";
	  }	  
    }
    if($_POST['contactTipoClienteField'] == 1){
	  //echo $methodE = "CodEmpleado=".$_POST['contactIdentificacionField']." ";
	  $methodE = "CodEmpleado=".$_POST['contactIdentificacionField']." ";		
	  $usuarioWebE = $usuarioManager->callWebServiceResgisroEmpleado($methodE);
	  //print_r($usuarioWebE);
	  //echo "Empresas: ".$usuarioWebE["Empresas"]."\n";
	  $empresaArray = array();
	  $empresaArray = $usuarioWebE["Empresas"];
	  $empresaArrayExt = $usuarioWebE["Existe"];
	  $empresaArrayNom = $usuarioWebE["Nombre"];
	  //echo $empresaArray = count($empresaArray);
	  
      if($empresaArrayExt == 1){	  
      		$usuario = $usuarioManager->saveUsuario($_POST['contactIdentificacionField'], strtoupper($_POST['contactEmailField']), 
                                        $_POST['contactTipoClienteField'],$_POST['contactClaveField'],$empresaArrayNom);
                                        
		  foreach($empresaArray as $empresaArrayEmpresas){
				//print_r($empresaArrayEmpresas);
				$empresasResult= $empresaArrayEmpresas["Empresa"];
				$estadoResult= $empresaArrayEmpresas["Estado"];
				if($empresasResult!="Pruebas_INNSer"){
					$usuarioWebInsert = $usuarioManager->saveEmpresaEmpleado($_POST['contactIdentificacionField'],$empresasResult,$estadoResult);
				}
				//echo $usuarioWebInsert;
				/*if($usuarioWebInsert == 1){
					echo true;
				}else{
					echo false;
				}*/
				
		  }
		  echo json_encode($usuario);
	  }else{
		  echo "ERROR";
	  }
	}



}
/*}else{
  echo json_encode($usuario);
} */                                           
//echo json_encode($usuario);
?>