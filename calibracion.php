<?
session_start();
include "checar_sesion_admin.php";
include "coneccion_i.php";
$idU=$_SESSION['idU'];
$id=$_GET["id"];
$revision=$_GET["revision"];
if($revision=="")
{
	$consulta  = "SELECT revision, nombre, estatus from grupos_calibracion where id=$id";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_row($resultado);
		$revision=$res[0];
		$nombre=$res[1];
		$estatus=$res[2];
	}
}
if($_POST["guardar"]=="Guardar Calibracion" || $_POST["cerrar"]=="Cerrar Calibracion")
{
	$id=$_POST["id"];
 $id_c = $_POST["id_c"];
 $resulta = $_POST["resultado"];
 $clasifi = $_POST["clasifi"];
 $contador=0;
 if (sizeof($id_c) > 0)
   foreach ($id_c as $na) {
   		$c=$clasifi[$contador];
   		if($c=="A" || $c=="a")
			$c="3";
		else
			if($c=="M" || $c=="m")
				$c="2";
			else
			  if($c=="B" || $c=="b")
				$c="1";
			  else 
				$c="0";
   		$consulta = "update planes set  resultado_calibracion=$resulta[$contador], clasificacion=$c where id_empleado=$na and revision=$revision";
		$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro: $consulta" . mysqli_error($enlace));
		$contador++;
   }
}

if($_POST["cerrar"]=="Cerrar Calibracion")
{
 $id=$_POST["id"];

   		$consulta = "update grupos_calibracion set  estatus=1 where id=$id ";
		$resultado = mysqli_query($enlace,$consulta) or die("Error en operacion registro: $consulta" . mysqli_error($enlace));

}




$consulta  = "SELECT revision, nombre, estatus from grupos_calibracion where id=$id";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_row($resultado);
		$revision=$res[0];
		$nombre=$res[1];
		$estatus=$res[2];
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
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url();
	background-color: #E5E5E5;
}
</style>
<link href="images/textos.css" rel="stylesheet" type="text/css" />
<script>
	$(document).ready(function(){
	$(".iframe").colorbox({iframe:true,width:"900", height:"500",transition:"fade", scrolling:true, opacity:0.6});
		$(".iframe2").colorbox({iframe:true,width:"450", height:"320",transition:"fade", scrolling:false, opacity:0.1});
		$("#click").click(function(){ 
			$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
			return false;
		});
	});
</script>

			<script src="../../js/highcharts.js"></script>
