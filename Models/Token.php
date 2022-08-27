<?php
namespace Models;
require_once('ClassConexion.php');
use Models\ClassConexion;
class Token
{
    private $BD;
    public function __construct(){ 
        // clearstatcache();
        $this->BD = new ClassConexion();

    }

    public function getToken(){
        // // ----------GET TOKEN---------------------------------------
        $BD = $this->BD;
        $usu = "SELECT user,password FROM user_token_generate LIMIT 1";
        $rusu = $BD->ejecutarSql($usu);
        $fila = $BD->fetchArray($rusu);
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
        
        $value = base64_encode("user=" . $user . "&password=" . $password);
        
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
        $BD = new $this->BD;
        $usuAPI = "SELECT user,password FROM user_token_generate LIMIT 1";
        $rusuAPI = $BD->ejecutarSql($usuAPI);
        $f = $BD->fetchArray($rusuAPI);
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
        // echo $firtsCharacter[$firts] . $prefijo . $value . $subfijo;
        return $firtsCharacter[$firts] . $prefijo . $value . $subfijo;
    }
}
?>