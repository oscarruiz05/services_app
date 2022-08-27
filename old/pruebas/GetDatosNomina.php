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


function callWebServicePruebas($method,$link)
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

function callWebServiceFinancap($identificacion)
{

    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://admin.financap.co/api/SaldosCreditoTodos',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array('docIde' => $identificacion),
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer WFYPKIPErWe90P7ieNN5wu0vbBbqhyJvAZml9TVozixyKLD7Ngmbv2C9laOf'
      ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    return json_decode($response,true);


}
$token=getToken();
if($_GET["identificacion"]){
    $identificacion=$_GET["identificacion"];
    $method="codempleado=$identificacion&token=$token";
    $registro=callWebServicePruebas($method,'https://apps.grupologis.co/WsMovilApp/RegisterEmpleado');
    $empresas=$registro["Empresas"];
    $empresa="";
    for($i=0;$i<=count($empresas);$i++){
        if($empresas[$i]["Estado"]==1){
            $empresa=$empresas[$i]["Empresa"];
            break;
        }
    }
    
    $method = "CodEmpleado=$identificacion&Empresa=$empresa&token=$token";
    
    $prestamosFinancap=callWebServiceFinancap($identificacion);
    $nomina = callWebServicePruebas($method,'https://apps.grupologis.co/WsMovilApp/NominaDatosGenerales');
    
    
    if($nomina["Correcto"]==$nomina["Existe"]&&$nomina["Correcto"]==1){
        $nomina=array(
            "NombreCargo"=>mb_strtolower($nomina["NombreCargo"],'UTF-8'),
            "FechaIngreso"=>$nomina["FechaIngreso"],
            "Salario"=>$nomina["Salario"],
            );
    }else{
        $nomina="";
    }
    
    echo json_encode($nomina);
}
?>


       
