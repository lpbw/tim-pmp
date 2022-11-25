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
$impacto2="";
$impacto3="";
$impacto4="";
$impacto5="";
$impacto6="";

$ponderacion="";
$ponderacion2="";
$ponderacion3="";
$ponderacion4="";
$ponderacion5="";
$ponderacion6="";


if($idU==$verobjetivos){
$tipo_usuario="User";
}
else{$tipo_usuario="Jefe";
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
	$descripcion2=$_POST["descripcion2"];
	$impacto=$_POST["impacto"];
	$impacto2=$_POST["impacto2"];
	$impacto3=$_POST["impacto3"];
	$impacto4=$_POST["impacto4"];
	$impacto5=$_POST["impacto5"];
	$impacto6=$_POST["impacto6"];
	
	$ponderacion=$_POST["ponderacion"];
	$ponderacion2=$_POST["ponderacion2"];
	$ponderacion3=$_POST["ponderacion3"];
	$ponderacion4=$_POST["ponderacion4"];
	$ponderacion5=$_POST["ponderacion5"];
	$ponderacion6=$_POST["ponderacion6"];
	
	
	
	if($plan=="" || $plan==null)
	{
		
		$consulta  = "insert into planes(id_empleado, revision, estatus) value($verobjetivos, $revision, 0)";
		$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );
		$num=1;
		for($i=0 ; $i<5 ; $i++)
		{
			$inicio=$_POST["inicio".$num];
			$fin=$_POST["fin".$num];
			$fechat = explode('-', $inicio);
			$finicio="$fechat[2]-$fechat[1]-$fechat[0]";
			$fechat = explode('-', $fin);
			$ffin="$fechat[2]-$fechat[1]-$fechat[0]";
			$obj=($objetivo[$i]);
			$des=($descripcion[$i]);
			$des2=($descripcion2[$i]);
			$imp=($impacto[$i]);
			$imp2=($impacto2[$i]);
			$imp3=($impacto3[$i]);
			$imp4=($impacto4[$i]);
			$imp5=($impacto5[$i]);
			$imp6=($impacto6[$i]);
			
			$ponder=($ponderacion[$i]);
			$ponder2=($ponderacion2[$i]);
			$ponder3=($ponderacion3[$i]);
			$ponder4=($ponderacion4[$i]);
			$ponder5=($ponderacion5[$i]);
			$ponder6=($ponderacion6[$i]);
			
			
			
			$consulta  = "insert into objetivos2(id_empleado, numero, nombre, descripcion, impacto, f_inicio, f_fin, revision, impacto2, impacto3, impacto4, impacto5, impacto6, ponderacion, ponderacion2, ponderacion3, ponderacion4, ponderacion5, ponderacion6, descripcion2) value($verobjetivos, $num, '$obj', '$des', '$imp', '$finicio', '$ffin', $revision, '$imp2', '$imp3', '$imp4', '$imp5', '$imp6', '$ponder', '$ponder2', '$ponder3', '$ponder4', '$ponder5', '$ponder6', '$des2')";
			$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: $consulta". mysqli_error($enlace) );
			$num++;
		}
	}else
	{
		//
		$num=1;
		for($i=0 ; $i<5 ; $i++)
		{
			$inicio=$_POST["inicio".$num];
			$fin=$_POST["fin".$num];
			$fechat = explode('-', $inicio);
			$finicio="$fechat[2]-$fechat[1]-$fechat[0]";
			$fechat = explode('-', $fin);
			$ffin="$fechat[2]-$fechat[1]-$fechat[0]";
			$obj=($objetivo[$i]);
			$des=($descripcion[$i]);
			$des2=($descripcion2[$i]);
			$imp=($impacto[$i]);
			$imp2=($impacto2[$i]);
			$imp3=($impacto3[$i]);
			$imp4=($impacto4[$i]);
			$imp5=($impacto5[$i]);
			$imp6=($impacto6[$i]);
			
			$ponder=($ponderacion[$i]);
			$ponder2=($ponderacion2[$i]);
			$ponder3=($ponderacion3[$i]);
			$ponder4=($ponderacion4[$i]);
			$ponder5=($ponderacion5[$i]);
			$ponder6=($ponderacion6[$i]);
			
			
			
			$consulta  = "update objetivos2 set  nombre='$obj', descripcion='$des', impacto='$imp', f_inicio='$finicio', f_fin='$ffin', impacto2='$imp2', impacto3='$imp3', impacto4='$imp4', impacto5='$imp5', impacto6='$imp6', ponderacion='$ponder', ponderacion2='$ponder2', ponderacion3='$ponder3', ponderacion4='$ponder4', ponderacion5='$ponder5', ponderacion6='$ponder6', descripcion2='$des2'
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
	for($i=1;$i<=5; $i++){
        $query = "UPDATE objetivos2 SET coment{$tipo}_midYearReview='".mysqli_real_escape_string($enlace,$_POST['coment'.$tipo.'_midYearReview'][$i-1])."',
            midCheckpoint = '{$_POST["midCheckpoint$i"]}' WHERE id_empleado = $verobjetivos AND numero = $i AND revision = '{$_POST["revision"]}';";
        $result = mysqli_query($enlace,$query) or print(' No se actualizado tu checkpoint');
    }
	}else{
	for($i=1;$i<=5; $i++){
        $query = "UPDATE objetivos2 SET coment{$tipo}_midYearReview='".mysqli_real_escape_string($enlace,$_POST['coment'.$tipo.'_midYearReview'][$i-1])."',
            midCheckpoint = '{$_POST["midCheckpoint_e$i"]}', midCheckpoint_e = '{$_POST["midCheckpoint_e$i"]}' WHERE id_empleado = $verobjetivos AND numero = $i AND revision = '{$_POST["revision"]}';";
        $result = mysqli_query($enlace,$query) or print(' No se actualizado tu checkpoint');
    }
	}
}
if( isset($_POST['guardarMidYearReview'])){
    
    if(isset($_POST['comentUser_midYearReview']))
	{
        $tipo = 'User';
    for($i=1;$i<=5; $i++){
        $query = "UPDATE objetivos2 SET coment{$tipo}_midYearReview='".mysqli_real_escape_string($enlace,$_POST['coment'.$tipo.'_midYearReview'][$i-1])."',
            midCheckpoint_e = '{$_POST["midCheckpoint_e$i"]}' WHERE id_empleado = $verobjetivos AND numero = $i AND revision = '{$_POST["revision"]}';";
        //echo"1 $query";
		$result = mysqli_query($enlace,$query) or print(' No se actualizado tu checkpoint');
    }
	}
	else
	{
	 $tipo = 'Jefe';
    for($i=1;$i<=5; $i++){
        $query = "UPDATE objetivos2 SET coment{$tipo}_midYearReview='".mysqli_real_escape_string($enlace,$_POST['coment'.$tipo.'_midYearReview'][$i-1])."',
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
    for($i=1;$i<=5; $i++){
			$query = "UPDATE objetivos2 SET comentario_{$tipo}_f='".mysqli_real_escape_string($enlace,$_POST['comentario_'.$tipo.'_f'][$i-1])."', 
			revision_final='{$_POST["cFinal$i"]}',
			revision_final2='{$_POST["cFinal2$i"]}',
			revision_final3='{$_POST["cFinal3$i"]}',
			revision_final4='{$_POST["cFinal4$i"]}',
			revision_final5='{$_POST["cFinal5$i"]}',
			revision_final6='{$_POST["cFinal6$i"]}'
				 WHERE id_empleado = $verobjetivos AND numero = $i AND revision = '{$_POST["revision"]}';";
		   // echo"$query ";
			$result = mysqli_query($enlace,$query) or print(' No se actualizado tu revision final');
		}
    
	if($tipo=="j")
	{
		$query = "UPDATE planes SET resultado_obj='{$_POST['rFinal']}', comentario_final_j = '{$_POST['comentario_final_j']}', clasificacion = '{$_POST['clasFinal']}' WHERE id_empleado = $verobjetivos  AND revision = '{$_POST["revision"]}';";
		$result = mysqli_query($enlace,$query) or print(' No se actualizado tu revision final');
	}else
	{
		for($i=1;$i<=5; $i++){
			$query = "UPDATE objetivos2 SET 
				revision_final = '{$_POST["cFinal_e$i"]}',
				revision_final2 = '{$_POST["cFinal_e2$i"]}',
				revision_final3 = '{$_POST["cFinal_e3$i"]}',
				revision_final4 = '{$_POST["cFinal_e4$i"]}',
				revision_final5 = '{$_POST["cFinal_e5$i"]}',
				revision_final6 = '{$_POST["cFinal_e6$i"]}',
				 
				revision_final_e = '{$_POST["cFinal_e$i"]}',
				revision_final_e2 = '{$_POST["cFinal_e2$i"]}',
				revision_final_e3 = '{$_POST["cFinal_e3$i"]}',
				revision_final_e4 = '{$_POST["cFinal_e4$i"]}',
				revision_final_e5 = '{$_POST["cFinal_e5$i"]}',
				revision_final_e6 = '{$_POST["cFinal_e6$i"]}' 
				
				WHERE id_empleado = $verobjetivos AND numero = $i AND revision = '{$_POST["revision"]}';";
		   // echo"$query ";
			$result = mysqli_query($enlace,$query) or print(' No se actualizado tu revision final');
			
		}
		$query = "UPDATE planes SET  comentario_final = '{$_POST['comentario_final_e']}' WHERE id_empleado = $verobjetivos  AND revision = '{$_POST["revision"]}';";
		$result = mysqli_query($enlace,$query) or print(' No se actualizado tu revision final');	
	}
	if(isset($_POST['guardarFinalDes']) || isset($_POST['firmarFinalDes']))
	{
		
		$objetivo=$_POST["objetivo"];
		$descripcion=$_POST["descripcion"];
		$descripcion2=$_POST["descripcion2"];
		$impacto=$_POST["impacto"];
		$impacto2=$_POST["impacto2"];
		$impacto3=$_POST["impacto3"];
		$impacto4=$_POST["impacto4"];
		$impacto5=$_POST["impacto5"];
		$impacto6=$_POST["impacto6"];
		$ponderacion=$_POST["ponderacion"];
		$ponderacion2=$_POST["ponderacion2"];
		$ponderacion3=$_POST["ponderacion3"];
		$ponderacion4=$_POST["ponderacion4"];
		$ponderacion5=$_POST["ponderacion5"];
		$ponderacion6=$_POST["ponderacion6"];
		
		
		$num=1;
		for($i=0 ; $i<5 ; $i++)
		{
			$inicio=$_POST["inicio".$num];
			$fin=$_POST["fin".$num];
			$revision=$_POST['revision'];//se descomento esto
			$fechat = explode('-', $inicio);
			$finicio="$fechat[2]-$fechat[1]-$fechat[0]";
			$fechat = explode('-', $fin);
			$ffin="$fechat[2]-$fechat[1]-$fechat[0]";
			$obj=($objetivo[$i]);
			$des=($descripcion[$i]);
			$des2=($descripcion2[$i]);
			$imp=($impacto[$i]);
			$imp2=($impacto2[$i]);
			$imp3=($impacto3[$i]);
			$imp4=($impacto4[$i]);
			$imp5=($impacto5[$i]);
			$imp6=($impacto6[$i]);
			
			$ponder=($ponderacion[$i]);
			$ponder2=($ponderacion2[$i]);
			$ponder3=($ponderacion3[$i]);
			$ponder4=($ponderacion4[$i]);
			$ponder5=($ponderacion5[$i]);
			$ponder6=($ponderacion6[$i]);
			
			
			
			$consulta  = "update objetivos2 set  nombre='$obj', descripcion='$des', impacto='$imp', f_inicio='$finicio', f_fin='$ffin', impacto2='$imp2', impacto3='$imp3', impacto4='$imp4', impacto5='$imp5', impacto6='$imp6', ponderacion='$ponder', ponderacion2='$ponder2', ponderacion3='$ponder3', ponderacion4='$ponder4', ponderacion5='$ponder5', ponderacion6='$ponder6', descripcion2='$des2'
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
    //echo"$query";   
    $result = mysqli_query($enlace,$query) or die('No se actualizado tu checkpoint1');
    
    for($i=1;$i<=5; $i++){
        $query = "UPDATE objetivos2 SET coment{$tipo}_midYearReview='".mysqli_real_escape_string($enlace,$_POST['coment'.$tipo.'_midYearReview'][$i-1])."',
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
	$descripcion2=$_POST["descripcion2"];
	$impacto=$_POST["impacto"];
	$impacto2=$_POST["impacto2"];
	$impacto3=$_POST["impacto3"];
	$impacto4=$_POST["impacto4"];
	$impacto5=$_POST["impacto5"];
	$impacto6=$_POST["impacto6"];
	
	$ponderacion=$_POST["ponderacion"];
	$ponderacion2=$_POST["ponderacion2"];
	$ponderacion3=$_POST["ponderacion3"];
	$ponderacion4=$_POST["ponderacion4"];
	$ponderacion5=$_POST["ponderacion5"];
	$ponderacion6=$_POST["ponderacion6"];
	
	
	
	if($plan=="" || $plan==null)
	{
		
		$consulta  = "insert into planes(id_empleado, revision, estatus) value($verobjetivos, $revision, 0)";
		$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );
		$num=1;
		for($i=0 ; $i<5 ; $i++)
		{
			$inicio=$_POST["inicio".$num];
			$fin=$_POST["fin".$num];
			$fechat = explode('-', $inicio);
			$finicio="$fechat[2]-$fechat[1]-$fechat[0]";
			$fechat = explode('-', $fin);
			$ffin="$fechat[2]-$fechat[1]-$fechat[0]";
			$obj=($objetivo[$i]);
			$des=($descripcion[$i]);
			$des2=($descripcion2[$i]);
			$imp=($impacto[$i]);
			$imp2=($impacto2[$i]);
			$imp3=($impacto3[$i]);
			$imp4=($impacto4[$i]);
			$imp5=($impacto5[$i]);
			$imp6=($impacto6[$i]);
			
			$ponder=($ponderacion[$i]);
			$ponder2=($ponderacion2[$i]);
			$ponder3=($ponderacion3[$i]);
			$ponder4=($ponderacion4[$i]);
			$ponder5=($ponderacion5[$i]);
			$ponder6=($ponderacion6[$i]);
			
		
			
			$consulta  = "insert into objetivos2(id_empleado, numero, nombre, descripcion, impacto, f_inicio, f_fin, revision, impacto2, impacto3, impacto4, impacto5, impacto6, ponderacion, ponderacion2, ponderacion3, ponderacion4, ponderacion5, ponderacion6, descripcion2) value($verobjetivos, $num, '$obj', '$des', '$imp', '$finicio', '$ffin', $revision, '$imp2', '$imp3', '$imp4', '$imp5', '$imp6', '$ponder', '$ponder2', '$ponder3', '$ponder4', '$ponder5', '$ponder6', '$des2')";
			$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: $consulta". mysqli_error($enlace) );
			$num++;
		}
	}else
	{
		//
		$num=1;
		for($i=0 ; $i<5 ; $i++)
		{
			$inicio=$_POST["inicio".$num];
			$fin=$_POST["fin".$num];
			$fechat = explode('-', $inicio);
			$finicio="$fechat[2]-$fechat[1]-$fechat[0]";
			$fechat = explode('-', $fin);
			$ffin="$fechat[2]-$fechat[1]-$fechat[0]";
			$obj=($objetivo[$i]);
			$des=($descripcion[$i]);
			$des2=($descripcion2[$i]);
			$imp=($impacto[$i]);
			$imp2=($impacto2[$i]);
			$imp3=($impacto3[$i]);
			$imp4=($impacto4[$i]);
			$imp5=($impacto5[$i]);
			$imp6=($impacto6[$i]);
			
			$ponder=($ponderacion[$i]);
			$ponder2=($ponderacion2[$i]);
			$ponder3=($ponderacion3[$i]);
			$ponder4=($ponderacion4[$i]);
			$ponder5=($ponderacion5[$i]);
			$ponder6=($ponderacion6[$i]);
			
			
			
			$consulta  = "update objetivos2 set  nombre='$obj', descripcion='$des', impacto='$imp', f_inicio='$finicio', f_fin='$ffin', impacto2='$imp2', impacto3='$imp3', impacto4='$imp4', impacto5='$imp5', impacto6='$imp6', ponderacion='$ponder', ponderacion2='$ponder2', ponderacion3='$ponder3', ponderacion4='$ponder4', ponderacion5='$ponder5', ponderacion6='$ponder6', descripcion2='$des2'
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
		//$etapa=1;
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
	$consulta  = "SELECT id, estatus, firma_e_i, firma_e_f, firma_j_i, firma_j_f,firmaUser_midYearReview, firmaJefe_midYearReview, resultado_obj, clasificacion, comentario_final, comentario_final_j from planes where id_empleado=$verobjetivos and revision=$revision";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta todo fall&oacute;P1: $consulta " . mysqli_error($enlace));//. mysqli_error($enlace)	
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
		$comentario_final_e=$res[10];
		$comentario_final_j=$res[11];
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
				if($firma2e!="0000-00-00" && $firma2j!="0000-00-00" && $idU==$jefe)
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
function revisaCalif(){
	<? $numero=1;
	for($i=0 ; $i<5 ; $i++)
	{ ?>
								
								if(document.form1.pact[<? echo $i?>].value>0 && (document.form1.cFinal_e<? echo $numero?>[0].checked==false && document.form1.cFinal_e<? echo $numero?>[1].checked==false && document.form1.cFinal_e<? echo $numero?>[2].checked==false && document.form1.cFinal_e<? echo $numero?>[3].checked==false))
								{
									alert("No tiene calificacion objetivo <? echo $numero?>");
									document.form1.cFinal_e<? echo $numero?>[0].focus();
									return false;
								}else{
								if(document.form1.pact2[<? echo $i?>].value>0 && (document.form1.cFinal_e2<? echo $numero?>[0].checked==false && document.form1.cFinal_e2<? echo $numero?>[1].checked==false && document.form1.cFinal_e2<? echo $numero?>[2].checked==false && document.form1.cFinal_e2<? echo $numero?>[3].checked==false))
								{
									alert("No tiene calificacion objetivo <? echo $numero?>");
									document.form1.cFinal_e2<? echo $numero?>[0].focus();
									return false;
								}else{
								if(document.form1.pact3[<? echo $i?>].value>0 && (document.form1.cFinal_e3<? echo $numero?>[0].checked==false && document.form1.cFinal_e3<? echo $numero?>[1].checked==false && document.form1.cFinal_e3<? echo $numero?>[2].checked==false && document.form1.cFinal_e3<? echo $numero?>[3].checked==false))
								{
									alert("No tiene calificacion objetivo <? echo $numero?>");
									document.form1.cFinal_e3<? echo $numero?>[0].focus();
									return false;
								}else{
								if(document.form1.pact4[<? echo $i?>].value>0 && (document.form1.cFinal_e4<? echo $numero?>[0].checked==false && document.form1.cFinal_e4<? echo $numero?>[1].checked==false && document.form1.cFinal_e4<? echo $numero?>[2].checked==false && document.form1.cFinal_e4<? echo $numero?>[3].checked==false))
								{
									alert("No tiene calificacion objetivo <? echo $numero?>");
									document.form1.cFinal_e4<? echo $numero?>[0].focus();
									return false;
								}else{
								if(document.form1.pact5[<? echo $i?>].value>0 && (document.form1.cFinal_e5<? echo $numero?>[0].checked==false && document.form1.cFinal_e5<? echo $numero?>[1].checked==false && document.form1.cFinal_e5<? echo $numero?>[2].checked==false && document.form1.cFinal_e5<? echo $numero?>[3].checked==false))
								{
									alert("No tiene calificacion objetivo <? echo $numero?>");
									document.form1.cFinal_e5<? echo $numero?>[0].focus();
									return false;
								}else{
								if(document.form1.pact6[<? echo $i?>].value!="" && (document.form1.cFinal_e6<? echo $numero?>[0].checked==false && document.form1.cFinal_e6<? echo $numero?>[1].checked==false && document.form1.cFinal_e6<? echo $numero?>[2].checked==false && document.form1.cFinal_e6<? echo $numero?>[3].checked==false))
								{
									alert("No tiene calificacion objetivo <? echo $numero?>");
									document.form1.cFinal_e6<? echo $numero?>[0].focus();
									return false;
								}else{} }}}}}
	<? $numero++;
	} ?> 
	
	return true;
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
function firmarFinal(){
    if(revisaCalif()==true){
        var element = document.createElement('input');
        element.name = 'firmarFinal';
        element.value = 1;
        document.form1.appendChild(element);
        document.form1.submit();
    }
}
function firmarFinalDes(){
    if(revisaCalif()==true){
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
					/* if(document.form1.objetivo[5].value!="" && document.form1.midCheckpoint6[0].checked==false && document.form1.midCheckpoint6[1].checked==false && document.form1.midCheckpoint6[2].checked==false){
                document.form1.midCheckpoint6[0].focus();
                alert('Falto evaluacion de objetivo 6');
                return false;
		  			}*/
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
					/* if(document.form1.objetivo[5].value!="" && document.form1.midCheckpoint_e6[0].checked==false && document.form1.midCheckpoint_e6[1].checked==false && document.form1.midCheckpoint_e6[2].checked==false){
                document.form1.midCheckpoint6[0].focus();
                alert('Falto evaluacion de objetivo 6');
                return false;
		  			}*/
					 }
					 }
				 }
			 }
		  }
}
    var txtAU = document.getElementsByName('comentUser_midYearReview[]');
    var txtAJ = document.getElementsByName('comentJefe_midYearReview[]');
    for(var i=0 ; i<5 ; i++){
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
    for(var i=0 ; i<5 ; i++){
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
<body>
<!---->
<form method="post" name="form1" action="">
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
			for($i=1 ; $i<=5 ; $i++)
			{
				$ob="";
				$de="";
				$inicio="";
				$fin="";
				$im="";
				$im2="";
				$im3="";
				$im4="";
				$im5="";
				$im6="";
				$pon="";
				$pon2="";
				$pon3="";
				$pon4="";
				$pon5="";
				$pon6="";
				$consulta  = "
                                    SELECT nombre, descripcion, DATE_FORMAT(f_inicio,'%d-%m-%Y'), DATE_FORMAT(f_fin,'%d-%m-%Y'), impacto,
                                        comentUser_midYearReview, comentJefe_midYearReview, midCheckpoint,midCheckpoint_e, revision_final,revision_final_e, comentario_e_f, comentario_j_f, impacto2, impacto3, impacto4, impacto5, ponderacion, ponderacion2, ponderacion3, ponderacion4, ponderacion5, ponderacion6, impacto6, descripcion2, revision_final2, revision_final3, revision_final4, revision_final5, revision_final6, revision_final_e2, revision_final_e3, revision_final_e4, revision_final_e5, revision_final_e6
                                    from objetivos2 where id_empleado=$verobjetivos 
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
					$im2=stripcslashes($res[13]);
					$im3=stripcslashes($res[14]);
					$im4=stripcslashes($res[15]);
					$im5=stripcslashes($res[16]);
					$im6=stripcslashes($res[23]);
					
					$pon=stripcslashes($res[17]);
					$pon2=stripcslashes($res[18]);
					$pon3=stripcslashes($res[19]);
					$pon4=stripcslashes($res[20]);
					$pon5=stripcslashes($res[21]);
					$pon6=stripcslashes($res[22]);
					
					
					
					$de2=stripcslashes($res[24]);
				}
				$j=$i-1;
			?><script>

function cambiar<? echo $i?>()
{
var index=document.forms.form1.objetivo[<? echo $j?>].selectedIndex;
form1.descripcion[<? echo $j?>].length=0;
form1.descripcion2[<? echo $j?>].length=0;
if(index==0){ objetivo0<? echo $i?>();}
if(index==1){ objetivo1<? echo $i?>();}
if(index==2){ objetivo2<? echo $i?>();}
if(index==3){ objetivo3<? echo $i?>();}
if(index==4){ objetivo4<? echo $i?>();}
if(index==5){ objetivo5<? echo $i?>();}


form1.impacto[<? echo $j?>].length=0;
form1.impacto2[<? echo $j?>].length=0;
form1.impacto3[<? echo $j?>].length=0;
form1.impacto4[<? echo $j?>].length=0;
form1.impacto5[<? echo $j?>].length=0;

if(index==0){ des0<? echo $i?>()};
if(index==1){ des1<? echo $i?>()};
if(index==2){ des2<? echo $i?>()};
if(index==3){ des3<? echo $i?>()};
if(index==4){ des4<? echo $i?>()};
if(index==5){ des5<? echo $i?>()};

}
function objetivo0<? echo $i?>(){
opcion0=new Option("--Selecciona--","0","defauldSelected");
opcion20=new Option("--Selecciona--","0","defauldSelected");
document.forms.form1.descripcion[<? echo $j?>].options[0]=opcion0;
document.forms.form1.descripcion2[<? echo $j?>].options[0]=opcion20;
des0<? echo $i?>();
}
function objetivo1<? echo $i?>(){
opcion0=new Option("--Selecciona--","0","defauldSelected");
opcion20=new Option("--Selecciona--","0","defauldSelected");
document.forms.form1.descripcion[<? echo $j?>].options[0]=opcion0;
document.forms.form1.descripcion2[<? echo $j?>].options[0]=opcion20;
		<? 
		$query = "SELECT * from lags where id_io=1 order by id";
        $result = mysqli_query($enlace,$query) or print("<option value=\"ERROR\">".mysqli_error($enlace)."</option>");
		$count=1;
        while($lags = mysqli_fetch_assoc($result)){ 
         ?>       
opcion<? echo $lags['id']?>=new Option("<? echo $lags['nombre']?>","<? echo $lags['id']?>", "", "<? echo $de==$lags['id']?"selected":""; ?>");
opcion2<? echo $lags['id']?>=new Option("<? echo $lags['nombre']?>","<? echo $lags['id']?>", "", "<? echo $de2==$lags['id']?"selected":""; ?>");
document.forms.form1.descripcion[<? echo $j?>].options[<? echo $count?>]=opcion<? echo $lags['id']?>;
document.forms.form1.descripcion2[<? echo $j?>].options[<? echo $count?>]=opcion2<? echo $lags['id']?>;
<?
$count++;
}
?>
}

function objetivo2<? echo $i?>(){
opcion0=new Option("--Selecciona--","0","defauldSelected");
opcion20=new Option("--Selecciona--","0","defauldSelected");
document.forms.form1.descripcion[<? echo $j?>].options[0]=opcion0;
document.forms.form1.descripcion2[<? echo $j?>].options[0]=opcion20;
		<? 
		$query = "SELECT * from lags where id_io=2 order by id";
        $result = mysqli_query($enlace,$query) or print("<option value=\"ERROR\">".mysqli_error($enlace)."</option>");
		$count=1;
        while($lags = mysqli_fetch_assoc($result)){
         ?>       
opcion<? echo $lags['id']?>=new Option("<? echo $lags['nombre']?>","<? echo $lags['id']?>", "", "<? echo $de==$lags['id']?"selected":""; ?>");
opcion2<? echo $lags['id']?>=new Option("<? echo $lags['nombre']?>","<? echo $lags['id']?>", "", "<? echo $de2==$lags['id']?"selected":""; ?>");
document.forms.form1.descripcion[<? echo $j?>].options[<? echo $count?>]=opcion<? echo $lags['id']?>;
document.forms.form1.descripcion2[<? echo $j?>].options[<? echo $count?>]=opcion2<? echo $lags['id']?>;
<?
$count++;
}							
?>		
}

function objetivo3<? echo $i?>(){
opcion0=new Option("--Selecciona--","0","defauldSelected");
opcion20=new Option("--Selecciona--","0","defauldSelected");
document.forms.form1.descripcion[<? echo $j?>].options[0]=opcion0;
document.forms.form1.descripcion2[<? echo $j?>].options[0]=opcion20;
		<? 
		$query = "SELECT * from lags where id_io=3 order by id";
        $result = mysqli_query($enlace,$query) or print("<option value=\"ERROR\">".mysqli_error($enlace)."</option>");
		$count=1;
        while($lags = mysqli_fetch_assoc($result)){
        ?>       
opcion<? echo $lags['id']?>=new Option("<? echo $lags['nombre']?>","<? echo $lags['id']?>", "", "<? echo $de==$lags['id']?"selected":""; ?>");
opcion2<? echo $lags['id']?>=new Option("<? echo $lags['nombre']?>","<? echo $lags['id']?>", "", "<? echo $de2==$lags['id']?"selected":""; ?>");
document.forms.form1.descripcion[<? echo $j?>].options[<? echo $count?>]=opcion<? echo $lags['id']?>;
document.forms.form1.descripcion2[<? echo $j?>].options[<? echo $count?>]=opcion2<? echo $lags['id']?>;
<?
$count++;
}
?>		
}

function objetivo4<? echo $i?>(){
opcion0=new Option("--Selecciona--","0","defauldSelected");
opcion20=new Option("--Selecciona--","0","defauldSelected");
document.forms.form1.descripcion[<? echo $j?>].options[0]=opcion0;
document.forms.form1.descripcion2[<? echo $j?>].options[0]=opcion20;
		<? 
		$query = "SELECT * from lags where id_io=4 order by id";
        $result = mysqli_query($enlace,$query) or print("<option value=\"ERROR\">".mysqli_error($enlace)."</option>");
		$count=1;
        while($lags = mysqli_fetch_assoc($result)){
        ?>       
opcion<? echo $lags['id']?>=new Option("<? echo $lags['nombre']?>","<? echo $lags['id']?>", "", "<? echo $de==$lags['id']?"selected":""; ?>");
opcion2<? echo $lags['id']?>=new Option("<? echo $lags['nombre']?>","<? echo $lags['id']?>", "", "<? echo $de2==$lags['id']?"selected":""; ?>");
document.forms.form1.descripcion[<? echo $j?>].options[<? echo $count?>]=opcion<? echo $lags['id']?>;
document.forms.form1.descripcion2[<? echo $j?>].options[<? echo $count?>]=opcion2<? echo $lags['id']?>;
<?
$count++;
}
?>		
}

function objetivo5<? echo $i?>(){
opcion0=new Option("--Selecciona--","0","defauldSelected");
opcion20=new Option("--Selecciona--","0","defauldSelected");
document.forms.form1.descripcion[<? echo $j?>].options[0]=opcion0;
document.forms.form1.descripcion2[<? echo $j?>].options[0]=opcion20;
		<? 
		$query = "SELECT * from lags where id_io=5 order by id";
        $result = mysqli_query($enlace,$query) or print("<option value=\"ERROR\">".mysqli_error($enlace)."</option>");
		$count=1;
        while($lags = mysqli_fetch_assoc($result)){
        ?>       
opcion<? echo $lags['id']?>=new Option("<? echo $lags['nombre']?>","<? echo $lags['id']?>", "", "<? echo $de==$lags['id']?"selected":""; ?>");
opcion2<? echo $lags['id']?>=new Option("<? echo $lags['nombre']?>","<? echo $lags['id']?>", "", "<? echo $de2==$lags['id']?"selected":""; ?>");
document.forms.form1.descripcion[<? echo $j?>].options[<? echo $count?>]=opcion<? echo $lags['id']?>;
document.forms.form1.descripcion2[<? echo $j?>].options[<? echo $count?>]=opcion2<? echo $lags['id']?>;
<?
$count++;
}							                         
?>
}


function des0<? echo $i?>(){
opcion0=new Option("--Selecciona--","0","defauldSelected");
document.forms.form1.impacto[<? echo $j?>].options[0]=opcion0;
opcion10=new Option("--Selecciona--","0","defauldSelected");
document.forms.form1.impacto2[<? echo $j?>].options[0]=opcion10;
opcion20=new Option("--Selecciona--","0","defauldSelected");
document.forms.form1.impacto3[<? echo $j?>].options[0]=opcion20;
opcion30=new Option("--Selecciona--","0","defauldSelected");
document.forms.form1.impacto4[<? echo $j?>].options[0]=opcion30;
opcion40=new Option("--Selecciona--","0","defauldSelected");
document.forms.form1.impacto5[<? echo $j?>].options[0]=opcion40;
}
function des1<? echo $i?>(){
opcion0=new Option("--Selecciona--","0","defauldSelected");
document.forms.form1.impacto[<? echo $j?>].options[0]=opcion0;
opcion20=new Option("--Selecciona--","0","defauldSelected");
document.forms.form1.impacto2[<? echo $j?>].options[0]=opcion20;
opcion30=new Option("--Selecciona--","0","defauldSelected");
document.forms.form1.impacto3[<? echo $j?>].options[0]=opcion30;
opcion40=new Option("--Selecciona--","0","defauldSelected");
document.forms.form1.impacto4[<? echo $j?>].options[0]=opcion40;
opcion50=new Option("--Selecciona--","0","defauldSelected");
document.forms.form1.impacto5[<? echo $j?>].options[0]=opcion50;
		<? 
		$query = "SELECT leads.id, leads.nombre FROM leads where id_io=1";
        $result = mysqli_query($enlace,$query) or print("<option value=\"ERROR\">".mysqli_error($enlace)."</option>");
		$count=1;
        while($lags = mysqli_fetch_assoc($result)){
		
        ?>       
opcion<? echo $lags['id']?>=new Option("<? echo $lags['nombre']?>","<? echo $lags['id']?>", "", "<? echo $im==$lags['id']?"selected":""; ?>");
document.forms.form1.impacto[<? echo $j?>].options[<? echo $count?>]=opcion<? echo $lags['id']?>;

opcion2<? echo $lags['id']?>=new Option("<? echo $lags['nombre']?>","<? echo $lags['id']?>", "", "<? echo $im2==$lags['id']?"selected":""; ?>");
document.forms.form1.impacto2[<? echo $j?>].options[<? echo $count?>]=opcion2<? echo $lags['id']?>;

opcion3<? echo $lags['id']?>=new Option("<? echo $lags['nombre']?>","<? echo $lags['id']?>", "", "<? echo $im3==$lags['id']?"selected":""; ?>");
document.forms.form1.impacto3[<? echo $j?>].options[<? echo $count?>]=opcion3<? echo $lags['id']?>;

opcion4<? echo $lags['id']?>=new Option("<? echo $lags['nombre']?>","<? echo $lags['id']?>", "", "<? echo $im4==$lags['id']?"selected":""; ?>");
document.forms.form1.impacto4[<? echo $j?>].options[<? echo $count?>]=opcion4<? echo $lags['id']?>;

opcion5<? echo $lags['id']?>=new Option("<? echo $lags['nombre']?>","<? echo $lags['id']?>", "", "<? echo $im5==$lags['id']?"selected":""; ?>");
document.forms.form1.impacto5[<? echo $j?>].options[<? echo $count?>]=opcion5<? echo $lags['id']?>;
		<?
		
		$count++;
		}							                         
		?>
}
function des2<? echo $i?>(){
opcion0=new Option("--Selecciona--","0","defauldSelected");
document.forms.form1.impacto[<? echo $j?>].options[0]=opcion0;
opcion20=new Option("--Selecciona--","0","defauldSelected");
document.forms.form1.impacto2[<? echo $j?>].options[0]=opcion20;
opcion30=new Option("--Selecciona--","0","defauldSelected");
document.forms.form1.impacto3[<? echo $j?>].options[0]=opcion30;
opcion40=new Option("--Selecciona--","0","defauldSelected");
document.forms.form1.impacto4[<? echo $j?>].options[0]=opcion40;
opcion50=new Option("--Selecciona--","0","defauldSelected");
document.forms.form1.impacto5[<? echo $j?>].options[0]=opcion50;
		<? 
		$query = "SELECT leads.id, leads.nombre FROM leads where id_io=2";
        $result = mysqli_query($enlace,$query) or print("<option value=\"ERROR\">".mysqli_error($enlace)."</option>");
		$count=1;
        while($lags = mysqli_fetch_assoc($result)){
        ?>       
opcion<? echo $lags['id']?>=new Option("<? echo $lags['nombre']?>","<? echo $lags['id']?>", "", "<? echo $im==$lags['id']?"selected":""; ?>");
document.forms.form1.impacto[<? echo $j?>].options[<? echo $count?>]=opcion<? echo $lags['id']?>;

opcion2<? echo $lags['id']?>=new Option("<? echo $lags['nombre']?>","<? echo $lags['id']?>", "", "<? echo $im2==$lags['id']?"selected":""; ?>");
document.forms.form1.impacto2[<? echo $j?>].options[<? echo $count?>]=opcion2<? echo $lags['id']?>;

opcion3<? echo $lags['id']?>=new Option("<? echo $lags['nombre']?>","<? echo $lags['id']?>", "", "<? echo $im3==$lags['id']?"selected":""; ?>");
document.forms.form1.impacto3[<? echo $j?>].options[<? echo $count?>]=opcion3<? echo $lags['id']?>;

opcion4<? echo $lags['id']?>=new Option("<? echo $lags['nombre']?>","<? echo $lags['id']?>", "", "<? echo $im4==$lags['id']?"selected":""; ?>");
document.forms.form1.impacto4[<? echo $j?>].options[<? echo $count?>]=opcion4<? echo $lags['id']?>;

opcion5<? echo $lags['id']?>=new Option("<? echo $lags['nombre']?>","<? echo $lags['id']?>", "", "<? echo $im5==$lags['id']?"selected":""; ?>");
document.forms.form1.impacto5[<? echo $j?>].options[<? echo $count?>]=opcion5<? echo $lags['id']?>;
		<?
		$count++;
		}							                         
		?>
}
function des3<? echo $i?>(){
opcion0=new Option("--Selecciona--","0","defauldSelected");
document.forms.form1.impacto[<? echo $j?>].options[0]=opcion0;
opcion20=new Option("--Selecciona--","0","defauldSelected");
document.forms.form1.impacto2[<? echo $j?>].options[0]=opcion20;
opcion30=new Option("--Selecciona--","0","defauldSelected");
document.forms.form1.impacto3[<? echo $j?>].options[0]=opcion30;
opcion40=new Option("--Selecciona--","0","defauldSelected");
document.forms.form1.impacto4[<? echo $j?>].options[0]=opcion40;
opcion50=new Option("--Selecciona--","0","defauldSelected");
document.forms.form1.impacto5[<? echo $j?>].options[0]=opcion50;
		<? 
		$query = "SELECT leads.id, leads.nombre FROM leads where id_io=3";
        $result = mysqli_query($enlace,$query) or print("<option value=\"ERROR\">".mysqli_error($enlace)."</option>");
		$count=1;
        while($lags = mysqli_fetch_assoc($result)){
        ?>       
opcion<? echo $lags['id']?>=new Option("<? echo $lags['nombre']?>","<? echo $lags['id']?>", "", "<? echo $im==$lags['id']?"selected":""; ?>");
document.forms.form1.impacto[<? echo $j?>].options[<? echo $count?>]=opcion<? echo $lags['id']?>;

opcion2<? echo $lags['id']?>=new Option("<? echo $lags['nombre']?>","<? echo $lags['id']?>", "", "<? echo $im2==$lags['id']?"selected":""; ?>");
document.forms.form1.impacto2[<? echo $j?>].options[<? echo $count?>]=opcion2<? echo $lags['id']?>;

opcion3<? echo $lags['id']?>=new Option("<? echo $lags['nombre']?>","<? echo $lags['id']?>", "", "<? echo $im3==$lags['id']?"selected":""; ?>");
document.forms.form1.impacto3[<? echo $j?>].options[<? echo $count?>]=opcion3<? echo $lags['id']?>;

opcion4<? echo $lags['id']?>=new Option("<? echo $lags['nombre']?>","<? echo $lags['id']?>", "", "<? echo $im4==$lags['id']?"selected":""; ?>");
document.forms.form1.impacto4[<? echo $j?>].options[<? echo $count?>]=opcion4<? echo $lags['id']?>;

opcion5<? echo $lags['id']?>=new Option("<? echo $lags['nombre']?>","<? echo $lags['id']?>", "", "<? echo $im5==$lags['id']?"selected":""; ?>");
document.forms.form1.impacto5[<? echo $j?>].options[<? echo $count?>]=opcion5<? echo $lags['id']?>;
		<?
		$count++;
		}							                         
		?>
}
function des4<? echo $i?>(){
opcion0=new Option("--Selecciona--","0","defauldSelected");
document.forms.form1.impacto[<? echo $j?>].options[0]=opcion0;
opcion20=new Option("--Selecciona--","0","defauldSelected");
document.forms.form1.impacto2[<? echo $j?>].options[0]=opcion20;
opcion30=new Option("--Selecciona--","0","defauldSelected");
document.forms.form1.impacto3[<? echo $j?>].options[0]=opcion30;
opcion40=new Option("--Selecciona--","0","defauldSelected");
document.forms.form1.impacto4[<? echo $j?>].options[0]=opcion40;
opcion50=new Option("--Selecciona--","0","defauldSelected");
document.forms.form1.impacto5[<? echo $j?>].options[0]=opcion50;
		<? 
		$query = "SELECT leads.id, leads.nombre FROM leads where id_io=4";
        $result = mysqli_query($enlace,$query) or print("<option value=\"ERROR\">".mysqli_error($enlace)."</option>");
		$count=1;
        while($lags = mysqli_fetch_assoc($result)){
        ?>       
opcion<? echo $lags['id']?>=new Option("<? echo $lags['nombre']?>","<? echo $lags['id']?>", "", "<? echo $im==$lags['id']?"selected":""; ?>");
document.forms.form1.impacto[<? echo $j?>].options[<? echo $count?>]=opcion<? echo $lags['id']?>;

opcion2<? echo $lags['id']?>=new Option("<? echo $lags['nombre']?>","<? echo $lags['id']?>", "", "<? echo $im2==$lags['id']?"selected":""; ?>");
document.forms.form1.impacto2[<? echo $j?>].options[<? echo $count?>]=opcion2<? echo $lags['id']?>;

opcion3<? echo $lags['id']?>=new Option("<? echo $lags['nombre']?>","<? echo $lags['id']?>", "", "<? echo $im3==$lags['id']?"selected":""; ?>");
document.forms.form1.impacto3[<? echo $j?>].options[<? echo $count?>]=opcion3<? echo $lags['id']?>;

opcion4<? echo $lags['id']?>=new Option("<? echo $lags['nombre']?>","<? echo $lags['id']?>", "", "<? echo $im4==$lags['id']?"selected":""; ?>");
document.forms.form1.impacto4[<? echo $j?>].options[<? echo $count?>]=opcion4<? echo $lags['id']?>;

opcion5<? echo $lags['id']?>=new Option("<? echo $lags['nombre']?>","<? echo $lags['id']?>", "", "<? echo $im5==$lags['id']?"selected":""; ?>");
document.forms.form1.impacto5[<? echo $j?>].options[<? echo $count?>]=opcion5<? echo $lags['id']?>;
		<?
		$count++;
		}							                         
		?>
}
function des5<? echo $i?>(){
opcion0=new Option("--Selecciona--","0","defauldSelected");
document.forms.form1.impacto[<? echo $j?>].options[0]=opcion0;
opcion20=new Option("--Selecciona--","0","defauldSelected");
document.forms.form1.impacto2[<? echo $j?>].options[0]=opcion20;
opcion30=new Option("--Selecciona--","0","defauldSelected");
document.forms.form1.impacto3[<? echo $j?>].options[0]=opcion30;
opcion40=new Option("--Selecciona--","0","defauldSelected");
document.forms.form1.impacto4[<? echo $j?>].options[0]=opcion40;
opcion50=new Option("--Selecciona--","0","defauldSelected");
document.forms.form1.impacto5[<? echo $j?>].options[0]=opcion50;
		<? 
		$query = "SELECT leads.id, leads.nombre FROM leads where id_io=5";
        $result = mysqli_query($enlace,$query) or print("<option value=\"ERROR\">".mysqli_error($enlace)."</option>");
		$count=1;
        while($lags = mysqli_fetch_assoc($result)){
        ?>       
opcion<? echo $lags['id']?>=new Option("<? echo $lags['nombre']?>","<? echo $lags['id']?>", "", "<? echo $im==$lags['id']?"selected":""; ?>");
document.forms.form1.impacto[<? echo $j?>].options[<? echo $count?>]=opcion<? echo $lags['id']?>;

opcion2<? echo $lags['id']?>=new Option("<? echo $lags['nombre']?>","<? echo $lags['id']?>", "", "<? echo $im2==$lags['id']?"selected":""; ?>");
document.forms.form1.impacto2[<? echo $j?>].options[<? echo $count?>]=opcion2<? echo $lags['id']?>;

opcion3<? echo $lags['id']?>=new Option("<? echo $lags['nombre']?>","<? echo $lags['id']?>", "", "<? echo $im3==$lags['id']?"selected":""; ?>");
document.forms.form1.impacto3[<? echo $j?>].options[<? echo $count?>]=opcion3<? echo $lags['id']?>;

opcion4<? echo $lags['id']?>=new Option("<? echo $lags['nombre']?>","<? echo $lags['id']?>", "", "<? echo $im4==$lags['id']?"selected":""; ?>");
document.forms.form1.impacto4[<? echo $j?>].options[<? echo $count?>]=opcion4<? echo $lags['id']?>;

opcion5<? echo $lags['id']?>=new Option("<? echo $lags['nombre']?>","<? echo $lags['id']?>", "", "<? echo $im5==$lags['id']?"selected":""; ?>");
document.forms.form1.impacto5[<? echo $j?>].options[<? echo $count?>]=opcion5<? echo $lags['id']?>;
		<?
		$count++;
		}							                         
		?>
}
</script>
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
                                          <td height="20" bgcolor="#ced0d1" class="usuario"><img src="images/spacer.gif" width="10" height="10" />1. IO Principie:</td>
                                        </tr>
                                    </table></td>
                                  </tr>
                                  <tr>
                                    <td><label>
									<? if($ver=="1" || $ver=="3"){?>
                                  <!--<input name="objetivo[]" type="text" class="texto_tareas" id="objetivo" value="<?echo"$ob";?>" size="60" />-->
									  
						<select name="objetivo[<? echo $j?>]"  class="texto_tareas" style="width:300px" id="objetivo" onChange="cambiar<? echo $i?>();">
                          	<option value="">--Selecciona--</option>
						  <? 
						  	$query = "SELECT * from io_principies where revision=$revision order by id";
                            $result = mysqli_query($enlace,$query) or print("<option value=\"ERROR\">".mysqli_error($enlace)."</option>");
                            while($io = mysqli_fetch_assoc($result)){?>
                          	<option value="<? echo $io['id']?>" <? echo $ob==$io['id']?"selected":""; ?> ><? echo $io['nombre']?></option>
                          <?
                            }
                          ?>
                        </select>
                                      
                                    <? }else{?>
									 <div align="left" class="texto_tareas"><? 
	$consulta99  = "SELECT * from io_principies where id=$ob";
	$resultado99 = mysqli_query($enlace,$consulta99); //or die("La consulta fall&oacute;P1:$consulta99  ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	if(@mysqli_num_rows($resultado99)>=1)
	{
		$res99=mysqli_fetch_row($resultado99);
		$nombre99=$res99[1];
		echo"$nombre99";
	}
									 
									 ?><input name="objetivo" type="hidden" id="objetivo" value="<?echo"$ob";?>" />
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
                                          <td height="20" bgcolor="#ced0d1" class="usuario"><img src="images/spacer.gif" width="10" height="10" />2. Lag Indicator:</td>
                                        </tr>
                                    </table></td>
                                  </tr>
                                  <tr>
                                    <td><label>
                                     
									  <? if($ver=="1" || $ver=="3"){?>
                         <!--<textarea name="descripcion[]" cols="60" rows="5" class="texto_tareas" id="descripcion"><?echo"$de";?></textarea>-->
						
						<select name="descripcion[<? echo $j?>]"  class="texto_tareas" style="width:300px" id="descripcion" >
                          	<option value="">--Selecciona--</option>
                        </select>
						<select name="descripcion2[<? echo $j?>]"  class="texto_tareas" style="width:300px" id="descripcion2" >
                          	<option value="">--Selecciona--</option>
                        </select>
                                    <? }else{?>
									 <div align="left" class="texto_tareas"><? 
	$consulta98  = "SELECT * from lags where id=$de";
	$resultado98 = mysqli_query($enlace,$consulta98); // or die("La consulta fall&oacute;P1:$consulta98  ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	if(@mysqli_num_rows($resultado98)>=1)
	{
		$res98=mysqli_fetch_row($resultado98);
		$nombre98=$res98[1];
		echo"$nombre98";
	}
	echo"<br/>";
	$consulta91  = "SELECT * from lags where id=$de2";
	$resultado91 = mysqli_query($enlace,$consulta91); // or die("La consulta fall&oacute;P1:$consulta98  ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	if(@mysqli_num_rows($resultado91)>=1)
	{
		$res91=mysqli_fetch_row($resultado91);
		$nombre91=$res91[1];
		echo"$nombre91";
	}
									 ?></div>
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
                                          <td height="20" bgcolor="#ced0d1" class="usuario"><img src="images/spacer.gif" width="10" height="10" />3. Lead Indicators:</td>
                                        </tr>
                                    </table></td>
                                  </tr>
								  <!--Lead1-->
                                  <tr>
                                    <td><label>
									   <? if($ver=="1" || $ver=="3"){?>
                                     <!--<textarea name="impacto[]" cols="60" rows="5" class="texto_tareas" id="impacto"><?echo"$im";?></textarea>-->
						<select name="impacto[<? echo $j?>]"  class="texto_tareas" style="width:215px" id="impacto">
                          	<option value="">--Selecciona--</option>
						  
                        </select>
						<input name="ponderacion[]" type="text" class="texto_tareas" id="ponderacion" value="<? echo"$pon";?>" size="2" /><span class="texto_tareas">%</span>      
								    <? }else{?>
									 <div align="left" class="texto_tareas"><? 
	$consulta97  = "SELECT * from leads where id=$im";
	$resultado97 = mysqli_query($enlace,$consulta97); //or die("La consulta fall&oacute;P1:$consulta97  ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	if(@mysqli_num_rows($resultado97)>=1)
	{
		$res97=mysqli_fetch_row($resultado97);
		$nombre97=$res97[1];
		echo"$nombre97-<b>$pon%</b>";
	}
									 
									 ?></div>
									 <? }?>
									 <input type="hidden" name="pact[<? echo $j?>]" id="pact" value="<? echo $im?>">
                                    </label>
									<? if($etapa>=3){?>
									<label class="texto_tareas">
                                              <? $disabled == ( $verFinal==10 || $verFinal==9)?'disabled':'';?>
                                              Employee Rating :
                       <input <? echo $disabled;?> <? if($tipo_usuario=="Jefe"){echo "disabled";}?> type="radio" name="cFinal_e<? echo $i;?>" value="1" id="cFinal<? echo $i;?>" <? echo $res['revision_final_e']=='1'?'checked':""; ?> <? if($im>0){echo "required";}?>/>
                                              1
                       <input <? echo $disabled;?> <? if($tipo_usuario=="Jefe"){echo "disabled";}?> type="radio" name="cFinal_e<? echo $i;?>" value="2" id="cFinal<? echo $i;?>" <? echo $res['revision_final_e']=='2'?'checked':""; ?>/>
2 
						<input <? echo $disabled;?> <? if($tipo_usuario=="Jefe"){echo "disabled";}?> type="radio" name="cFinal_e<? echo $i;?>" value="3" id="cFinal<? echo $i;?>" <? echo $res['revision_final_e']=='3'?'checked':""; ?>/> 
3

                       <input <? echo $disabled;?> <? if($tipo_usuario=="Jefe"){echo "disabled";}?> type="radio" name="cFinal_e<? echo $i;?>" value="4" id="cFinal<? echo $i;?>" <? echo $res['revision_final_e']=='4'?'checked':""; ?>/>
                                              4
                     </label>
					 <br/>
					 <label class="texto_tareas">
                                              <? $disabled == ( $verFinal==10 /*|| $verFinal==9*/)?'disabled':'';?>
                                              Supervisor Rating :
                       <input <? echo $disabled;?><? if($tipo_usuario=="User"){echo "disabled";}?> type="radio" name="cFinal<? echo $i;?>" value="1" id="cFinal<? echo $i;?>" <? echo $res['revision_final']=='1'?'checked':""; ?>/>
                                              1
                       <input <? echo $disabled;?><? if($tipo_usuario=="User"){echo "disabled";}?> type="radio" name="cFinal<? echo $i;?>" value="2" id="cFinal<? echo $i;?>" <? echo $res['revision_final']=='2'?'checked':""; ?>/>
2 
						<input <? echo $disabled;?><? if($tipo_usuario=="User"){echo "disabled";}?> type="radio" name="cFinal<? echo $i;?>" value="3" id="cFinal<? echo $i;?>" <? echo $res['revision_final']=='3'?'checked':""; ?>/> 
3

                       <input <? echo $disabled;?><? if($tipo_usuario=="User"){echo "disabled";}?> type="radio" name="cFinal<? echo $i;?>" value="4" id="cFinal<? echo $i;?>" <? echo $res['revision_final']=='4'?'checked':""; ?>/>
                                              4
                       </label>
					   <br/>
					   <br/>
					 <? }?>
									</td>
                                  </tr>
								  <!--Lead2-->
								  <tr>
                                    <td><label>
									   <? if($ver=="1" || $ver=="3"){?>
                                     <!--<textarea name="impacto[]" cols="60" rows="5" class="texto_tareas" id="impacto"><?echo"$im";?></textarea>-->
						<select name="impacto2[<? echo $j?>]"  class="texto_tareas" style="width:215px" id="impacto2">
                          	<option value="">--Selecciona--</option>
						  
                        </select>
						<input name="ponderacion2[]" type="text" class="texto_tareas" id="ponderacion2" value="<? echo"$pon2";?>" size="2" /><span class="texto_tareas">%</span>
                                   
									<? }else{?>
									 <div align="left" class="texto_tareas"><? 
	$consulta97  = "SELECT * from leads where id=$im2";
	$resultado97 = mysqli_query($enlace,$consulta97); //or die("La consulta fall&oacute;P1:$consulta97  ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	if(@mysqli_num_rows($resultado97)>=1)
	{
		$res97=mysqli_fetch_row($resultado97);
		$nombre97=$res97[1];
		echo"$nombre97-<b>$pon2%</b>";
	}
									 
									 ?></div>
									 <? }?>
									 <input type="hidden" name="pact2[<? echo $j?>]" id="pact2" value="<? echo $im2?>">
                                    </label>
									<? if($etapa>=3){?>
									
									<label class="texto_tareas">
                                              <? $disabled == ( $verFinal==10 || $verFinal==9)?'disabled':'';?>
                                              Employee Rating :
                       <input <? echo $disabled;?> <? if($tipo_usuario=="Jefe"){echo "disabled";}?> type="radio" name="cFinal_e2<? echo $i;?>" value="1" id="cFinal2<? echo $i;?>" <? echo $res['revision_final_e2']=='1'?'checked':""; ?> <? if($im2>0){echo "required";}?>/>
                                              1
                       <input <? echo $disabled;?> <? if($tipo_usuario=="Jefe"){echo "disabled";}?> type="radio" name="cFinal_e2<? echo $i;?>" value="2" id="cFinal2<? echo $i;?>" <? echo $res['revision_final_e2']=='2'?'checked':""; ?>/>
2 
						<input <? echo $disabled;?> <? if($tipo_usuario=="Jefe"){echo "disabled";}?> type="radio" name="cFinal_e2<? echo $i;?>" value="3" id="cFinal2<? echo $i;?>" <? echo $res['revision_final_e2']=='3'?'checked':""; ?>/> 
3

                       <input <? echo $disabled;?> <? if($tipo_usuario=="Jefe"){echo "disabled";}?> type="radio" name="cFinal_e2<? echo $i;?>" value="4" id="cFinal2<? echo $i;?>" <? echo $res['revision_final_e2']=='4'?'checked':""; ?>/>
                                              4
                     </label>
					 <br/>
					 <label class="texto_tareas">
                                              <? $disabled == ( $verFinal==10 /*|| $verFinal==9*/)?'disabled':'';?>
                                              Supervisor Rating :
                       <input <? echo $disabled;?><? if($tipo_usuario=="User"){echo "disabled";}?> type="radio" name="cFinal2<? echo $i;?>" value="1" id="cFinal2<? echo $i;?>" <? echo $res['revision_final2']=='1'?'checked':""; ?>/>
                                              1
                       <input <? echo $disabled;?><? if($tipo_usuario=="User"){echo "disabled";}?> type="radio" name="cFinal2<? echo $i;?>" value="2" id="cFinal2<? echo $i;?>" <? echo $res['revision_final2']=='2'?'checked':""; ?>/>
2 
						<input <? echo $disabled;?><? if($tipo_usuario=="User"){echo "disabled";}?> type="radio" name="cFinal2<? echo $i;?>" value="3" id="cFinal2<? echo $i;?>" <? echo $res['revision_final2']=='3'?'checked':""; ?>/> 
3

                       <input <? echo $disabled;?><? if($tipo_usuario=="User"){echo "disabled";}?> type="radio" name="cFinal2<? echo $i;?>" value="4" id="cFinal2<? echo $i;?>" <? echo $res['revision_final2']=='4'?'checked':""; ?>/>
                                              4
                       </label>
					   <br/>
					   <br/>
					 <? }?>
									</td>
                                  </tr>
								  <!--Lead3-->
								  <tr>
                                    <td><label> 
									   <? if($ver=="1" || $ver=="3"){?>
                                     <!--<textarea name="impacto[]" cols="60" rows="5" class="texto_tareas" id="impacto"><?echo"$im";?></textarea>-->
						<select name="impacto3[<? echo $j?>]"  class="texto_tareas" style="width:215px" id="impacto3">
                          	<option value="">--Selecciona--</option>
						  
                        </select>
						<input name="ponderacion3[]" type="text" class="texto_tareas" id="ponderacion3" value="<? echo"$pon3";?>" size="2" /><span class="texto_tareas">%</span>
                                   
									<? }else{?>
									 <div align="left" class="texto_tareas"><? 
	$consulta97  = "SELECT * from leads where id=$im3";
	$resultado97 = mysqli_query($enlace,$consulta97); //or die("La consulta fall&oacute;P1:$consulta97  ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	if(@mysqli_num_rows($resultado97)>=1)
	{
		$res97=mysqli_fetch_row($resultado97);
		$nombre97=$res97[1];
		echo"$nombre97-<b>$pon3%</b>";
	}
									 
									 ?></div>
									 <? }?>
									 <input type="hidden" name="pact3[<? echo $j?>]" id="pact3" value="<? echo $im3?>">
                                    </label>
									<? if($etapa>=3){?>
									
									<label class="texto_tareas">
                                              <? $disabled == ( $verFinal==10 || $verFinal==9)?'disabled':'';?>
                                              Employee Rating :
                       <input <? echo $disabled;?> <? if($tipo_usuario=="Jefe"){echo "disabled";}?> type="radio" name="cFinal_e3<? echo $i;?>" value="1" id="cFinal3<? echo $i;?>" <? echo $res['revision_final_e3']=='1'?'checked':""; ?> <? if($im3>0){echo "required";}?>/>
                                              1
                       <input <? echo $disabled;?> <? if($tipo_usuario=="Jefe"){echo "disabled";}?> type="radio" name="cFinal_e3<? echo $i;?>" value="2" id="cFinal3<? echo $i;?>" <? echo $res['revision_final_e3']=='2'?'checked':""; ?>/>
2 
						<input <? echo $disabled;?> <? if($tipo_usuario=="Jefe"){echo "disabled";}?> type="radio" name="cFinal_e3<? echo $i;?>" value="3" id="cFinal3<? echo $i;?>" <? echo $res['revision_final_e3']=='3'?'checked':""; ?>/> 
3

                       <input <? echo $disabled;?> <? if($tipo_usuario=="Jefe"){echo "disabled";}?> type="radio" name="cFinal_e3<? echo $i;?>" value="4" id="cFinal3<? echo $i;?>" <? echo $res['revision_final_e3']=='4'?'checked':""; ?>/>
                                              4
                     </label>
					 <br/>
					 <label class="texto_tareas">
                                              <? $disabled == ( $verFinal==10 /*|| $verFinal==9*/)?'disabled':'';?>
                                              Supervisor Rating :
                       <input <? echo $disabled;?><? if($tipo_usuario=="User"){echo "disabled";}?> type="radio" name="cFinal3<? echo $i;?>" value="1" id="cFinal3<? echo $i;?>" <? echo $res['revision_final3']=='1'?'checked':""; ?>/>
                                              1
                       <input <? echo $disabled;?><? if($tipo_usuario=="User"){echo "disabled";}?> type="radio" name="cFinal3<? echo $i;?>" value="2" id="cFinal3<? echo $i;?>" <? echo $res['revision_final3']=='2'?'checked':""; ?>/>
2 
						<input <? echo $disabled;?><? if($tipo_usuario=="User"){echo "disabled";}?> type="radio" name="cFinal3<? echo $i;?>" value="3" id="cFinal3<? echo $i;?>" <? echo $res['revision_final3']=='3'?'checked':""; ?>/> 
3

                       <input <? echo $disabled;?><? if($tipo_usuario=="User"){echo "disabled";}?> type="radio" name="cFinal3<? echo $i;?>" value="4" id="cFinal3<? echo $i;?>" <? echo $res['revision_final3']=='4'?'checked':""; ?>/>
                                              4
                       </label>
					   <br/>
					   <br/>
					 <? }?>
									</td>
                                  </tr>
								  <!--Lead4-->
								  <tr>
                                    <td><label>
									   <? if($ver=="1" || $ver=="3"){?>
                                     <!--<textarea name="impacto[]" cols="60" rows="5" class="texto_tareas" id="impacto"><?echo"$im";?></textarea>-->
						<select name="impacto4[<? echo $j?>]"  class="texto_tareas" style="width:215px" id="impacto4">
                          	<option value="">--Selecciona--</option>
						 
                        </select>
						<input name="ponderacion4[]" type="text" class="texto_tareas" id="ponderacion4" value="<? echo"$pon4";?>" size="2" /><span class="texto_tareas">%</span>
                                    
									<? }else{?>
									 <div align="left" class="texto_tareas"><? 
	$consulta97  = "SELECT * from leads where id=$im4";
	$resultado97 = mysqli_query($enlace,$consulta97); //or die("La consulta fall&oacute;P1:$consulta97  ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	if(@mysqli_num_rows($resultado97)>=1)
	{
		$res97=mysqli_fetch_row($resultado97);
		$nombre97=$res97[1];
		echo"$nombre97-<b>$pon4%</b>";
	}
									 
									 ?></div>
									 <? }?>
									 <input type="hidden" name="pact4[<? echo $j?>]" id="pact4" value="<? echo $im4?>">
                                    </label>
									<? if($etapa>=3){?>
									
									<label class="texto_tareas">
                                              <? $disabled == ( $verFinal==10 || $verFinal==9)?'disabled':'';?>
                                              Employee Rating :
                       <input <? echo $disabled;?> <? if($tipo_usuario=="Jefe"){echo "disabled";}?> type="radio" name="cFinal_e4<? echo $i;?>" value="1" id="cFinal4<? echo $i;?>" <? echo $res['revision_final_e4']=='1'?'checked':""; ?> <? if($im4>0){echo "required";}?>/>
                                              1
                       <input <? echo $disabled;?> <? if($tipo_usuario=="Jefe"){echo "disabled";}?> type="radio" name="cFinal_e4<? echo $i;?>" value="2" id="cFinal4<? echo $i;?>" <? echo $res['revision_final_e4']=='2'?'checked':""; ?>/>
2 
						<input <? echo $disabled;?> <? if($tipo_usuario=="Jefe"){echo "disabled";}?> type="radio" name="cFinal_e4<? echo $i;?>" value="3" id="cFinal4<? echo $i;?>" <? echo $res['revision_final_e4']=='3'?'checked':""; ?>/> 
3

                       <input <? echo $disabled;?> <? if($tipo_usuario=="Jefe"){echo "disabled";}?> type="radio" name="cFinal_e4<? echo $i;?>" value="4" id="cFinal4<? echo $i;?>" <? echo $res['revision_final_e4']=='4'?'checked':""; ?>/>
                                              4
                     </label>
					 <br/>
					 <label class="texto_tareas">
                                              <? $disabled == ( $verFinal==10 /*|| $verFinal==9*/)?'disabled':'';?>
                                              Supervisor Rating :
                       <input <? echo $disabled;?><? if($tipo_usuario=="User"){echo "disabled";}?> type="radio" name="cFinal4<? echo $i;?>" value="1" id="cFinal4<? echo $i;?>" <? echo $res['revision_final4']=='1'?'checked':""; ?>/>
                                              1
                       <input <? echo $disabled;?><? if($tipo_usuario=="User"){echo "disabled";}?> type="radio" name="cFinal4<? echo $i;?>" value="2" id="cFinal4<? echo $i;?>" <? echo $res['revision_final4']=='2'?'checked':""; ?>/>
2 
						<input <? echo $disabled;?><? if($tipo_usuario=="User"){echo "disabled";}?> type="radio" name="cFinal4<? echo $i;?>" value="3" id="cFinal4<? echo $i;?>" <? echo $res['revision_final4']=='3'?'checked':""; ?>/> 
3

                       <input <? echo $disabled;?><? if($tipo_usuario=="User"){echo "disabled";}?> type="radio" name="cFinal4<? echo $i;?>" value="4" id="cFinal4<? echo $i;?>" <? echo $res['revision_final4']=='4'?'checked':""; ?>/>
                                              4
                       </label>
					   <br/>
					   <br/>
					 <? }?>
									</td>
                                  </tr>
								  <!--Lead5-->
								  <tr>
                                    <td><label>
									   <? if($ver=="1" || $ver=="3"){?>
                                     <!--<textarea name="impacto[]" cols="60" rows="5" class="texto_tareas" id="impacto"><?echo"$im";?></textarea>-->
						<select name="impacto5[<? echo $j?>]"  class="texto_tareas" style="width:215px" id="impacto5">
                          	<option value="">--Selecciona--</option>
						  
                        </select>
						<input name="ponderacion5[]" type="text" class="texto_tareas" id="ponderacion5" value="<? echo"$pon5";?>" size="2" /><span class="texto_tareas">%</span>
                                   
								    <? }else{?>
									 <div align="left" class="texto_tareas"><? 
	$consulta97  = "SELECT * from leads where id=$im5";
	$resultado97 = mysqli_query($enlace,$consulta97);// or die("La consulta fall&oacute;P1:$consulta97  ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	if(@mysqli_num_rows($resultado97)>=1)
	{
		$res97=mysqli_fetch_row($resultado97);
		$nombre97=$res97[1];
		echo"$nombre97-<b>$pon5%</b>";
	}
									 
									 ?>
									 <? }?>
									 <input type="hidden" name="pact5[<? echo $j?>]" id="pact5" value="<? echo $im5?>"></div>
                                    </label>
									<? if($etapa>=3){?>
									
									<label class="texto_tareas">
                                              <? $disabled == ( $verFinal==10 || $verFinal==9)?'disabled':'';?>
                                              Employee Rating :
                       <input <? echo $disabled;?> <? if($tipo_usuario=="Jefe"){echo "disabled";}?> type="radio" name="cFinal_e5<? echo $i;?>" value="1" id="cFinal5<? echo $i;?>" <? echo $res['revision_final_e5']=='1'?'checked':""; ?> <? if($im5>0){echo "required";}?>/>
                                              1
                       <input <? echo $disabled;?> <? if($tipo_usuario=="Jefe"){echo "disabled";}?> type="radio" name="cFinal_e5<? echo $i;?>" value="2" id="cFinal5<? echo $i;?>" <? echo $res['revision_final_e5']=='2'?'checked':""; ?>/>
2 
						<input <? echo $disabled;?> <? if($tipo_usuario=="Jefe"){echo "disabled";}?> type="radio" name="cFinal_e5<? echo $i;?>" value="3" id="cFinal5<? echo $i;?>" <? echo $res['revision_final_e5']=='3'?'checked':""; ?>/> 
3

                       <input <? echo $disabled;?> <? if($tipo_usuario=="Jefe"){echo "disabled";}?> type="radio" name="cFinal_e5<? echo $i;?>" value="4" id="cFinal5<? echo $i;?>" <? echo $res['revision_final_e5']=='4'?'checked':""; ?>/>
                                              4
                     </label>
					 <br/>
					 <label class="texto_tareas">
                                              <? $disabled == ( $verFinal==10 /*|| $verFinal==9*/)?'disabled':'';?>
                                              Supervisor Rating :
                       <input <? echo $disabled;?><? if($tipo_usuario=="User"){echo "disabled";}?> type="radio" name="cFinal5<? echo $i;?>" value="1" id="cFinal5<? echo $i;?>" <? echo $res['revision_final5']=='1'?'checked':""; ?>/>
                                              1
                       <input <? echo $disabled;?><? if($tipo_usuario=="User"){echo "disabled";}?> type="radio" name="cFinal5<? echo $i;?>" value="2" id="cFinal5<? echo $i;?>" <? echo $res['revision_final5']=='2'?'checked':""; ?>/>
2 
						<input <? echo $disabled;?><? if($tipo_usuario=="User"){echo "disabled";}?> type="radio" name="cFinal5<? echo $i;?>" value="3" id="cFinal5<? echo $i;?>" <? echo $res['revision_final5']=='3'?'checked':""; ?>/> 
3

                       <input <? echo $disabled;?><? if($tipo_usuario=="User"){echo "disabled";}?> type="radio" name="cFinal5<? echo $i;?>" value="4" id="cFinal5<? echo $i;?>" <? echo $res['revision_final5']=='4'?'checked':""; ?>/>
                                              4
                       </label>
					   <br/>
					   <br/>
					 <? }?>
									</td>
                                  </tr>
								  <!-- Lead 6 abierto-->
								  <tr>
                                    <td><label>
									   <? if($ver=="1" || $ver=="3"){?>
                                     <!--<textarea name="impacto[]" cols="60" rows="5" class="texto_tareas" id="impacto"><?echo"$im";?></textarea>-->
					
        <input name="impacto6[<? echo $j?>]" type="text" class="texto_tareas" style="width:211px" id="impacto6" value="<? echo"$im6";?>" />
		<input name="ponderacion6[]" type="text" class="texto_tareas" id="ponderacion6" value="<? echo"$pon6";?>" size="2" /><span class="texto_tareas">%</span>
                                 
								    <? }else{?>
									 <div align="left" class="texto_tareas"><? 

		if($im6!="" && $pon6!=""){
		echo"$im6-<b>$pon6%</b>";
	}else{
	echo "&nbsp;";
	}
									 
									 ?></div>
									 <? }?>
									 <input type="hidden" name="pact6[<? echo $j?>]" id="pact6" value="<? echo $im6?>">
                                    </label>
									<? if($etapa>=3){?>
									
									<label class="texto_tareas">
                                              <? $disabled == ( $verFinal==10 || $verFinal==9)?'disabled':'';?>
                                              Employee Rating :
                       <input <? echo $disabled;?> <? if($tipo_usuario=="Jefe"){echo "disabled";}?> type="radio" name="cFinal_e6<? echo $i;?>" value="1" id="cFinal6<? echo $i;?>" <? echo $res['revision_final_e6']=='1'?'checked':""; ?> <? if($im6>0){echo "required";}?>/>
                                              1
                       <input <? echo $disabled;?> <? if($tipo_usuario=="Jefe"){echo "disabled";}?> type="radio" name="cFinal_e6<? echo $i;?>" value="2" id="cFinal6<? echo $i;?>" <? echo $res['revision_final_e6']=='2'?'checked':""; ?>/>
2 
						<input <? echo $disabled;?> <? if($tipo_usuario=="Jefe"){echo "disabled";}?> type="radio" name="cFinal_e6<? echo $i;?>" value="3" id="cFinal6<? echo $i;?>" <? echo $res['revision_final_e6']=='3'?'checked':""; ?>/> 
3

                       <input <? echo $disabled;?> <? if($tipo_usuario=="Jefe"){echo "disabled";}?> type="radio" name="cFinal_e6<? echo $i;?>" value="4" id="cFinal6<? echo $i;?>" <? echo $res['revision_final_e6']=='4'?'checked':""; ?>/>
                                              4
                     </label>
					 <br/>
					 <label class="texto_tareas">
                                              <? $disabled == ( $verFinal==10 /*|| $verFinal==9*/)?'disabled':'';?>
                                              Supervisor Rating :
                       <input <? echo $disabled;?><? if($tipo_usuario=="User"){echo "disabled";}?> type="radio" name="cFinal6<? echo $i;?>" value="1" id="cFinal6<? echo $i;?>" <? echo $res['revision_final6']=='1'?'checked':""; ?>/>
                                              1
                       <input <? echo $disabled;?><? if($tipo_usuario=="User"){echo "disabled";}?> type="radio" name="cFinal6<? echo $i;?>" value="2" id="cFinal6<? echo $i;?>" <? echo $res['revision_final6']=='2'?'checked':""; ?>/>
2 
						<input <? echo $disabled;?><? if($tipo_usuario=="User"){echo "disabled";}?> type="radio" name="cFinal6<? echo $i;?>" value="3" id="cFinal6<? echo $i;?>" <? echo $res['revision_final6']=='3'?'checked':""; ?>/> 
3

                       <input <? echo $disabled;?><? if($tipo_usuario=="User"){echo "disabled";}?> type="radio" name="cFinal6<? echo $i;?>" value="4" id="cFinal6<? echo $i;?>" <? echo $res['revision_final6']=='4'?'checked':""; ?>/>
                                              4
                       </label>
					   <br/>
					   <br/>
					 <? }?>
									</td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td><img src="images/spacer.gif" width="10" height="20" /></td>
                            </tr>
                            <tr>
                              <td><table width="350" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="410">&nbsp;</td>
                                  </tr>
                                  <tr> </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td><img src="images/spacer.gif" width="10" height="20" /></td>
                            </tr>
                        </table></td>
                        <td width="53"><img src="images/spacer.gif" width="52" height="20" /></td>
                        <td width="350" valign="top">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
						<td>
						<table width="300" border="0" cellspacing="2" cellpadding="0">
                                        <tr>
                                          <td height="20" bgcolor="#ced0d1" class="usuario"><img src="images/spacer.gif" width="10" height="10" /> 4. Beginning Date: </td>
                                          <td width="128" class="usuario">
										  <? if($ver=="1" || $ver=="3"){?>
                                       <input name="inicio<?echo"$i";?>" type="text" class="texto_tareas" id="inicio<?echo"$i";?>" value="<?echo"$inicio";?>" size="15" readonly/>
                                    <? }else{?>
									 	<div align="left" class="texto_tareas"><? echo"$inicio";?></div>
									 <? }?>										  </td>
                                        </tr>
                                    </table>									</td>
								  </tr>
									<tr>
									  <td>&nbsp;</td>
								  </tr>
									<tr>
									<td>
									<table width="300" border="0" cellspacing="2" cellpadding="0">
                                  <tr>
                                    <td height="20" bgcolor="#ced0d1" class="usuario"><img src="images/spacer.gif" width="10" height="10" /> 5. Due Date:</td>
                                    <td width="128" class="usuario">
									 <? if($ver=="1" || $ver=="3"){?>
                                       <input name="fin<?echo"$i";?>" type="text" class="texto_tareas" id="fin<?echo"$i";?>" value="<?echo"$fin";?>" size="15" readonly/>
                                    <? }else{?>
									 	<div align="left" class="texto_tareas"><? echo"$fin";?></div>
									 <? }?>									</td>
                                  </tr>
                              </table>
							  </td>
							  </tr>
							  <tr>
									  <td>&nbsp;</td>
								  </tr>
							  </table>
                            <? if($etapa==2){?>
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
                                              <? $disabled == ( $verChP==7 )?'disabled':'';?>
                                            <input <? echo $disabled;?> <? if($tipo_usuario=="Jefe"){echo "disabled";}?> type="radio" name="midCheckpoint_e<? echo $i;?>" value="BT" id="midCheckpoint_0" <? echo $res['midCheckpoint_e']=='BT'?'checked':""; ?>/>
                                            <span class="texto_rojo">Behind plan </span></label></td>
                                        <td width="16%"><label>
                                              <? $disabled == ( $verChP==7 )?'disabled':'';?>
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
                                        <td width="32%">&nbsp;</td>
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
			   <? if( (($verFinal==10 ) || ($verFinal==9 )) && $etapa>=3){?>
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
			  <p>
			    <? }?>
			    <? if(intval($etapa['etapa'])>=3){?>
			    </p>
			  <table width="471" border="0" align="center" cellpadding="0" cellspacing="0">
  
  <tr>
    <td><strong>Employee Final Comments:</strong></td>
  </tr>
  <tr>
    <td><div align="center">
	<? if($verFinal=="8" ){?>
      <textarea name="comentario_final_e" cols="60" rows="5" class="texto_tareas" id="comentario_final_e"><? echo $comentario_final_e;?></textarea>
	<? } else { echo "$comentario_final_e";}?>
    </div></td>
  </tr>
  <?  if($verFinal==9 || ($verFinal==10 && $etapa==4)){?>
  <tr>
    <td><strong>Supervisor/Manager Final Comments:</strong></td>
  </tr>
  <tr>
    <td><div align="center">
	<? if($verFinal=="9" ){?>
      <textarea name="comentario_final_j" cols="60" rows="5" class="texto_tareas" id="comentario_final_j"><? echo $comentario_final_j;?></textarea>
	<? } else { echo "$comentario_final_j";}?>
    </div></td>
  </tr>
  <? }?>
</table>

			  <p>
			    <? }?>
			  
			  
              <p align="center">&nbsp;</p>
              <p align="center">
                <?
				//firma cierre final
				 if( (($verFinal==8 && $ver==0) || ($verFinal==9 && $ver==0)) && $etapa==3){?>
                  <a href="javascript:firmarFinal(<? //echo !$entroEmpleado?'true':'false';?>);" onmouseout="MM_swapImgRestore()" 
                   onmouseover="MM_swapImage('Image11','','images/b_firmar_r.png',1)"> <img src="images/b_firmar.png" name="Image11" width="61" height="23" border="0" id="Image11" /></a>
                  <? }
				  //firma cierre final con objetivos desbloqueados
				 if( (($verFinal==8 && $ver==1) || ($verFinal==9 && $ver==1))&& $etapa==3 ){?>
                  <a href="javascript:firmarFinalDes(<? //echo !$entroEmpleado?'true':'false';?>);" onmouseout="MM_swapImgRestore()" 
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
<script> 

window.onload=function(){ 
cambiar1(); 
cambiar2();
cambiar3();
cambiar4();
cambiar5(); 

} 


</script> 
</form>
</body>
</html>
