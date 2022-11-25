<?
session_start();
include "checar_sesion_admin.php";
include "coneccion_i.php";
$idU=$_SESSION['idU'];
$plan=$res[0];
$estatus="";
$firma1e="";
$firma2e="";
$firma1j="";
$firma2j="";
	$consulta  = "SELECT revision, etapa, etapa_360 from etapa where id=1";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_row($resultado);
		$revision=$res[0];
		$etapa=$res[1];
		$etapa360=$res[2];
	}
	$consulta  = "SELECT id, estatus, firma_e_i, firma_e_f, firma_j_i, firma_j_f, estatus_360 from planes where id_empleado=$idU and revision=$revision";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//	
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_row($resultado);
		$plan=$res[0];
		$estatus=$res[1];
		$firma1e=$res[2];
		$firma2e=$res[3];
		$firma1j=$res[4];
		$firma2j=$res[5];
		$estatus360=$res[6];
	}
	$consulta  = "SELECT id_jefe from usuarios where id=$idU";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//	
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_row($resultado);
		$jefe=$res[0];
		
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
	document.form1.submit();
}
//-->
</script>
<style type="text/css">
<!--
.style1 {font-size: 24px}
-->
</style>
</head>

<body onload="MM_preloadImages('images/b_cambio_r.png','images/b_administracion_r.png','images/b_log_out_r.png')">
<form id="form1" name="form1" method="post" action="">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
   <?include_once("header.php");?>
  </tr>
  <tr>
    <td height="698" valign="top" background=""><table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><img src="images/spacer.gif" width="10" height="20" /></td>
      </tr>
      <tr>
        <td><div align="center">
          <table width="850" border="0" cellspacing="7" cellpadding="0">
            <tr>
              <td><div align="center" class="text_grande style1">BIENVENIDO AL TU PORTAL DE PMP </div></td>
            </tr>
            <tr>
              <td><div align="center" class="text_mediano">(GESTIÓN DEL DESEMPEÑO)</div></td>
            </tr>
          </table>
        </div></td>
      </tr>
      <tr>
        <td><img src="images/spacer.gif" width="10" height="20" /></td>
      </tr>
      <tr>
        <td><table width="814" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td colspan="3"><img src="images/cuadro_int_arriba.png" width="814" height="20" /></td>
            </tr>
          <tr>
            <td width="20"><img src="images/cuadro_int_izq.png" width="20" height="115" /></td>
            <td width="774" bgcolor="#FFFFFF"><table width="730" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td><div align="left" class="texto_chico">Mensaje para ti: </div></td>
              </tr>
              <tr>
                <td><img src="images/spacer.gif" width="10" height="10" /></td>
              </tr>
              <tr>
                <td><div align="center" class="text_grande">El hombre inteligente no es el que tiene muchas ideas, sino el que sabe<br />
                  sacar provecho de las pocas que tiene”.</div></td>
              </tr>
              <tr>
                <td><img src="images/spacer.gif" width="10" height="10" /></td>
              </tr>
              <tr>
                <td><div align="right" class="olvido">Anónimo</div></td>
              </tr>
              
            </table></td>
            <td width="20"><img src="images/cuadro_int_der.png" width="20" height="115" /></td>
          </tr>
          <tr>
            <td colspan="3"><img src="images/cuadro_int_abajo.png" width="814" height="20" /></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="images/spacer.gif" width="10" height="10" /></td>
      </tr>
      <tr>
        <td><table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="250" valign="top" bgcolor="#eeeeee"><table width="753" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td><img src="images/spacer.gif" width="10" height="20" />
                  <input name="verobjetivos" type="hidden" id="verobjetivos" /></td>
              </tr>
              <tr>
                <td><span class="tit_1">Ciclo <? echo"$revision";?> Etapa: </span><span class="texto_tareas">Revisión Intermedia </span></td>
              </tr>
              <tr>
                <td><img src="images/franja.jpg" width="753" height="12" /></td>
              </tr>
              <tr>
                <td><img src="images/spacer.gif" width="10" height="10" /></td>
              </tr>
              <tr>
                <td><table width="753" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="223" valign="top"><table width="223" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td background="images/tit_sin_nada.jpg"><div align="center"><span class="text_mediano_blanco">TAREAS PENDIENTES </span></div></td>
                      </tr>
					  <?
					  if(($plan=="" || ($plan!="" && $estatus==0)) && $etapa<="1")
					  {
					  ?>
                      <tr>
                        <td height="27" bgcolor="#DFDFDF"><div align="center" class="texto_tareas"><a href="javascript:verobjetivos('<?echo $idU?>');" class="texto_tareas">Capturar Planeación <? echo $revision;?></a> </div></td>
                      </tr>
					  <? }
					  	$consulta  = "SELECT planes.id_empleado, planes.firma_j_i, planes.firma_e_i, planes.estatus, usuarios.nombre from planes inner join usuarios on planes.id_empleado=usuarios.id where usuarios.id_jefe=$idU and planes.revision=$revision ";
						$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)	
						$count=0;
						while(@mysqli_num_rows($resultado)>$count)					
						{
							$res=mysqli_fetch_row($resultado);
							if($res[1]=="0000-00-00" && $res[2]!="0000-00-00" && $res[3]==1)
							{ // si no esta firmado por jefe, si esta firmado por empleado, si estaus igual 1
						 ?>
							  <tr>
								<td height="27" bgcolor="#DFDFDF"><div align="center" class="texto_tareas"><a href="javascript:verobjetivos('<?echo $res[0]?>');" class="texto_tareas">Revisar Planeación de Objetivos de <? echo"$res[4]";?> </a> </div></td>
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
                        <td height="27" bgcolor="#DFDFDF"><div align="center" class="texto_tareas"><a href="javascript:verobjetivos('<?echo $idU?>');" class="texto_tareas">Revisión Intermedia <? echo $revision;?></a> </div></td>
                      </tr>
					  <? }
					  	$consulta  = "SELECT planes.id_empleado, planes.firmaUser_midYearReview, planes.firmaJefe_midYearReview, planes.estatus, usuarios.nombre from planes inner join usuarios on planes.id_empleado=usuarios.id where usuarios.id_jefe=$idU and planes.revision=$revision ";
						$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)	
						$count=0;
						while(@mysqli_num_rows($resultado)>$count)					
						{
							$res=mysqli_fetch_row($resultado);
							if($res[1]!=null && $res[2]==null && $res[3]==3)
							{ // si no esta firmado por jefe, si esta firmado por empleado, si estaus igual 3
						 ?>
							  <tr>
								<td height="27" bgcolor="#DFDFDF"><div align="center" class="texto_tareas"><a href="javascript:verobjetivos('<?echo $res[0]?>');" class="texto_tareas">Revisión Internedia de Objetivos de <? echo"$res[4]";?> </a> </div></td>
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
                        <td height="27" bgcolor="#DFDFDF"><div align="center" class="texto_tareas"><a href="seleccion_evaluadores.php" class="texto_tareas">Selección de Evaluadores <? echo $revision;?></a> </div></td>
                      </tr>
					  <? }
					  ///////Contestar encuesta 360
					   if($plan!="" && $estatus360=="2" && $etapa360=="2")
					  {
					  ?>
                      <tr>
                        <td height="27" bgcolor="#DFDFDF"><div align="center" class="texto_tareas"><a href="evaluacion_360.php" class="texto_tareas">Contestar Encuesta 360 <? echo $revision;?></a> </div></td>
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
								<td height="27" bgcolor="#DFDFDF"><div align="center" class="texto_tareas"><a href="revision_evaluadores.php?idE=<? echo"$res[0]";?>" class="texto_tareas">Revisión de Evaluadores de <? echo"$res[1]";?> </a> </div></td>
							  </tr>
					  <?	
							}
							$count++;
						}
					  ?>
                    </table>
                      <div align="center"><br />
                        <br />
                      </div>
                      <table width="223" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td background="images/tit_sin_nada.jpg"><div align="center" class="text_mediano_blanco">OBJETIVOS</div></td>
                        </tr>
                        <tr>
                          <td height="27" bgcolor="#DFDFDF"><div align="center" class="texto_tareas"><a href="javascript:verobjetivos('<?echo $idU?>');" class="texto_tareas">Mis Objetivos </a></div></td>
                        </tr>
                        <tr>
                          <td height="27" class="texto_tareas"><div align="center"><a href="javascript:verobjetivos('<?echo $jefe?>');" target="_blank" class="texto_tareas">Objetivos de mi Jefe </a></div></td>
                        </tr>
                        <tr>
                          <td height="27" bgcolor="#DFDFDF" class="texto_tareas"><div align="center" class="texto_tareas"><a href="migente.php" class="texto_tareas">Objetivos de mi Gente </a></div></td>
                        </tr>
                      </table>
                      <br />
                      <table width="223" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td background="images/tit_sin_nada.jpg" class="text_mediano_blanco"><div align="center">DOCUMENTACIÓN</div></td>
                        </tr>
                        <tr>
                          <td height="27" bgcolor="#DFDFDF"><div align="center" class="texto_tareas">Nombre de la tarea pendiente</div></td>
                        </tr>
                        <tr>
                          <td height="27" class="texto_tareas"><div align="center"><a href="docs/ToolKit-CompetenciasdeLiderazgo(360).pdf" target="_blank" class="texto_tareas">Competencias de Liderazgo Evaluación 360 </a></div></td>
                        </tr>
                      </table>
                      <br />
                      <table width="223" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td background="images/tit_sin_nada.jpg" class="text_mediano_blanco"><div align="center">PERSONAL</div></td>
                        </tr>
                        <tr>
                          <td height="27" bgcolor="#DFDFDF"><div align="center" class="texto_tareas" onclick="window.location = 'career_profile.php'" style="cursor:pointer">Career Profile</div></td>
                        </tr>
						<tr>
                          <td height="27" bgcolor="#DFDFDF"><div align="center" class="texto_tareas" onclick="window.location = 'career_migente.php'" style="cursor:pointer">Career Profile de mi gente</div></td>
                        </tr>
                      </table>
<br /></td>
                    <td width="20"><img src="images/spacer.gif" width="42" height="20" /></td>
                    <td colspan="3" valign="top"><div align="center"><img src="images/grafica.png" width="366" height="252" /></div></td>
                    </tr>
                  <tr>
                    <td valign="top">&nbsp;</td>
                    <td><img src="images/spacer.gif" width="42" height="20" /></td>
                    <td width="223" valign="top">&nbsp;</td>
                    <td><img src="images/spacer.gif" width="42" height="20" /></td>
                    <td valign="top">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td><img src="images/spacer.gif" width="10" height="20" /></td>
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
            <td width="114">
			<a href="<? echo $_SESSION["idA"]=="1"? 'admin.php':'menu.php';?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image24','','images/b_administracion_r.png',1)"><img src="images/b_administracion.png" name="Image24" width="114" height="23" border="0" id="Image24" /></a></td>
            <td><img src="images/spacer.gif" width="17" height="20" /></td>
            <td><a href="logout.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image25','','images/b_log_out_r.png',1)"><img src="images/b_log_out.png" name="Image25" width="71" height="23" border="0" id="Image25" /></a></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>

</form>
</body>
</html>
