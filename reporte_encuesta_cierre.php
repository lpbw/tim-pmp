<?
session_start();
include "checar_sesion_admin.php";
include "coneccion_i.php";
$idU=$_SESSION['idU'];
$revision=$_POST["revision"];
	
	
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


function buscar()
{
	document.form1.action="reporte_encuesta_cierre.php";
	document.form1.submit();
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
                <td><span class="tit_1">Reporte de resultados de la encuesta de cierre </span><span class="texto_tareas"></span></td>
              </tr>
              <tr>
                <td><img src="images/franja.jpg" width="753" height="12" /></td>
              </tr>
              <tr>
                <td><img src="images/spacer.gif" width="10" height="10" /></td>
              </tr>
              <tr>
                <td valign="top"><table width="99%" border="0" cellspacing="2" cellpadding="0">
                  <tr>
                    <td colspan="4"><input name="verobjetivos" type="hidden" id="verobjetivos" />
                      <span class="style10">
                      <select name="revision" class="texto_verde" id="revision" onchange="buscar();">
                        <option value="0">--Revisiones--</option>
						
                        <?	  

		
	$consulta  = "SELECT revision FROM planes group by revision ORDER BY revision";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: " . mysqli_error($enlace));
	$count=1;
	while(@mysqli_num_rows($resultado)>=$count)
	{
		$res2=mysqli_fetch_row($resultado);
		if($revision==$res2[0])
			echo"<option value=\"$res2[0]\" selected>$res2[0]</option>";
		else
			echo"<option value=\"$res2[0]\" >$res2[0]</option>";
		$count=$count+1;
	}	
		
		?>
                      </select>
                      <? if($revision!=0 and $revision!=""){?><a href="reporte_encuesta_cierre_excel.php?revision=<?echo"$revision";?>" target="_blank" class="text_mediano">Exportar a excel </a><? }?></span></td>
                    </tr>
                  <tr>
                    <td width="8%" bgcolor="#00475c" class="text_mediano_blanco">&nbsp;</td>
                    <td width="38%" bgcolor="#00475c" class="text_mediano_blanco"><div align="left">1.- Recibiste retroalimentación de tu resultado en Objetivos?</div></td>
                    <td width="29%" bgcolor="#00475c" class="text_mediano_blanco"><div align="left">2.-Recibiste retroalimentación de tu Evaluación 360°?</div></td>
                    <td width="25%" bgcolor="#00475c" class="text_mediano_blanco"><div align="left">3.-	Recibiste calificación final de desempeño?</div></td>
                  </tr>
				   <? 
					  	$color="CCCCCC";
						if($revision!="")
						{
							$consulta  = "SELECT count(p1), p1 FROM encuesta_cierre where revision=$revision group by p1";					
							$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)	
							$count=0;
							while(@mysqli_num_rows($resultado)>$count)					
							{
								$res=mysqli_fetch_row($resultado);
								if($res[1]=="0")
									$no_p1=$res[0];
								if($res[1]=="1")
									$si_p1=$res[0];
							$count++;
							}
							$consulta  = "SELECT count(p2), p2 FROM encuesta_cierre where revision=$revision group by p2";					
							$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)	
							$count=0;
							while(@mysqli_num_rows($resultado)>$count)					
							{
								$res=mysqli_fetch_row($resultado);
								if($res[1]=="0")
									$no_p2=$res[0];
								if($res[1]=="1")
									$si_p2=$res[0];
							$count++;
							}
							$consulta  = "SELECT count(p3), p3 FROM encuesta_cierre where revision=$revision group by p3";					
							$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)	
							$count=0;
							while(@mysqli_num_rows($resultado)>$count)					
							{
								$res=mysqli_fetch_row($resultado);
								if($res[1]=="0")
									$no_p3=$res[0];
								if($res[1]=="1")
									$si_p3=$res[0];
							$count++;
							}
						}
							//if($res[1]=="0000-00-00" && $res[2]!="0000-00-00" && $res[3]==1)
							//{ // si no esta firmado por jefe, si esta firmado por empleado, si estaus igual 1*/
						 ?>
                  <tr bgcolor="#<?echo"$color";?>">
                    <td  class="texto_tareas"><div align="center">Si</div></td>
                    <td  class="texto_tareas"><div align="center"><? echo"$si_p1";?></div></td>
                    <td  class="texto_tareas"><div align="center"><? echo"$si_p2";?></div></td>
                    <td  class="texto_tareas"><div align="center"><? echo"$si_p3";?></div></td>
                  </tr>
                  <tr bgcolor="#<?echo"$color";?>">
                    <td  class="texto_tareas"><div align="center">No</div></td>
                    <td  class="texto_tareas"><div align="center"><? echo"$no_p1";?></div></td>
                    <td  class="texto_tareas"><div align="center"><? echo"$no_p2";?></div></td>
                    <td  class="texto_tareas"><div align="center"><? echo"$no_p3";?></div></td>
                  </tr>
				  
				  
                </table></td>
              </tr>
              
            </table>
              <br />
              <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td colspan="3">Detalles de No </td>
                  </tr>
                <tr>
                  <td width="152" bgcolor="#00475c" class="text_mediano_blanco">Empleado</td>
                  <td width="170" bgcolor="#00475c" class="text_mediano_blanco">Jefe</td>
                  <td width="278" bgcolor="#00475c" class="text_mediano_blanco">Comentario</td>
                </tr>
				<?
				if($revision!="")
				{
				$consulta  = "SELECT e.nombre, j.nombre, c.comentarios FROM encuesta_cierre as c inner join usuarios as e on c.id_empleado=e.id inner join usuarios as j on e.id_jefe=j.id where c.p1=0 or c.p2=0 or c.p3=0 and revision=$revision";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: " . mysqli_error($enlace));
	$count=1;
	while(@mysqli_num_rows($resultado)>=$count)
	{
		$res2=mysqli_fetch_row($resultado);
		?>
                <tr>
                  <td><? echo"$res2[0]";?></td>
                  <td><? echo"$res2[1]";?></td>
                  <td><? echo"$res2[2]";?></td>
                </tr>
				
				<?
				$count++;
				}
				}
				?>
              </table>
              <p>&nbsp;</p></td>
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

</form>
</body>
</html>
