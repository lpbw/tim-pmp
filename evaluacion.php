<?

ini_set("display_errors", 1);
ini_set("track_errors", 1);
ini_set("html_errors", 1);

session_start();


include "checar_sesion_admin.php";
include "coneccion_i.php";
$idU=$_SESSION['idU'];
$verev=$_POST["verev"];
$idA=$_SESSION['idA'];
////////////////////////Guardar envio o rechazo de administrador de RH
if($_POST["enviar"]=="Firmar")
{
	$faltas_rh=$_POST["faltas_rh"];
	$coment=$_POST["coment"];
	if($faltas_rh=="1")
		$estatus="2";
	else
		$estatus="7";
	$consulta  = "update evaluaciones set estatus='$estatus', faltas_rh=$faltas_rh, id_faltas_rh=$idU, fecha_faltas_rh=now(), coment_rh='$coment' where id=$verev";
	$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro: ". mysqli_error($enlace) );
	if($estatus=="7")
	{
		for($i=1 ; $i<=12 ; $i++)
		{
		$consulta  = "insert into detalle_calidad(id_evaluacion, numero) values($verev, $i)";
		$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro: ". mysqli_error($enlace) );
		}
		
		$consulta  = "insert into detalle_competencia(id_evaluacion, numero,  v_sup, v_calidad, v_entre) values($verev, 1,0,0,0)";
		$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro: ". mysqli_error($enlace) );
		$consulta  = "insert into detalle_competencia(id_evaluacion, numero,  v_sup, v_calidad, v_entre) values($verev, 2,0,0,0)";
		$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro: ". mysqli_error($enlace) );
		$consulta  = "insert into detalle_competencia(id_evaluacion, numero,  v_sup, v_calidad, v_entre) values($verev, 3,0,0,0)";
		$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro: ". mysqli_error($enlace) );
		$consulta  = "insert into detalle_competencia(id_evaluacion, numero,  v_sup, v_calidad, v_entre) values($verev, 4,0,0,0)";
		$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro: ". mysqli_error($enlace) );
		$consulta  = "insert into detalle_competencia(id_evaluacion, numero,  v_sup, v_calidad, v_entre) values($verev, 5,0,0,0)";
		$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro: ". mysqli_error($enlace) );
		$consulta  = "insert into detalle_competencia(id_evaluacion, numero,  v_sup, v_calidad, v_entre) values($verev, 6,0,0,0)";
		$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro: ". mysqli_error($enlace) );
		
		
		$consulta  = "insert into detalle_eficiencia(id_evaluacion) values($verev)";
		$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro: ". mysqli_error($enlace) );
		
		echo"<script>document.location=\"programar_evaluacion.php?id=$verev\";</script>";
	}else
	{
		$consulta  = "SELECT usuarios.email, empleados.nombre, empleados.app, empleados.apm, DATE_FORMAT(evaluaciones.fecha_eval,'%m-%d-%Y') from evaluaciones inner join empleados on evaluaciones.id_empleado=empleados.id inner join usuarios on empleados.id_supervisor=usuarios.id where evaluaciones.id='$verev' ";		
		$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace));
		if(@mysqli_num_rows($resultado)>=1)
		{
			$res=mysqli_fetch_row($resultado);
			$email=$res[0];
			$EmailFrom="notificaciones@evhourly.com";
			$Body="Le sido programada la evaluacion de $res[1] $res[2] $res[3] con fecha limite del $res[4]";
			$success = mail($email, "Evaluacion de desempeño hourly - $res[1] $res[2] $res[3]", $Body, "From: <$EmailFrom>");
		}
		echo"<script>alert(\"Evaluacion enviada a coordinador\");window.close();</script>";
	}
}

////////////////////////////////////Guardar evaluacion del supervisor
if($_POST["guardar_s"]=="Guardar" || $_POST["firmar_s"]=="Firmar")
{
	$cuantos=$_POST["cuantos"];
	$iks=$_POST["iks"];
	$idEmp=$_POST["idEmp"];
	$efi_sup=$_POST["efi_sup"];
	$eficiencia_meta=$_POST["eficiencia_meta"];
	$eficiencia_1=$_POST["eficiencia1"];
	$eficiencia_2=$_POST["eficiencia2"];
	$eficiencia_3=$_POST["eficiencia3"];
	$eficiencia_4=$_POST["eficiencia4"];
	$eficiencia_5=$_POST["eficiencia5"];
	$eficiencia_6=$_POST["eficiencia6"];
	$eficiencia_7=$_POST["eficiencia7"];
	$eficiencia_8=$_POST["eficiencia8"];
	$eficiencia_9=$_POST["eficiencia9"];
	$eficiencia_10=$_POST["eficiencia10"];
	$eficiencia_11=$_POST["eficiencia11"];
	$eficiencia_12=$_POST["eficiencia12"];
	
	if($_POST["eficiencia_4"]=="")
		$eficiencia_4="0";
	else
		$eficiencia_4=$_POST["eficiencia_4"];
	if($_POST["eficiencia_5"]=="")
		$eficiencia_5="0";
	else
		$eficiencia_5=$_POST["eficiencia_5"];
	if($_POST["eficiencia_6"]=="")
		$eficiencia_6="0";
	else
		$eficiencia_6=$_POST["eficiencia_6"];
	if($_POST["eficiencia_7"]=="")
		$eficiencia_7="0";
	else
		$eficiencia_7=$_POST["eficiencia_7"];
	if($_POST["eficiencia_8"]=="")
		$eficiencia_8="0";
	else
		$eficiencia_8=$_POST["eficiencia_8"];
	if($_POST["eficiencia_9"]=="")
		$eficiencia_9="0";
	else
		$eficiencia_9=$_POST["eficiencia_9"];
	if($_POST["eficiencia_10"]=="")
		$eficiencia_10="0";
	else
		$eficiencia_10=$_POST["eficiencia_10"];
	if($_POST["eficiencia_11"]=="")
		$eficiencia_11="0";
	else
		$eficiencia_11=$_POST["eficiencia_11"];
	if($_POST["eficiencia_12"]=="")
		$eficiencia_12="0";
	else
		$eficiencia_12=$_POST["eficiencia_12"];
	$ncr_meta=$_POST["ncr_meta"];
	$ncr_resul=$_POST["ncr_resul"];
	$scrap_meta=$_POST["scrap_meta"];
	$scrap_resul=$_POST["scrap_resul"];
	$snag_meta=$_POST["snag_meta"];
	$snag_resul=$_POST["snag_resul"];
	$v1_sup=$_POST["v1_sup"];
	$v2_sup=$_POST["v2_sup"];
	$v3_sup=$_POST["v3_sup"];
	$v4_sup=$_POST["v4_sup"];
	$v5_sup=$_POST["v5_sup"];
	$v6_sup=$_POST["v6_sup"];
	$coment_s=$_POST["coment_s"];
	$aprovado_s=$_POST["aprovado_s"];
	$coment1=$_POST["coment1"];
	$coment2=$_POST["coment2"];
	$coment3=$_POST["coment3"];
	$coment4=$_POST["coment4"];
	$coment5=$_POST["coment5"];
	$coment6=$_POST["coment6"];
	
	$consulta  = "update detalle_eficiencia set meta='$eficiencia_meta', ef1=$eficiencia_1, ef2=$eficiencia_2, ef3=$eficiencia_3, ef4=$eficiencia_4, ef5=$eficiencia_5, ef6=$eficiencia_6, ef7=$eficiencia_7, ef8=$eficiencia_8, ef9=$eficiencia_9, ef10=$eficiencia_10, ef11=$eficiencia_11, ef12=$eficiencia_12 where id_evaluacion=$verev";
	$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro: $consulta". mysqli_error($enlace) );
	$num=1;
	for($i=0 ; $i<$cuantos ; $i++)
	{
		$consulta  = "update detalle_calidad set ncr_meta=$ncr_meta[$i], ncr_resul=$ncr_resul[$i], scrap_meta=$scrap_meta[$i], scrap_resul=$scrap_resul[$i], snag_meta=$snag_meta[$i], snag_resul=$snag_resul[$i] where id_evaluacion=$verev and numero=$num";
		$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro:$consulta ". mysqli_error($enlace) );
		$num++;
	}
	$consulta  = "update empleados set iks='$iks' where id=$idEmp";
	$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro: $consulta". mysqli_error($enlace) );
	
	$consulta  = "update detalle_competencia set comentario='$coment1', v_sup=$v1_sup where id_evaluacion=$verev and numero=1";
	$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro: $consulta". mysqli_error($enlace) );
	$consulta  = "update detalle_competencia set comentario='$coment2', v_sup=$v2_sup where id_evaluacion=$verev and numero=2";
	$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro:$consulta ". mysqli_error($enlace) );
	$consulta  = "update detalle_competencia set comentario='$coment3' where id_evaluacion=$verev and numero=3";
	$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro:$consulta ". mysqli_error($enlace) );
	$consulta  = "update detalle_competencia set comentario='$coment4', v_sup=$v4_sup where id_evaluacion=$verev and numero=4";
	$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro: $consulta". mysqli_error($enlace) );
	$consulta  = "update detalle_competencia set comentario='$coment5', v_sup=$v5_sup where id_evaluacion=$verev and numero=5";
	$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro:$consulta ". mysqli_error($enlace) );
	$consulta  = "update detalle_competencia set comentario='$coment6', v_sup=$v6_sup where id_evaluacion=$verev and numero=6";
	$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro: $consulta". mysqli_error($enlace) );
		
	
	if($_POST["firmar_s"]=="Firmar")
	{
		$consulta  = "update evaluaciones set estatus='3', efi_sup=$efi_sup, id_efi_sup='$idU', fecha_efi_sup=now(), aprovado_s='$aprovado_s', coment_s='$coment_s', fecha_s=now(), iks='$iks' where id=$verev";
		$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro: ". mysqli_error($enlace) );
		
		$consulta  = "SELECT usuarios.email, empleados.nombre, empleados.app, empleados.apm, DATE_FORMAT(evaluaciones.fecha_eval,'%d-%m-%Y') from evaluaciones inner join empleados on evaluaciones.id_empleado=empleados.id inner join usuarios on empleados.id_supervisor=usuarios.id where evaluaciones.id='$verev' ";		
		$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace));
		if(@mysqli_num_rows($resultado)>=1)
		{
			$resM=mysqli_fetch_row($resultado);
			$consulta  = "SELECT usuarios.email from  usuarios where tipo in (2, 3)";		
			$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace));
			$count=0;
			while(@mysqli_num_rows($resultado)>$count)
			{
				$res=mysqli_fetch_row($resultado);
				$email=$res[0];
				$EmailFrom="notificaciones@evhourly.com";
				$Body="La evaluacion de $resM[1] $resM[2] $resM[3] con fecha limite del $resM[4] ha sido firmada por el supervisor de produccion y esta lista para ser validada.";
				$success = mail($email, "Evaluacion de desempeño hourly - $resM[1] $resM[2] $resM[3]", $Body, "From: <$EmailFrom>");
				$count++;
			}
		}
		echo"<script>alert(\"La evaluacion ha sido Firmada\");window.location=\"menu.php\";</script>";
	}else
	{
		$consulta  = "update evaluaciones set  efi_sup=$efi_sup, id_efi_sup='$idU', aprovado_s='$aprovado_s', coment_s='$coment_s', iks='$iks' where id=$verev";
		$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro: $consulta". mysqli_error($enlace) );
	}
	
}
////////////////////////////////////Guardar evaluacion del supervisor de calidad
if($_POST["guardar_c"]=="Guardar" || $_POST["firmar_c"]=="Firmar")
{
	
	
	$v1_cal=$_POST["v1_cal"];
	$v2_cal=$_POST["v2_cal"];
	$v3_cal=$_POST["v3_cal"];
	$v4_cal=$_POST["v4_cal"];
	$v5_cal=$_POST["v5_cal"];
	$v6_cal=$_POST["v6_cal"];
	$coment_c=$_POST["coment_c"];
	$aprovado_c=$_POST["aprovado_c"];
	$coment1=$_POST["coment1"];
	$coment2=$_POST["coment2"];
	$coment3=$_POST["coment3"];
	$coment4=$_POST["coment4"];
	$coment5=$_POST["coment5"];
	$coment6=$_POST["coment6"];
	
	
	
	$consulta  = "update detalle_competencia set comentario='$coment1', v_calidad=$idU where id_evaluacion=$verev and numero=1";
	$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro: $consulta". mysqli_error($enlace) );
	$consulta  = "update detalle_competencia set comentario='$coment2', v_calidad=$idU where id_evaluacion=$verev and numero=2";
	$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro:$consulta ". mysqli_error($enlace) );
	$consulta  = "update detalle_competencia set comentario='$coment3', v_calidad=$idU where id_evaluacion=$verev and numero=3";
	$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro:$consulta ". mysqli_error($enlace) );
	$consulta  = "update detalle_competencia set comentario='$coment4', v_calidad=$idU where id_evaluacion=$verev and numero=4";
	$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro: $consulta". mysqli_error($enlace) );
	$consulta  = "update detalle_competencia set comentario='$coment5', v_calidad=$idU where id_evaluacion=$verev and numero=5";
	$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro:$consulta ". mysqli_error($enlace) );
	$consulta  = "update detalle_competencia set comentario='$coment6', v_calidad=$idU where id_evaluacion=$verev and numero=6";
	$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro: $consulta". mysqli_error($enlace) );
		
	
	if($_POST["firmar_c"]=="Firmar")
	{
		$consulta  = "SELECT usuarios.email, empleados.nombre, empleados.app,
					 empleados.apm, DATE_FORMAT(evaluaciones.fecha_eval,'%d-%m-%Y'), evaluaciones.fecha_s,
					  evaluaciones.fecha_c, evaluaciones.fecha_e, evaluaciones.aprovado_s,
					   evaluaciones.aprovado_c, evaluaciones.aprovado_e
					    from evaluaciones inner join empleados on evaluaciones.id_empleado=empleados.id inner join usuarios on empleados.id_supervisor=usuarios.id where evaluaciones.id='$verev' ";		
		$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace));
		if(@mysqli_num_rows($resultado)>=1)
		{
			$discrepancia=0;
			$resM=mysqli_fetch_row($resultado);
			if($resM[5]!="" &&  $resM[7]!="")// revisa que supervisores evaluaron
			{
				$discrepancia=3;
				if($resM[8]!=$aprovado_c || $resM[8]!=$resM[10] || $aprovado_c!=$resM[10] )// revisa si hay discrepancia
					$discrepancia=4;
					
				$consulta  = "update evaluaciones set   fecha_c=now(), aprovado_c='$aprovado_c', coment_c='$coment_c', id_c='$idU', estatus=$discrepancia where id=$verev";
			}
			else
				$consulta  = "update evaluaciones set   fecha_c=now(), aprovado_c='$aprovado_c', coment_c='$coment_c', id_c='$idU' where id=$verev";
	
			$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro: ". mysqli_error($enlace) );
			$consulta  = "SELECT usuarios.email from  usuarios where tipo in (1)";		
			$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace));
			$count=0;
			while(@mysqli_num_rows($resultado)>$count)
			{
				$res=mysqli_fetch_row($resultado);
				$email=$res[0];
				$EmailFrom="notificaciones@evhourly.com";
				
				if($discrepancia=="4")
					$Body="La evaluacion de $resM[1] $resM[2] $resM[3] con fecha limite del $resM[4] ha sido firmada por el supervisor de calidad  y entrenamiento, en la cual hubo discrepancia en el resultado y requiere agendar reunion.";
				else
					$Body="La evaluacion de $resM[1] $resM[2] $resM[3] con fecha limite del $resM[4] ha sido firmada por el supervisor de calidad  y entrenamiento, en la cual requiere su firma para continuar con el proceso de retroalimentación";
				if($discrepancia!="0")
				$success = mail($email, "Evaluacion de desempeño hourly - $resM[1] $resM[2] $resM[3]", $Body, "From: <$EmailFrom>");
				$count++;
			}
		}
		echo"<script>alert(\"La evaluacion ha sido Firmada\");window.location=\"menu.php\";</script>";
	}else
	{
		$consulta  = "update evaluaciones set  aprovado_c='$aprovado_c', coment_c='$coment_c' where id=$verev";
		$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro: $consulta". mysqli_error($enlace) );
	}
	
}

