<?php
header('Access-Control-Allow-Origin: *'); 
/*foreach ($_POST as $c => $v){
  echo $c." = ".$v."<br>";
}*/
$hojavida="";
$href='';
$facturaArray="";
require_once "../dbmanagers/UsuarioManager.php";
$usuarioManager = new UsuarioManager();
$method = "CodEmpleado=".$_POST['CodEmpleado']."&Empresa=".$_POST['Empresa']." ";
$list = $usuarioManager->callWebServiceListQuejas($method);
//print_r($list);
$Programa= $list["Programa"];
$Correcto= $list["Correcto"];
if($Correcto == 1){
	if(!empty($Programa)){
		foreach($Programa as $ProgramaArray){
			$Documento= trim($ProgramaArray["Documento"]);
			$Fecha= $ProgramaArray["Fecha"];
			$Asunto= $ProgramaArray["Asunto"];
			$Comentario= $ProgramaArray["Comentario"];
			$Estado= $ProgramaArray["Estado"];
			if($Estado == "Registrado"){
				$style = "class='estadopqr1'";
			}
			if($Estado == "En Proceso"){
				$style = "class='estadopqr2'";
			}
			if($Estado == "Finalizado"){
				$style = "class='estadopqr3'";
			}
			$href='"quejasRespueta.html?asunto=\''.$Asunto.'\'&comentario=\''.$Comentario.'\'&respuesta=\''.$ProgramaArray["Respuesta"].'\'"';
			//print_r($ProgramaArray);
		?>
		
          <a class="boxxpqr" href=<?=$href?>>
                    <div class="mensageboxpqr">
                       <p class="mprtitle"  ><strong>Asunto:</strong> <?=$Asunto?></p>
                       <!--<p class="mprtex"><strong>Comentario:</strong> <?=$Comentario?></p>--> 
                       <p class="mprtitle"  ><strong>Documento:</strong> <?=$Documento?></p>
                       <p class="mprtitle"  ><strong>Fecha:</strong> <?=$Fecha?></p> 
                       <p class="mprtex"><strong>Estado:</strong><?=$Estado?></p>
                    </div>
                    <div class="boxxpqr2">
                    <div <?=$style?>></div>
                    </div> 
          </a>
		<?
		 }
	}else{
?>
    <a class="boxxpqr" href="#">
                    <div class="mensageboxpqr">
                      <p class="mprtitle" ><strong>No Hay Resultado.</strong></p>
                    </div>
                    <div class="boxxpqr2">
                    </div> 
    </a>
    
<?php		
	}
}else{
?>
 <a class="boxxpqr" href="#">
                    <div class="mensageboxpqr">
                      <p class="mprtitle"><strong>No Hay Resultado.</strong></p>
                    </div>
                    <div class="boxxpqr2">
                    </div> 
    </a>
<?
}
?>

