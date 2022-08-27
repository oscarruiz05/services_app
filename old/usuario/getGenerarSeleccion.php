<?php
header('Access-Control-Allow-Origin: *'); 

/*foreach ($_POST as $c => $v){
  echo $c." = ".$v."<br>";
}*/
$array=array();
$quejasWebService = "";
//require_once "../dbmanagers/UsuarioManager.php";
//$usuarioManager = new UsuarioManager();
$NitCliente = $_POST["NitCliente"];
$Empresa = $_POST["Empresa"];
$TipoProceso = $_POST["TipoProceso"];
$Cargo = $_POST["Cargo"];
$NumVacantes = $_POST["NumVacantes"];
$Ciudad = $_POST["Ciudad"];
$Horario = $_POST["Horario"];
$Salario = $_POST["Salario"];
$Auxilio = $_POST["Auxilio"];
$ValorAuxilio = $_POST["ValorAuxilio"];
$Funciones = $_POST["Funciones"];
$NivelAcademico = $_POST["NivelAcademico"];
$Experiencia = $_POST["Experiencia"];
$ConocimientosInformaticos = $_POST["ConocimientosInformaticos"];
$Habilidades = $_POST["Habilidades"];
$VisitaDomiciliaria = $_POST["VisitaDomiciliaria"];
$Observacion = $_POST["Observacion"];

$method = "Empresa=".$Empresa."&TipoProceso=".$TipoProceso."&Cargo=".$Cargo."&NumVacantes=".$NumVacantes."&Ciudad=".$Ciudad."&Horario=".$Horario."&Salario=".$Salario."&Auxilio=".$Auxilio."&ValorAuxilio=".$ValorAuxilio."&Funciones=".$Funciones."&NivelAcademico=".$NivelAcademico."&ConocimientosInformaticos=".$ConocimientosInformaticos."&Habilidades=".$Habilidades."&VisitaDomiciliaria=".$VisitaDomiciliaria."&Experiencia=".$Experiencia."&Observacion=".$Observacion."&NitCliente=".$NitCliente;
// abrimos la sesión cURL
$ch = curl_init();
// definimos la URL a la que hacemos la petición
curl_setopt($ch, CURLOPT_URL,"http://www.grupologisnovasoft.com/WsAppMovil/GenerarSeleccion");
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
echo $remote_server_output;
?>
