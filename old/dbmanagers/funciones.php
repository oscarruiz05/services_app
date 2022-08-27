<?php

/*mb__output("latin1");
mb_internal_encoding("latin1");
ob_start('mb_output_handler');*/
function convertir_cadena($cadena)
{
	$ca = mb_detect_encoding($cadena);
	$cadena = mb_convert_encoding($cadena, "latin1", $ca);
	return $cadena;
}

/*function conectar(&$con)
    {
	$user = "root";
	$dsn  = "central";
	$host = "localhost";
	$pass = "towel";
	$con = odbc_connect($dsn, $user, $pass) or die("NO SE PUDO CONECTAR");
    }
*/
function conectar(&$con)
{
      $this->bd_host = "localhost";
      $this->bd_usuario = "grupolog_app";
      $this->bd_contrasena = "poiu0987";
      $this->bd_base = "grupolog_app";
      $this->bd_id = mysql_connect($this->bd_host, $this->bd_usuario, $this->bd_contrasena);
      $this->bd_select = mysql_select_db($this->bd_base, $this->bd_id);
      echo mysql_error();
}
/*******************/

function valida_session()
{ 	
	session_start(); 
	//COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO 
	if($_SESSION["existe"] != "SI")
	{
		$_SESSION["existe"];
	    //si no existe, envio a la página de autentificacion
		header("Location: ./index.html");
		//ademas salgo de este script
		exit();
	}
	else
	{
		//echo $_SESSION["hora_acc"];
		$hora_log = $_SESSION["hora_acc"];
		$ahora = getDateTime($fec = 'tstamp');
		//echo strtotime($hora_log);
		//echo strtotime($ahora);
		$tiempo_transcurrido = (strtotime($ahora) - strtotime($hora_log));
		
		//comparamos el tiempo transcurrido
		if($tiempo_transcurrido >= 100000000)
		{
			$usuarioS = $_SESSION["usuarioS"];
			$idusuarioS = $_SESSION["idusuarioS"];
			
			/*$upd = "UPDATE usuarios
					SET online = 'OFF'
					WHERE email_usuario = '".$email_usuarioS."' AND id_usuario = '".$idusuarioS."'";
					//echo "sql3 = ".$upd."<br>";
					$rupd = $BD->ejecutar_sql($upd);*/
			//unset($_SESSION);
			//session_destroy();//destruyo la sesión
			header("Location: ./index.html");//envío al usuario a la pag. de autenticación
			//sino, actualizo la fecha de la sesión
		}
		else
		{
			//$_SESSION["hora_acc"] = $ahora;
		}
	}
}

function valida_cookie()
 {
   // $idusuarioS = $_SESSION["idusuarioS"];
	
 } 
/*function ValidateMail($Email) 
{
    global $_HOST;
    $result = array();

		// Step 2 -- Check the e-mail address format
		
		// Next, you'll use our regular expression to determine if the e-mail address is properly formatted. If the e-mail address is not valid, return in error:
		if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $Email)) {
		
		  $result[0]=false;
				$result[1]="$Email is not properly formatted = no es el formato correcto";
				return $result;
			}
		
		   list ( $Username, $Domain ) = split ("@",$Email);
		
		   if (getmxrr($Domain, $MXHost))  
		     {
		
				$ConnectAddress = $MXHost[0];
			}
		  else {
		
				$ConnectAddress = $Domain;
		
			}
		
			$Connect = fsockopen ( $ConnectAddress, 25 );
		
			if ($Connect) {
		
				if (ereg("^220", $Out = fgets($Connect, 1024))) {
		
				   fputs ($Connect, "HELO $_HOST\r\n");
				   $Out = fgets ( $Connect, 1024 );
				   fputs ($Connect, "MAIL FROM: <{$Email}>\r\n");
				   $From = fgets ( $Connect, 1024 );
				   fputs ($Connect, "RCPT TO: <{$Email}>\r\n");
				   $To = fgets ($Connect, 1024);
				   fputs ($Connect, "QUIT\r\n");
				   fclose($Connect);
					if (!ereg ("^250", $From) || !ereg ( "^1024", $To )) {
					   $result[0]=false;
					   $result[1]="Server rejected address = Servidor rechazó la dirección";
					   return $result;
		
					}
				} else {
		
					$result[0] = false;
					$result[1] = "No response from server = No hay respuesta del servidor";
					return $result;
				  }
		
			}  else {
		
				$result[0]=false;
				$result[1]="Can not connect E-Mail server = No se puede conectar con el servidor de correo electrónico";
				return $result;
			}
		
		// Step 5 -- Return the results
		
		// Finally, our last and easiest step is to return the results and finish:
			$result[0]=true;
			$result[1]="$Email appears to be valid = parece ser válida ";
			return $result;
} // end of function

function getmxrr($hostname, &$mxhosts)
{
    $mxhosts = array();
    exec('nslookup -type=mx '.$hostname, $result_arr);
    foreach($result_arr as $line) 
       {
         if (preg_match("/.*mail exchanger = (.*)/", $line, $matches)) 
           $mxhosts[] = $matches[1];
       }
    return( count($mxhosts) > 0 );
}*/
//mandar mail
/*function mandar_mail($email_usuarioS)
{
    $para = $email_usuarioS;
	$asunto = 'Mensaje de verificacion';
	$mensaje = 'hola';
	/*$cabeceras = 'From: yovanafd@gmail.com' . "\r\n" .
	'Reply-To: fanclub@otbvideo.com' . "\r\n" .
	'X-Mailer: PHP/' . phpversion();*/
	/*mail($para, $asunto, $mensaje);
 	
}*/
/*********************************/
function orderArray($clave) {
	return function ($a, $b) use ($clave) {
		return strnatcmp($a[$clave], $b[$clave]);
	};
}
//obtiene la fecha del sistema
function getDateTime($fec){
	$hora = getdate();
	$mes = $hora["mon"];
	$dia = $hora["mday"];
	$lm = strlen($mes);
	$ld = strlen($dia);
	if($lm == 1)
	{
		$mes = '0'.$hora["mon"];
	}
	else
	{
		$mes = $hora["mon"];
	}
	if($ld == 1)
	{
		$dia = '0'.$hora["mday"];
	}
	else
	{
		$dia = $hora["mday"];
	}
	$segundos = $hora["seconds"];
	//devuelve la fecha formato date
	if($fec == 'date')
	{
		$date = $hora["year"]."-".$mes."-".$dia;
	}
	if($fec == 'tstamp')
	{
		$date = $hora["year"]."-".$mes."-".$dia." ".$hora["hours"].":".$hora["minutes"].":".$segundos;
	}
	if($fec == 'dmy')
	{
		$date = $dia."/".$mes."/".$hora["year"];
	}
	if($fec == 'anio')
	{
		$date = $hora["year"];
	}
	if($fec == 'mes')
	{
		$date = $mes;
	}
	if($fec == 'hora')
	{
		$date = $hora["hours"].":".$hora["minutes"].":".$segundos;
	}
	return $date;
}
/***************************/
function getHora(){
 $hora = getdate();
 $segundos = $hora["seconds"];
 $date = $hora["hours"].":".$hora["minutes"];
 return $date;
}
/**************************/
function comparar_fechas($fecha_a_restar, $fecha_disminuida)
{
	$fecha_a_restarP   = explode("-", $fecha_a_restar);
	$fecha_disminuidaP = explode("-", $fecha_disminuida);
	
	//echo "FR ".$fecha_a_restar." FD ".$fecha_disminuida."<br>";
	//calculo timestamp de las dos fechas
	$tfr = mktime(0,0,0,$fecha_a_restarP[1],$fecha_a_restarP[2],$fecha_a_restarP[0]);
	$tfd = mktime(0,0,0,$fecha_disminuidaP[1],$fecha_disminuidaP[2],$fecha_disminuidaP[0]);
	//resto a una fecha la otra
	$segundos_diferencia = $tfr - $tfd;
	//echo $segundos_diferencia;
	
	//convierto segundos en días
	$dias_diferencia = $segundos_diferencia / (60 * 60 * 24);
	
	//obtengo el valor absoulto de los días (quito el posible signo negativo)
	$dias_diferencia = abs($dias_diferencia);
	
	//quito los decimales a los días de diferencia
	$dias_diferencia = floor($dias_diferencia);
	//echo "DIAS DIFERENCIA <strong>".$dias_diferencia."</strong> PARA ".$fecha_disminuida."<br>";
	return $dias_diferencia;
}
/**************************/
function borrar_item($array_with_elements, $key_name)
{
    
 	$key_index = array_keys(array_keys($array_with_elements), $key_name);
	if (count($key_index) != "")
	{
		array_splice($array_with_elements, $key_index[0], 1);
		//print_r($array_with_elements);
		//echo "elemento2 = ".$array_with_elements."<br> posision2 = ".$key_name."<br>";
	}
	return $array_with_elements;
}
/*******************/

