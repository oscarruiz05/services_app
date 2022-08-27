<?php
header('Access-Control-Allow-Origin: *'); 
include('../dbmanagers/class_conexion.php');
$BD = new class_conexion();
/*foreach ($_POST as $c => $v){
 echo $c." = ".$v."<br>";
}*/
$ideps =$_POST["ideps"];
$idips =$_POST["idips"];
$ciudad =$_POST["ciudad"];
    $sqlA = "SELECT e.ideps,e.nombre,e.celular,e.telefono,e.direccion,e.estado,e.fhingreso,e.ciudad
			 FROM eps AS e
			 WHERE e.ideps = '".$ideps."' AND e.ciudad = '".$ciudad."'
			 ORDER BY e.nombre DESC";
			$resultA   = $BD->ejecutar_sql($sqlA);
	        $filaA     = $BD->fetch_array($resultA);
		    $ideps 	   = $filaA["ideps"];
		    $nombre	   = $filaA["nombre"];
		    $telefono  = $filaA["telefono"];
		    $celular   = $filaA["celular"];
		    $direccion = $filaA["direccion"];
		    $estado	   = $filaA["estado"];
			$ciudad	   = $filaA["ciudad"];
		    $fhingreso = $filaA["fhingreso"];
?>
<div class="timeline">
    <div class="timeline-decoration" style="height:96%;"></div>
    <div class="timeline-item">
        <div class="timeline-icon" style="cursor:pointer" onclick="window.location.href='hojadevida.html'">
            
        </div>
        <div class="timeline-text">
            <h3 class="title">Eps</h3>
            <p>
            <ul> 
              <li><strong>Nombre Eps:</strong> <?=$nombre?></li>
              <li><strong>Direccion:</strong> <?=$direccion?></li>
              <li><strong>Ciudad:</strong> <?=$ciudad?></li>
              <li><strong>Telefono:</strong> <?=$telefono?></li>
              <li><strong>Celular:</strong> <?=$celular?></li>
            </ul>
            </p>
        </div>
    </div>
</div>

<?



    $sqlA = "SELECT i.idips,i.ideps,i.nombre,i.celular,i.telefono,i.direccion,i.estado,i.fhingreso,i.ciudad
			 FROM ips AS i
			 WHERE i.ideps = '".$ideps."'AND i.ciudad = '".$ciudad."'
			 ORDER BY i.nombre DESC";
			$resultA = $BD->ejecutar_sql($sqlA);
	while($filaA = $BD->fetch_array($resultA)){
		  $ideps 	    = $filaA["ideps"];
		  $idips 	    = $filaA["idips"];
		  $nombre		= $filaA["nombre"];
		  $telefono		= $filaA["telefono"];
		  $celular		= $filaA["celular"];
		  $direccion	= $filaA["direccion"];
		  $estado		= $filaA["estado"];
		  $ciudad	   = $filaA["ciudad"];
		  $fhingreso	= $filaA["fhingreso"];

?>
<div class="timeline">
    <div class="timeline-decoration" style="height:96%;"></div>
    <div class="timeline-item">
        <div class="timeline-icon" style="cursor:pointer" onclick="window.location.href='hojadevida.html'">
            <i class="fa fa-mail-reply"></i>
        </div>
        <div class="timeline-text">
            <h3 class="title">Ips</h3>
            <p>
            <ul> 
              <li><strong>Nombre Ips:</strong> <?=$nombre?></li>
              <li><strong>Direccion:</strong> <?=$direccion?></li>
              <li><strong>Ciudad:</strong> <?=$ciudad?></li>
              <li><strong>Telefono:</strong> <?=$telefono?></li>
              <li><strong>Celular:</strong> <?=$celular?></li>
            </ul>
            </p>
        </div>
    </div>
</div>
<?		  
	}
?>

