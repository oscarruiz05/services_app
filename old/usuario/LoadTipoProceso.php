<?php
header('Access-Control-Allow-Origin: *'); 
include('../dbmanagers/class_conexion.php');
$BD = new class_conexion();

 $sql1 = "SELECT t.idtipo,t.nombre,t.fhingreso
		   FROM tipoprocesos AS t
		   ORDER BY t.nombre DESC";
  	      $result1 = $BD->ejecutar_sql($sql1);
?>
          <option value="">Seleccione Tipo de Proceso</option>
<?			
		    while($filaA = $BD->fetch_array($result1)){
			  $idtipo 	     = $filaA["idtipo"];
			  $nombre		 = $filaA["nombre"];
			  $fhingreso     = $filaA["fhingreso"];

?>
    <option value="<?=$nombre?>"><?=$nombre?></option>
<?
}
?>
