<?
session_start();
include "checar_sesion_admin.php";
include "coneccion_i.php";
$idU=$_SESSION['idU'];
$rev=$_POST["rev"];
$borrar=$_POST["borrar"];
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
	
	if($borrar!="")
	{
		$query="delete from io_principies where id=$borrar";
		$resultado=mysqli_query($enlace,$query)or die("Falla al desactivar usuario: ".mysqli_error($enlace));
		echo"<script>alert(\"Objetivo eliminado\");</script>";
	}
if($rev!="")
{
$revision=$rev;
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
		$(".iframe3").colorbox({iframe:true,width:"650", height:"520",transition:"fade", scrolling:false, opacity:0.1});
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
function borrar(id)
{
	if(confirm('Deseas borrar este objetivo?')){
		document.form1.borrar.value=id;
		document.form1.submit();
	}
}
function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<style type="text/css">
<!--
.style1 {font-size: 24px}
.style10 {font-family: Geneva, Arial, Helvetica, sans-serif; font-size: 16px; color: #104352; }
-->
</style>
</head>

<body onload="MM_preloadImages('images/b_cambio_r.png','images/b_administracion_r.png','images/b_log_out_r.png','images/b_inicio_r.png')">
<form action="" method="post"  name="form1" id="form1">
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
              <td><div align="center" class="text_grande style1">ADMINISTRACIÓN DEL  PORTAL DE PMP </div></td>
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
        <td><img src="images/spacer.gif" width="10" height="10" /></td>
      </tr>
      <tr>
        <td><table width="844" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="250" valign="top" bgcolor="#eeeeee"><table width="836" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td><img src="images/spacer.gif" width="10" height="20" /></td>
              </tr>
              <tr>
                <td><span class="tit_1">Administración de Objetivos <? echo"$revision";?>  </span><span class="texto_tareas">
                  <input name="verobjetivos" type="hidden" id="verobjetivos" />
                  <input name="borrar" type="hidden" id="borrar" />
                </span></td>
              </tr>
              <tr>
                <td><img src="images/franja.jpg" width="753" height="12" /></td>
              </tr>
              <tr>
                <td><img src="images/spacer.gif" width="10" height="10" /></td>
              </tr>
              <tr>
                <td valign="top"><table width="85%" border="0" align="center" cellpadding="0" cellspacing="2">
                  <tr>
                    <td class="text_mediano_blanco">&nbsp;</td>
                    <td colspan="4" class="text_mediano">Revisión                      
                      <select name="rev" id="rev">
                        
					  <?
					  $consulta  = "SELECT revision from io_principies group by revision";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	$contador=0;
	while(@mysqli_num_rows($resultado)>$contador)
	{
		$res=mysqli_fetch_row($resultado);
		if($revision==$res[0])
		echo"<option value=\"$res[0]\" selected>$res[0]</option>";
		else
		echo"<option value=\"$res[0]\">$res[0]</option>";
		
		$contador++;
	}
	//echo"<option value=\"2018\">2018</option>";
	?>
                      </select>
                      <input name="buscar" type="submit" id="buscar" value="Buscar" /></td>
                  </tr>
                  <tr>
                    <td class="text_mediano_blanco">&nbsp;</td>
                    <td colspan="4" class="text_mediano_blanco"><div align="right" class="text_mediano"><a href="agregar_ob.php" class="text_mediano iframe2">Agregar Objetivos</a> </div></td>
                    </tr>
                  <tr>
                    <td width="5%" bgcolor="#00475c" class="text_mediano_blanco">No.</td>
                    <td width="57%" bgcolor="#00475c" class="text_mediano_blanco">Nombre</td>
                    <td width="16%" bgcolor="#00475c" class="text_mediano_blanco">&nbsp;</td>
                    <td width="13%" bgcolor="#00475c" class="text_mediano_blanco">&nbsp;</td>
                    <td width="9%" bgcolor="#00475c" class="text_mediano_blanco">&nbsp;</td>
                  </tr>
				   <? 
					  	$color="CCCCCC";
						
						$consulta  = "SELECT * from io_principies where revision=$revision order by id";
						$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)	
						$count=0;
						while(@mysqli_num_rows($resultado)>$count)					
						{
							$res=mysqli_fetch_row($resultado);
							
						 ?>
                  <tr bgcolor="#<?echo"$color";?>">
                    <td  class="texto_tareas"><a href="editar_ob.php?id=<? echo $res[0];?>" class="texto_tareas iframe2"><? echo $count+1?></a></td>
                    <td  class="texto_tareas"><a href="editar_ob.php?id=<? echo $res[0];?>" class="texto_tareas iframe2"><? echo"$res[1]";?></a></td>
                    <td  class="texto_tareas" align="center"><a href="agregar_lags.php?id=<? echo $res[0];?>" class="boton iframe3">Agregar Lags</a></td>
                    <td  class="texto_tareas" align="center"><a href="agregar_leads.php?id=<? echo $res[0];?>" class="boton iframe3">Agregar Leads</a></td>
                    <td  class="texto_tareas" align="center"><a href="javascript:borrar(<? echo $res[0] ?>);"><img src="images/eliminar.png" width="20px" height="20px" border="0" title="Eliminar Usuario"/></a></td>
                  </tr>
				  <?
				  if($color=="CCCCCC")
				  	$color="FFFFFF";
					else
					$color="CCCCCC";
					$count++;
				}
				  ?>
                  <tr>
                    <td bgcolor="#FFFFFF" class="texto_tareas">&nbsp;</td>
                    <td bgcolor="#FFFFFF" class="texto_tareas">&nbsp;</td>
                    <td bgcolor="#FFFFFF" class="texto_tareas">&nbsp;</td>
                    <td bgcolor="#FFFFFF" class="texto_tareas">&nbsp;</td>
                    <td bgcolor="#FFFFFF" class="texto_tareas">&nbsp;</td>
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
        <?include_once("footer.php");?>
      </tr>
    </table></td>
  </tr>
</table>

</form>
</body>
</html>
