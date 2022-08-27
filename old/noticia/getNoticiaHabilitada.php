<?php
header('Access-Control-Allow-Origin: *');
include('../dbmanagers/class_conexion.php');
$BD = new class_conexion();

$empresaId = utf8_decode($_GET['empresaId']);
$tipousuarioId = utf8_decode($_GET['tipousuarioId']);
$idnoticia = utf8_decode($_GET['idnoticia']);

$sql1 = "SELECT 
 idnoticia,titulo,mensaje,link,empresa,estado,ruta,tipo,fhingreso 
			FROM noticias 
			WHERE estado = 1 AND idnoticia='$idnoticia'  AND (empresa = '' OR empresa = '" . $empresaId . "') 
			AND (tipo = 0 OR tipo = " . $tipousuarioId . ")
			ORDER BY idnoticia DESC
			LIMIT 1";

$result1 = $BD->ejecutar_sql($sql1);
$filaA = $BD->fetch_array($result1);
$idnoticia         = $filaA["idnoticia"];
$titulo            = $filaA["titulo"];
$mensaje        = $filaA["mensaje"];
$link              = $filaA["link"];
$empresa        = $filaA["empresa"];
$ruta            = $filaA["ruta"];
$fhingreso        = $filaA["fhingreso"];
$mensaje = str_replace('\"', '"', $mensaje);
?>
<? $pos = strpos($link, "https://www.youtube.com/");
$idVideo = substr($link, -11);
if ($ruta != "" && $pos !== 0) {
    ?>
    <img class="img-noticias-2019" style="margin-bottom: 0px!important;height: 200px;" src="http://appgrupologis.com/app/managers/usuario/<?= $ruta ?>" alt="img">
<?
} else if ($ruta == "" && $pos !== 0) {
    ?>
    <img class="img-noticias-2019" style="margin-bottom: 0px!important;height: 200px;" src="./images/default_noticias.jpg">
<?
} else if ($pos === 0) { ?>
    <iframe width="100%" height="400" src="https://www.youtube.com/embed/<?= $idVideo ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<? } ?>
<h3 class="ttl-noticias-2019" style="color:#000"><?= $titulo ?></h3>
<p class="blog-post-date"><i class="fa fa-calendar"></i><?= $fhingreso ?></p><br><br>

<div class="mensaje-text255">
    <? echo html_entity_decode($mensaje); ?>
</div>
<? if ($link != "") { ?>
    <button class="botonNoticia225" onclick="window.open('<?= $link ?>','_blank')">Enlace relacionado</button>
<? } ?>