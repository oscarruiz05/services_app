<?php
header('Access-Control-Allow-Origin: *');
include("../dbmanagers/class_conexion.php");

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


function completeMethod($method)
{
    $BD = new class_conexion();

    $usuAPI = "SELECT user,password FROM user_token_generate LIMIT 1";

    $rusuAPI = $BD->ejecutar_sql($usuAPI);
        
    $f = $BD->fetch_array($rusuAPI);
    $userAPI = $f["user"];

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

    $value = $method . "&user=" . $userAPI;
    $value = base64_encode($value);
    return $firtsCharacter[$firts] . $prefijo . $value . $subfijo;

    
}


function callWebService($method,$link)
{
   
    $value = completeMethod($method);
    $datos_post = http_build_query(
        array(
            'Value' => $value
        )
    );

    $opciones = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => $datos_post
    ));
    $contexto = stream_context_create($opciones);
    $resultado = file_get_contents($link, false, $contexto);
    return json_decode($resultado, true);

}

$token=getToken();
$dataOrdenIngreso=json_decode(file_get_contents('php://input'),true);
$dataOrdenIngreso['token']=$token;

$method = http_build_query($dataOrdenIngreso);

$ordenIngreso = callWebService($method,'https://apps.grupologis.co/WsMovilApp/OrdenIngresoRbiCrear');

if($ordenIngreso["Correcto"]==1){
    $response=['data'=>$_POST,'message'=>'Orden de ingreso creada','status'=>true];
}else{
    $response=['data'=>null,'message'=>$ordenIngreso['Error'],'status'=>false];
}

echo json_encode($response);
?>