<script src="../../js/highcharts-more.js"></script>
<script src="../../js/modules/exporting.js"></script>

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

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
function imprime()
{
window.open("imprime_calibracion.php?id=<? echo"$id"?>");
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
              <td><div align="center" class="text_grande style1">Calibración <?echo $nombre?> </div></td>
            </tr>
            <tr>
              <td><div align="center" class="text_mediano">(GESTIÓN DEL DESEMPEÑO)</div></td>
            </tr>
          </table>
        </div></td>
      </tr>
      <tr>
        <td><div align="right"><img src="images/spacer.gif" width="10" height="20" /><a href="grupos_calibracion.php" class="text_mediano">Grupos de Calibracion</a> </div></td>
      </tr>
      <tr>
        <td><img src="images/spacer.gif" width="10" height="10" /></td>
      </tr>
      <tr>
        <td><table width="844" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="250" valign="top" bgcolor="#eeeeee"><table width="836" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td colspan="2"><img src="images/spacer.gif" width="10" height="20" /></td>
              </tr>
              <tr>
                <td colspan="2"><span class="texto_tareas">
                  <input name="id" type="hidden" id="id" value="<?echo"$id";?>" />
                </span></td>
              </tr>
              <tr>
                <td colspan="2"><img src="images/franja.jpg" width="753" height="12" /></td>
              </tr>
              <tr>
                <td colspan="2"><img src="images/spacer.gif" width="10" height="10" /></td>
              </tr>
              <tr>
                <td width="659" valign="top"><table width="642" border="0" cellspacing="2" cellpadding="0">
                  <tr>
                    <td width="32%" bgcolor="#00475c" class="text_mediano_blanco">Nombre</td>
                    <td width="11%" bgcolor="#00475c" class="text_mediano_blanco"><div align="center">360</div></td>
					<td width="11%" bgcolor="#00475c" class="text_mediano_blanco"><div align="center">Obj Ind</div></td>
					<td width="10%" bgcolor="#00475c" class="text_mediano_blanco"><div align="center">Total<br />
					  Pond</div></td>
					<td width="10%" bgcolor="#00475c" class="text_mediano_blanco"><div align="center">Rating PMP</div></td>
                    <td width="10%" bgcolor="#00475c" class="text_mediano_blanco"><div align="center">Rating Jefe</div></td>
                    <td width="13%" bgcolor="#00475c" class="text_mediano_blanco"><div align="center">Clasification</div></td>
                    <td width="13%" bgcolor="#00475c" class="text_mediano_blanco"><div align="center">Calibration Rating </div></td>
                    </tr>
				   <? 
					  	$hay=0;
						$color="CCCCCC";
						$consulta = "SELECT usuarios.id, usuarios.nombre, planes.resultado_obj, planes.clasificacion, format(planes.resultado_360,1), planes.resultado_calibracion, planes.clasificacion_calibracion, planes.resultado_obj_final, resultado_total from usuarios inner join  grupo_empleado on usuarios.id=grupo_empleado.id_empleado inner join planes on usuarios.id=planes.id_empleado where id_grupo=$id and planes.revision=$revision order by resultado_total desc";
						$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)	
						$count=0;
						while(@mysqli_num_rows($resultado)>$count)					
						{
							$res=mysqli_fetch_row($resultado);
							$c=$res[3];//clasificacion
							$d=$res[6];//clasificaion en caliobracion
							$e=$res[2];//final rating jefe
							if($c=="3")
							{
								$c="A";
								
							}
							else
								if($c=="2")
								{
									$c="M";
							
								}
								else
								  if($c=="1")
								  {
									$c="B";
									
								  }
								  else 
								  {
								  	$c="";
									
								  }
							if($d=="3")
								$d="A";
							else
								if($d=="2")
									$d="M";
								else
								  if($d=="1")
									$d="B";
								  else 
								  	$d="";
							if($e=="4")
								$e="1";
							else
								if($e=="3")
									$e="2";
								else
								  if($e=="2")
									$e="3";
								  else 
								  	if($e=="1")
									$e="4";
							//if($res[1]=="0000-00-00" && $res[2]!="0000-00-00" && $res[3]==1)
							//{ // si no esta firmado por jefe, si esta firmado por empleado, si estaus igual 1*/
							if($res[8]<=20){$rating=1;}
							if($res[8]>20 && $res[8]<=60){$rating=2;}
							if($res[8]>60 && $res[8]<=90){$rating=3;}
							if($res[8]>90 ){$rating=4;}
						 ?>
                  <tr bgcolor="#<?echo"$color";?>">
                    <td  class="texto_tareas"><a href="resultados_360_new20.php?id=<? echo"$res[0]";?>&revision=<? echo"$revision";?>" target="_blank" class="texto_tareas"><? echo"$res[1]";?></a></td>
                    <td  class="texto_tareas"><div align="center"><a href="resultados_360.php?id=<? echo"$res[0]";?>&revision=<? echo"$revision";?>" target="_blank" class="texto_tareas"><? echo"$res[4]";?></a></div></td>
					 <td  class="texto_tareas"><div align="center"><a href="ver_obj.php?id=<? echo"$res[0]";?>&revision=<? echo"$revision";?>" class="texto_tareas iframe"><? echo"$res[7]";?></a></div></td>
					  <td  class="texto_tareas"><div align="center"><a href="ver_obj.php?id=<? echo"$res[0]";?>&amp;revision=<? echo"$revision";?>" class="texto_tareas iframe"><? echo"$res[8]";?></a></div></td>
					  <td  class="texto_tareas"><div align="center"><a href="resultados_360.php?id=<? echo"$res[0]";?>&revision=<? echo"$revision";?>" target="_blank" class="texto_tareas"><? echo"$rating";?></a></div></td>
                    <td  class="texto_tareas"><div align="center"><a href="resultados_360.php?id=<? echo"$res[0]";?>&revision=<? echo"$revision";?>" target="_blank" class="texto_tareas"><? echo"$e";?></a></div></td>
                    <td  class="texto_tareas"><div align="center"><a href="resultados_360.php?id=<? echo"$res[0]";?>&revision=<? echo"$revision";?>" target="_blank" class="texto_tareas"></a>
                      <input name="clasifi[]" type="text" class="text_grande" id="clasifi[]" value="<? echo"$c";?>" size="3" maxlength="3" />
                    </div></td>
                    <td  class="texto_tareas"><div align="center">
                      <input name="id_c[]" type="hidden" id="id_c" value="<? echo"$res[0]";?>" />
                      <input name="resultado[]" type="text" class="text_grande" id="resultado" value="<? if($res[5]=="0") echo"$e"; else {echo"$res[5]"; $hay=1;}?>" size="3" maxlength="3" />
                    </div></td>
                    </tr>
				  <?
				  if($color=="CCCCCC")
				  	$color="FFFFFF";
					else
					$color="CCCCCC";
					$count++;
				}
				  ?>
                </table>                  </td>
                <td width="177" valign="top"><div align="center">
                 <? if($estatus=="0"){?>
				  <input name="guardar" type="submit" id="guardar" value="Guardar Calibracion" />
				  <? }?>
				  <br/>
				  <br/>
               <table width="95%" border="0" cellspacing="0" cellpadding="0" class="texto_tareas" align="center">
  <tr align="center">
    <td><b>Obj Ind</b></td>
    <td><b>Rating PMP</b></td>
  </tr>
  <tr align="center">
    <td width="58%">0-20</td>
    <td width="42%">1</td>
  </tr>
  <tr align="center">
    <td>21-60</td>
    <td>2</td>
  </tr>
  <tr align="center" >
    <td>61-90</td>
    <td>3</td>
  </tr>
  <tr align="center">
    <td>91-100</td>
    <td>4</td>
  </tr>
