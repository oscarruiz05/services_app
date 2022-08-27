<?
header('Access-Control-Allow-Origin: *'); 
include('../dbmanagers/class_conexion.php');
$BD = new class_conexion();
$idnoticia = $_POST["idnoticia"];
$sql = "DELETE FROM noticias
	    WHERE idnoticia = '".$idnoticia."' ";
        $rusult = $BD->ejecutar_sql($sql);
		if($rusult){
			echo "TRUE";
		}else{
			echo "FALSE";
		}
?>