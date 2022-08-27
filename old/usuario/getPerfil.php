<?php
header('Access-Control-Allow-Origin: *');
include('../dbmanagers/class_conexion.php');
$BD = new class_conexion(); 
/*foreach ($_POST as $c => $v){
  echo $c." = ".$v."<br>";
}*/
$perfil="";
$perfilWebService = "";
require_once "../dbmanagers/UsuarioManager.php";
$usuarioManager = new UsuarioManager();
$Empresa = $_GET["empresaId"];
$CodEmpleado = $_GET["identificacionId"];
$method = "CodEmpleado=".$CodEmpleado."&Empresa=".$Empresa;
$perfilWebService = $usuarioManager->callWebServicePerfil($method);
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
          <p class="titleperfil"><?=$perfilArray["nomb_emp"]?></p>
          <p class="titleperfilcargo"><?=$perfilArray["nom_car"]?></p>
          <a href="UploadPhoto2.html" class="button" 
          style="cursor: pointer; background-color: #4099ff;opacity: 0.9; width: 31%;color: #fff; margin-top: -7px;height: 37px;margin-bottom: 14px;">
          Editar Foto</a>
          
          <br />
          
          <?
                     if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPod'))
			{
			  // echo "ios";
			}else{
				                  ?>
	                  <a href="#" class="button" style="cursor: pointer;background-color: #d30e8b;opacity: 0.9;width: 31%;color: #fff;margin-top: -7px;height: 37px;margin-bottom: 14px;"  Onclick='closeApp()'>
	                  Cerrar sesiòn</a>
	                  <?
                       }
           ?>
          
    </center>
    </div>
<div>
 <center>
 <div>
     <a id="btn_editarPerfil" href="EditarPerfil.html?CodEmpleado=<?=$CodEmpleado?>&Empresa=<?=$Empresa?>&Direccion=<?=trim($perfilArray["dir_res"])?>&Email=<?=trim($perfilArray["e_mail"])?>&Telefono=<?=trim($perfilArray["tel_res"])?>&Celular=<?=trim($perfilArray["tel_cel"])?>&EstadoCivil=<?=trim($perfilArray["Est_Civ"])?>" class="button" 
              style="cursor: pointer; background-color: #4099ff;opacity: 0.9; width: 31%;color: #fff; margin-top: -7px;height: 37px;margin-bottom: 14px;">
              Editar Perfil</a>
             
 </div>
 <div style="width:70%;">
 
 
<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-user" style="padding-left:10px;"></i>
              <strong>Identificacion:</strong><p class="icperFIl"><?=$perfilArray["cod_emp"]?></p>
     </p> 
<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-venus-mars" style="padding-left:10px;"></i>
              <strong>Sexo:</strong><p class="icperFIl"> <?=$perfilArray["sexo"]?></p>
     </p>
<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa" style="padding-left:10px;"></i>
              <strong>Estado Civil:</strong><p class="icperFIl"> <?=$perfilArray["Est_Civ"]?></p>
     </p>
<!--<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-child" style="padding-left:10px;"></i>
              <strong>No. Hijos:</strong><p class="icperFIl">	<? //=$perfilArray["num_hijos"]?></p>
     </p>-->
<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-calendar" style="padding-left:10px;"></i>
              <strong>Fecha Nacimiento:</strong><p class="icperFIl"> <?=$perfilArray["fec_nac"]?></p>
     </p>
<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-globe" style="padding-left:10px;"></i>
              <strong>Ciudad:</strong><p class="icperFIl"> <?=$perfilArray["nom_ciu"]?></p>
     </p>
<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-phone" style="padding-left:10px;"></i>
              <strong>Teléfono Residencia:</strong><p class="icperFIl"> <?=$perfilArray["tel_res"]?></p>
     </p>
<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-mobile" style="padding-left:10px;"></i>
              <strong>Celular:</strong><p class="icperFIl"> <?=$perfilArray["tel_cel"]?>	</p>
     </p>
<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-home" style="padding-left:10px;"></i>
              <strong>Dirección Residencia:</strong><p class="icperFIl"> <?=$perfilArray["dir_res"]?></p>
     </p>
<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-envelope-o" style="padding-left:10px;"></i>
              <strong>Correo Electrónico:</strong><p class="icperFIl"> <?=$perfilArray["e_mail"]?></p>
     </p>
<!--<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-check-circle-o" style="padding-left:10px;"></i>
              <strong>PorcT:</strong><p class="icperFIl"> <? //=$perfilArray["PorcT"]?></p>
     </p>-->
<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-money" style="padding-left:10px;"></i>
              <strong>Salario Base:</strong><p class="icperFIl"> <?=$perfilArray["sal_bas"]?></p>
     </p>
<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-clock-o" style="padding-left:10px;"></i>
              <strong>Valor Hora:</strong><p class="icperFIl"> <?=$perfilArray["valhora"]?></p>
     </p>
