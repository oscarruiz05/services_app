<?php
namespace Models;

use mysqli;

class ClassConexion
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
    
    public function __construct(){

        /* condicion conexion */
        $production = true;

        if($production != true){
            $this->bd_host = "localhost";
            $this->bd_usuario = "root";
            $this->bd_contrasena = "";
            $this->bd_base = "grupolog_app";
            $this->bd_id = $this->classConexion();
        }else{
            $this->bd_host = "localhost";
            // $this->bd_host = "mysql"; //Docker
            $this->bd_usuario = "grupolog_app";
            $this->bd_contrasena = "poiu0987";
            $this->bd_base = "grupolog_app";
            $this->bd_id = $this->classConexion();
        }

        
    }

    public function classConexion(){ // crea la conexion db
        $mysqli = new mysqli($this->bd_host, $this->bd_usuario, $this->bd_contrasena, $this->bd_base);
        if ($mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }
        return $mysqli;
    }
    public function ejecutarSql($consulta){ // ejecutar consultas sq 
        $cons = "SET NAMES 'utf8'".$consulta;
        $this->bd_registros = mysqli_query($this->bd_id,$consulta );// or die("NO SE PUDO CONECTAR");
        echo mysqli_error($this->bd_id);
        return $this->bd_registros;	   
	}

    public function fetchArray(){
        $this->bd_cadena = mysqli_fetch_array($this->bd_registros);
		echo mysqli_error($this->bd_id);
        return $this->bd_cadena;
    }
}
?>