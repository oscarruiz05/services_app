<?php

require("DBManager.php");

class UsuarioManager extends DBManager {
//   const "http://www.grupologisnovasoft.com/WsAppMovil/"=""http://www.grupologisnovasoft.com/WsAppMovil/"";
  public function UsuarioManager() {
    parent::DBManager();
  }
  public function saveUsuario($identificacion, $correo,$tipousuario,$clave,$Nombre){
  //echo "identificacion= ".$identificacion." correo= ".$correo." clave= ".$clave." \n";
  $todate = date("Y-m-d h:i:s");  	
    
  $array = array('correo1' => 'info@grupologis.co',
                 //'correo2'=>'jacs3d@gmail.com',
                );
    
     
    $subject = 'Registro usuario Nuevo App'; 
    $message = "Le informamos que el usuario identificado con cedula ". $identificacion." con el correo ".$correo." se ha registrado en la app\n" ; 
    $headers = 'From: info@grupologis.co'."\r\n" . 
        'X-Mailer: PHP/' . phpversion(); 
    foreach ($array as $i => $value) {
      
      mail($value, $subject, $message, $headers); 
    }
    parent::executeQuery("SET NAMES UTF8;");
     parent::Delete('usuarios', array( 'identificacion' => $identificacion ));
    return parent::Insert(array('identificacion' => $identificacion, 'correo' =>  $correo , 'tipousuario' => $tipousuario,
	'clave' => $clave,'nombre'=>$Nombre,'fhingreso' => $todate,'foto' => ''), 'usuarios');
	/*$response = parent::Insert(array('identificacion' => $identificacion, 'correo' =>  $correo , 'clave' => $clave,'fhingreso' => $todate), 
	'usuarios');*/
    
    /*if($response == "true"){
    	return parent::LastInsertID();
		return "true";
    }else{
    	return "false";
    }*/
  }
  public function MailUser($correa){
	  $record = parent::executeQuery("SELECT count(*) AS total 
	                                 FROM `usuarios` 
									 WHERE correo = '".$correa."' ");
      return $record;
  }
  public function callWebServiceResgisroCliente($method){
	  $url ="http://www.grupologisnovasoft.com/WsAppMovil/"."RegisterCliente?".$method." ";
	  $json = file_get_contents($url);
	  $array = json_decode($json,true);
	  //print_r($array);
	  return $array;
  }

  public function callWebServiceResgisroEmpleado($method){
    //   $url ="http://grupologisnovasoft.com/WsAppMovil/RegisterEmpleado?".$method." ";
	  $url ="http://www.grupologisnovasoft.com/WsAppMovil/"."RegisterEmpleado?".$method." ";
	  $json = file_get_contents($url);
	  $array = json_decode($json,true);
	  //print_r($array);
	  return $array;
  }
  public function callWebServicePerfil($method){
	//   $url ="http://grupologisnovasoft.com/WsAppMovil/PerfilEmpleado?".$method." ";
	  $url ="http://www.grupologisnovasoft.com/WsAppMovil/"."PerfilEmpleado?".$method." ";
	  $json = file_get_contents($url);
	  $array = json_decode($json,true);

	  return $array;
  }  
  
  public function callWebServiceFotoPerfil($method){
    $url ="http://www.grupologisnovasoft.com/WsAppMovil/"."GetFotoEmpleado?".$method."";
    $json = file_get_contents($url);
    $array=$json;
    // $array = json_decode($json,true);
    //print_r($array);
    return $url;
} 

  public function callWebServicePerfilCliente($method){
	  //echo "http://www.grupologisnovasoft.com/WsAppMovil/"."PerfilCliente?".$method."; ";
	  $url ="http://www.grupologisnovasoft.com/WsAppMovil/"."PerfilCliente?".$method." ";
	  $json = file_get_contents($url);
	  $array = json_decode($json,true);
	  //print_r($array);
	  return $array;
  }
  
  public function callWebServiceCertificadoRetencion($method){
	  //echo "http://www.grupologisnovasoft.com/WsAppMovil/"."CertificadoIngresos?".$method." ";
	  $url ="http://www.grupologisnovasoft.com/WsAppMovil/"."CertificadoIngresos?".$method." ";
	  $json = file_get_contents($url);
	  $array = json_decode($json,true);
	  //print_r($array);
	  return $array;
  }
   public function callWebServiceFacturaCliente($method){
	   //echo "http://www.grupologisnovasoft.com/WsAppMovil/"."FacturasCliente?".$method." ";
	  $url ="http://www.grupologisnovasoft.com/WsAppMovil/"."FacturasCliente?".$method." ";
	  $json = file_get_contents($url);
	  $array = json_decode($json,true);
	  //print_r($array);
	  return $array;
  }
   public function callWebServiceHojaVida($method){
	  //echo "http://www.grupologisnovasoft.com/WsAppMovil/"."ListaDocEmpleado?".$method." ";
	  $url ="http://www.grupologisnovasoft.com/WsAppMovil/"."ListaDocEmpleado?".$method." ";
	  $json = file_get_contents($url);
	  $array = json_decode($json,true);
	  //print_r($array);
	  return $array;
  }  
  public function callWebServiceHojaVidaClien($method){
	  //echo "http://www.grupologisnovasoft.com/WsAppMovil/"."ListaDocEmpleado?".$method." ";
	  $url ="http://www.grupologisnovasoft.com/WsAppMovil/"."EmpleadosCliente?".$method." ";
	  $json = file_get_contents($url);
	  $array = json_decode($json,true);
	  //print_r($array);
	  return $array;
  }
  
  
  public function callWebServiceSeleccion($method){
	  //echo "http://www.grupologisnovasoft.com/WsAppMovil/"."GenerarSeleccion?".$method."  ";
	  $url ="http://www.grupologisnovasoft.com/WsAppMovil/"."GenerarSeleccion?".$method." ";
	  $json = file_get_contents($url);
	  $array = json_decode($json,true);
	  //print_r($array);
	  return $array;
  }
  public function callWebServiceCapacitacion($method){
	  // echo "http://www.grupologisnovasoft.com/WsAppMovil/"."GenerarSeleccion?".$method."  ";
	  $url ="http://www.grupologisnovasoft.com/WsAppMovil/"."CapacitacionesCliente?".$method." ";
	  $json = file_get_contents($url);
	  $array = json_decode($json,true);
	  //print_r($array);
	  return $array;
  
  }
  public function callWebServiceVolanteNomina($method){
	  //echo "http://www.grupologisnovasoft.com/WsAppMovil/"."VolanteNomina?".$method."  ";
	  $url ="http://www.grupologisnovasoft.com/WsAppMovil/"."VolanteNomina?".$method." ";
	  $json = file_get_contents($url);
	  $array = json_decode($json,true);
	  //print_r($array);
	  return $array;
  
  }  
  public function callWebServiceListQuejas($method){
	  //echo "http://www.grupologisnovasoft.com/WsAppMovil/"."VolanteNomina?".$method."  ";
	  $url ="http://www.grupologisnovasoft.com/WsAppMovil/"."QuejasEmpleado?".$method." ";
	  $json = file_get_contents($url);
	  $array = json_decode($json,true);
	  //print_r($array);
	  return $array;
  
  }  
   public function callWebServiceQuejas($method){
	  //echo "http://www.grupologisnovasoft.com/WsAppMovil/"."GenerarQueja?".$method."  ";
	  /*$url ="http://www.grupologisnovasoft.com/WsAppMovil/"."GenerarQueja?".$method." ";
	  $json = file_get_contents($url);
	  $array = json_decode($json,true);
	  //print_r($array);
	  return $array;*/
	  
	  $servicio="http://www.grupologisnovasoft.com/WsAppMovil/"."GenerarQueja"; //url del servicio
  	  $parametros=array(); //parametros de la llamada
	  $parametros['idioma']="es";
	  $parametros['usuario']="manolo";
	  $parametros['clave']="tuclave";
	  $client = new SoapClient($servicio, $method);
	  return $client;
  
  }  
  
  
  
  
  public function saveEmpresaEmpleado($identificacion, $empresa, $estado){
	  $todate = date("Y-m-d h:i:s");
	  parent::executeQuery("SET NAMES UTF8;");
	  parent::Delete('empresas', array( 'identificacion' => $identificacion,'empresa' =>  $empresa ));
      return parent::Insert(array('identificacion' => $identificacion, 'empresa' =>  $empresa , 'estado'=>  $estado ,'fhingreso' => $todate), 'empresas');
  }
  
  public function getEmpresa($identificacionId) {
	//echo "empresa= ".$identificacionId;
    $record = parent::executeQuery("SELECT e.id,e.empresa,e.estado,
									a.alias
									FROM empresas AS e
									INNER JOIN alias AS a ON e.empresa = a.empresa 
									WHERE e.identificacion='".$identificacionId."' AND (e.estado != 0 OR e.estado != 99 OR e.estado != 4)
									ORDER BY a.alias ");
	/*echo "SELECT e.id,e.empresa,e.estado,
									a.alias
									FROM empresas AS e
									INNER JOIN alias AS a ON e.empresa = a.empresa 
									WHERE e.identificacion='".$identificacionId."' AND (e.estado != 0 OR e.estado != 99 OR e.estado != 4)
									ORDER BY a.alias ";*/
    return $record;
  }
  public function validationUsuario($clave, $identificacion) {

    $record = parent::executeQuery("SELECT COUNT(*)AS existe FROM usuarios WHERE clave='".$clave."' AND identificacion='".$identificacion. "' ");
	//echo "SELECT COUNT(*)AS existe FROM usuarios WHERE clave='".$clave."' AND identificacion='".$identificacion. "' ";
    return $record;
  }
   public function getNoticiaHabilitada($empresaId,$tipousuarioId) {
	
    $record = parent::executeQuery("SELECT 	idnoticia,titulo,mensaje,correo,empresa,estado,ruta,tipo,fhingreso 
									FROM noticias 
									WHERE estado = 1 AND (empresa = '' OR empresa = '".$empresaId."')  
									AND (tipo = 0 OR tipo = ".$tipousuarioId.")
									ORDER BY idnoticia DESC 
									LIMIT 1");
					/*echo "SELECT 	idnoticia,titulo,mensaje,correo,empresa,estado,ruta,tipo,fhingreso 
									FROM noticias 
									WHERE estado = ".$tipousuarioId." AND (empresa = '' OR empresa = '".$empresaId."')
									ORDER BY idnoticia DESC 
									LIMIT 1";*/
    return $record;
  }
 

}
