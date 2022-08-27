<?php
header('Access-Control-Allow-Origin: *'); 
include('../dbmanagers/class_conexion.php');
$BD = new class_conexion();

$correo = utf8_decode($_POST['correo']);
$clave   = utf8_decode($_POST['clave']);
/*$correo = "wfperalta@gmail.com";
$clave   = "123456";*/
 
$usu = "SELECT count(*) AS total,clave 
	    FROM usuarios 
	    WHERE correo = '".$correo."'";
$rusu = $BD->ejecutar_sql($usu);
$fila = $BD->fetch_array($rusu);
$total = $fila["total"];
$clave = $fila["clave"];
//echo "sql1 = ".$usu."<br>";
//echo "sql1 = ".$total."<br>";
if($total > 0){
$subject  = "Cambio de movil Grupo Logis";
$headers  = "From: info@grupologis.co";
$headers .= "<info@grupologis.co>\r\n";
//$headers .= "Content-type: text/html";
$headers .= "X-Mailer: Drupal\n"; 
$headers .= 'MIME-Version: 1.0' . "\n"; 
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
$message  = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title></title>
</head>
 <body>
  <center>
	 <img src='img:http://www.appgrupologis.com/app/MovilNew/images/cabeceracorreo.jpg'>
	 <h1>Los Datos de su cuenta acceso:</h1>
	 <p>
	   Ingrese en el siguiente link con el siguiente codigo de seguridad para completar su cambio de movil:
	 </p> 
	 <p><strong>su codigo de seguridad es: ".$clave." </strong></p>
	 <p><strong>Link:</strong> <a href='http://appgrupologis.com/app/MovilNew/newmovil.html?correo=".$correo."'>Cambio de movil</a></p>
   </center> 
 </body>
</html>
";
if(mail($correo, $subject, $message, $headers)){ 
	     echo "TRUE";
	}else{
		echo "ERROR CORREO";
	}
}//fin si el login existe en la tabla
if($total == 0){
	echo "FALSE";//SI NO HAY NINGUN USUARIO QUE COINCIDA
}
?>