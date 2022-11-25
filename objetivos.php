<?
session_start();

include "checar_sesion_admin.php";
include "coneccion_i.php";
$idU=$_SESSION['idU'];
$verobjetivos=$_POST["verobjetivos"];
$plan="";
$estatus="";
$firma1e="";
$firma2e="";
$firma1j="";
$firma2j="";
$impacto="";

	$consulta  = "SELECT id, id_jefe from usuarios where id=$verobjetivos";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta  ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_row($resultado);
		$nombreEmpleado=$res[0];
		$jefe=$res[1];
		
		if($idU==$verobjetivos){
			$tipo_usuario="User";
		}
		else{
			if($res[1]==$idU)
				$tipo_usuario="Jefe";
			else
				$tipo_usuario="Empleado";
		}
		
	}



$debug = FALSE;
if($debug)
    $verobjetivos = $_REQUEST['verobjetivos'];

if(isset($_POST['desbloquearMidYearReview'])){
    $query = "UPDATE planes SET firmaUser_midYearReview = NULL, firmaJefe_midYearReview = NULL, firma_e_i='0000-00-00', firma_j_i='0000-00-00', estatus='0'
        WHERE id_empleado = $verobjetivos AND revision = '{$_POST["revision"]}';";
        
    $result = mysqli_query($enlace,$query) or print('No se actualizado tu checkpoint');
}
if(isset($_POST['desfirmarMidYearReview'])){
    $query = "UPDATE planes SET firmaUser_midYearReview = NULL, firmaJefe_midYearReview = NULL, estatus=2
        WHERE id_empleado = $verobjetivos AND revision = '{$_POST["revision"]}';";
        
    $result = mysqli_query($enlace,$query) or print('No se actualizado tu checkpoint');
}

if(isset($_POST['desbloquearCierre'])){
    $query = "UPDATE planes SET firma_e_i='0000-00-00', firma_j_i='0000-00-00', firma_e_f = '0000-00-00', firma_j_f = NULL, firma_e_i='0000-00-00' , estatus='0'
        WHERE id_empleado = $verobjetivos AND revision = '{$_POST["revision"]}';";
        
    $result = mysqli_query($enlace,$query) or print('No se actualizado tu checkpoint');
}
if(isset($_POST['desfirmarCierre'])){
    $query = "UPDATE planes SET firma_e_f = '0000-00-00', firma_j_f='0000-00-00', estatus=4
        WHERE id_empleado = $verobjetivos AND revision = '{$_POST["revision"]}';";
        
    $result = mysqli_query($enlace,$query) or print('No se actualizado tu checkpoint');
}
//guarda cuando esta desbloqueado hasta planeacion pero en etapa de check point
if( isset($_POST['guardarMidYearReviewDes']) || isset($_POST['firmarMidYearReviewDes'])){
    
    $revision=$_POST["revision"];
	$plan=$_POST["plan"];
	$objetivo=$_POST["objetivo"];
	$descripcion=$_POST["descripcion"];
	$impacto=$_POST["impacto"];
	
	
	if($plan=="" || $plan==null)
	{
		
		$consulta  = "insert into planes(id_empleado, revision, estatus) value($verobjetivos, $revision, 0)";
		$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );
		$num=1;
		for($i=0 ; $i<6 ; $i++)
		{
			$inicio=$_POST["inicio".$num];
			$fin=$_POST["fin".$num];
			$fechat = explode('-', $inicio);
			$finicio="$fechat[2]-$fechat[1]-$fechat[0]";
			$fechat = explode('-', $fin);
			$ffin="$fechat[2]-$fechat[1]-$fechat[0]";
			$obj=addslashes($objetivo[$i]);
			$des=addslashes($descripcion[$i]);
			$imp=addslashes($impacto[$i]);
			$consulta  = "insert into objetivos(id_empleado, numero, nombre, descripcion, impacto, f_inicio, f_fin, revision) value($verobjetivos, $num, '$obj', '$des', '$imp', '$finicio', '$ffin', $revision)";
			$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: $consulta". mysqli_error($enlace) );
			$num++;
		}
	}else
	{
		//
		$num=1;
		for($i=0 ; $i<6 ; $i++)
		{
			$inicio=$_POST["inicio".$num];
			$fin=$_POST["fin".$num];
			$fechat = explode('-', $inicio);
			$finicio="$fechat[2]-$fechat[1]-$fechat[0]";
			$fechat = explode('-', $fin);
			$ffin="$fechat[2]-$fechat[1]-$fechat[0]";
			$obj=addslashes($objetivo[$i]);
			$des=addslashes($descripcion[$i]);
			$imp=addslashes($impacto[$i]);
			$consulta  = "update objetivos set  nombre='$obj', descripcion='$des', impacto='$imp', f_inicio='$finicio', f_fin='$ffin' 
                            where id_empleado=$verobjetivos and numero=$num and revision=$revision";
			//echo"$consulta <br>";
			$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: $consulta". mysqli_error($enlace) );
			$num++;
		}
	}
	
	if(isset($_POST['comentUser_midYearReview']))
        $tipo = 'User';
    else $tipo = 'Jefe';
    
    if($tipo=='Jefe'){
	for($i=1;$i<=6; $i++){
        $query = "UPDATE objetivos SET coment{$tipo}_midYearReview='".mysqli_real_escape_string($enlace,$_POST['coment'.$tipo.'_midYearReview'][$i-1])."',
            midCheckpoint = '{$_POST["midCheckpoint$i"]}' WHERE id_empleado = $verobjetivos AND numero = $i AND revision = '{$_POST["revision"]}';";
        $result = mysqli_query($enlace,$query) or print(' No se actualizado tu checkpoint');
    }
	}else{
	for($i=1;$i<=6; $i++){
        $query = "UPDATE objetivos SET coment{$tipo}_midYearReview='".mysqli_real_escape_string($enlace,$_POST['coment'.$tipo.'_midYearReview'][$i-1])."',
            midCheckpoint = '{$_POST["midCheckpoint_e$i"]}', midCheckpoint_e = '{$_POST["midCheckpoint_e$i"]}' WHERE id_empleado = $verobjetivos AND numero = $i AND revision = '{$_POST["revision"]}';";
        $result = mysqli_query($enlace,$query) or print(' No se actualizado tu checkpoint');
    }
	}
}
if( isset($_POST['guardarMidYearReview'])){
    
    if(isset($_POST['comentUser_midYearReview']))
	{
        $tipo = 'User';
    for($i=1;$i<=6; $i++){
        $query = "UPDATE objetivos SET coment{$tipo}_midYearReview='".mysqli_real_escape_string($enlace,$_POST['coment'.$tipo.'_midYearReview'][$i-1])."',
            midCheckpoint_e = '{$_POST["midCheckpoint_e$i"]}' WHERE id_empleado = $verobjetivos AND numero = $i AND revision = '{$_POST["revision"]}';";
        //echo"1 $query";
		$result = mysqli_query($enlace,$query) or print(' No se actualizado tu checkpoint');
    }
	}
	else
	{
	 $tipo = 'Jefe';
    for($i=1;$i<=6; $i++){
        $query = "UPDATE objetivos SET coment{$tipo}_midYearReview='".mysqli_real_escape_string($enlace,$_POST['coment'.$tipo.'_midYearReview'][$i-1])."',
            midCheckpoint = '{$_POST["midCheckpoint$i"]}' WHERE id_empleado = $verobjetivos AND numero = $i AND revision = '{$_POST["revision"]}';";
        //echo"2 $query";
		$result = mysqli_query($enlace,$query) or print(' No se actualizado tu checkpoint');
    }
	}
    
}
if( isset($_POST['guardarFinal']) || isset($_POST['firmarFinal']) ||  isset($_POST['guardarFinalDes']) || isset($_POST['firmarFinalDes'])){
    
    if(isset($_POST['comentario_e_f']))
        $tipo = 'e';
    else $tipo = 'j';
    for($i=1;$i<=6; $i++){
			$query = "UPDATE objetivos SET comentario_{$tipo}_f='".mysqli_real_escape_string($enlace,$_POST['comentario_'.$tipo.'_f'][$i-1])."', revision_final='{$_POST["cFinal$i"]}'
				 WHERE id_empleado = $verobjetivos AND numero = $i AND revision = '{$_POST["revision"]}';";
		   // echo"$query ";
			$result = mysqli_query($enlace,$query) or print(' No se actualizado tu revision final');
		}
    
	if($tipo=="j")
	{
		$query = "UPDATE planes SET resultado_obj='{$_POST['rFinal']}', clasificacion = '{$_POST['clasFinal']}' WHERE id_empleado = $verobjetivos  AND revision = '{$_POST["revision"]}';";
		$result = mysqli_query($enlace,$query) or print(' No se actualizado tu revision final');
	}else
	{
		for($i=1;$i<=6; $i++){
			$query = "UPDATE objetivos SET 
				revision_final = '{$_POST["cFinal_e$i"]}', revision_final_e = '{$_POST["cFinal_e$i"]}' WHERE id_empleado = $verobjetivos AND numero = $i AND revision = '{$_POST["revision"]}';";
		   // echo"$query ";
			$result = mysqli_query($enlace,$query) or print(' No se actualizado tu revision final');
		}	
	}
	if(isset($_POST['guardarFinalDes']) || isset($_POST['firmarFinalDes']))
	{
		
		$objetivo=$_POST["objetivo"];
		$descripcion=$_POST["descripcion"];
		$impacto=$_POST["impacto"];
		$num=1;
		for($i=0 ; $i<6 ; $i++)
		{
			$inicio=$_POST["inicio".$num];
			$fin=$_POST["fin".$num];
			$revision=$_POST['revision'];//se descomento esto
			$fechat = explode('-', $inicio);
			$finicio="$fechat[2]-$fechat[1]-$fechat[0]";
			$fechat = explode('-', $fin);
			$ffin="$fechat[2]-$fechat[1]-$fechat[0]";
			$obj=addslashes($objetivo[$i]);
			$des=addslashes($descripcion[$i]);
			$imp=addslashes($impacto[$i]);
			$consulta  = "update objetivos set  nombre='$obj', descripcion='$des', impacto='$imp', f_inicio='$finicio', f_fin='$ffin' 
                            where id_empleado=$verobjetivos and numero=$num and revision=$revision";
			//echo"$consulta <br>";
			$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P12: $consulta". mysqli_error($enlace) );
			$num++;
		}
	}
}
if(isset($_POST['firmarMidYearReview']) || isset($_POST['firmarMidYearReviewDes'])){    
    $jefe = NULL;
    
    if(isset($_POST['comentUser_midYearReview'])){
        $tipo = 'User';
        $estatus = 3;
        $query = "SELECT usuarios.*, us.nombre AS nombreEmpleado FROM `usuarios` 
            inner join usuarios as us on usuarios.id = us.id_jefe
            WHERE us.id = $idU";
        $result = mysqli_query($enlace,$query) or print(' No se obtuvo id del jefe '.mysqli_error($enlace));
        $jefe = mysqli_fetch_assoc($result);
    } else {
        $tipo = 'Jefe';
        $estatus = 4;
    }
	//guarda firma de planeacion
    if(isset($_POST['firmarMidYearReviewDes'])){
		if($estatus==3)
			$consulta  = "update planes set estatus=$estatus, firma_e_i=now() where id_empleado=$verobjetivos and revision= '{$_POST["revision"]}'";
		else
		if($estatus==4)
			$consulta  = "update planes set estatus=$estatus, firma_j_i=now() where id_empleado=$verobjetivos and revision='{$_POST["revision"]}'";
		$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: $consulta ". mysqli_error($enlace) );
	}
	//guarda firma de checkpoint
    $query = "UPDATE planes SET firma{$tipo}_midYearReview = NOW(), estatus = $estatus
        WHERE id_empleado = $verobjetivos AND revision = '{$_POST["revision"]}';";
        
    $result = mysqli_query($enlace,$query) or die('No se actualizado tu checkpoint1');
    
    for($i=1;$i<=6; $i++){
        $query = "UPDATE objetivos SET coment{$tipo}_midYearReview='".mysqli_real_escape_string($enlace,$_POST['coment'.$tipo.'_midYearReview'][$i-1])."',
            midCheckpoint = '{$_POST["midCheckpoint$i"]}'
            WHERE id_empleado = $verobjetivos AND numero = $i AND revision = '{$_POST["revision"]}';";
            
        $result = mysqli_query($enlace,$query) or die('<br>No se actualizado tu checkpoint2'.$query.  mysqli_error($enlace));
    }
    
    if(!is_null($jefe)){
        $EmailFrom = "notificaciones@tim-pmp.com";
        $Body = "<html xmlns=\"http://www.w3.org/1999/xhtml\">
        <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
        <title>TIM-PMP</title>
        <link href=\"http://www.tim-pmp.com/images/textos.css\" rel=\"stylesheet\" type=\"text/css\" />
        <style type=\"text/css\">
        <!--
        body {
                margin-left: 0px;
                margin-top: 0px;
        }
        .style1 {font-size: 16px}
        -->
        </style></head>

        <body>
        <table width=\"617\" border=\"0\" cellspacing=\"2\" cellpadding=\"0\">
          <tr>
                <td><div align=\"center\"><img src=\"http://www.tim-pmp.com/images/header_mail.jpg\" width=\"613\" height=\"107\" /></div></td>
          </tr>
          <tr>
                <td><div align=\"center\" class=\"text_grande\">Gestion de Desempeño </div></td>
          </tr>
          <tr>
                <td><p>&nbsp;</p>
                  <p>Tu colaborador {$jefe['nombreEmpleado']} ha firmado sus revisi&oacute;n intermedia.</p>
                  <p>Te invitamos a entrar a la plataforma para validarlos, en la secci&oacute;n de tareas pendientes encontraras una liga &quot; Revisi&oacute;n Intermedia {$_POST["revision"]}.</p>
                  <p align=\"center\"><a href=\"http://www.tim-pmp.com\" class=\"boton style1\">http:///www.tim-pmp.com</a></p>
                <p align=\"left\">El empleado {$jefe['nombreEmpleado']} </p>
                <p align=\"left\">. </p></td>
          </tr>
          <tr>
                <td class=\"texto_chico\">
                <div align=\"center\">Este correo electronico fue generado automaticamente y no requiere ser contestado, para cualquier duda acudir al departamento de Recursos Humanos con la Lic. Nancy Haller nhaller@bh.com </div></td>
          </tr>
        </table>
        </body>
        </html>";
        $Subject = "TIM-PMP - Revisar Mid Year Review de {$jefe['nombreEmpleado']} ";
        
        $success2 = mail($jefe['email'], $Subject, $Body, "From: TIM-PMP <$EmailFrom>\nContent-type: text/html; charset=utf-8\n");
		echo"<script>alert(\"Tu revisión intermedia ha sido firmada, tu coordinador recibira un correo electronico para que proceda a revisarla\");</script>";
    }else
		echo"<script>alert(\"La revisión intermedia ha sido firmada\");</script>";
    
}

