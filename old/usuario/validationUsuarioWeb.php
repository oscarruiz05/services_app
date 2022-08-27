<?php
header('Access-Control-Allow-Origin: *'); 
include('../dbmanagers/class_conexion.php');
$BD = new class_conexion();

$usuario = utf8_decode($_POST['usuario']);
$clave   = utf8_decode($_POST['clave']);
 
$usu = "SELECT u.usuario,u.cedula,u.clave,u.estado,u.id_compania,u.extencion,
		p.nombre,p.apellido,
		t.id_tipo,t.descripcion
		FROM usuarios_app AS u
		INNER JOIN tipousuario AS t ON u.tipo_usuario = t.id_tipo
		INNER JOIN personas AS p ON u.cedula = p.cedula
		WHERE u.usuario = '".$usuario."' AND u.estado = 1 ";
$rusu = $BD->ejecutar_sql($usu);
$nu   = $BD->num_rows($rusu);
//echo "sql1 = ".$usu."<br>";
//echo "sql1 = ".$nu."<br>";
$ingreso = 0;//para ver si la contraseña esta habilitada
if($nu > 0){
	$fila = $BD->fetch_array($rusu);
	$claveBD = $fila["clave"];
	echo "claveBD = ".$claveBD."<br> clave =".$clave;
		if($claveBD == $clave){
		    //echo $password."<br>".$passwordS."<br>";
			$id_tipo			= $fila["id_tipo"];
			$usuario    		= $fila["usuario"];
			$nombre      		= $fila["nombre"];
			$apellido    		= $fila["apellido"];
			$id_compania    	= $fila["id_compania"];
			$extencion        	= $fila["extencion"];
			$fhregistro 		= date("Y-m-d h:i:s");
			$ingreso = 1;

			if($ingreso == 1){
				session_start();
           		$_SESSION["existe"]       = "SI";
				$_SESSION["id_tipoS"]     = $id_tipo;
				$_SESSION["usuarioS"]     = $usuario;
				$_SESSION["nombreS"]      = $nombre;
				$_SESSION["apellidoS"]    = $apellido;
				$_SESSION["hora_acc"]     = $fhregistro; 
				$_SESSION["id_companiaS"] = $id_compania; 
				$_SESSION["extS"]         = $extencion; 
				echo  "true";
			}//fin si hay posibilidad de ingresar
		}//fin si el usuario coincide
}//fin si el login existe en la tabla
if($nu == 0){
	echo "false";//SI NO HAY NINGUN USUARIO QUE COINCIDA
}
?>
