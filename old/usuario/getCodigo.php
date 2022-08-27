<?php
header('Access-Control-Allow-Origin: *'); 
include('../dbmanagers/class_conexion.php');
$BD = new class_conexion();
/*foreach ($_POST as $c => $v){
  echo $c." = ".$v."<br>";
}*/
$correo = utf8_decode($_POST['correo']);
$codigo   = utf8_decode($_POST['codigo']);
 
$usu = "SELECT count(*) AS total 
	    FROM usuarios 
	    WHERE correo = '".$correo."' AND clave = '".$codigo."' ";
$rusu = $BD->ejecutar_sql($usu);
$fila = $BD->fetch_array($rusu);
$total = $fila["total"];
//echo "sql1 = ".$usu."<br>";
//echo "sql1 = ".$total."<br>";
if($total > 0){
   $sql = "DELETE FROM usuarios WHERE correo = '".$correo."' AND clave = '".$codigo."' ";
   $result = $BD->ejecutar_sql($sql);
   if($result){
	   echo "TRUE";
   }else{
	   echo "FALSE SQL";
   }
}//fin si el login existe en la tabla
if($total == 0){
	echo "FALSE";//SI NO HAY NINGUN USUARIO QUE COINCIDA
}
?>