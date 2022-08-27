<?php
header('Access-Control-Allow-Origin: *'); 
include('../dbmanagers/class_conexion.php');
$BD = new class_conexion();
?>
<div class="formFieldWrap323">
 <select class="contactField323 requiredField"  id="ideps" name="ideps" onChange="LoadIps();">
   <option value="" >[Seleccion...]</option>
    <?
    $sqlA = "SELECT e.ideps,e.nombre,e.telefono,e.celular,e.direccion,e.fhingreso,e.estado
                        FROM eps AS e
                        WHERE e.estado = 1
                        ORDER BY e.nombre DESC";
                        $resultA = $BD->ejecutar_sql($sqlA);
           while($filaA = $BD->fetch_array($resultA)){
                  $ideps 	    = $filaA["ideps"];
                  $nombre		= $filaA["nombre"];
                  $telefono		= $filaA["telefono"];
                  $celular		= $filaA["celular"];
                  $direccion	= $filaA["direccion"];
                  $estado		= $filaA["estado"];
                  $fhingreso	= $filaA["fhingreso"];
                  echo "<option value='".$ideps."' >".$nombre."</option>";
           }
    ?>
 </select>
</div>

<div class="formFieldWrap323" id="ResultIps">
 <select class="contactField323 requiredField"  id="idips" name="idips">
   <option value="" >[Seleccion..]</option>
 </select>
</div>
<div class="formFieldWrap323">
<select name="ciudad" class="contactField323 requiredField" id="ciudad" >
    <option value="">Seleccione Ciudad</option>
    <?
	 $sql1 = "SELECT c.idciudad,c.nombre,c.fhingreso
		  FROM ciudades AS c
		  ORDER BY c.nombre DESC";
  	      $result1 = $BD->ejecutar_sql($sql1);
    ?>
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
  </select>
</div>
<div class="formSubmitButtonErrorsWrap">
  <input type="button" class="buttonWrap button button-green contactSubmitButton" id="contactSubmitButton" value="BUSCAR"
    data-formId="contactForm" style="cursor:pointer" onclick="SearchEpsIps()"/>
</div>