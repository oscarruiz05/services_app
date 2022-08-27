<?php
header('Access-Control-Allow-Origin: *'); 
/*foreach ($_POST as $c => $v){
  echo $c." = ".$v."<br>";
}*/
$usuario="";
require_once "../dbmanagers/UsuarioManager.php";
$usuarioManager = new UsuarioManager();
$usuario = $usuarioManager->validationUsuario($_POST['contactClaveField'],$_POST['contactIdentificacionField']);
$usuarioArray = $usuario;
foreach($usuarioArray as $result){
	$result= $result["existe"];
}
//echo $result;
if($result == "1"){
	echo "true";
}else{
	echo "false";
}
//echo json_encode($usuario);
?>