if(isset($_POST['firmarFinal']) || isset($_POST['firmarFinalDes'])){    
    $jefe = NULL;
    
    if(isset($_POST['comentario_e_f'])){
        $tipo = 'e';
        $estatus = 5;
        $query = "SELECT usuarios.*, us.nombre AS nombreEmpleado FROM `usuarios` 
            inner join usuarios as us on usuarios.id = us.id_jefe
            WHERE us.id = $idU";
        $result = mysqli_query($enlace,$query) or print(' No se obtuvo id del jefe '.mysqli_error($enlace));
        $jefe = mysqli_fetch_assoc($result);
    } else {
        $tipo = 'j';
        $estatus = 6;
    }
	
	//guarda firma final
    $query = "UPDATE planes SET firma_{$tipo}_f = NOW(), estatus = $estatus
        WHERE id_empleado = $verobjetivos AND revision = '{$_POST["revision"]}';";
        
    $result = mysqli_query($enlace,$query) or die('No se actualizado tu checkpoint1');
    
   
    
    if(!is_null($jefe)){
        $EmailFrom = "notificaciones@tim-pmp.com";
        $Body = "<html xmlns=\"http://www.w3.org/1999/xhtml\">
        <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
        <title>TIM-PMP</title>
        <link href=\"http://www.tim-pmp.com/images/textos.css\" rel=\"stylesheet\" type=\"text/css\" />
        <style type=\"text/css\">
        <!--
        body {
                margin-left: 0px;
                margin-top: 0px;
        }
        .style1 {font-size: 16px}
        -->
        </style></head>

        <body>
        <table width=\"617\" border=\"0\" cellspacing=\"2\" cellpadding=\"0\">
          <tr>
                <td><div align=\"center\"><img src=\"http://www.tim-pmp.com/images/header_mail.jpg\" width=\"613\" height=\"107\" /></div></td>
          </tr>
          <tr>
                <td><div align=\"center\" class=\"text_grande\">Gestion de Desempeño </div></td>
          </tr>
          <tr>
                <td><p>&nbsp;</p>
                  <p>Tu colaborador {$jefe['nombreEmpleado']} ha firmado su Cierre de Objetivos.</p>
                  <p>Te invitamos a entrar a la plataforma para validarlos, en la secci&oacute;n de tareas pendientes encontraras una liga &quot; Cierre de Objetivos {$_POST["revision"]} de {$jefe['nombreEmpleado']} .</p>
                  <p align=\"center\"><a href=\"http://www.tim-pmp.com\" class=\"boton style1\">http:///www.tim-pmp.com</a></p>
                <p align=\"left\"> </p>
                <p align=\"left\">. </p></td>
          </tr>
          <tr>
                <td class=\"texto_chico\">
                <div align=\"center\">Este correo electronico fue generado automaticamente y no requiere ser contestado, para cualquier duda acudir al departamento de Recursos Humanos con la Lic. Nancy Haller nhaller@bh.com </div></td>
          </tr>
        </table>
        </body>
        </html>";
        $Subject = "TIM-PMP - Revisar ANNUAL PERFORMANCE REVIEW de {$jefe['nombreEmpleado']} ";
        
        $success2 = mail($jefe['email'], $Subject, $Body, "From: TIM-PMP <$EmailFrom>\nContent-type: text/html; charset=utf-8\n");
		echo"<script>alert(\"Tu cierre de objetivos ha sido firmada, tu coordinador recibira un correo electronico para que proceda a revisarla\");</script>";
    }else
		echo"<script>alert(\"El cierre de objetivos ha sido firmado\");</script>";
    
}