//VERIFICA INTEGRIDAD DE LA NOTA COMERCIAL
function verificar_item($array, $opcion)
{
	//0 NOTA SIN ITEMS
	//1 TIENE INCONSISTENCIAS
	//2 NO TIENE INCONSISTENCIAS
	if($opcion == 'C')//SI ESTOY CREANDO LA NOTA COMERCIAL
	{
		$array_notaC = $array;
		$nro_items = count($array_notaC);
		if($nro_items > 0)
		{
			$inconsistencias = 0;
			for($i = 0; $i < $nro_items; $i++)
			{
				if( ($array_notaC[$i][2] == '') or ($array_notaC[$i][4] == '') )
				{
					$inconsistencias++;
				}
			}
			if($inconsistencias > 0) {
				$return = 1;
			}
			if($inconsistencias == 0)
			{
				$return = 2;
			}
		}//fin si la nota tiene items
		if($nro_items == 0)
		{
			$return = 0;
		}
		return $return;
	}
	if($opcion == 'M')//SI ESTOY EDITANDO LA NOTA COMERCIAL
	{
		$array_notaM = $array;
		$nro_items = count($array_notaM);
		if($nro_items > 0)
		{
			$inconsistencias = 0;
			for($i = 0; $i < $nro_items; $i++)
			{
				if( ($array_notaM[$i][2] == '') or ($array_notaM[$i][4] == '') )
				{
					$inconsistencias++;
				}
			}
			if($inconsistencias > 0) {
				$return = 1;
				//echo "<tr><td>HAY <strong>".$inconsistencias."</strong> ITEM(S) QUE LE FALTAN DATOS.<br></td></tr>";MUESTRA LAS INCONSISTENCIAS
			}
			if($inconsistencias == 0)
			{
				$return = 2;
				//echo "<meta -equiv='refresh' content='1;URL=./nc_vista_previa.php'>"; MANDA A OTRA PAGINA
			}
		}//fin si la nota tiene items
		if($nro_items == 0)
		{
			$return = 0;
			//echo "<tr><td>LA NOTA COMERCIAL NO TIENE NINGUN ITEM.<br></td></tr>";
		}
		return $return;
	}
}
/*******************/

//VERIFICA EL ARRAY DE CONDICIONES COMERCIALES
function verifica_cc($array, $opcion, $estado)
{
	//1 TIENE INCONSISTENCIAS
	//2 NO TIENE INCONSISTENCIAS
	//echo "estado: ".$estado."<br>";
	if($opcion == 'C')//SI ESTOY CREANDO LA NOTA COMERCIAL
	{
		$condiciones_matrizC = $array;
		$sw_orden = 0;
		if($condiciones_matrizC[0][3] != "")
		{
			if( (($condiciones_matrizC[0][3] == "S") and ($condiciones_matrizC[0][4] == "")) or
				(($condiciones_matrizC[0][3] == "N") and (($condiciones_matrizC[0][5] == "")or($condiciones_matrizC[0][6] == ""))) )
			{
				$sw_orden = 1;
			}
		}
		else {
			$sw_orden = 1;
		}
		
		$sw_coti = 0;
		if( (($condiciones_matrizC[0][13] == 0)and($condiciones_matrizC[0][14] != "")) || (($condiciones_matrizC[0][13] == 1)and($condiciones_matrizC[0][14] == "")) ) {
			$sw_coti = 1;
		}
		if( (($condiciones_matrizC[0][15] == 0)and($condiciones_matrizC[0][16] != "")) || (($condiciones_matrizC[0][15] == 1)and($condiciones_matrizC[0][16] == "")) ) {
			$sw_coti = 1;
		}
		
		$sw_condiciones = 2;
		if( (($condiciones_matrizC[0][0] == "") or ($condiciones_matrizC[0][1] == "")  or ($condiciones_matrizC[0][2] == "")  or
			($condiciones_matrizC[0][3] == "")  or ($sw_orden == 1)                    or ($condiciones_matrizC[0][7] == "")  or
			($condiciones_matrizC[0][9] == "")  or ($condiciones_matrizC[0][10] == "") or ($condiciones_matrizC[0][11] == "") or
			($condiciones_matrizC[0][12] == "") or ($sw_coti == 1)) and ($estado == 1) )
		{
			$sw_condiciones = 1;
		}
		if( (($condiciones_matrizC[0][0] == "") or ($condiciones_matrizC[0][1] == "") or ($condiciones_matrizC[0][2] == "") or
			($condiciones_matrizC[0][9] == "") or ($sw_coti == 1)) and ($estado == 3) )
		{
			$sw_condiciones = 1;
		}
		//echo "Contacto: ".$condiciones_matrizC[0][0]." Forma de Pago: ".$condiciones_matrizC[0][1]." Validez Oferta: ".$condiciones_matrizC[0][2]." Tiempo de Entrega: ".$condiciones_matrizC[0][9]."<br>";
		//echo "SW Condiciones: ".$sw_condiciones." SW Coti: ".$sw_coti." Estado: ".$estado."<br>";
		return $sw_condiciones;
	}
	if($opcion == 'M')//SI ESTOY CREANDO LA NOTA COMERCIAL
	{
		$condiciones_matrizM = $array;
		$sw_orden = 0;
		if($condiciones_matrizM[0][3] != "")
		{
			if( (($condiciones_matrizM[0][3] == "S") and ($condiciones_matrizM[0][4] == "")) or
				(($condiciones_matrizM[0][3] == "N") and (($condiciones_matrizM[0][5] == "")or($condiciones_matrizM[0][6] == ""))) )
			{
				$sw_orden = 1;
			}
		}
		else {
			$sw_orden = 1;
		}
		
		$sw_coti = 0;
		if( (($condiciones_matrizM[0][13] == 0)and($condiciones_matrizM[0][14] != "")) || (($condiciones_matrizM[0][13] == 1)and($condiciones_matrizM[0][14] == "")) ) {
			$sw_coti = 1;
		}
		if( (($condiciones_matrizM[0][15] == 0)and($condiciones_matrizM[0][16] != "")) || (($condiciones_matrizM[0][15] == 1)and($condiciones_matrizM[0][16] == "")) ) {
			$sw_coti = 1;
		}
		
		$sw_condiciones = 2;
		if( (($condiciones_matrizM[0][0] == "") or ($condiciones_matrizM[0][1] == "")  or ($condiciones_matrizM[0][2] == "")  or
			($condiciones_matrizM[0][3] == "")  or ($sw_orden == 1)                    or ($condiciones_matrizM[0][7] == "")  or
			($condiciones_matrizM[0][9] == "")  or ($condiciones_matrizM[0][10] == "") or ($condiciones_matrizM[0][11] == "") or
			($condiciones_matrizM[0][12] == "") or ($sw_coti == 1)) and ($estado == 1) )
		{
			$sw_condiciones = 1;
		}
		
		if( (($condiciones_matrizM[0][0] == "") or ($condiciones_matrizM[0][1] == "") or ($condiciones_matrizM[0][2] == "") or
			($condiciones_matrizM[0][9] == "")  or ($sw_coti == 1)) and ($estado == 3) )
		{
			$sw_condiciones = 1;
		}
		//echo "SW Cond: ".$sw_condiciones."<br>";
		return $sw_condiciones;
	}
}
/*******************/