<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-credit-card" style="padding-left:10px;"></i>
              <strong>Tipo Pago:</strong><p class="icperFIl"> <?=$perfilArray["TipoPago"]?></p>
     </p>
<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-university" style="padding-left:10px;"></i>
              <strong>Nombre Banco:</strong><p class="icperFIl"> <?=$perfilArray["nom_ban"]?></p>
     </p>
<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-user" style="padding-left:10px;"></i>
              <strong>Cta Banco:</strong><p class="icperFIl"> <?=$perfilArray["cta_ban"]?></p>
     </p>
<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-university" style="padding-left:10px;"></i>
              <strong>Sucursal:</strong><p class="icperFIl"> <?=$perfilArray["nom_suc"]?></p>
     </p>
<!--<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-shopping-cart" style="padding-left:10px;"></i>
              <strong>Cod.Cco:</strong><p class="icperFIl"> <? //=$perfilArray["cod_cco"]?></p>
     </p>-->
<!--<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-university" style="padding-left:10px;"></i>
              <strong>Convenio CCo:</strong><p class="icperFIl"> < //?=$perfilArray["conv_cco"]?></p>
     </p>-->
<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-file-o" style="padding-left:10px;"></i>
              <strong>Convenio:</strong><p class="icperFIl"> <?=$perfilArray["convenio"]?></p>
     </p>
<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-file-text-o" style="padding-left:10px;"></i>
              <strong>Nombre Convenio:</strong><p class="icperFIl"> <?=$perfilArray["nomconvenio"]?></p>
     </p>
<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-globe" style="padding-left:10px;"></i>
              <strong>Ciudad Labora:</strong><p class="icperFIl"> <?=$perfilArray["ciulabora"]?></p>
     </p>
<!--<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-book" style="padding-left:10px;"></i>
              <strong>Regimen Salarial:</strong><p class="icperFIl"> < //?=$perfilArray["Reg_Salarial"]?></p>
     </p>-->
<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-money" style="padding-left:10px;"></i>
              <strong>Clase Salario:</strong><p class="icperFIl"> <?=$perfilArray["Clase_Salar"]?></p>
     </p>
<!--<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-check-circle-o" style="padding-left:10px;"></i>
              <strong>Pension:</strong><p class="icperFIl"> <? //=$perfilArray["Pension"]?>	</p>
     </p>-->
<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-street-view" style="padding-left:10px;"></i>
              <strong>Extranjero:</strong><p class="icperFIl"> <?=$perfilArray["Extranj"]?></p>
     </p>
<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-map-marker" style="padding-left:10px;"></i>
              <strong>Reside Extranjero:</strong><p class="icperFIl"> <?=$perfilArray["ResideExtr"]?></p>
     </p>
<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-calendar" style="padding-left:10px;"></i>
              <strong>Fecha Ingreso:</strong><p class="icperFIl"> <?=$perfilArray["fec_ing"]?></p>
     </p>
<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-calendar-o" style="padding-left:10px;"></i>
              <strong>Fecha Retiro:</strong><p class="icperFIl"> <?=$perfilArray["fec_ret"]?>	</p>
     </p>
<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-file-text-o" style="padding-left:10px;"></i>
              <strong>Contrato:</strong><p class="icperFIl"> <?=$perfilArray["contrato"]?></p>
     </p>
<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-file-o" style="padding-left:10px;"></i>
              <strong>Nombre Contrato:</strong><p class="icperFIl"> <?=$perfilArray["nom_con"]?></p>
     </p>
<!--<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-close" style="padding-left:10px;"></i>
              <strong>Metodo Retención:</strong><p class="icperFIl"> <? //=$perfilArray["met_ret"]?></p>
     </p>
<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-arrow-down" style="padding-left:10px;"></i>
              <strong>Metodo Descto:</strong><p class="icperFIl"> <? //=$perfilArray["mto_dto"]?></p>
     </p>-->
<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-hospital-o" style="padding-left:10px;"></i>
              <strong>EPS:</strong><p class="icperFIl"> <?=$perfilArray["nomEPS"]?></p>
     </p>
<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-institution" style="padding-left:10px;"></i>
              <strong>AFP:</strong><p class="icperFIl"> <?=$perfilArray["nomAFP"]?></p>
     </p>
<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-users" style="padding-left:10px;"></i>
              <strong>Caja Compensación:</strong><p class="icperFIl"> <?=$perfilArray["nomCAJA"]?></p>
     </p>
<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-heart" style="padding-left:10px;"></i>
              <strong>ARP:</strong><p class="icperFIl"> <?=$perfilArray["nomARP"]?></p>
     </p>
<p class="thumb-column" style="  margin-bottom: -14px; margin-top: -14px;">
              <i class="fa fa-user" style="padding-left:10px;"></i>
              <strong>N° Hijos:</strong><p class="icperFIl"><?=$perfilArray["num_hijos"]?></p>
     </p> 
     </div>
     </center>