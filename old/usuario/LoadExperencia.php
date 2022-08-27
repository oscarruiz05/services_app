<?php
header('Access-Control-Allow-Origin: *'); 
include('../dbmanagers/class_conexion.php');
$BD = new class_conexion();

 $sql1 = "SELECT e.idexperencia,e.nombre,e.fhingreso
		  FROM experencias AS e
		  ORDER BY e.nombre DESC";
  	      $result1 = $BD->ejecutar_sql($sql1);
?>
          <option value="">Tiempo Experiencia en el Cargo</option>
<?			
		    while($filaA = $BD->fetch_array($result1)){
              $idexperencia  = $filaA["idexperencia"];
			  $nombre		 = $filaA["nombre"];
			  $fhingreso     = $filaA["fhingreso"];
?>
    <option value="<?=$nombre?>"><?=$nombre?></option>
<?
}
?>