//ORDENA UN ARRAY
function ordenar_array($aArray, $sField, $bDescending = false)
{
    $bIsNumeric = IsNumeric($aArray);
	$aKeys = array_keys($aArray);
	$nSize = sizeof($aArray);
	for ($nIndex = 0; $nIndex < $nSize - 1; $nIndex++)
    {
		$nMinIndex = $nIndex;
		$objMinValue = $aArray[$aKeys[$nIndex]][$sField];
		$sKey = $aKeys[$nIndex];
		for ($nSortIndex = $nIndex + 1; $nSortIndex < $nSize; ++$nSortIndex)
		{
			if ($aArray[$aKeys[$nSortIndex]][$sField] < $objMinValue)
			{
				$nMinIndex = $nSortIndex;
				$sKey = $aKeys[$nSortIndex];
				$objMinValue = $aArray[$aKeys[$nSortIndex]][$sField];
			}
		}
		$aKeys[$nMinIndex] = $aKeys[$nIndex];
		$aKeys[$nIndex] = $sKey;
	}
	
	$aReturn = array();
	for ($nSortIndex = 0; $nSortIndex < $nSize; ++$nSortIndex)
	{
		$nIndex = $bDescending ? $nSize - $nSortIndex - 1: $nSortIndex;
		$aReturn[$aKeys[$nIndex]] = $aArray[$aKeys[$nIndex]];
	}
	return $bIsNumeric ? array_values($aReturn) : $aReturn;
}
/*******************/

function IsNumeric($aArray)
{
	$aKeys = array_keys($aArray);
	for ($nIndex = 0; $nIndex < sizeof($aKeys); $nIndex++)
	{
		if (!is_int($aKeys[$nIndex]) || ($aKeys[$nIndex] != $nIndex))
		{
			return false;
		}
	}
    return true;
}
/****************************/
function displayString($arrayText) 
{
	 //echo "hola1";
   if (count($arrayText) > 0) 
    {
		   //echo "hola2";
		   $string = '';
		   foreach($arrayText as $val)
		   {
			   $string .= $val."<br />\n";
		   }
		  return $string;
    } 
  else 
    {
       	return false;
    }
}

/***************************/
function fecha_sin_hora($fecha)
{
	$hoy = explode(" ", $fecha);
	$fecha = $hoy[0];
	$hora = $hoy[1];

	$fs = $fecha;
	return $fs;
}

/***************************/
function fecha_mes_dia($fecha)
{
	$fecharray = explode("-", $fecha);
	//print_r($fecharray);
	$anio = $fecharray[0];
	$nmes = $fecharray[1];
	$dia  = $fecharray[2];
	$mes_texto = mes_a_texto($nmes);
	
	$fs = $mes_texto."_".$dia;
	return $fs;
}

/***************************/
function fecha_preorder($fecha)
{
	$fecharray = explode("-", $fecha);
	//print_r($fecharray);
	$anio = $fecharray[0];
	$nmes = $fecharray[1];
	$dia  = $fecharray[2];
	
	$fs = $dia."/".$nmes."/".$anio;
	return $fs;
}
/***************************/
function fecha_order($fecha)
{
	$hoy = explode("-", $fecha);
	$dia = $hoy[0];
	$nmes = $hoy[1];
	$anio  = $hoy[2];

	$fs = $anio."-".$nmes."-".$dia;
	return $fs;
}

