<?php
header('Access-Control-Allow-Origin: *'); 
$noticias = "";
require_once "../dbmanagers/UsuarioManager.php";
$empresaId = utf8_decode($_GET['empresaId']);
$tipousuarioId = utf8_decode($_GET['tipousuarioId']);
$usuarioManager = new UsuarioManager();
$noticias = $usuarioManager->getNoticiaHabilitada($empresaId,$tipousuarioId);
echo json_encode($noticias);
?>
