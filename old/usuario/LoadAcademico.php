<?php
header('Access-Control-Allow-Origin: *'); 
include('../dbmanagers/class_conexion.php');
$BD = new class_conexion();

 $sql1 = "SELECT n.idacademico,n.nombre,n.fhingreso
		  FROM nivelacademico AS n
		  ORDER BY n.nombre DESC";
  	      $result1 = $BD->ejecutar_sql($sql1);
?>
          <option value="">Nivel Académico</option>
<?			
		    while($filaA = $BD->fetch_array($result1)){
			  $idacademico 	 = $filaA["idacademico"];
			  $nombre		 = $filaA["nombre"];
			  $fhingreso     = $filaA["fhingreso"];

?>
    <option value="<?=$nombre?>"><?=$nombre?></option>
<?
}
?>