if(isset($_POST['desfirmarMidYearReview'])){
        $revision=$_POST["revision"];
	$plan=$_POST["plan"];
	$consulta  = "update planes SET firmaUser_midYearReview = NULL, firmaJefe_midYearReview = NULL, estatus = 2
        WHERE id=$plan";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: $consulta". mysqli_error($enlace) );
	echo"<script>alert(\"Desfirmado\");</script>";
}
if(!$debug){
    
if($_POST["desfirmar_planeacion"]=="Desfirmar Planeación"){
$revision=$_POST["revision"];
	$plan=$_POST["plan"];
	$consulta  = "update planes set  firma_e_i='0000-00-00', firma_j_i='0000-00-00', estatus='0' where id=$plan";
			//echo"$consulta <br>";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: $consulta". mysqli_error($enlace) );
	echo"<script>alert(\"Plan Desfirmado\");</script>";
}

if( ($_POST["guardar"]=="1" || $_POST["firma1"]=="1" || $_POST["firma2"]=="1")){

	$revision=$_POST["revision"];
	$plan=$_POST["plan"];
	$objetivo=$_POST["objetivo"];
	$descripcion=$_POST["descripcion"];
	$impacto=$_POST["impacto"];
	
	
	if($plan=="" || $plan==null)
	{
		
		$consulta  = "insert into planes(id_empleado, revision, estatus) value($verobjetivos, $revision, 0)";
		$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );
		$num=1;
		for($i=0 ; $i<6 ; $i++)
		{
			$inicio=$_POST["inicio".$num];
			$fin=$_POST["fin".$num];
			$fechat = explode('-', $inicio);
			$finicio="$fechat[2]-$fechat[1]-$fechat[0]";
			$fechat = explode('-', $fin);
			$ffin="$fechat[2]-$fechat[1]-$fechat[0]";
			$obj=addslashes($objetivo[$i]);
			$des=addslashes($descripcion[$i]);
			$imp=addslashes($impacto[$i]);
			$consulta  = "insert into objetivos(id_empleado, numero, nombre, descripcion, impacto, f_inicio, f_fin, revision) value($verobjetivos, $num, '$obj', '$des', '$imp', '$finicio', '$ffin', $revision)";
			$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: $consulta". mysqli_error($enlace) );
			$num++;
		}
	}else
	{
		//
		$num=1;
		for($i=0 ; $i<6 ; $i++)
		{
			$inicio=$_POST["inicio".$num];
			$fin=$_POST["fin".$num];
			$fechat = explode('-', $inicio);
			$finicio="$fechat[2]-$fechat[1]-$fechat[0]";
			$fechat = explode('-', $fin);
			$ffin="$fechat[2]-$fechat[1]-$fechat[0]";
			$obj=addslashes($objetivo[$i]);
			$des=addslashes($descripcion[$i]);
			$imp=addslashes($impacto[$i]);
			$consulta  = "update objetivos set  nombre='$obj', descripcion='$des', impacto='$imp', f_inicio='$finicio', f_fin='$ffin' 
                            where id_empleado=$verobjetivos and numero=$num and revision=$revision";
			//echo"$consulta <br>";
			$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: $consulta". mysqli_error($enlace) );
			$num++;
		}
	}
}

if($_POST["firma1"]=="1")
{
	$consulta  = "SELECT nombre, id_jefe from usuarios where id=$verobjetivos";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta  ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_row($resultado);
		$nombreEmpleado=$res[0];
		$jefe=$res[1];
		
	}
	$consulta  = "SELECT email from usuarios where id=$jefe";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta  ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_row($resultado);
		$EmailTo=$res[0];
		
	}
	$consulta  = "update planes set estatus=1, firma_e_i=now() where id_empleado=$verobjetivos and revision=$revision";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: $consulta ". mysqli_error($enlace) );
	
	$EmailFrom = "notificaciones@tim-pmp.com";

		$Body = "<html xmlns=\"http://www.w3.org/1999/xhtml\">
		<head>
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
		<title>TIM-PMP</title>
		<link href=\"http://www.tim-pmp.com/images/textos.css\" rel=\"stylesheet\" type=\"text/css\" />
		<style type=\"text/css\">
		<!--
		body {
			margin-left: 0px;
			margin-top: 0px;
		}
		.style1 {font-size: 16px}
		-->
		</style></head>
		
		<body>
		<table width=\"617\" border=\"0\" cellspacing=\"2\" cellpadding=\"0\">
		  <tr>
			<td><div align=\"center\"><img src=\"http://www.tim-pmp.com/images/header_mail.jpg\" width=\"613\" height=\"107\" /></div></td>
		  </tr>
		  <tr>
			<td><div align=\"center\" class=\"text_grande\">Gestion de Desempeño </div></td>
		  </tr>
		  <tr>
			<td><p>&nbsp;</p>
			  <p>Tu colaborador $nombreEmpleado ha firmado sus objetivos.</p>
			  <p>Te invitamos a entrar a la plataforma para validarlos, en la sección de tareas pendientes encontraras una liga &quot; Revisar Planeación de Objetivos de $nombreEmpleado </p>
			  <p align=\"center\"><a href=\"http://www.tim-pmp.com\" class=\"boton style1\">http:///www.tim-pmp.com</a></p>
			<p align=\"left\">Es importante completar el proceso de revisión para no tener problemas en futuras etapas</p>
			<p align=\"left\">. </p></td>
		  </tr>
		  <tr>
			<td class=\"texto_chico\"><div align=\"center\">Este correo electronico fue generado automaticamente y no requiere ser contestado, para cualquier duda acudir al departamento de Recursos Humanos con la Lic. Nancy Haller nhaller@bh.com </div></td>
		  </tr>
		</table>
		</body>
		</html>";
		$Subject = "TIM-PMP - Revisar Planeación de $nombreEmpleado";
		
		$success2 = mail($EmailTo, $Subject, $Body, "From: TIM-PMP <$EmailFrom>\nContent-type: text/html; charset=utf-8\n");
		
	echo"<script>alert(\"Tu planeación ha sido firmada, tu coordinador recibira un correo electronico para que proceda a revisarla\");</script>";
}
if($_POST["firma2"]=="1")
{
	$consulta  = "update planes set estatus=2, firma_j_i=now() where id_empleado=$verobjetivos and revision=$revision";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: $consulta ". mysqli_error($enlace) );
	echo"<script>alert(\"Planeacion Firmada\");</script>";
}

}
	$consulta  = "SELECT revision, etapa from etapa where id=1";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta  ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_row($resultado);
		$revision=$res[0];
		$etapa=$res[1];
	}
	$consulta  = "SELECT nombre, puesto, DATE_FORMAT(fecha_contratacion,'%d-%m-%Y'), DATEDIFF( NOW() , fecha_contratacion ), id_jefe from usuarios where id=$verobjetivos";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta  ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_row($resultado);
		$nombre=$res[0];
		$puesto=$res[1];
		$jefe=$res[4];
		$contratacion=$res[2];
		$tiempo=round($res[3]/364, 0);
	}
	$consulta  = "SELECT id, estatus, firma_e_i, firma_e_f, firma_j_i, firma_j_f,firmaUser_midYearReview, firmaJefe_midYearReview, resultado_obj, clasificacion
            from planes where id_empleado=$verobjetivos and revision=$revision";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: $consulta " . mysqli_error($enlace));//. mysqli_error($enlace)	
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_array($resultado);
                $planes = $res;
		$plan=$res[0];
		$estatus=$res[1];
		$firma1e=$res[2];
		$firma2e=$res[3];
		$firma1j=$res[4];
		$firma2j=$res[5];
		$firma3e=$res[6];
		$firma3j=$res[7];
	}
	$ver=0;
        
       /* $consulta = "SELECT * FROM etapa where id =1";
		$result = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: $consulta " . mysqli_error($enlace));
        //$result = mysqli_query($enlace,$consulta) or die(mysqli_error($enlace));
        //$etapa = mysqli_fetch_assoc($result);
        $etapa=mysql_fetch_array($result,MYSQL_BOTH);
		echo"$etapa[2]";*/
		
	if(($firma1e=="0000-00-00" || $plan=="") && $idU==$verobjetivos)
		$ver=1; // entra empleado con plan sin firmar o crear puede editar
	else
	{
		if($firma1e!="0000-00-00" && $idU==$verobjetivos && $firma1j=="0000-00-00")
			$ver=2; // entra empleado con plan sin firmado solo puede ver textos
		else
		{
			if($firma1e!="0000-00-00" && $firma1j=="0000-00-00" && $idU==$jefe)
				$ver=3; // entra jefe pendiente de firmar puede editar
			else
			{
				if($firma1e!="0000-00-00" && $firma1j!="0000-00-00" && $idU==$id_jefe)
					$ver=4; // entra jefe frimado solo ver
				
			}
		}
	}
	//echo $ver;
	
	if( is_null($planes['firmaUser_midYearReview'])   && $idU==$verobjetivos)
	{
						$verChP=5; // empleado no ha firmado midyear, empleado puede editar midyear. jefe no le aparece midyear.
	} else 
	if(!is_null($planes['firmaUser_midYearReview']) && is_null($planes['firmaJefe_midYearReview']) && $idU==$jefe)
	{
						$verChP=6; // empleado ha firmado midyear, jefe firmará midyear. Empleado solo ver.
	} else 
	if($etapa>=2){
						$verChP=7;// empleado y jefe firmaron pero salen solo de lectura
	}
	
	if($firma2e=="0000-00-00" && $idU==$verobjetivos)
		$verFinal=8; // entra empleado  para firmar  cierre de objetivos puede editar comentarios
	else
	{
		
			if($firma2e!="0000-00-00" && $firma2j=="0000-00-00" && $idU==$jefe)
				$verFinal=9; // entra jefe pendiente de firmar puede editar
			else
			{
				if($firma2e!="0000-00-00" && $firma2j!="0000-00-00")
					$verFinal=10; // entra jefe frimado solo ver
				
			}
		
	}
         $entroEmpleado = intval($idU) == intval($verobjetivos);
        

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bell</title>
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
.texto_rojo {
	color: #F00;
}
.texto_verde {
	color: #060;
}
.texto_azul {
	color: #009;
}
-->
</style>
<link href="images/textos.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
<link rel="stylesheet" href="colorbox.css" />
<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
<script src="colorbox/jquery.colorbox-min.js"></script>