/***************************/
function fecha_dvd_aquirir($fecha)
{
	$hoy = explode("-", $fecha);
	$anio = $hoy[0];
	$nmes = $hoy[1];
	$dia  = $hoy[2];
	$mes_texto = mes_a_texto($nmes);
	$dia_texto = dia_hora($dia);
	$hora = hora($dia);
	$fs =$dia_texto." ".$mes_texto." ".$anio;
	return $fs;
}
function hora($fecha)
{
	$hoy = explode(" ", $fecha);
	$dia =  $hoy[0];
	$hora = $hoy[1];
	//$dia  = $hoy[2];
	//$mes_texto = mes_a_texto($nmes);
	//$dia = dia_hora($fecha);
	$fs =$hora;
	return $fs;
}
/***************************/
function dia_hora($fecha)
{
	$hoy = explode(" ", $fecha);
	$dia =  $hoy[0];
	$hora = $hoy[1];
	//$dia  = $hoy[2];
	//$mes_texto = mes_a_texto($nmes);
	//$dia = dia_hora($fecha);
	$fs =$dia;
	return $fs;
}
/***************************/
function fecha_nac_usuario_cumple($fecha)
{
	$hoy = explode("-", $fecha);
	$anio = $hoy[0];
	$nmes = $hoy[1];
	$dia  = $hoy[2];
	$mes_texto = mes_a_texto($nmes);
	$dia_texto = dia_semana($fecha);
	$fs =$dia." ".$mes_texto." ".$anio;
	return $fs;
}
/***************************/
function fecha_nac_mod_cumple($fecha)
{
	$hoy = explode("-", $fecha);
	$anio = $hoy[0];
	$nmes = $hoy[1];
	$dia  = $hoy[2];
	$mes_texto = mes_a_texto($nmes);
	$dia_texto = dia_semana($fecha);
	$fs =$dia." ".$mes_texto;
	return $fs;
}
/***********************/
function dia_tiempo($day)
{
   $data = explode(" ", $day);
   $daytime = $data[0];
   $time    = $data[1]; 
   return $daytime; 
}
/***************************/
function fecha_mensaje($fecha)
{
	$hoy = explode("-", $fecha);
	$anio = $hoy[0];
	$nmes = $hoy[1];
	$dia  = $hoy[2];
	$mes_texto = mes_a_texto($nmes);
	$dia_time = dia_tiempo($dia);
	$fs =$dia_time." ".$mes_texto." ".$anio;
	return $fs;
}
/**********************/
function ruta_paths($ruta_carpeta)
{
	$ruta = explode("/", $ruta_carpeta);
	$ruta1 = $ruta[0];
	$ruta2 = $ruta[1];
	$ruta3 = $ruta[2];
	$ruta4 = $ruta[3];
	$ruta5 = $ruta[4];
	$ruta6 = $ruta[5];
	$result = $ruta5."/".$ruta6."/";
	return $result;
}
/**********************/
function ruta_foto($ruta_carpeta)
{
	$ruta = explode("/", $ruta_carpeta);
	$ruta1 = $ruta[0];
	$ruta2 = $ruta[1];
	$ruta3 = $ruta[2];
	$ruta4 = $ruta[3];
	$ruta5 = $ruta[4];
	$ruta6 = $ruta[5];
	$result = $ruta6;
	return $result;
}
/**********************/
function ruta_corta($ruta_carpeta)
{
	$ruta = explode("/", $ruta_carpeta);
	$ruta1 = $ruta[0];
	$ruta2 = $ruta[1];
	$ruta3 = $ruta[2];
	$ruta4 = $ruta[3];
	$ruta5 = $ruta[4];
	$ruta6 = $ruta[5];
	$result = $ruta6."/";
	return $result;
}
/**********************/
function ruta_dvd($ruta_carpeta)
{
	$ruta = explode("/", $ruta_carpeta);
	$ruta1 = $ruta[0];
	$ruta2 = $ruta[1];
	$ruta3 = $ruta[2];
	$ruta4 = $ruta[3];
	$ruta5 = $ruta[4];
	$ruta6 = $ruta[5];
	$ruta7 = $ruta[6];	
	$result = $ruta5."/".$ruta6."/".$ruta7."/";
	return $result;
}
/***********************/
function ruta_video($ruta_carpeta)
{
	$ruta = explode("/", $ruta_carpeta);
	$ruta1 = $ruta[0];
	$ruta2 = $ruta[1];
	$ruta3 = $ruta[2];
	$ruta4 = $ruta[3];
	$ruta5 = $ruta[4];
	$ruta6 = $ruta[5];
	//$ruta7 = $ruta[6];	*/
	$result = $ruta5."/".$ruta6."/";
	return $result;
}
/***********************/
function ruta_imagenprom($ruta_carpeta)
{
	$ruta = explode("/", $ruta_carpeta);
	$ruta1 = $ruta[0];
	$ruta2 = $ruta[1];
	$ruta3 = $ruta[2];
	$ruta4 = $ruta[3];
	$ruta5 = $ruta[4];
	$ruta6 = $ruta[5];
	$ruta7 = $ruta[6];
	/*$ruta8 = $ruta[7];
	$ruta9 = $ruta[8];*/
	$result = $ruta6."/".$ruta7."/";
	return $result;
}
/**********************/
function ruta_editar_imagen($ruta_carpeta)
{
	$ruta = explode("/", $ruta_carpeta);
	$ruta1 = $ruta[0];
	$ruta2 = $ruta[1];
	$ruta3 = $ruta[2];
	$ruta4 = $ruta[3];
	$ruta5 = $ruta[4];
	$ruta6 = $ruta[5];
	$ruta7 = $ruta[6];	
	$result = $ruta5."/".$ruta6."/".$ruta7;
	return $result;
}
/**********************/
function ruta_nombre($ruta_carpeta)
{
	$fila = explode("/", $ruta_carpeta);
	$fila1 = $fila[0];
	$fila2 = $fila[1];
	$fila3 = $fila[2];
	$filaresult = $fila3;
	return $filaresult;
}
/**********************/
function fecha_de_cumplanos($fecha)
{
	$hoy = explode("-", $fecha);
	$anio = $hoy[0];
	$nmes = $hoy[1];
	$dia  = $hoy[2];
	
	$mes_texto = mes_a_texto($nmes);
	$dia_texto = dia_semana($fecha);
	
	$fs = $mes_texto." ".$dia."  ";
	return $fs;
}
/***********************/
function mes($fecha)
{
	$hoy = explode("-", $fecha);
	$anio = $hoy[0];
	$nmes = $hoy[1];
	$dia  = $hoy[2];
	
	//$mes_texto = mes_a_texto($nmes);
	//$dia_texto = dia_semana($fecha);
	
	$fs = $nmes."-".$dia;
	return $fs;
}
/***********************/
function dia_numero($fecha)
{
	$hoy = explode("-", $fecha);
	$anio = $hoy[0];
	$nmes = $hoy[1];
	$dia  = $hoy[2];

	$fs = $dia;
	return $fs;
}

/***********************/
function mes_numero($fecha)
{
	$hoy = explode("-", $fecha);
	$anio = $hoy[0];
	$nmes = $hoy[1];
	$dia  = $hoy[2];

	$fs = mes_a_texto($nmes);
	return $fs;
}
/***********************/
function ano_numero($fecha)
{
	$hoy = explode("-", $fecha);
	$anio = $hoy[0];
	$nmes = $hoy[1];
	$dia  = $hoy[2];
	
	$fs = $anio;
	return $fs;
}
/***********************/
function ano_numero_solo($fecha)
{
	
	$hoy = explode("/", $fecha);
	$dia = $hoy[0];
	$nmes = $hoy[1];
	$anio  = $hoy[2];
	
	$fs = $anio;
	return $fs;
}
/**********************************/
function mes_actual()
{
	$fecha = getDateTime($fec = 'date');
	$hoy = explode("-", $fecha);
	$anio = $hoy[0];
	$nmes = $hoy[1];
	$dia  = $hoy[2];
	
	$mes_texto = mes_a_texto($nmes);
	$dia_texto = dia_semana($fecha);
	$fs = $mes_texto;
	return $fs;
}
/**********************************/
function ano_actual_valida()
{
	$fecha = getDateTime($fec = 'date');
	$hoy = explode("-", $fecha);
	$anio = $hoy[0];
	$nmes = $hoy[1];
	$dia  = $hoy[2];
	
	$mes_texto = mes_a_texto($nmes);
	$dia_texto = dia_semana($fecha);
	$fs = $anio;
	return $fs;
}
/***********************************/
function mes_fecha_incrementado()
{
	$fecha = getDateTime($fec = 'date');
	$hoy = explode("-", $fecha);
	$anio = $hoy[0];
	$nmes = $hoy[1];
	$dia  = $hoy[2];

	//$mes_texto = mes_a_texto($nmes);
	//$dia_texto = dia_semana($fecha);
	if ($nmes == '01')
	 {
	   $fs = '02-31';
	 }
	 if ($nmes == '02')
	 {
	   $fs = '03-28';
	 }
	 if ($nmes == '03')
	 {
	   $fs = '04-31';
	 } 
	 if ($nmes == '04')
	 {
	   $fs = '05-30';
	 }
	 if ($nmes == '05')
	 {
	   $fs = '06-30';
	 }
	 if ($nmes == '06')
	 {
	   $fs = '07-31';
	 }
	 if ($nmes == '07')
	 {
	   $fs = '08-31';
	 }
	 if ($nmes == '08')
	 {
	   $fs = '09-30';
	 }
	 if ($nmes == '09')
	 {
	   $fs = '10-31';
	 }
	 if ($nmes == '10')
	 {
	   $fs = '11-30';
	 }
	 if ($nmes == '11')
	 {
	   $fs = '12-31';
	 }
	 if ($nmes == '12')
	 {
	   $fs = '01-31';
	 }

	return $fs;
}
/***********************/
function mes_actual_incrementado()
{
	$fecha = getDateTime($fec = 'date');
	$hoy = explode("-", $fecha);
	$anio = $hoy[0];
	$nmes = $hoy[1];
	$dia  = $hoy[2];
	
	$mes_texto = mes_a_texto($nmes);
	$dia_texto = dia_semana($fecha);
	if ($mes_texto == 'January')
	 {
	   $fs = 'January - February';
	 } 
	 if ($mes_texto == 'February')
	 {
	   $fs = 'February - March';
	 } 
	 if ($mes_texto == 'March')
	 {
	   $fs = 'March - April';
	 } 
	 if ($mes_texto == 'April')
	 {
	   $fs = 'April - May';
	 } 
	 if ($mes_texto == 'May')
	 {
	   $fs = 'May - June';
	 } 
	 if ($mes_texto == 'June')
	 {
	   $fs = 'June - July';
	 } 
	 if ($mes_texto == 'July')
	 {
	   $fs = 'July - August';
	 } 
	 if ($mes_texto == 'August')
	 {
	   $fs = 'August - September';
	 } 
	 if ($mes_texto == 'September')
	 {
	   $fs = 'September - October';
	 } 
	 if ($mes_texto == 'October')
	 {
	   $fs = 'October - November';
	 } 
	 if ($mes_texto == 'November')
	 {
	   $fs = 'November - Dicember';
	 } 
	if ($mes_texto == 'December')
	 {
	   $fs = 'December - January';
	 } 
	return $fs;
}
/****************************/
function fechasistema_nueva()
{
	$fecha = getDateTime($fec = 'date');
	$hoy = explode("-", $fecha);
	$anio = $hoy[0];
	$nmes = $hoy[1];
	$dia  = $hoy[2];
	
	$mes_texto = mes_a_texto($nmes);
	$dia_texto = dia_semana($fecha);
	//$fs = "<b>".$dia_texto." ".$dia."</b> de <b>".$mes."</b> de <b>".$anio."</b>";
	$fs = $nmes."-".$dia;
	return $fs;
}
/**************************/
function fechasistema()
{
	$fecha = getDateTime($fec = 'date');
	$hoy = explode("-", $fecha);
	$anio = $hoy[0];
	$nmes = $hoy[1];
	$dia  = $hoy[2];
	
	$mes_texto = mes_a_texto($nmes);
	$dia_texto = dia_semana($fecha);
	//$fs = "<b>".$dia_texto." ".$dia."</b> de <b>".$mes."</b> de <b>".$anio."</b>";
	$fs = $dia_texto." ".$dia." ".$mes_texto." ".$anio;
	return $fs;
}
/**************************/

