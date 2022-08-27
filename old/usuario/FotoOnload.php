<?
header('Access-Control-Allow-Origin: *');
if($_FILES['file']){
echo "archivo= ".$_FILES['file']; 
echo $method = "CodEmpleado=1140842635&Empresa=InnSer&Foto=prueba".$_FILES['file'];

			// abrimos la sesión cURL
			$ch = curl_init();
			// definimos la URL a la que hacemos la petición
			curl_setopt($ch, CURLOPT_URL,"http://www.grupologisnovasoft.com/WsAppMovil/SetFotoEmpleado");
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
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title</title>
</head>
<body>
<form action="FotoOnload.php" method="post" enctype="multipart/form-data">
<label for="archivo">file:</label>
<input type="file" name="file" id="file" />
<br/>
<input type="submit" value="Enviar" />
</form>
</body>
</html>