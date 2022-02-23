<?
session_start();
include "checar_sesion_admin.php";
include "coneccion.php";
$idU=$_SESSION['idU'];
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
		
	}
/*	if($_POST['leido']=="1")
	{*/
		$consulta  = "update planes set descripcion_vista=1 where id_empleado=$idU and revision=$revision";
		$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
		$leido="1";
	//}
	//echo $puesto;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>e3i</title>
<link rel="stylesheet" href="colorbox.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="colorbox/jquery.colorbox-min.js"></script>
<style>
body{
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url(images/bkg_fondo_2.jpg);
}
.text
{
	font-family:"GOTHICB";
	src: url("fonts/GOTHICB.TTF");
}
.text2
{
	font-family:arial;
	color:#FFFFFF;
	font-size:12px;
}
.fondo:hover
{
	background:url(images/b_vacio_r.jpg);
}
a{
	text-decoration:none;
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


function verobjetivos(dato)
{
	document.form1.verobjetivos.value=dato;
	document.form1.action="objetivos2.php";
	document.form1.submit();
}
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
<link href="images/textos1.css" rel="stylesheet" type="text/css" />
<script>
	$(document).ready(function(){
		$(".iframe2").colorbox({iframe:true,width:"450", height:"320",transition:"fade", scrolling:false, opacity:0.1});
		$(".iframe3").colorbox({iframe:true,width:"550", height:"550",transition:"fade", scrolling:false, opacity:0.1});
		$("#click").click(function(){ 
			$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
			return false;
		});
	});
</script>
</head>

<body >
<form id="form1" name="form1" method="post" action="">
<div style="position:fixed;left:85%;"></div>
		
<table width="980" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="210" valign="top" background="images/bkg_izq.jpg"><table width="210" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><img src="images/logo_e3i.jpg" width="256" height="99" /></td>
      </tr>
			<tr>
				<td align="center"><span class="text2">Ciclo <? echo"$revision";?> Etapa: </span><span class="text2"><? echo"$etapa_name";?> </span></td>
			</tr>
      <tr>
        <td  background="images/tit_vacio.jpg" height="35"><div align="left" style="margin-left:8%;"><span class="text">Tareas Pendientes <input name="verobjetivos" type="hidden" id="verobjetivos" />
                  <input name="verrevision" type="hidden" id="verrevision" /></span></div></td>
      </tr>
			  <?
					  if(($plan=="" || ($plan!="" && $estatus==0)) && $etapa=="1")
					  {
					  ?>
						 <tr>
                        <td  background="images/b_vacio.jpg" class="fondo" height="25"><div align="left" style="margin-left:8%;"><a href="javascript:verobjetivos('<?echo $idU?>');"><span class="text2">Capturar Planeación <? echo $revision;?></span></a> </div></td>
             </tr>
					 <? }
					  	$consulta  = "SELECT planes.id_empleado, planes.firma_j_i, planes.firma_e_i, planes.estatus, usuarios.nombre from planes inner join usuarios on planes.id_empleado=usuarios.id where usuarios.id_jefe=$idU and planes.revision=$revision and usuarios.activo=1";
						$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: ". mysql_error() );//. mysql_error()	
						$count=0;
						while(@mysql_num_rows($resultado)>$count)					
						{
							$res=mysql_fetch_row($resultado);
							if($res[1]=="0000-00-00" && $res[2]!="0000-00-00" && $res[3]==1)
							{ // si no esta firmado por jefe, si esta firmado por empleado, si estaus igual 1
						 ?>	
						   <tr>
								<td background="images/b_vacio.jpg" class="fondo" height="25"><div align="left" style="margin-left:8%;"><a href="javascript:verobjetivos('<?echo $res[0]?>');"><span class="text2">Revisar Planeación de Objetivos de <? echo"$res[4]";?> </span></a> </div></td>
							  </tr>
					  <?	
							}
							$count++;
						}
					  ?>
						  <?
							
					  if( $estatus<=2 && $etapa=="2")
					  {
					  ?>
                      <tr>
                        <td  background="images/b_vacio.jpg" class="fondo" height="25"><div align="left" style="margin-left:8%;"><a href="javascript:verobjetivos('<?echo $idU?>');"><span class="text2">Revisión Intermedia <? echo $revision;?></span></a> </div></td>
                      </tr>
					  <? }
						 if( $estatus<=4 && $etapa=="3")
					  {
						?>
						  <tr>
                        <td background="images/b_vacio.jpg" class="fondo" height="25"><div align="left" style="margin-left:8%;"><a href="javascript:verobjetivos('<?echo $idU?>');"><span class="text2">Cierre de Objetivos <? echo $revision;?></span></a> </div></td>
                      </tr>
					  <? }
						$consulta  = "SELECT planes.id_empleado, planes.firmaUser_midYearReview, planes.firmaJefe_midYearReview, planes.estatus, usuarios.nombre, planes.firma_e_f, planes.firma_j_f from planes inner join usuarios on planes.id_empleado=usuarios.id where usuarios.id_jefe=$idU and planes.revision=$revision ";
						$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: ". mysql_error() );//. mysql_error()	
						$count=0;
						while(@mysql_num_rows($resultado)>$count)					
						{
							$res=mysql_fetch_row($resultado);
							if($res[1]!=null && $res[2]==null && $res[3]==3)
							{ // si no esta firmado por jefe, si esta firmado por empleado, si estaus igual 3
						?>
						 <tr>
								<td  background="images/b_vacio.jpg" class="fondo" height="25"><div align="left" style="margin-left:8%;"><a href="javascript:verobjetivos('<?echo $res[0]?>');"><span class="text2">Revisión Internedia de Objetivos de <? echo"$res[4]";?> </span></a> </div></td>
							  </tr>
					  <?	
							}
							if($res[5]!="0000-00-00" && $res[6]=="0000-00-00" && $res[3]==5)
							{ // si no esta firmado por jefe, si esta firmado por empleado, si estaus igual 5 cierre de objetvos
						 ?>
							  <tr>
								<td  background="images/b_vacio.jpg" class="fondo" height="25"><div align="left" style="margin-left:8%;"><a href="javascript:verobjetivos('<?echo $res[0]?>');"><span class="text2">Cierre de Objetivos de <? echo"$res[4]";?> </span></a> </div></td>
							  </tr>
					  <?	
							}
							$count++;
						}
						
					  ?>
						 <? ////////////////////Seleccion de valuadores
					  if($plan!="" && $estatus360==0 && $etapa360=="1")
					  {
					  ?>
                      <tr>
                        <td  background="images/b_vacio.jpg" class="fondo" height="25"><div align="left" style="margin-left:8%;"><a href="seleccion_evaluadores.php" ><span class="text2">Selección de Evaluadores <? echo $revision;?></span></a> </div></td>
                      </tr>
					  <? }
					  ///////Contestar encuesta 360
					   if($plan!="" && $estatus360=="2" && $etapa360=="2")
					  {
					  ?>
                      <tr>
                        <td  background="images/b_vacio.jpg" class="fondo" height="25"><div align="left" style="margin-left:8%;"><a href="evaluacion_360.php" ><span class="text2"> Contestar Encuesta 360 <? echo $revision;?></span></a> </div></td>
                      </tr>
					  <? }
					   ////////////////////REvision de valuadores
					  	$consulta  = "SELECT planes.id_empleado, usuarios.nombre from planes inner join usuarios on planes.id_empleado=usuarios.id where usuarios.id_jefe=$idU and planes.revision=$revision and planes.estatus_360=1 ";
						$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1: ". mysql_error() );//. mysql_error()	
						$count=0;
						while(@mysql_num_rows($resultado)>$count)					
						{
							$res=mysql_fetch_row($resultado);
							if($etapa360==1)
							{ // si no esta firmado por jefe, si esta firmado por empleado, si estaus igual 1
						 ?>
							  <tr>
								<td  background="images/b_vacio.jpg" class="fondo" height="25"><div align="left" style="margin-left:8%;"><a href="revision_evaluadores.php?idE=<? echo"$res[0]";?>" ><span class="text2">Revisión de Evaluadores de <? echo"$res[1]";?> </span></a> </div></td>
							  </tr>
					  <?	
							}
							$count++;
						}
					  ?>
					   <?
					  if($plan!="" && $etapa=="4")
					  {
					  ?>
                      <tr>
                        <td  background="images/b_vacio.jpg" class="fondo" height="25"><div align="left" style="margin-left:8%;"><a href="javascript:verresultados('<?echo $idU?>','<?echo $revision?>');" ><span class="text2">Mis Resultados <? echo $revision;?></span></a> </div></td>
                      </tr>
					  <? } 
					  if($retro=="1" && $retro_e=="0")
					  {
					  ?>
                      <tr>
                        <td  background="images/b_vacio.jpg" class="fondo" height="25"><div align="left" style="margin-left:8%;"><a href="encuesta_cierre.php?id=<?echo"$idU";?>&revision=<?echo"$revision";?>" ><span class="text2">Cierre de Proceso PMP</span></a> </div></td>
                      </tr>
					  <? }?>
					  <tr>
                        <td  background="images/b_vacio.jpg" class="fondo" height="25"><div align="left" style="margin-left:8%;"><a href="planes.php" ><span class="text2">Plan de Desarrollo</span></a> </div></td>
                      </tr>
					  <tr>
                        <td  background="images/b_vacio.jpg" class="fondo" height="25"><div align="left" style="margin-left:8%;"><a href="planes_gente.php" ><span class="text2">Plan de Desarrollo de mi gente</span></a> </div></td>
                      </tr>
					  <? if($idU=="70749"){?>
					  <tr>
                        <td  background="images/b_vacio.jpg" class="fondo" height="25"><div align="left" style="margin-left:8%;"><a href="planes_tim.php" ><span class="text2">Plan de Desarrollo TIM</span></a> </div></td>
                      </tr>
					  <tr>
                        <td  background="images/b_vacio.jpg" class="fondo" height="25"><div align="left" style="margin-left:8%;"><a href="reporte_plan_desarrollo.php" ><span class="text2">Reporte Plan de Desarrollo TIM</span></a> </div></td>
                      </tr>
					  <? }?>
       <tr>
        <td><img src="images/spacer1.gif" width="10" height="21" /></td>
      </tr>
      <tr>
        <td  background="images/tit_vacio.jpg" height="35"><div align="left" style="margin-left:8%;"><span class="text">Objetivos</span></div></td>
      </tr>
       <tr>
                          <td  background="images/b_vacio.jpg" class="fondo" height="25"><div align="left" style="margin-left:8%;"><a href="javascript:verobjetivos('<?echo $idU?>');"><span class="text2">Mis Objetivos</span></a></div></td>
                        </tr>
						<? if($idU==2 || $idU==1){?>
						<tr>
                          <td  background="images/b_vacio.jpg" class="fondo" height="25"><div align="left" style="margin-left:8%;"><a href="javascript:verobjetivos2('<?echo $idU?>');"><span class="text2">Mis Objetivos 2</span></a></div></td>
                        </tr>
						<tr>
                          <td  background="images/b_vacio.jpg" class="fondo" height="25"><div align="left" style="margin-left:8%;"><a href="javascript:verobjetivos2('<?echo $jefe?>');"><span class="text2">Objetivos de mi Jefe 2</span></a></div></td>
                        </tr>
						<? }?>
                        <tr>
                          <td  background="images/b_vacio.jpg" class="fondo" height="25"><div align="left" style="margin-left:8%;"><a href="javascript:verobjetivos('<?echo $jefe?>');"><span class="text2">Objetivos de mi Jefe</span> </a></div></td>
                        </tr>
                        <tr>
                          <td  background="images/b_vacio.jpg" class="fondo" height="25"> <div align="left" style="margin-left:8%"><a href="migente.php"><span class="text2">Objetivos de mi Gente</span> </a></div></td>
                      </tr> 
											 <tr>
        <td><img src="images/spacer1.gif" width="10" height="21" /></td>
      </tr>
      <tr>
        <td  background="images/tit_vacio.jpg" height="35"><div align="left" style="margin-left:8%;"><span class="text">Documentos Tim</span></div></td>
      </tr>
     <tr>
                          <td background="images/b_vacio.jpg" class="fondo" height="25"><div align="left" style="margin-left:8%;"><a href="docs/ToolKit-CompetenciasdeLiderazgo(360).pdf" target="_blank"><span class="text2">Competencias de Liderazgo Evaluación 360 </span></a></div></td>
                        </tr>
                        <tr>
                          <td background="images/b_vacio.jpg" class="fondo" height="25"><div align="left" style="margin-left:8%;"><a href="docs/Behaviorsflier.pdf" target="_blank"><span class="text2">Textron Behaviors </span></a></div></td>
                        </tr>
			
			<!-----------------------------------Menu Personal------------------------------------------------->
			<tr>
				<td background="images/tit_vacio.jpg" height="35">
					<div align="left" style="margin-left:8%;">
						<span class="text">
							Personal
						</span>
					</div>
				</td>
			</tr>
			
			<tr>
				<td background="images/b_vacio.jpg" class="fondo" height="25" >
					<div align="left" style="margin-left:8%;" onclick="window.location = 'career_tim.php'">
						<span class="text2" style="cursor:pointer;">
							Career File TIM
						</span>
					</div>
				</td>
			</tr>
			
			<tr>
				<td background="images/b_vacio.jpg" class="fondo" height="25" >
					<div align="left" style="margin-left:8%;" onclick="window.location = 'career_profile.php'">
						<span class="text2" style="cursor:pointer;">
							My Career File
						</span>	
					</div>
				</td>
			</tr>
			
			<tr>
				<td background="images/b_vacio.jpg" class="fondo" height="25" >
					<div align="left" style="margin-left:8%;" onclick="window.location = 'career_migente.php'">
						<span class="text2" style="cursor:pointer;">
							Career File de mi gente
						</span>
					</div>
				</td>
			</tr>
			
			<tr>
				<td background="images/b_vacio.jpg" class="fondo" height="25" >
					<div align="left" style="margin-left:8%;">
						<a href="historial.php">
							<span class="text2">
								Historial de Resultados
							</span>	
						</a>
					</div>	
				</td>
			</tr>
			
			<tr>
				<td background="images/b_vacio.jpg" class="fondo" height="25" >
					<div align="left" style="margin-left:8%;" onclick="window.location = 'historial_migente.php'">
						<span class="text2" style="cursor:pointer;">
							Historial de Resultados de mi gente
						</span>	
					</div>
				</td>
			</tr>
			
			<!--<tr>
				<td background="images/b_vacio.jpg" class="fondo" height="25" >
					<div align="left" style="margin-left:8%;" class="text2">
					<? if($archivo!=""){?>
						<a href="docs_puestos/<? echo"$archivo";?>" target="_blank" class="text2">Descripción de Puesto<br />
				(Leido y/o Actualizado)
						</a>
						<input name="leido" type="checkbox" id="leido" value="1" onclick="leidos();" <? if($leido=="1") echo"checked";?>/> 
					<? }
					else
					{?>
					<!--<a href="docs_puestos/<? echo"$archivo";?>" target="_blank" class="text2">
					Descripción de Puesto<br />
					<!--</a>
					<? }?>
					</div>
				</td>
			</tr>			-->						
    </table></td>
    <td valign="top"><table width="724" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><img src="images/header.jpg" width="724" height="245" /></td>
      </tr>
      <tr>
        <td height="500" valign="top" bgcolor="#eeeeee"><table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td><img src="images/spacer1.gif" width="10" height="21" /></td>
          </tr>
          <tr>
            <td><div align="center" class="texto_titulos_arial_regular">BIENVENIDO A TU PORTAL PMP</div><br /><div align="center">(GESTIÓN DEL DESEMPEÑO)</div></td>
          </tr>
          <tr>
            <td align="center"><img src="images/spacer1.gif" width="10" height="3" /></td>
          </tr>
          <tr>
            <td><div align="center"><img src="images/linea.png" width="543" height="9" /></div></td>
          </tr>
          <tr>
            <td align="center"><img src="images/proceso.png" width="485" height="398" /></td>
          </tr>
					<tr>
            <td><img src="images/spacer1.gif" width="10" height="3" /></td>
          </tr>
					
          <tr>
            
          </tr>
          <tr>
            <td>&nbsp;</td>
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
    </table></td>
  </tr>
  <tr>
    <td colspan="2" valign="top" background="images/bkg_abajo.jpg"><img src="images/spacer1.gif" width="10" height="17" /><img src="images/spacer1.gif" width="10" height="17" /></td>
  </tr>
</table>
</form>
</body>
</html>