function mes_a_texto($nmes)
{
	switch ($nmes)
	{
		case "01" : $mes = "ENERO"; break;
		case "02" : $mes = "FEBRERO"; break;
		case "03" : $mes = "MARZO"; break;
		case "04" : $mes = "ABRIL"; break;
		case "05" : $mes = "MAYO"; break;
		case "06" : $mes = "JUNIO"; break;
		case "07" : $mes = "JULIO"; break;
		case "08" : $mes = "AGOSTO"; break;
		case "09" : $mes = "SEPTIEMBRE"; break;
		case "10" : $mes = "OCTUBRE"; break;
		case "11" : $mes = "NOVIEMBRE"; break;
		case "12" : $mes = "DICIEMBRE"; break;
	}
	return $mes;
}
/**************************/

function dia_semana($fecha)
{
	list($ano,$mes,$dia) = explode("-",$fecha);
	$numerodiasemana = date('w', mktime(0,0,0,$mes,$dia,$ano));
	switch($numerodiasemana)
	{
		case 0: return "Sunday";
		case 1: return "Monday";
		case 2: return "tuesday";
		case 3: return "Wednesday";
		case 4: return "Thursday";
		case 5: return "Friday";
		case 6: return "Saturday";
	}
}
/**************************/

function date_a_texto($fecha)
{
	$hoy = explode("-", $fecha);
	$anio = $hoy[0];
	$nmes = $hoy[1];
	$dia  = $hoy[2];
	$dia_texto = dia_semana($fecha);
	$mes_texto = mes_a_texto($nmes);
	$fs = $dia_texto." ".$dia." de ".$mes_texto." de ".$anio;
	return $fs;
}
/**************************/

function volver_date($fecha)
{
	if($fecha != '')
	{
		$fexp = explode("/", $fecha);
		if(strlen($fexp[0]) == 1)
		{
			$fexp[0] = '0'.$fexp[0];
		}
		if(strlen($fexp[1]) == 1)
		{
			$fexp[1] = '0'.$fexp[1];
		}
		$date = $fexp[2]."-".$fexp[0]."-".$fexp[1];
		return $date;
	}
}
/**************************/

function volver_dmy($fecha)
{
	$fexp = explode("-", $fecha);
	$dmy = $fexp[2]."/".$fexp[1]."/".$fexp[0];
	return $dmy;
}
/**************************/

//recibe el formato del calendario con el iframe de meses y lo vuelve date
function puntos_date($fecha)
{
	$fexp = explode(".", $fecha);
	$date = $fexp[2]."-".$fexp[1]."-".$fexp[0];
	return $date;
}
/**************************/

//recibe el formato date y lo vuelve como el del iframe calendar
function date_puntos($fecha)
{
	$fecha = substr($fecha, 0, 10);
	$fexp = explode("-", $fecha);
	$date = $fexp[2].".".$fexp[1].".".$fexp[0];
	return $date;
}
/**************************/

function sumar_dias($fecha, $ndias)
{
	$fecha_exp = explode("/", $fecha);
	$suma = mktime(0, 0, 0, $fecha_exp[1], $fecha_exp[0], $fecha_exp[2]) + $ndias * 24 * 60 * 60;
	$fecha_sumada = date("d-m-Y", $suma);
	return $fecha_sumada;
}
/**************************/

function timestamp_a_texto($fecha)
{
	$dia  = substr($fecha, 0, 10);
	$long = strlen($fecha);
	$hora = substr($fecha, 11, $long);
	$dia  = date_a_texto($dia);
	$fecha = $dia." -- ".$hora;
	return $fecha;
}
/**************************/

//CONVERTIR SUCURSAL A TEXTO
function sucursal_a_texto($idsucursal)
{
	if($idsucursal == 1)
		$suc = "BAQ";
	if($idsucursal == 2)
		$suc = "CTG";
	if($idsucursal == 3)
		$suc = "MED";
	if($idsucursal == 4)
		$suc = "BOG";
	if($idsucursal == 5)
		$suc = "STA";
	return $suc;
}
//CONVERTIR SUCURSAL A TEXTO
function sucursal_a_textoC($idsucursal)
{
	if($idsucursal == 1)
		$suc = "BARRANQUILLA";
	if($idsucursal == 2)
		$suc = "CARTAGENA";
	if($idsucursal == 3)
		$suc = "MEDELLIN";
	if($idsucursal == 4)
		$suc = "BOGOTA";
	if($idsucursal == 5)
		$suc = "SANTA MARTA";
	return $suc;
}
/**************************/

//coloca la imagen al 50%, ajustando al tamaño del contenedor
function ajustar_imagen($imagen, $tamano)
{
	if($imagen != '')
	{
		list($ancho, $altura, $tipo, $atr) = getimagesize($imagen);
		//echo "<b>ORIGINALES</b> -->Ancho ".$ancho." --> Alto ".$altura."<br>";
		if( ($ancho > $tamano) or ($altura > $tamano) )
		{
			$relacion1 = ($tamano * 100) / $ancho;
			$relacion2 = ($tamano * 100) / $altura;
			$relacion1 = round($relacion1, 2);
			$relacion2 = round($relacion2, 2);
			//echo "IMAGEN ".$imagen." <b>RELACION 1</b> ".$relacion1." <b>RELACION 2</b> ".$relacion2."<br>";
			if($relacion1 > $relacion2)
				$relacionQ = $relacion1;
			if($relacion2 > $relacion1)
				$relacionQ = $relacion2;
			
			$anchoN  = $ancho * ($relacionQ / 100);
			$alturaN = $altura * ($relacionQ / 100);
			$anchoN  = round($anchoN, 2);
			$alturaN = round($alturaN, 2);
			//echo "ANCHO NUEVO ".$anchoN." ALTURA NUEVA ".$alturaN."<br>";
		}
		if($anchoN == '')
			$anchoR = $ancho;
		else
			$anchoR = $anchoN;
		
		if($alturaN == '')
			$alturaR = $altura;
		else
			$alturaR = $alturaN;
		
		$array_imagen["ancho"]  = $anchoR;
		$array_imagen["altura"] = $alturaR;
		return $array_imagen;
	}
}
/**************************/

