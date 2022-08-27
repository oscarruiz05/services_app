<?php
header('Access-Control-Allow-Origin: *');
include('../dbmanagers/class_conexion.php');
require_once "../dbmanagers/UsuarioManager.php";

function getToken(){
    // // ----------GET TOKEN---------------------------------------
    $BD = new class_conexion();
    $usu = "SELECT user,password FROM user_token_generate LIMIT 1";
    $rusu = $BD->ejecutar_sql($usu);
    $fila = $BD->fetch_array($rusu);
    $user = $fila["user"];
    $password = $fila["password"];
    
    $firtsCharacter = array();
    $firtsCharacter[1] = "Q";
    $firtsCharacter[2] = "A";
    $firtsCharacter[3] = "Z";
    $firtsCharacter[4] = "W";
    $firtsCharacter[5] = "S";
    $firtsCharacter[6] = "X";
    $firtsCharacter[7] = "E";
    $firtsCharacter[8] = "D";
    $firtsCharacter[9] = "F";
    
    $firts = rand(1, 9);
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz@*ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $prefijo = substr(str_shuffle($permitted_chars), ($firts * 2), ($firts * 2));
    $subfijo = substr(str_shuffle($permitted_chars), ($firts * 2), ($firts * 2));
    
    $value = "user=" . $user . "&password=" . $password;
    $value = base64_encode($value);
    
    $datos_post = http_build_query(
        array(
            'value' => $firtsCharacter[$firts] . $prefijo . $value . $subfijo,
        )
    );
    
    $opciones = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => $datos_post
    ));
    $contexto = stream_context_create($opciones);
    $resultado = file_get_contents('https://apps.grupologis.co/WsMovilApp/TokenSeguridad', false, $contexto);
    $data = json_decode($resultado, true);
    
    return $data["token"];
}

$token=getToken();
$usuarioManager = new UsuarioManager();
if(isset($_GET['empresa'])){
    $method = "codempleado=".$_GET['cod_emp']."&Empresa=".$_GET['empresa']."&token=".$token;
}else{
    $headers = apache_request_headers();
    if(!isset($headers['Authorization'])||$headers['Authorization']!=="QCpHUlVQT0xPR0lTMjAyMiE"){
        echo json_encode(['Correcto'=>0,'Error'=>'No Auth']);
        return;
    }
    $empresas=$usuarioManager->callWebServiceResgisroEmpleado("CodEmpleado=".$_GET['cod_emp']."&token=$token");
    if(isset($empresas['Empresas'])){
        $empresas=$empresas['Empresas'];
    }
    $empresaKey=array_search(1,array_column($empresas,"Estado"));
    if($empresaKey!==false){
        $method = "codempleado=".$_GET['cod_emp']."&Empresa=".$empresas[$empresaKey]['Empresa']."&token=".$token;
    }else{
        echo json_encode(['Correcto'=>0,'Error'=>'No se encontró el empleado en nuestra base de datos']);
        return;
    }
}
$perfilWebService = $usuarioManager->callWebServicePerfil($method);
echo json_encode($perfilWebService);