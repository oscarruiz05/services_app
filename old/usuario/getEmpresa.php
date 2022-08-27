<?php
header('Access-Control-Allow-Origin: *'); 
/*foreach ($_POST as $c => $v){
  echo $c." = ".$v."<br>";
}*/
$empresas="";
$usuarioWebC = "";
$usuarioWebE = "";
$usuarioWebInsert = "";
$empresasList = "";
require_once "../dbmanagers/UsuarioManager.php";
$usuarioManager = new UsuarioManager();
if($_POST['tipousuarioId'] == 2){
	  $methodC = "NitCliente=".$_POST['identificacionId']." ";
	  $identificacionId=$_POST['identificacionId'];
	  $usuarioWebC = $usuarioManager->callWebServiceResgisroCliente($methodC);
	  $empresaArray = $usuarioWebC["Empresas"];
	  
	  foreach($empresaArray as $empresaArrayEmpresas){
			//print_r($empresaArrayEmpresas);
			$empresasResult= $empresaArrayEmpresas["Empresa"];
			$estadoResult= $empresaArrayEmpresas["Estado"];
			$usuarioWebInsert = $usuarioManager->saveEmpresaEmpleado($_POST['identificacionId'],$empresasResult,$estadoResult);
	  }
	  //print_r($usuarioWebInsert);
	  
		  $option = " <option value=''>Seleccione Empresa</option>";
			if($usuarioWebInsert == 1){
				//echo "empresa= ".$identificacionId;
				$empresasList = $usuarioManager->getEmpresa($identificacionId);
				$empresasListArray = $empresasList;
				//print_r($empresasListArray);
				foreach($empresasListArray as $empresasListArrayEmpresa){
				   //print_r($empresasListArrayEmpresa);
				   $empresasResult= $empresasListArrayEmpresa["empresa"];
				   $empresasResultAlias= $empresasListArrayEmpresa["alias"];
				   $empresasResultEstado= $empresasListArrayEmpresa["estado"];
				   if( ($empresasResultEstado == 99) || ($empresasResultEstado == 4) || ($empresasResultEstado== 0)  ){
					   }else{
					     $option.= " <option value='".$empresasResult."'>".$empresasResultAlias."</option>";
					   }
				}
				echo $option;
				//print_r($empresasListArray);
				//$option .= " <option value='".$empresasListArray["empresa"]."'>".$empresasListArray["empresa"]."</option>";
				//echo $option;
				//echo "true";
			}else{
				echo "false";
			}
		  //print_r($usuarioWebC);
		  
	  
    }
    if($_POST['tipousuarioId'] == 1){
	  $methodE = "CodEmpleado=".$_POST['identificacionId']." ";	
	  $identificacionId=$_POST['identificacionId'];
	  $usuarioWebE = $usuarioManager->callWebServiceResgisroEmpleado($methodE);
	  //echo "Empresas: ".$usuarioWebE["Empresas"]."\n";
	  //$empresaArray = array();
	  $empresaArray = $usuarioWebE["Empresas"];
	  //echo $empresaArray = count($empresaArray);
	  foreach($empresaArray as $empresaArrayEmpresas){
			//print_r($empresaArrayEmpresas);
			$empresasResult= $empresaArrayEmpresas["Empresa"];
			$estadoResult= $empresaArrayEmpresas["Estado"];
			$usuarioWebInsert = $usuarioManager->saveEmpresaEmpleado($_POST['identificacionId'],$empresasResult,$estadoResult);
	  }
	    $option = " <option value=''>Seleccione Empresa</option>";
		if($usuarioWebInsert == 1){
					//echo "empresa= ".$identificacionId;
					$empresasList = $usuarioManager->getEmpresa($identificacionId);
					$empresasListArray = $empresasList;
					//print_r($empresasListArray);
					foreach($empresasListArray as $empresasListArrayEmpresa){
					   //print_r($empresasListArrayEmpresa);
					   $empresasResult= $empresasListArrayEmpresa["empresa"];
					   $empresasResultAlias= $empresasListArrayEmpresa["alias"];
					   $empresasResultEstado= $empresasListArrayEmpresa["estado"];
					   if( ($empresasResultEstado == 99) || ($empresasResultEstado == 4) || ($empresasResultEstado== 0)  ){
					   }else{
					     $option.= " <option value='".$empresasResult."'>".$empresasResultAlias."</option>";
					   }
					}
					echo $option;
					//print_r($empresasListArray);
					//$option .= " <option value='".$empresasListArray["empresa"]."'>".$empresasListArray["empresa"]."</option>";
					//echo $option;
					//echo "true";
				}else{
					echo "false";
				}
		  
    }
?>