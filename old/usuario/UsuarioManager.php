<?php

require("DBManager.php");

class UsuarioManager extends DBManager {

  public function UsuarioManager() {
    parent::DBManager();
  }
  public function saveUsuario($identificacion, $correo,$tipousuario,$clave){
	  //echo "identificacion= ".$identificacion." correo= ".$correo." clave= ".$clave." \n";
	  $todate = date("Y-m-d h:i:s");  	
		
	  $array = array('correo1' => 'info@grupologis.co',
			 'correo2'=>'jacs3d@gmail.com');
			 //'correo3'=>'info@jacs3d.com',
			 //'prueba'=>'umbrellax2003@gmail.com'
		
		 
		$subject = 'Registro usuario Nuevo App'; 
		$message = "Le informamos que el usuario identificado con cedula ". $identificacion." con el correo ".$correo." se ha registrado en la app\n" ; 
		$headers = 'From: info@grupologis.co'."\r\n" . 
			'X-Mailer: PHP/' . phpversion(); 
		foreach ($array as $i => $value) {
		  
		  mail($value, $subject, $message, $headers); 
		}
		parent::executeQuery("SET NAMES UTF8;");
	  
		return parent::Insert(array('identificacion' => $identificacion, 'correo' =>  $correo , 'tipousuario' => $tipousuario,
		'clave' => $clave,'fhingreso' => $todate), 'usuarios');
		/*$response = parent::Insert(array('identificacion' => $identificacion, 'correo' =>  $correo , 'clave' => $clave,'fhingreso' => $todate), 
		'usuarios');*/
		
		/*if($response == "true"){
			return parent::LastInsertID();
			return "true";
		}else{
			return "false";
		}*/
  }
  public function getNoticiaHabilitada($empresaId,$tipousuarioId) {
    $record = parent::executeQuery("SELECT * 
	                                FROM noticias 
									WHERE estado = 1 AND empresa='".$empresaId."' AND tipo = '".$tipousuarioId."'
									ORDER BY idnoticia DESC 
									LIMIT 1");
                               
							   /*echo "SELECT *,count(empresa) AS num 
	                                FROM noticias 
									WHERE estado = 1 AND empresa=".$empresaId." 
									LIMIT 1";*/
    return $record;
  }
  public function callWebServiceResgisroCliente($method){
	  $url ="http://www.grupologisnovasoft.com/WsAppMovil/RegisterCliente?".$method." ";
	  $json = file_get_contents($url);
	  $array = json_decode($json,true);
	  //print_r($array);
	  return $array;
  }
  public function callWebServiceResgisroEmpleado($method){
	  $url ="http://www.grupologisnovasoft.com/WsAppMovil/RegisterEmpleado?".$method." ";
	  $json = file_get_contents($url);
	  $array = json_decode($json,true);
	  //print_r($array);
	  return $array;
  }
  public function callWebServiceCertificadoRetencion($method){
	  //echo "http://www.grupologisnovasoft.com/WsAppMovil/CertificadoIngresos?".$method." ";
	  $url ="http://www.grupologisnovasoft.com/WsAppMovil/CertificadoIngresos?".$method." ";
	  $json = file_get_contents($url);
	  $array = json_decode($json,true);
	  //print_r($array);
	  return $array;
  }
  public function callWebServicePerfil($method){
	  //echo "http://www.grupologisnovasoft.com/WsAppMovil/CertificadoIngresos?".$method." ";
	  $url ="http://grupologisnovasoft.com/WsAppMovil/PerfilEmpleado?".$method." ";
	  $json = file_get_contents($url);
	  $array = json_decode($json,true);
	  //print_r($array);
	  return $array;
  }
   public function callWebServiceFacturaCliente($method){
	   //echo "http://www.grupologisnovasoft.com/WsAppMovil/FacturasCliente?".$method." ";
	  $url ="http://www.grupologisnovasoft.com/WsAppMovil/FacturasCliente?".$method." ";
	  $json = file_get_contents($url);
	  $array = json_decode($json,true);
	  //print_r($array);
	  return $array;
  }
  public function callWebServiceSeleccion($method){
	  //echo "http://www.grupologisnovasoft.com/WsAppMovil/GenerarSeleccion?".$method."  ";
	  $url ="http://www.grupologisnovasoft.com/WsAppMovil/GenerarSeleccion?".$method." ";
	  $json = file_get_contents($url);
	  $array = json_decode($json,true);
	  //print_r($array);
	  return $array;
  }
  public function callWebServiceCapacitacion($method){
	  // echo "http://www.grupologisnovasoft.com/WsAppMovil/GenerarSeleccion?".$method."  ";
	  $url ="http://www.grupologisnovasoft.com/WsAppMovil/CapacitacionesCliente?".$method." ";
	  $json = file_get_contents($url);
	  $array = json_decode($json,true);
	  //print_r($array);
	  return $array;
  
  }
  public function callWebServiceVolanteNomina($method){
	  echo "http://www.grupologisnovasoft.com/WsAppMovil/VolanteNomina?".$method."  ";
	  $url ="http://www.grupologisnovasoft.com/WsAppMovil/VolanteNomina?".$method." ";
	  $json = file_get_contents($url);
	  $array = json_decode($json,true);
	  //print_r($array);
	  return $array;
  
  }  
  
  /*public function callWebServiceVolanteNomina(){
	  $url ="http://www.grupologisnovasoft.com/WsAppMovil/VolanteNomina?Anho=2016&Mes=03&Empresa=Nova_PPal&Cedula=1001778465 ";
	  $json = file_get_contents($url);
	  $array = json_decode($json,true);
	  print_r($array);
	  return $array;
  }*/
  
  public function saveEmpresaEmpleado($identificacion, $empresa, $estado){
	  $todate = date("Y-m-d h:i:s");
	  parent::executeQuery("SET NAMES UTF8;");
	  parent::Delete('empresas', array( 'identificacion' => $identificacion,'empresa' =>  $empresa ));
      return parent::Insert(array('identificacion' => $identificacion, 'empresa' =>  $empresa , 'estado'=>  $estado ,'fhingreso' => $todate), 'empresas');
  }
  
  public function getEmpresa($identificacionId) {
	//echo "empresa= ".$identificacionId;
    $record = parent::executeQuery("SELECT empresa 
	                                FROM empresas 
									WHERE estado = 1 and identificacion='".$identificacionId."'
									ORDER BY empresa ");
	/*echo "SELECT empresa 
	                                FROM empresas 
									WHERE estado = 1 and identificacion='".$identificacionId."'
									ORDER BY empresa ";*/
    return $record;
  }
  public function validationUsuario($clave, $identificacion) {

    $record = parent::executeQuery("SELECT COUNT(*)AS existe FROM usuarios WHERE clave='".$clave."' AND identificacion='".$identificacion. "' ");
	//echo "SELECT COUNT(*)AS existe FROM usuarios WHERE clave='".$clave."' AND identificacion='".$identificacion. "' ";
    return $record;
  }
 public function validationUsuarioWeb($usuario, $clave) {

    $record = parent::executeQuery("SELECT COUNT(*)AS existe FROM usuarios_app WHERE clave='".$clave."' AND usuario='".$usuario. "' ");
	//echo "SELECT COUNT(*)AS existe FROM usuarios WHERE clave='".$clave."' AND identificacion='".$identificacion. "' ";
    return $record;
  } 
 

}
?>