//RECORRE LOS SUBDIRECTORIOS DE UN ARCHIVO
function listar_directorios_ruta($ruta)
{
	// abrir un directorio y listarlo recursivo
	//echo "RUTA ".$ruta."<br>";
	$pos = 0;
	if(is_dir($ruta))
	{
		if($dh = opendir($ruta))
		{
			while (($file = readdir($dh)) !== false)
			{
				//esta línea la utilizaríamos si queremos listar todo lo que hay en el directorio
				//mostraría tanto archivos como directorios
				//echo "<br>Nombre de archivo: $file : Es un: " . filetype($ruta . $file);
				if(is_dir($ruta . $file) && $file!="." && $file!="..")
				{
					//solo si el archivo es un directorio, distinto que "." y ".."
					//echo "<br>Directorio: $ruta$file";
					$array_dirs[$pos] = $file;
					$pos++;
					//echo "<br>Subdir ".$file;
					//listar_directorios_ruta($ruta . $file . "/");//si quiero seguir con los subdirectorios
				}
			}
			closedir($dh);
		}
		return $array_dirs;
	}
	else
	{
		echo "<br>No es ruta valida"; 
	}
}
/**************************/


//DESPUES QUE LLEGO WALTER
//RECORRE CUALQUIER ARRAY Y GENERA SUBSTRING SQL
function genera_sql($array, $tabla, $columna, $prefijo)
{
	$longitud = count($array);
	//echo "Long ".$longitud."<br>";
	$contador = 0;
	if($longitud > 0)
	{
		if($longitud == 1)
		{
			$String = $prefijo." ".$tabla.".".$columna." = ".$array[$contador][0]."";
		}
		if($longitud > 1)
		{
			for($i = 0; $i < $longitud; $i++)
			{
				if( ($i == 0) )
				{
					$String = $prefijo." (".$tabla.".".$columna." = ".$array[$i][0]."";
				}
				if( ($i > 0) and ($i < ($longitud - 1) ) )
				{
					$String.= " OR ".$tabla.".".$columna." = ".$array[$i][0]."";
				}
				if( ($i > 0) and ($i == ($longitud - 1) ) )
				{
					$String.= " OR ".$tabla.".".$columna." = ".$array[$i][0].")";
				}
			}
			$contador++;
		}
		return($String);
	}
}

//PARA SACAR LOS VENDEDORES ASOCIADOS A UN USUARIO
function vendedores_usuario($idusuario, $tabla, $columna, $prefijo)
{
	$BD = new class_conexion();
	$ven = "SELECT vendedores.idvendedor
			FROM vendedores, perfiles
			WHERE vendedores.idvendedor = perfiles.idvendedor AND perfiles.idasistente = ".$idusuario."";
	//echo $sel_ven."<br><br>";
	$rven = $BD->ejecutar_sql($ven);
	$cv = 1;
	$nvs = $BD->num_rows($rven);
	while($FVEN = $BD->fetch_array($rven))
	{
		$idvendedor_perfiles = $FVEN["idvendedor"];
		if($nvs == 1)
		{
			$String = $prefijo." ".$tabla.".".$columna." = ".$idvendedor_perfiles."";
		}
		if($nvs > 1)
		{
			if($cv == 1)
			{
				$String = $prefijo." (".$tabla.".".$columna." = ".$idvendedor_perfiles."";
			}
			if( ($cv > 1) and ($cv < $nvs) )
			{
				$String.= " OR ".$tabla.".".$columna." = ".$idvendedor_perfiles."";
			}
			if( ($cv > 1) and ($cv == $nvs) )
			{
				$String.= " OR ".$tabla.".".$columna." = ".$idvendedor_perfiles.")";
			}
		}
		$cv++;
	}//fin del while donde se sacan los vendedores de un asistente
	return($String);
}

//VERIFICA SI UN USUARIO TIENE UNA PAGINA
function privilegios_pagina($pagina, $idusuario)
{
	$BD = new class_conexion();
	$archivo = basename($pagina);
	$pri = "SELECT lectura, escritura, actualizar, eliminar
			FROM privilegios_usuarios
			WHERE privilegios_usuarios.idpagina = (SELECT paginas.idpagina
												   FROM paginas
												   WHERE paginas.idpagina = privilegios_usuarios.idpagina AND paginas.nombre_archivo = '".$archivo."')
			AND privilegios_usuarios.idusuario = ".$idusuario."";
	//echo $pri."<br>";
	$rpri = $BD->ejecutar_sql($pri);
	$np = $BD->num_rows($rpri);
	if($np > 0)
	{
		$fila = $BD->fetch_array($rpri);
		$lectura    = $fila["lectura"];
		$escritura  = $fila["escritura"];
		$actualizar = $fila["actualizar"];
		$eliminar   = $fila["eliminar"];
		//echo "Pag: ".$archivo." L ".$lectura." E ".$escritura." A ".$actualizar." E ".$eliminar."<br>";
		if( ($lectura == 1) or ($escritura == 1) or ($actualizar == 1) or ($eliminar == 1) ) {
			$return[0] = 1;
			$return['lectura']    = $lectura;
			$return['escritura']  = $escritura;
			$return['actualizar'] = $actualizar;
			$return['eliminar']   = $eliminar;
			return $return;
		}
		if( ($lectura == 0) and ($escritura == 0) and ($actualizar == 0) and ($eliminar == 0) ) {
			$return[0] = 0;
			return $return;
		}
	}
	else
	{
		$return[0] = 0;
		return $return;
		//PONER LA FUNCION QUE MUESTRA QUE NO TIENE ACCESO
	}
}

//MUESTRA LOS VENDEDORES QUE TIENE UN USUARIO
function cargar_vendedores_usuario($idusuarioS, $width)
{
	$BD = new class_conexion();
	$vend = "SELECT usuarios.idusuario, usuarios.nombre
			 FROM usuarios, perfiles
			 WHERE usuarios.idusuario = perfiles.idvendedor AND perfiles.idasistente = ".$idusuarioS."
			 AND usuarios.estado = 'A'
			 ORDER BY nombre";
	//echo $vend."<br><br>";
	$rvend = $BD->ejecutar_sql($vend);
	$nv = $BD->num_rows($rvend);
	if($nv > 0)
	{
		echo "<select name='idvendedor' id='idvendedor' style='width:".$width."px;'>";
		echo "<option value=''>[Seleccione]</option>";
		while($fila = $BD->fetch_array($rvend))
		{
			$idusuario = $fila["idusuario"];
			$nombre    = $fila["nombre"];
			echo "<option value=".$idusuario.">".$nombre."</option>";
		}
		echo "</select>";
	}
	else
	{
		echo "NO TIENE VENDEDORES ASOCIADOS.";
	}
}

//PARA EL PIE DE PAGINA
function footer($width, $nombre_usuario)
{
	echo "<table width=".$width." align='center'>";
	echo "<tr><td><br></td></tr>";
	echo "</table>";
	echo "<table width=".$width." align='center' cellpadding='0' cellspacing='0' background='./../images/fondoabajo.jpg'>";
	echo "<tr>";
	echo "	<td width='900' height='130' align='right'>";
	//echo "		<img src='./../images/derechos.png' width='450' height='20'>";
	echo "	</td>";
	echo "	<td width='335' height='100' align='center'>";
	echo "		<table>";
	echo "			<tr>";
	echo "				<td style='font-size:12px; color:#FFFFFF;' align='left' valign='top' height='10'>".fechasistema()."</td>";
	echo "			</tr>";
	echo "			<tr>";
	echo "				<td style='font-size:12px; color:#FFFFFF;' align='left' valign='baseline' height='10'>Bienvenido(a): ".strtoupper($nombre_usuario)."</td>";
	echo "			</tr>";
	echo "			<tr>";
	echo "				<td align='left' height='10'>";
	echo "					<a style='font-size:12px; color:#FFFFFF;' href='javascript:cambio_de_claveF();'>Cambio de Clave</a>";
	echo "					<a style='font-size:12px; color:#FFFFFF;' href='javascript:intermedio_cerrar_session();'>Salir</a>";
	echo "				</td>";
	echo "			</tr>";
	echo "		</table>";
	echo "	</td>";
	echo "</tr>";
	echo "</table>";
}
/*******************/

