<?php
header('Access-Control-Allow-Origin: *'); 
/*foreach ($_POST as $c => $v){
  echo $c." = ".$v."<br>";
}*/
$hojavida="";
$facturaArray="";
require_once "../dbmanagers/UsuarioManager.php";
$usuarioManager = new UsuarioManager();
$method = "NitCliente=".$_POST['NitCliente']."&Empresa=".$_POST['Empresa']."&Criterio=".$_POST['Criterio']."&MesIngreso=".$_POST['MesIngreso']." ";
$hojavida = $usuarioManager->callWebServiceHojaVidaClien($method);
//print_r($hojavida);
$Empleados= $hojavida["Empleados"];
$Correcto= $hojavida["Correcto"];
if($Correcto == 1){
	if(!empty($Empleados)){		
		foreach($Empleados as $EmpleadosArray){
		   //print_r($empresaArrayEmpresas);
			$cod_emp= trim($EmpleadosArray["cod_emp"]);
			$nom_emp= $EmpleadosArray["nom_emp"];
			$ap1_emp= $EmpleadosArray["ap1_emp"];
			$ap2_emp= $EmpleadosArray["ap2_emp"];
			$est_lab= $EmpleadosArray["est_lab"];
			$e_mail=  $EmpleadosArray["e_mail"];
			$cod_car= $EmpleadosArray["cod_car"];
			$nom_car= $EmpleadosArray["nom_car"];
			$fec_ini= $EmpleadosArray["fec_ini"];
			$fec_fin= $EmpleadosArray["fec_fin"];
			$method = "NitCliente=0&Empresa=".$_POST['Empresa']."&CodEmpleado=".$cod_emp." ";   
			$hojavidaEmpl = $usuarioManager->callWebServiceHojaVida($method);
			//print_r($hojavidaEmpl);	
			$Docs= $hojavidaEmpl["Docs"];
			$CorrectEmp= $hojavidaEmpl["Correcto"];
			foreach($Docs as $DocsArray){
			  //print_r($empresaArrayEmpresas);
			  $IdDocumento= $DocsArray["IdDocumento"];
			  $NombreDocumento= $DocsArray["NombreDocumento"];
			}
		
		
		?>
		<div class="timeline">
			<div class="timeline-decoration" style="height:96%;"></div>
			<div class="timeline-item">
				<div class="timeline-icon" style="cursor:pointer" onclick="window.location.href='hojadevida.html'">
					
				</div>
				<div class="timeline-text">
					<h3 class="title">Resultado</h3>
					<p>
					<ul> 
					  <li><strong>Nombre Completo:</strong> <?=$nom_emp." ".$ap1_emp." ".$ap2_emp?></li>
					  <li><strong>Estado del Empleado:</strong> <?=$est_lab?></li>
					  <li><strong>Email del Empleado:</strong> <?=$e_mail?></li>
					  <li><strong>Código del Cargo del Empleado:</strong> <?=$nom_car?></li>
					  <li><strong>Fecha de Ingreso del Empleado:</strong> <?=$fec_ini?></li>
					  <li><strong>Fecha Finalización del Contrato:</strong> <?=$fec_fin?></li>
					  <?
					   if(!empty($Docs)){
					  ?>
					 
					 <input type="submit" class="buttonWrap button button-green contactSubmitButton"
						  onclick="window.location.href='http://www.grupologisnovasoft.com/WsAppMovil/DownDocEmpleado?NitCliente=<?=$_POST['NitCliente']?>&CodEmpleado=<?=$cod_emp?>&Empresa=<?=$_POST['Empresa']?>&IdDocumento=<?=$IdDocumento?>'" value="Documento"
						 style="cursor:pointer"/>
					  <?
					   }
					  ?>   
					</ul>
					</p>
				</div>
			</div>
		</div>
		<?
		 }
	}else{
?>
    VACIO
<?		
	}
}else{
?>
VACIO
<?
}
?>


       