////////////////////////////////////Guardar evaluacion del supervisor de entrenamiento
if($_POST["guardar_e"]=="Guardar" || $_POST["firmar_e"]=="Firmar")
{
	
	
	$v1_entre=$_POST["v1_entre"];
	$v2_entre=$_POST["v2_entre"];
	$v3_entre=$_POST["v3_entre"];
	$v4_entre=$_POST["v4_entre"];
	$v5_entre=$_POST["v5_entre"];
	$v6_entre=$_POST["v6_entre"];
	$coment_e=$_POST["coment_e"];
	$aprovado_e=$_POST["aprovado_e"];
	$coment1=$_POST["coment1"];
	$coment2=$_POST["coment2"];
	$coment3=$_POST["coment3"];
	$coment4=$_POST["coment4"];
	$coment5=$_POST["coment5"];
	$coment6=$_POST["coment6"];
	
	
	
	$consulta  = "update detalle_competencia set comentario='$coment1', v_entre=$v1_entre where id_evaluacion=$verev and numero=1";
	$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro: $consulta". mysqli_error($enlace) );
	$consulta  = "update detalle_competencia set comentario='$coment2', v_entre=$v2_entre where id_evaluacion=$verev and numero=2";
	$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro:$consulta ". mysqli_error($enlace) );
	$consulta  = "update detalle_competencia set comentario='$coment3' where id_evaluacion=$verev and numero=3";
	$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro:$consulta ". mysqli_error($enlace) );
	$consulta  = "update detalle_competencia set comentario='$coment4', v_entre=$v4_entre where id_evaluacion=$verev and numero=4";
	$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro: $consulta". mysqli_error($enlace) );
	$consulta  = "update detalle_competencia set comentario='$coment5', v_entre=$v5_entre where id_evaluacion=$verev and numero=5";
	$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro:$consulta ". mysqli_error($enlace) );
	$consulta  = "update detalle_competencia set comentario='$coment6', v_entre=$v6_entre where id_evaluacion=$verev and numero=6";
	$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro: $consulta". mysqli_error($enlace) );
		
	
	if($_POST["firmar_e"]=="Firmar")
	{
		$consulta  = "SELECT usuarios.email, empleados.nombre, empleados.app,
					 empleados.apm, DATE_FORMAT(evaluaciones.fecha_eval,'%d-%m-%Y'), evaluaciones.fecha_s,
					  evaluaciones.fecha_c, evaluaciones.fecha_e, evaluaciones.aprovado_s,
					   evaluaciones.aprovado_c, evaluaciones.aprovado_e
					    from evaluaciones inner join empleados on evaluaciones.id_empleado=empleados.id inner join usuarios on empleados.id_supervisor=usuarios.id where evaluaciones.id='$verev' ";		
		$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace));
		if(@mysqli_num_rows($resultado)>=1)
		{
			$discrepancia=0;
			$resM=mysqli_fetch_row($resultado);
			if($resM[5]!="" &&  $resM[6]!="")// revisa que supervisores evaluaron
			{
				$discrepancia=3;
				if($resM[8]!=$aprovado_e || $aprovado_e!=$resM[9] || $resM[9]!=$resM[8])// revisa si hay discrepancia
					$discrepancia=4;
					
				$consulta  = "update evaluaciones set   fecha_e=now(), aprovado_e='$aprovado_e', coment_e='$coment_e', id_e='$idU', estatus=$discrepancia where id=$verev";
			}
			else
				$consulta  = "update evaluaciones set   fecha_e=now(), aprovado_e='$aprovado_e', coment_e='$coment_e', id_e='$idU' where id=$verev";
		$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro: ". mysqli_error($enlace) );
		
		
			$consulta  = "SELECT usuarios.email from  usuarios where tipo in (1)";		
			$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace));
			$count=0;
			while(@mysqli_num_rows($resultado)>$count)
			{
				$res=mysqli_fetch_row($resultado);
				$email=$res[0];
				$EmailFrom="notificaciones@evhourly.com";
				
				if($discrepancia=="4")
					$Body="La evaluacion de $resM[1] $resM[2] $resM[3] con fecha limite del $resM[4] ha sido firmada por el supervisor de calidad  y entrenamiento, en la cual hubo discrepancia en el resultado y requiere agendar reunion.";
				else
					$Body="La evaluacion de $resM[1] $resM[2] $resM[3] con fecha limite del $resM[4] ha sido firmada por el supervisor de calidad  y entrenamiento, en la cual requiere su firma para continuar con el proceso de retroalimentación";
				if($discrepancia!="0")
				$success = mail($email, "Evaluacion de desempeño hourly - $resM[1] $resM[2] $resM[3]", $Body, "From: <$EmailFrom>");
				$count++;
			}
		}
		echo"<script>alert(\"La evaluacion ha sido Firmada\");window.location=\"menu.php\";</script>";
	}else
	{
		$consulta  = "update evaluaciones set  aprovado_e='$aprovado_e', coment_e='$coment_e' where id=$verev";
		$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro: $consulta". mysqli_error($enlace) );
	}
	
}

////////////////////////////////////Firma evaluacion del HRVP
if($_POST["firmar_rh"]=="Firmar")
{
	
	
	
	$aprovado_rh=$_POST["aprovado_rh"];

		$consulta  = "SELECT usuarios.email, empleados.nombre, empleados.app,
					 empleados.apm, DATE_FORMAT(evaluaciones.fecha_eval,'%d-%m-%Y'), evaluaciones.fecha_s,
					  evaluaciones.fecha_c, evaluaciones.fecha_e, evaluaciones.aprovado_s,
					   evaluaciones.aprovado_c, evaluaciones.aprovado_e
					    from evaluaciones inner join empleados on evaluaciones.id_empleado=empleados.id inner join usuarios on empleados.id_supervisor=usuarios.id where evaluaciones.id='$verev' ";		
		$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace));
		if(@mysqli_num_rows($resultado)>=1)
		{
			$discrepancia=0;
			$resM=mysqli_fetch_row($resultado);
			
			if($aprovado_rh=="1")// revisa que supervisores evaluaron
			{
				
				$consulta  = "update evaluaciones set   fecha_rh=now(), aprovado_rh='$aprovado_rh', id_rh='$idU' where id=$verev";
				$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro: ". mysqli_error($enlace) );	
				
		
		
				$consulta  = "SELECT usuarios.email from  usuarios where tipo in (5)";		
				$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace));
				$count=0;
				while(@mysqli_num_rows($resultado)>$count)
				{
					$res=mysqli_fetch_row($resultado);
					$email=$res[0];
					$EmailFrom="notificaciones@evhourly.com";
					
					
						$Body="La evaluacion de $resM[1] $resM[2] $resM[3]  ha sido firmada por el   HRVP, requiere de su validacion.";
					
					$success = mail($email, "Evaluacion de desempeño hourly - $resM[1] $resM[2] $resM[3]", $Body, "From: <$EmailFrom>");
					$count++;
				}
			}
			else
			{
				$consulta  = "update evaluaciones set   fecha_rh=now(), aprovado_rh='$aprovado_rh', id_rh='$idU', estatus=7 where id=$verev";
				$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro: ". mysqli_error($enlace) );
				$consulta  = "SELECT usuarios.email from  usuarios where tipo in (1)";		
				$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace));
				$count=0;
				while(@mysqli_num_rows($resultado)>$count)
				{
					$res=mysqli_fetch_row($resultado);
					$email=$res[0];
					$EmailFrom="notificaciones@evhourly.com";
					
					
						$Body="La evaluacion de $resM[1] $resM[2] $resM[3]  ha sido firmada por el  HRVP como NO APROBADO.";
					
					$success = mail($email, "Evaluacion de desempeño hourly - $resM[1] $resM[2] $resM[3]", $Body, "From: <$EmailFrom>");
					$count++;
				}
			}
			
		}
		echo"<script>alert(\"La evaluacion ha sido Firmada\");window.location=\"menu.php\";</script>";
	
	
}

////////////////////////////////////Firma evaluacion del Value stream manager
if($_POST["firmar_v"]=="Firmar")
{
	
	
	
	$aprovado_v=$_POST["aprovado_v"];

		$consulta  = "SELECT usuarios.email, empleados.nombre, empleados.app,
					 empleados.apm, DATE_FORMAT(evaluaciones.fecha_eval,'%d-%m-%Y'), evaluaciones.fecha_s,
					  evaluaciones.fecha_c, evaluaciones.fecha_e, evaluaciones.aprovado_s,
					   evaluaciones.aprovado_c, evaluaciones.aprovado_e
					    from evaluaciones inner join empleados on evaluaciones.id_empleado=empleados.id inner join usuarios on empleados.id_supervisor=usuarios.id where evaluaciones.id='$verev' ";		
		$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace));
		if(@mysqli_num_rows($resultado)>=1)
		{
			
			$resM=mysqli_fetch_row($resultado);
			
			if($aprovado_v=="1")// revisa que supervisores evaluaron
			{
				
				$consulta  = "update evaluaciones set   fecha_v=now(), aprovado_v='$aprovado_v', id_v='$idU', estatus=5 where id=$verev";
				$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro: ". mysqli_error($enlace) );	
				
		
		
				$consulta  = "SELECT usuarios.email from  usuarios where tipo in (1)";		
				$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace));
				$count=0;
				while(@mysqli_num_rows($resultado)>$count)
				{
					$res=mysqli_fetch_row($resultado);
					$email=$res[0];
					$EmailFrom="notificaciones@evhourly.com";
					
					
						$Body="La evaluacion de $resM[1] $resM[2] $resM[3]  ha sido firmada por el   VSM";
					
					$success = mail($email, "Evaluacion de desempeño hourly - $resM[1] $resM[2] $resM[3]", $Body, "From: <$EmailFrom>");
					$count++;
				}
			}
			else
			{
				$consulta  = "update evaluaciones set   fecha_v=now(), aprovado_v='$aprovado_v', id_v='$idU', estatus=7 where id=$verev";
				$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro: ". mysqli_error($enlace) );
				$consulta  = "SELECT usuarios.email from  usuarios where tipo in (1)";		
				$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace));
				$count=0;
				while(@mysqli_num_rows($resultado)>$count)
				{
					$res=mysqli_fetch_row($resultado);
					$email=$res[0];
					$EmailFrom="notificaciones@evhourly.com";
					
					
						$Body="La evaluacion de $resM[1] $resM[2] $resM[3]  ha sido firmada por el  VSM como NO APROBADO.";
					
					$success = mail($email, "Evaluacion de desempeño hourly - $resM[1] $resM[2] $resM[3]", $Body, "From: <$EmailFrom>");
					$count++;
				}
			}
			
		}
		echo"<script>alert(\"La evaluacion ha sido Firmada\");window.location=\"menu.php\";</script>";
	
	
}

