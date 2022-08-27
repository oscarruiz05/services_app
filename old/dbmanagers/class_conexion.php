<?php
class class_conexion
{
 	public $bd_id;
	public $filas;
	public $bd_select;
	private $bd_host;
	private $bd_usuario;
	private $bd_contrasena;
	private $bd_base;
	public $bd_registros;
	public $bd_resulset;
    public $bd_cadena;

    public function class_conexion(){
      $this->bd_host = "localhost";
      $this->bd_usuario = "grupolog_app";
      $this->bd_contrasena = "poiu0987";
      $this->bd_base = "grupolog_app";
      $this->bd_id = mysql_connect($this->bd_host, $this->bd_usuario, $this->bd_contrasena);
      $this->bd_select = mysql_select_db($this->bd_base, $this->bd_id);
      echo mysql_error();
    }
     public function ejecutar_sql($consulta){
	   $cons = "SET NAMES 'utf8'".$consulta;
	   $this->bd_registros = mysql_query($consulta, $this->bd_id);// or die("NO SE PUDO CONECTAR");
	   echo mysql_error();
	   return $this->bd_registros;	   
	 }

   public function ejecutar_sql2($consulta){
	   $cons = "SET NAMES 'utf8'".$consulta;
	   $this->bd_registros = mysql_query($consulta, $this->bd_id);// or die("NO SE PUDO CONECTAR");
	   echo mysql_error();
	   return $this->bd_registros;	   
	 }
	 
    public function fetch_array(){
		 $this->bd_cadena = mysql_fetch_array($this->bd_registros);
		 echo mysql_error();
	     return $this->bd_cadena;
	}

	 public function fetch_array_1(){
		 $this->bd_cadena = mysql_fetch_array($this->bd_resultset);
		 echo mysql_error();
	     return $this->bd_cadena;
	}
	public function fetch_array_2($resultado){
		 $this->bd_cadena = mysql_fetch_array($resultado);
		 echo mysql_error();
	     return $this->bd_cadena;
	}

    public function num_rows(){
		//mysql_query($consulta, $this->bd_id);
		$this->bd_clumnas = mysql_num_rows($this->bd_registros);
		echo mysql_error();
	    return $this->bd_clumnas;
	}

	public function almacenar(){
 		   $this->bd_resultset = $this->bd_registros;
	}
	
	public function almacenar2(){
 		   $resultado = $this->bd_registros;
	}
}

?>