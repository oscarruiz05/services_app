<?php
header('Access-Control-Allow-Origin: *'); 
$Anho = $_POST["Anho"];
$Empresa = $_POST["Empresa"];
$Cedula = $_POST["Cedula"];
$method = "Anho=".$Anho."&Empresa=".$Empresa."&Cedula=".$Cedula." ";
header("Content-disposition: attachment; filename=http://www.grupologisnovasoft.com/WsAppMovil/CertificadoIngresos?".$method."");
/*foreach ($_POST as $c => $v){
  echo $c." = ".$v."<br>";
}*/
/*$certificadoR="";
$usuarioWebC = "";
$usuarioWebE = "";
$usuarioWebInsert = "";
$empresasList = "";
require_once "../dbmanagers/UsuarioManager.php";
$usuarioManager = new UsuarioManager();
$Anho = $_POST["Anho"];
$Empresa = $_POST["Empresa"];
$Cedula = $_POST["Cedula"];
$method = "Anho=".$Anho."&Empresa=".$Empresa."&Cedula=".$Cedula." ";
$certificadoR = $usuarioManager->callWebServiceCertificadoRetencion($method);
echo json_encode($certificadoR);*/

?>