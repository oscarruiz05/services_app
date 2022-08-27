<?php
header('Access-Control-Allow-Origin: *'); 
include('../dbmanagers/class_conexion.php');
$BD = new class_conexion();
/*foreach ($_POST as $c => $v){
 echo $c." = ".$v."<br>";
}*/
$ideps =$_POST["ideps"];
    $sqlA = "SELECT i.idips,i.ideps,i.nombre,i.celular,i.telefono,i.direccion,i.estado,i.fhingreso
			 FROM ips AS i
			 WHERE i.ideps = '".$ideps."'
			 ORDER BY i.nombre DESC";
			$resultA = $BD->ejecutar_sql($sqlA);
?>
<select class="contactField323 requiredField"  id="idips" name="idips">
   <option value="" >[Seleccion..]</option>
<?			
	while($filaA = $BD->fetch_array($resultA)){
		  $ideps 	    = $filaA["ideps"];
		  $idips 	    = $filaA["idips"];
		  $nombre		= $filaA["nombre"];
		  $telefono		= $filaA["telefono"];
		  $celular		= $filaA["celular"];
		  $direccion	= $filaA["direccion"];
		  $estado		= $filaA["estado"];
		  $fhingreso	= $filaA["fhingreso"];
		  echo "<option value='".$idips."' >".$nombre."</option>";
	}
?>
 </select>
