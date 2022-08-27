<?php
header('Access-Control-Allow-Origin: *'); 
include('../dbmanagers/class_conexion.php');
$BD = new class_conexion();

 $sql1 = "SELECT a.id,a.ano,a.fhingreso
		  FROM anos AS a
		  ORDER BY a.ano DESC";
  	      $result1 = $BD->ejecutar_sql($sql1);
?>
          <option value="">Seleccione Año</option>
<?			
		    while($filaA = $BD->fetch_array($result1)){
				$id 	     = $filaA["id"];
			    $ano		 = $filaA["ano"];
			    $fhingreso = $filaA["fhingreso"];

?>
    <option value="<?=$ano?>"><?=$ano?></option>
<?
}
?>
