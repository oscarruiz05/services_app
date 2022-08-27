<?php
header('Access-Control-Allow-Origin: *'); 
/*foreach ($_POST as $c => $v){
  echo $c." = ".$v."<br>";
}*/
$seleccion="";
$seleccionArray="";
require_once "../dbmanagers/UsuarioManager.php";
$usuarioManager = new UsuarioManager();
$method = "NitCliente=".$_POST['NitCliente']."&Salario=".$_POST['Salario']."&Uso=".$_POST['Uso']."&Auxilio=".$_POST['Auxilio']."&Horario=".$_POST['Horario']."&Ciudad=".$_POST['Ciudad']."&Experiencia=".$_POST['Experiencia']."&Cargo=".$_POST['Cargo']."&NivelAcademico=".$_POST['NivelAcademico']."&Observacion=".$_POST['Observacion']." ";
$seleccion = $usuarioManager->callWebServiceSeleccion($method);
echo $seleccion;
?>


       
