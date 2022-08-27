<?php
header('Access-Control-Allow-Origin: *'); 
include('../dbmanagers/class_conexion.php');
$BD = new class_conexion();

 $sql1 = "SELECT a.idauxilio,a.nombre,a.fhingreso
		  FROM auxilios AS a
		  ORDER BY a.nombre DESC";
  	      $result1 = $BD->ejecutar_sql($sql1);
?>
          <option value="">Seleccione Auxilios salariales?</option>
<?			
		    while($filaA = $BD->fetch_array($result1)){
			  $idauxilio     = $filaA["idauxilio"];
			  $nombre		 = $filaA["nombre"];
			  $fhingreso     = $filaA["fhingreso"];

?>
    <option value="<?=$nombre?>"><?=$nombre?></option>
<?
}
?>
