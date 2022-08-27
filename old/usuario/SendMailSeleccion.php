<?
header('Access-Control-Allow-Origin: *');
/*foreach ($_POST as $c => $v){
  echo $c." = ".$v."<br>";
}*/
$idSeleccion = $_POST["idSeleccion"];
$IdUsuario = $_POST["IdUsuario"];
$tipousuarioId = $_POST["tipousuarioId"];
require_once "../dbmanagers/UsuarioManager.php";
$usuarioManager = new UsuarioManager();
if($tipousuarioId == 1){
	  $methodE = "CodEmpleado=".$_POST['IdUsuario']." ";	
	  $usuarioWebE = $usuarioManager->callWebServiceResgisroEmpleado($methodE);
	  //print_r($usuarioWebE);
	  $Email = $usuarioWebE["Email"];
}
if($tipousuarioId == 2){
	   $methodC = "NitCliente=".$_POST['IdUsuario']." ";
	   $usuarioWebC = $usuarioManager->callWebServiceResgisroCliente($methodC);
	   $Email = $usuarioWebC["Email"];
}
   
     //$Email = "umbrellax2003@gmail.com";
    $subject = "Resgitro de su Seleccion con la referencia numero ".$idSeleccion; 
    $message = "
	Estimado (a),\r\n
	Debido a nuestros estándares de calidad, Le informamos que hemos recibido su solicitud y está siendo procesada mediante requerimiento de selección N° ".$idSeleccion." .\r\n
	Nuestra área de Selección, estará comunicándose con usted como parte de validación de tiempo de respuesta a tal trámite o validación de perfil del cargo.\r\n
	Cordialmente,\r\n\r\n\r\n
	Coordinadora de Selección \r\n
	seleccion@grupologis.co\r\n
	Tel.: 317 4426249 - 385 3362 Ext. 126 \r\n
	Calle 64 No 50 – 03 Barranquilla \r\n
	www.grupologis.co;"; 
    $headers = 'From: seleccion@grupologis.co'."\r\n" . 
        'X-Mailer: PHP/' . phpversion(); 
      mail("selección@grupologis.co", $subject, $message, $headers);
      if(mail($Email, $subject, $message, $headers)){
		  echo "TRUE";
	  }else{
		  echo "FALSE";
	  }

?>