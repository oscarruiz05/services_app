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
    $prestamos = callWebServicePruebas($method,'https://apps.grupologis.co/WsMovilApp/PrestamosEmpleado');
    $embargos = callWebServicePruebas($method,'https://apps.grupologis.co/WsMovilApp/EmbargosEmpleado');
    $novedadesFijas = callWebServicePruebas($method,'https://apps.grupologis.co/WsMovilApp/NovedadesFijasEmpleado');
    $volantesUltimosMeses = callWebServicePruebas($method,'https://apps.grupologis.co/WsMovilApp/VolantesUltimosMeses');
    $historiaLaboral = callWebServicePruebas($method,'https://apps.grupologis.co/WsMovilApp/HistoriaLaboralEmpleado');
    
    if($nomina["Correcto"]==$nomina["Existe"]&&$nomina["Correcto"]==1){
        $nomina=array(
            "CodCargo"=>$nomina["CodCargo"],
            "NombreCargo"=>mb_strtolower($nomina["NombreCargo"],'UTF-8'),
            "FechaIngreso"=>$nomina["FechaIngreso"],
            "Salario"=>$nomina["Salario"],
            "NoCuentaBanco"=>$nomina["NoCuentaBanco"]
            );
    }else{
        $nomina="";
    }
    
    if($prestamos["Correcto"]==$prestamos["Existe"]&&$prestamos["Correcto"]==1  && count($prestamos["Prestamos"])>0){
        $prestamos=$prestamos["Prestamos"];
    }else{
        $prestamos="";
    }
    
    if($prestamosFinancap["codigo"]==200){
        $prestamosFinancap=$prestamosFinancap["data"];
    }else{
        $prestamosFinancap="";
    }
    
    if($embargos["Correcto"]==$embargos["Existe"]&&$embargos["Correcto"]==1  && count($embargos["Embargos"])>0){
        $embargos=$embargos["Embargos"];
    }else{
        $embargos="";
    }
    
    if($novedadesFijas["Correcto"]==$novedadesFijas["Existe"]&&$novedadesFijas["Correcto"]==1  && count($novedadesFijas["NovedadesFijas"])>0){
        $novedadesFijas=$novedadesFijas["NovedadesFijas"];
    }else{
        $novedadesFijas="";
    }
    
    if($volantesUltimosMeses["Correcto"]==1){
        $volantesUltimosMeses=array(
            "name"=>$volantesUltimosMeses["name"],
            "file"=>$volantesUltimosMeses["file"],
            "mimetype"=>$volantesUltimosMeses["mimetype"]
            );
    }else{
        $volantesUltimosMeses="";
    }

    if($historiaLaboral["Correcto"]==$historiaLaboral["Existe"] && $historiaLaboral["Correcto"]==1 && count($historiaLaboral["HistoriaLaboral"])>0){
        $historiaLaboral=$historiaLaboral["HistoriaLaboral"];
    }else{
        $historiaLaboral="";
    }
    
    $response=array(
        "nombre"=>mb_strtolower($registro["Nombre"],'UTF-8'),
        "email"=>$registro["Email"],
        "identificacion"=>$identificacion,
        "nomina"=>$nomina,
        "prestamos"=>$prestamos,
        "prestamosFinancap"=>$prestamosFinancap,
        "embargos"=>$embargos,
        "novedadesFijas"=>$novedadesFijas,
        "historiaLaboral"=>$historiaLaboral,
        "volantesUltimosMeses"=>$volantesUltimosMeses
        );
    
    echo json_encode($response);
}
?>


       