//busca informacion del evaluado
$consulta  = "SELECT empleados.id, empleados.nombre,empleados.app,
			empleados.apm, usuarios.nombre, DATE_FORMAT(evaluaciones.inicio_periodo,'%m-%d-%Y'), 
			DATE_FORMAT(evaluaciones.fin_periodo,'%d-%m-%Y'), DATE_FORMAT(evaluaciones.fecha_eval,'%d-%m-%Y'), estatus.nombre,
			 tipo_evaluacion.nombre, evaluaciones.id ,evaluaciones.inicio_periodo,
			  evaluaciones.fin_periodo, evaluaciones.estatus, empleados.nivel,
			   evaluaciones.puesto, empleados.value, evaluaciones.iks,
			    empleados.iks, MONTH(evaluaciones.inicio_periodo), MONTH(evaluaciones.fin_periodo),
				 evaluaciones.inicio_periodo, evaluaciones.fin_periodo, evaluaciones.tipo,
				 empleados.area, evaluaciones.fecha_c, evaluaciones.fecha_e  
				 FROM evaluaciones inner join empleados on evaluaciones.id_empleado=empleados.id inner join usuarios on empleados.id_supervisor=usuarios.id inner join tipo_evaluacion on evaluaciones.tipo=tipo_evaluacion.id inner join estatus on evaluaciones.estatus=estatus.id where evaluaciones.id=$verev ";
//echo"$consulta";
$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)	
if(@mysqli_num_rows($resultado)>0)					
{
	$res=mysqli_fetch_row($resultado);
	if($res[17]=="")
		$iks=$res[18];
	else
		$iks=$res[17];
	$mes_inicio=$res[19];
	$mes_fin=$res[20];
	$cuantos=($mes_fin-$mes_inicio)+1;
}
$relacion=array(0,0,0,0,0,0,0,0,0,0,0,0,0);
$temp_inicio=$mes_inicio;
for($i=1 ; $i<=12 ; $i++)
{
	$relacion[$i]=$temp_inicio;
	if($temp_inicio=="12")
		$temp_inicio=1;
	else
		$temp_inicio++;
	
}
$fis=array(0,0,0,0,0,0,0,0,0,0,0,0,0);
$pes=array(0,0,0,0,0,0,0,0,0,0,0,0,0);
$fjs=array(0,0,0,0,0,0,0,0,0,0,0,0,0);
$re=array(0,0,0,0,0,0,0,0,0,0,0,0,0);
$dis=array(0,0,0,0,0,0,0,0,0,0,0,0,0);
$consulta2  = "SELECT count(id),MONTH(fecha), tipo FROM `inasistencias` where id_empleado=$res[0] and fecha>='$res[21]' and fecha<='$res[22]' group by MONTH(fecha), tipo order by MONTH(fecha)";
//echo" $consulta2";
$resultado2 = mysqli_query($enlace,$consulta2) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)	
$count=0;
$count_inicio=$mes_inicio;
while(@mysqli_num_rows($resultado2)>$count)					
{
	$res2=mysqli_fetch_row($resultado2);
	if($res2[2]=="FI")
		$fis[$res2[1]]=$res2[0];
	if($res2[2]=="FJ")
		$fjs[$res2[1]]=$res2[0];
	if($res2[2]=="PE")
		$pes[$res[1]]=$res[0];
	if($res2[2]=="RE")
		$re[$res2[1]]=$res2[0];
	if($res2[2]=="SU")
		$dis[$res2[1]]=$res2[0];
	$count++;
	
}
/*$consulta2  = "SELECT count(id),MONTH(fecha) FROM `suspensiones` where id_empleado=$res[0] and fecha>='$res[5]' and fecha<='$res[6]' group by MONTH(fecha) order by MONTH(fecha)";
//echo"$id_sup $id_estatus $consulta";
$resultado2 = mysqli_query($enlace,$consulta2) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)	
$count=0;
while(@mysqli_num_rows($resultado2)>$count)					
{
	$res2=mysqli_fetch_row($resultado2);
	
	$dis[$res2[1]]=$res2[0];
	
	$count++;
	
}*/
$consultaE  = "SELECT evaluaciones.faltas_rh, us1.nombre, evaluaciones.fecha_faltas_rh,
			 evaluaciones.efi_sup, us2.nombre, evaluaciones.fecha_efi_sup,
			  evaluaciones.coment_s, evaluaciones.fecha_s, evaluaciones.aprovado_s,
			  evaluaciones.coment_c, evaluaciones.fecha_c, evaluaciones.aprovado_c,
			  evaluaciones.coment_e, evaluaciones.fecha_e, evaluaciones.aprovado_e, 
			  us3.nombre, us4.nombre, us5.nombre,
			   us6.nombre,  evaluaciones.fecha_rh, evaluaciones.aprovado_rh,
				evaluaciones.fecha_v, evaluaciones.aprovado_v
			    FROM evaluaciones left outer join usuarios as us1 on evaluaciones.id_faltas_rh=us1.id left outer join usuarios as us2 on evaluaciones.id_efi_sup=us2.id left outer join usuarios as us3 on evaluaciones.id_c=us3.id left outer join usuarios as us4 on evaluaciones.id_e=us4.id left outer join usuarios as us5 on evaluaciones.id_rh=us5.id  left outer join usuarios as us6 on evaluaciones.id_v=us6.id where evaluaciones.id=$verev ";
//echo"$id_sup $id_estatus $consulta";
$resultadoE = mysqli_query($enlace,$consultaE) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)	
if(@mysqli_num_rows($resultadoE)>0)					
{
	$resE=mysqli_fetch_row($resultadoE);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bell</title>
<link rel="stylesheet" href="colorbox.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="colorbox/jquery.colorbox-min.js"></script>

<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url();
	background-color: #E5E5E5;
}
-->
</style>
<link href="images/textos.css" rel="stylesheet" type="text/css" />
<script>
	$(document).ready(function(){
		$(".iframe2").colorbox({iframe:true,width:"450", height:"320",transition:"fade", scrolling:false, opacity:0.1});
		$(".iframeD").colorbox({iframe:true,width:"850", height:"420",transition:"fade", scrolling:false, opacity:0.9});
		$("#click").click(function(){ 
			$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
			return false;
		});
	});
