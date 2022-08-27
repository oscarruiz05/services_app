<?php
header('Access-Control-Allow-Origin: *'); 
$method = "CodEmpleado=".$_POST["CodEmpleado"]."&Empresa=".$_POST["Empresa"]."&Direccion=".$_POST["Direccion"]."&Email=".$_POST["Email"]."&Telefono=".$_POST["Telefono"]."&Celular=".$_POST["Celular"]."&EstadoCivil=".$_POST["EstadoCivil"];
// abrimos la sesión cURL
$ch = curl_init();
// definimos la URL a la que hacemos la petición
curl_setopt($ch, CURLOPT_URL,"http://www.grupologisnovasoft.com/WsAppMovil/ActualPerfilEmpleado");
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
?>