//VERIFICA QUE PRECIO SE OBTIENE PARA UN PRODUCTO SEGUN LA SUCURSAL
function precio_sucursal($array_sucursales, $precio1, $precio2)
{
	$nro_items = count($array_sucursales);
	if($nro_items > 0)
	{
		for($j = 0; $j <= $nro_items; $j++)
		{
			if( ($array_sucursales[$j][0] == 1) or ($array_sucursales[$j][0] == 2) or ($array_sucursales[$j][0] == 5) )//COSTA
			{
				$precio = $precio1;
			}
			if( ($array_sucursales[$j][0] == 3) or ($array_sucursales[$j][0] == 4) )//INTERIOR
			{
				$precio = $precio2;
			}		
		}
	}
	else
	{
		$precio = $precio1;
	}
	return $precio;
}
/*******************/

//VER SI UNA CADENA ES NUMERICA
function valida_numero($numero)
{
	if($numero != "")
	{
		$elemento = str_split($numero);
		$contL = 0;
		for($i = 0; $i < count($elemento); $i++)
		{
			$v = ord($elemento[$i]);
			//echo "EL ".$elemento[$i]." ASCII ".$v."<br>";
			if( ($v < 48) or ($v > 57) )
			{
				$contL++;
			}
		}
		//echo " NUMERO ".$numero." CONT ".$contL."<br>";
		return $contL;
	}
}
/*******************/

//INDICADORES DE MODULO NC
function nc_indicadores_total($idnota, $idvendedor, $descuento, $iva)
{
	$BD = new class_conexion();
	$det = "SELECT pda_nc_detalle.cantidad, pda_nc_detalle.decima, pda_nc_detalle.valor, pda_nc_detalle.centavo
			FROM pda_nc_detalle
			WHERE pda_nc_detalle.idnota = ".$idnota." AND pda_nc_detalle.idvendedor = ".$idvendedor."";
	$rdet = $BD->ejecutar_sql($det);
	$nd = $BD->num_rows($rdet);
	if($nd > 0)
	{
		$valor_total_sin_iva = 0;
		$cont_items = 0;
		while($fdet = $BD->fetch_array($rdet))
		{
			$cantidad = $fdet["cantidad"];
			$decima   = $fdet["decima"];
			$valor    = $fdet["valor"];
			$centavo  = $fdet["centavo"];
			if( ($decima > 0) and ($decima != "") ) {
				$cantidad = $cantidad.".".$decima;
			}
			if( ($centavo > 0) and ($centavo != "") ) {
				$valor = $cantidad.".".$centavo;
			}
			$valor_total_uni = $valor * $cantidad;
			$valor_total_sin_iva = $valor_total_sin_iva + $valor_total_uni;
		}//FIN WHILE DETALLE
		if( ($descuento != "") and ($descuento > 0) )
		{
			$valor_descuento = $valor_total_sin_iva * ($descuento/100);
			$valor_total_sin_iva = $valor_total_sin_iva - $valor_descuento;
		}
		$valor_iva = $valor_total_sin_iva *($iva/100);
		$valor_total_con_iva = $valor_total_sin_iva + $valor_iva;
		$valor_total_nc = $valor_total_con_iva;
		return $valor_total_nc;
	}
	else
	{
		return 0;
	}
}

//INDICADORES MODULO NC
function nc_indicadores_trazabilidad($idnota, $idvendedor)
{
	$string_tr = "";
	$BD = new class_conexion();
	$tra = "SELECT idnota1, idnota2, idvendedor1, idvendedor2, estado
			FROM pda_trazabilidad
			WHERE (idnota1 = ".$idnota." AND idvendedor2 = ".$idvendedor.") XOR (idnota2 = ".$idnota." AND idvendedor1 = ".$idvendedor.")
			ORDER BY idnota1";
	//echo $tra."<br>";
	$rtra = $BD->ejecutar_sql($tra);
	$ntra = $BD->num_rows($rtra);
	if($ntra > 0)
	{
		$esp = 1;
		while($ftra = $BD->fetch_array($rtra))
		{
			$idnota1     = $ftra["idnota1"];
			$idvendedor1 = $ftra["idvendedor1"];
			$idnota2     = $ftra["idnota2"];
			$idvendedor2 = $ftra["idvendedor2"];
			$estado      = $ftra["estado"];
			
			if($estado == 1) {
				$estado_ver = "T";
			}
			if($estado == 2) {
				$estado_ver = "P";
			}
			
			if($idnota1 == $idnota) {
				$idnotaT = $idnota2;
			}
			if($idnota2 == $idnota) {
				$idnotaT = $idnota1;
			}
			
			if($idvendedor1 == $idvendedor) {
				$idvendedorT = $idvendedor2;
			}
			if($idvendedor2 == $idvendedor) {
				$idvendedorT = $idvendedor1;
			}
			if( ($esp >= 1) and ($esp < $ntra) ) {
				$espacio = " <b>|</b> ";
			}
			if( ($esp > 1) and ($esp == $ntra) ) {
				$espacio = "";
			}
			$string_tr.= $estado_ver." - ".$idnotaT.$espacio;
			//$pdf->addText(302, 683, 8, "<c:uline>  ".$idnotaT."  </c:uline>");
			$esp++;
		}//fin while
		return $string_tr;
	}
	else {
		return $string_tr;
	}
}

