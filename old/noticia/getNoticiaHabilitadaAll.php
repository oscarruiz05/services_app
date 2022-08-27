<?php
header('Access-Control-Allow-Origin: *'); 
include('../dbmanagers/class_conexion.php');
$BD = new class_conexion();

$empresaId = utf8_decode($_GET['empresaId']);
$tipousuarioId = utf8_decode($_GET['tipousuarioId']);
   $sql1 = "SELECT 	idnoticia,titulo,mensaje,link,empresa,estado,ruta,tipo,fhingreso 
			FROM noticias 
			WHERE estado = 1 AND (empresa = '' OR empresa = '".$empresaId."') 
			AND (tipo = 0 OR tipo = ".$tipousuarioId.")
			ORDER BY idnoticia DESC
			LIMIT 20";
		    $result1 = $BD->ejecutar_sql($sql1);
		    while($filaA = $BD->fetch_array($result1)){
				 $idnoticia 	    = $filaA["idnoticia"];
				 $titulo		    = $filaA["titulo"];
				 $mensaje		    = $filaA["mensaje"];
				 $link	    	    = $filaA["link"];
				 $empresa		    = $filaA["empresa"];
				 $ruta		        = $filaA["ruta"];
				 $fhingreso		    = $filaA["fhingreso"];
		
				 $mensaje = str_replace('\"', "", $mensaje);

?>
             <div class="blog-post">
                <!-- Validación iframe video e imagen -->
                <?
                $pos = strpos($link, "https://www.youtube.com/");
                $idVideo= substr($link, -11);
                if($ruta !="" && $pos !== 0){
                    ?>
                    <img class="img-noticias-2019" style="margin-bottom: 0px!important;height: 150px;" src="http://appgrupologis.com/app/managers/usuario/<?=$ruta?>" alt="img">
                    <?
                }else if($ruta=="" && $pos !==0){
                    ?>
                    <img class="img-noticias-2019" style="margin-bottom: 0px!important;height: 150px;" src="./images/default_noticias.jpg" >
                    <?
                }else if($pos===0){?>
                    <iframe class="frame"width="359" height="250" src="https://www.youtube.com/embed/<?=$idVideo?>" 
                    frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <?}?>
                <br>
                <? if(strlen($titulo)>70){
                    $newTitle=substr($titulo, 0, 67)."...";
                }else{
                    $newTitle=$titulo;
                }
                ?>
                <h3 class="blog-post-title" style="color:#000"><?=$newTitle?></h3>
                <p class="blog-post-date" style="margin-top: 0px;"><i class="fa fa-calendar"></i><?=$fhingreso?></p>
                <br><br>
                <div class="blog-post-text" style="text-align:justify">
                    <?echo html_entity_decode($mensaje);?>
                </div>
                
                <?if($pos!==0){?>
                    <button class="botonNoticia225" onclick="window.open('<?=$link?>','_blank')">Enlace relacionado</button>
                <?}?>
            </div>
            <div class="decoration"></div>
<?
}
?>