<SCRIPT>
	$(document).ready(function(){
		$(".iframe2").colorbox({iframe:true,width:"450", height:"320",transition:"fade", scrolling:false, opacity:0.1});
		$("#click").click(function(){ 
			$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
			return false;
		});
	});
	
	$(function() {
		$( "#inicio1" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#fin1" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#inicio2" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#fin2" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#inicio3" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#fin3" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#inicio4" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#fin4" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#inicio5" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#fin5" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#inicio6" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#fin6" ).datepicker({ dateFormat: 'dd-mm-yy' });
		
	});
	</SCRIPT>
<script type="text/javascript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function validar()
{
	var numero=1;
	for(var i=0 ; i<1 ; i++)
	{
		if(document.form1.objetivo[i].value=="")
		{
			alert("No escribio Nombre del Objetivo "+numero);
			document.form1.objetivo[i].focus();
			return false;
		}else
		{
			if(document.form1.descripcion[i].value=="")
			{
				alert("No escribio Descripcion del Objetivo "+numero);
				document.form1.descripcion[i].focus();
				return false;
			}else
			{
				if(document.form1.impacto[i].value=="")
				{
					alert("No escribio Impacto del Objetivo "+numero);
					document.form1.impacto[i].focus();
					return false;
				}else
				{
					
				}
			}
		}
		numero++;
	}
	if(document.form1.inicio1.value=="" || document.form1.fin1.value=="")
	{
		alert("No escribio el rango Fecha de inicio y fin del Objetivo 1");
		document.form1.inicio1.focus();
		return false;
	}else
	{
		if(document.form1.inicio2.value=="" || document.form1.fin2.value=="")
		{
			alert("No escribio el rango Fecha de inicio y fin del Objetivo 1");
			document.form1.inicio2.focus();
			return false;
		}else
		{
			if(document.form1.inicio3.value=="" || document.form1.fin3.value=="")
			{
				alert("No escribio el rango Fecha de inicio y fin del Objetivo 3");
				document.form1.inicio3.focus();
				return false;
			}else
			{
				if(document.form1.inicio4.value=="" || document.form1.fin4.value=="")
				{
					alert("No escribio el rango Fecha de inicio y fin del Objetivo 4");
					document.form1.inicio4.focus();
					return false;
				}
			}
		}
	}
	return true;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function guardar()
{
	document.form1.guardar.value="1";
	document.form1.submit();
}

function firmar()
{
	if(validar()==true)
	{
	document.form1.firma1.value="1";
	document.form1.submit();
	}
}


function guardarFinalDes()
{
    var element = document.createElement('input');
    element.name = 'guardarFinalDes';
    element.value = 1;
    document.form1.appendChild(element);
    document.form1.submit();
}
function guardarFinal()
{
    var element = document.createElement('input');
    element.name = 'guardarFinal';
    element.value = 1;
    document.form1.appendChild(element);
    document.form1.submit();
}
function guardarMidYearReviewDes()
{
    var element = document.createElement('input');
    element.name = 'guardarMidYearReviewDes';
    element.value = 1;
    document.form1.appendChild(element);
    document.form1.submit();
}
function guardarMidYearReview()
{
    var element = document.createElement('input');
    element.name = 'guardarMidYearReview';
    element.value = 1;
    document.form1.appendChild(element);
    document.form1.submit();
}
function firmarMidYearReviewDes(esJefe){
    if(validar() && validarMidYearReview(esJefe)){
        var element = document.createElement('input');
        element.name = 'firmarMidYearReviewDes';
        element.value = 1;
        document.form1.appendChild(element);
        document.form1.submit();
    }
}
function firmarMidYearReview(esJefe){
    if( validarMidYearReview(esJefe) ){
        var element = document.createElement('input');
        element.name = 'firmarMidYearReview';
        element.value = 1;
        document.form1.appendChild(element);
        document.form1.submit();
    }
}
function firmarFinal(esJefe){
    if( validarFinal(esJefe) ){
        var element = document.createElement('input');
        element.name = 'firmarFinal';
        element.value = 1;
        document.form1.appendChild(element);
        document.form1.submit();
    }
}
function firmarFinalDes(esJefe){
    if( validarFinal(esJefe) &&  validar() ){
        var element = document.createElement('input');
        element.name = 'firmarFinalDes';
        element.value = 1;
        document.form1.appendChild(element);
        document.form1.submit();
    }
}
function validarMidYearReview(esJefe){
    //validar textarea jefe o usuario
if(esJefe){
	if(document.form1.objetivo[0].value!="" && document.form1.midCheckpoint1[0].checked==false && 
            document.form1.midCheckpoint1[1].checked==false && 
            document.form1.midCheckpoint1[2].checked==false){
                document.form1.midCheckpoint1[0].focus();
                alert('Falto evaluacion de objetivo 1');
                return false;
        } else {
            if(document.form1.objetivo[1].value!="" && document.form1.midCheckpoint2[0].checked==false && document.form1.midCheckpoint2[1].checked==false && document.form1.midCheckpoint2[2].checked==false){
                document.form1.midCheckpoint2[0].focus();
                alert('Falto evaluacion de objetivo 2');
                return false;
     		 }else
			 {
				 if(document.form1.objetivo[2].value!="" && document.form1.midCheckpoint3[0].checked==false && document.form1.midCheckpoint3[1].checked==false && document.form1.midCheckpoint3[2].checked==false){
					document.form1.midCheckpoint3[0].focus();
					alert('Falto evaluacion de objetivo 3');
					return false;
				 }else
				 {
					  if(document.form1.objetivo[3].value!="" && document.form1.midCheckpoint4[0].checked==false && document.form1.midCheckpoint4[1].checked==false && document.form1.midCheckpoint4[2].checked==false){
						document.form1.midCheckpoint4[0].focus();
						alert('Falto evaluacion de objetivo 4');
						return false;
					 }else
					 {
					  if(document.form1.objetivo[4].value!="" && document.form1.midCheckpoint5[0].checked==false && document.form1.midCheckpoint5[1].checked==false && document.form1.midCheckpoint5[2].checked==false){
						document.form1.midCheckpoint5[0].focus();
						alert('Falto evaluacion de objetivo 5');
						return false;
					 }else
					 {
					 if(document.form1.objetivo[5].value!="" && document.form1.midCheckpoint6[0].checked==false && document.form1.midCheckpoint6[1].checked==false && document.form1.midCheckpoint6[2].checked==false){
                document.form1.midCheckpoint6[0].focus();
                alert('Falto evaluacion de objetivo 6');
                return false;
		  			}
					 }
					 }
				 }
			 }
		  }
}else
{
	if(document.form1.objetivo[0].value!="" && document.form1.midCheckpoint_e1[0].checked==false && 
            document.form1.midCheckpoint_e1[1].checked==false && 
            document.form1.midCheckpoint_e1[2].checked==false){
                document.form1.midCheckpoint_e1[0].focus();
                alert('Falto evaluacion de objetivo 1');
                return false;
        } else {
            if(document.form1.objetivo[1].value!="" && document.form1.midCheckpoint_e2[0].checked==false && document.form1.midCheckpoint_e2[1].checked==false && document.form1.midCheckpoint_e2[2].checked==false){
                document.form1.midCheckpoint_e2[0].focus();
                alert('Falto evaluacion de objetivo 2');
                return false;
     		 }else
			 {
				 if(document.form1.objetivo[2].value!="" && document.form1.midCheckpoint_e3[0].checked==false && document.form1.midCheckpoint_e3[1].checked==false && document.form1.midCheckpoint_e3[2].checked==false){
					document.form1.midCheckpoint_e3[0].focus();
					alert('Falto evaluacion de objetivo 3');
					return false;
				 }else
				 {
					  if(document.form1.objetivo[3].value!="" && document.form1.midCheckpoint_e4[0].checked==false && document.form1.midCheckpoint_e4[1].checked==false && document.form1.midCheckpoint_e4[2].checked==false){
						document.form1.midCheckpoint_e4[0].focus();
						alert('Falto evaluacion de objetivo 4');
						return false;
					 }else
					 {
					  if(document.form1.objetivo[4].value!="" && document.form1.midCheckpoint_e5[0].checked==false && document.form1.midCheckpoint_e5[1].checked==false && document.form1.midCheckpoint_e5[2].checked==false){
						document.form1.midCheckpoint_e5[0].focus();
						alert('Falto evaluacion de objetivo 5');
						return false;
					 }else
					 {
					 if(document.form1.objetivo[5].value!="" && document.form1.midCheckpoint_e6[0].checked==false && document.form1.midCheckpoint_e6[1].checked==false && document.form1.midCheckpoint_e6[2].checked==false){
                document.form1.midCheckpoint6[0].focus();
                alert('Falto evaluacion de objetivo 6');
                return false;
		  			}
					 }
					 }
				 }
			 }
		  }
}
    var txtAU = document.getElementsByName('comentUser_midYearReview[]');
    var txtAJ = document.getElementsByName('comentJefe_midYearReview[]');
    for(var i=0 ; i<6 ; i++){
        try{
            if(document.form1.objetivo[i].value!="" && txtAU[i].value=="" && txtAU.length > 0){
                txtAU[i].focus();
                alert('Falto comentario del objetivo '+ (i+1));
                return false;
            }   
        }catch(e){
            //console.log('txtAU '+e.message);
        }
        try{
            if(txtAJ[i].value=="" && txtAJ.length > 0){
                txtAJ[i].focus();
                alert('Falto comentario del objetivo '+(i+1));
                return false;
            }
            
        }catch(e){
            //console.log('txtAJ '+e.message);
        }
		
    }
	 
		  
	  
    return true;
}
function validarFinal(esJefe){
    //validar textarea jefe o usuario
	if(document.form1.cFinal1[0].checked==false && 
            document.form1.cFinal1[1].checked==false && 
            document.form1.cFinal1[2].checked==false && 
			document.form1.cFinal1[3].checked==false  && 
			document.form1.cFinal1[4].checked==false)
			{
                document.form1.cFinal1[0].focus();
                alert('Falto evaluacion de objetivo 1');
                return false;
        } else {
            if(document.form1.cFinal2[0].checked==false && document.form1.cFinal2[1].checked==false && document.form1.cFinal2[2].checked==false && document.form1.cFinal2[3].checked==false && document.form1.cFinal2[4].checked==false){
                document.form1.cFinal2[0].focus();
                alert('Falto evaluacion de objetivo 2');
                return false;
     		 }else
			 {
				 if(document.form1.cFinal3[0].checked==false && document.form1.cFinal3[1].checked==false && document.form1.cFinal3[2].checked==false && document.form1.cFinal3[3].checked==false && document.form1.cFinal3[4].checked==false){
					document.form1.midCheckpoint3[0].focus();
					alert('Falto evaluacion de objetivo 3');
					return false;
				 }else
				 {
					  if(document.form1.cFinal4[0].checked==false && document.form1.cFinal4[1].checked==false && document.form1.cFinal4[2].checked==false && document.form1.cFinal4[3].checked==false && document.form1.cFinal4[4].checked==false){
						document.form1.cFinal4[0].focus();
						alert('Falto evaluacion de objetivo 4');
						return false;
					 }else
					 {
					  if(document.form1.cFinal5[0].checked==false && document.form1.cFinal5[1].checked==false && document.form1.cFinal5[2].checked==false && document.form1.cFinal5[3].checked==false && document.form1.cFinal5[4].checked==false){
						document.form1.cFinal5[0].focus();
						alert('Falto evaluacion de objetivo 5');
						return false;
					 }else
					 {
					 if(document.form1.cFinal6[0].checked==false && document.form1.cFinal6[1].checked==false && document.form1.cFinal6[2].checked==false && document.form1.cFinal6[3].checked==false && document.form1.cFinal6[4].checked==false){
                document.form1.cFinal6[0].focus();
                alert('Falto evaluacion de objetivo 6');
                return false;
		  			}
					 }
					 }
				 }
			 }
		  }
    var txtAU = document.getElementsByName('comentario_e_f[]');
    var txtAJ = document.getElementsByName('comentario_j_f[]');
    for(var i=0 ; i<6 ; i++){
        try{
            if(txtAU[i].value=="" && txtAU.length > 0){
                txtAU[i].focus();
                alert('Falto comentario del objetivo '+ (i+1));
                return false;
            }   
        }catch(e){
            //console.log('txtAU '+e.message);
        }
        try{
            if(txtAJ[i].value=="" && txtAJ.length > 0){
                txtAJ[i].focus();
                alert('Falto comentario del objetivo '+(i+1));
                return false;
            }
            
        }catch(e){
            //console.log('txtAJ '+e.message);
        }
		
    }
	if(esJefe)
	{
		if(document.form1.rFinal[0].checked==false && document.form1.rFinal[1].checked==false && document.form1.rFinal[2].checked==false && document.form1.rFinal[3].checked==false && document.form1.rFinal[4].checked==false){
                document.form1.rFinal[0].focus();
                alert('Falto evaluacion final');
                return false;
		  }
		  if(document.form1.clasFinal[0].checked==false && document.form1.clasFinal[1].checked==false && document.form1.clasFinal[2].checked==false ){
                document.form1.rFinal[0].focus();
                alert('Falto clasificacion final');
                return false;
		  }
	} 
		  
	  
    return true;
}

function firmarR()
{
	if(validar()==true)
	{
	document.form1.firma2.value="1";
	document.form1.submit();
	}
}

function guardarFinal()
{
    var element = document.createElement('input');
    element.name = 'guardarFinal';
    element.value = 1;
    document.form1.appendChild(element);
    document.form1.submit();
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
</head>

<body onload="MM_preloadImages('images/b_cambio_r.png','images/b_administracion_r.png','images/b_log_out_r.png','images/b_inicio_r.png','images/b_guardar_r.png','images/b_firmar_r.png')">
<form method="post" name="form1">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
   <?include_once("header.php");?>
  </tr>
  <tr>
    <td height="698" valign="top" background="images/bkg_fondo_2.jpg"><table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><div align="right"><a href="menu<? if($debug) echo 2;?>.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image30','','images/b_inicio_r.png',1)"><img src="images/b_inicio.png" name="Image30" width="58" height="23" border="0" id="Image30" /></a><a href="menu.php" class="boton"></a><img src="images/spacer.gif" width="56" height="19" /></div></td>
      </tr>
      
      <tr>
        <td><table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="250" valign="top" bgcolor="#eeeeee"><table width="753" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td><img src="images/spacer.gif" width="10" height="20" /></td>
              </tr>
              <tr>
                <td><table width="753" border="0" cellspacing="3" cellpadding="0">
                    <tr>
                      <td width="477" class="tit_1"><? echo $revision?> PMP for: <span class="texto_tareas"><? echo $nombre?></span></td>
                      <td colspan="4" rowspan="4" valign="top"><img src="images/logo_marca_agua.jpg" width="278" height="59" /></td>
                      </tr>
                    <tr>
                      <td class="tit_1">Position Title:<span class="texto_tareas"> <? echo $puesto?></span></td>
                      </tr>
                    <tr>
                      <td class="tit_1">Hire date: <span class="texto_tareas"><? echo $contratacion?></span></td>
                      </tr>
                    <tr>
                      <td class="tit_1">Time on this job: <span class="texto_tareas"><? echo $tiempo?> años
                        <input name="plan" type="hidden" id="plan" value="<?echo"$plan";?>" />
                        <input name="verobjetivos" type="hidden" id="verobjetivos" value="<?echo"$verobjetivos";?>" />
                        <input name="revision" type="hidden" id="revision" value="<?echo"$revision";?>" />
                        <input name="guardar" type="hidden" id="guardar" />
                      </span></td>
                      </tr>
                  </table></td>
              </tr>
              <tr>
                <td><img src="images/spacer.gif" width="10" height="20" /></td>
              </tr>
              

            </table>
			<?
			for($i=1 ; $i<=6 ; $i++)
			{
				$ob="";
				$de="";
				$inicio="";
				$fin="";
				$im="";
				$consulta  = "
                                    SELECT nombre, descripcion, DATE_FORMAT(f_inicio,'%d-%m-%Y'), DATE_FORMAT(f_fin,'%d-%m-%Y'), impacto,
                                        comentUser_midYearReview, comentJefe_midYearReview, midCheckpoint,midCheckpoint_e, revision_final,revision_final_e, comentario_e_f, comentario_j_f
                                    from objetivos where id_empleado=$verobjetivos 
                                        and numero=$i and revision=$revision";
				$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: $consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)	
				if(@mysqli_num_rows($resultado)>=1)
				{
					$res=  mysqli_fetch_array($resultado);
					$ob=stripcslashes($res[0]);
					$de=stripcslashes($res[1]);
					$inicio=$res[2];
					$fin=$res[3];
					$im=stripcslashes($res[4]);
				}
			?>
              <table width="753" border="0" align="center" cellpadding="0" cellspacing="0">

                <tr>
                  <td><img src="images/spacer.gif" width="10" height="20" /></td>
                </tr>
                <tr>
                  <td><table width="753" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="28" background="images/titulos_franjas.jpg"><table width="450" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="10"><img src="images/spacer.gif" width="15" height="28" /></td>
                              <td class="text_mediano_blanco">BUSINESS OBJECTIVE # <? echo"$i";?></td>
                            </tr>
                        </table></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td><img src="images/spacer.gif" width="10" height="20" /></td>
                </tr>
                <tr>
                  <td><table width="753" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="350" valign="top"><table width="350" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td><table width="350" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="410"><table width="250" border="0" cellspacing="2" cellpadding="0">
                                        <tr>
                                          <td height="20" bgcolor="#ced0d1" class="usuario"><img src="images/spacer.gif" width="10" height="10" />1. Name of Objective:</td>
                                        </tr>
                                    </table></td>
                                  </tr>
                                  <tr>
                                    <td><label>
									<? if($ver=="1" || $ver=="3"){?>
                                      <input name="objetivo[]" type="text" class="texto_tareas" id="objetivo" value="<?echo"$ob";?>" size="60" />
                                      
                                    <? }else{?>
									 <div align="left" class="texto_tareas"><? echo"$ob";?><input name="objetivo" type="hidden" id="objetivo" value="<?echo"$ob";?>" />
									 </div>
									 <? }?>
									</label></td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td><img src="images/spacer.gif" width="10" height="20" /></td>
                            </tr>
                            <tr>
                              <td><table width="350" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="410"><table width="250" border="0" cellspacing="2" cellpadding="0">
                                        <tr>
                                          <td height="20" bgcolor="#ced0d1" class="usuario"><img src="images/spacer.gif" width="10" height="10" />2. SMART Description:</td>
                                        </tr>
                                    </table></td>
                                  </tr>
                                  <tr>
                                    <td><label>
                                     
									  <? if($ver=="1" || $ver=="3"){?>
                                       <textarea name="descripcion[]" cols="60" rows="5" class="texto_tareas" id="descripcion"><?echo"$de";?></textarea>
                                    <? }else{?>
									 <div align="left" class="texto_tareas"><? echo"$de";?></div>
									 <? }?>
                                    </label></td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td><img src="images/spacer.gif" width="10" height="20" /></td>
                            </tr>
                            <tr>
                              <td><table width="350" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="410"><table width="330" border="0" cellspacing="2" cellpadding="0">
                                        <tr>
                                          <td height="20" bgcolor="#ced0d1" class="usuario"><img src="images/spacer.gif" width="10" height="10" />3. Textron Behaviors which impact this objective:</td>
                                        </tr>
                                    </table></td>
                                  </tr>
                                  <tr>
                                    <td><label>
                                      
									   <? if($ver=="1" || $ver=="3"){?>
                                       <textarea name="impacto[]" cols="60" rows="5" class="texto_tareas" id="impacto"><?echo"$im";?></textarea>
                                    <? }else{?>
									 <div align="left" class="texto_tareas"><? echo"$im";?></div>
									 <? }?>
                                    </label></td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td><img src="images/spacer.gif" width="10" height="20" /></td>
                            </tr>
                            <tr>
                              <td><table width="350" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="410"><table width="300" border="0" cellspacing="2" cellpadding="0">
                                        <tr>
                                          <td height="20" bgcolor="#ced0d1" class="usuario"><img src="images/spacer.gif" width="10" height="10" /> 4. Beginning Date: </td>
                                          <td width="128" class="usuario">
										  <? if($ver=="1" || $ver=="3"){?>
                                       <input name="inicio<?echo"$i";?>" type="text" class="texto_tareas" id="inicio<?echo"$i";?>" value="<?echo"$inicio";?>" size="15" readonly/>
                                    <? }else{?>
									 	<div align="left" class="texto_tareas"><? echo"$inicio";?></div>
									 <? }?>										  </td>
                                        </tr>
                                    </table></td>
                                  </tr>
                                  <tr> </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td><img src="images/spacer.gif" width="10" height="20" /></td>
                            </tr>
                            <tr>
                              <td><table width="300" border="0" cellspacing="2" cellpadding="0">
                                  <tr>
                                    <td height="20" bgcolor="#ced0d1" class="usuario"><img src="images/spacer.gif" width="10" height="10" /> 5. Due Date:</td>
                                    <td width="128" class="usuario">
									 <? if($ver=="1" || $ver=="3"){?>
                                       <input name="fin<?echo"$i";?>" type="text" class="texto_tareas" id="fin<?echo"$i";?>" value="<?echo"$fin";?>" size="15" readonly/>
                                    <? }else{?>
									 	<div align="left" class="texto_tareas"><? echo"$fin";?></div>
									 <? }?>									</td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td><img src="images/spacer.gif" width="10" height="20" /></td>
                            </tr>
                        </table></td>
                        <td width="53"><img src="images/spacer.gif" width="52" height="20" /></td>
                        <td width="350" valign="top">
                            <? if($etapa>=2){?>
                        <table width="350" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><table width="350" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="410"><table width="250" border="0" cellspacing="2" cellpadding="0">
                                  <tr>
                                    <td height="20" bgcolor="#ced0d1" class="usuario"><img src="images/spacer.gif" alt="" width="10" height="10" />6. MID YEAR REVIEW:</td>
                                  </tr>
                                </table></td>
                              </tr>
                              <tr>
                                <td>
                                    <table width="350" border="0" cellspacing="2" cellpadding="0">
                                  <tr>
                                    <td height="20" class="texto_tareas"><table width="100%" align="center">
                                      <tr>
                                        <td>Employee</td>
                                        <td>Supervisor/Manager</td>
                                      </tr>
                                      <tr>
                                        <td width="16%">
										
                                          <label>
                                              <? $disabled = ( $verChP==7 )?'disabled':'';?>
                                            <input <? echo $disabled;?> <? if($tipo_usuario=="Jefe"){echo "disabled";}?> type="radio" name="midCheckpoint_e<? echo $i;?>" value="BT" id="midCheckpoint_0" <? echo $res['midCheckpoint_e']=='BT'?'checked':""; ?>/>
                                            <span class="texto_rojo">Behind plan </span></label></td>
                                        <td width="16%"><label>
                                              <? $disabled = ( $verChP==7 )?'disabled':'';?>
                                            <input <? echo $disabled;?> <? if($tipo_usuario=="User"){echo "disabled";}?> type="radio" name="midCheckpoint<? echo $i;?>" value="BT" id="midCheckpoint_0" <? echo $res['midCheckpoint']=='BT'?'checked':""; ?>/>
                                            <span class="texto_rojo">Behind plan </span></label></td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <label>
                                            <input <? echo $disabled;?> <? if($tipo_usuario=="Jefe"){echo "disabled";}?> type="radio" name="midCheckpoint_e<? echo $i;?>" value="OT" id="midCheckpoint_1" <? echo $res['midCheckpoint_e']=='OT'?'checked':""; ?>/>
                                            <span class="texto_verde">On plan </span></label></td>
                                        <td><label>
                                            <input <? echo $disabled;?> <? if($tipo_usuario=="User"){echo "disabled";}?> type="radio" name="midCheckpoint<? echo $i;?>" value="OT" id="midCheckpoint_1" <? echo $res['midCheckpoint']=='OT'?'checked':""; ?>/>
                                            <span class="texto_verde">On plan </span></label></td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <label>
                                            <input <? echo $disabled;?> <? if($tipo_usuario=="Jefe"){echo "disabled";}?> type="radio" name="midCheckpoint_e<? echo $i;?>" value="C" id="midCheckpoint_2" <? echo $res['midCheckpoint_e']=='C'?'checked':""; ?>/>
                                            <span class="texto_azul">Ahead of plan </span></label></td>
                                        <td> <label>
                                            <input <? echo $disabled;?><? if($tipo_usuario=="User"){echo "disabled";}?> type="radio" name="midCheckpoint<? echo $i;?>" value="C" id="midCheckpoint_2" <? echo $res['midCheckpoint']=='C'?'checked':""; ?>/>
                                            <span class="texto_azul">Ahead of plan </span></label></td>
                                      </tr>
                                      <tr>
                                        <td colspan="2">&nbsp;</td>
                                        </tr>
                                    </table></td>
                                    </tr>
                                </table>                                </td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td align="left" valign="top" class="texto_tareas"><strong>Employee Comments</strong></td>
                          </tr>
                          <tr>
                            <td align="left" valign="top" class="texto_tareas">&nbsp;
                                
                                <? if( $verChP==5 ){?>
                              <textarea name="comentUser_midYearReview[]" cols="40" rows="4" class="texto_tareas" id="comentUser_midYearReview[]"><?
                              echo $res['comentUser_midYearReview'];?></textarea>
                              &nbsp;<? } else echo $res['comentUser_midYearReview'];?></td>
                          </tr>
                            <? if( ($verChP==6 || $verChP==7 ) ){?>
                          <tr>
                            <td align="left" valign="top" class="texto_tareas"><strong>Supervisor/Manager Comments:</strong>                            </td>
                          </tr>
                            <tr><td>
                                  &nbsp;<? if( $verChP==6  ){?>
                                  <textarea name="comentJefe_midYearReview[]" cols="60" rows="5" class="texto_tareas" id="comentJefe_midYearReview[]"><?
                              echo $res['comentJefe_midYearReview'];?></textarea>
                                  <?} else echo $res['comentJefe_midYearReview'];?></td></tr>
                          <? } else {?>
                            <tr><td></td></tr>
                            <? }?>
						  <tr>
                            <td><img src="images/spacer.gif" alt="" width="10" height="20" />
                                
                                <? if( ($verChP==5 && $ver==0) || ($verChP==6 && $ver==0) ){?>
                                <a href="javascript:guardarMidYearReview();" onmouseout="MM_swapImgRestore()" 
                                   onmouseover="MM_swapImage('Image31<?echo"$i";?>','','images/b_guardar_r.png',1)">
                                    <img src="images/b_guardar.png" alt="" name="Image31<?echo"$i";?>" width="69" height="23" border="0" id="Image31<?echo"$i";?>2" />                                </a>
                            <? }?>
                            <? if( ($verChP==5 && $ver==1)|| ($verChP==6 && $ver==3) ){?>
                            <a href="javascript:guardarMidYearReviewDes();" onmouseout="MM_swapImgRestore()" 
                                   onmouseover="MM_swapImage('Image31<?echo"$i";?>','','images/b_guardar_r.png',1)"> <img src="images/b_guardar.png" alt="" name="Image31<?echo"$i";?>" width="69" height="23" border="0" id="Image31<?echo"$i";?>2" /> </a>
                            <? }?></td>
                          </tr>
                        </table>
                        <? }?>  
						<? if($etapa>=3){?>
                        <table width="350" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><table width="350" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="410"><table width="250" border="0" cellspacing="2" cellpadding="0">
                                  <tr>
                                    <td height="20" bgcolor="#ced0d1" class="usuario"><img src="images/spacer.gif" alt="" width="10" height="10" />7. ANNUAL PERFORMANCE REVIEW:</td>
                                  </tr>
                                </table></td>
                              </tr>
                              <tr>
                                <td>
                                    <table width="350" border="0" cellspacing="2" cellpadding="0">
                                  <tr>
                                    <td height="20" class="texto_tareas"><table width="100%" align="center">
									
                                      <tr>
                                        <td> <label>
                                              <? $disabled = ( $verFinal==10 || $verFinal==9)?'disabled':'';?>
                                              Employee Rating :
                       <input <? echo $disabled;?> <? if($tipo_usuario=="Jefe"){echo "disabled";}?> type="radio" name="cFinal_e<? echo $i;?>" value="1" id="cFinal<? echo $i;?>" <? echo $res['revision_final_e']=='1'?'checked':""; ?>/>
                                              1
                       <input <? echo $disabled;?> <? if($tipo_usuario=="Jefe"){echo "disabled";}?> type="radio" name="cFinal_e<? echo $i;?>" value="2" id="cFinal<? echo $i;?>" <? echo $res['revision_final_e']=='2'?'checked':""; ?>/>
2 
						<input <? echo $disabled;?> <? if($tipo_usuario=="Jefe"){echo "disabled";}?> type="radio" name="cFinal_e<? echo $i;?>" value="3" id="cFinal<? echo $i;?>" <? echo $res['revision_final_e']=='3'?'checked':""; ?>/> 
3

                       <input <? echo $disabled;?> <? if($tipo_usuario=="Jefe"){echo "disabled";}?> type="radio" name="cFinal_e<? echo $i;?>" value="4" id="cFinal<? echo $i;?>" <? echo $res['revision_final_e']=='4'?'checked':""; ?>/>
                                              4
                     <!--  <input <? echo $disabled;?> <? if($tipo_usuario=="Jefe"){echo "disabled";}?> type="radio" name="cFinal_e<? echo $i;?>" value="5" id="cFinal<? echo $i;?>" <? echo $res['revision_final_e']=='5'?'checked':""; ?>/> 
                                              5--></label></td>
                                      </tr>
                                      <tr>
                                        <td width="32%">
									
                                          <label>
                                              <? $disabled = ( $verFinal==10 /*|| $verFinal==9*/)?'disabled':'';?>
                                              Supervisor Rating :
                       <input <? echo $disabled;?><? if($tipo_usuario=="User"){echo "disabled";}?> type="radio" name="cFinal<? echo $i;?>" value="1" id="cFinal<? echo $i;?>" <? echo $res['revision_final']=='1'?'checked':""; ?>/>
                                              1
                       <input <? echo $disabled;?><? if($tipo_usuario=="User"){echo "disabled";}?> type="radio" name="cFinal<? echo $i;?>" value="2" id="cFinal<? echo $i;?>" <? echo $res['revision_final']=='2'?'checked':""; ?>/>
2 
						<input <? echo $disabled;?><? if($tipo_usuario=="User"){echo "disabled";}?> type="radio" name="cFinal<? echo $i;?>" value="3" id="cFinal<? echo $i;?>" <? echo $res['revision_final']=='3'?'checked':""; ?>/> 
3

                       <input <? echo $disabled;?><? if($tipo_usuario=="User"){echo "disabled";}?> type="radio" name="cFinal<? echo $i;?>" value="4" id="cFinal<? echo $i;?>" <? echo $res['revision_final']=='4'?'checked':""; ?>/>
                                              4
                       <!--<input <? echo $disabled;?><? if($tipo_usuario=="User"){echo "disabled";}?> type="radio" name="cFinal<? echo $i;?>" value="5" id="cFinal<? echo $i;?>" <? echo $res['revision_final']=='5'?'checked':""; ?>/> 
                                              5--></label></td>
                                        </tr>
                                      <tr>
                                        <td><strong>Employee Comments</strong></td>
                                        </tr>
                                      <tr>
                                        <td><? if( $verFinal==8 ){?>
                                          <textarea name="comentario_e_f[]" cols="40" rows="4" class="texto_tareas" id="comentario_e_f[]"><? echo $res['comentario_e_f'];?></textarea>
&nbsp;
<? } else echo $res['comentario_e_f'];?></td>
                                      </tr>
                                    </table></td>
                                    </tr>
                                </table>                                </td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td align="left" valign="top" class="texto_tareas">&nbsp;</td>
                          </tr>
                            <? if( ($verFinal==9 || $verFinal==10 ) ){?>
                          <tr>
                            <td align="left" valign="top" class="texto_tareas"><strong>Supervisor/Manager Comments:</strong>                            </td>
                          </tr>
                            <tr><td>
                                  &nbsp;<? if( $verFinal==9  ){?>
                                  <textarea name="comentario_j_f[]" cols="60" rows="5" class="texto_tareas" id="comentario_j_f[]"><?
                              echo $res['comentario_j_f'];?></textarea>
                                  <? } else echo $res['comentario_j_f'];?></td></tr>
                          <? } else {?>
                            <tr><td></td></tr>
                            <? }?>
						  <tr>
                            <td><img src="images/spacer.gif" alt="" width="10" height="20" />
                                
                                <? if( ($verFinal==8 && $ver==0) || ($verFinal==9  && $ver==0) ){?>
                                <a href="javascript:guardarFinal();" onmouseout="MM_swapImgRestore()" 
                                   onmouseover="MM_swapImage('Image31<?echo"$i";?>','','images/b_guardar_r.png',1)">
                                    <img src="images/b_guardar.png" alt="" name="Image31<?echo"$i";?>" width="69" height="23" border="0" id="Image31<?echo"$i";?>2" />                                </a>
                            <? }
							if( ($verFinal==8  && $ver==1) || ($verFinal==9  && $ver==3) ){?>
                                <a href="javascript:guardarFinalDes();" onmouseout="MM_swapImgRestore()" 
                                   onmouseover="MM_swapImage('Image31<?echo"$i";?>','','images/b_guardar_r.png',1)">
                                    <img src="images/b_guardar.png" alt="" name="Image31<?echo"$i";?>" width="69" height="23" border="0" id="Image31<?echo"$i";?>2" />                                </a>
                            <? }?></td>
                          </tr>
                        </table>
                        <? }?>                        </td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>

                <tr>
                  <td><div align="center"><img src="images/spacer.gif" width="10" height="20" />
                      <? if(($ver=="1" || $ver=="3")&& $etapa==1){?>
					  <a href="javascript:guardar();" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image31<?echo"$i";?>','','images/b_guardar_r.png',1)"><img src="images/b_guardar.png" name="Image31<?echo"$i";?>" width="69" height="23" border="0" id="Image31<?echo"$i";?>" /></a><? }?>
                  </div></td>
                </tr>
              </table>
			  <?
			  }
			  ?>
			   <? 
			   //echo"$verFinal $etapa";
			   if( ((($verFinal==10 ) || ($verFinal==9 )) && $etapa>=3 && $tipo_usuario=="Jefe")  ){//|| $etapa==4?>
              <table width="200" border="1" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td bgcolor="#FFFFFF"><div align="center">Final Rating </div></td>
                </tr>
                <tr>
                  <td><div align="center">
				  <? if($verFinal!="9") $disabled="disabled"; else $disabled="";?>
                    <input <? echo $disabled;?> type="radio" name="rFinal" value="1" id="rFinal" <? echo $planes[8]=='1'?'checked':""; ?>/>
                    1
                    <input <? echo $disabled;?> type="radio" name="rFinal" value="2" id="rFinal" <? echo $planes[8]=='2'?'checked':""; ?>/>
                    2
  <input <? echo $disabled;?> type="radio" name="rFinal" value="3" id="rFinal" <? echo $planes[8]=='3'?'checked':""; ?>/>
                    3
  <input <? echo $disabled;?> type="radio" name="rFinal" value="4" id="rFinal" <? echo $planes[8]=='4'?'checked':""; ?>/>
                    4
  <!--<input <? echo $disabled;?> type="radio" name="rFinal" value="5" id="rFinal" <? echo $planes[8]=='5'?'checked':""; ?>/>
                    5--> </div></td>
                </tr>
                <tr>
                  <td bgcolor="#FFFFFF"><div align="center">Clasification</div></td>
                </tr>
                <tr>
                  <td>
                    <div align="center">
                      <input <? echo $disabled;?> type="radio" name="clasFinal" value="1" id="clasFinal" <? echo $planes[9]=='1'?'checked':""; ?>/>
                      1
                      <input <? echo $disabled;?> type="radio" name="clasFinal" value="2" id="clasFinal" <? echo $planes[9]=='2'?'checked':""; ?>/>
                      2
                      <input <? echo $disabled;?> type="radio" name="clasFinal" value="3" id="clasFinal" <? echo $planes[9]=='3'?'checked':""; ?>/>
                      3</div></td>
                </tr>
              </table>
			  <? }?>
              <p align="center">&nbsp;</p>
              <p align="center">
                <?
				//firma cierre final
				 if( (($verFinal==8 && $ver==0) || ($verFinal==9 && $ver==0)) && $etapa==3){?>
                  <a href="javascript:firmarFinal(<? echo !$entroEmpleado?'true':'false';?>);" onmouseout="MM_swapImgRestore()" 
                   onmouseover="MM_swapImage('Image11','','images/b_firmar_r.png',1)"> <img src="images/b_firmar.png" name="Image11" width="61" height="23" border="0" id="Image11" /></a>
                  <? }
				  //firma cierre final con objetivos desbloqueados
				 if( (($verFinal==8 && $ver==1) || ($verFinal==9 && $ver==1))&& $etapa==3 ){?>
                  <a href="javascript:firmarFinalDes(<? echo !$entroEmpleado?'true':'false';?>);" onmouseout="MM_swapImgRestore()" 
                   onmouseover="MM_swapImage('Image111','','images/b_firmar_r.png',1)"><img src="images/b_firmar.png" name="Image111" width="61" height="23" border="0" id="Image111" /></a>
                  <? }?>
				  
                <?
				//firma check point 
				 if( (($verChP==5 && $ver==0) || ($verChP==6 && $ver==0)) && $etapa==2){?>
                <a href="javascript:firmarMidYearReview(<? echo !$entroEmpleado?'true':'false';?>);" onmouseout="MM_swapImgRestore()" 
                   onmouseover="MM_swapImage('Image1','','images/b_firmar_r.png',1)">
                  <img src="images/b_firmar.png" name="Image1" width="61" height="23" border="0" id="Image1" /></a>
                <? }?>
                <? 
				//firma check point con objetivos desbloqueados
				if( (($verChP==5 && $ver==1) || ($verChP==6 && $ver==3)) && $etapa==2){?>
                <a href="javascript:firmarMidYearReviewDes(<? echo !$entroEmpleado?'true':'false';?>);" onmouseout="MM_swapImgRestore()" 
                   onmouseover="MM_swapImage('Image1','','images/b_firmar_r.png',1)">
                  <img src="images/b_firmar.png" name="Image1" width="61" height="23" border="0" id="Image1" /></a>
                <? }?>
                <? if($ver=="1" && $etapa==1){?>
                <a href="javascript:firmar();" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image32','','images/b_firmar_r.png',1)"><img src="images/b_firmar.png" name="Image32" width="61" height="23" border="0" id="Image32" /></a>
                <input name="firma1" type="hidden" id="firma1" />
                <? }?>
                <? if($ver=="3" && $etapa==1){?>
                <a href="javascript:firmarR();" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image321','','images/b_firmar_r.png',1)"><img src="images/b_firmar.png" name="Image321" width="61" height="23" border="0" id="Image321" /></a>
                <input name="firma2" type="hidden" id="firma2" />
                <? }?>
              </p>
              <p align="center">
			  <? if($_SESSION["idA"]=="1" && $firma1e!="0000-00-00"){?>
                <input name="desfirmar_planeacion" type="submit" id="desfirmar_planeacion" value="Desfirmar Planeación" />
              
			  <? }?>
            <? if($_SESSION["idA"]=="1" && $verChP == 7){?>
                <input name="desfirmarMidYearReview" type="submit" id="desfirmar_MidYearReview" value="Desfirmar Mid Year Review" />
            <? } ?>
			 <? if($_SESSION["idA"]=="1" && $firma3e!=null){?>
                <input name="desbloquearMidYearReview" type="submit" id="desbloquearMidYearReview" value="Desbloquear Mid Year Review" />
            <? } ?>
            <? if($_SESSION["idA"]=="1" && $verChP == 7){?>
            <input name="desfirmarCierre" type="submit" id="desfirmarCierre" value="Desfirmar Cierre Objetivos" />
            <? } ?>
            <? if($_SESSION["idA"]=="1" && $firma3e!=null){?>
            <input name="desbloquearCierre" type="submit" id="desbloquearCierre" value="Desbloquear Cierre Objetivos" />
            <? } ?>
</p></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="images/spacer.gif" width="10" height="50" /></td>
      </tr>
      <tr>
        <td><table width="386" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="145"><a href="cambia_pass.php?id=<?echo"$idU";?>" class="iframe2" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image21','','images/b_cambio_r.png',1)"><img src="images/b_cambio.png" name="Image21" width="145" height="23" border="0" id="Image21" /></a></td>
            <td><img src="images/spacer.gif" width="16" height="20" /></td>
            <td width="114">
			 <? if($_SESSION["idA"]=="1"){?>
			<a href="admin.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image24','','images/b_administracion_r.png',1)"><img src="images/b_administracion.png" name="Image24" width="114" height="23" border="0" id="Image24" /></a>
			<? }?>			</td>
            <td><img src="images/spacer.gif" width="17" height="20" /></td>
            <td><a href="logout.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image25','','images/b_log_out_r.png',1)"><img src="images/b_log_out.png" name="Image25" width="71" height="23" border="0" id="Image25" /></a></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="images/spacer.gif" width="10" height="20" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="17" valign="top" background="images/bkg_azul.jpg"><img src="images/spacer.gif" width="10" height="17" /></td>
  </tr>
</table>
</form>
</body>
</html>
