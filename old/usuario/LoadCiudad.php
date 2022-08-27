<?php
header('Access-Control-Allow-Origin: *'); 
include('../dbmanagers/class_conexion.php');
$BD = new class_conexion();

 $sql1 = "SELECT c.idciudad,c.nombre,c.fhingreso
		  FROM ciudades AS c
		  ORDER BY c.nombre ASC";
  	      $result1 = $BD->ejecutar_sql($sql1);
?>
          <option value="">Seleccionar Ciudad</option>
<?			
		    while($filaA = $BD->fetch_array($result1)){
			  $idciudad 	 = $filaA["idciudad"];
			  $nombre		 = $filaA["nombre"];
			  $fhingreso     = $filaA["fhingreso"];

?>
    <option value="<?=$nombre?>"><?=$nombre?></option>
<?
}
?>
