<?php
header('Access-Control-Allow-Origin: *'); 
/*$url ="http://www.grupologisnovasoft.com/WsAppMovil/VolanteNomina?Anho=2016&Mes=03&Empresa=Nova_PPal&Cedula=1001778465 ";
	  $json = file_get_contents($url);
	  $array = json_decode($json,true);
	  echo "prueba=".$array;*/
	  //print_r($array);


/*$c = curl_init('http://www.grupologisnovasoft.com/WsAppMovil/VolanteNomina?Anho=2016&Mes=07&Empresa=InnSer&Cedula=22581361');
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
curl_setopt($c, CURLOPT_USERPWD, 'FDW:PASS');
$page = curl_exec($c);
curl_close($c);
echo $page;*/

$ch = curl_init();
$source = "http://www.grupologisnovasoft.com/WsAppMovil/VolanteNomina?Anho=2016&Mes=07&Empresa=InnSer&Cedula=22581361";
curl_setopt($ch, CURLOPT_URL, $source);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);
$destination = dirname(__FILE__) . '/file.pdf';
$file = fopen($destination, "w+");
fputs($file, $data);
fclose($file);
$filename = 'walter.pdf';

header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-Disposition: attachment; filename=$filename");
header("Content-Type: application/pdf");
header("Content-Transfer-Encoding: binary");
readfile($destination);
/*$página_inicio = file_get_contents("http://www.grupologisnovasoft.com/WsAppMovil/VolanteNomina?Anho=2016&Mes=01&Empresa=Nova_PPal&Cedula=1007188417");
echo $página_inicio;*/

// abrimos la sesión cURL
/*
$ch = curl_init();
// definimos la URL a la que hacemos la petición
curl_setopt($ch, CURLOPT_URL,"http://www.grupologisnovasoft.com/WsAppMovil/GenerarQueja");
// definimos el número de campos o parámetros que enviamos mediante POST
curl_setopt($ch, CURLOPT_POST, 1);
// definimos cada uno de los parámetros
curl_setopt($ch, CURLOPT_POSTFIELDS, "Empresa=GesLab&IdUsuario=55248312&NombreUsuario=prueba&Archivo=&Asunto=prueba&Detalle=prueba");
// recibimos la respuesta y la guardamos en una variable
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$remote_server_output = curl_exec ($ch);
// cerramos la sesión cURL
curl_close ($ch);
// hacemos lo que queramos con los datos recibidos
// por ejemplo, los mostramos
/print_r($remote_server_output);
*/

/*$file = "http://www.grupologisnovasoft.com/WsAppMovil/VolanteNomina?Anho=2016&Mes=07&Empresa=InnSer&Cedula=22581361"


    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
    exit();*/


?>