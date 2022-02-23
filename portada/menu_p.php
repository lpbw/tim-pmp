<?
	session_start();
	include "checar_sesion_admin.php";
	include "coneccion.php";
	$idU=$_SESSION['idU'];
	$idA=$_SESSION['idA'];
	echo $idA; 
	$plan=$res[0];
	$estatus="";
	$firma1e="";
	$firma2e="";
	$firma1j="";
	$firma2j="";
	$consulta  = "SELECT revision, etapa, etapa_360, retro from etapa where id=1";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta ". mysql_error() );//. mysql_error()	
	if(@mysql_num_rows($resultado)>=1)
	{
		$res=mysql_fetch_row($resultado);
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
	$consulta  = "SELECT id, estatus, firma_e_i, firma_e_f, firma_j_i, firma_j_f, estatus_360, retro, descripcion_vista from planes where id_empleado=$idU and revision=$revision";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta ". mysql_error() );//	
	if(@mysql_num_rows($resultado)>=1)
	{
		$res=mysql_fetch_row($resultado);
		$plan=$res[0];
		$estatus=$res[1];
		$firma1e=$res[2];
		$firma2e=$res[3];
		$firma1j=$res[4];
		$firma2j=$res[5];
		$estatus360=$res[6];
		$retro_e=$res[7];
		$leido=$res[8];
	}
	$consulta  = "SELECT id_jefe, puesto from usuarios where id=$idU";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta ". mysql_error() );//	
	if(@mysql_num_rows($resultado)>=1)
	{
		$res=mysql_fetch_row($resultado);
		$jefe=$res[0];
		$puesto=$res[1];
		//$puesto=3;
		/*echo "<script>alert('$puesto');</script>";*/
	}
	/*if($_POST['leido']=="1")
	{*/
		$consulta  = "update planes set descripcion_vista=1 where id_empleado=$idU and revision=$revision";
		$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
		$leido="1";
	/*}*/
	//echo $puesto;
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>e3i</title>
<style type="text/css">

body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url(images/bkg_fondo_2.jpg);
}
.texto_tarea{
	color:#fff;
	font-size:15px;
	text-decoration: none;
	font-family: "GOTHICB";
	font-style:gothicb;
}
.centrar
{
	margin-left:8%;
	margin-top:-2%;
}
</style>
<script type="text/javascript">

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
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

/*function verobjetivos(dato)
{
	document.form1.verobjetivos.value=dato;
	document.form1.action="objetivos2.php";
	document.form1.submit();
}*/
function verobjetivos2(dato)
{
	document.form1.verobjetivos.value=dato;
	document.form1.action="objetivos2.php";
	document.form1.submit();
}

function verresultados(dato, dato2)
{
	document.form1.verobjetivos.value=dato;
	document.form1.verrevision.value=dato2;
	document.form1.action="resultados_360_n.php";
	document.form1.submit();
}
function leidos()
{
	
	document.form1.action="menu.php";
	document.form1.submit();
}	

</script>
<link href="images/textos.css" rel="stylesheet" type="text/css" />
</head>

