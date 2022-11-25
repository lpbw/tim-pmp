<?
	session_start();
	include "checar_sesion_admin.php";
	include "coneccion_i.php";
	$idU=$_SESSION['idU'];
	$idA=$_SESSION['idA'];
	//echo $idA;
	$plan=$res[0];
	$estatus="";
	$firma1e="";
	$firma2e="";
	$firma1j="";
	$firma2j="";
	$consulta  = "SELECT revision, etapa, etapa_360, retro from etapa where id=1";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_row($resultado);
		$revision=$res[0];
		$etapa=$res[1];
		$etapa360=$res[2];
		$retro=$res[3];
		if($etapa=="1")
			$etapa_name="Planeación";
		else
		{
			if($etapa=="2")
				$etapa_name="Revisión Intermedia";
			else
			{
				if($etapa=="3")
					$etapa_name="Revisión Final";
				else
				{
					if($etapa=="4")
						$etapa_name="Ver Resultados";
					else
					{

					}
				}
			}
		}
	}
	// Obtener informacion del plan
	$consulta  = "SELECT id, estatus, firma_e_i, firma_e_f, firma_j_i, firma_j_f, estatus_360, retro, descripcion_vista from planes where id_empleado=$idU and revision=$revision";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_row($resultado);
		$plan=$res[0];//id
		$estatus=$res[1];
		$firma1e=$res[2];
		$firma2e=$res[3];
		$firma1j=$res[4];
		$firma2j=$res[5];
		$estatus360=$res[6];
		$retro_e=$res[7];
		$leido=$res[8];
	}
	// Obtener informacion del plan de desarrollo
	$plan_des="";
	$consulta  = "SELECT id,  firma_e, firma_e_fin, firma_j, firma_j_fin from plan_desarrollo where id_usuario=$idU and revision=$revision";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_row($resultado);
		$plan_des=$res[0];//id
		$firma1e_des=$res[1];
		$firma2e_des=$res[2];
		$firma1j_des=$res[3];
		$firma2j_des=$res[4];
		
	}
	
	$consulta  = "SELECT id_jefe, puesto from usuarios where id=$idU";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_row($resultado);
		$jefe=$res[0];
		$puesto=$res[1];
		//$puesto=3;
		/*echo "<script>alert('$puesto');</script>";*/
	}
	/*if($_POST['leido']=="1")
	{*/
		$consulta  = "update planes set descripcion_vista=1 where id_empleado=$idU and revision=$revision";
		$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta " . mysqli_error($enlace));
		$leido="1";
	/*}*/
	//echo $puesto;
	?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>
<link type="text/css" href="css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<link rel="stylesheet" href="colorbox.css" />
<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
<script src="colorbox/jquery.colorbox-min.js"></script>

<SCRIPT>
	$(document).ready(function(){
		$(".iframe2").colorbox({iframe:true,width:"450", height:"320",transition:"fade", scrolling:false, opacity:0.1});
		$(".iframe1").colorbox({iframe:true,width:"500", height:"320",transition:"fade", scrolling:true, opacity:0.7});
		$("#click").click(function(){
			$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
			return false;
		});
	});		
		$(document).ready(function(){
		$(".iframe2").colorbox({iframe:true,width:"450", height:"320",transition:"fade", scrolling:false, opacity:0.1});
		$(".iframe1").colorbox({iframe:true,width:"500", height:"320",transition:"fade", scrolling:true, opacity:0.7});
		$("#click").click(function(){
			$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
			return false;
		});
	});
