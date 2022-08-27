<?php
include('../dbmanagers/class_conexion.php');
require('elibom/elibom.php');
header("Access-Control-Allow-Origin: *");

$BD = new class_conexion(); 
$usuario = "";
$usuarioWebC = "";
$usuarioWebE = "";
$usuarioWebInsert = "";

$usu = "SELECT correo,count(*) AS total 
	    FROM usuarios 
	    WHERE identificacion = '".$_POST['contactIdentificacionField']."' ";
$rusu = $BD->ejecutar_sql($usu);
$fila = $BD->fetch_array($rusu);
$total = $fila["total"];
$correo = $fila["correo"];


$elibom = new ElibomClient('Analistadesistemas@grupologis.co', 'Iemr9108*');
$digits = 4;
$codigo = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);

require_once "../dbmanagers/UsuarioManager.php";
$usuarioManager = new UsuarioManager();

if($_POST['contactTipoClienteField'] == 2){
	$methodC = "NitCliente=".$_POST['contactIdentificacionField']." ";
	$usuarioWebC = $usuarioManager->callWebServiceResgisroCliente($methodC);
	$empresaArray = $usuarioWebC["Empresas"];
	$empresaArrayExt = $usuarioWebC["Existe"];
	$empresaArrayNom = $usuarioWebC["Nombre"];
	
	
	$contactos = $usuarioManager->callWebServicePerfilCliente($methodC);
	$contactos = $contactos["Contactos"];
    $valido = false;
    
    foreach($contactos as $info){
		if($info['Telefono'] == $_POST['contactNumeroTelefonico']){
		    $valido = true;
			break;
	    }
	}
	    
    
	if($empresaArrayExt == 1){
		if($total==0)
		{
			$usuario = $usuarioManager->saveUsuario($_POST['contactIdentificacionField'],strtoupper($_POST['contactEmailField']), 
			$_POST['contactTipoClienteField'],$_POST['contactClaveField'],$empresaArrayNom);	
		}

		foreach($empresaArray as $empresaArrayEmpresas){
			$empresasResult= $empresaArrayEmpresas["Empresa"];
			$estadoResult= $empresaArrayEmpresas["Estado"];
			if($empresasResult!="Pruebas_INNSer"){
				$usuarioWebInsert = $usuarioManager->saveEmpresaEmpleado($_POST['contactIdentificacionField'],$empresasResult,$estadoResult);
			}
		}
		$deliveryId = $elibom->sendMessage('57'.$_POST['contactNumeroTelefonico'], 'Bienvenido a GRUPOLOGIS su codigo es: '.$codigo );
		
		if($valido){
	        $usuario = ["codigo" => $codigo,"correo" => $correo,"stats"=>true];
		    echo json_encode($usuario);
	    }else{
	       echo "ERRORT";
	    }
	}else{
		echo "ERROR";
	}
}

if($_POST['contactTipoClienteField'] == 1){
	$methodE = "CodEmpleado=".$_POST['contactIdentificacionField']." ";		
	$usuarioWebE = $usuarioManager->callWebServiceResgisroEmpleado($methodE);
	// echo $usuarioWebE;
	$empresaArray = array();
	$empresaArray = $usuarioWebE["Empresas"];
	// $empresaArray[1]["Empresa"]="logis";
	$empresaArrayExt = $usuarioWebE["Existe"];
	$empresaArrayNom = $usuarioWebE["Nombre"];
	
	if($empresaArrayExt == 1){
    	foreach($empresaArray as $empresaArrayEmpresas){
    				$empresasResult= $empresaArrayEmpresas["Empresa"];
    				$estadoResult= $empresaArrayEmpresas["Estado"];
    				if($empresasResult!="Pruebas_INNSer"){
    					$usuarioWebInsert = $usuarioManager->saveEmpresaEmpleado($_POST['contactIdentificacionField'],$empresasResult,$estadoResult);
    				}
    				
    	}
	}
	
	$emp = "SELECT empresa
	    FROM empresas 
	    WHERE identificacion = '".$_POST['contactIdentificacionField']."' AND estado != 99 AND empresa != 'Pruebas_INNSer' ORDER BY id DESC LIMIT 1";
	$remp= $BD->ejecutar_sql($emp);
	$fila = $BD->fetch_array($remp);
	$empresa = $fila["empresa"];

	$NitCliente = $_POST['contactIdentificacionField'];
	$method = "CodEmpleado=".$NitCliente."&Empresa=".$empresa;
	$perfilWebService = $usuarioManager->callWebServicePerfil($method);
	// echo $perfilWebService["Correcto"];
	$perfilArray = $perfilWebService["Perfil"];

	if($perfilArray["tel_cel"]==$_POST['contactNumeroTelefonico'])
	{
		if($empresaArrayExt == 1){	
			if($total==0)
			{  
				$usuario = $usuarioManager->saveUsuario($_POST['contactIdentificacionField'], strtoupper($_POST['contactEmailField']), 
				$_POST['contactTipoClienteField'],$_POST['contactClaveField'],$empresaArrayNom);
			}	

			$deliveryId = $elibom->sendMessage('57'.$_POST['contactNumeroTelefonico'], 'Bienvenido a GRUPOLOGIS su codigo es: '.$codigo );
			$usuario = array("codigo" => $codigo,"correo" => $correo,"stats"=>true);
			echo json_encode($usuario);
		}else{
			echo "ERROR";
		}
	
	}else{
		echo "ERRORT";
	}
}

?>