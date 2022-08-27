<?php
header('Access-Control-Allow-Origin: *'); 
include('../dbmanagers/class_conexion.php');
$count = 0;
$countDiv2 = 0;
$BD = new class_conexion();

$empresaId = utf8_decode($_GET['empresaId']);
$tipousuarioId = utf8_decode($_GET['tipousuarioId']);
$sql1 = "	SELECT 	idnoticia,titulo,mensaje,link,empresa,estado,ruta,tipo,fhingreso 
FROM noticias 
WHERE estado = 1 AND (empresa = '' OR empresa = '".$empresaId."') 
AND (tipo = 0 OR tipo = ".$tipousuarioId.")
ORDER BY idnoticia DESC
LIMIT 20";
$result1 = $BD->ejecutar_sql($sql1);
$countDiv = 0;
while($filaA = $BD->fetch_array($result1)){
	$idnoticia 	    = $filaA["idnoticia"];
	$titulo		    = $filaA["titulo"];
	$mensaje		    = $filaA["mensaje"];
	$link   		    = $filaA["link"];
	$empresa		    = $filaA["empresa"];
	$ruta		        = $filaA["ruta"];
	$fhingreso		    = $filaA["fhingreso"];
	$mensaje = str_replace('\"', '"', $mensaje);
	if($count==0){
		$countDiv = $countDiv + 1;
		echo "<div class='product".($countDiv==1?' active':'')."' product-id='".$countDiv."'>";	
	}
	
	if ($countDiv2==0){
		echo "<div class='div-noticias-app-2019-full'>";	
	}
	?>

	<div class="box-noticias-2019 scroll-custom" style="height:45%;">
		<?
        $pos = strpos($link, "https://www.youtube.com/");
        $idVideo= substr($link, -11);
		if($ruta !="" && $pos !== 0){
			?>
			<img class="img-noticias-2019" style="margin-bottom: 0px!important;height: 200px;" src="http://appgrupologis.com/app/managers/usuario/<?=$ruta?>" alt="img">
			<?
		}else if($ruta=="" && $pos !==0){
			?>
			<img class="img-noticias-2019" style="margin-bottom: 0px!important;height: 200px;" src="./images/default_noticias.jpg" >
			<?
		}else if($pos===0){?>
            <iframe class="frame" width="100%" height="400" src="https://www.youtube.com/embed/<?=$idVideo?>" 
            frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <?}?>		
        <?
        if(strlen($titulo)>70){
            $newTitle=substr($titulo, 0, 67)."...";
        }else{
            $newTitle=$titulo;
        }
        ?>
        <h3 class="ttl-noticias-2019" style="color:#000"><?=$newTitle?></h3>
        <p class="blog-post-date"><i class="fa fa-calendar"></i><?=$fhingreso?></p>
        <br>
        <br>

        

        <?/*if(strlen($mensaje)>139){
            $newMessage=substr($mensaje, 0, 136)."...";
        }else{
            $newMessage=$mensaje;
        }*/?>
		<!-- <div class="mensaje-texx2019"><? #echo html_entity_decode($newMessage);?></div> -->
        <div class="mensaje-texx2019"><?echo html_entity_decode($mensaje);?></div>


        <?if(strlen($mensaje)>139){?>
            <button class="botonMas225" id="btnNot" onclick="showNoticia(<?=$idnoticia?>)">Ver más</button>
        <?}?>
		
        

        <?if($pos!==0){?>
            <button class="botonNoticia225" onclick="window.open('<?=$link?>','_blank')">Enlace relacionado</button>
        <?}?>

        


		
		
	</div>
	<?
	$count = $count + 1 ;
	if($count==6){
		echo "</div>";
		$count = 0;
	}
	$countDiv2 = $countDiv2 + 1;
	if ($countDiv2 == 2){
		echo "</div>";
		$countDiv2 = 0;
	}
}
?>