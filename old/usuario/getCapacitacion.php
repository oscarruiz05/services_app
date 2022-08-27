<?php
header('Access-Control-Allow-Origin: *'); 
/*foreach ($_POST as $c => $v){
  echo $c." = ".$v."<br>";
}*/
$capacitacion="";
$capacitacionArray="";
require_once "../dbmanagers/UsuarioManager.php";
$usuarioManager = new UsuarioManager();
$method = "NitCliente=".$_POST['NitCliente']."&CodEmpleado=".$_POST['CodEmpleado']."&Empresa=".$_POST['Empresa']." ";
$capacitacion = $usuarioManager->callWebServiceCapacitacion($method);
//print_r($capacitacion);
//echo json_encode($capacitacion);
//echo "--".$capacitacion["Correcto"]."--".$capacitacion["Programa"]."<br>";
//echo var_dump( empty($capacitacion["Programa"]) );
$Correcto = $capacitacion["Correcto"];
if($Correcto == 1){
	if(empty($capacitacion["Programa"]) == true){
		echo "VACIO";
	}else{
		$capacitacionArray = $capacitacion["Programa"];

		foreach($capacitacionArray as $CapArray){
			$Documento= trim($CapArray["Documento"]);
			$Fecha= $CapArray["Fecha"];
			$Asunto= $CapArray["Asunto"];
			$Comentario= $CapArray["Comentario"];
			$Tema= $CapArray["Tema"];
			$Tipo=  $CapArray["Tipo"];
			$Personal= $CapArray["Personal"];
			$Estado= $CapArray["Estado"];
		?>
		<div class="timeline">
			<div class="timeline-decoration" style="height:96%;"></div>
			<div class="timeline-item">
				<div class="timeline-icon" style="cursor:pointer" onclick="window.location.href='capacitacion.html'">
					
				</div>
				<div class="timeline-text">
					<h3 class="title">Resultado</h3>
					<p>
					<ul> 
					  <li><strong>Documento:</strong> <?=$Documento?></li>
					  <li><strong>Fecha:</strong> <?=$Fecha?></li>
					  <li><strong>Asunto:</strong> <?=$Asunto?></li>
					  <li><strong>Comentario:</strong> <?=$Comentario?></li>
					  <li><strong>Tema:</strong> <?=$Tema?></li>
					  <li><strong>Tipo:</strong> <?=$Tipo?></li>
                      <li><strong>Personal:</strong> <?=$Personal?></li>
                      <li><strong>Estado:</strong> <?=$Estado?></li>
					    
					</ul>
					</p>
				</div>
			</div>
		</div>
		<?	
		}
	}
}else{
	echo "ERROR";
}
?>


       
