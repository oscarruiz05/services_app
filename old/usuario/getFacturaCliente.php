<?php
header('Access-Control-Allow-Origin: *'); 
/*foreach ($_POST as $c => $v){
  echo $c." = ".$v."<br>";
}*/
$factura="";
$facturaArray="";
require_once "../dbmanagers/UsuarioManager.php";
$usuarioManager = new UsuarioManager();
$method = "NitCliente=".$_POST['NitCliente']."&Empresa=".$_POST['Empresa']."&Anho=".$_POST['Anho']."&Mes=".$_POST['Mes']." ";
$factura = $usuarioManager->callWebServiceFacturaCliente($method);
$facturaArray = $factura["Facturas"];
//print_r($facturaArray);
if(empty($facturaArray)){
echo "";
}else{
		foreach($facturaArray as $facturaArrayFacturas){
		   //print_r($empresaArrayEmpresas);
			$anho= $facturaArrayFacturas["anho"];
			$mes= $facturaArrayFacturas["mes"];
			$subtipo = $facturaArrayFacturas["subtipo"];
			$nofact= $facturaArrayFacturas["nofact"];
			$fecha= $facturaArrayFacturas["fecha"];
			$desc= $facturaArrayFacturas["desc"];
		
		//echo json_encode($factura);
?>
		<div class="timeline">
			<div class="timeline-decoration" style="height:96%;"></div>
			<div class="timeline-item">
				<div class="timeline-icon" style="cursor:pointer" onclick="window.location.href='facturaCliente.html'">
					
				</div>
				<div class="timeline-text">
					<h3 class="title">Resultado</h3>
					<p>
					<ul class="box_factura33"> 
					  <li class="box_factura33item"><strong>Año:</strong> <?=$anho?></li>
					  <li class="box_factura33item"><strong>Mes:</strong> <?=$mes?></li>
					  <li class="box_factura33item"><strong>Subtipo:</strong> <?=$subtipo?></li>
					  <li class="box_factura33item"><strong>No. Factura:</strong> <?=$nofact?></li>
					  <li class="box_factura33item"><strong>Fecha:</strong> <?=$fecha?></li>
					  <li class="box_factura33item"><strong>Descripcion:</strong> <?=$desc?></li>
					  <input type="button" class="buttonWrap button button-green contactSubmitButton"
						  onclick="window.location.href='http://www.grupologisnovasoft.com/WsAppMovil/ReporteFactura?Anho=<?=$anho?>&Mes=<?=$mes?>&Empresa=<?=$_POST['Empresa']?>&SubTipo=<?=$subtipo?>&NoFact=<?=$nofact?>&NitCliente=<?=$_POST['NitCliente']?>'" value="Reporte Factura"
						 style="cursor:pointer"/>
					  <input type="button" class="buttonWrap button button-green contactSubmitButton" 
						 onclick="window.location.href='http://www.grupologisnovasoft.com/WsAppMovil/SoporteFactura?Anho=<?=$anho?>&Mes=<?=$mes?>&Empresa=<?=$_POST['Empresa']?>&SubTipo=<?=$subtipo?>&NoFact=<?=$nofact?>&NitCliente=<?=$_POST['NitCliente']?>'" value="Soporte Factura"
						 style="cursor:pointer"/>
					</ul>
					</p>
				</div>
			</div>
		</div>
<?
		}
}
?>
		
		
			   
