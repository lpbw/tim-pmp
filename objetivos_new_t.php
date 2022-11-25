<?



ini_set("display_errors", 1);

ini_set("track_errors", 1);

ini_set("html_errors", 1);

ini_set("session.cookie_lifetime","7200"); 

ini_set("session.gc_maxlifetime","7200");

session_start();

include "checar_sesion_admin.php";

include "coneccion_i.php";

$idU=$_SESSION['idU'];

$soy_jefe = 1;

if($verobjetivos=="")

$verobjetivos=$idU;

$consulta = "SELECT * FROM usuarios WHERE id=$idU";

$resultado= mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: $consulta". mysqli_error($enlace));

$res = mysqli_fetch_assoc($resultado);

/* echo "<script>alert(".$res['id_jefe'].");</script>";*/



  $verobjetivos=$_POST["verobjetivos"];//id mi gente



/* echo "<script>alert(".$verobjetivos.");</script>";*/

if ($idU != $verobjetivos) {

  $soy_jefe = 0;// no es jefe

}

  // echo 'v='.$verobjetivos;

  // echo 'id='.$idU;



  $con = "SELECT id_jefe FROM usuarios WHERE id=$idU";

  $res = mysqli_query($enlace,$con) or die("La consulta fall&oacute;P1: " );

  $res_jefe = mysqli_fetch_assoc($res);

  $id_jefe = $res_jefe['id_jefe'];



  // echo 'j='.$id_jefe;

if($verobjetivos=="")

$verobjetivos=$idU;

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



$proyecto="";

$proyecto2="";

$proyecto3="";

$proyecto4="";

$proyecto5="";

$proyecto6="";



$ponderacion="";

$ponderacion2="";

$ponderacion3="";

$ponderacion4="";

$ponderacion5="";

$ponderacion6="";



$ponderacion_p="";

$ponderacion_p2="";

$ponderacion_p3="";

$ponderacion_p4="";

$ponderacion_p5="";

$ponderacion_p6="";





if($idU==$verobjetivos){

  $tipo_usuario="User";

  $consulta_imagen = "SELECT imagen FROM usuarios WHERE id=$idU";

}else{

  $tipo_usuario="Jefe";

  $consulta_imagen = "SELECT imagen FROM usuarios WHERE id=$verobjetivos";

}

$resultado_imagen = mysqli_query($enlace,$consulta_imagen) or die("La consulta fall&oacute;P1: $consulta_imagen". mysqli_error($enlace));

$res = mysqli_fetch_assoc($resultado_imagen);

$imagen_perfil = $res['imagen'];



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



	$proyecto=$_POST["proyecto"];

	$proyecto2=$_POST["proyecto2"];

	$proyecto3=$_POST["proyecto3"];

	$proyecto4=$_POST["proyecto4"];

	$proyecto5=$_POST["proyecto5"];

	$proyecto6=$_POST["proyecto6"];



	$ponderacion=$_POST["ponderacion"];

	$ponderacion2=$_POST["ponderacion2"];

	$ponderacion3=$_POST["ponderacion3"];

	$ponderacion4=$_POST["ponderacion4"];

	$ponderacion5=$_POST["ponderacion5"];

	$ponderacion6=$_POST["ponderacion6"];



	$ponderacion_p=$_POST["ponderacion_p"];

	$ponderacion_p2=$_POST["ponderacion_p2"];

	$ponderacion_p3=$_POST["ponderacion_p3"];

	$ponderacion_p4=$_POST["ponderacion_p4"];

	$ponderacion_p5=$_POST["ponderacion_p5"];

	$ponderacion_p6=$_POST["ponderacion_p6"];



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



			$proyect=($proyecto[$i]);

			$proyect2=($proyecto2[$i]);

			$proyect3=($proyecto3[$i]);

			$proyect4=($proyecto4[$i]);

			$proyect5=($proyecto5[$i]);

			$proyect6=($proyecto6[$i]);



			$ponder=($ponderacion[$i]);

			$ponder2=($ponderacion2[$i]);

			$ponder3=($ponderacion3[$i]);

			$ponder4=($ponderacion4[$i]);

			$ponder5=($ponderacion5[$i]);

			$ponder6=($ponderacion6[$i]);



			$ponder_p=($ponderacion_p[$i]);

			$ponder_p2=($ponderacion_p2[$i]);

			$ponder_p3=($ponderacion_p3[$i]);

			$ponder_p4=($ponderacion_p4[$i]);

			$ponder_p5=($ponderacion_p5[$i]);

			$ponder_p6=($ponderacion_p6[$i]);



			$consulta  = "insert into objetivos2(id_empleado, numero, nombre, descripcion, impacto, f_inicio, f_fin, revision, impacto2, impacto3, impacto4, impacto5, impacto6, ponderacion, ponderacion2, ponderacion3, ponderacion4, ponderacion5, ponderacion6, descripcion2, proyecto, proyecto2, proyecto3, proyecto4, proyecto5, proyecto6, ponderacion_p, ponderacion_p2, ponderacion_p3, ponderacion_p4, ponderacion_p5, ponderacion_p6) value($verobjetivos, $num, '$obj', '$des', '$imp', '$finicio', '$ffin', $revision, '$imp2', '$imp3', '$imp4', '$imp5', '$imp6', '$ponder', '$ponder2', '$ponder3', '$ponder4', '$ponder5', '$ponder6', '$des2', '$proyect', '$proyect2', '$proyect3', '$proyect4', '$proyect5', '$proyect6', '$ponder_p', '$ponder_p2', '$ponder_p3', '$ponder_p4', '$ponder_p5', '$ponder_p6')";

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



			$proyect=($proyecto[$i]);

			$proyect2=($proyecto2[$i]);

			$proyect3=($proyecto3[$i]);

			$proyect4=($proyecto4[$i]);

			$proyect5=($proyecto5[$i]);

			$proyect6=($proyecto6[$i]);



			$ponder=($ponderacion[$i]);

			$ponder2=($ponderacion2[$i]);

			$ponder3=($ponderacion3[$i]);

			$ponder4=($ponderacion4[$i]);

			$ponder5=($ponderacion5[$i]);

			$ponder6=($ponderacion6[$i]);



			$ponder_p=($ponderacion_p[$i]);

			$ponder_p2=($ponderacion_p2[$i]);

			$ponder_p3=($ponderacion_p3[$i]);

			$ponder_p4=($ponderacion_p4[$i]);

			$ponder_p5=($ponderacion_p5[$i]);

			$ponder_p6=($ponderacion_p6[$i]);



			$consulta  = "update objetivos2 set  nombre='$obj', descripcion='$des', impacto='$imp', f_inicio='$finicio', f_fin='$ffin', impacto2='$imp2', impacto3='$imp3', impacto4='$imp4', impacto5='$imp5', impacto6='$imp6', ponderacion='$ponder', ponderacion2='$ponder2', ponderacion3='$ponder3', ponderacion4='$ponder4', ponderacion5='$ponder5', ponderacion6='$ponder6', descripcion2='$des2', proyecto='$proyect', proyecto2='$proyect2', proyecto3='$proyect3', proyecto4='$proyect4', proyecto5='$proyect5', proyecto6='$proyect6', ponderacion_p='$ponder_p', ponderacion_p2='$ponder_p2', ponderacion_p3='$ponder_p3', ponderacion_p4='$ponder_p4', ponderacion_p5='$ponder_p5', ponderacion_p6='$ponder_p6'

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



if(isset($_POST['firmarMidYearReview'])){

        $revision=$_POST["revision"];
	$plan=$_POST["plan"];
	$consulta  = "update planes SET firmaUser_midYearReview = now(), estatus = 3 WHERE id=$plan";

	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: $consulta". mysqli_error($enlace) );

	echo"<script>alert(\"Firmado\");</script>";

}

if(isset($_POST['firmarMidYearReviewJ'])){

        $revision=$_POST["revision"];

	$plan=$_POST["plan"];

	$consulta  = "update planes SET  firmaJefe_midYearReview = now(), estatus = 4

        WHERE id=$plan";

	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: $consulta". mysqli_error($enlace) );

	echo"<script>alert(\"Firmado\");</script>";

}



if(isset($_POST['desfirmarMidYearReview'])){

        $revision=$_POST["revision"];

	$plan=$_POST["plan"];

	$consulta  = "update planes SET firmaUser_midYearReview = NULL, firmaJefe_midYearReview = NULL, estatus = 2

        WHERE id=$plan";

	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: $consulta". mysqli_error($enlace) );

	echo"<script>alert(\"Desfirmado\");</script>";

}





if($_POST["desfirmar_planeacion"]=="Desfirmar Planeación"){

	$revision=$_POST["revision"];

	$plan=$_POST["plan"];

	$consulta  = "update planes set  firma_e_i='0000-00-00', firma_j_i='0000-00-00', estatus='0' where id=$plan";

			//echo"$consulta <br>";

	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: $consulta". mysqli_error($enlace) );

	echo"<script>alert(\"Plan Desfirmado\");</script>";

}



if( ($_POST["guardar"]=="1" )){ // agregar objetivo



	$revision=$_POST["revision"];

	$plan=$_POST["plan"];

	$objetivo=$_POST["objetivo"];

	$descripcion=$_POST["descripcion"];

	$estrategia=$_POST["estrategia"];

	$inicio=$_POST["inicio"];

	$limite=$_POST["limite"];

	if($inicio=="")

		$inicio="0000-00-00";

	if($limite=="")

		$limite="0000-00-00";

	$fechat = explode('-', $inicio);

	$finicio="$fechat[2]-$fechat[1]-$fechat[0]";

	$fechat = explode('-', $limite);

	$ffin="$fechat[2]-$fechat[1]-$fechat[0]";





	//var_dump($revision);

	if($plan=="" || $plan==null)

	{



		$consulta  = "insert into planes(id_empleado, revision, estatus) value($verobjetivos, $revision, 0)";

		$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );

	}

		$consulta  = "insert into objetivos_new(id_empleado, numero, id_objetivo,id_estrategia, descripcion,inicio, limite, revision) value($verobjetivos, 1, '$objetivo', '$estrategia', '$descripcion', '$finicio', '$ffin', '$revision')";

		$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: $consulta". mysqli_error($enlace) );

		$id_objetivo=mysqli_insert_id($enlace);

		$num=1;

		for($i=0 ; $i<10 ; $i++)

		{

			$accion=$_POST["accion".$num];

			$inicio=$_POST["inicio".$num];

			$fin=$_POST["fin".$num];

			if($inicio=="")

				$inicio="0000-00-00";

			if($fin=="")

				$fin="0000-00-00";

			$fechat = explode('-', $inicio);

			$finicio="$fechat[2]-$fechat[1]-$fechat[0]";

			$fechat = explode('-', $fin);

			$ffin="$fechat[2]-$fechat[1]-$fechat[0]";





			$consulta  = "insert into acciones_new(id_empleado,  id_objetivo, accion,inicio, limite, revision, estatus, comentario) value($verobjetivos,  '$id_objetivo', '$accion',  '$finicio', '$ffin', $revision, 0, '')";

			$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: $consulta". mysqli_error($enlace) );

			$num++;

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

	$revision=$_POST["revision"];

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

			<td class=\"texto_chico\"><div align=\"center\">Este correo electronico fue generado automaticamente y no requiere ser contestado, para cualquier duda acudir al departamento de Recursos Humanos  </div></td>

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

	$revision=$_POST["revision"];

	$consulta  = "update planes set estatus=2, firma_j_i=now() where id_empleado=$verobjetivos and revision=$revision";

	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: $consulta ". mysqli_error($enlace) );

	echo"<script>alert(\"Planeacion Firmada\");</script>";

}

if($_POST["firma2"]=="2")

