<?php
header('Access-Control-Allow-Origin: *');
include('../dbmanagers/class_conexion.php');
$BD = new class_conexion(); 
/*foreach ($_FILE as $c => $v){
 echo $c." = ".$v."<br>";
}*/
//var_dump($_FILES['file']);
$userid = $_REQUEST["userid"];
$empresa = $_REQUEST["empresa"];
$rutaCompleta = '';

//$new_image_name = "namethisimage.jpg";
//echo "fichero => ".$_FILES["file"]["name"]." userid => ".$userid; 
//move_uploaded_file($_FILES["file"]["tmp_name"], "/img/".$new_image_name);
$nombre = "perfil".$userid;
if (file_exists($nombre)) {
   $rutaphp = "perfil".$userid."/";
} else {
     mkdir(dirname(__FILE__)."/perfil".$userid."/", 0777);
     chmod("perfil".$userid."", 0777);
     $rutaphp = "perfil".$userid."/";
}

//echo "ruta=".dirname(__FILE__)."/documento".$id;
//move_uploaded_file($_FILES['file']['tmp_name'], $rutaphp.$_FILES['file']['name']);
move_uploaded_file($_FILES['file']['tmp_name'], $rutaphp."foto".$userid.".jpg");
$rutaCompleta = realpath($rutaphp.""."foto".$userid.".jpg");
$sql = "UPDATE usuarios
         SET foto = '".addslashes(mysql_escape_string("foto".$userid.".jpg"))."'
         WHERE identificacion = '".$userid."' ";
		 $result = $BD->ejecutar_sql($sql);
		if($result){
			$params = array(
			 'Foto'=> '@'.$rutaCompleta,
			 'Empresa'=>$empresa,
			 'CodEmpleado'=>$userid
            );
			//$method = "CodEmpleado =".$userid."&Empresa =".$empresa."&Foto=".$_FILES['file'];
			//echo $method;
			// abrimos la sesión cURL
            // print_r($params);
			$ch = curl_init();
			// definimos la URL a la que hacemos la petición
			curl_setopt($ch, CURLOPT_URL,"http://www.grupologisnovasoft.com/WsAppMovil/SetFotoEmpleado");
			// definimos el número de campos o parámetros que enviamos mediante POST
			curl_setopt($ch, CURLOPT_POST, 1);
			// definimos cada uno de los parámetros
			curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
			// recibimos la respuesta y la guardamos en una variable
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$remote_server_output = curl_exec ($ch);
			// cerramos la sesión cURL
			curl_close ($ch);
			// hacemos lo que queramos con los datos recibidos
			// por ejemplo, los mostramos
			// print_r($remote_server_output);
			//echo $remote_server_output;
			echo "TRUE";
		}else{
			echo "FALSE";
		}
		
?>