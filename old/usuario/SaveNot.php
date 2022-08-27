<?php
header('Access-Control-Allow-Origin: *'); 
include('../dbmanagers/class_conexion.php');
$BD = new class_conexion();
function fecha_order($fecha)
   {
	$fecharray = explode("/", $fecha);
	//print_r($fecharray);
	$dia = $fecharray[0];
	$nmes = $fecharray[1];
	$anio  = $fecharray[2];
	$fs = $anio."/".$nmes."/".$dia;
	return $fs;
  }

  function validar_caracter($texto){
	if (preg_match("/(á|é|í|ó|ú|ñ+)/", $texto)) {
		return 0;
	}else{
		return 1;
	}
}

function validarDimension($img){
    $MAXW=800;
    $MAXH=400;
    $size=getimagesize($img);
    if ($size[0]!=$MAXW || $size[1]!=$MAXH) {
        return FALSE;
    }else{
        return TRUE;
    }
}
/*foreach ($_POST as $c => $v){
 echo $c." = ".$v."<br>";
}*/
/*foreach ($_FILES as $c => $v){
 echo $c." = ".$v."<br>";
}*/
$titulo    = utf8_decode($_POST['titulo']);
$empresa   = utf8_decode($_POST['empresa']);
$mensaje   = $_POST['mensaje'];
$link      = $_POST['link'];
$tipo      = utf8_decode($_POST['tipo']);
$idnoticia = $_POST['idnoticia'];

$todate = date("Y-m-d h:i:s");

// if($_FILES["file1"] != ""){
// 	//echo "prueba".$name = $_FILES["file1"]["name"];
//     // $validar = validar_caracter($name);
//     // $vDim=validarDimension($_FILES["file1"]);
//     // if(!$vDim){
//     //     echo "<script type='text/javascript'>
// 	// 	 alert('La imagen debe ser de 800px de ancho y 400px de alto');
// 	// 	  location.href = '../../admin/notificaciones.php';
// 	// 	</script>";
// 	// 	exit;
//     // }

// 	// if($validar == 0){
// 	// echo "<script type='text/javascript'>
// 		//  alert('Datos del archivo ".$name." No deben contener caracter extraños ejemplo: ñ,é, estc...');
// 		//   location.href = '../../admin/notificaciones.php';
// 		// </script>";
// 		// exit;
// 	}
// }