//INDICADORES DE PRODUCTOS POR CLIENTE
function nc_calcular_productos($idproducto, $cliente_nit, $fecha1, $fecha2, $idvendedor, $global_precio)
{
	$BD = new class_conexion();
	$vlr = "SELECT pda_nc_encabezado.iva, pda_nc_encabezado.descuento, pda_nc_detalle.cantidad, pda_nc_detalle.decima, pda_nc_detalle.valor, pda_nc_detalle.centavo
			FROM pda_nc_encabezado, pda_nc_detalle, pda_nc_condiciones
			WHERE pda_nc_encabezado.fhregistro BETWEEN ('".$fecha1." 00:00:00') AND ('".$fecha2." 23:59:59') AND pda_nc_encabezado.cliente_nit = ".$cliente_nit."
			AND pda_nc_encabezado.idvendedor = pda_nc_detalle.idvendedor AND pda_nc_encabezado.idvendedor = pda_nc_condiciones.idvendedor AND pda_nc_detalle.idvendedor = pda_nc_condiciones.idvendedor
			AND pda_nc_encabezado.idnota = pda_nc_detalle.idnota AND pda_nc_encabezado.idnota = pda_nc_condiciones.idnota AND pda_nc_detalle.idnota = pda_nc_condiciones.idnota
			AND pda_nc_condiciones.asesor = ".$idvendedor."
			AND pda_nc_encabezado.idnota = pda_nc_detalle.idnota AND pda_nc_detalle.idproducto = ".$idproducto."";
	//echo $vlr."<br><br>";
	$rvlr = $BD->ejecutar_sql($vlr);
	$valor_total_sin_iva = 0;
	$total_precio = 0;
	$total_cantidad = 0;
	while($fvlr = $BD->fetch_array($rvlr))
	{
		$iva       = $fvlr["iva"];
		$descuento = $fvlr["descuento"];
		$cantidad  = $fvlr["cantidad"];
		$decima    = $fvlr["decima"];
		$valor     = $fvlr["valor"];
		$centavo   = $fvlr["centavo"];
		
		if( ($decima > 0) and ($decima != "") ) {
			$cantidad = $cantidad.".".$decima;
		}
		if( ($centavo > 0) and ($centavo != "") ) {
			$valor = $valor.".".$centavo;
		}
		
		$valor_total_uni = $valor * $cantidad;
		$valor_total_sin_iva = $valor_total_sin_iva + $valor_total_uni;
		
		if( ($descuento != "") and ($descuento > 0) ) {
			$valor_descuento = $valor_total_sin_iva * ($descuento/100);
			$valor_total_sin_iva = $valor_total_sin_iva - $valor_descuento;
		}
		//$valor_iva = $valor_total_sin_iva *($iva/100);
		//$valor_total_con_iva = $valor_total_sin_iva + $valor_iva;
		//$total_precio = $total_precio + $valor_total_sin_iva;
		$total_cantidad = $total_cantidad + $cantidad;
		//echo "<b>nit:</b> ".$cliente_nit." <b>id:</b> ".$idproducto." <b>Valor:</b> ".number_format($total_precio, 2, ",", ".")." <b>Cantidad:</b> ".$cantidad."<br>";
	}
	$total_precio = $total_precio + $valor_total_sin_iva;
	$global_precio = $global_precio + $total_precio;
	//echo "<b>Codigo:</b> ".$idproducto." <b>Total:</b> ".number_format($total_precio, 2, ",", ".")." <b>Cantidad:</b> ".number_format($total_cantidad, 2, ",", ".")."<br><br>";
	$array_producto[0] = $total_precio;
	$array_producto[1] = $total_cantidad;
	$array_producto[2] = $global_precio;
	return $array_producto;
}

//PARA SACAR LOS VENDEDORES ASOCIADOS A UN USUARIO
function vendedores_sucursal($idusuario, $idsucursal, $tabla, $columna, $prefijo)
{
	$BD = new class_conexion();
	$ven = "SELECT usuarios.idusuario
			FROM usuarios, perfiles
			WHERE usuarios.idusuario = perfiles.idvendedor AND perfiles.idasistente = ".$idusuario." AND usuarios.idsucursal = ".$idsucursal."";
	//echo $sel_ven."<br><br>";
	$rven = $BD->ejecutar_sql($ven);
	$cv = 1;
	$nvs = $BD->num_rows($rven);
	while($FVEN = $BD->fetch_array($rven))
	{
		$idvendedor_perfiles = $FVEN["idusuario"];
		if($nvs == 1)
		{
			$String = $prefijo." ".$tabla.".".$columna." = ".$idvendedor_perfiles."";
		}
		if($nvs > 1)
		{
			if($cv == 1)
			{
				$String = $prefijo." (".$tabla.".".$columna." = ".$idvendedor_perfiles."";
			}
			if( ($cv > 1) and ($cv < $nvs) )
			{
				$String.= " OR ".$tabla.".".$columna." = ".$idvendedor_perfiles."";
			}
			if( ($cv > 1) and ($cv == $nvs) )
			{
				$String.= " OR ".$tabla.".".$columna." = ".$idvendedor_perfiles.")";
			}
		}
		$cv++;
	}//fin del while donde se sacan los vendedores de un asistente
	return($String);
}

//INDICADORES EFECTIVIDAD
function nc_indicadores_efectividad($fl_fechas, $fl_vendedores)
{
	$BD = new class_conexion();
	$tra = "SELECT pda_trazabilidad.idnota1, pda_trazabilidad.idnota2, pda_trazabilidad.idvendedor1, pda_trazabilidad.idvendedor2, pda_trazabilidad.estado
			FROM pda_nc_encabezado, pda_trazabilidad
			WHERE ".$fl_fechas." ".$fl_vendedores."
			AND ((pda_trazabilidad.idnota1 = pda_nc_encabezado.idnota AND pda_trazabilidad.idvendedor2 = pda_nc_encabezado.idvendedor)
			XOR (pda_trazabilidad.idnota2 = pda_nc_encabezado.idnota AND pda_trazabilidad.idvendedor1 = pda_nc_encabezado.idvendedor))
			GROUP BY pda_trazabilidad.idnota1, pda_trazabilidad.idnota2, pda_trazabilidad.idvendedor1, pda_trazabilidad.idvendedor2, pda_trazabilidad.estado";
	//echo $tra."<br>";
	//WHERE (idnota1 = ".$idnota." AND idvendedor2 = ".$idvendedor.") XOR (idnota2 = ".$idnota." AND idvendedor1 = ".$idvendedor.")
	$rtra = $BD->ejecutar_sql($tra);
	$ntra = $BD->num_rows($rtra);
	if($ntra > 0)
	{
		while($ftra = $BD->fetch_array($rtra))
		{
			$idnota1     = $ftra["idnota1"];
			$idvendedor1 = $ftra["idvendedor1"];
			$idnota2     = $ftra["idnota2"];
			$idvendedor2 = $ftra["idvendedor2"];
			$estado      = $ftra["estado"];
			
			if($estado == 1) {
				$total_totales++;
				$estado_ver = 1;
			}
			if($estado == 2) {
				//echo "entro: ".$idnota."<br>";
				$total_parciales++;
				$estado_ver = 2;
			}			
			if($idnota1 == $idnota) {
				$idnotaT = $idnota2;
			}
			if($idnota2 == $idnota) {
				$idnotaT = $idnota1;
			}
			
			if($idvendedor1 == $idvendedor) {
				$idvendedorT = $idvendedor2;
			}
			if($idvendedor2 == $idvendedor) {
				$idvendedorT = $idvendedor1;
			}
			
			//echo "St: ".$estado." F: ".$estado_ver." //".$idnota." - ".$idvendedor." => ".$idnotaT." - ".$idvendedorT."<br>";
			
		}//fin while
		$cont_parciales = $cont_parciales + $total_parciales;
		$cont_totales   = $cont_totales + $total_totales;
		//echo "CP: ".$cont_parciales."<br>";
		$array_mods[0] = $cont_totales;
		$array_mods[1] = $cont_parciales;
		return $array_mods;
	}
	else {
		return 0;
	}
}

function ruta_copy($ruta_carpeta)
{
	$fila = explode("/", $ruta_carpeta);
	$fila1 = $fila[0];
	$fila2 = $fila[1];
	$fila3 = $fila[2];
	/*$fila4 = $fila[3];
	$fila5 = $fila[4];
	$fila6 = $fila[5];
	$fila7 = $fila[6];*/
	$resultado = $fila1."/".$fila2;
	return $resultado;
}

function recurse_copy($ruta,$ruta2,$tmp_name,$name) {

	$ruta = $ruta.$name;
	$rutaoriginal = $ruta2.$name;
	echo "ruta1 = ".$ruta."<br>";
	echo "ruta2 = ".$rutaoriginal."<br>";
	
	copy($ruta,$rutaoriginal);
	
	/*$dir = opendir($src);
    @mkdir($dst);
    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if ( is_dir($src . '/' . $file) ) {
                recurse_copy($src . '/' . $file,$dst . '/' . $file);
            }
            else {
                copy($src . '/' . $file,$dst . '/' . $file);
            }
        }
    }
    closedir($dir);*/
}


?>