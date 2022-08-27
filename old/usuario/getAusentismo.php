<?php
header('Access-Control-Allow-Origin: *'); 
/*foreach ($_POST as $c => $v){
  echo $c." = ".$v."<br>";
}*/
$factura="";
$facturaArray="";
require_once "../dbmanagers/UsuarioManager.php";
$usuarioManager = new UsuarioManager();
$method = "NitCliente=".$_POST['NitCliente']."&Empresa=".$_POST['Empresa']."&Anho=".$_POST['Anho']."&FechaInicial=".$_POST['FechaInicial']."&FechaFinal=".$_POST['FechaFinal']." ";
// abrimos la sesión cURL
$ch = curl_init();
// definimos la URL a la que hacemos la petición
curl_setopt($ch, CURLOPT_URL,"http://www.grupologisnovasoft.com/WsAppMovil/Ausentismo");
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


       
