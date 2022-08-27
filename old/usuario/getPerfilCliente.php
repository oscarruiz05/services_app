<?php
header('Access-Control-Allow-Origin: *');
include('../dbmanagers/class_conexion.php');
$BD = new class_conexion(); 
/*foreach ($_GET as $c => $v){
  echo $c." = ".$v."<br>";
}*/
$perfil="";
$perfilWebService = "";
require_once "../dbmanagers/UsuarioManager.php";
$usuarioManager = new UsuarioManager();
$Empresa = $_GET["empresaId"];
$NitCliente = $_GET["identificacionId"];
//$method = "CodEmpleado=".$CodEmpleado."&Empresa=".$Empresa;
$method = "NitCliente=".$NitCliente;
//$perfilWebService = $usuarioManager->callWebServicePerfil($method);
$perfilWebService = $usuarioManager->callWebServicePerfilCliente($method);
//print_r($perfilWebService);
$perfilArray = $perfilWebService["Perfil"];
//print_r($perfilArray);
$sqlA = "SELECT u.foto
		FROM usuarios AS u
		WHERE u.identificacion = '".$_GET["identificacionId"]."'";
		$resultA = $BD->ejecutar_sql($sqlA);
		$filaA = $BD->fetch_array($resultA);
        $foto 	    = $filaA["foto"];
				  
?>
<br /><br />
    <!--NUEVO CODIGO PERFIL-->
     
<div class="circle-slider half-bottom" >
  <div style="background-color:#f5f5f5;">
			 <?
				if($foto != ""){
			?>
				   <img src="http://appgrupologis.com/app/managers/usuario/perfil<?=$_GET["identificacionId"]?>/<?=$foto?>" alt="img">
			<?
				}else{
			?>
				   <img src="images/ico--04.png" alt="img">
			<?
				}
			?>
            <br>
            <center>
                 <a href="UploadPhoto2.html" class="button" 
                  style="cursor: pointer; background-color: #4099ff;opacity: 0.9; width: 31%;color: #fff; margin-top: -7px;height: 37px;margin-bottom: 14px;">
                  Editar Foto</a><br />
                  <p class="titleperfil"><?=$perfilArray["Nombre"]?></p>
                  <a id="btn_editarPerfil" href="EditarPerfilClien.html?NitCliente=<?=$NitCliente?>&Direccion=<?=$perfilArray["Direccion"]?>&Email=<?=$perfilArray["Correo"]?>&Telefono=<?=$perfilArray["Telefono"]?>" 
                  class="button" style="cursor: pointer; background-color: #4099ff;opacity: 0.9; width: 31%;color: #fff; margin-top: -7px;height: 37px;margin-bottom: 14px;">Editar Perfil</a>
                  <br />
                  <?
                     if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPod'))
			{
			  // echo "ios";
			}else{
				                  ?>
	                  <a href="#" class="button" style="cursor: pointer;background-color: #d30e8b;opacity: 0.9;width: 31%;color: #fff;margin-top: -7px;height: 37px;margin-bottom: 14px;"  Onclick='closeApp()'>
	                  Cerrar sesi&oacute;n</a>
	                  <?
                       }
           ?>
                  
            </center>
    </div>
</div>
 <center>
  <p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-phone" style="padding-left:10px;"></i>
              <strong>Teléfono Residencia:</strong><p class="icperFIl"> <?=$perfilArray["Telefono"]?></p>
     </p>
  <p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-home" style="padding-left:10px;"></i>
              <strong>Dirección Residencia:</strong><p class="icperFIl"> <?=$perfilArray["Direccion"]?></p>
     </p>
   <p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-envelope-o" style="padding-left:10px;"></i>
              <strong>Correo Electrónico:</strong><p class="icperFIl"> <?=$perfilArray["Correo"]?></p>
     </p>
 </center>