</script>
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

			.texto_tarea {
				color: #fff;
				text-decoration: none;
				font-family: "Century Gothic", CenturyGothic, AppleGothic, sans-serif;
				font-size: 13px;
				font-style: normal;
				font-variant: normal;
				font-weight: 400;
				line-height: 13px;
			}

			.centrar {
				margin-left: 8%;
				margin-top: 0.5%;
				height: 24px;
			}

			.centrar1 {
				margin-left: 8%;
				margin-top: -3%;
				height: 24px;
			}
		</style>
		<script type="text/javascript">
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

			function MM_findObj(n, d) { //v4.01
				var p, i, x;
				if (!d) d = document;
				if ((p = n.indexOf("?")) > 0 && parent.frames.length) {
					d = parent.frames[n.substring(p + 1)].document;
					n = n.substring(0, p);
				}
				if (!(x = d[n]) && d.all) x = d.all[n];
				for (i = 0; !x && i < d.forms.length; i++) x = d.forms[i][n];
				for (i = 0; !x && d.layers && i < d.layers.length; i++) x = MM_findObj(n, d.layers[i].document);
				if (!x && d.getElementById) x = d.getElementById(n);
				return x;
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

			function ff(x) {
				x.style.backgroundImage = "url(images/bkg_vacio_doble_r.jpg)";
			}

			function ff2(x) {
				x.style.backgroundImage = "url(images/bkg_vacio_doble.jpg)";
			}

			function verobjetivos(dato) {
				document.form1.verobjetivos.value = dato;
				document.form1.action = "objetivos_new.php";
				document.form1.submit();
			}
			function verplan(dato)
			{
				document.form1.verobjetivos.value=dato;
				document.form1.action="planes_new.php";
				document.form1.target="blank";
				document.form1.submit();
			}

			function verobjetivos2(dato) {
				document.form1.verobjetivos.value = dato;
				document.form1.action = "objetivos_new.php";
				document.form1.submit();
			}

			function verresultados(dato, dato2) {
				document.form1.verobjetivos.value = dato;
				document.form1.verrevision.value = dato2;
				document.form1.target = "_blank";
				document.form1.action = "resultados_360_new20.php";
				document.form1.submit();
			}

			function leidos() {

				document.form1.action = "menu.php";
				document.form1.submit();
			}
		</script>
		<link href="images/texto2.css" rel="stylesheet" type="text/css" />
	</head>

	<body
		onLoad="MM_preloadImages('images/b_historia_rl.jpg','images/b_mision_r.jpg','images/b_vision_r.jpg','images/b_valores_r.jpg','images/b_creencias_r.jpg','images/b_objetivos_r.jpg','images/b_evaluaciones_r.jpg','images/b_historial_r.jpg','images/b_plan_individual_r.jpg','images/b_mi_career_r.jpg','images/b_programa_anual_inst_r.jpg','images/b_programa_anual_tec_r.jpg','images/b_descripcion_r.jpg','images/b_check_r.jpg','images/b_libro_r.jpg','images/b_competencias_r.jpg','images/b_objetivos_jefe_r.jpg','images/b_objetivos_gente_r.jpg')">
		<form id="form1" name="form1" method="post" action="">
			<input name="verobjetivos" type="hidden" id="verobjetivos" />
			<input name="verrevision" type="hidden" id="verrevision" />
			<div style="position:fixed;left:85%;"></div>
			<table width="980" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
					<td width="210" valign="top" background="images/bkg_izq1.jpg">
						<table width="210" border="0" cellspacing="2" cellpadding="0">
							<tr>
								<td>
									<img src="images/logo.png" width="99" height="99" style="margin-left:30%;" />
								</td>
							</tr>
							<tr>
								<td bgcolor="#C0C0C0">
									<!-- <img src="images/tit_filosofia.jpg" width="256" height="34" /> -->
									<div align="center" style="padding:2%;border: black 1px solid;">
										<b>FILOSOFIA ORGANIZACIONAL</b>
									</div>
								</td>
							</tr>
							<tr>
								<?
								$consultaf  = "select * from filosofia where id=2";
								$resultadof = mysqli_query($enlace,$consultaf) or die("La consulta fall&oacute;P1:$consultaf " . mysqli_error($enlace));
								$resf=mysqli_fetch_assoc($resultadof);
								$archivomision=$resf['archivo'];
							?>
								<td class="tdn">
									<a target="_blank" <? if($archivomision!="" ){?>href="docs_filosofia/
										<? echo "$archivomision";?>"
										<? }?>>
										<!-- <img src="images/b_mision.jpg" name="Image3" width="256" height="23" border="0" id="Image3" /> -->
										<div align="center" class="texto_bold_blanco enlace">
											Misión
										</div>
									</a>
								</td>

							</tr>
					</td>
				</tr>
				<tr>
					<?
								$consultaf  = "select * from filosofia where id=1";
								$resultadof = mysqli_query($enlace,$consultaf) or die("La consulta fall&oacute;P1:$consultaf " . mysqli_error($enlace));
								$resf=mysqli_fetch_assoc($resultadof);
								$archivovision=$resf['archivo'];
							?>
					<!--<td>
						 <a target="_blank" <? if($archivovision!="" ){?>href="docs_filosofia/
							<? echo "$archivovision";?>"
							<? }?> onMouseOut="MM_swapImgRestore()"
							onMouseOver="MM_swapImage('Image4','','images/b_vision_r.jpg',1)"><img
								src="images/b_vision.jpg" name="Image4" width="256" height="23" border="0"
								id="Image4" />
						</a>
					</td>-->
					<td class="tdn">
						<a target="_blank" <? if($archivovision!="" ){?>href="docs_filosofia/
							<? echo "$archivovision";?>"
							<? }?>>
							<!-- <img src="images/b_mision.jpg" name="Image3" width="256" height="23" border="0" id="Image3" /> -->
							<div align="center" class="texto_bold_blanco enlace">
								Visión
							</div>
						</a>
					</td>
				</tr>
				<tr>
					<?
								$consultaf  = "select * from filosofia where id=3";
								$resultadof = mysqli_query($enlace,$consultaf) or die("La consulta fall&oacute;P1:$consultaf " . mysqli_error($enlace));
								$resf=mysqli_fetch_assoc($resultadof);
								$archivovalores=$resf['archivo'];
							?>
					<!-- <td>
						<a target="_blank" <? if($archivovalores!="" ){?>href="docs_filosofia/
							<? echo "$archivovalores";?>"
							<? }?> onMouseOut="MM_swapImgRestore()"
							onMouseOver="MM_swapImage('Image5','','images/b_valores_r.jpg',1)"><img
								src="images/b_valores.jpg" name="Image5" width="256" height="23" border="0"
								id="Image5" />
						</a>
					</td> -->
					<td class="tdn">
									<a target="_blank" <? if($archivovalores!="" ){?>href="docs_filosofia/
										<? echo "$archivovalores";?>"
										<? }?>>
										<!-- <img src="images/b_mision.jpg" name="Image3" width="256" height="23" border="0" id="Image3" /> -->
										<div align="center" class="texto_bold_blanco enlace">
											Valores
										</div>
									</a>
								</td>
				</tr>
				<tr>
					<?
								$consultaf  = "select * from filosofia where id=4";
								$resultadof = mysqli_query($enlace,$consultaf) or die("La consulta fall&oacute;P1:$consultaf " . mysqli_error($enlace));
								$resf=mysqli_fetch_assoc($resultadof);
								$archivocreencias=$resf['archivo'];
							?>
					<!-- <td>
						<a target="_blank" <? if($archivocreencias!="" ){?>href="docs_filosofia/
							<? echo "$archivocreencias";?>"
							<? }?> onMouseOut="MM_swapImgRestore()"
							onMouseOver="MM_swapImage('Image6','','images/b_creencias_r.jpg',1)"><img
								src="images/b_creencias.jpg" name="Image6" width="256" height="23" border="0"
								id="Image6" />
						</a>
					</td> -->
					<td class="tdn">
									<a target="_blank" <? if($archivocreencias!="" ){?>href="docs_filosofia/
										<? echo "$archivocreencias";?>"
										<? }?>>
										<!-- <img src="images/b_mision.jpg" name="Image3" width="256" height="23" border="0" id="Image3" /> -->
										<div align="center" class="texto_bold_blanco enlace">
											Creencias Poderosas
										</div>
									</a>
								</td>
				</tr>
				<tr>
					<td><img src="images/spacer.gif" width="10" height="21" /></td>
				</tr>
				<tr>
					<td bgcolor="#C0C0C0">
						<!-- <img src="images/tit_desempeno.jpg" width="256" height="34" /> -->
						<div align="center" style="padding:2%;border: black 1px solid;">
							<b>DESEMPEÑO</b>
						</div>
					</td>
				</tr>
				<!-- <tr>
        <td><a href="javascript:verobjetivos2('<?echo $idU?>');" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image9','','images/b_objetivos_r.jpg',1)"><img src="images/b_objetivos.jpg" name="Image9" width="256" height="23" border="0" id="Image9" /></a></td>
      </tr>-->
				<tr>
					<!-- <td><a href="javascript:verobjetivos2('<?echo $jefe?>');" onMouseOut="MM_swapImgRestore()"
							onMouseOver="MM_swapImage('Image33','','images/b_objetivos_jefe_r.jpg',1)"><img
								src="images/b_objetivos_jefe.jpg" name="Image33" width="256" height="23" border="0"
								id="Image33" /></a>
					</td> -->
					<td class="tdn">
									<a href="javascript:verobjetivos2('<?echo $jefe?>');">
										<div align="center" class="texto_bold_blanco enlace">
											Objetivos de mi jefe
										</div>
									</a>
								</td>
				</tr>
				<tr>
					<!-- <td><a href="migente.php" onMouseOut="MM_swapImgRestore()"
							onMouseOver="MM_swapImage('Image34','','images/b_objetivos_gente_r.jpg',1)"><img
								src="images/b_objetivos_gente.jpg" name="Image34" width="256" height="23" border="0"
								id="Image34" /></a></td> -->
								<td class="tdn">
									<a href="migente.php">
										<div align="center" class="texto_bold_blanco enlace">
											Objetivos de mi Gente
										</div>
									</a>
								</td>
				</tr>
				<?
			///////Contestar encuesta 360
					   if($plan!="" && $estatus360=="2" && $etapa360=="2")
					  {

					  ?>
				<!--<tr>
        <td><a href="evaluacion_360.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image37','','images/b_contestar_encuesta_360_r.jpg',1)"><img src="images/b_contestar_encuesta_360.jpg" name="Image37" width="256" height="23" border="0" id="Image37" /></a></td>
      </tr>-->

				<?
			}

			?>
				<tr>
					<!-- <td><a href="historial.php" onMouseOut="MM_swapImgRestore()"
							onMouseOver="MM_swapImage('Image38','','images/b_historial_resultados_r.jpg',1)"><img
								src="images/b_historial_resultados.jpg" name="Image38" width="256" height="23"
								border="0" id="Image38" /></a></td> -->
								<td class="tdn">
									<a href="historial.php">
										<div align="center" class="texto_bold_blanco enlace">
											Historial de Resultado
										</div>
									</a>
								</td>
				</tr>
				<tr>
					<!-- <td><a onclick="window.location = 'historial_migente.php'" onMouseOut="MM_swapImgRestore()"
							onMouseOver="MM_swapImage('Image39','','images/b_historial_resultados_gente_r.jpg',1)"
							style="cursor:pointer;"><img src="images/b_historial_resultados_gente.jpg" name="Image39"
								width="256" height="23" border="0" id="Image39" /></a></td> -->
								<td class="tdn" style="cursor:pointer;">
									<a onClick="window.location = 'historial_migente.php'">
										<div align="center" class="texto_bold_blanco enlace">
											Historial de Resultado de mi Gente
										</div>
									</a>
								</td>
				</tr>
				<tr>
					<td><img src="images/spacer.gif" width="10" height="21" /></td>
				</tr>
				<tr>
					<td bgcolor="#C0C0C0">
						<!-- <img src="images/tit_desarrollo.jpg" width="256" height="34" /> -->
						<div align="center" style="padding:2%;border: black 1px solid;">
							<b>DESARROLLO</b>
						</div>
					</td>
				</tr>
				<tr>
					<!-- <td><a href="planes.php" onMouseOut="MM_swapImgRestore()"
							onMouseOver="MM_swapImage('Image40','','images/b_plan_desarrollo_r.jpg',1)"><img
								src="images/b_plan_desarrollo.jpg" name="Image40" width="256" height="23" border="0"
								id="Image40" /></a></td> -->
								<td class="tdn">
									<a href="planes_new.php">
										<div align="center" class="texto_bold_blanco enlace">
											Plan de Desarrollo
										</div>
									</a>
								</td>
				</tr>
				<tr>
					<!-- <td><a href="planes_gente.php" onMouseOut="MM_swapImgRestore()"
							onMouseOver="MM_swapImage('Image41','','images/b_plan_desarrollo_gente_r.jpg',1)"><img
								src="images/b_plan_desarrollo_gente.jpg" name="Image41" width="256" height="23"
								border="0" id="Image41" /></a></td> -->
								<td class="tdn">
									<a href="planes_gente.php">
										<div align="center" class="texto_bold_blanco enlace">
											Plan de Desarrollo de mi Gente
										</div>
									</a>
								</td>
				</tr>
				<!--<tr>

        <td><a  style="cursor:pointer;" onclick="window.location = 'career_tim.php'" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image42','','images/b_career_file_r.jpg',1)"><img src="images/b_career_file.jpg" name="Image42" width="256" height="23" border="0" id="Image42" /></a></td>
      </tr>-->
				<tr>
					<!-- <td><a style="cursor:pointer;" onClick="window.location = 'career_profile.php'"
							onMouseOut="MM_swapImgRestore()"
							onMouseOver="MM_swapImage('Image43','','images/b_my_career_file_r.jpg',1)"><img
								src="images/b_my_career_file.jpg" name="Image43" width="256" height="23" border="0"
								id="Image43" /></a></td> -->
								<td class="tdn" style="cursor:pointer;">
									<a onClick="window.location = 'career_profile.php'">
										<div align="center" class="texto_bold_blanco enlace">
											My Career File
										</div>
									</a>
								</td>
				</tr>
				<tr>
					<!-- <td><a style="cursor:pointer;" onClick="window.location = 'career_migente.php'"
							onMouseOut="MM_swapImgRestore()"
							onMouseOver="MM_swapImage('Image44','','images/b_career_file_gente_r.jpg',1)"><img
								src="images/b_career_file_gente.jpg" name="Image44" width="256" height="23" border="0"
								id="Image44" /></a></td> -->
								<td class="tdn" style="cursor:pointer;">
									<a onClick="window.location = 'career_migente.php'">
										<div align="center" class="texto_bold_blanco enlace">
											Career File de mi Gente
										</div>
									</a>
								</td>
				</tr>
				<tr>
					<td><img src="images/spacer.gif" width="10" height="21" /></td>
				</tr>
				<!-- FIN DESMPENIO -->

				<!-- TAREAS PENDIENTES -->
				<tr>
					<td bgcolor="#C0C0C0">
						<!-- <img src="images/tit_tareaspendientes.jpg" width="256" height="34" /> -->
						<div align="center" style="padding:2%;border: black 1px solid;">
							<b>TAREAS PENDIENTES</b>
						</div>
					</td>
				</tr>

				<!-- Capturar Planeación -->
				<?
				if(($plan=="" || ($plan!="" && $estatus==0)) && $etapa=="1")
				{
			?>
				<tr>
					<!-- <td background="images/bkg_vacio_doble.jpg" width="256" height="23"
						style="background-repeat:none;cursor:pointer;" onMouseOver="ff(this);" onMouseOut="ff2(this)">
						<div class="centrar">
							<a href="javascript:verobjetivos('<?//echo $idU?>');" class="texto_tarea">
								Capturar Planeación
								<? //echo $revision;?>
							</a>
						</div>
					</td> -->
					<td class="tdn" style="cursor:pointer;">
									<a href="javascript:verobjetivos('<?echo $idU?>');">
										<div align="center" class="texto_bold_blanco enlace">
											Capturar Planeación
											<? echo $revision;?>
										</div>
									</a>
								</td>
				</tr>
				<?
				}
			?>
					<!-- Revisar Plan de Desarrollo Individual de -->
				<?
					if($plan_des=="" || $firma1e_des=="0000-00-00")
					{
			?>
				<tr>
					
					<td class="tdn">
						<a href="planes_new.php">
							<div align="center" class="texto_bold_blanco enlace">
						    Capturar Plan de Desarrollo Individual </div>
						</a>
					</td>
				</tr>
				<?
					}
				
				
				?>	
					
					
					
				<!-- Revisar Planeación de Objetivos -->
				<?
				$consulta  = "SELECT planes.id_empleado, planes.firma_j_i, planes.firma_e_i, planes.estatus, usuarios.nombre from planes inner join usuarios on planes.id_empleado=usuarios.id where usuarios.id_jefe=$idU and planes.revision=$revision and usuarios.activo=1";
				$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)
				$count=0;
				while(@mysqli_num_rows($resultado)>$count)
				{
					$res=mysqli_fetch_row($resultado);
					// si no esta firmado por jefe, si esta firmado por empleado, si estaus igual 1
					if($res[1]=="0000-00-00" && $res[2]!="0000-00-00" && $res[3]==1)
					{
			?>
				<tr>
					<!-- <td background="images/bkg_vacio_doble.jpg" width="256" height="46"
						style="background-repeat:none;cursor:pointer;" onMouseOver="ff(this);" onMouseOut="ff2(this)">
						<div class="centrar1">
							<a href="javascript:verobjetivos('<?echo $res[0]?>');" class="texto_tarea">
								Revisar Planeación de Objetivos de
								<? echo"$res[4]";?>
							</a>
						</div>
					</td> -->
					<td class="tdn">
									<a href="javascript:verobjetivos('<?echo $res[0]?>');">
										<div align="center" class="texto_bold_blanco enlace">
											Revisar Planeación de Objetivos de
											<? echo"$res[4]";?>
										</div>
									</a>
								</td>
				</tr>
				<?
					}
					$count++;
				}
			?>

				<!-- Revisión Intermedia -->
				<?
				if( $estatus<=2 && $etapa=="2")
				{
			?>
				<tr>
					<!-- <td background="images/bkg_vacio_doble.jpg" width="256" height="46"
						style="background-repeat:none;cursor:pointer;" onMouseOver="ff(this);" onMouseOut="ff2(this)">
						<div class="centrar">
							<a href="javascript:verobjetivos('<?echo $idU?>');" class="texto_tarea">
								Revisión Intermedia
								<? echo $revision;?>
							</a>
						</div>
					</td> -->
					<td class="tdn">
									<a href="javascript:verobjetivos('<?echo $idU?>');">
										<div align="center" class="texto_bold_blanco enlace">
										Revisión Intermedia <? echo $revision;?>
										</div>
									</a>
								</td>
				</tr>
				<?
				}
			?>


				<!-- Cierre de Objetivos -->
				<?
				if( $estatus<=4 && $etapa=="3")
				{
			?>
				<tr>
					<!-- <td background="images/bkg.jpg" width="256" height="23"
						style="background-repeat:none;cursor:pointer;" onMouseOver="ff(this);" onMouseOut="ff2(this)">
						<div class="centrar">
							<a href="javascript:verobjetivos('<?echo $idU?>');" class="texto_tarea">
								Cierre de Objetivos
								<? echo $revision;?>
							</a>
						</div>
					</td> -->
					<td class="tdn">
									<a href="javascript:verobjetivos('<?echo $idU?>');">
										<div align="center" class="texto_bold_blanco enlace">
										Cierre de Objetivos
								<? echo $revision;?>
										</div>
									</a>
								</td>
				</tr>
				<?
				}
			?>

				<!--Revision de planes de desarrollo de mi gente -->
				
				<?
				$consulta  = "SELECT plan_desarrollo.id_usuario, plan_desarrollo.firma_e,plan_desarrollo.firma_j, plan_desarrollo.firma_e_fin, plan_desarrollo.firma_j_fin, usuarios.nombre from plan_desarrollo inner join usuarios on plan_desarrollo.id_usuario=usuarios.id where usuarios.id_jefe=$idU and plan_desarrollo.revision=$revision ";
				$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)
				$count=0;
				while(@mysqli_num_rows($resultado)>$count)
				{
					$res=mysqli_fetch_row($resultado);
					// si no esta firmado por jefe, si esta firmado por empleado, si estaus igual 3
					if($res[1]!="0000-00-00" && $res[2]=="0000-00-00")
					{
			?>
				<tr>
					
					<td class="tdn">
									<a href="javascript:verplan('<?echo $res[0]?>');">
										<div align="center" class="texto_bold_blanco enlace">
										Revisión Plan de Desarrollo Individual de
								<? echo"$res[5]";?>
										</div>
									</a>
								</td>
				</tr>
				<?
					}
					if($res[3]!="0000-00-00" && $res[4]=="0000-00-00")
					{
			?>
				<tr>
					
					<td class="tdn">
									<a href="javascript:verplan('<?echo $res[0]?>');">
										<div align="center" class="texto_bold_blanco enlace">
										Revisión Final Plan de Desarrollo Individual de
								<? echo"$res[4]";?>
										</div>
									</a>
								</td>
				</tr>
				<?
					}
					$count++;
				}
				?>
				<!--
				1-Revisión Intermedia de Objetivos.
				2-Cierre de Objetivos.
			-->
				<?
				$consulta  = "SELECT planes.id_empleado, planes.firmaUser_midYearReview, planes.firmaJefe_midYearReview, planes.estatus, usuarios.nombre, planes.firma_e_f, planes.firma_j_f from planes inner join usuarios on planes.id_empleado=usuarios.id where usuarios.id_jefe=$idU and planes.revision=$revision ";
				$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)
				$count=0;
				while(@mysqli_num_rows($resultado)>$count)
				{
					$res=mysqli_fetch_row($resultado);
					// si no esta firmado por jefe, si esta firmado por empleado, si estaus igual 3
					if($res[1]!=null && $res[2]==null && $res[3]==3)
					{
			?>
				<tr>
					<!-- <td background="images/bkg_vacio_doble.jpg" width="256" height="46"
						style="background-repeat:none;cursor:pointer;" onMouseOver="ff(this);" onMouseOut="ff2(this)">
						<div class="centrar">
							<a href="javascript:verobjetivos('<?echo $res[0]?>');" class="texto_tarea">
								Revisión Intermedia de Objetivos de
								<? echo"$res[4]";?>
							</a>
						</div>
					</td> -->
					<td class="tdn">
									<a href="javascript:verobjetivos('<?echo $res[0]?>');">
										<div align="center" class="texto_bold_blanco enlace">
										Revisión Intermedia de Objetivos de
								<? echo"$res[4]";?>
										</div>
									</a>
								</td>
				</tr>
				<?
					}
					// si no esta firmado por jefe, si esta firmado por empleado, si estaus igual 5 cierre de objetvos
					if($res[5]!="0000-00-00" && $res[6]=="0000-00-00" && $res[3]==5)
					{
			?>
				<tr>
					<!-- <td background="images/bkg.jpg" width="256" height="23"
						style="background-repeat:none;cursor:pointer;" onMouseOver="ff(this);" onMouseOut="ff2(this)">
						<div class="centrar">
							<a href="javascript:verobjetivos('<?echo $res[0]?>');" class="texto_tarea">
								Cierre de Objetivos de
								<? echo"$res[4]";?>
							</a>
						</div>
					</td> -->
					<td class="tdn">
									<a href="javascript:verobjetivos('<?echo $res[0]?>');">
										<div align="center" class="texto_bold_blanco enlace">
										Cierre de Objetivos de
								<? echo"$res[4]";?>
										</div>
									</a>
								</td>
				</tr>
				<?
					}
					$count++;
				}
			?>


				<!-- Seleccion de evaluadores -->
				<?
				if($plan!="" && $estatus360==0 && $etapa360=="1")
				{
			?>
				<!--<tr>
							<td background="images/bkg.jpg" width="256" height="23" style="background-repeat:none;cursor:pointer;" onMouseOver="ff(this);" onMouseOut="ff2(this)">
								<div class="centrar">
									<a href="seleccion_evaluadores.php" class="texto_tarea">
										Selección de Evaluadores <? echo $revision;?>
									</a>
								</div>
							</td>
        	</tr>-->
				<?
				}
			?>

				<!-- Contestar encuesta 360 -->
				<?
				if($plan!="" && $estatus360=="2" && $etapa360=="2")
				{
			?>
				<tr>
					<!-- <td background="images/bkg_vacio_doble.jpg" width="256" height="46"
						style="background-repeat:none;cursor:pointer;" onMouseOver="ff(this);" onMouseOut="ff2(this)">
						<div class="centrar">
							<a href="evaluacion_360_new.php" class="texto_tarea">
								Contestar Encuesta 360
								<? echo $revision;?>
							</a>
						</div>
					</td> -->
					<td class="tdn">
									<a href="evaluacion_360_new.php">
										<div align="center" class="texto_bold_blanco enlace">
										Contestar Encuesta 360
								<? echo $revision;?>
										</div>
									</a>
								</td>
				</tr>
				<?
				}
			?>


				<!-- Revision de evaluadores -->
				<?
				$consulta  = "SELECT planes.id_empleado, usuarios.nombre from planes inner join usuarios on planes.id_empleado=usuarios.id where usuarios.id_jefe=$idU and planes.revision=$revision and planes.estatus_360=1 ";
				$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)
				$count=0;
				while(@mysqli_num_rows($resultado)>$count)
				{
					$res=mysqli_fetch_row($resultado);
					// si no esta firmado por jefe, si esta firmado por empleado, si estaus igual 1
					if($etapa360==1)
					{
			?>
				<!--<tr>
							<td background="images/bkg.jpg" width="256" height="23" style="background-repeat:none;cursor:pointer;" onMouseOver="ff(this);" onMouseOut="ff2(this)">
								<div class="centrar">
									<a href="revision_evaluadores.php?idE=<? echo"$res[0]";?>" class="texto_tarea">
										Revisión de Evaluadores de <? echo"$res[1]";?>
									</a>
								</div>
							</td>
        		</tr>-->
				<?
					}
					$count++;
				}
			?>

				<!-- Mis Resultados -->
				<?
				////////////////////////
				//////////////
				//////////////////////
				//excepcion 2021 retro
				$etapa=4;
				$revision=2021;
				$consulta  = "SELECT id, estatus, firma_e_i, firma_e_f, firma_j_i, firma_j_f, estatus_360, retro, descripcion_vista from planes where id_empleado=$idU and revision=$revision";
				$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//
				if(@mysqli_num_rows($resultado)>=1)
				{
					$res=mysqli_fetch_row($resultado);
					$plan=$res[0];//id
					$retro_e=$res[7];
					$leido=$res[8];
				}
				if($plan!="" && $etapa=="4" && $retro_e=="1")
				{
			?>
				<tr>
					 <td background="images/bkg.jpg" width="256" height="23"
						style="background-repeat:none;cursor:pointer;" onMouseOver="ff(this);" onMouseOut="ff2(this)">
						<div class="centrar">
							<a href="javascript:verresultados('<?echo $idU?>','<?echo $revision?>');"
								class="texto_tarea">
								Mis Resultados
								<? echo $revision;?>
							</a>
						</div>
					</td> 

				</tr>
				<?
				}
			?>

				<!-- Resultados de mi gente-->
				<?
				
				
				$consultaG  = "SELECT usuarios.nombre from planes inner join usuarios on planes.id_empleado=usuarios.id where usuarios.id_jefe=$idU and planes.revision=$revision ";
				$resultadoG = mysqli_query($enlace,$consultaG) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)
				$tengogente=0;
				if(@mysqli_num_rows($resultadoG)>0)
				{
					$tengogente=1;
				}
				
				if($plan!="" && $etapa=="4" && $tengogente=="1")
				{
			?>
				<tr>
					<!-- <td background="images/bkg.jpg" width="256" height="23"
						style="background-repeat:none;cursor:pointer;" onMouseOver="ff(this);" onMouseOut="ff2(this)">
						<div class="centrar">
							<a href="migente_historial.php" class="texto_tarea">
								Resultados de Mi Gente
								<? echo $revision;?> </a> </div>
					</td> -->
					<td class="tdn">
									<a href="migente_historial.php">
										<div align="center" class="texto_bold_blanco enlace">
										Resultados de Mi Gente
								<? echo $revision;?>
										</div>
									</a>
								</td>
				</tr>
				<?
				}
			?>
				<!-- Cierre de Proceso PMP -->
				<?
				if($retro=="1" && $retro_e=="0")
				{
			?>
				<tr>
					<!-- <td background="images/bkg.jpg" width="256" height="23"
						style="background-repeat:none;cursor:pointer;" onMouseOver="ff(this);" onMouseOut="ff2(this)">
						<div class="centrar">
							<a href="encuesta_cierre.php?id=<?echo" $idU";?>&revision=
								<?echo"$revision";?>" class="texto_tarea iframe3">
								Cierre de Proceso PMP
							</a>
						</div>
					</td> -->
					<td class="tdn">
									<a href="encuesta_cierre.php?id=<?echo" $idU";?>&revision=
								<?echo"$revision";?>">
										<div align="center" class="texto_bold_blanco enlace iframe3">
										Cierre de Proceso PMP
										</div>
									</a>
								</td>
				</tr>
				<?
				}
			?>

				<!-- Plan de Desarrollo TIM -->
				<?
				if($idU=="70749")
				{
			?>
				<tr>
					<!-- <td background="images/bkg.jpg" width="256" height="23"
						style="background-repeat:none;cursor:pointer;" onMouseOver="ff(this);" onMouseOut="ff2(this)">
						<div class="centrar">
							<a href="planes_tim.php" class="texto_tarea">
								Plan de Desarrollo TIM
							</a>
						</div>
					</td> -->
					<td class="tdn">
									<a href="planes_tim.php">
										<div align="center" class="texto_bold_blanco enlace">
										Plan de Desarrollo TIM
										</div>
									</a>
								</td>
				</tr>
				<tr>
					<!-- <td background="images/bkg.jpg" width="256" height="23"
						style="background-repeat:none;cursor:pointer;" onMouseOver="ff(this);" onMouseOut="ff2(this)">
						<div class="centrar">
							<a href="reporte_plan_desarrollo.php" class="texto_tarea">
								Reporte Plan de Desarrollo TIM
							</a>
						</div>
					</td> -->
					<td class="tdn">
									<a href="reporte_plan_desarrollo.php">
										<div align="center" class="texto_bold_blanco enlace">
										Reporte Plan de Desarrollo TIM
										</div>
									</a>
								</td>
				</tr>
				<? } ////////////////////Seleccion de valuadores
					  if($plan!="" && $estatus360==0 && $etapa360=="1")
					  {
					  ?>
				<tr>
						<td class="tdn">
									<a href="seleccion_evaluadores.php" class="texto_tarea">
<div align="center" class="texto_bold_blanco enlace">
										Selección de Evaluadores <? echo $revision;?>

								</div>
									</a>
						</td>
				</tr>
				<? }
					  ////////////////////REvision de valuadores
					  	$consulta  = "SELECT planes.id_empleado, usuarios.nombre from planes inner join usuarios on planes.id_empleado=usuarios.id where usuarios.id_jefe_360=$idU and planes.revision=$revision and planes.estatus_360=1 ";
						$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)
						$count=0;
						while(@mysqli_num_rows($resultado)>$count)
						{
							$res=mysqli_fetch_row($resultado);
							if($etapa360==1)
							{ // si no esta firmado por jefe, si esta firmado por empleado, si estaus igual 1
						 ?>
				<tr>
					<td background="images/bkg_vacio_doble.jpg" width="256" height="46"
						style="background-repeat:none;cursor:pointer;" onMouseOver="ff(this);" onMouseOut="ff2(this)">
						<div class="centrar"><a href="revision_evaluadores.php?idE=<? echo" $res[0]";?>"
								class="texto_tarea">Revisión de Evaluadores de
								<? echo"$res[1]";?> </a> </div>
					</td>
				</tr>
				<?
							}
							$count++;
						}
					  ?>
				<?

			?>
				<!-- FIN TAREAS PENDIENTES -->

				<!-- CAPACITACION -->
				<tr>
					<td bgcolor="#C0C0C0">
						<!-- <img src="images/tit_capacitacion.jpg" width="256" height="34" /> -->
						<div align="center" style="padding:2%;border: black 1px solid;">
							<b>CAPACITACIÓN</b>
						</div>
					</td>
				</tr>
				<tr>
					<?
					$consultaf  = "select * from programas where id=1";
					$resultadof = mysqli_query($enlace,$consultaf) or die("La consulta fall&oacute;P1:$consultaf " . mysqli_error($enlace));
					$resf=mysqli_fetch_assoc($resultadof);
					$archivoinstitucion=$resf['archivo'];
				?>
					<!-- <td><a target="_blank" <? if($archivoinstitucion!="" ){?>href="docs_programas/
							<? echo "$archivoinstitucion";?>"
							<? }?> onMouseOut="MM_swapImgRestore()"
							onMouseOver="MM_swapImage('Image19','','images/b_programa_anual_inst_r.jpg',1)"><img
								src="images/b_programa_anual_inst.jpg" name="Image19" width="256" height="23" border="0"
								id="Image19" /></a></td> -->
								<td class="tdn">
									<a target="_blank" <? if($archivoinstitucion!="" ){?>href="docs_programas/
							<? echo "$archivoinstitucion";?>"
							<? }?>>
										<div align="center" class="texto_bold_blanco enlace">
											Programa Anual Institucional
										</div>
									</a>
								</td>
				</tr>
				<tr>
					<?
					$consultaf  = "select * from programas where id=2";
					$resultadof = mysqli_query($enlace,$consultaf) or die("La consulta fall&oacute;P1:$consultaf " . mysqli_error($enlace));
					$resf=mysqli_fetch_assoc($resultadof);
					$archivotecnico=$resf['archivo'];
				?>
					<!-- <td><a target="_blank" <? if($archivotecnico!="" ){?>href="docs_programas/
							<? echo "$archivotecnico";?>"
							<? }?> onMouseOut="MM_swapImgRestore()"
							onMouseOver="MM_swapImage('Image20','','images/b_programa_anual_tec_r.jpg',1)"><img
								src="images/b_programa_anual_tec.jpg" name="Image20" width="256" height="23" border="0"
								id="Image20" /></a></td> -->
								<td class="tdn">
									<a target="_blank" <? if($archivotecnico!="" ){?>href="docs_programas/
							<? echo "$archivotecnico";?>"
							<? }?>>
										<div align="center" class="texto_bold_blanco enlace">
											Programa Anual Técnico
										</div>
									</a>
								</td>
				</tr>
				<tr>
					<?
	$consulta  = "SELECT archivo from puestos where id=$puesto";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_row($resultado);
		$archivo=$res[0];

	}
					?>
					<!-- <td><a <? if($archivo!="" ){?>href="docs_puestos/
							<? echo"$archivo";?>" target="_blank"
							<? } ?> onMouseOut="MM_swapImgRestore()"
							onMouseOver="MM_swapImage('Image54','','images/b_descripcion_r.jpg',1)"><img
								src="images/b_descripcion.jpg" name="Image54" width="256" height="23" border="0"
								id="Image54" /></a></td> -->
								<td class="tdn">
									<a <? if($archivo!="" ){?>href="docs_puestos/
							<? echo"$archivo";?>" target="_blank"
							<? }?>>
										<div align="center" class="texto_bold_blanco enlace">
											Descripción de Puesto
										</div>
									</a>
								</td>
				</tr>
				<tr>
					<?
	$consulta  = "SELECT archivo2 from puestos where id=$puesto";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_row($resultado);
		$archivo2=$res[0];

	}
					?>
					<!-- <td><a <? if($archivo2!="" ){?>href="docs_puestos/
							<? echo"$archivo2";?>" target="_blank"
							<? } ?> onMouseOut="MM_swapImgRestore()"
							onMouseOver="MM_swapImage('Image22','','images/b_check_r.jpg',1)"><img
								src="images/b_check.jpg" name="Image22" width="256" height="23" border="0"
								id="Image22" /></a></td> -->
								<td class="tdn">
									<a target="_blank" <? if($archivo2!="" ){?>href="docs_puestos/
							<? echo "$archivo2";?>"
							<? }?>>
										<div align="center" class="texto_bold_blanco enlace">
											Check list de Entrenamiento
										</div>
									</a>
								</td>
				</tr>
				<tr>
					<td><img src="images/spacer.gif" width="10" height="21" /></td>
				</tr>
			</table>
			</td>
			<td valign="top">
				<table width="724" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td><img src="images/a.jpg" width="724" height="245" /></td>
					</tr>
					<tr>
						<td height="500" valign="top" bgcolor="#eeeeee">
							<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
								<tr>
									<td><img src="images/spacer.gif" width="10" height="30" /></td>
								</tr>
								<tr>
									<td>
										<div align="center" class="texto_titulos_arial_regular">BIENVENIDO A TU
											PORTAL PMP</div>
									</td>
								</tr>
								<tr>
									<td><img src="images/spacer.gif" width="10" height="3" /></td>
								</tr>
								<tr>
									<td>
										<div align="center"><img src="images/linea.png" width="543" height="9" /></div>
									</td>
								</tr>
								<tr>
									<td><img src="images/spacer.gif" width="10" height="21" /></td>
								</tr>
								<tr>
									<td>
										<div align="center"><img src="images/proceso.png" width="485" height="398" />
										</div>
									</td>
								</tr>
								<tr>
									<td><img src="images/spacer.gif" width="10" height="12" /></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td bgcolor="#EEEEEE">
							<table width="90" border="0" align="right" cellpadding="0" cellspacing="0">
								<tr>

									<td width="640">
										<a href="cambia_pass.php?id=<?echo" $idU";?>" class="iframe2"
											onMouseOut="MM_swapImgRestore()"
											onMouseOver="MM_swapImage('Image21','','images/b_cambio.png',1)">
											<img src="images/b_cambio.png" name="Image21" width="145" height="23"
												border="0" id="Image21" />
										</a>
									</td>

									<td width="10"><img src="images/spacer1.gif" width="30" height="21" /></td>

									<td width="640">
										<a href="<? echo $_SESSION["idA"]=="1" ? 'admin.php' :'menu.php';?>"
											onMouseOut="MM_swapImgRestore()"
											onMouseOver="MM_swapImage('Image24','','images/b_administracion.png',1)">
											<img src="images/b_administracion.png" name="Image24" width="150"
												height="23" border="0" id="Image24" />										</a>									</td>

									<td width="10"><img src="images/spacer1.gif" width="30" height="21" /></td>

									<td width="640">
										<a href="logout.php" onMouseOut="MM_swapImgRestore()"
											onMouseOver="MM_swapImage('Image25','','images/b_log_out.png',1)">
											<img src="images/b_log_out.png" name="Image25" width="150" height="23"
												border="0" id="Image25" />										</a>									</td>

									<td width="10"><img src="images/spacer1.gif" width="120" height="21" /></td>
									<td width="640">
										<div align="right"><img src="images/bell.png" width="90" height="51" />
										</div>
									</td>
									<td width="10"><img src="images/spacer1.gif" width="30" height="21" /></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="2" valign="top" background=""><img src="images/spacer.gif"
								width="10" height="17" /><img src="images/spacer.gif" width="10" height="17" /></td>
					</tr>
				</table>
		</form>
	</body>

</html>
