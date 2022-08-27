<?php
namespace Models;
require_once("ClassConexion.php");
require_once("Token.php");
use Models\Token;
use Models\ClassConexion;

class UsuarioManager extends ClassConexion
{
    private $tokenClass;

    public function __construct(){ 
        // clearstatcache();
        $this->tokenClass = new Token();
    }

    public function callWebServiceResgisroEmpleado($method){

        $value = $this->tokenClass->completeMethod($method);

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
        $resultado = file_get_contents('https://apps.grupologis.co/WsMovilApp/RegisterEmpleado', false, $contexto);
        return json_decode($resultado, true);
    }

    public function callWebServicePerfil($method){
        $value = $this->tokenClass->completeMethod($method);
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
        $resultado = file_get_contents('https://apps.grupologis.co/WsMovilApp/PerfilEmpleado', false, $contexto);
        // echo $resultado;
        return json_decode($resultado, true);
    }

    public function callWebServiceOrdenIngresoRbiCentroCostos($method){
        $value = $this->tokenClass->completeMethod($method);
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
        $resultado = file_get_contents('https://apps.grupologis.co/WsMovilApp/OrdenIngresoRbiCentroCostos', false, $contexto);
        // echo $resultado;
        return json_decode($resultado, true);
    }

    public function callWebServiceOrdenIngresoRbiCargos($method){
        $value = $this->tokenClass->completeMethod($method);
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
        $resultado = file_get_contents('https://apps.grupologis.co/WsMovilApp/OrdenIngresoRbiCargos', false, $contexto);
        // echo $resultado;
        return json_decode($resultado, true);
    }

    public function callWebServiceOrdenIngresoRbiConvenios($method){
        $value = $this->tokenClass->completeMethod($method);
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
        $resultado = file_get_contents('https://apps.grupologis.co/WsMovilApp/OrdenIngresoRbiConvenios', false, $contexto);
        // echo $resultado;
        return json_decode($resultado, true);
    }

    public function callWebServiceOrdenIngresoRbiCrear($method){
        $value = $this->tokenClass->completeMethod($method);
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
        $resultado = file_get_contents('https://apps.grupologis.co/WsMovilApp/OrdenIngresoRbiCrear', false, $contexto);
        // echo $resultado;
        return json_decode($resultado, true);
    }

    public function callWebServiceOrdenIngresoRbiConsultar($method){
        $value = $this->tokenClass->completeMethod($method);
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
            )
        );
        $contexto = stream_context_create($opciones);
        $resultado = file_get_contents('https://apps.grupologis.co/WsMovilApp/OrdenIngresoRbiConsultar', false, $contexto);
        // echo $resultado;
        return json_decode($resultado, true);
    }

    public function callWebServiceOrdenIngresoRbiNovedadesFijas($method){
        $value = $this->tokenClass->completeMethod($method);
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
            )
        );
        $contexto = stream_context_create($opciones);
        $resultado = file_get_contents('https://apps.grupologis.co/WsMovilApp/OrdenIngresoRbiNovedadesFijas', false, $contexto);
        return json_decode($resultado, true);
    }

    public function callWebServiceOrdenIngresoRbiTiposContratos($method){
        $value = $this->tokenClass->completeMethod($method);
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
            )
        );
        $contexto = stream_context_create($opciones);
        $resultado = file_get_contents('https://apps.grupologis.co/WsMovilApp/OrdenIngresoRbiTiposContratos', false, $contexto);
        return json_decode($resultado, true);
    }

    function callWebService($method,$link,$type){
        $value = $this->tokenClass->completeMethod($method);

        $datos_post = http_build_query(
            array(
                'Value' => $value
            )
        );

        $opciones = array('http' =>
        array(
            'method'  => $type,
            'header'  => 'Content-type: application/x-www-form-urlencoded',
            'content' => $datos_post
        ));
        $contexto = stream_context_create($opciones);
        $resultado = file_get_contents($link, false, $contexto);
        return json_decode($resultado, true);

    }
}
?>