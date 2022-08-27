<?php
header('Access-Control-Allow-Origin: *'); 
/*foreach ($_POST as $c => $v){
  echo $c." = ".$v."<br>";
}*/
$hojavida="";
$facturaArray="";
require_once "../dbmanagers/UsuarioManager.php";
$usuarioManager = new UsuarioManager();
$method = "NitCliente=".$_POST['NitCliente']."&Empresa=".$_POST['Empresa']."&CodEmpleado=".$_POST['CodEmpleado']." ";
$hojavida = $usuarioManager->callWebServiceHojaVida($method);
//print_r($hojavida);
$Docs= $hojavida["Docs"];
$Correcto= $hojavida["Correcto"];
if($Correcto == 1){
foreach($Docs as $DocsArray){
   //print_r($empresaArrayEmpresas);
	$IdDocumento= $DocsArray["IdDocumento"];
	$NombreDocumento= $DocsArray["NombreDocumento"];
}
 if(empty($Docs)){
         ?>VACIO<?
		      }else{
            ?>
  <div class="timeline">
    <div class="timeline-decoration" style="height:96%;"></div>
    <div class="timeline-item">
        <div class="timeline-icon" style="cursor:pointer" onclick="window.location.href='hojadevidaEmp.html'">
            
        </div>
        <div class="timeline-text">
            <h3 class="title">Resultado</h3>
            <p>
            <ul> 
              <li><strong>No. Documento:</strong> <?=$IdDocumento?></li>
              <li><strong>Nombre Documento:</strong> <?=$NombreDocumento?></li>
             
              <input type="submit" class="buttonWrap button button-green contactSubmitButton botondescargar33"
                  onclick="window.location.href='http://www.grupologisnovasoft.com/WsAppMovil/DownDocEmpleado?NitCliente=<?=$_POST['NitCliente']?>&CodEmpleado=<?=$_POST['CodEmpleado']?>&Empresa=<?=$_POST['Empresa']?>&IdDocumento=<?=$IdDocumento?>'" value="Descargar"
                 style="cursor:pointer"/>
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
?>


       