</script>
<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function verobjetivos(dato)
{
	document.form1.verobjetivos.value=dato;
	document.form1.action="objetivos.php";
	document.form1.target="blank";
	document.form1.submit();
}
function buscar()
{
	document.form1.action="reporte_planes.php";
	document.form1.submit();
}
//-->
</script>
<style type="text/css">
<!--
.style17 {font-family: Arial, Helvetica, sans-serif; color: #999999; font-size: 12px; font-weight: bold; }
.style18 {font-size: 14px; color: #404040; text-decoration: none; font-family: "Helvetica LT Std";}
.style19 {color: #FFFFFF}
-->
</style>
</head>

<body onload="MM_preloadImages('images/b_cambio_r.png','images/b_administracion_r.png','images/b_log_out_r.png')">
<form id="form1" name="form1" method="post" action="">
  <img src="images/header_1.jpg" width="900" height="107" />
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td background="images/bkg_admin.jpg"><table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="698" valign="top" background=""><table width="1020" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><img src="images/spacer.gif" width="10" height="20" /></td>
      </tr>
      <tr>
        <td><div align="center">
          <table width="850" border="0" cellspacing="7" cellpadding="0">

            <tr>
              <td><div align="center" class="text_mediano">EVALAUCION DE DESEMPEÑO</div></td>
            </tr>
          </table>
        </div></td>
      </tr>
      <tr>
        <td><img src="images/spacer.gif" width="10" height="20" />
          <input name="verev" type="hidden" id="verev" value="<?echo"$verev";?>" />
          <input name="idEmp" type="hidden" id="idEmp" value="<?echo"$res[0]";?>" /></td>
      </tr>
      <tr>
        <td><img src="images/spacer.gif" width="10" height="10" /></td>
      </tr>
      <tr>
        <td><table width="1020" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="250" valign="top" bgcolor="#eeeeee"><table width="964" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td><table width="100%" border="0" cellspacing="3" cellpadding="0">
                  <tr>
                    <td colspan="2"><div align="center"><span class="style18"><strong>Tipo de Evaluación:</strong> <? echo"$res[9]";?></span></div></td>
                    <td colspan="2"><div align="center"><span class="text_mediano"><span class="text_mediano"><strong>Nivel Actual</strong></span>: </span><span class="style18"><? echo"$res[14]";?></span> </div></td>
                    <td colspan="2" class="style18"><div align="center"><span class="text_mediano">Nivel que Aplica:</span><? echo"$res[15]";?></div></td>
                  </tr>
                  <tr>
                    <td colspan="2">&nbsp;</td>
                    <td colspan="2"><div align="right"></div></td>
                    <td colspan="2" class="style18">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2" bgcolor="#FFFFFF" class="style18">No. y Nombre : </td>
                    <td colspan="2" bgcolor="#FFFFFF" class="style18">Item / Value Stream: </td>
                    <td colspan="2" bgcolor="#FFFFFF" class="style18">Supervisor:</td>
                  </tr>
                  <tr>
                    <td width="3%" class="text_mediano">&nbsp;</td>
                    <td width="32%" class="text_mediano"><span class="style18"><? echo"$res[0]";?></span> <span class="style18"><? echo"$res[1]";?> <? echo"$res[2]";?> <? echo"$res[3]";?></span></td>
                    <td width="4%" class="text_mediano">&nbsp;</td>
                    <td width="30%" class="text_mediano"><span class="style18"><? echo"$res[24]";?></span></td>
                    <td width="4%" class="text_mediano">&nbsp;</td>
                    <td width="27%" class="text_mediano"><span class="style18"><? echo"$res[4]";?></span></td>
                  </tr>
                  <tr>
                    <td colspan="2" bgcolor="#FFFFFF" class="style18">Periodo de evaluación: </td>
                    <td colspan="2" bgcolor="#FFFFFF" class="style18">IKs que domina: </td>
                    <td colspan="2" bgcolor="#FFFFFF" class="style18">&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="text_mediano">&nbsp;</td>
                    <td class="text_mediano"><span class="style18"><? echo"$res[5]";?></span> al <span class="style18"><? echo"$res[6]";?></span></td>
                    <td colspan="4" class="style18"><input name="iks" type="text" id="iks" value="<? echo"$iks";?> " size="70" maxlength="70" /></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td><div align="center"></div></td>
              </tr>
              <tr>
                <td><img src="images/spacer.gif" width="10" height="10" /></td>
              </tr>
              <tr>
                <td height="40" valign="bottom" bgcolor="#FFFFFF" class="text_grande">1.- PRE-REQUISITOS </td>
              </tr>
              <tr>
                <td valign="top"><table width="100%" border="2" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="18%">&nbsp;</td>
                    <td width="19%"><input name="verobjetivos" type="hidden" id="verobjetivos" />
                      <input name="cuantos" type="hidden" id="cuantos" value="<?echo"$res[23]";?>" /></td>
                    <td colspan="12"><div align="center" class="style17">Resultados del Periodo de Revisión NORMAL </div></td>
                    <td width="15%"><div align="center"></div></td>
                    </tr>
                  <tr>
                    <td bgcolor="#00475c" class="text_mediano_blanco">Criterios</td>
                    <td bgcolor="#00475c" class="text_mediano_blanco">KPI's</td>
                    <td width="4%" bgcolor="#00475c" class="text_mediano_blanco"><div align="center">Mes <br />
                      1 </div></td>
                    <td width="4%" bgcolor="#00475c" class="text_mediano_blanco"><div align="center">Mes <br />
                      2 </div></td>
                    <td width="4%" bgcolor="#00475c" class="text_mediano_blanco"><div align="center">Mes <br />
                      3 </div></td>
                    <td width="4%" bgcolor="#00475c" class="text_mediano_blanco"><div align="center"><? if($res[23]>3){?>Mes <br />
                      4 <? }?></div></td>
                    <td width="4%" bgcolor="#00475c" class="text_mediano_blanco"><div align="center"><? if($res[23]>3){?>Mes <br />
                      5 <? }?></div></td>
                    <td width="4%" bgcolor="#00475c" class="text_mediano_blanco"><div align="center"><? if($res[23]>3){?>Mes <br />
                      6 <? }?></div></td>
                    <td width="4%" bgcolor="#00475c" class="text_mediano_blanco"><div align="center"><? if($res[23]>6){?>Mes <br />
                      7 <? }?></div></td>
                    <td width="4%" bgcolor="#00475c" class="text_mediano_blanco"><div align="center"><? if($res[23]>6){?>Mes <br />
                      8 <? }?></div></td>
                    <td width="4%" bgcolor="#00475c" class="text_mediano_blanco"><div align="center"><? if($res[23]>6){?>Mes <br />
                      9 <? }?></div></td>
                    <td width="4%" bgcolor="#00475c" class="text_mediano_blanco"><div align="center"><? if($res[23]>6){?>Mes <br />
                      10 <? }?></div></td>
                    <td width="4%" bgcolor="#00475c" class="text_mediano_blanco"><div align="center"><? if($res[23]>6){?>Mes <br />
                      11 <? }?></div></td>
                    <td width="4%" bgcolor="#00475c" class="text_mediano_blanco"><div align="center"><? if($res[23]>6){?>Mes <br />
                      12 <? }?></div></td>
                    <td bgcolor="#00475c" class="text_mediano_blanco"><div align="center">Autorizaciones</div></td>
                    </tr>
				  
                  <tr >
                    <td  class="texto_tareas"><div align="left">
                      <p><strong>1.- Asistencia</strong><br /> 
                        <span class="texto_chico">Inaistencias y retardos</span></p>
                      </div></td>
                    <td  class="texto_tareas"><table width="100%" border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td width="15%" class="texto_chico">Meta:</td>
                        <td width="63%" class="texto_chico">Injustificadas </td>
                        <td width="22%" class="texto_tareas"><div align="center">0</div></td>
                      </tr>
                      <tr>
                        <td class="texto_chico">&nbsp;</td>
                        <td class="texto_chico">Permisos </td>
                        <td class="texto_tareas"><div align="center">7</div></td>
                      </tr>
                      <tr>
                        <td class="texto_chico">&nbsp;</td>
                        <td class="texto_chico">Retardos </td>
                        <td class="texto_tareas"><div align="center">5</div></td>
                      </tr>
                    </table>                      
                      <a href="javascript:verobjetivos('<?echo"$res[10]";?>');" class="texto_tareas"></a></td>
                    <td  class="texto_tareas"><div align="left">
                      <table width="100%" border="0" cellpadding="0" cellspacing="3">
                        <tr>
                          <td><div align="center"><? echo $fis[$relacion[1]];?></div></td>
                        </tr>
                        <tr>
                          <td><div align="center"><? echo $fjs[$relacion[1]]+$pes[$relacion[1]];?></div></td>
                        </tr>
                        <tr>
                          <td><div align="center"><? echo $re[$relacion[1]];?></div></td>
                        </tr>
                      </table>
                    </div></td>
                    <td  class="texto_tareas"><div align="center">
                      <table width="100%" border="0" cellspacing="3" cellpadding="0">
                        <tr>
                          <td><div align="center"><? echo $fis[$relacion[2]];?></div></td>
                        </tr>
                        <tr>
                          <td><div align="center"><? echo $fjs[$relacion[2]]+$pes[$relacion[2]];?></div></td>
                        </tr>
                        <tr>
                          <td><div align="center"><? echo$re[$relacion[2]];?></div></td>
                        </tr>
                      </table>
                    </div></td>
                    <td  class="texto_tareas"><div align="center">
                      <table width="100%" border="0" cellspacing="3" cellpadding="0">
                        <tr>
                          <td><div align="center"><? echo $fis[$relacion[3]];?></div></td>
                        </tr>
                        <tr>
                          <td><div align="center"><? echo $fjs[$relacion[3]]+$pes[$relacion[3]];?></div></td>
                        </tr>
                        <tr>
                          <td><div align="center"><? echo $re[$relacion[3]];?></div></td>
                        </tr>
                      </table>
                    </div></td>
                    <td  class="texto_tareas"><div align="center">
                      <? if($res[23]>3){?>
					  <table width="100%" border="0" cellspacing="3" cellpadding="0">
                        <tr>
                          <td><div align="center"><? echo $fis[$relacion[4]];?></div></td>
                        </tr>
                        <tr>
                          <td><div align="center"><? echo $fjs[$relacion[4]]+$pes[$relacion[4]];?></div></td>
                        </tr>
                        <tr>
                          <td><div align="center"><? echo $re[$relacion[4]];?></div></td>
                        </tr>
                      </table>
					  <?}?>
                    </div></td>
                    <td  class="texto_tareas"><div align="center">
					<? if($res[23]>3){?>
                      <table width="100%" border="0" cellspacing="3" cellpadding="0">
                        <tr>
                          <td><div align="center"><? echo $fis[$relacion[5]] ;?></div></td>
                        </tr>
                        <tr>
                          <td><div align="center"><? echo $fjs[$relacion[5]]+$pes[$relacion[5]];?></div></td>
                        </tr>
                        <tr>
                          <td><div align="center"><? echo $re[$relacion[5]];?></div></td>
                        </tr>
                      </table>
					  <?}?>
                    </div></td>
                    <td  class="texto_tareas"><div align="center">
					<? if($res[23]>3){?>
                      <table width="100%" border="0" cellspacing="3" cellpadding="0">
                        <tr>
                          <td><div align="center"><? echo $fis[$relacion[6]];?></div></td>
                        </tr>
                        <tr>
                          <td><div align="center"><? echo $fjs[$relacion[6]]+$pes[$relacion[6]];?></div></td>
                        </tr>
                        <tr>
                          <td><div align="center"><? echo $re[$relacion[6]];?></div></td>
                        </tr>
                      </table>
					  <?}?>
                    </div></td>
                    <td  class="texto_tareas">
					<? if($res[23]>6){?>
					<table width="100%" border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td><div align="center"><? echo $fis[$relacion[7]];?></div></td>
                      </tr>
                      <tr>
                        <td><div align="center"><? echo $fjs[$relacion[7]]+$pes[$relacion[7]];?></div></td>
                      </tr>
                      <tr>
                        <td><div align="center"><? echo $re[$relacion[7]];?></div></td>
                      </tr>
                    </table><? }?></td>
                    <td  class="texto_tareas"><? if($res[23]>6){?><table width="100%" border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td><div align="center"><? echo $fis[$relacion[8]];?></div></td>
                      </tr>
                      <tr>
                        <td><div align="center"><? echo $fjs[$relacion[8]]+$pes[$relacion[8]];?></div></td>
                      </tr>
                      <tr>
                        <td><div align="center"><? echo $re[$relacion[8]];?></div></td>
                      </tr>
                    </table><? }?></td>
                    <td  class="texto_tareas"><? if($res[23]>6){?><table width="100%" border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td><div align="center"><? echo $fis[$relacion[9]];?></div></td>
                      </tr>
                      <tr>
                        <td><div align="center"><? echo $fjs[$relacion[9]]+$pes[$relacion[9]];?></div></td>
                      </tr>
                      <tr>
                        <td><div align="center"><? echo $re[$relacion[9]];?></div></td>
                      </tr>
                    </table><? }?></td>
                    <td  class="texto_tareas"><? if($res[23]>6){?><table width="100%" border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td><div align="center"><? echo $fis[$relacion[10]];?></div></td>
                      </tr>
                      <tr>
                        <td><div align="center"><? echo $fjs[$relacion[10]]+$pes[$relacion[10]];?></div></td>
                      </tr>
                      <tr>
                        <td><div align="center"><? echo $re[$relacion[10]];?></div></td>
                      </tr>
                    </table><? }?></td>
                    <td  class="texto_tareas"><? if($res[23]>6){?><table width="100%" border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td><div align="center"><? echo $fis[$relacion[11]];?></div></td>
                      </tr>
                      <tr>
                        <td><div align="center"><? echo $fjs[$relacion[11]]+$pes[$relacion[11]];?></div></td>
                      </tr>
                      <tr>
                        <td><div align="center"><? echo $re[$relacion[11]];?></div></td>
                      </tr>
                    </table><? }?></td>
                    <td  class="texto_tareas"><? if($res[23]>6){?><table width="100%" border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td><div align="center"><? echo $fis[$relacion[12]];?></div></td>
                      </tr>
                      <tr>
                        <td><div align="center"><? echo $fjs[$relacion[12]]+$pes[$relacion[12]];?></div></td>
                      </tr>
                      <tr>
                        <td><div align="center"><? echo $re[$relacion[12]];?></div></td>
                      </tr>
                    </table><? }?></td>
                    <td rowspan="2" bgcolor="#FFFFFF"  class="texto_chico"><div align="center">
                      <table width="88%" border="0" cellspacing="3" cellpadding="0">
                        <tr>
                          <td><input type="radio" name="faltas_rh" id="faltas_rh" value="1" <? if($resE[0]=="1" && $resE[2]!=null)echo"checked";?> onclick="cambiaFalta()"/>
                            Aprobado</td>
                          </tr>
                        <tr>
                          <td><input type="radio" name="faltas_rh" id="faltas_rh" value="0"  <? if($resE[0]=="0" && $resE[2]!=null)echo"checked";?> onclick="cambiaFalta()"/> 
                            No Aprobado</td>
                        </tr>
                        <tr>
                          <td><div align="left">HRBP:  </div></td>
                        </tr>
                        <tr>
                          <td><? if($resE[2]!=null)echo"$resE[1] ($resE[2])";?></td>
                        </tr>
                        <tr>
                          <td><img src="images/spacer.gif" width="10" height="20" />
						  <? if($res[13]=="1"){?>
                            <textarea name="coment" cols="15" rows="4" id="coment"></textarea>
							<? }?></td>
                        </tr>
                      </table>
                    </div></td>
                    </tr>
				 
                  <tr>
                    <td bgcolor="#FFFFFF" class="texto_tareas"><p><strong>2.- Disciplina</strong><br />
                        <span class="texto_chico">Suspensiones y medidas disciplinarias                        </span></p>                      </td>
                    <td bgcolor="#FFFFFF" class="texto_tareas"><table width="100%" border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td width="18%" valign="top" class="texto_chico">Meta:</td>
                        <td width="59%" class="texto_chico">Suspensiones y medidas disciplinarias </td>
                        <td width="23%"><div align="center" class="texto_tareas">0</div></td>
                      </tr>

                    </table></td>
                    <td bgcolor="#FFFFFF" class="texto_tareas"><div align="center"><? echo $dis[$relacion[1]] ;?></div></td>
                    <td bgcolor="#FFFFFF" class="texto_tareas"><div align="center"><? echo $dis[$relacion[2]] ;?></div></td>
                    <td bgcolor="#FFFFFF" class="texto_tareas"><div align="center"><? echo $dis[$relacion[3]];?></div></td>
                    <td bgcolor="#FFFFFF" class="texto_tareas"><div align="center"><? if($res[23]>3){ echo $dis[$relacion[4]];}?></div></td>
                    <td bgcolor="#FFFFFF" class="texto_tareas"><div align="center"><? if($res[23]>3){ echo $dis[$relacion[5]];}?></div></td>
                    <td bgcolor="#FFFFFF" class="texto_tareas"><div align="center"><? if($res[23]>3){ echo $dis[$relacion[6]];}?></div></td>
                    <td bgcolor="#FFFFFF" class="texto_tareas"><div align="center"><? if($res[23]>6){echo $dis[$relacion[7]];}?></div></td>
                    <td bgcolor="#FFFFFF" class="texto_tareas"><div align="center"><? if($res[23]>6){echo $dis[$relacion[8]];}?></div></td>
                    <td bgcolor="#FFFFFF" class="texto_tareas"><div align="center"><? if($res[23]>6){echo $dis[$relacion[9]];}?></div></td>
                    <td bgcolor="#FFFFFF" class="texto_tareas"><div align="center"><? if($res[23]>6){echo $dis[$relacion[10]];}?></div></td>
                    <td bgcolor="#FFFFFF" class="texto_tareas"><div align="center"><? if($res[23]>6){echo $dis[$relacion[11]];}?></div></td>
                    <td bgcolor="#FFFFFF" class="texto_tareas"><div align="center"><? if($res[23]>6){echo $dis[$relacion[12]];}?></div></td>
                  </tr>
				  <?
				  $efi= array(0,0,0,0,0,0,0,0,0,0,0,0,0);
					$consultaC  = "SELECT * from detalle_eficiencia where id_evaluacion=$verev";
						//echo"$id_sup $id_estatus $consulta";
						$resultadoC = mysqli_query($enlace,$consultaC) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)	
						if(@mysqli_num_rows($resultadoC)>0)					
						{
							$resC=mysqli_fetch_row($resultadoC);
							$efi[0]=$resC[1];
							$efi[1]=$resC[2];
							$efi[2]=$resC[3];
							$efi[3]=$resC[4];
							$efi[4]=$resC[5];
							$efi[5]=$resC[6];
							$efi[6]=$resC[7];
							$efi[7]=$resC[8];
							$efi[8]=$resC[9];
							$efi[9]=$resC[10];
							$efi[10]=$resC[11];
							$efi[11]=$resC[12];
							$efi[12]=$resC[13];
							
							
						}	
					?>
                  <tr>
                    <td class="texto_tareas"><strong>3.- Eficiencia</strong><br />
                      <span class="texto_chico">Cumplimiento de meta ind. de eficiencia </span></td>
                    <td class="texto_tareas"><table width="100%" border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td width="18%" valign="top" class="texto_chico">Meta:</td>
                        <td width="58%" valign="top" class="texto_chico">Eficiencia Individual </td>
                        <td width="24%"><input name="eficiencia_meta" type="text" id="eficiencia_meta" value="<? echo $efi[0];?>" size="2" maxlength="2" style="width:17px"/>
                          <span class="texto_chico">%</span></td>
                      </tr>
                    </table></td>
                    <td class="texto_tareas"><div align="center">
                      <input name="eficiencia1" type="text" id="eficiencia1" value="<? echo $efi[1];?>" size="2" maxlength="2"  style="width:17px"/>
                    </div></td>
                    <td class="texto_chico"><div align="center">
                      <input name="eficiencia2" type="text" id="eficiencia2" value="<? echo $efi[2];?>" size="2" maxlength="2"  style="width:17px"/>
                    </div></td>
                    <td class="texto_chico"><div align="center">
                      <input name="eficiencia3" type="text" id="eficiencia3" value="<? echo $efi[3];?>" size="2" maxlength="2"  style="width:17px"/>
                    </div></td>
                    <td class="texto_chico"><div align="center">
                     <? if($res[23]>3){?> <input name="eficiencia4" type="text" id="eficiencia4" value="<? echo $efi[4];?>" size="2" maxlength="2"  style="width:17px"/><?}?>
                    </div></td>
                    <td class="texto_chico"><div align="center">
                     <? if($res[23]>3){?> <input name="eficiencia5" type="text" id="eficiencia5" value="<? echo $efi[5];?>" size="2" maxlength="2"  style="width:17px"/><?}?>
                    </div></td>
                    <td class="texto_chico"><div align="center">
                     <? if($res[23]>3){?> <input name="eficiencia6" type="text" id="eficiencia6" value="<? echo $efi[6];?>" size="2" maxlength="2"  style="width:17px"/><?}?>
                    </div></td>
                    <td class="texto_chico"><div align="center">
                     <? if($res[23]>6){?> <input name="eficiencia7" type="text" id="eficiencia7" value="<? echo $efi[7];?>" size="2" maxlength="2"  style="width:17px"/><?}?>
                    </div></td>
                    <td class="texto_chico"><div align="center">
                      <? if($res[23]>6){?> <input name="eficiencia8" type="text" id="eficiencia8" value="<? echo $efi[8];?>" size="2" maxlength="2"  style="width:17px"/><?}?>
                    </div></td>
                    <td class="texto_chico"><div align="center">
                      <? if($res[23]>6){?> <input name="eficiencia9" type="text" id="eficiencia9" value="<? echo $efi[9];?>" size="2" maxlength="2"  style="width:17px"/><?}?>
                    </div></td>
                    <td class="texto_chico"><div align="center">
                      <? if($res[23]>6){?> <input name="eficiencia10" type="text" id="eficiencia10" value="<? echo $efi[10];?>" size="2" maxlength="2"  style="width:17px"/><?}?>
                    </div></td>
                    <td class="texto_chico"><div align="center">
                      <? if($res[23]>6){?> <input name="eficiencia11" type="text" id="eficiencia11" value="<? echo $efi[11];?>" size="2" maxlength="2"  style="width:17px"/><?}?>
                    </div></td>
                    <td class="texto_chico"><div align="center">
                      <? if($res[23]>6){?> <input name="eficiencia12" type="text" id="eficiencia12" value="<? echo $efi[12];?>" size="2" maxlength="2"  style="width:17px"/><?}?>
                    </div></td>
                    <td rowspan="2" bgcolor="#FFFFFF" class="texto_chico"> <? if($res[13]>1){?><table width="89%" border="0" align="center" cellpadding="0" cellspacing="3">
                      <tr>
                        <td><input type="radio" name="efi_sup" id="efi_sup" value="1" <? if($resE[3]=="1")echo"checked";?>/>
                          Aprobado</td>
                      </tr>
                      <tr>
                        <td><input type="radio" name="efi_sup" id="efi_sup" value="0" <? if($resE[3]=="0")echo"checked";?>/>
                          No Aprobado</td>
                      </tr>
                      <tr>
                        <td><div align="left">Supervisor: </div></td>
                      </tr>
                      <tr>
                        <td><? if($resE[5]!=null)echo"$resE[4] ($resE[5])";?></td>
                      </tr>
                      <tr>
                        <td><img src="images/spacer.gif" width="10" height="20" /></td>
                      </tr>
                    </table><? }?></td>
                    </tr>
					<?
					$ncr_meta=   array(0,0,0,0,0,0,0,0,0,0,0,0,0);
					$ncr_resul=  array(0,0,0,0,0,0,0,0,0,0,0,0,0);
					$scrap_meta= array(0,0,0,0,0,0,0,0,0,0,0,0,0);
					$scrap_resul=array(0,0,0,0,0,0,0,0,0,0,0,0,0);
					$snag_meta=  array(0,0,0,0,0,0,0,0,0,0,0,0,0);
					$snag_resul= array(0,0,0,0,0,0,0,0,0,0,0,0,0);
					$consultaC  = "SELECT * from detalle_calidad where id_evaluacion=$verev order by numero";
						//echo"$id_sup $id_estatus $consulta";
						$resultadoC = mysqli_query($enlace,$consultaC) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)	
						$countC=0;
						while(@mysqli_num_rows($resultadoC)>$countC)					
						{
							$resC=mysqli_fetch_row($resultadoC);
							$ncr_meta[$countC]=$resC[3];
							$ncr_resul[$countC]=$resC[4];
							$scrap_meta[$countC]=$resC[5];
							$scrap_resul[$countC]=$resC[6];
							$snag_meta[$countC]=$resC[7];
							$snag_resul[$countC]=$resC[8];
							$countC++;
						}	
					?>
                  <tr>
                    <td valign="top" bgcolor="#FFFFFF" class="texto_tareas"><strong>4.- Calidad</strong><br />
                      Nivel de defectos individuales <br /></td>
                    <td bgcolor="#FFFFFF" class="texto_tareas"><table width="100%" border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td width="15%" class="texto_chico">Meta:</td>
                        <td width="66%" height="22" class="texto_chico"><div align="right">NCR </div></td>
                        </tr>
                      <tr>
                        <td bgcolor="#EEEEEE" class="texto_chico">&nbsp;</td>
                        <td height="22" bgcolor="#EEEEEE" class="texto_chico"><div align="right">Resultados NCR </div></td>
                        </tr>
                      <tr>
                        <td class="texto_chico">Meta:</td>
                        <td height="22" class="texto_chico"><div align="right">Scrap </div></td>
                        </tr>
                      <tr>
                        <td bgcolor="#EEEEEE" class="texto_chico">&nbsp;</td>
                        <td height="22" bgcolor="#EEEEEE" class="texto_chico"><div align="right">Resultados SCRAP </div></td>
                      </tr>
                      <tr>
                        <td class="texto_chico">Meta:</td>
                        <td height="22" class="texto_chico"><div align="right">Snags</div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE" class="texto_chico">&nbsp;</td>
                        <td height="22" bgcolor="#EEEEEE" class="texto_chico"><div align="right">Resultados SNAGS </div></td>
                      </tr>
                    </table></td>
                    <td bgcolor="#FFFFFF" class="texto_tareas"><table width="100%" border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td><div align="center">
                          <input name="ncr_meta[]" type="text" id="ncr_meta" value="<?echo $ncr_meta[0];?>" size="2" maxlength="2" style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center">
                          <input name="ncr_resul[]" type="text" id="ncr_resul" value="<?echo $ncr_resul[0];?>" size="2" maxlength="2" style="width:17px" />
                        </div></td>
                      </tr>
                      <tr>
                        <td><div align="center">
                          <input name="scrap_meta[]" type="text" id="scrap_meta" value="<?echo $scrap_meta[0];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center">
                          <input name="scrap_resul[]" type="text" id="scrap_resul" value="<?echo $scrap_resul[0];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td><div align="center">
                          <input name="snag_meta[]" type="text" id="snag_meta" value="<?echo $snag_meta[0];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center">
                          <input name="snag_resul[]" type="text" id="snag_resul" value="<?echo $snag_resul[0];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                    </table></td>
                    <td bgcolor="#FFFFFF" class="texto_chico"><table width="100%" border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td><div align="center">
                            <input name="ncr_meta[]" type="text" id="ncr_meta" value="<?echo $ncr_meta[1];?>" size="2" maxlength="2" style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center">
                            <input name="ncr_resul[]" type="text" id="ncr_resul" value="<?echo $ncr_resul[1];?>" size="2" maxlength="2" style="width:17px" />
                        </div></td>
                      </tr>
                      <tr>
                        <td><div align="center">
                            <input name="scrap_meta[]" type="text" id="scrap_meta" value="<?echo $scrap_meta[1];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center">
                            <input name="scrap_resul[]" type="text" id="scrap_resul" value="<?echo $scrap_resul[1];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td><div align="center">
                            <input name="snag_meta[]" type="text" id="snag_meta" value="<?echo $snag_meta[1];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center">
                            <input name="snag_resul[]" type="text" id="snag_resul" value="<?echo $snag_resul[1];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                    </table></td>
                    <td bgcolor="#FFFFFF" class="texto_chico"><table width="100%" border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td><div align="center">
                            <input name="ncr_meta[]" type="text" id="ncr_meta" value="<?echo $ncr_meta[2];?>" size="2" maxlength="2" style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center">
                            <input name="ncr_resul[]" type="text" id="ncr_resul" value="<?echo $ncr_resul[2];?>" size="2" maxlength="2" style="width:17px" />
                        </div></td>
                      </tr>
                      <tr>
                        <td><div align="center">
                            <input name="scrap_meta[]" type="text" id="scrap_meta" value="<?echo $scrap_meta[2];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center">
                            <input name="scrap_resul[]" type="text" id="scrap_resul" value="<?echo $scrap_resul[2];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td><div align="center">
                            <input name="snag_meta[]" type="text" id="snag_meta" value="<?echo $snag_meta[2];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center">
                            <input name="snag_resul[]" type="text" id="snag_resul" value="<?echo $snag_resul[2];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                    </table></td>
                    <td bgcolor="#FFFFFF" class="texto_chico"><? if($res[23]>3){?> <table width="100%" border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td><div align="center">
                            <input name="ncr_meta[]" type="text" id="ncr_meta" value="<?echo $ncr_meta[3];?>" size="2" maxlength="2" style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center">
                            <input name="ncr_resul[]" type="text" id="ncr_resul" value="<?echo $ncr_resul[3];?>" size="2" maxlength="2" style="width:17px" />
                        </div></td>
                      </tr>
                      <tr>
                        <td><div align="center">
                            <input name="scrap_meta[]" type="text" id="scrap_meta" value="<?echo $scrap_meta[3];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center">
                            <input name="scrap_resul[]" type="text" id="scrap_resul" value="<?echo $scrap_resul[3];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td><div align="center">
                            <input name="snag_meta[]" type="text" id="snag_meta" value="<?echo $snag_meta[3];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center">
                            <input name="snag_resul[]" type="text" id="snag_resul" value="<?echo $snag_resul[3];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                    </table><?}?></td>
                    <td bgcolor="#FFFFFF" class="texto_chico"><? if($res[23]>3){?> <table width="100%" border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td><div align="center">
                            <input name="ncr_meta[]" type="text" id="ncr_meta" value="<?echo $ncr_meta[4];?>" size="2" maxlength="2" style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center">
                            <input name="ncr_resul[]" type="text" id="ncr_resul" value="<?echo $ncr_resul[4];?>" size="2" maxlength="2" style="width:17px" />
                        </div></td>
                      </tr>
                      <tr>
                        <td><div align="center">
                            <input name="scrap_meta[]" type="text" id="scrap_meta" value="<?echo $scrap_meta[4];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center">
                            <input name="scrap_resul[]" type="text" id="scrap_resul" value="<?echo $scrap_resul[4];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td><div align="center">
                            <input name="snag_meta[]" type="text" id="snag_meta" value="<?echo $snag_meta[4];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center">
                            <input name="snag_resul[]" type="text" id="snag_resul" value="<?echo $snag_resul[4];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                    </table><?}?></td>
                    <td bgcolor="#FFFFFF" class="texto_chico"><? if($res[23]>3){?> <table width="100%" border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td><div align="center">
                            <input name="ncr_meta[]" type="text" id="ncr_meta" value="<?echo $ncr_meta[5];?>" size="2" maxlength="2" style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center">
                            <input name="ncr_resul[]" type="text" id="ncr_resul" value="<?echo $ncr_resul[5];?>" size="2" maxlength="2" style="width:17px" />
                        </div></td>
                      </tr>
                      <tr>
                        <td><div align="center">
                            <input name="scrap_meta[]" type="text" id="scrap_meta" value="<?echo $scrap_meta[5];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center">
                            <input name="scrap_resul[]" type="text" id="scrap_resul" value="<?echo $scrap_resul[5];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td><div align="center">
                            <input name="snag_meta[]" type="text" id="snag_meta" value="<?echo $snag_meta[5];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center">
                            <input name="snag_resul[]" type="text" id="snag_resul" value="<?echo $snag_resul[5];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                    </table><?}?></td>
                    <td bgcolor="#FFFFFF" class="texto_chico"><? if($res[23]>6){?> <table width="100%" border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td><div align="center">
                            <input name="ncr_meta[]" type="text" id="ncr_meta" value="<?echo $ncr_meta[6];?>" size="2" maxlength="2" style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center">
                            <input name="ncr_resul[]" type="text" id="ncr_resul" value="<?echo $ncr_resul[6];?>" size="2" maxlength="2" style="width:17px" />
                        </div></td>
                      </tr>
                      <tr>
                        <td><div align="center">
                            <input name="scrap_meta[]" type="text" id="scrap_meta" value="<?echo $scrap_meta[6];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center">
                            <input name="scrap_resul[]" type="text" id="scrap_resul" value="<?echo $scrap_resul[6];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td><div align="center">
                            <input name="snag_meta[]" type="text" id="snag_meta" value="<?echo $snag_meta[6];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center">
                            <input name="snag_resul[]" type="text" id="snag_resul" value="<?echo $snag_resul[6];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                    </table><?}?></td>
                    <td bgcolor="#FFFFFF" class="texto_chico"><? if($res[23]>6){?><table width="100%" border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td><div align="center">
                            <input name="ncr_meta[]" type="text" id="ncr_meta" value="<?echo $ncr_meta[7];?>" size="2" maxlength="2" style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center">
                            <input name="ncr_resul[]" type="text" id="ncr_resul" value="<?echo $ncr_resul[7];?>" size="2" maxlength="2" style="width:17px" />
                        </div></td>
                      </tr>
                      <tr>
                        <td><div align="center">
                            <input name="scrap_meta[]" type="text" id="scrap_meta" value="<?echo $scrap_meta[7];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center">
                            <input name="scrap_resul[]" type="text" id="scrap_resul" value="<?echo $scrap_resul[7];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td><div align="center">
                            <input name="snag_meta[]" type="text" id="snag_meta" value="<?echo $snag_meta[7];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center">
                            <input name="snag_resul[]" type="text" id="snag_resul" value="<?echo $snag_resul[7];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                    </table><?}?></td>
                    <td bgcolor="#FFFFFF" class="texto_chico"><? if($res[23]>6){?><table width="100%" border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td><div align="center">
                            <input name="ncr_meta[]" type="text" id="ncr_meta" value="<?echo $ncr_meta[8];?>" size="2" maxlength="2" style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center">
                            <input name="ncr_resul[]" type="text" id="ncr_resul" value="<?echo $ncr_resul[8];?>" size="2" maxlength="2" style="width:17px" />
                        </div></td>
                      </tr>
                      <tr>
                        <td><div align="center">
                            <input name="scrap_meta[]" type="text" id="scrap_meta" value="<?echo $scrap_meta[8];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center">
                            <input name="scrap_resul[]" type="text" id="scrap_resul" value="<?echo $scrap_resul[8];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td><div align="center">
                            <input name="snag_meta[]" type="text" id="snag_meta" value="<?echo $snag_meta[8];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center">
                            <input name="snag_resul[]" type="text" id="snag_resul" value="<?echo $snag_resul[8];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                    </table><?}?></td>
                    <td bgcolor="#FFFFFF" class="texto_chico"><? if($res[23]>6){?><table width="100%" border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td><div align="center">
                            <input name="ncr_meta[]" type="text" id="ncr_meta[]9" value="<?echo $ncr_meta[9];?>" size="2" maxlength="2" style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center">
                            <input name="ncr_resul[]" type="text" id="ncr_resul" value="<?echo $ncr_resul[9];?>" size="2" maxlength="2" style="width:17px" />
                        </div></td>
                      </tr>
                      <tr>
                        <td><div align="center">
                            <input name="scrap_meta[]" type="text" id="scrap_meta" value="<?echo $scrap_meta[9];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center">
                            <input name="scrap_resul[]" type="text" id="scrap_resul" value="<?echo $scrap_resul[9];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td><div align="center">
                            <input name="snag_meta[]" type="text" id="snag_meta" value="<?echo $snag_meta[9];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center">
                            <input name="snag_resul[]" type="text" id="snag_resu" value="<?echo $snag_resul[9];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                    </table><?}?></td>
                    <td bgcolor="#FFFFFF" class="texto_chico"><? if($res[23]>6){?><table width="100%" border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td><div align="center">
                            <input name="ncr_meta[]" type="text" id="ncr_meta" value="<?echo $ncr_meta[10];?>" size="2" maxlength="2" style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center">
                            <input name="ncr_resul[]" type="text" id="ncr_resul" value="<?echo $ncr_resul[10];?>" size="2" maxlength="2" style="width:17px" />
                        </div></td>
                      </tr>
                      <tr>
                        <td><div align="center">
                            <input name="scrap_meta[]" type="text" id="scrap_meta" value="<?echo $scrap_meta[10];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center">
                            <input name="scrap_resul[]" type="text" id="scrap_resul" value="<?echo $scrap_resul[10];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td><div align="center">
                            <input name="snag_meta[]" type="text" id="snag_meta" value="<?echo $snag_meta[10];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center">
                            <input name="snag_resul[]" type="text" id="snag_resul" value="<?echo $snag_resul[10];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                    </table><?}?></td>
                    <td bgcolor="#FFFFFF" class="texto_chico"><? if($res[23]>6){?><table width="100%" border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td><div align="center">
                            <input name="ncr_meta[]" type="text" id="ncr_meta" value="<?echo $ncr_meta[11];?>" size="2" maxlength="2" style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center">
                            <input name="ncr_resul[]" type="text" id="ncr_resul" value="<?echo $ncr_resul[11];?>" size="2" maxlength="2" style="width:17px" />
                        </div></td>
                      </tr>
                      <tr>
                        <td><div align="center">
                            <input name="scrap_meta[]" type="text" id="scrap_meta" value="<?echo $scrap_meta[11];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center">
                            <input name="scrap_resul[]" type="text" id="scrap_resul" value="<?echo $scrap_resul[11];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td><div align="center">
                            <input name="snag_meta[]" type="text" id="snag_meta" value="<?echo $snag_meta[11];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#EEEEEE"><div align="center">
                            <input name="snag_resul[]" type="text" id="snag_resul" value="<?echo $snag_resul[11];?>" size="2" maxlength="2"  style="width:17px"/>
                        </div></td>
                      </tr>
                    </table><?}?></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td><div align="center"><img src="images/spacer.gif" width="10" height="20" /></div></td>
              </tr>
			  <? if($res[13]>=2){?>
              <tr>
                <td height="40" valign="bottom" bgcolor="#FFFFFF" class="text_grande">2.- VALIDACÓN DE COMPETENCIAS </td>
              </tr>
              <tr>
                <td>
				<?
						$coment=array('','','','','','');
						$v_sup=array(0,0,0,0,0,0);
						$v_cal=array(0,0,0,0,0,0);
						$v_entre=array(0,0,0,0,0,0);
						$consultaC  = "SELECT * from detalle_competencia where id_evaluacion=$verev order by numero";
						//echo"$id_sup $id_estatus $consulta";
						$resultadoC = mysqli_query($enlace,$consultaC) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)	
						$countC=0;
						while(@mysqli_num_rows($resultadoC)>$countC)					
						{
							$resC=mysqli_fetch_row($resultadoC);
							$coment[$countC]=$resC[4];
							$v_sup[$countC]=$resC[5];
							$v_cal[$countC]=$resC[6];
							$v_entre[$countC]=$resC[7];
							
							
							$countC++;
						}
						$texto1=array('','','','','','');
						$texto2=array('','','','','','');
						$nivelC=substr($res[15], -1);
						$consultaC  = "SELECT * from competencias where nivel='$nivelC'";
						//echo"$consultaC";
						$resultadoC = mysqli_query($enlace,$consultaC) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)	
						if(@mysqli_num_rows($resultadoC)>0)					
						{
							$resC=mysqli_fetch_row($resultadoC);
							$countT=0;
							for($i=2;$i<13;$i=$i+2)
							{
								$texto1[$countT]=str_replace("\n","<br>",$resC[$i]);
				
								$countT++;
							}
							$countT=0;
							for($i=3;$i<14;$i=$i+2)
							{
								
								$texto2[$countT]=str_replace("\n","<br>",$resC[$i]);
								$countT++;
							}

						}	
					?>
				<table width="100%" border="0" cellpadding="0" cellspacing="2" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
                  <tr valign="top" bgcolor="#00475c" class="text_mediano_blanco">
                    <td colspan="4" bgcolor="#999999" class="text_mediano_blanco">Para cada competencia, indicar &quot;SI&quot; en la columna correspondiente si los resultados del empleado coinciden con la definición de la competencia y pueden ser validados</td>
                    </tr>
                  <tr>
                    <td colspan="4" valign="top" bgcolor="#00475c" class="text_mediano_blanco">1.- <span class="text_mediano_blanco">CONOCIMIENTOS TÉCNICOS  (BPS) </span><br>                      <div align="center"></div></td>
                    </tr>
                  
                  <tr>
                    <td valign="top" class="text_mediano_blanco">&nbsp;</td>
                    <td colspan="3" rowspan="2" valign="top" bgcolor="#E2E2E2" class="texto_tareas"><p><span class="texto_tareas"><strong><? echo"$texto1[0]";?></strong></span></p>
                      <p><span class="text_mediano"><span class="texto_tareas"><? echo"$texto2[0]";?></span></span></p></td>
                    </tr>
                  <tr>
                    <td valign="top" class="text_mediano_blanco">&nbsp;</td>
                    </tr>
                  <tr>
                    <td width="1%" valign="top" class="text_mediano_blanco">&nbsp;</td>
                    <td width="22%" valign="top" bgcolor="#FFFFFF" class="texto_tareas"><p>Comentarios o ejemplos que soportan esta calificación:</p>
                      <p align="center"></p></td>
                    <td width="36" colspan="2" bgcolor="#FFFFFF"><div align="center">
                      <textarea name="coment1" cols="60" rows="3" id="coment1"><?echo"$coment[0]";?></textarea>
                    </div></td>
                    </tr>
                  <tr>
                    <td valign="top" class="text_mediano_blanco">&nbsp;</td>
                    <td colspan="3" valign="top" bgcolor="#FFFFFF" class="texto_tareas"><table width="100%" border="0" cellpadding="0" cellspacing="3" bgcolor="#FFFFFF">
                      <tr>
                        <td width="28%" height="30" bgcolor="#666666" class="text_mediano"><div align="right" class="text_mediano_blanco">
                          <div align="center">Validación</div>
                        </div></td>
                        <td width="9%" bgcolor="#FFFF00" class="text_mediano"><div align="right">Supervisor</div></td>
                        <td width="12%" bgcolor="#FFFF00" class="text_mediano"><div align="left">
                          <input name="v1_sup" type="radio" value="1" <? if($v_sup[0]=="1") echo"checked";?>/>
                          Si 
                          <input name="v1_sup" type="radio" value="0" <? if($v_sup[0]=="0") echo"checked";?>/>
                          No</div></td>
                        <td width="11%" bgcolor="#FFFF00" class="text_mediano">
                            <div align="right">
                              <? if($res[13]>3 || $idA=="2"){?>
                              Calidad
                              <? }?>
                                </div></td>
                        <td width="15%" bgcolor="#FFFF00" class="text_mediano"><div align="left">
                            <? if($res[13]>3 || $idA=="2"){?>
                            <input name="v1_cal" type="radio" value="1" <? if($v_cal[0]=="1") echo"checked";?>/>
                            Si
  <input name="v1_cal" type="radio" value="0" <? if($v_cal[0]=="0") echo"checked";?>/>
                            No
  <? }?>
                          </div></td>
                        <td width="10%" bgcolor="#FFFF00" class="text_mediano">
                            <div align="right">
                              <? if($res[13]>3 || $idA=="3"){?>
                              Entrenamiento
                              <? }?>
                                </div></td>
                        <td width="15%" bgcolor="#FFFF00" class="text_mediano"><div align="left">
                            <? if($res[13]>3 || $idA=="3"){?>
                            <input name="v1_entre" type="radio" value="1"<? if($v_entre[0]=="1") echo"checked";?> />
                            Si
  <input name="v1_entre" type="radio" value="0"<? if($v_entre[0]=="0") echo"checked";?> />
                            No
                            <? }?>
                        </div>                          </td>
                      </tr>

                    </table></td>
                    </tr>
					<tr>
                    <td colspan="4" valign="top" bgcolor="#00475c" class="text_mediano_blanco">2.- EFICIENCIA <span class="texto_chico style19">(Validar contra registros de eficiencia)</span><br>                      
                      <div align="center"></div></td>
                    </tr>
                  
                  <tr>
                    <td valign="top" class="text_mediano_blanco">&nbsp;</td>
                    <td colspan="3" rowspan="2" valign="top" bgcolor="#E2E2E2" class="texto_tareas"><p><span class="texto_tareas"><strong><? echo"$texto1[1]";?></strong></span></p>
                      <p><span class="text_mediano"><span class="texto_tareas"><? echo"$texto2[1]";?></span></span></p></td>
                    </tr>
                  <tr>
                    <td valign="top" class="text_mediano_blanco">&nbsp;</td>
                    </tr>
                  <tr>
                    <td width="1%" valign="top" class="text_mediano_blanco">&nbsp;</td>
                    <td width="22%" valign="top" bgcolor="#FFFFFF" class="texto_tareas"><p>Comentarios o ejemplos que soportan esta calificación:</p>
                      <p align="center"></p></td>
                    <td colspan="2" bgcolor="#FFFFFF"><div align="center">
                      <textarea name="coment2" cols="60" rows="3" id="coment2"><?echo"$coment[1]";?></textarea>
                    </div></td>
                    </tr>
                  <tr>
                    <td valign="top" class="text_mediano_blanco">&nbsp;</td>
                    <td colspan="3" valign="top" bgcolor="#FFFFFF" class="texto_tareas"><table width="100%" border="0" cellpadding="0" cellspacing="3" bgcolor="#FFFFFF">
                      <tr>
                        <td width="28%" height="30" bgcolor="#666666" class="text_mediano"><div align="right" class="text_mediano_blanco">
                          <div align="center">Validación</div>
                        </div></td>
                        <td width="9%" bgcolor="#FFFF00" class="text_mediano"><div align="right">Supervisor</div></td>
                        <td width="12%" bgcolor="#FFFF00" class="text_mediano"><div align="left">
                          <input name="v2_sup" type="radio" value="1"<? if($v_sup[1]=="1") echo"checked";?> />
Si
<input name="v2_sup" type="radio" value="0" <? if($v_sup[1]=="0") echo"checked";?>/>
No</div></td>
                        <td width="11%" bgcolor="#FFFF00" class="text_mediano">
                            <div align="right">
                              <? if($res[13]>3 || $idA=="2"){?>
Calidad
<? }?>
                            </div></td>
                        <td width="15%" bgcolor="#FFFF00" class="text_mediano"><div align="left">
                          <? if($res[13]>3 || $idA=="2"){?>
                          N/A
<? }?>
                        </div></td>
                        <td width="10%" bgcolor="#FFFF00" class="text_mediano">
                            <div align="right">
                              <? if($res[13]>3 || $idA=="3"){?>
                              Entrenamiento
                              <? }?>
</div></td>
                        <td width="15%" bgcolor="#FFFF00" class="text_mediano"><div align="left">
                          <? if($res[13]>3 || $idA=="3"){?>
                          <input name="v2_entre" type="radio" value="1" <? if($v_entre[1]=="1") echo"checked";?>/>
Si
<input name="v2_entre" type="radio" value="0" <? if($v_entre[1]=="0") echo"checked";?>/>
No
<? }?>
                        </div>                          </td>
                      </tr>

                    </table></td>
                    </tr>
					<tr>
                    <td colspan="4" valign="top" bgcolor="#00475c" class="text_mediano_blanco">3.-CALIDAD- AUTO INSPECCION<span class="text_mediano"> <span class="texto_chico style19">(Validar contra registros de calidad)</span></span><br>                      <div align="center"></div></td>
                    </tr>
                  
                  <tr>
                    <td valign="top" class="text_mediano_blanco">&nbsp;</td>
                    <td colspan="3" rowspan="2" valign="top" bgcolor="#E2E2E2" class="texto_tareas"><p><span class="texto_tareas"><strong><? echo"$texto1[2]";?></strong></span></p>
                      <p><span class="text_mediano"><span class="texto_tareas"><? echo"$texto2[2]";?></span></span></p></td>
                    </tr>
                  <tr>
                    <td valign="top" class="text_mediano_blanco">&nbsp;</td>
                    </tr>
                  <tr>
                    <td width="1%" valign="top" class="text_mediano_blanco">&nbsp;</td>
                    <td width="22%" valign="top" bgcolor="#FFFFFF" class="texto_tareas"><p>Comentarios o ejemplos que soportan esta calificación:</p>
                      <p align="center"></p></td>
                    <td colspan="2" bgcolor="#FFFFFF"><div align="center">
                      <textarea name="coment3" cols="60" rows="3" id="coment3"><?echo"$coment[2]";?></textarea>
                    </div></td>
                    </tr>
                  <tr>
                    <td valign="top" class="text_mediano_blanco">&nbsp;</td>
                    <td colspan="3" valign="top" bgcolor="#FFFFFF" class="texto_tareas"><table width="100%" border="0" cellpadding="0" cellspacing="3" bgcolor="#FFFFFF">
                      <tr>
                        <td width="28%" height="30" bgcolor="#666666" class="text_mediano"><div align="right" class="text_mediano_blanco">
                          <div align="center">Validación</div>
                        </div></td>
                        <td width="9%" bgcolor="#FFFF00" class="text_mediano"><div align="right">Supervisor</div></td>
                        <td width="12%" bgcolor="#FFFF00" class="text_mediano"><div align="center">N/A</div></td>
                        <td width="11%" bgcolor="#FFFF00" class="text_mediano">
                            <div align="right">
                              <? if($res[13]>3 || $idA=="2"){?>
Calidad
<? }?>
</div></td>
                        <td width="15%" bgcolor="#FFFF00" class="text_mediano"><div align="left">
                          <? if($res[13]>3 || $idA=="2"){?>
                          <input name="v3_cal" type="radio" value="1" <? if($v_cal[2]=="1") echo"checked";?> />
Si
<input name="v3_cal" type="radio" value="0" <? if($v_cal[2]=="0") echo"checked";?> />
No
<? }?>
</div></td>
                        <td width="10%" bgcolor="#FFFF00" class="text_mediano">
                            <div align="right">
                              <? if($res[13]>3 || $idA=="3"){?>
                              Entrenamiento
                              <? }?>
</div></td>
                        <td width="15%" bgcolor="#FFFF00" class="text_mediano"><div align="left">
                          <? if($res[13]>3 || $idA=="3"){?>
                          N/A
<? }?>
                        </div>                          </td>
                      </tr>

                    </table></td>
                    </tr>
					<tr>
                    <td colspan="4" valign="top" bgcolor="#00475c" class="text_mediano_blanco">4.-PREVENCIÓN DE PROBLEMAS DE PRODUCCION <br>                      <div align="center"></div></td>
                    </tr>
                  
                  <tr>
                    <td valign="top" class="text_mediano_blanco">&nbsp;</td>
                    <td colspan="3" rowspan="2" valign="top" bgcolor="#E2E2E2" class="texto_tareas"><p><span class="texto_tareas"><strong><? echo"$texto1[3]";?></strong></span></p>
                      <p><span class="text_mediano"><span class="texto_tareas"><? echo"$texto2[3]";?></span></span></p></td>
                    </tr>
                  <tr>
                    <td valign="top" class="text_mediano_blanco">&nbsp;</td>
                    </tr>
                  <tr>
                    <td width="1%" valign="top" class="text_mediano_blanco">&nbsp;</td>
                    <td width="22%" valign="top" bgcolor="#FFFFFF" class="texto_tareas"><p>Comentarios o ejemplos que soportan esta calificación:</p>
                      <p align="center"></p></td>
                    <td colspan="2" bgcolor="#FFFFFF"><div align="center">
                      <textarea name="coment4" cols="60" rows="3" id="coment4"><?echo"$coment[3]";?></textarea>
                    </div></td>
                    </tr>
                  <tr>
                    <td valign="top" class="text_mediano_blanco">&nbsp;</td>
                    <td colspan="3" valign="top" bgcolor="#FFFFFF" class="texto_tareas"><table width="100%" border="0" cellpadding="0" cellspacing="3" bgcolor="#FFFFFF">
                      <tr>
                        <td width="28%" height="30" bgcolor="#666666" class="text_mediano"><div align="right" class="text_mediano_blanco">
                          <div align="center">Validación</div>
                        </div></td>
                        <td width="9%" bgcolor="#FFFF00" class="text_mediano"><div align="right">Supervisor</div></td>
                        <td width="12%" bgcolor="#FFFF00" class="text_mediano"><div align="left">
                          <input name="v4_sup" type="radio" value="1"  <? if($v_sup[3]=="1") echo"checked";?>/>
Si
<input name="v4_sup" type="radio" value="0"  <? if($v_sup[3]=="0") echo"checked";?>/>
No</div></td>
                        <td width="11%" bgcolor="#FFFF00" class="text_mediano">
                            <div align="right">
                              <? if($res[13]>3 || $idA=="2"){?>
Calidad
<? }?>
</div></td>
                        <td width="15%" bgcolor="#FFFF00" class="text_mediano"><div align="left">
                          <? if($res[13]>3 || $idA=="2"){?>
                          <input name="v4_cal" type="radio" value="1"  <? if($v_cal[3]=="1") echo"checked";?>/>
Si
<input name="v4_cal" type="radio" value="0"  <? if($v_cal[3]=="0") echo"checked";?>/>
No
<? }?>
                        </div></td>
                        <td width="10%" bgcolor="#FFFF00" class="text_mediano">
                            <div align="right">
                              <? if($res[13]>3 || $idA=="3"){?>
                              Entrenamiento
                              <? }?>
</div></td>
                        <td width="15%" bgcolor="#FFFF00" class="text_mediano"><div align="left">
                          <? if($res[13]>3 || $idA=="3"){?>
                          <input name="v4_entre" type="radio" value="1"  <? if($v_entre[3]=="1") echo"checked";?>/>
Si
<input name="v4_entre" type="radio" value="0"  <? if($v_entre[3]=="0") echo"checked";?>/>
No
<? }?>
                        </div>                          </td>
                      </tr>

                    </table></td>
                    </tr>
					<tr>
                    <td colspan="4" valign="top" bgcolor="#00475c" class="text_mediano_blanco">5.- SEGURIDAD<br>                      <div align="center"></div></td>
                    </tr>
                  
                  <tr>
                    <td valign="top" class="text_mediano_blanco">&nbsp;</td>
                    <td colspan="3" rowspan="2" valign="top" bgcolor="#E2E2E2" class="texto_tareas"><p><span class="texto_tareas"><strong><? echo"$texto1[4]";?></strong></span></p>
                      <p><span class="text_mediano"><span class="texto_tareas"><? echo"$texto2[4]";?></span></span></p></td>
                    </tr>
                  <tr>
                    <td valign="top" class="text_mediano_blanco">&nbsp;</td>
                    </tr>
                  <tr>
                    <td width="1%" valign="top" class="text_mediano_blanco">&nbsp;</td>
                    <td width="22%" valign="top" bgcolor="#FFFFFF" class="texto_tareas"><p>Comentarios o ejemplos que soportan esta calificación:</p>
                      <p align="center"></p></td>
                    <td colspan="2" bgcolor="#FFFFFF"><div align="center">
                      <textarea name="coment5" cols="60" rows="3" id="coment5"><?echo"$coment[4]";?></textarea>
                    </div></td>
                    </tr>
                  <tr>
                    <td valign="top" class="text_mediano_blanco">&nbsp;</td>
                    <td colspan="3" valign="top" bgcolor="#FFFFFF" class="texto_tareas"><table width="100%" border="0" cellpadding="0" cellspacing="3" bgcolor="#FFFFFF">
                      <tr>
                        <td width="28%" height="30" bgcolor="#666666" class="text_mediano"><div align="right" class="text_mediano_blanco">
                          <div align="center">Validación</div>
                        </div></td>
                        <td width="9%" bgcolor="#FFFF00" class="text_mediano"><div align="right">Supervisor</div></td>
                        <td width="12%" bgcolor="#FFFF00" class="text_mediano"><div align="left">
                          <input name="v5_sup" type="radio" value="1"  <? if($v_sup[4]=="1") echo"checked";?>/>
Si
<input name="v5_sup" type="radio" value="0"  <? if($v_sup[4]=="0") echo"checked";?>/>
No</div></td>
                        <td width="11%" bgcolor="#FFFF00" class="text_mediano">
                            <div align="right">
                              <? if($res[13]>3 || $idA=="2"){?>
Calidad
<? }?>
</div></td>
                        <td width="15%" bgcolor="#FFFF00" class="text_mediano"><div align="left">
                          <? if($res[13]>3 || $idA=="2"){?>
 N/A                          <? }?>
                        </div></td>
                        <td width="10%" bgcolor="#FFFF00" class="text_mediano">
                            <div align="right">
                              <? if($res[13]>3 || $idA=="3"){?>
                              Entrenamiento
                              <? }?>
</div></td>
                        <td width="15%" bgcolor="#FFFF00" class="text_mediano"><div align="left">
                          <? if($res[13]>3 || $idA=="3"){?>
                          <input name="v5_entre" type="radio" value="1"  <? if($v_entre[4]=="1") echo"checked";?>/>
Si
<input name="v5_entre" type="radio" value="0" <? if($v_entre[4]=="0") echo"checked";?> />
No
<? }?>
</div>                          </td>
                      </tr>

                    </table></td>
                    </tr>
					<tr>
                    <td colspan="4" valign="top" bgcolor="#00475c" class="text_mediano_blanco">6.-TRABAJO EN EQUIPO <br>                      <div align="center"></div></td>
                    </tr>
                  
                  <tr>
                    <td valign="top" class="text_mediano_blanco">&nbsp;</td>
                    <td colspan="3" rowspan="2" valign="top" bgcolor="#E2E2E2" class="texto_tareas"><p><span class="texto_tareas"><strong><? echo"$texto1[5]";?></strong></span></p>
                      <p><span class="text_mediano"><span class="texto_tareas"><? echo"$texto2[5]";?></span></span></p></td>
                    </tr>
                  <tr>
                    <td valign="top" class="text_mediano_blanco">&nbsp;</td>
                    </tr>
                  <tr>
                    <td width="1%" valign="top" class="text_mediano_blanco">&nbsp;</td>
                    <td width="22%" valign="top" bgcolor="#FFFFFF" class="texto_tareas"><p>Comentarios o ejemplos que soportan esta calificación:</p>
                      <p align="center"></p></td>
                    <td colspan="2" bgcolor="#FFFFFF"><div align="center">
                      <textarea name="coment6" cols="60" rows="3" id="coment6"><?echo"$coment[5]";?></textarea>
                    </div></td>
                    </tr>
                  <tr>
                    <td valign="top" class="text_mediano_blanco">&nbsp;</td>
                    <td colspan="3" valign="top" bgcolor="#FFFFFF" class="texto_tareas"><table width="100%" border="0" cellpadding="0" cellspacing="3" bgcolor="#FFFFFF">
                      <tr>
                        <td width="28%" height="30" bgcolor="#666666" class="text_mediano"><div align="right" class="text_mediano_blanco">
                          <div align="center">Validación</div>
                        </div></td>
                        <td width="9%" bgcolor="#FFFF00" class="text_mediano"><div align="right">Supervisor</div></td>
                        <td width="12%" bgcolor="#FFFF00" class="text_mediano"><div align="left">
                          <input name="v6_sup" type="radio" value="1"  <? if($v_sup[5]=="1") echo"checked";?>/>
Si
<input name="v6_sup" type="radio" value="0" <? if($v_sup[5]=="0") echo"checked";?> />
No</div></td>
                        <td width="11%" bgcolor="#FFFF00" class="text_mediano">
                            <div align="right">
                              <? if($res[13]>3 || $idA=="2"){?>
Calidad
<? }?>
</div></td>
                        <td width="15%" bgcolor="#FFFF00" class="text_mediano"><div align="left">
                          <? if($res[13]>3 || $idA=="2"){?>
                          <input name="v6_cal" type="radio" value="1"  <? if($v_cal[5]=="1") echo"checked";?>/>
Si
<input name="v6_cal" type="radio" value="0"  <? if($v_cal[5]=="0") echo"checked";?>/>
No
<? }?>
</div></td>
                        <td width="10%" bgcolor="#FFFF00" class="text_mediano">
                            <div align="right">
                              <? if($res[13]>3 || $idA=="3"){?>
                              Entrenamiento
                              <? }?>
</div></td>
                        <td width="15%" bgcolor="#FFFF00" class="text_mediano"><div align="left">
                          <? if($res[13]>3 || $idA=="3"){?>
                          <input name="v6_entre" type="radio" value="1"  <? if($v_entre[5]=="1") echo"checked";?>/>
Si
<input name="v6_entre" type="radio" value="0"  <? if($v_entre[5]=="0") echo"checked";?>/>
No
<? }?>
</div>                          </td>
                      </tr>

                    </table></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><table width="100%" border="0" cellspacing="3" cellpadding="0">
                  <tr>
                    <td height="40" colspan="2" valign="bottom" bgcolor="#FFFFFF" class="text_grande">3.- Autorizaciones <br />
                      <span class="olvido">Se requiere acreditar las Competencias 1 al 5 para que proceda el cambio de nivel y el cambio de salario.</span></td>
                  </tr>
                  <tr>
                    <td width="15%"><table width="100%" border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td width="29%" bgcolor="#FFFFFF" class="text_mediano">Supervisor de Producción </td>
                        </tr>
                      <tr>
                        <td><div align="center">
                              <textarea name="coment_s" cols="50" rows="5" id="coment_s"><? echo"$resE[6]";?></textarea>
                                                </div></td>
                        </tr>
                      

                    </table></td>
                    <td width="16%" valign="top"><table width="100%" border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td width="29%" bgcolor="#FFFFFF" class="text_mediano"><? if($res[13]>2){?><? echo"$resE[4]";?> (<? echo"$resE[7]";?>) <? }?></td>
                      </tr>
                      <tr>
                        <td><input type="radio" name="aprovado_s" id="radio" value="1" <? if($resE[8]==1)echo"checked";?>/>
                          Aprobado
                          <input type="radio" name="aprovado_s" id="radio" value="0" <? if($resE[8]==0)echo"checked";?> />
                          No Aprobado</td>
                      </tr>
                      <tr>
                        <td>
                          <div align="left">
                            <? if($res[13]=="2" && $idA=="4"){?>
                            <input name="guardar_s" type="submit" id="enviar" value="Guardar" />
                            <input name="firmar_s" type="submit" id="enviar2" value="Firmar" onclick="return validaGuardarFirmar_s();"/>
                            <? }?>
                          </div></td>
                      </tr>
                    </table></td>
                  </tr>
                  <? if($res[13]>=3 || $idA=="2" ){?><tr>
                    <td><table width="100%" border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td width="29%" bgcolor="#FFFFFF" class="text_mediano">Supervisor de Calidad </td>
                      </tr>
                      <tr>
                        <td><div align="center">
                            <textarea name="coment_c" cols="50" rows="5" id="coment_c"><? echo"$resE[9]";?></textarea>
                        </div></td>
                      </tr>
                    </table></td>
                    <td valign="top"><table width="100%" border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td width="29%" bgcolor="#FFFFFF" class="text_mediano"><? if($res[25]!=""){?>                          <? echo"$resE[15]";?> (<? echo"$resE[10]";?>)
                          <? }?></td>
                      </tr>
                      <tr>
                        <td><input type="radio" name="aprovado_c" id="radio3" value="1" <? if($resE[11]==1)echo"checked";?>/>
                          Aprobado
                          <input type="radio" name="aprovado_c" id="radio4" value="0" <? if($resE[11]==0)echo"checked";?>/>
                          No Aprobado</td>
                      </tr>
                      <tr>
                        <td>
                          <div align="left">
                            <? if($res[13]=="3" && $idA=="2" && $res[25]==null){?>
                            <input name="guardar_c" type="submit" id="guardar_c" value="Guardar" />
                            <input name="firmar_c" type="submit" id="firmar_c" value="Firmar" />
                            <? }?>
                          </div></td>
                      </tr>
                    </table></td>
                  </tr><? }?>
                  <? if($res[13]>=3 || $idA=="3"){?><tr>
                    <td><table width="100%" border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td width="29%" bgcolor="#FFFFFF" class="text_mediano">Supervisor de Entrenamiento </td>
                      </tr>
                      <tr>
                        <td><div align="center">
                          <textarea name="coment_e" cols="50" rows="5" id="coment_e"><? echo"$resE[12]";?></textarea>
                        </div></td>
                      </tr>
                    </table></td>
                    <td valign="top"><table width="100%" border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td width="29%" bgcolor="#FFFFFF" class="text_mediano"><? if($res[26]!=""){?>
                          <? echo"$resE[16]";?> (<? echo"$resE[13]";?>)
                          <? }?></td>
                      </tr>
                      <tr>
                        <td><input name="aprovado_e" type="radio" id="aprovado_e" value="1"  <? if($resE[14]==1)echo"checked";?>/>
                          Aprobado
                          <input type="radio" name="aprovado_e" id="aprovado_e" value="0"  <? if($resE[14]==0)echo"checked";?>/>
                          No Aprobado</td>
                      </tr>
                      <tr>
                        <td>
                          <div align="left">
                            <? if($res[13]=="3" && $idA=="3" && $res[26]==null){?>
                            <input name="guardar_e" type="submit" id="guardar_e" value="Guardar" />
                            <input name="firmar_e" type="submit" id="firmar_e" value="Firmar" />
                            <? }?>
                          </div></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td colspan="2"><table width="100%" border="0" cellspacing="3" cellpadding="0">
                      <tr>
                        <td>
						<? if($res[13]>=3 && $resE[7]!="" && $resE[10]!="" && $resE[13]!=""){?>
						<table width="100%" border="0" cellspacing="3" cellpadding="0">
                          <tr>
                            <td width="29%" bgcolor="#FFFFFF" class="text_mediano">HRBP</td>
                          </tr>
                          <tr>
                            <td><div align="center">
                              <table width="100%" border="0" cellspacing="3" cellpadding="0">
                                <tr>
                                  <td width="29%" bgcolor="#FFFFFF" class="text_mediano"><? if($resE[19]!=""){?>
                                      <? echo"$resE[17]";?> (<? echo"$resE[19]";?>)
                                    <? }?></td>
                                </tr>
                                <tr>
                                  <td><div align="left">
                                    <input type="radio" name="aprovado_rh" id="radio2" value="1"  <? if($resE[20]==1)echo"checked";?>/>
                                    Aprobado
                                    <input type="radio" name="aprovado_rh" id="radio7" value="0"  <? if($resE[20]==0)echo"checked";?>/>
                                    No Aprobado</div></td>
                                </tr>
                                <tr>
                                  <td><div align="left">
                                    <? if($resE[19]==null && $idA=="6"){?>
                                    <input name="firmar_rh" type="submit" id="firmar_rh" value="Firmar" />
                                    <? }?>
</div></td>
                                </tr>
                              </table>
                            </div></td>
                          </tr>
                        </table>
						<? }?>
						</td>
                        <td>
						<? if($res[13]>=3 && $resE[7]!="" && $resE[10]!="" && $resE[13]!="" && $resE[19]!=""){?>
						<table width="100%" border="0" cellspacing="3" cellpadding="0">
                          <tr>
                            <td width="29%" bgcolor="#FFFFFF" class="text_mediano">Value Stream Manager </td>
                          </tr>
                          <tr>
                            <td><table width="100%" border="0" cellspacing="3" cellpadding="0">
                              <tr>
                                <td width="29%" bgcolor="#FFFFFF" class="text_mediano"><? if($resE[21]!=""){?>
                                    <? echo"$resE[18]";?> (<? echo"$resE[21]";?>)
                                  <? }?></td>
                              </tr>
                              <tr>
                                <td><input type="radio" name="aprovado_v" id="radio8" value="1"  <? if($resE[22]==1)echo"checked";?>/>
                                  Aprobado
                                  <input type="radio" name="aprovado_v" id="radio9" value="0"  <? if($resE[22]==0)echo"checked";?>/>
                                  No Aprobado</td>
                              </tr>
                              <tr>
                                <td><div align="left">
                                  <? if($resE[21]==null && $idA=="5"){?>
                                  <input name="firmar_v" type="submit" id="firmar_v" value="Firmar" />
                                  <? }?>
</div></td>
                              </tr>
                            </table></td>
                          </tr>
                        </table>
						<? }?>
						</td>
                      </tr>
                    </table></td>
                    </tr>
                  <? }?>
                </table></td>
              </tr><? }?>
              <tr>
                <td><div align="center">
                  <p>&nbsp;                    </p>
                  <p>
				  <? if($res[13]=="1" && $idA=="3"){?>
                    <input name="enviar" type="submit" id="guardar" value="Firmar" onclick="return validaEnvio();"/>
                    <? }?>
                  </p>
                </div></td>
              </tr>
              
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="images/spacer.gif" width="10" height="50" /></td>
      </tr>
      <tr>
        <td><table width="350" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="145"><a href="cambia_pass.php?id=<?echo"$idU";?>" class="iframe2" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image21','','images/b_cambio_r.png',1)"><img src="images/b_cambio.png" name="Image21" width="145" height="23" border="0" id="Image21" /></a></td>
            <td><img src="images/spacer.gif" width="16" height="20" /></td>
            <td width="114"><? if($_SESSION["idA"]=="1"){?>
			<a href="admin.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image24','','images/b_administracion_r.png',1)"><img src="images/b_administracion.png" name="Image24" width="114" height="23" border="0" id="Image24" /></a>
			<? }?></td>
            <td><img src="images/spacer.gif" width="17" height="20" /></td>
            <td><a href="logout.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image25','','images/b_log_out_r.png',1)"><img src="images/b_log_out.png" name="Image25" width="71" height="23" border="0" id="Image25" /></a></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<script>
function validaEnvio()
{
	if(document.form1.faltas_rh[0].checked==false && document.form1.faltas_rh[1].checked==false)
	{
		alert("Seleccione la aprobacion");
		document.form1.faltas_rh[0].focus();
		return false;
	}else
	{
		if(document.form1.faltas_rh[1].checked==true && document.form1.coment.value=="")
		{
			alert("Escriba la razon porta le no fue aprobada");
			document.form1.coment.focus();
			return false;
		}else
		{
		
		}
	}
}
function validaGuardarFirmar_s()
{
	if(document.form1.efi_sup[0].checked==false && document.form1.efi_sup[1].checked==false)
	{
		alert("Seleccione la aprobacion de eficiencia");
		document.form1.efi_sup[0].focus();
		return false;
	}else
	{
		for (var i=0;i<<?echo"$cuantos";?>;i++)
		{
			if((document.form1.ncr_meta[i].value=="0" || document.form1.ncr_meta[0].value=="") )
			{
				alert("Capture Meta de NCR");
				document.form1.ncr_meta[i].focus();
				return false;
			}else
			{
				if((document.form1.ncr_resul[i].value=="") )
				{
					alert("Capture Resultado de NCR");
					document.form1.ncr_resul[i].focus();
					return false;
				}else
				{
					if((document.form1.scrap_meta[i].value=="0" || document.form1.scrap_meta[i].value=="") )
					{
						alert("Capture Meta de SCRAP");
						document.form1.scrap_meta[i].focus();
						return false;
					}else
					{
						if((document.form1.scrap_resul[i].value=="") )
						{
							alert("Capture Resultado de SCRAP");
							document.form1.scrap_resul[i].focus();
							return false;
						}else
						{
							if((document.form1.snag_meta[i].value=="0" || document.form1.snag_meta[i].value==""))
							{
								alert("Capture Meta de SNAG");
								document.form1.snag_meta[i].focus();
								return false;
							}else
							{
								if((document.form1.snag_resul[i].value==""))
								{
									alert("Capture Resultado de SNAG");
									document.form1.snag_resul[i].focus();
									return false;
								}else
								{
								
								}
							}
						}
					}	
				}
			}
		}
		
			if((document.form1.eficiencia_meta.value=="0" || document.form1.eficiencia_meta.value=="") )
			{
				alert("Capture Meta de Eficiencia");
				document.form1.eficiencia_meta.focus();
				return false;
			}else
			{
				if((document.form1.eficiencia1.value=="") )
				{
					alert("Capture Resultado de Eficiencia del mes 1");
					document.form1.eficiencia1.focus();
					return false;
				}else
				{
					if((document.form1.eficiencia2.value=="") )
					{
						alert("Capture Resultado de Eficiencia del mes 2");
						document.form1.eficiencia2.focus();
						return false;
					}else
					{
						if((document.form1.eficiencia3.value=="") )
						{
							alert("Capture Resultado de Eficiencia del mes 3");
							document.form1.eficiencia3.focus();
							return false;
						}else
						{
							if(<?echo"$cuantos";?>>3)
							if((document.form1.eficiencia4.value=="") )
							{
								alert("Capture Resultado de Eficiencia del mes 4");
								document.form1.eficiencia4.focus();
								return false;
							}else
							{
								if((document.form1.eficiencia5.value=="") )
								{
									alert("Capture Resultado de Eficiencia del mes 5");
									document.form1.eficiencia5.focus();
									return false;
								}else
								{
									if((document.form1.eficiencia6.value=="") )
									{
										alert("Capture Resultado de Eficiencia del mes 6");
										document.form1.eficiencia6.focus();
										return false;
									}else
									{
										if(<?echo"$cuantos";?>>6)
										if((document.form1.eficiencia7.value=="") )
										{
											alert("Capture Resultado de Eficiencia del mes 7");
											document.form1.eficiencia7.focus();
											return false;
										}else
										{
											if((document.form1.eficiencia8.value=="") )
											{
												alert("Capture Resultado de Eficiencia del mes 8");
												document.form1.eficiencia8.focus();
												return false;
											}else
											{
												if((document.form1.eficiencia9.value=="") )
												{
													alert("Capture Resultado de Eficiencia del mes 9");
													document.form1.eficiencia9.focus();
													return false;
												}else
												{
													if((document.form1.eficiencia10.value=="") )
													{
														alert("Capture Resultado de Eficiencia del mes 10");
														document.form1.eficiencia10.focus();
														return false;
													}else
													{
														if((document.form1.eficiencia11.value=="") )
														{
															alert("Capture Resultado de Eficiencia del mes 11");
															document.form1.eficiencia11.focus();
															return false;
														}else
														{
															if((document.form1.eficiencia12.value=="") )
															{
																alert("Capture Resultado de Eficiencia del mes 12");
																document.form1.eficiencia12.focus();
																return false;
															}else
															{
															
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		
	}
}

</script>
</form>
</body>
</html>