</table>		
                </div></td>
              </tr>
              <tr>
                <td colspan="2"><img src="images/spacer.gif" width="10" height="20" /></td>
              </tr>
              <tr>
                <td colspan="2"><div id="container" style="min-width: 250px; height: 350px; margin: 0 auto"></div></td>
              </tr>
              <tr>
                <td colspan="2"><table width="92%" border="0" cellspacing="2" cellpadding="0" align="center">
                  <tr>
                    <td width="20%" bgcolor="#00475c" class="text_mediano_blanco"><div align="center">1</div></td>
                    <td width="20%" bgcolor="#00475c" class="text_mediano_blanco"><div align="center">2</div></td>
                    <td width="20%" bgcolor="#00475c" class="text_mediano_blanco"><div align="center">3</div></td>
                    <td width="20%" bgcolor="#00475c" class="text_mediano_blanco"><div align="center">4</div></td>
                    
                    <td width="20%" bgcolor="#FFFFFF" class="text_mediano"><div align="center">Rating</div></td>
                  </tr>
                  <? 
					  $consulta = "SELECT count(planes.resultado_obj) from usuarios inner join  grupo_empleado on usuarios.id=grupo_empleado.id_empleado inner join planes on usuarios.id=planes.id_empleado where id_grupo=$id and planes.revision=$revision ";
						$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );
						if(@mysqli_num_rows($resultado)>0)					
						{
							$res=mysqli_fetch_row($resultado);
							$cuantos=$res[0];
						}
						//echo $cuantos;
						if($hay=="1") // si ya se guardo calibracion una vez toma los datos de resultados_calibracion
						$consulta = "SELECT count(planes.resultado_calibracion), planes.resultado_calibracion from usuarios inner join  grupo_empleado on usuarios.id=grupo_empleado.id_empleado inner join planes on usuarios.id=planes.id_empleado where id_grupo=$id and planes.revision=$revision group by planes.resultado_calibracion";			
						else
						$consulta = "SELECT count(planes.resultado_total), planes.resultado_total from usuarios inner join  grupo_empleado on usuarios.id=grupo_empleado.id_empleado inner join planes on usuarios.id=planes.id_empleado where id_grupo=$id and planes.revision=$revision group by planes.resultado_total";
						//echo"$consulta";
						$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)	
						$count=0;
						$uno=0;
						$dos=0;
						$tres=0;
						$cuatro=0;
						
						while(@mysqli_num_rows($resultado)>$count)					
						{
							$res=mysqli_fetch_row($resultado);
							if($res[1]=="0")
								$cero=$res[0];
							else if($res[1]=="1")
									$uno=round(($res[0]/$cuantos)*100);
								else if($res[1]=="2")
									$dos=round(($res[0]/$cuantos)*100);
										else if($res[1]=="3")
									$tres=round(($res[0]/$cuantos)*100);
										else if($res[1]=="4")
									$cuatro=round(($res[0]/$cuantos)*100);
										
							$count++;
							//$temp=round(($res[0]/$cuantos)*100);
							//echo "<br>$temp ; $res[0] / $cuantos";
						}	
						 ?>
                  <tr bgcolor="#<?echo"$color";?>">
                    <td  class="texto_tareas"><div align="center"><? echo"$uno";?>%</div></td>
                    <td  class="texto_tareas"><div align="center"><? echo"$dos";?>%</div></td>
                    <td  class="texto_tareas"><div align="center"><? echo"$tres";?>%</div></td>
                    <td  class="texto_tareas"><div align="center"><? echo"$cuatro";?>%</div></td>
                   
                    <td  class="text_mediano"><div align="center">Actual%</div></td>
                  </tr>
                  <tr bgcolor="#<?echo"$color";?>">
                    <td  class="texto_tareas"><div align="center">1%</div></td>
                    <td  class="texto_tareas"><div align="center">10%</div></td>
                    <td  class="texto_tareas"><div align="center">70%</div></td>
                    <td  class="texto_tareas"><div align="center">18%</div></td>
                    
                    <td  class="text_mediano"><div align="center">Target%</div></td>
                  </tr>
                </table>
                  <p>&nbsp;</p>
                  <p align="center">
				  <? if($estatus=="0"){?>
                    <input name="cerrar" type="submit" id="cerrar" value="Cerrar Calibracion" />
					<? }else{?>
					<input name="imprimir" type="button" id="imprimir" value="Imprimir" onclick="imprime();"/>
					<? }?>
                  </p></td>
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
</table>
<script>
$(function () {
    $('#container').highcharts({
        title: {
            text: 'Results PMP',
            x: -20 //center
        },
        subtitle: {
            text: 'Calibration',
            x: -20
        },
        xAxis: {
            categories: ['1', '2', '3', '4']
        },
        yAxis: {
            title: {
                text: 'Empleados'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: ''
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Dep%',
            data: [<? echo"$uno";?>, <? echo"$dos";?>, <? echo"$tres";?>, <? echo"$cuatro";?>]
        }, {
            name: 'Target%',
            data: [1, 10, 70, 18]
        }]
    });
});
</script>
</form>
</body>
</html>