{

	$revision=$_POST["revision"];

	$consulta  = "update planes set estatus=0, firma_e_i=null where id_empleado=$verobjetivos and revision=$revision";

	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: $consulta ". mysqli_error($enlace) );

	$consulta  = "SELECT email from usuarios where id=$verobjetivos";

	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta  ". mysqli_error($enlace) );//. mysqli_error($enlace)

	if(@mysqli_num_rows($resultado)>=1)

	{

		$res=mysqli_fetch_row($resultado);

		$EmailTo=$res[0];



	}





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

        <td><div align=\"center\"><img src=\"http://www.tim-pmp.com/images/bell.png\" width=\"90\" height=\"51\" /></div></td>

      </tr>

      <tr>

        <td><div align=\"center\" class=\"text_grande\">Gestion de Desempeño </div></td>

      </tr>

      <tr>

        <td><p>&nbsp;</p>

          <p>Tu coordinador ha desfirmado tus objetivos.</p>

          <p>Te invitamos a entrar a la plataforma para hacer las modificaciones necesarias y volver a firmar la planeación, en la sección de tareas pendientes encontraras una liga  \"Planeación de Objetivos\"  </p>

          <p align=\"center\"><a href=\"http://www.tim-pmp.com\" class=\"boton style1\">http:///www.tim-pmp.com</a></p>

        <p align=\"left\">Es importante completar el proceso de revisión para no tener problemas en futuras etapas</p>

        <p align=\"left\">. </p></td>

      </tr>

      <tr>

        <td class=\"texto_chico\"><div align=\"center\">Este correo electronico fue generado automaticamente y no requiere ser contestado, para cualquier duda acudir al departamento de Recursos Humanos  </div></td>

      </tr>

    </table>

    </body>

    </html>";

		$Subject = "TIM-PMP -  Planeación de Objetivos";



		$success2 = mail($EmailTo, $Subject, $Body, "From: TIM-PMP <$EmailFrom>\nContent-type: text/html; charset=utf-8\n");

	echo"<script>alert(\"Planeacion Desfirmada\");</script>";

}





	$consulta  = "SELECT revision, etapa from etapa where id=1";

	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta  ". mysqli_error($enlace) );//. mysqli_error($enlace)

	if(@mysqli_num_rows($resultado)>=1)

	{

		$res=mysqli_fetch_row($resultado);

		$revision=$res[0];

		$etapa=$res[1];

		//$revision=2020;

		// $etapa=3;

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

	

        //  Guardar comentarios y estatus de las acciones

         if($_POST["guardar"]=="3" || $_POST["guardar"]=="4"){

            $acciones = $_POST['accion'];

            foreach ($acciones as $accion => $id_accion) {

              $estatus = $_POST['estatus'.$id_accion];

              $comentario = $_POST['comentario'.$id_accion];

              $consulta = "UPDATE acciones_new SET estatus=$estatus,comentario='$comentario' WHERE id=$id_accion";

              $resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P13: $consulta". mysqli_error($enlace));

            }

			 if($_POST["guardar"]=="3" )

            echo"<script>alert(\"Actualizado!!\");</script>";

         }

		 

		  //  Guardar comentarios y evaluacion de objetivos finales empleado

         if( $_POST["guardar"]=="4" || $_POST["guardar"]=="6"){

             $acciones = $_POST['accion'];

            foreach ($acciones as $accion => $id_accion) {

              $estatus = $_POST['estatus'.$id_accion];

              $comentario = $_POST['comentario'.$id_accion];

              $consulta = "UPDATE acciones_new SET estatus=$estatus,comentario='$comentario' WHERE id=$id_accion";

              $resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P13: $consulta". mysqli_error($enlace));

            }

			$list_obj = $_POST['list_obj'];

            foreach ($list_obj as $lista_obj => $id_lista) {

              $f_empleado = $_POST['f_empleado'.$id_lista];

			  if($f_empleado=='')

			  	$f_empleado=0;

			  

              $f_comentario = $_POST['f_comentario'.$id_lista];

			  $f_j_comentario = $_POST['f_j_comentario'.$id_lista];

              $consulta = "UPDATE objetivos_new SET evaluacion=$f_empleado,comentario_e='$f_comentario' WHERE id=$id_lista";

              $resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P13: $consulta". mysqli_error($enlace));

			  

            }

				$final_empleado = $_POST['final_empleado'];

				$consulta = "UPDATE planes SET comentario_final='$final_empleado' WHERE revision=$revision and id_empleado=$verobjetivos";

              $resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P13: $consulta". mysqli_error($enlace));

            echo"<script>alert(\"Actualizado!!\");</script>";

         }

		  //  Guardar comentarios y evaluacion de objetivos finales jefe

         if( $_POST["guardar"]=="5" ||  $_POST["guardar"]=="7"){

            

			$list_obj = $_POST['list_obj'];

			$rFinal = $_POST['rFinal'];

			if($rFinal=='')

				$rFinal=0;

			$clasFinal = $_POST['clasFinal'];

			if($clasFinal=='')

				$clasFinal=0;

			$final_jefe = $_POST['final_jefe'];

			

            foreach ($list_obj as $lista_obj => $id_lista) {

              

			  $f_jefe = $_POST['f_jefe'.$id_lista];

               if($f_jefe=='')

			  	$f_jefe=0;

			  $f_j_comentario = $_POST['f_j_comentario'.$id_lista];

              $consulta = "UPDATE objetivos_new SET evaluacion_j=$f_jefe,comentario_j='$f_j_comentario' WHERE id=$id_lista";

              $resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P13: $consulta". mysqli_error($enlace));

            }

			$consulta = "UPDATE planes SET comentario_final_j='$final_jefe', resultado_obj=$rFinal, clasificacion=$clasFinal WHERE revision=$revision and id_empleado=$verobjetivos";

              $resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P13: $consulta". mysqli_error($enlace));

            echo"<script>alert(\"Actualizado!!\");</script>";

         }

 // firmar revision final empleado

if( $_POST["guardar"]=="6"){

		 

        $query = "SELECT usuarios.*, us.nombre AS nombreEmpleado FROM `usuarios`

            inner join usuarios as us on usuarios.id = us.id_jefe

            WHERE us.id = $idU";

        $result = mysqli_query($enlace,$query) or print(' No se obtuvo id del jefe '.mysqli_error($enlace));

        $jefe = mysqli_fetch_assoc($result);

   



	//guarda firma final

    $query = "UPDATE planes SET firma_e_f = NOW(), estatus=5

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

                <div align=\"center\">Este correo electronico fue generado automaticamente y no requiere ser contestado, para cualquier duda acudir al departamento de Recursos Humanos  </div></td>

          </tr>

        </table>

        </body>

        </html>";

        $Subject = "TIM-PMP - Revisar ANNUAL PERFORMANCE REVIEW de {$jefe['nombreEmpleado']} ";



        $success2 = mail($jefe['email'], $Subject, $Body, "From: TIM-PMP <$EmailFrom>\nContent-type: text/html; charset=utf-8\n");

		echo"<script>alert(\"Tu cierre de objetivos ha sido firmada, tu coordinador recibira un correo electronico denotificación\");</script>";

    	

		  

		  }

}		  

		  // firmar revision final jefe

		  if( $_POST["guardar"]=="7"){

		  

				   $query = "UPDATE planes SET firma_j_f = NOW(), estatus=6

				WHERE id_empleado = $verobjetivos AND revision = '{$_POST["revision"]}';";

		

			$result = mysqli_query($enlace,$query) or die('No se actualizado tu checkpoint1');

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

		$rFinal=$res[8];

		$clasFinal=$res[9];

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

	// echo $ver;



	if( is_null($planes['firmaUser_midYearReview'])   && $idU==$verobjetivos)

	{

						$verChP=5; // empleado no ha firmado midyear, empleado puede editar midyear. jefe no le aparece midyear.

	} else{

    	if(!is_null($planes['firmaUser_midYearReview']) && is_null($planes['firmaJefe_midYearReview']) && $idU==$jefe)

	  	{

			$verChP=6; // empleado ha firmado midyear, jefe firmará midyear. Empleado solo ver.

	  	}else{

      		if($etapa>=2){

				$verChP=7;// empleado y jefe firmaron pero salen solo de lectura

	    	}

    	}

   }

	 



  // echo $verChP;

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

				else

				{

					if($firma2e!="0000-00-00" && $firma2j!="0000-00-00" && $idU==$verobjetivos)

						$verFinal=11; // entra empleado cuando ya esta todo firmado y puede ver



				}

			}



	}

         $entroEmpleado = intval($idU) == intval($verobjetivos);



?>

