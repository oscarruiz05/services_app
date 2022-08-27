<?php
header('Access-Control-Allow-Origin: *'); 

/*foreach ($_POST as $c => $v){
  echo $c." = ".$v."<br>";
}*/
$perfil="";
$quejasWebService = "";
//require_once "../dbmanagers/UsuarioManager.php";
//$usuarioManager = new UsuarioManager();
$Empresa = $_POST["Empresa"];
$IdUsuario = $_POST["IdUsuario"];
$tipousuarioId = $_POST["tipousuarioId"];
$Archivo = $_POST["Archivo"];
$Asunto = $_POST["Asunto"];
$Detalle = $_POST["Detalle"];
require_once "../dbmanagers/UsuarioManager.php";
$usuarioManager = new UsuarioManager();
if($tipousuarioId == 1){
	  $methodE = "CodEmpleado=".$_POST['IdUsuario']." ";	
	  $usuarioWebE = $usuarioManager->callWebServiceResgisroEmpleado($methodE);
	  $NombreUsuario = $usuarioWebE["Nombre"];
}
if($tipousuarioId == 2){
	   $methodC = "NitCliente=".$_POST['IdUsuario']." ";
	   $usuarioWebC = $usuarioManager->callWebServiceResgisroCliente($methodC);
	   $NombreUsuario = $usuarioWebC["Nombre"];
}

$method = "Empresa=".$Empresa."&IdUsuario=".$IdUsuario."&NombreUsuario=".$NombreUsuario."&Archivo=".$Archivo."&Asunto=".$Asunto."&Detalle=".$Detalle;
// abrimos la sesión cURL
$ch = curl_init();
// definimos la URL a la que hacemos la petición
curl_setopt($ch, CURLOPT_URL,"http://www.grupologisnovasoft.com/WsAppMovil/GenerarQueja");
// definimos el número de campos o parámetros que enviamos mediante POST
curl_setopt($ch, CURLOPT_POST, 1);
// definimos cada uno de los parámetros
curl_setopt($ch, CURLOPT_POSTFIELDS, $method);
// recibimos la respuesta y la guardamos en una variable
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$remote_server_output = curl_exec ($ch);
// cerramos la sesión cURL
curl_close ($ch);
// hacemos lo que queramos con los datos recibidos
// por ejemplo, los mostramos
print_r($remote_server_output);
//$quejasWebService = $usuarioManager->callWebServiceQuejas($method);
//echo "respuesta = ".$quejasWebService;
//print_r($quejasWebService);
//print_r($perfilArray);
?>