<body onload="MM_preloadImages('images/b_historia_rl.jpg','images/b_mision_r.jpg','images/b_vision_r.jpg','images/b_valores_r.jpg','images/b_creencias_r.jpg','images/b_objetivos_r.jpg','images/b_evaluaciones_r.jpg','images/b_historial_r.jpg','images/b_plan_individual_r.jpg','images/b_mi_career_r.jpg','images/b_programa_anual_inst_r.jpg','images/b_programa_anual_tec_r.jpg','images/b_descripcion_r.jpg','images/b_check_r.jpg','images/b_libro_r.jpg','images/b_competencias_r.jpg','images/b_objetivos_jefe_r.jpg','images/b_objetivos_gente_r.jpg')">
	<form id="form1" name="form1" method="post" action="">
		<input name="verobjetivos" type="hidden" id="verobjetivos" />
    <input name="verrevision" type="hidden" id="verrevision" />
		<div style="position:fixed;left:85%;"></div>		
		<table width="980" border="0" align="center" cellpadding="0" cellspacing="0">
  		<tr>
    		<td width="210" valign="top" background="images/bkg_izq.jpg">
					<table width="210" border="0" cellspacing="0" cellpadding="0">
      			<tr>
        			<td>
								<img src="images/logo_e3i.jpg" width="256" height="99" />
							</td>
      			</tr>
      			<tr>
        			<td>
								<img src="images/tit_filosofia.jpg" width="256" height="34" />
							</td>
      			</tr>
      			<tr>
							<?
								$consultaf  = "select * from filosofia where id=2";
								$resultadof = mysql_query($consultaf) or die("La consulta fall&oacute;P1:$consultaf " . mysql_error());
								$resf=mysql_fetch_assoc($resultadof);
								$archivomision=$resf['archivo'];
							?>
        			<td>
								<a target="_blank" <? if($archivomision!=""){?>href="docs_filosofia/<? echo "$archivomision";?>"<? }?> onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3','','images/b_mision_r.jpg',1)"><img src="images/b_mision.jpg" name="Image3" width="256" height="23" border="0" id="Image3" />
								</a>
							</td>
      			</tr>
      			<tr>
							<?
								$consultaf  = "select * from filosofia where id=1";
								$resultadof = mysql_query($consultaf) or die("La consulta fall&oacute;P1:$consultaf " . mysql_error());
								$resf=mysql_fetch_assoc($resultadof);
								$archivovision=$resf['archivo'];
							?>
        			<td>
								<a target="_blank" <? if($archivovision!=""){?>href="docs_filosofia/<? echo "$archivovision";?>"<? }?> onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image4','','images/b_vision_r.jpg',1)"><img src="images/b_vision.jpg" name="Image4" width="256" height="23" border="0" id="Image4" />
								</a>
							</td>
      			</tr>
      			<tr>
							<?
								$consultaf  = "select * from filosofia where id=3";
								$resultadof = mysql_query($consultaf) or die("La consulta fall&oacute;P1:$consultaf " . mysql_error());
								$resf=mysql_fetch_assoc($resultadof);
								$archivovalores=$resf['archivo'];
							?>
        			<td>
								<a target="_blank" <? if($archivovalores!=""){?>href="docs_filosofia/<? echo "$archivovalores";?>"<? }?> onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image5','','images/b_valores_r.jpg',1)"><img src="images/b_valores.jpg" name="Image5" width="256" height="23" border="0" id="Image5" />
								</a>
							</td>
      			</tr>
      			<tr>
							<?
								$consultaf  = "select * from filosofia where id=4";
								$resultadof = mysql_query($consultaf) or die("La consulta fall&oacute;P1:$consultaf " . mysql_error());
								$resf=mysql_fetch_assoc($resultadof);
								$archivocreencias=$resf['archivo'];
							?>
        			<td>
								<a target="_blank" <? if($archivocreencias!=""){?>href="docs_filosofia/<? echo "$archivocreencias";?>"<? }?> onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image6','','images/b_creencias_r.jpg',1)"><img src="images/b_creencias.jpg" name="Image6" width="256" height="23" border="0" id="Image6" />
								</a>
							</td>
      			</tr>
      <tr>
        <td><img src="images/spacer.gif" width="10" height="21" /></td>
      </tr>
      <tr>
        <td><img src="images/tit_desempeno.jpg" width="256" height="34" /></td>
      </tr>
      <tr>
        <td><a href="javascript:verobjetivos2('<?echo $idU?>');" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image9','','images/b_objetivos_r.jpg',1)"><img src="images/b_objetivos.jpg" name="Image9" width="256" height="23" border="0" id="Image9" /></a></td>
      </tr>
      <tr>
        <td><a href="javascript:verobjetivos2('<?echo $jefe?>');" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image33','','images/b_objetivos_jefe_r.jpg',1)"><img src="images/b_objetivos_jefe.jpg" name="Image33" width="256" height="23" border="0" id="Image33" /></a></td>
      </tr>
      <tr>
        <td><a href="migente.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image34','','images/b_objetivos_gente_r.jpg',1)"><img src="images/b_objetivos_gente.jpg" name="Image34" width="256" height="23" border="0" id="Image34" /></a></td>
      </tr>
			<?
			///////Contestar encuesta 360
					   if($plan!="" && $estatus360=="2" && $etapa360=="2")
					  {
						
					  ?>
      <tr>
        <td><a href="evaluacion_360.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image37','','images/b_contestar_encuesta_360_r.jpg',1)"><img src="images/b_contestar_encuesta_360.jpg" name="Image37" width="256" height="23" border="0" id="Image37" /></a></td>
      </tr>
			
			<?
			}
			?>
      <tr>
        <td><a href="historial.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image38','','images/b_historial_resultados_r.jpg',1)"><img src="images/b_historial_resultados.jpg" name="Image38" width="256" height="23" border="0" id="Image38" /></a></td>
      </tr>
      <tr>
        <td><a  onclick="window.location = 'historial_migente.php'" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image39','','images/b_historial_resultados_gente_r.jpg',1)" style="cursor:pointer;"><img src="images/b_historial_resultados_gente.jpg" name="Image39" width="256" height="23" border="0" id="Image39" /></a></td>
      </tr>
      <tr>
        <td><img src="images/spacer.gif" width="10" height="21" /></td>
      </tr>
      <tr>
        <td><img src="images/tit_desarrollo.jpg" width="256" height="34" /></td>
      </tr>
      <tr>
        <td><a href="planes.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image40','','images/b_plan_desarrollo_r.jpg',1)"><img src="images/b_plan_desarrollo.jpg" name="Image40" width="256" height="23" border="0" id="Image40" /></a></td>
      </tr>
      <tr>
        <td><a href="planes_gente.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image41','','images/b_plan_desarrollo_gente_r.jpg',1)"><img src="images/b_plan_desarrollo_gente.jpg" name="Image41" width="256" height="23" border="0" id="Image41" /></a></td>
      </tr>
      <!--<tr>

        <td><a  style="cursor:pointer;" onclick="window.location = 'career_tim.php'" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image42','','images/b_career_file_r.jpg',1)"><img src="images/b_career_file.jpg" name="Image42" width="256" height="23" border="0" id="Image42" /></a></td>
      </tr>-->
      <tr>
        <td><a  style="cursor:pointer;" onclick="window.location = 'career_profile.php'" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image43','','images/b_my_career_file_r.jpg',1)"><img src="images/b_my_career_file.jpg" name="Image43" width="256" height="23" border="0" id="Image43" /></a></td>
      </tr>
      <tr>
        <td><a  style="cursor:pointer;" onclick="window.location = 'career_migente.php'" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image44','','images/b_career_file_gente_r.jpg',1)"><img src="images/b_career_file_gente.jpg" name="Image44" width="256" height="23" border="0" id="Image44" /></a></td>
      </tr>
      <tr>
        <td><img src="images/spacer.gif" width="10" height="21" /></td>
      </tr>
			<!-- FIN DESMPENIO -->
			
			<!-- TAREAS PENDIENTES -->
			<tr>
        <td>
					<img src="images/tit_tareaspendientes.jpg" width="256" height="34" />
				</td>
      </tr>
			<?
				// if(($plan=="" || ($plan!="" && $estatus==0)) && $etapa=="1")
				// {
			?>
          <tr>
            <td background="images/bkg_vacio.jpg" width="256" height="30" style="background-repeat:none;">
							<div class="centrar">
								<a href="javascript:verobjetivos('<?echo $idU?>');" class="texto_tarea">
									Capturar Planeación <? echo $revision;?>
								</a>
							</div>
						</td>
          </tr>
			<?
				// }
			?>
			<!-- FIN TAREAS PENDIENTES -->

			<!-- CAPACITACION -->
      <tr>
        <td><img src="images/tit_capacitacion.jpg" width="256" height="34" /></td>
      </tr>
      <tr>
			<?
					$consultaf  = "select * from programas where id=1";
					$resultadof = mysql_query($consultaf) or die("La consulta fall&oacute;P1:$consultaf " . mysql_error());
					$resf=mysql_fetch_assoc($resultadof);
					$archivoinstitucion=$resf['archivo'];
				?>
        <td><a target="_blank" <? if($archivoinstitucion!=""){?>href="docs_programas/<? echo "$archivoinstitucion";?>"<? }?> onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image19','','images/b_programa_anual_inst_r.jpg',1)"><img src="images/b_programa_anual_inst.jpg" name="Image19" width="256" height="23" border="0" id="Image19" /></a></td>
      </tr>
      <tr>
			<?
					$consultaf  = "select * from programas where id=2";
					$resultadof = mysql_query($consultaf) or die("La consulta fall&oacute;P1:$consultaf " . mysql_error());
					$resf=mysql_fetch_assoc($resultadof);
					$archivotecnico=$resf['archivo'];
				?>
        <td><a target="_blank" <? if($archivotecnico!=""){?>href="docs_programas/<? echo "$archivotecnico";?>"<? }?> onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image20','','images/b_programa_anual_tec_r.jpg',1)"><img src="images/b_programa_anual_tec.jpg" name="Image20" width="256" height="23" border="0" id="Image20" /></a></td>
      </tr>
      <tr>
			<?
	$consulta  = "SELECT archivo from puestos where id=$puesto";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta ". mysql_error() );//	
	if(@mysql_num_rows($resultado)>=1)
	{
		$res=mysql_fetch_row($resultado);
		$archivo=$res[0];
		
	}
					?>
        <td><a <? if($archivo!=""){?>href="docs_puestos/<? echo"$archivo";?>" target="_blank" <? } ?> onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image21','','images/b_descripcion_r.jpg',1)"><img src="images/b_descripcion.jpg" name="Image21" width="256" height="23" border="0" id="Image21" /></a></td>
      </tr>
      <tr>
				<?
	$consulta  = "SELECT archivo2 from puestos where id=$puesto";
	$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta ". mysql_error() );//	
	if(@mysql_num_rows($resultado)>=1)
	{
		$res=mysql_fetch_row($resultado);
		$archivo2=$res[0];
		
	}
					?>
        <td><a <? if($archivo2!=""){?>href="docs_puestos/<? echo"$archivo2";?>" target="_blank" <? } ?> onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image22','','images/b_check_r.jpg',1)"><img src="images/b_check.jpg" name="Image22" width="256" height="23" border="0" id="Image22" /></a></td>
      </tr>
      <tr>
        <td><img src="images/spacer.gif" width="10" height="21" /></td>
      </tr>
    </table></td>
    <td valign="top"><table width="724" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><img src="images/header.jpg" width="724" height="245" /></td>
      </tr>
      <tr>
        <td height="500" valign="top" bgcolor="#eeeeee"><table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td><img src="images/spacer.gif" width="10" height="30" /></td>
          </tr>
          <tr>
            <td><div align="center" class="texto_titulos_arial_regular">BIENVENIDO A TU PORTAL PMP</div></td>
          </tr>
          <tr>
            <td><img src="images/spacer.gif" width="10" height="3" /></td>
          </tr>
          <tr>
            <td><div align="center"><img src="images/linea.png" width="543" height="9" /></div></td>
          </tr>
          <tr>
            <td><img src="images/spacer.gif" width="10" height="21" /></td>
          </tr>
          <tr>
            <td><div align="center"><img src="images/proceso.png" width="485" height="398" /></div></td>
          </tr>
          <tr>
            <td><img src="images/spacer.gif" width="10" height="12" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td bgcolor="#EEEEEE"><table width="90" border="0" align="right" cellpadding="0" cellspacing="0">
          <tr>
					
						<td width="640">
							<a href="cambia_pass.php?id=<?echo"$idU";?>" class="iframe2" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image21','','images/b_cambio_r.png',1)">
								<img src="images/b_cambio.png" name="Image21" width="145" height="23" border="0" id="Image21" />
							</a>
						</td>
						
						<td width="10"><img src="images/spacer1.gif" width="30" height="21" /></td>
						
						<td width="640">
							<a href="<? echo $_SESSION["idA"]=="1"? 'admin.php':'menu.php';?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image24','','images/b_administracion_r.png',1)">
								<img src="images/b_administracion.png" name="Image24" width="114" height="23" border="0" id="Image24" />
							</a>
						</td>
						
						<td width="10"><img src="images/spacer1.gif" width="30" height="21" /></td>
						
						<td width="640">
							<a href="logout.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image25','','images/b_log_out_r.png',1)">
								<img src="images/b_log_out.png" name="Image25" width="71" height="23" border="0" id="Image25" />
							</a>
						</td>
						
						 <td width="10"><img src="images/spacer1.gif" width="120" height="21" /></td>
            <td width="640"><div align="right"><img src="images/bell.png" width="90" height="51" /></div></td>
            <td width="10"><img src="images/spacer1.gif" width="30" height="21" /></td>
          </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" valign="top" background="images/bkg_abajo.jpg"><img src="images/spacer.gif" width="10" height="17" /><img src="images/spacer.gif" width="10" height="17" /></td>
  </tr>
</table>
</form>
</body>
</html>