<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Bell</title>

    <style type="text/css">
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

    .button {

        padding: 1px 1px;

        border: 1px solid #00475C;

        border-radius: 0px;

        background-color: #00475C;

        color: #fff;

        text-decoration: none;

        /* text-transform:uppercase; */

        text-align: center;

        box-shadow: 1px 1px 1px #000;

        display: inline-block;

    }
    </style>

    <link href="images/textos.css" rel="stylesheet" type="text/css" />

    <link type="text/css" href="css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />

    <link rel="stylesheet" href="colorbox.css" />

    <script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>

    <script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>

    <script src="colorbox/jquery.colorbox-min.js"></script>



    <SCRIPT>
    $(document).ready(function() {

        $(".iframe2").colorbox({
            iframe: true,
            width: "800",
            height: "620",
            transition: "fade",
            scrolling: true,
            opacity: 0.1
        });

        $("#click").click(function() {

            $('#click').css({
                "background-color": "#f00",
                "color": "#fff",
                "cursor": "inherit"
            }).text("Open this window again and this message will still be here.");

            return false;

        });

    });



    $(function() {



        $("#inicio").datepicker({ dateFormat: 'dd-mm-yy' });

        $("#limite").datepicker({  dateFormat: 'dd-mm-yy' });

        $("#inicio1").datepicker({ dateFormat: 'dd-mm-yy' });

        $("#fin1").datepicker({ dateFormat: 'dd-mm-yy'});

        $("#inicio2").datepicker({ dateFormat: 'dd-mm-yy' });

        $("#fin2").datepicker({ dateFormat: 'dd-mm-yy' });

        $("#inicio3").datepicker({dateFormat: 'dd-mm-yy' });

        $("#fin3").datepicker({ dateFormat: 'dd-mm-yy'  });

        $("#inicio4").datepicker({ dateFormat: 'dd-mm-yy' });

        $("#fin4").datepicker({dateFormat: 'dd-mm-yy'  });

        $("#inicio5").datepicker({ dateFormat: 'dd-mm-yy' });

        $("#fin5").datepicker({ dateFormat: 'dd-mm-yy' });

        $("#inicio6").datepicker({ dateFormat: 'dd-mm-yy' });

        $("#fin6").datepicker({ dateFormat: 'dd-mm-yy'});

        $("#inicio7").datepicker({ dateFormat: 'dd-mm-yy' });

        $("#fin67").datepicker({ dateFormat: 'dd-mm-yy' });

        $("#inicio8").datepicker({dateFormat: 'dd-mm-yy' });

        $("#fin8").datepicker({dateFormat: 'dd-mm-yy' });

        $("#inicio9").datepicker({ dateFormat: 'dd-mm-yy' });

        $("#fin9").datepicker({dateFormat: 'dd-mm-yy' });

        $("#inicio10").datepicker({ dateFormat: 'dd-mm-yy' });

        $("#fin10").datepicker({ dateFormat: 'dd-mm-yy' });

    });

    function firmarMidYearReviewDes(esJefe) {

        // if(validar() && validarMidYearReview(esJefe)){

        // var element = document.createElement('input');

        // element.name = 'firmarMidYearReviewDes';

        // element.value = 1;

        // document.form1.appendChild(element);

        document.form1.submit();

        // }

    }

    function firmarMidYearReview(esJefe) {

        // if( validarMidYearReview(esJefe) ){

        var element = document.createElement('input');

        element.name = 'firmarMidYearReview';

        element.value = 1;

        document.form1.appendChild(element);

        document.form1.submit();

        // }

    }

    function firmarMidYearReviewJ(esJefe) {

        // if( validarMidYearReview(esJefe) ){

        var element = document.createElement('input');

        element.name = 'firmarMidYearReviewJ';

        element.value = 1;

        document.form1.appendChild(element);

        document.form1.submit();

        // }

    }

    function validarMidYearReview(esJefe) {

        //validar textarea jefe o usuario

        if (esJefe) {

            if (document.form1.objetivo[0].value != "" && document.form1.midCheckpoint1[0].checked == false &&

                document.form1.midCheckpoint1[1].checked == false &&

                document.form1.midCheckpoint1[2].checked == false) {

                document.form1.midCheckpoint1[0].focus();

                alert('Falto evaluacion de objetivo 1');

                return false;

            } else {

                if (document.form1.objetivo[1].value != "" && document.form1.midCheckpoint2[0].checked == false &&
                    document.form1.midCheckpoint2[1].checked == false && document.form1.midCheckpoint2[2].checked ==
                    false) {

                    document.form1.midCheckpoint2[0].focus();

                    alert('Falto evaluacion de objetivo 2');

                    return false;

                } else

                {

                    if (document.form1.objetivo[2].value != "" && document.form1.midCheckpoint3[0].checked == false &&
                        document.form1.midCheckpoint3[1].checked == false && document.form1.midCheckpoint3[2].checked ==
                        false) {

                        document.form1.midCheckpoint3[0].focus();

                        alert('Falto evaluacion de objetivo 3');

                        return false;

                    } else

                    {

                        if (document.form1.objetivo[3].value != "" && document.form1.midCheckpoint4[0].checked ==
                            false && document.form1.midCheckpoint4[1].checked == false && document.form1.midCheckpoint4[
                                2].checked == false) {

                            document.form1.midCheckpoint4[0].focus();

                            alert('Falto evaluacion de objetivo 4');

                            return false;

                        } else

                        {

                            if (document.form1.objetivo[4].value != "" && document.form1.midCheckpoint5[0].checked ==
                                false && document.form1.midCheckpoint5[1].checked == false && document.form1
                                .midCheckpoint5[2].checked == false) {

                                document.form1.midCheckpoint5[0].focus();

                                alert('Falto evaluacion de objetivo 5');

                                return false;

                            } else

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

        } else

        {

            if (document.form1.objetivo[0].value != "" && document.form1.midCheckpoint_e1[0].checked == false &&

                document.form1.midCheckpoint_e1[1].checked == false &&

                document.form1.midCheckpoint_e1[2].checked == false) {

                document.form1.midCheckpoint_e1[0].focus();

                alert('Falto evaluacion de objetivo 1');

                return false;

            } else {

                if (document.form1.objetivo[1].value != "" && document.form1.midCheckpoint_e2[0].checked == false &&
                    document.form1.midCheckpoint_e2[1].checked == false && document.form1.midCheckpoint_e2[2].checked ==
                    false) {

                    document.form1.midCheckpoint_e2[0].focus();

                    alert('Falto evaluacion de objetivo 2');

                    return false;

                } else

                {

                    if (document.form1.objetivo[2].value != "" && document.form1.midCheckpoint_e3[0].checked == false &&
                        document.form1.midCheckpoint_e3[1].checked == false && document.form1.midCheckpoint_e3[2]
                        .checked == false) {

                        document.form1.midCheckpoint_e3[0].focus();

                        alert('Falto evaluacion de objetivo 3');

                        return false;

                    } else

                    {

                        if (document.form1.objetivo[3].value != "" && document.form1.midCheckpoint_e4[0].checked ==
                            false && document.form1.midCheckpoint_e4[1].checked == false && document.form1
                            .midCheckpoint_e4[2].checked == false) {

                            document.form1.midCheckpoint_e4[0].focus();

                            alert('Falto evaluacion de objetivo 4');

                            return false;

                        } else

                        {

                            if (document.form1.objetivo[4].value != "" && document.form1.midCheckpoint_e5[0].checked ==
                                false && document.form1.midCheckpoint_e5[1].checked == false && document.form1
                                .midCheckpoint_e5[2].checked == false) {

                                document.form1.midCheckpoint_e5[0].focus();

                                alert('Falto evaluacion de objetivo 5');

                                return false;

                            } else

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

        for (var i = 0; i < 5; i++) {

            try {

                if (document.form1.objetivo[i].value != "" && txtAU[i].value == "" && txtAU.length > 0) {

                    txtAU[i].focus();

                    alert('Falto comentario del objetivo ' + (i + 1));

                    return false;

                }

            } catch (e) {

                //console.log('txtAU '+e.message);

            }

            try {

                if (txtAJ[i].value == "" && txtAJ.length > 0) {

                    txtAJ[i].focus();

                    alert('Falto comentario del objetivo ' + (i + 1));

                    return false;

                }



            } catch (e) {

                //console.log('txtAJ '+e.message);

            }



        }







        return true;

    }
    </SCRIPT>

    <script type="text/javascript">
   
    function MM_findObj(n, d) { //v4.01

        var p, i, x;
        if (!d) d = document;
        if ((p = n.indexOf("?")) > 0 && parent.frames.length) {

            d = parent.frames[n.substring(p + 1)].document;
            n = n.substring(0, p);
        }

        if (!(x = d[n]) && d.all) x = d.all[n];
        for (i = 0; !x && i < d.forms.length; i++)
		 x = d.forms[i][n];

        for (i = 0; !x && d.layers && i < d.layers.length; i++)
		 x = MM_findObj(n, d.layers[i].document);

        if (!x && d.getElementById) x = d.getElementById(n);
        return x;

    }

    function revisaCalif() {

        <? $numero = 1;

        for ($i = 0; $i < 5; $i++)

        {
            ?>



            if (document.form1.pact[<? echo $i ?>].value > 0 && (document.form1.cFinal_e<? echo $numero ?>[0].checked == false && document.form1.cFinal_e<? echo $numero ?>[1].checked == false && document.form1.cFinal_e<? echo $numero ?>[2].checked == false && document.form1.cFinal_e<? echo $numero ?>[3].checked == false))

            {

                alert("No tiene calificacion objetivo <? echo $numero?>");

                document.form1.cFinal_e<? echo $numero ?>[0].focus();

                return false;

            } else {

                if (document.form1.pact2[<? echo $i ?>].value > 0 && (document.form1.cFinal_e2<? echo $numero ?>[0].checked == false && document.form1.cFinal_e2<? echo $numero ?>[1].checked == false &&
                        document.form1.cFinal_e2<? echo $numero ?>[2].checked == false && document.form1.cFinal_e2<? echo $numero ?>[3].checked == false))

                {

                    alert("No tiene calificacion objetivo <? echo $numero?>");

                    document.form1.cFinal_e2<? echo $numero ?>[0].focus();

                    return false;

                } else {

                    if (document.form1.pact3[<? echo $i ?>].value > 0 && (document.form1.cFinal_e3<?
                            echo $numero ?>[0].checked == false && document.form1.cFinal_e3<? echo $numero ?>[1].checked == false && document.form1.cFinal_e3<? echo $numero ?>[2].checked == false &&
                            document.form1.cFinal_e3<? echo $numero ?>[3].checked == false))

                    {

                        alert("No tiene calificacion objetivo <? echo $numero?>");

                        document.form1.cFinal_e3<? echo $numero ?>[0].focus();

                        return false;

                    } else {

                        if (document.form1.pact4[<? echo $i ?>].value > 0 && (document.form1.cFinal_e4<?
                                echo $numero ?>[0].checked == false && document.form1.cFinal_e4<? echo $numero ?>[1].checked == false && document.form1.cFinal_e4<? echo $numero ?>[2].checked == false && document.form1.cFinal_e4<? echo $numero ?>[3].checked == false))

                        {

                            alert("No tiene calificacion objetivo <? echo $numero?>");

                            document.form1.cFinal_e4<? echo $numero ?>[0].focus();

                            return false;

                        } else {

                            if (document.form1.pact5[ <? echo $i ?> ].value > 0 && (document.form1.cFinal_e5<? echo $numero ?>[0].checked == false && document.form1.cFinal_e5<? echo $numero ?>[1].checked == false && document.form1.cFinal_e5<? echo $numero ?>[2].checked == false && document.form1.cFinal_e5<? echo $numero ?>[3].checked == false))

                            {

                                alert("No tiene calificacion objetivo <? echo $numero?>");

                                document.form1.cFinal_e5<? echo $numero ?>[0].focus();

                                return false;

                            } else {

                                if (document.form1.pact6[ <? echo $i ?> ].value != "" && (document.form1.cFinal_e6<?
                                        echo $numero ?>[0].checked == false && document.form1.cFinal_e6<?
                                        echo $numero ?>[1].checked == false && document.form1.cFinal_e6<?
                                        echo $numero ?>[2].checked == false && document.form1.cFinal_e6<?
                                        echo $numero ?>[3].checked == false))

                                {

                                    alert("No tiene calificacion objetivo <? echo $numero?>");

                                    document.form1.cFinal_e6<? echo $numero ?>[0].focus();

                                    return false;

                                } else {}
                            }
                        }
                    }
                }
            }

            <? $numero++;

        } ?>



        return true;

    }





    function MM_preloadImages() { //v3.0

        var d = document;
        if (d.images) {
            if (!d.MM_p) d.MM_p = new Array();

            var i, j = d.MM_p.length,
                a = MM_preloadImages.arguments;
            for (i = 0; i < a.length; i++)

                if (a[i].indexOf("#") != 0) {
                    d.MM_p[j] = new Image;
                    d.MM_p[j++].src = a[i];
                }
        }

    }



    function MM_swapImgRestore() { //v3.0

        var i, x, a = document.MM_sr;
        for (i = 0; a && i < a.length && (x = a[i]) && x.oSrc; i++) x.src = x.oSrc;

    }





    function firmarR()

    {

        if (validar() == true)

        {

            document.form1.firma2.value = "1";

            document.form1.submit();

        }

    }

    function desfirmarR()

    {

        if (validar() == true)

        {

            document.form1.firma2.value = "2";

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

        var i, j = 0,
            x, a = MM_swapImage.arguments;
        document.MM_sr = new Array;
        for (i = 0; i < (a.length - 2); i += 3)

            if ((x = MM_findObj(a[i])) != null) {
                document.MM_sr[j++] = x;
                if (!x.oSrc) x.oSrc = x.src;
                x.src = a[i + 2];
            }

    }

    $(document).ready(function() {



        $("#objetivo").change(function() {

            var deptid = $(this).val();



            $.ajax({

                url: 'busca_estrategia.php',

                type: 'post',

                data: {
                    id_objetivo: deptid
                },

                dataType: 'json',

                success: function(response) {



                    var len = response.length;



                    $("#estrategia").empty();

                    for (var i = 0; i < len; i++) {

                        var id = response[i]['id'];

                        var name = response[i]['name'];



                        $("#estrategia").append("<option value='" + id + "'>" + name + "</option>");



                    }

                }

            });

        });



    });

    //
    -->
    function guardar1(valor)
    {
    if (valor == "1")
    {
    	if (document.form1.objetivo.value == "0")
    	{	
			alert("Debe seleccionar un	Objetivo ");
    		document.form1.objetivo.focus();
    		return false;
    	} else if (document.form1.estrategia.value == "0")
    		{
				alert("Debe  seleccionar una Estrategia ");
				document.form1.estrategia.focus();
    			return false;
    		} else if (document.form1.descripcion.value == "0")
    		{
    			alert("Debe escribir  una Descripcion ");
   				 document.form1.descripcion.focus();
   				 return false;
    		} else if (document.form1.inicio.value == "0")
    		{
			alert("Debe seleccionar  fecha  de Inicio ");
			document.form1.inicio.focus();
			return false;
    		}
    		else if (document.form1.accion1.value == "" && document.form1.accion2.value == "")
    		{
    		alert("Debellenar al menos 2 acciones ");
    		document.form1.accion1.focus();
   			 return false;
    		} else if (document.form1.limite.value == "0")
    		{
			alert("Debe seleccionar fecha limite ");
			 document.form1.limite.focus();
   			 return false;
    		} else
    		{
    			document.form1.guardar.value = valor;
				//1  agregar,  2  guardar
				document.form1.submit();
    		}
    } else
    {
    	document.form1.guardar.value = valor;
    	// 1 agregar,  2 guardar
    	document.form1.submit();
    }
}
    function firmar()
    {
    if (validar() == true)
    {
    document.form1.firma1.value = "1";
    document.form1.submit();
    }
    }
    function guardar_comentarios_acciones()
    {
    document.form1.guardar.value = 3;
    document.form1.submit();
    }
    function  guardar_final_e()
    {
    document.form1.guardar.value = 4;
    document.form1.submit();
    }
    function  guardar_final_j()
    {
    document.form1.guardar.value = 5;
    document.form1.submit();
    }
    function firmarFinal_e()
    {
    if (validarFinal_e())
    {
    document.form1.guardar.value = 6;
    document.form1.submit();
    }
    }
    function firmarFinal_j()
    {
		if (validarFinal_j())
		{
		document.form1.guardar.value = 7;
		document.form1.submit();
		}
    }
   // firmarFinal_e

    </script>

    <style type="text/css">
    <!--
    .style1 {
        color: #FFFFFF
    }
    -->

    </style>

</head>

<body>

    <!---->

    <form method="post" name="form1" action="">

        <input type="hidden" name="revision" id="revision" value="<? echo $revision; ?>" />

        <table width="100%" border="0" cellspacing="0" cellpadding="0">

            <tr>

                <td background="images/Header_bkg.png">
                    <table width="900" border="0" align="center" cellpadding="0" cellspacing="0">

                        <tr>

                            <td>
                                <div align="center"><a href="menu.php"><img src="images/header_logo.png" width="210"
                                            height="175" border="0" /></a></div>
                            </td>

                        </tr>

                    </table>
                </td>

            </tr>

            <tr>

                <td height="698" valign="top">
                    <table width="900" border="0" align="center" cellpadding="0" cellspacing="0">

                        <tr>

                            <td bgcolor="#FFFFFF">
                                <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">

                                    <tr>

                                        <td colspan="9">
                                            <table width="400" border="0" align="center" cellpadding="0"
                                                cellspacing="0">

                                                <tr>

                                                    <td>
                                                        <table width="300" border="0" cellspacing="0" cellpadding="0">

                                                            <tr>

                                                                <td width="5" valign="baseline"
                                                                    background="images/linea_horizontal.png"><span
                                                                        class="olvido"><img src="images/spacer.gif"
                                                                            width="190" height="10" /></span></td>

                                                                <td height="10">
                                                                    <div align="center">

                                                                        <table width="50" border="0" cellspacing="3"
                                                                            cellpadding="0">

                                                                            <tr>

                                                                                <td><span
                                                                                        class="olvido">Evaluación</span>
                                                                                </td>

                                                                            </tr>

                                                                        </table>

                                                                    </div>
                                                                </td>

                                                                <td width="5" background="images/linea_horizontal.png">
                                                                    <span class="olvido"><img src="images/spacer.gif"
                                                                            width="190" height="10" /></span></td>

                                                            </tr>

                                                        </table>
                                                    </td>

                                                </tr>

                                                <tr>

                                                    <td><span class="olvido"><img src="images/spacer.gif" width="10"
                                                                height="10" /></span></td>

                                                </tr>

                                            </table>
                                        </td>

                                        <td width="10">&nbsp;</td>

                                        <td colspan="3">
                                            <table width="180" border="0" align="center" cellpadding="0"
                                                cellspacing="0">

                                                <tr>

                                                    <td>
                                                        <table width="150" border="0" align="center" cellpadding="0"
                                                            cellspacing="0">

                                                            <tr>

                                                                <td width="5" valign="baseline"
                                                                    background="images/linea_horizontal.png"><span
                                                                        class="olvido"><img src="images/spacer.gif"
                                                                            width="45" height="10" /></span></td>

                                                                <td height="10">
                                                                    <div align="center">

                                                                        <table width="50" border="0" cellspacing="3"
                                                                            cellpadding="0">

                                                                            <tr>

                                                                                <td>
                                                                                    <div align="center"><span
                                                                                            class="olvido">Firmas</span>
                                                                                    </div>
                                                                                </td>

                                                                            </tr>

                                                                        </table>

                                                                    </div>
                                                                </td>

                                                                <td width="5" background="images/linea_horizontal.png">
                                                                    <span class="olvido"><img src="images/spacer.gif"
                                                                            width="45" height="10" /></span></td>

                                                            </tr>

                                                        </table>
                                                    </td>

                                                </tr>

                                                <tr>

                                                    <td><span class="olvido"><img src="images/spacer.gif" width="10"
                                                                height="10" /></span></td>

                                                </tr>

                                            </table>
                                        </td>

                                        <td width="14">&nbsp;</td>

                                        <td width="14">
                                            <table width="100" border="0" align="center" cellpadding="0"
                                                cellspacing="0">

                                                <tr>

                                                    <td>
                                                        <table width="100" border="0" align="center" cellpadding="0"
                                                            cellspacing="0">

                                                            <tr>

                                                                <td width="5" valign="baseline"
                                                                    background="images/linea_horizontal.png"><span
                                                                        class="olvido"><img src="images/spacer.gif"
                                                                            width="15" height="10" /></span></td>

                                                                <td height="10">
                                                                    <div align="center">

                                                                        <table width="50" border="0" cellspacing="3"
                                                                            cellpadding="0">

                                                                            <tr>

                                                                                <td>
                                                                                    <div align="center"><span
                                                                                            class="olvido">Cierre</span>
                                                                                    </div>
                                                                                </td>

                                                                            </tr>

                                                                        </table>

                                                                    </div>
                                                                </td>

                                                                <td width="5" background="images/linea_horizontal.png">
                                                                    <span class="olvido"><img src="images/spacer.gif"
                                                                            width="15" height="10" /></span></td>

                                                            </tr>

                                                        </table>
                                                    </td>

                                                </tr>

                                                <tr>

                                                    <td><span class="olvido"><img src="images/spacer.gif" width="10"
                                                                height="10" /></span></td>

                                                </tr>

                                            </table>
                                        </td>

                                    </tr>

                                    <tr>

                                        <td width="98">
                                            <table width="70" border="0" cellspacing="0" cellpadding="0">

                                                <tr>

                                                    <td><img src="images/circulo_1.png" name="Image29" width="31"
                                                            height="32" border="0" id="Image29" /></td>

                                                    <td><img src="images/spacer.gif" width="3" height="10" /></td>

                                                    <td><span class="olvido">Planeación Estratégica</span></td>

                                                </tr>

                                            </table>
                                        </td>

                                        <td width="10" class="olvido"><img src="images/spacer.gif" width="10"
                                                height="10" /></td>

                                        <td width="105">
                                            <table width="100" border="0" cellspacing="0" cellpadding="0">

                                                <tr>

                                                    <td><img src="images/circulo_2<? if($etapa==1)echo" _r";?>.png"
                                                        name="Image1" width="31" height="32" border="0" id="Image1" />
                                                    </td>

                                                    <td><img src="images/spacer.gif" width="3" height="10" /></td>

                                                    <td><span class="olvido">Planeación de Objetivos</span></td>

                                                </tr>

                                            </table>
                                        </td>

                                        <td width="11"><span class="olvido"><img src="images/spacer.gif" width="10"
                                                    height="10" /></span></td>

                                        <td width="105">
                                            <table width="70" border="0" cellspacing="0" cellpadding="0">

                                                <tr>

                                                    <td><img src="images/circulo_3<? if($etapa==2)echo" _r";?>.png"
                                                        name="Image21" width="31" height="32" border="0" id="Image21" />
                                                    </td>

                                                    <td><img src="images/spacer.gif" width="3" height="10" /></td>

                                                    <td><span class="olvido">Revisiones Periodicas</span></td>

                                                </tr>

                                            </table>
                                        </td>

                                        <td width="11"><span class="olvido"><img src="images/spacer.gif" width="10"
                                                    height="10" /></span></td>

                                        <td width="105">
                                            <table width="70" border="0" cellspacing="0" cellpadding="0">

                                                <tr>

                                                    <td><img src="images/circulo_4.png" name="Image24" width="31"
                                                            height="32" border="0" id="Image24" /></td>

                                                    <td><img src="images/spacer.gif" width="3" height="10" /></td>

                                                    <td><span class="olvido">Evaluación 360</span></td>

                                                </tr>

                                            </table>
                                        </td>

                                        <td width="11"><span class="olvido"><img src="images/spacer.gif" width="10"
                                                    height="10" /></span></td>

                                        <td width="105">
                                            <table width="70" border="0" cellspacing="0" cellpadding="0">

                                                <tr>

                                                    <td><img src="images/circulo_5.png" name="Image25" width="31"
                                                            height="32" border="0" id="Image25" /></td>

                                                    <td><img src="images/spacer.gif" width="3" height="10" /></td>

                                                    <td><span class="olvido">Cierre de Objetivos</span></td>

                                                </tr>

                                            </table>
                                        </td>

                                        <td><span class="olvido"><img src="images/spacer.gif" width="5"
                                                    height="10" /></span></td>

                                        <td width="115">
                                            <table width="86" border="0" cellspacing="0" cellpadding="0">

                                                <tr>

                                                    <td width="31"><img src="images/circulo_6.png" name="Image27"
                                                            width="31" height="32" border="0" id="Image27" /></td>

                                                    <td width="3"><img src="images/spacer.gif" width="3" height="10" />
                                                    </td>

                                                    <td width="52"><span class="olvido">Firma del Empleado</span></td>

                                                </tr>

                                            </table>
                                        </td>

                                        <td width="14"><span class="olvido"><img src="images/spacer.gif" alt=""
                                                    width="10" height="10" /></span></td>

                                        <td width="14">
                                            <table width="85" border="0" cellspacing="0" cellpadding="0">

                                                <tr>

                                                    <td><img src="images/circulo_7.png" name="Image28" width="31"
                                                            height="32" border="0" id="Image28" /></td>

                                                    <td><img src="images/spacer.gif" width="3" height="10" /></td>

                                                    <td><span class="olvido">Firma del Gerente</span></td>

                                                </tr>

                                            </table>
                                        </td>

                                        <td><span class="olvido"><img src="images/spacer.gif" alt="" width="5"
                                                    height="10" /></span></td>

                                        <td>
                                            <table width="68" border="0" align="center" cellpadding="0" cellspacing="0">

                                                <tr>

                                                    <td width="31"><img src="images/circulo_8.png" name="Image210"
                                                            width="31" height="32" border="0" id="Image210" /></td>

                                                    <td><img src="images/spacer.gif" width="3" height="10" /></td>

                                                    <td><span class="olvido">Cierre</span></td>

                                                </tr>

                                            </table>
                                        </td>

                                    </tr>

                                    <tr>

                                        <td>&nbsp;</td>

                                        <td>&nbsp;</td>

                                        <td>&nbsp;</td>

                                        <td>&nbsp;</td>

                                        <td>&nbsp;</td>

                                        <td>&nbsp;</td>

                                        <td>&nbsp;</td>

                                        <td>&nbsp;</td>

                                        <td>&nbsp;</td>

                                        <td>&nbsp;</td>

                                        <td>&nbsp;</td>

                                        <td>&nbsp;</td>

                                        <td>&nbsp;</td>

                                        <td>&nbsp;</td>

                                        <td>&nbsp;</td>

                                    </tr>

                                </table>
                            </td>

                        </tr>

                        <tr>

                            <td>
                                <div align="right"><img src="images/spacer.gif" width="56" height="19" /></div>
                            </td>

                        </tr>



                        <tr>

                            <td>
                                <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">

                                    <tr>

                                        <td height="250" valign="top" bgcolor="#eeeeee">
                                            <table width="753" border="0" align="center" cellpadding="0"
                                                cellspacing="0">

                                                <tr>

                                                    <td><img src="images/spacer.gif" width="10" height="20" /></td>

                                                </tr>

                                                <tr>

                                                    <td>
                                                        <table width="753" border="0" cellspacing="3" cellpadding="0">

                                                            <tr>

                                                                <td colspan="2" class="tit_1">Gestion del Desempeño
                                                                    <? echo $revision?><span class="texto_tareas">

                                                                        <input name="plan" type="hidden" id="plan" value="<?echo $plan;?>" />

                                                                        <input name="verobjetivos" type="hidden"
                                                                            id="verobjetivos" value="<?echo"
                                                                            $verobjetivos";?>" />



                                                                        <input name="guardar" type="hidden"
                                                                            id="guardar" />

                                                                    </span>
                                                                </td>

                                                                <td width="278" colspan="4" valign="top">&nbsp;</td>

                                                            </tr>

                                                            <tr>

                                                                <td width="108" rowspan="2" class="tit_1"><img
                                                                        src="empleados/<?echo" $imagen_perfil";?>"
                                                                    width="91" /></td>

                                                                <td width="355" valign="top" class="tit_1"><span
                                                                        class="texto_tareas">
                                                                        <? echo $nombre?>
                                                                    </span></td>

                                                                <td width="278" colspan="4" valign="top">&nbsp;</td>

                                                            </tr>

                                                            <tr>

                                                                <td colspan="5" valign="top" class="tit_1">

                                                                    <div align="left">

                                                                        <img src="images/I1.jpg" width="102"
                                                                            height="70" />

                                                                        <img src="images/I2.jpg" width="102"
                                                                            height="70" />

                                                                        <img src="images/I3.jpg" width="102"
                                                                            height="70" />

                                                                        <img src="images/I4.jpg" width="102"
                                                                            height="70" />

                                                                        <img src="images/I5.jpg" width="102"
                                                                            height="70" />
                                                                    </div>
                                                                </td>

                                                            </tr>





                                                        </table>
                                                    </td>

                                                </tr>

                                                <tr>

                                                    <td><img src="images/spacer.gif" width="10" height="20" /></td>

                                                </tr>





                                            </table>

                                            <!-- plan de accion -->

                                            <? if($plan=="" || $etapa==1){?>



                                            <table width="753" border="0" align="center" cellpadding="0"
                                                cellspacing="0">



                                                <tr>

                                                    <td colspan="2"><img src="images/spacer.gif" width="10"
                                                            height="20" /></td>

                                                </tr>

                                                <tr>

                                                    <td colspan="2">
                                                        <table width="753" border="0" cellspacing="0" cellpadding="0">

                                                            <tr>

                                                                <td height="28" background="images/titulos_franjas.jpg">
                                                                    <table width="100%" border="0" cellspacing="0"
                                                                        cellpadding="0">

                                                                        <tr>

                                                                            <td width="10" bgcolor="#333300"><img
                                                                                    src="images/spacer.gif" width="15"
                                                                                    height="28" /></td>

                                                                            <td bgcolor="#333300"
                                                                                class="text_mediano_blanco"
                                                                                style="color:#FFFFFF;">AGREGAR OBJETIVO
                                                                            </td>

                                                                        </tr>

                                                                    </table>
                                                                </td>

                                                            </tr>

                                                        </table>
                                                    </td>

                                                </tr>

                                                <tr>

                                                    <td colspan="2" bgcolor="#FFFFFF">
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">

                                                            <tr>

                                                                <td width="410">
                                                                    <table width="100%" border="0" cellspacing="2"
                                                                        cellpadding="0">

                                                                        <tr>

                                                                            <td width="25%" height="20"
                                                                                bgcolor="#FFFFFF" class="usuario"><img
                                                                                    src="images/spacer.gif" width="10"
                                                                                    height="10" />Objetivo LAG:</td>

                                                                            <td width="75%" class="usuario"><select
                                                                                    name="objetivo" class="texto_tareas"
                                                                                    style="width:350px" id="objetivo">

                                                                                    <option value="">--Selecciona--
                                                                                    </option>

                                                                                    <?

						  	$query = "SELECT * from io_principies where revision=$revision order by id";

                            $result = mysqli_query($enlace,$query) or print("<option value=\"ERROR\">".mysqli_error($enlace)."</option>");

                            while($io = mysqli_fetch_assoc($result)){?>

                                                                                    <option value="<? echo $io['id']?>"
                                                                                        <? echo
                                                                                        $ob==$io['id']?"selected":""; ?>
                                                                                        >
                                                                                        <? echo $io['nombre']?>
                                                                                    </option>

                                                                                    <?

                            }

                          ?>

                                                                                </select></td>

                                                                        </tr>

                                                                    </table>
                                                                </td>

                                                            </tr>



                                                        </table>
                                                    </td>

                                                </tr>

                                                <tr>

                                                    <td colspan="2" bgcolor="#FFFFFF">
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">

                                                            <tr>

                                                                <td width="410">
                                                                    <table width="100%" border="0" cellspacing="2"
                                                                        cellpadding="0">

                                                                        <tr>

                                                                            <td width="25%" height="20"
                                                                                bgcolor="#FFFFFF" class="usuario"><img
                                                                                    src="images/spacer.gif" width="10"
                                                                                    height="10" /> Estrategia:</td>

                                                                            <td width="75%" class="usuario"><select
                                                                                    name="estrategia"
                                                                                    class="texto_tareas"
                                                                                    style="width:350px" id="estrategia">

                                                                                    <option value="">--Selecciona--
                                                                                    </option>

                                                                                </select></td>

                                                                        </tr>

                                                                    </table>
                                                                </td>

                                                            </tr>



                                                        </table>
                                                    </td>

                                                </tr>

                                                <tr>

                                                    <td colspan="2" bgcolor="#FFFFFF">
                                                        <table width="100%" border="0" cellspacing="2" cellpadding="0">

                                                            <tr>

                                                                <td width="25%" height="20" bgcolor="#FFFFFF"
                                                                    class="usuario">
                                                                    <p align="left"><img src="images/spacer.gif" alt=""
                                                                            width="10" height="10" />Objetivo SMART

                                                                        :<br />

                                                                        <img src="images/spacer.gif" alt="" width="10"
                                                                            height="10" />(Descripción)
                                                                    </p>
                                                                </td>

                                                                <td width="75%" class="usuario"><textarea
                                                                        name="descripcion" cols="50" rows="4"
                                                                        class="texto_tareas" id="descripcion">

</textarea></td>

                                                            </tr>

                                                        </table>
                                                    </td>

                                                </tr>

                                                <tr>

                                                    <td width="350" bgcolor="#FFFFFF">
                                                        <table width="100%" border="0" cellspacing="2" cellpadding="0">

                                                            <tr>

                                                                <td width="185" height="20" bgcolor="#FFFFFF"
                                                                    class="usuario"><img src="images/spacer.gif"
                                                                        width="10" height="10" /> Fecha Inicio: </td>

                                                                <td width="159" class="usuario"><input name="inicio"
                                                                        type="text" class="texto_tareas" id="inicio"
                                                                        size="15" readonly="readonly" />

                                                                    <div align="left" class="texto_tareas"></div>
                                                                </td>

                                                            </tr>

                                                        </table>
                                                    </td>

                                                    <td width="403" bgcolor="#FFFFFF">
                                                        <table width="100%" border="0" cellspacing="2" cellpadding="0">

                                                            <tr>

                                                                <td width="207" height="20" bgcolor="#FFFFFF"
                                                                    class="usuario"><img src="images/spacer.gif"
                                                                        width="10" height="10" /> Fecha Límite:</td>

                                                                <td width="190" class="usuario"><input name="limite"
                                                                        type="text" class="texto_tareas" id="limite"
                                                                        size="15" readonly="readonly" /></td>

                                                            </tr>

                                                        </table>
                                                    </td>

                                                </tr>



                                                <tr>

                                                    <td colspan="2"><img src="images/spacer.gif" width="10"
                                                            height="20" />

                                                        <table width="100%" border="0" cellspacing="2" cellpadding="0">

                                                            <tr>

                                                                <td height="20" bgcolor="#ced0d1" class="usuario"><img
                                                                        src="images/spacer.gif" width="10"
                                                                        height="10" /> Plan de Acción: </td>

                                                            </tr>

                                                            <tr>

                                                                <td height="20" class="usuario">
                                                                    <table width="100%" border="0">

                                                                        <tr>

                                                                            <td width="46%" bgcolor="#FFFFFF">Accion
                                                                            </td>

                                                                            <td width="16%" bgcolor="#FFFFFF">Fecha
                                                                                Inicio </td>

                                                                            <td width="12%" bgcolor="#FFFFFF">Fecha
                                                                                Límite </td>

                                                                            <td width="6%" bgcolor="#FFFFFF">&nbsp;</td>

                                                                            <td width="20%" bgcolor="#FFFFFF">&nbsp;
                                                                            </td>

                                                                        </tr>

                                                                        <? for($i=1; $i<=10; $i++){?>

                                                                        <tr>

                                                                            <td bgcolor="#FFFFFF"><input
                                                                                    name="accion<? echo $i?>"
                                                                                    type="text" class="texto_tareas"
                                                                                    id="accion<? echo $i?>" size="50" />
                                                                            </td>

                                                                            <td bgcolor="#FFFFFF"><input
                                                                                    name="inicio<? echo $i?>"
                                                                                    type="text" class="texto_tareas"
                                                                                    id="inicio<? echo $i?>" size="15"
                                                                                    readonly="readonly" /></td>

                                                                            <td bgcolor="#FFFFFF"><input
                                                                                    name="fin<? echo $i?>" type="text"
                                                                                    class="texto_tareas"
                                                                                    id="fin<? echo $i?>" size="15"
                                                                                    readonly="readonly" /></td>

                                                                            <td bgcolor="#FFFFFF">&nbsp;</td>

                                                                            <td bgcolor="#FFFFFF">&nbsp;</td>

                                                                        </tr>

                                                                        <? }?>

                                                                    </table>
                                                                </td>

                                                            </tr>

                                                        </table>
                                                    </td>

                                                </tr>



                                                <tr>

                                                    <td colspan="2">&nbsp;</td>

                                                </tr>



                                                <tr>

                                                    <td colspan="2">
                                                        <div align="center"><img src="images/spacer.gif" width="10"
                                                                height="20" />

                                                            <? if(($ver=="1" || $ver=="3")&& $etapa==1){?>

                                                            <a href="javascript:guardar1('1');"
                                                                onmouseout="MM_swapImgRestore()"
                                                                onmouseover="MM_swapImage('Image31<?echo"
                                                                $i";?>','','images/b_agregar_r.png',1)"><img
                                                                    src="images/b_agregar.png" name="Image31<?echo"
                                                                    $i";?>" width="150" height="23" border="0"
                                                                id="Image31
                                                                <?echo"$i";?>" />
                                                            </a>
                                                            <? }?>

                                                        </div>
                                                    </td>

                                                </tr>

                                            </table>

                                            <p>

                                                <? }?>

                                            </p>

                                            <!-- fin plan de accion -->



                                            <?

$cuantos=0;

$query2 = "SELECT objetivos_new.id as id_obj, io_principies.nombre as n_obj, lags.nombre as n_lag, DATE_FORMAT(inicio,'%d-%m-%Y') as inicio, DATE_FORMAT(limite,'%d-%m-%Y') as limite, descripcion, evaluacion, comentario_e, comentario_j, evaluacion_j, io_principies.meta   from objetivos_new inner join io_principies on objetivos_new.id_objetivo=io_principies.id inner join lags on objetivos_new.id_estrategia=lags.id where objetivos_new.revision=$revision and objetivos_new.id_empleado=$verobjetivos order by objetivos_new.id";

$result2 = mysqli_query($enlace,$query2) or print("<option value=\"ERROR\">".mysqli_error($query2)."</option>");

while($lista = mysqli_fetch_assoc($result2)){



$cuantos++;

?>

                                            <!-- objetivo -->

                                            <table width="753" border="0" align="center" cellpadding="0"
                                                cellspacing="0">

                                                <tr>

                                                    <td colspan="2"><img src="images/spacer.gif" width="10"
                                                            height="20" /></td>

                                                </tr>

                                                <tr>

                                                    <td colspan="2">
                                                        <table width="753" border="0" cellspacing="0" cellpadding="0">

                                                            <tr>

                                                                <td height="28" background="images/titulos_franjas.jpg">
                                                                    <table width="100%" border="0" cellspacing="0"
                                                                        cellpadding="0">

                                                                        <tr>

                                                                            <td width="10" bgcolor="#333300"><img
                                                                                    src="images/spacer.gif" width="15"
                                                                                    height="28" /></td>

                                                                            <td bgcolor="#333300"
                                                                                class="text_mediano_blanco"
                                                                                style="color:#FFFFFF;">OBJETIVO</td>

                                                                            <input type="hidden" name="id_objetivo[]"
                                                                                id="id_objetivo<? echo $cuantos?>"
                                                                                value="<? echo $lista['id_obj']?>">

                                                                        </tr>

                                                                    </table>
                                                                </td>

                                                            </tr>

                                                        </table>
                                                    </td>

                                                </tr>

                                                <tr>

                                                    <td colspan="2" bgcolor="#FFFFFF">
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">

                                                            <tr>

                                                                <td width="410">
                                                                    <table width="100%" border="0" cellspacing="2"
                                                                        cellpadding="0">

                                                                        <tr>

                                                                            <td width="25%" height="20"
                                                                                bgcolor="#FFFFFF" class="usuario"><img
                                                                                    src="images/spacer.gif" width="10"
                                                                                    height="10" />Objetivo LAG:</td>

                                                                            <td width="75%" class="usuario">
                                                                                <? echo $lista['n_obj'];?>
                                                                            </td>

                                                                        </tr>

                                                                    </table>
                                                                </td>

                                                            </tr>

                                                        </table>
                                                    </td>

                                                </tr>

                                                <tr>

                                                    <td colspan="2" bgcolor="#FFFFFF">
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">

                                                            <tr>

                                                                <td width="410">
                                                                    <table width="100%" border="0" cellspacing="2"
                                                                        cellpadding="0">

                                                                        <tr>

                                                                            <td width="25%" height="20"
                                                                                bgcolor="#FFFFFF" class="usuario"><img
                                                                                    src="images/spacer.gif" width="10"
                                                                                    height="10" /> Estrategia:</td>

                                                                            <td width="75%" class="usuario">
                                                                                <? echo $lista['n_lag'];?>
                                                                            </td>

                                                                        </tr>

                                                                    </table>
                                                                </td>

                                                            </tr>



                                                        </table>
                                                    </td>

                                                </tr>

                                                <tr>

                                                    <td colspan="2" bgcolor="#FFFFFF">
                                                        <table width="100%" border="0" cellspacing="2" cellpadding="0">

                                                            <tr>

                                                                <td width="25%" height="20" bgcolor="#FFFFFF"
                                                                    class="usuario">
                                                                    <p align="left"><img src="images/spacer.gif" alt=""
                                                                            width="10" height="10" />Objetivo SMART

                                                                        :<br />

                                                                        <img src="images/spacer.gif" alt="" width="10"
                                                                            height="10" />(Descripción)
                                                                    </p>
                                                                </td>

                                                                <td width="75%" class="usuario">
                                                                    <? echo $lista['descripcion'];?>
                                                                </td>

                                                            </tr>

                                                        </table>
                                                    </td>

                                                </tr>

                                                <tr>

                                                    <td width="350" bgcolor="#FFFFFF">
                                                        <table width="100%" border="0" cellspacing="2" cellpadding="0">

                                                            <tr>

                                                                <td width="185" height="20" bgcolor="#FFFFFF"
                                                                    class="usuario"><img src="images/spacer.gif"
                                                                        width="10" height="10" /> Fecha Inicio: </td>

                                                                <td width="159" class="usuario">
                                                                    <? echo $lista['inicio'];?>

                                                                    <div align="left" class="texto_tareas"></div>
                                                                </td>

                                                            </tr>

                                                        </table>
                                                    </td>

                                                    <td width="403" bgcolor="#FFFFFF">
                                                        <table width="100%" border="0" cellspacing="2" cellpadding="0">

                                                            <tr>

                                                                <td width="207" height="20" bgcolor="#FFFFFF"
                                                                    class="usuario"><img src="images/spacer.gif"
                                                                        width="10" height="10" /> Fecha Límite:</td>

                                                                <td width="190" class="usuario">
                                                                    <? echo $lista['limite'];?>
                                                                </td>

                                                            </tr>

                                                        </table>
                                                    </td>

                                                </tr>

                                                <tr>

                                                    <td bgcolor="#FFFFFF">
                                                        <table width="100%" border="0" cellspacing="2" cellpadding="0">

                                                            <tr>

                                                                <td width="206" height="20" bgcolor="#FFFFFF"
                                                                    class="usuario"><img src="images/spacer.gif"
                                                                        width="10" height="10" />Resultado Final del
                                                                    Objetivo LAG: </td>

                                                                <td width="138" class="usuario">
                                                                    <? echo $lista['meta'];?>

                                                                    <div align="left" class="texto_tareas"></div>
                                                                </td>

                                                            </tr>

                                                        </table>
                                                    </td>

                                                    <td bgcolor="#FFFFFF">&nbsp;</td>

                                                </tr>

                                                <tr>

                                                    <td colspan="2" bgcolor="#FFFFFF">
                                                        <div align="right"><img src="images/spacer.gif" width="10"
                                                                height="20" />

                                                            <? if($etapa == 1){?>

                                                            <a href="editar_objetivo.php?id=<? echo $lista['id_obj'];?>"
                                                                onmouseout="MM_swapImgRestore()"
                                                                onmouseover="MM_swapImage('Image31<?echo"
                                                                $i";?>','','images/icon_editar_r.png',1)"
                                                                class="iframe2"><img title="Editar objetivo"
                                                                    src="images/icon_editar.png" name="Image31<?echo"
                                                                    $i";?>" width="20" height="20" border="0"
                                                                id="Image31
                                                                <?echo"$i";?>" />
                                                            </a>

                                                            <a href="eliminar_objetivo.php?id=<? echo $lista['id_obj'];?>"
                                                                onmouseout="MM_swapImgRestore()"
                                                                onmouseover="MM_swapImage('Image31<?echo"
                                                                $i";?>','','images/icon_eliminar.png',1)"
                                                                class="iframe2"><img title="Eliminar objetivo"
                                                                    src="images/icon_eliminar.png" name="Image31<?echo"
                                                                    $i";?>" width="22" height="22" border="0"
                                                                id="Image31
                                                                <?echo"$i";?>" />
                                                            </a>

                                                            <? }?>

                                                        </div>

                                                        <table width="100%" border="0" cellspacing="2" cellpadding="0">

                                                            <tr>

                                                                <td height="20" bgcolor="#ced0d1" class="usuario"><img
                                                                        src="images/spacer.gif" width="10"
                                                                        height="10" /> Plan de Acción: </td>

                                                            </tr>

                                                            <tr>

                                                                <td height="20" class="usuario">
                                                                    <table width="100%" border="0">

                                                                        <tr>

                                                                            <td width="46%" bgcolor="#FFFFFF">Accion
                                                                            </td>

                                                                            <td width="16%" bgcolor="#FFFFFF">Fecha
                                                                                Inicio </td>

                                                                            <td width="12%" bgcolor="#FFFFFF">Fecha
                                                                                Límite </td>

                                                                            <td width="6%" bgcolor="#FFFFFF">Estatus
                                                                            </td>

                                                                            <td width="20%" bgcolor="#FFFFFF">Comentario
                                                                            </td>

                                                                        </tr>

                                                                        <?

$query3 = "SELECT id,accion, estatus, DATE_FORMAT(inicio,'%d-%m-%Y') as inicio, DATE_FORMAT(limite,'%d-%m-%Y') as limite, comentario  from acciones_new  where revision=$revision and id_objetivo=".$lista['id_obj']." and accion<>''order by id";

$result3 = mysqli_query($enlace,$query3) or print("<option value=\"ERROR\">".mysqli_error($enlace)."</option>");

while($lista3 = mysqli_fetch_assoc($result3)){

?>

                                                                        <tr>

                                                                            <td bgcolor="#FFFFFF">
                                                                                <? echo $lista3['accion'] ;?>
                                                                            </td>

                                                                            <td bgcolor="#FFFFFF">
                                                                                <? echo $lista3['inicio'] ;?>
                                                                            </td>

                                                                            <td bgcolor="#FFFFFF">
                                                                                <? echo $lista3['limite'] ;?>
                                                                            </td>

                                                                            <td bgcolor="#FFFFFF"><select
                                                                                    name="estatus<? echo $lista3['id']?>"
                                                                                    id="estatus">

                                                                                    <option value="0" <?
                                                                                        if($lista3['estatus']==0)
                                                                                        echo"selected";?>>Abierto
                                                                                    </option>

                                                                                    <option value="1" <?
                                                                                        if($lista3['estatus']==1)
                                                                                        echo"selected";?>>Cerrado
                                                                                    </option>

                                                                                </select></td>

                                                                            <td bgcolor="#FFFFFF"><input
                                                                                    name="comentario<? echo $lista3['id']?>"
                                                                                    type="text" id="comentario"
                                                                                    value="<? echo $lista3['comentario'];?>" />

                                                                                <input name="accion[]" type="hidden"
                                                                                    id="accion"
                                                                                    value="<? echo $lista3['id'];?>" />
                                                                            </td>

                                                                        </tr>

                                                                        <? }?>

                                                                    </table>
                                                                </td>

                                                            </tr>

                                                        </table>
                                                    </td>

                                                </tr>

                                                <tr>

                                                    <td colspan="2">

                                                        <?

				  if($etapa>=3){

				  

				  

				  ?>

                                                        <table width="100%" border="0" cellspacing="2" cellpadding="0">

                                                            <tr>

                                                                <td height="20" bgcolor="#ced0d1" class="usuario"><img
                                                                        src="images/spacer.gif" width="10"
                                                                        height="10" /> Cierre de Objetivos:

                                                                    <input name="list_obj[]" type="hidden"
                                                                        id="list_obj[]"
                                                                        value="<? echo $lista['id_obj'];?>" />
                                                                </td>

                                                            </tr>

                                                            <tr>

                                                                <td height="20" class="usuario">
                                                                    <table width="100%" border="0">

                                                                        <tr>

                                                                            <td width="53%" bgcolor="#FFFFFF">
                                                                                Coementarios del Colaborador </td>

                                                                            <td width="47%" bgcolor="#FFFFFF">Nivel de
                                                                                Cumplimiento del Objetivo </td>

                                                                        </tr>



                                                                        <tr>

                                                                            <td bgcolor="#FFFFFF"><textarea
                                                                                    name="f_comentario<? echo $lista['id_obj'] ;?>"
                                                                                    cols="50" rows="4"
                                                                                    id="f_comentario<? echo $lista['id_obj'] ;?>"><? echo $lista['comentario_e'] ;?>

</textarea></td>

                                                                            <td rowspan="3" valign="top"
                                                                                bgcolor="#FFFFFF">
                                                                                <table width="100%" border="0">

                                                                                    <tr>

                                                                                        <td width="23%">&nbsp;</td>

                                                                                        <td width="22%"
                                                                                            bgcolor="#FF0000">
                                                                                            <div align="center"
                                                                                                class="style1">No Cumple
                                                                                            </div>
                                                                                        </td>

                                                                                        <td width="24%"
                                                                                            bgcolor="#FFCC00">
                                                                                            <div align="center"
                                                                                                class="style1">
                                                                                                Parcialmente Cumple
                                                                                            </div>
                                                                                        </td>

                                                                                        <td width="19%"
                                                                                            bgcolor="#66CC99">
                                                                                            <div align="center"
                                                                                                class="style1">Cumple
                                                                                            </div>
                                                                                        </td>

                                                                                        <td width="12%"
                                                                                            bgcolor="#00CC00">
                                                                                            <div align="center"
                                                                                                class="style1">Excede
                                                                                            </div>
                                                                                        </td>

                                                                                    </tr>

                                                                                    <tr>

                                                                                        <td bgcolor="#CCCCCC">Rating del
                                                                                            Colaborador </td>

                                                                                        <td bgcolor="#CCCCCC">

                                                                                            <div align="center">

                                                                                                <input
                                                                                                    name="f_empleado<? echo $lista['id_obj'] ;?>"
                                                                                                    type="radio"
                                                                                                    value="1" <?
                                                                                                    if($lista['evaluacion']=="1"
                                                                                                    )echo"checked=\"checked\"";?>
                                                                                                requiered/>

                                                                                            </div>
                                                                                        </td>

                                                                                        <td bgcolor="#CCCCCC">
                                                                                            <div align="center">

                                                                                                <input
                                                                                                    name="f_empleado<? echo $lista['id_obj'] ;?>"
                                                                                                    type="radio"
                                                                                                    value="2" <?
                                                                                                    if($lista['evaluacion']=="2"
                                                                                                    )echo"checked=\"checked\"";?>
                                                                                                requiered/>

                                                                                            </div>
                                                                                        </td>

                                                                                        <td bgcolor="#CCCCCC">
                                                                                            <div align="center">

                                                                                                <input
                                                                                                    name="f_empleado<? echo $lista['id_obj'] ;?>"
                                                                                                    type="radio"
                                                                                                    value="3" <?
                                                                                                    if($lista['evaluacion']=="3"
                                                                                                    )echo"checked=\"checked\"";?>
                                                                                                requiered/>

                                                                                            </div>
                                                                                        </td>

                                                                                        <td bgcolor="#CCCCCC">
                                                                                            <div align="center">

                                                                                                <input
                                                                                                    name="f_empleado<? echo $lista['id_obj'] ;?>"
                                                                                                    type="radio"
                                                                                                    value="4" <?
                                                                                                    if($lista['evaluacion']=="4"
                                                                                                    )echo"checked=\"checked\"";?>
                                                                                                requiered/>

                                                                                            </div>
                                                                                        </td>

                                                                                    </tr>

                                                                                    <? if($etapa==3 &&  $verFinal=="8"){}else{?>

                                                                                    <tr>

                                                                                        <td bgcolor="#999999">Rating de
                                                                                            Gerente </td>

                                                                                        <td bgcolor="#999999">
                                                                                            <div align="center">

                                                                                                <input
                                                                                                    name="f_jefe<? echo $lista['id_obj'] ;?>"
                                                                                                    type="radio"
                                                                                                    value="1" <?
                                                                                                    if($lista['evaluacion_j']=="1"
                                                                                                    )echo"checked=\"checked\"";?>
                                                                                                requiered/>

                                                                                            </div>
                                                                                        </td>

                                                                                        <td bgcolor="#999999">
                                                                                            <div align="center">

                                                                                                <input
                                                                                                    name="f_jefe<? echo $lista['id_obj'] ;?>"
                                                                                                    type="radio"
                                                                                                    value="2" <?
                                                                                                    if($lista['evaluacion_j']=="2"
                                                                                                    )echo"checked=\"checked\"";?>
                                                                                                requiered/>

                                                                                            </div>
                                                                                        </td>

                                                                                        <td bgcolor="#999999">
                                                                                            <div align="center">

                                                                                                <input
                                                                                                    name="f_jefe<? echo $lista['id_obj'] ;?>"
                                                                                                    type="radio"
                                                                                                    value="3" <?
                                                                                                    if($lista['evaluacion_j']=="3"
                                                                                                    )echo"checked=\"checked\"";?>
                                                                                                requiered/>

                                                                                            </div>
                                                                                        </td>

                                                                                        <td bgcolor="#999999">
                                                                                            <div align="center">

                                                                                                <input
                                                                                                    name="f_jefe<? echo $lista['id_obj'] ;?>"
                                                                                                    type="radio"
                                                                                                    value="4" <?
                                                                                                    if($lista['evaluacion_j']=="4"
                                                                                                    )echo"checked=\"checked\"";?>
                                                                                                requiered/>

                                                                                            </div>
                                                                                        </td>

                                                                                    </tr>

                                                                                    <? }?>

                                                                                </table>
                                                                            </td>

                                                                        </tr>

                                                                        <tr>

                                                                            <td bgcolor="#FFFFFF">Comentarios del
                                                                                Gerente </td>

                                                                        </tr>

                                                                        <tr>

                                                                            <td bgcolor="#FFFFFF">

                                                                                <textarea
                                                                                    name="f_j_comentario<? echo $lista['id_obj'] ;?>"
                                                                                    cols="50" rows="4"
                                                                                    id="f_j_comentario<? echo $lista['id_obj'] ;?>"><? echo $lista['comentario_j'] ;?></textarea>
                                                                            </td>

                                                                        </tr>



                                                                    </table>
                                                                </td>

                                                            </tr>

                                                        </table>

                                                        <?

				  }

				  ?>
                                                    </td>

                                                </tr>

                                                <tr>

                                                    <td colspan="2">
                                                        <div align="center"><img src="images/spacer.gif" width="10"
                                                                height="20" />

                                                            <? //if(($ver=="1" || $ver=="3")&& $etapa==1 && 1>2){

                            if(($ver=="1" || $ver=="3")&& $etapa==1 && 1>2){

                            ?>



                                                            <input type="button" name="Button" value="Guardar"
                                                                onclick="guardar('2')" />



                                                            <? }

                     

                     if($etapa==2 && ($verobjetivos!=$id_jefe)){

                      

                      ?>



                                                            <input class="button" type="button" name="Button"
                                                                value="Guardar"
                                                                onclick="guardar_comentarios_acciones()" />



                                                            <? }

					

					if($etapa==3 &&  $verFinal=="8"){

                      

                      ?>



                                                            <input class="button" type="button" name="Button"
                                                                value="Guardar" onclick="guardar_final_e()" />



                                                            <? }

					if($etapa==3 &&  $verFinal=="9"){

                      

                      ?>



                                                            <input class="button" type="button" name="Button"
                                                                value="Guardar" onclick="guardar_final_j()" />



                                                            <? }

                    ?>



                                                        </div>
                                                    </td>

                                                </tr>

                                            </table>

                                            <p>

                                                <? }?>

                                                <!-- fin objetivo -->

                                            </p>

                                            <? if( ((($verFinal==10 ) || ($verFinal==9 )) && $etapa>=3 && $tipo_usuario=="Jefe")  ){//|| $etapa==4?>

                                            <table width="330" border="1" align="center" cellpadding="0"
                                                cellspacing="0">

                                                <tr>

                                                    <td colspan="2" bgcolor="#ced0d1">
                                                        <div align="center">

                                                            <? if($verFinal!="9") $disabled="disabled"; else $disabled="";?>

                                                            Final Rating
                                                        </div>
                                                    </td>

                                                </tr>

                                                <tr>

                                                    <td width="71" bgcolor="#FFFFFF">

                                                        <div align="center">

                                                            <input <? echo $disabled;?> type="radio" name="rFinal"
                                                            value="1" id="rFinal"
                                                            <? echo $planes[8]=='1'?'checked':""; ?>/>

                                                            <!--<input <? echo $disabled;?> type="radio" name="rFinal" value="5" id="rFinal" <? echo $planes[8]=='5'?'checked':""; ?>/>

                    5-->

                                                        </div>
                                                    </td>

                                                    <td width="253" bgcolor="#FFFFFF">Supera las expectativas </td>

                                                </tr>

                                                <tr>

                                                    <td bgcolor="#FFFFFF">
                                                        <div align="center">

                                                            <input <? echo $disabled;?> type="radio" name="rFinal"
                                                            value="2" id="radio3"
                                                            <? echo $planes[8]=='2'?'checked':""; ?>/>

                                                        </div>
                                                    </td>

                                                    <td bgcolor="#FFFFFF">Cumple con las expectativas </td>

                                                </tr>

                                                <tr>

                                                    <td bgcolor="#FFFFFF">
                                                        <div align="center">

                                                            <input <? echo $disabled;?> type="radio" name="rFinal"
                                                            value="3" id="radio2"
                                                            <? echo $planes[8]=='3'?'checked':""; ?>/>

                                                        </div>
                                                    </td>

                                                    <td bgcolor="#FFFFFF">Parcialmente cumple con las expectativas </td>

                                                </tr>

                                                <tr>

                                                    <td bgcolor="#FFFFFF">
                                                        <div align="center">

                                                            <input <? echo $disabled;?> type="radio" name="rFinal"
                                                            value="4" id="radio"
                                                            <? echo $planes[8]=='4'?'checked':""; ?>/>

                                                        </div>
                                                    </td>

                                                    <td bgcolor="#FFFFFF">No cumple la mayoria de las expectativas </td>

                                                </tr>

                                                <tr>

                                                    <td colspan="2" bgcolor="#ced0d1">
                                                        <div align="center">Clasification</div>
                                                    </td>

                                                </tr>

                                                <tr>

                                                    <td colspan="2" bgcolor="#FFFFFF">
                                                        <div align="center">

                                                            <input <? echo $disabled;?> type="radio" name="clasFinal"
                                                            value="1" id="clasFinal"
                                                            <? echo $planes[9]=='1'?'checked':""; ?>/>

                                                            Bajo

                                                            <input <? echo $disabled;?> type="radio" name="clasFinal"
                                                            value="2" id="clasFinal"
                                                            <? echo $planes[9]=='2'?'checked':""; ?>/>

                                                            Medio

                                                            <input <? echo $disabled;?> type="radio" name="clasFinal"
                                                            value="3" id="clasFinal"
                                                            <? echo $planes[9]=='3'?'checked':""; ?>/>

                                                            Alto
                                                        </div>
                                                    </td>

                                                </tr>

                                            </table>

                                            <? }?>

                                            <table width="400" border="0" align="center">

                                                <tr>

                                                    <td bgcolor="#CCCCCC">
                                                        <div align="center">Comentario Final del Colaborador </div>
                                                    </td>

                                                </tr>

                                                <tr>

                                                    <td>
                                                        <div align="center">

                                                            <textarea name="final_empleado" cols="50" rows="4"
                                                                id="final_empleado"><? echo $comentario_final_e ;?></textarea>

                                                        </div>
                                                    </td>

                                                </tr>

                                                <tr>

                                                    <td bgcolor="#999999">
                                                        <div align="center">Comentario Final del Gerente </div>
                                                    </td>

                                                </tr>

                                                <tr>

                                                    <td>
                                                        <div align="center">

                                                            <textarea name="final_jefe" cols="50" rows="4"
                                                                id="final_jefe"><? echo $comentario_final_j ;?></textarea>

                                                        </div>
                                                    </td>

                                                </tr>

                                            </table>

                                            <p>&nbsp;</p>

                                            <p align="center">

                                                <?

				//firma cierre final

				 if( ($verFinal==8 )  && $etapa==3){?>

                                                <a href="javascript:firmarFinal_e();" onmouseout="MM_swapImgRestore()"
                                                    onmouseover="MM_swapImage('Image11','','images/b_firmarn_r.png',1)">
                                                    <img src="images/b_firmarn.png" name="Image11" width="150"
                                                        height="23" border="0" id="Image11" /></a>

                                                <? } 

				  if( ($verFinal==9 ) && $etapa==3){?>

                                                <a href="javascript:firmarFinal_j();" onmouseout="MM_swapImgRestore()"
                                                    onmouseover="MM_swapImage('Image11','','images/b_firmarn_r.png',1)">
                                                    <img src="images/b_firmarn.png" name="Image11" width="150"
                                                        height="23" border="0" id="Image11" /></a>

                                                <? }?>



                                                <? if($ver=="1" && $etapa==1){?>

                                                <a href="javascript:firmar();" onmouseout="MM_swapImgRestore()"
                                                    onmouseover="MM_swapImage('Image32','','images/b_firmarn_r.png',1)"><img
                                                        src="images/b_firmarn.png" name="Image32" width="150"
                                                        height="23" border="0" id="Image32" /></a>

                                                <input name="firma1" type="hidden" id="firma1" />

                                                <? }?>

                                                <? if($ver=="3" && $etapa==1){?>

                                                <a href="javascript:firmarR();" onmouseout="MM_swapImgRestore()"
                                                    onmouseover="MM_swapImage('Image321','','images/b_firmarn_r.png',1)"><img
                                                        src="images/b_firmarn.png" name="Image321" width="150"
                                                        height="23" border="0" id="Image321" /></a>&nbsp;&nbsp;&nbsp;

                                                <a href="javascript:desfirmarR();" onmouseout="MM_swapImgRestore()"
                                                    onmouseover="MM_swapImage('Image321','','images/b_desfirmar_r.png',1)">
                                                    <img src="images/b_desfirmar.png" name="Image321" width="150"
                                                        height="23" border="0" id="Image321" /></a>

                                                <input name="firma2" type="hidden" id="firma2" />

                                                <? }?>

                                                <?

				//firma check point 

				 if(  $soy_jefe==1 && $etapa==2 && $firma3e==NULL){?>

                                                <a href="javascript:firmarMidYearReview(<? echo !$entroEmpleado?'true':'false';?>);"
                                                    onmouseout="MM_swapImgRestore()"
                                                    onmouseover="MM_swapImage('Image1','','images/b_firmarn_r.png',1)">

                                                    <img src="images/b_firmarn.png" name="Image1" width="150"
                                                        height="23" border="0" id="Image1" /></a>

                                                <? }

				if(  $soy_jefe==0 && $etapa==2 && $firma3j==NULL && $firma3e!=NULL){?>

                                                <a href="javascript:firmarMidYearReviewJ(<? echo !$entroEmpleado?'true':'false';?>);"
                                                    onmouseout="MM_swapImgRestore()"
                                                    onmouseover="MM_swapImage('Image1','','images/b_firmarn_r.png',1)">

                                                    <img src="images/b_firmarn.png" name="Image1" width="150"
                                                        height="23" border="0" id="Image1" /></a>

                                                <? }?>

                                                <? 

				//firma check point con objetivos desbloqueados

				if( (($verChP==5 && $ver==1) || ($verChP==6 && $ver==3)) && $etapa==2 && 1>2){?>

                                                <a href="javascript:firmarMidYearReviewDes(<? echo !$entroEmpleado?'true':'false';?>);"
                                                    onmouseout="MM_swapImgRestore()"
                                                    onmouseover="MM_swapImage('Image1','','images/b_firmarn_r.png',1)">

                                                    <img src="images/b_firmarn.png" name="Image1" width="150"
                                                        height="23" border="0" id="Image1" /></a>

                                                <? }?>

                                                <? if($_SESSION["idA"]=="1" && $verChP == 7){?>

                                                <input name="desfirmarMidYearReview" type="submit"
                                                    id="desfirmar_MidYearReview" value="Desfirmar Mid Year Review" />

                                                <? } ?>

                                                <? if($_SESSION["idA"]=="1" && $firma3e!=null && 1>2){?>

                                                <input name="desbloquearMidYearReview" type="submit"
                                                    id="desbloquearMidYearReview" value="Desbloquear Mid Year Review" />

                                                <? } ?>

                                                <? if($_SESSION["idA"]=="1" && $verChP == 7&& 1>2 ){?>

                                                <input name="desfirmarCierre" type="submit" id="desfirmarCierre"
                                                    value="Desfirmar Cierre Objetivos" />

                                                <? } ?>

                                                <? if($_SESSION["idA"]=="1" && $firma3e!=null && 1>2){?>

                                                <input name="desbloquearCierre" type="submit" id="desbloquearCierre"
                                                    value="Desbloquear Cierre Objetivos" />

                                                <? } ?>

                                            </p>
                                        </td>

                                    </tr>

                                    <tr>

                                        <td valign="top" bgcolor="#eeeeee">&nbsp;</td>

                                    </tr>

                                </table>
                            </td>

                        </tr>

                        <tr>

                            <td><img src="images/spacer.gif" width="10" height="50" /></td>

                        </tr>

                        <tr>

                            <td>
                                <table width="386" border="0" align="center" cellpadding="0" cellspacing="0">

                                    <tr>

                                        <td width="145"><a href="cambia_pass.php?id=<?echo" $idU";?>" class="iframe2"
                                                onmouseout="MM_swapImgRestore()"
                                                onmouseover="MM_swapImage('Image21','','images/b_cambio_r.png',1)"><img
                                                    src="images/b_cambio.png" name="Image21" width="150" height="23"
                                                    border="0" id="Image21" /></a></td>

                                        <td><img src="images/spacer.gif" width="16" height="20" /></td>

                                        <td width="114">

                                            <? if($_SESSION["idA"]=="1"){?>

                                            <a href="admin.php" onmouseout="MM_swapImgRestore()"
                                                onmouseover="MM_swapImage('Image24','','images/b_administracion_r.png',1)"><img
                                                    src="images/b_administracion.png" name="Image24" width="150"
                                                    height="23" border="0" id="Image24" /></a>

                                            <? }?>
                                        </td>

                                        <td><img src="images/spacer.gif" width="17" height="20" /></td>

                                        <td><a href="logout.php" onmouseout="MM_swapImgRestore()"
                                                onmouseover="MM_swapImage('Image25','','images/b_log_out_r.png',1)"><img
                                                    src="images/b_log_out.png" name="Image25" width="150" height="23"
                                                    border="0" id="Image25" /></a></td>

                                        <td>&nbsp;</td>

                                        <td>&nbsp;</td>

                                    </tr>

                                </table>
                            </td>

                        </tr>

                        <tr>

                            <td><img src="images/spacer.gif" width="10" height="20" /></td>

                        </tr>

                    </table>
                </td>

            </tr>

            <tr>

                <table width="100%" border="0" cellspacing="0" cellpadding="0">

                    <tr>

                        <td bgcolor="#322110"><img src="images/spacer.gif" alt="" width="10" height="30" /></td>

                    </tr>

                </table>

            </tr>

        </table>

        <script>
        function validar()

        {



            if ( <? echo "$cuantos"; ?>== "0")

            {

                alert("Debe agregar almenos un objetivo ");

                document.form1.objetivo.focus();

                return false;

            } else

                return true;

        }



        function validarFinal_e() {

            //validar textarea jefe o usuario

            <?



            $cuantos = 0;

            $query2 =
                "SELECT objetivos_new.id as id_obj, io_principies.nombre as n_obj, lags.nombre as n_lag, DATE_FORMAT(inicio,'%d-%m-%Y') as inicio, DATE_FORMAT(limite,'%d-%m-%Y') as limite, descripcion, evaluacion, comentario_e, comentario_j  from objetivos_new inner join io_principies on objetivos_new.id_objetivo=io_principies.id inner join lags on objetivos_new.id_estrategia=lags.id where objetivos_new.revision=$revision and objetivos_new.id_empleado=$verobjetivos order by objetivos_new.id";

            $result2 = mysqli_query($enlace, $query2) or print("<option value=\"ERROR\">".mysqli_error($result2).
                "</option>");

            while ($lista = mysqli_fetch_assoc($result2)) {



                $cuantos++;



                ?>

                if (document.form1.f_empleado<? echo $lista['id_obj']; ?>[0].checked == false &&

                    document.form1.f_empleado<? echo $lista['id_obj']; ?>[1].checked == false &&

                    document.form1.f_empleado<? echo $lista['id_obj']; ?>[2].checked == false &&

                    document.form1.f_empleado<?  echo $lista['id_obj']; ?>[3].checked == false)

                {

                    document.form1.f_empleado<? echo $lista['id_obj']; ?>[0].focus();

                    alert('Falto evaluacion de objetivo <? echo"$cuantos";?>');

                    return false;

                }

                if (document.form1.f_comentario<? echo $lista['id_obj']; ?>.value == "") {

                    document.form1.f_comentario<? echo $lista['id_obj']; ?>.focus();

                    alert('Falto comentario del objetivo <? echo"$cuantos";?>');

                    return false;

                }

                <?
            } ?>



            if (document.form1.final_empleado.value == "") {

                document.form1.final_empleado.focus();

                alert('Falto Comentario final');

                return false;

            }









            return true;

        }

        function validarFinal_j() {

            //validar textarea jefe o usuario

            <?



            $cuantos = 0;

            $query2 =
                "SELECT objetivos_new.id as id_obj, io_principies.nombre as n_obj, lags.nombre as n_lag, DATE_FORMAT(inicio,'%d-%m-%Y') as inicio, DATE_FORMAT(limite,'%d-%m-%Y') as limite, descripcion, evaluacion, comentario_e, comentario_j  from objetivos_new inner join io_principies on objetivos_new.id_objetivo=io_principies.id inner join lags on objetivos_new.id_estrategia=lags.id where objetivos_new.revision=$revision and objetivos_new.id_empleado=$verobjetivos order by objetivos_new.id";

            $result2 = mysqli_query($enlace, $query2) or print("<option value=\"ERROR\">".mysqli_error($result2).
                "</option>");

            while ($lista = mysqli_fetch_assoc($result2)) {



                $cuantos++;



                ?>

                if (document.form1.f_jefe<? echo $lista['id_obj']; ?>[0].checked == false &&

                    document.form1.f_jefe<? echo $lista['id_obj']; ?>[1].checked == false &&

                    document.form1.f_jefe<? echo $lista['id_obj']; ?>[2].checked == false &&

                    document.form1.f_jefe<? echo $lista['id_obj']; ?>[3].checked == false)

                {

                    document.form1.f_jefe<? echo $lista['id_obj']; ?>[0].focus();

                    alert('Falto evaluacion de objetivo <? echo"$cuantos";?>');

                    return false;

                }

                if (document.form1.f_j_comentario<? echo $lista['id_obj']; ?>.value == "") {

                    document.form1.f_j_comentario<? echo $lista['id_obj']; ?>.focus();

                    alert('Falto comentario del objetivo <? echo"$cuantos";?>');

                    return false;

                }

                <?
            } ?>





            if (document.form1.rFinal[0].checked == false && document.form1.rFinal[1].checked == false && document.form1
                .rFinal[2].checked == false && document.form1.rFinal[3].checked == false) {

                document.form1.rFinal[0].focus();

                alert('Falto evaluacion final');

                return false;

            }

            if (document.form1.clasFinal[0].checked == false && document.form1.clasFinal[1].checked == false && document
                .form1.clasFinal[2].checked == false) {

                document.form1.rFinal[0].focus();

                alert('Falto clasificacion final');

                return false;

            }



            if (document.form1.final_jefe.value == "") {

                document.form1.final_jefe.focus();

                alert('Falto Comentario final');

                return false;

            }



            return true;

        }
        </script>

    </form>

</body>

</html>