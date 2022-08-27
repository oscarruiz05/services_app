<?
header('Access-Control-Allow-Origin: *');
/*foreach ($_POST as $c => $v){
  echo $c." = ".$v."<br>";
}*/
$idQuejas = $_POST["idQuejas"];
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
    $subject = "Resgitro de su quejas con la referencia numero ".$idQuejas; 
    $message = "
	Estimado (a),\r\n
	Debido a nuestros estándares de calidad, Le informamos que hemos recibido su solicitud y está siendo procesada mediante Queja N° ".$idQuejas.".\r\n
	Nuestra área de atención al cliente estará comunicándose con usted.\r\n
	Cordialmente,\r\n\r\n\r\n
	
	Gestor de  Atención al cliente \r\n
	info@grupologis.co\r\n
	Tel.: 385 3362 - 385 3363 Ext. 134 \r\n
	Cel : 3185166257\r\n
	Calle 64 No 50 – 03 Barranquilla \r\n
	www.grupologis.co";

    $headers = 'From: info@grupologis.co'."\r\n" . 
        'X-Mailer: PHP/' . phpversion(); 
     //echo mail($Email, $subject, $message, $headers);
      if(mail($Email, $subject, $message, $headers)){
		  echo "TRUE";
	  }else{
		  echo "FALSE";
	  }

?>