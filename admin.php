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
	$consulta  = "SELECT revision, etapa from etapa where id=1";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_row($resultado);
		$revision=$res[0];
		$etapa=$res[1];
	}
	$consulta  = "SELECT id, estatus, firma_e_i, firma_e_f, firma_j_i, firma_j_f from planes where id_empleado=$idU and revision=$revision";
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
	}
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
-->
</style>
<link href="css/textos.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="colorbox.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="colorbox/jquery.colorbox-min.js"></script>
<script> 
	$(document).ready(function(){
	$(".iframe").colorbox({iframe:true,width:"450", height:"320",transition:"fade", scrolling:false, opacity:0.1});
	$(".iframe2").colorbox({iframe:true,width:"450", height:"420",transition:"fade", scrolling:false, opacity:0.1});
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

<body onload="MM_preloadImages('images/b_cambio_r.png','images/b_administracion_r.png','images/b_log_out_r.png','images/b_inicio_r.png')">
<form id="form1" name="form1" method="post" action="">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <?
      include_once("header.php");
    ?>
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
              <td><div align="center" class="text_grande style1">ADMINISTRACIÓN DEL  PORTAL DE PMP </div></td>
            </tr>
            <tr>
              <td><div align="center" class="text_mediano">(GESTIÓN DEL DESEMPEÑO)</div></td>
            </tr>
          </table>
        </div></td>
      </tr>
      <tr>
        <td><div align="right"><a href="menu.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image30','','images/b_inicio.png',1)"><img src="images/b_inicio.png" name="Image30" width="58" height="23" border="0" id="Image30" /></a><a href="menu.php" class="boton"></a><img src="images/spacer.gif" width="41" height="20" /></div></td>
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
                <td><span class="tit_1">Ciclo <? echo"$revision";?> Etapa: </span><span class="texto_tareas">Planeación</span></td>
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
                    <td width="223" valign="top"><div align="center"></div>
                      <table width="223" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td background="images/tit_sin_nada.jpg"><div align="center" class="text_mediano_blanco">REPORTES</div></td>
                        </tr>
                        <tr>
                          <td height="27" bgcolor="#DFDFDF"><div align="center" class="texto_tareas"><a href="reporte_planes.php" class="texto_tareas">Estatus de Planes</a> </div></td>
                        </tr>
                        <tr>
                          <td height="27" class="texto_tareas"><div align="center"><a href="avances_area.php" class="texto_tareas">Avances por Área  </a></div></td>
                        </tr>
						<!--<tr>
                          <td height="27" bgcolor="#DFDFDF"><div align="center" class="texto_tareas"><a href="reporte_resultados_check.php" class="texto_tareas">Resultados de Revisión Intermedia</a> </div></td>
                        </tr>-->
						 <!--<tr>
                          <td height="27" class="texto_tareas"><div align="center"><a href="reporte_encuesta_cierre.php" class="texto_tareas">Reporte de encuesta de cierre  </a></div></td>
                        </tr>-->
						<!--<tr>
                          <td height="27" bgcolor="#DFDFDF"><div align="center" class="texto_tareas"><a href="reporte_porcentaje_calif.php" class="texto_tareas">Reporte de Porcentaje de calificaciones dadas</a> </div></td>
                        </tr>-->
						<!--<tr>
                          <td height="27" class="texto_tareas"><div align="center"><a href="reporte_leer.php" class="texto_tareas">Reporte de Descripción de Puesto  </a></div></td>
                        </tr>-->
												
													<tr>
													<td height="27"  bgcolor="#DFDFDF"><div align="center"><a href="reporte_plan_desarrollo.php" class="texto_tareas">Reporte Plan de Desarrollo TIM</a></div></td>
												</tr>
												<tr>
													<td height="27" ><div align="center"><a href="career_tim.php" class="texto_tareas">Career File TIM</a></div></td>
												</tr>
												<tr >
                          <td height="27"   bgcolor="#DFDFDF" ><div align="center" class="texto_tareas"><a href="objetivos_planta.php" class="texto_tareas">Resultados Objetivos de Planta</a> </div></td>
                        </tr>
												
                      </table>                      
                      <br />
                      <table width="223" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td background="images/tit_sin_nada.jpg"><div align="center" class="text_mediano_blanco">ADMINISTRADOR</div></td>
                        </tr>
                        <tr>
                          <td height="27" bgcolor="#DFDFDF"><div align="center" class="texto_tareas"><a href="etapas.php" class="texto_tareas iframe2">Administración de Etapa y Revision</a> </div></td>
                        </tr>
                        <tr>
                          <td height="27" class="texto_tareas"><div align="center"><a href="usuarios.php" class="texto_tareas">Administración de Usuarios</a></div></td>
                        </tr>
                        <tr>
                          <td height="27" bgcolor="#DFDFDF"><div align="center" class="texto_tareas"><a href="grupos_calibracion.php" class="texto_tareas">Administración de Calibraciones </a> </div></td>
                        </tr>
                        <tr>
                          <td height="27" class="texto_tareas"><div align="center"><a href="calibraciones_excel.php?revision=<? echo $revision?>" target="_blank" class="texto_tareas">Exportar Resultados </a></div></td>
                        </tr>
						<tr>
                          <td height="27" bgcolor="#DFDFDF"><div align="center" class="texto_tareas"><a href="departamentos.php" class="texto_tareas">Administración de Departamentos </a> </div></td>
                        </tr>
						 <tr>
                          <td height="27" class="texto_tareas"><div align="center"><a href="adm_objetivos.php"  class="texto_tareas">Administración de Matriz</a></div></td>
                        </tr>
						<tr>
                          <td height="27" class="texto_tareas" bgcolor="#DFDFDF"><div align="center"><a href="puestos.php" target="_blank" class="texto_tareas">Administrar Puestos </a></div></td>
                        </tr>
						
                      </table>
					  <br/>
					  <table width="223" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td background="images/tit_sin_nada.jpg"><div align="center" class="text_mediano_blanco">HERRAMIENTAS</div></td>
                        </tr>
                        <tr>
                          <td height="27" bgcolor="#DFDFDF"><div align="center" class="texto_tareas"><a href="loginAS.php" class="texto_tareas">Entrar como otro Usuario</a> </div></td>
                        </tr>
						 
					<tr>
                           <td height="27"><div align="center" class="texto_tareas"><a href="filosofia_organizacional.php" class="texto_tareas">Filosofia Organizacional</a> </div></td>
                        </tr>
												
												<tr>
                           <td height="27" bgcolor="#DFDFDF"><div align="center" class="texto_tareas"><a href="programas.php" class="texto_tareas">Programas Anuales</a> </div></td>
                        </tr>
												
                      </table> 
                      <p>&nbsp;</p></td>
                    <td width="20"><img src="images/spacer.gif" width="42" height="20" /></td>
                    <td colspan="3" valign="top"><div align="center"></div></td>
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
      <?
        include_once("footer.php");
      ?>
      </tr>
    </table></td>
  </tr>
</table>

</form>
</body>
</html>