/*if($empresa != ""){
	$sql = "DELETE FROM noticias
	        WHERE empresa = '".$empresa."'";
            $result = $BD->ejecutar_sql($sql);
}*/
if($idnoticia == 0){
	$sql = "INSERT INTO noticias(titulo,mensaje,link,empresa,estado,tipo,fhingreso)
						VALUES('".$titulo."','".addslashes(mysql_escape_string($mensaje))."','".$link."','".$empresa."','1','".$tipo."','".$todate."')";
			$result = $BD->ejecutar_sql($sql);
			if($result){
				 $sql1 = "SELECT MAX(idnoticia) AS max
						  FROM noticias";
						  $result1 = $BD->ejecutar_sql($sql1);
						  $reg = $BD->fetch_array($result1);
						  $max            = $reg["max"];
			   if($_FILES["file1"] != ""){
				   echo $rutaphp = "img/";
				   if (isset ($_FILES["file1"]) ){
						if( ($_FILES['file1']['type']=="image/pjpeg") or 
							 ($_FILES['file1']['type']=="image/jpeg")or 
								($_FILES['file1']['type']=="image/x-png") or 
								  ($_FILES['file1']['type']=="image/png") ){
									  if($_FILES["file1"]["tmp_name"] != ""){
										switch ($_FILES['file1']['error']){
											   case 1: // UPLOAD_ERR_INI_SIZE
											   echo "<script language='JavaScript'>
												  alert ('El file1 sobrepasa el limite autorizado por el servidor (archivo1 php.ini) !') 
											   </script>";
											   break;
											   case 2: // UPLOAD_ERR_FORM_SIZE
											   echo "<script language='JavaScript'>
													alert ('El file1 sobrepasa el limite autorizado en el formulario HTML !') 
											   </script>";
											   echo "";
											   break;
											   case 3: // UPLOAD_ERR_PARTIAL
											   echo "<script language='JavaScript'>
												  alert ('El envio del file1 ha sido suspendido durante la transferencia!') 
											  </script>";
											  break;
											  case 4: // UPLOAD_ERR_NO_FILE
											  echo "<script language='JavaScript'>
												 alert ('El file1 que ha enviado tiene un tamaño nulo !') 
											   </script>";
											  break;
										   }
										   $tmp_name = $_FILES["file1"]["tmp_name"];
										   $name = $_FILES["file1"]["name"];
										   $sql2 = "UPDATE noticias
													SET ruta = '".$rutaphp.$name."'
													WHERE idnoticia = '".$max."' ";
													$result2 = $BD->ejecutar_sql($sql2);
										   //$rutaphp = "http://grupologis.co/app/admin/".$rutaphp;		
										   move_uploaded_file($_FILES['file1']['tmp_name'], $rutaphp.$_FILES['file1']['name']);
									  }
						}
				   }
			   }
			   echo "<script type='text/javascript'>
						 alert('Se ha actualizados los datos corectamente');
						 //location.reload();
						 location.href = '../../admin/notificaciones.php';
						</script>";
			}else{
			   echo "<script type='text/javascript'>
						 alert('Error. Itente de nuevo!');
						 //location.href = '../../admin/notificaciones.php';
						</script>";
			}
}else{

    if($_FILES["file1"]!=""){

        $sql = "UPDATE noticias
           SET titulo = '".addslashes(mysql_escape_string($titulo))."',mensaje='".addslashes(mysql_escape_string($mensaje))."',
		   link='".$link."',empresa = '".$empresa."',tipo = '".$tipo."'
           WHERE idnoticia = '".$idnoticia."' ";
		   $result = $BD->ejecutar_sql($sql);
		   if($result){
                $sql1 = "SELECT MAX(idnoticia) AS max
                        FROM noticias";
                $result1 = $BD->ejecutar_sql($sql1);
                $reg = $BD->fetch_array($result1);
                $max            = $reg["max"];
                    if($_FILES["file1"] != ""){
                        echo $rutaphp = "img/";
                        if (isset ($_FILES["file1"]) ){
                            if( ($_FILES['file1']['type']=="image/pjpeg") or 
                                ($_FILES['file1']['type']=="image/jpeg")or 
                                    ($_FILES['file1']['type']=="image/x-png") or 
                                        ($_FILES['file1']['type']=="image/png") ){
                                            if($_FILES["file1"]["tmp_name"] != ""){
                                            switch ($_FILES['file1']['error']){
                                                    case 1: // UPLOAD_ERR_INI_SIZE
                                                    echo "<script language='JavaScript'>
                                                        alert ('El file1 sobrepasa el limite autorizado por el servidor (archivo1 php.ini) !') 
                                                    </script>";
                                                    break;
                                                    case 2: // UPLOAD_ERR_FORM_SIZE
                                                    echo "<script language='JavaScript'>
                                                        alert ('El file1 sobrepasa el limite autorizado en el formulario HTML !') 
                                                    </script>";
                                                    echo "";
                                                    break;
                                                    case 3: // UPLOAD_ERR_PARTIAL
                                                    echo "<script language='JavaScript'>
                                                        alert ('El envio del file1 ha sido suspendido durante la transferencia!') 
                                                    </script>";
                                                    break;
                                                    case 4: // UPLOAD_ERR_NO_FILE
                                                    echo "<script language='JavaScript'>
                                                    alert ('El file1 que ha enviado tiene un tamaño nulo !') 
                                                    </script>";
                                                    break;
                                                }
                                                $tmp_name = $_FILES["file1"]["tmp_name"];
                                                $name = $_FILES["file1"]["name"];
                                                $sql2 = "UPDATE noticias
                                                        SET ruta = '".$rutaphp.$name."'
                                                        WHERE idnoticia = '".$max."' ";
                                                        $result2 = $BD->ejecutar_sql($sql2);
                                                //$rutaphp = "http://grupologis.co/app/admin/".$rutaphp;		
                                                move_uploaded_file($_FILES['file1']['tmp_name'], $rutaphp.$_FILES['file1']['name']);
                                            }
                            }
                        }
                    }
                echo "<script type='text/javascript'>
                        alert('Se ha actualizados los datos corectamente');
                        //location.reload();
                        location.href = '../../admin/notificaciones.php';
                        </script>";

			}else{
			   echo "<script type='text/javascript'>
						 alert('Error. Itente de nuevo!');
						 location.href = '../../admin/notificaciones.php';
						</script>";
			}
	

    }else{
        $sql = "UPDATE noticias
           SET titulo = '".addslashes(mysql_escape_string($titulo))."',mensaje='".addslashes(mysql_escape_string($mensaje))."',
		   link='".$link."',empresa = '".$empresa."',tipo = '".$tipo."'
           WHERE idnoticia = '".$idnoticia."' ";
		   $result = $BD->ejecutar_sql($sql);
		   if($result){
				 echo "<script type='text/javascript'>
						 alert('Se ha actualizados los datos corectamente');
						 //location.reload();
						 location.href = '../../admin/notificaciones.php';
						</script>";
			}else{
			   echo "<script type='text/javascript'>
						 alert('Error. Itente de nuevo!');
						 location.href = '../../admin/notificaciones.php';
						</script>";
			}
	
    }
	
	
}
?>