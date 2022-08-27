<?php
header('Access-Control-Allow-Origin: *'); 
/*foreach ($_POST as $c => $v){
  echo $c." = ".$v."<br>";
}*/
$factura="";
$facturaArray="";
require_once "../dbmanagers/UsuarioManager.php";
$usuarioManager = new UsuarioManager();
$method = "NitCliente=".$_POST['NitCliente']."&Empresa=".$_POST['Empresa']."&Anho=".$_POST['Anho']."&Mes=".$_POST['Mes']." ";
// abrimos la sesión cURL
//$ch = curl_init();
// definimos la URL a la que hacemos la petición
//curl_setopt($ch, CURLOPT_URL,"http://www.grupologisnovasoft.com/WsAppMovil/VolanteNominaGeneral");
// definimos el número de campos o parámetros que enviamos mediante POST
//curl_setopt($ch, CURLOPT_POST, 1);
// definimos cada uno de los parámetros
//curl_setopt($ch, CURLOPT_POSTFIELDS, $method);
// recibimos la respuesta y la guardamos en una variable
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//$remote_server_output = curl_exec ($ch);
// cerramos la sesión cURL
//curl_close ($ch);
// hacemos lo que queramos con los datos recibidos
// por ejemplo, los mostramos
//print_r($remote_server_output);
//$quejasWebService = $usuarioManager->callWebServiceQuejas($method);
//echo "respuesta = ".$quejasWebService;
//print_r($quejasWebService);
//print_r($perfilArray);


//$url  = "http://www.grupologisnovasoft.com/WsAppMovil/VolanteNominaGeneral?".$method;
    //El nombre del archivo donde se almacenara los datos descargados.
//$filePath = dirname(__FILE__).'/test.pdf';

    //Inicializa Curl.
//$ch = curl_init();
   //Pasamos la url a donde debe ir.
//curl_setopt($ch, CURLOPT_URL, $url);
    //Si necesitamos el header del archivo, en este caso no.
//curl_setopt($ch, CURLOPT_HEADER, false);
    //Si necesitamos descargar el archivo.
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //Lee el header y se mueve a la siguiente localización.
    //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    //Cantidad de segundo de limite para conectarse.
//curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
    //Cantidad de segundos de limite para ejecutar curl. 0 significa indefinido.
//curl_setopt($ch, CURLOPT_TIMEOUT, 0);
    //Donde almacenaremos el archivo.
//curl_setopt($ch, CURLOPT_FILE, $filePath);
    //curl_exec ejecuta el script.
	//echo "<br>";
//echo $result = curl_exec($ch);
    //Dejamos de utilizar el archivo creado.
   // fclose($fd);
   // if($result){ //funciono ?
   //      echo "Descarga correcta.";
//}
$source = "http://www.grupologisnovasoft.com/WsAppMovil/VolanteNominaGeneral?".$method;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $source);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSLVERSION,3);
$data = curl_exec ($ch);
$error = curl_error($ch); 
curl_close ($ch);

$destination = "./files/test.pdf";
$file = fopen($destination, "w+");
fputs($file, $data);
fclose($file);

?>


       
