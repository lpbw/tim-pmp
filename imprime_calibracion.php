<?
session_start();
include "checar_sesion_admin.php";
include "coneccion_i.php";
$idU=$_SESSION['idU'];
$id=$_GET["id"];


	$consulta  = "SELECT revision, nombre, estatus from grupos_calibracion where id=$id";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_row($resultado);
		$revision=$res[0];
		$nombre=$res[1];
		$estatus=$res[2];
	}

if($_POST["guardar"]=="Guardar Calibracion")
{
	$id=$_POST["id"];
 $id_c = $_POST["id_c"];
 $resulta = $_POST["resultado"];
 $contador=0;
 if (sizeof($id_c) > 0)
   foreach ($id_c as $na) {
   		$consulta = "update planes set  resultado_calibracion=$resulta[$contador] where id_empleado=$na and revision=$revision";
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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
			<script src="../../js/highcharts.js"></script>
<script src="../../js/highcharts-more.js"></script>
<script src="../../js/modules/exporting.js"></script>

<script type="text/javascript">
<!--



function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
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

<body>
<form id="form1" name="form1" method="post" action="">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td ><table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><img src="images/header_1.jpg" width="900" height="107" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="698" valign="top" ><table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
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
        <td><div align="right"><img src="images/spacer.gif" width="10" height="20" /><a href="grupos_calibracion.php" class="text_mediano"></a> </div></td>
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
                <td width="659" valign="top"><table width="556" border="0" cellspacing="2" cellpadding="0">
                  <tr>
                    <td width="40%" bgcolor="#00475c" class="text_mediano_blanco">Nombre</td>
                    <td width="15%" bgcolor="#00475c" class="text_mediano_blanco"><div align="center">360</div></td>
                    <td width="15%" bgcolor="#00475c" class="text_mediano_blanco"><div align="center">Rating</div></td>
                    <td width="15%" bgcolor="#00475c" class="text_mediano_blanco"><div align="center">Clasification</div></td>
                    <td width="15%" bgcolor="#00475c" class="text_mediano_blanco"><div align="center">Calibration</div></td>
                  </tr>
				   <? 
					  	$hay=0;
						$color="CCCCCC";
						$consulta = "SELECT usuarios.id, usuarios.nombre, planes.resultado_obj, planes.clasificacion, planes.resultado_360, planes.resultado_calibracion from usuarios inner join  grupo_empleado on usuarios.id=grupo_empleado.id_empleado inner join planes on usuarios.id=planes.id_empleado where id_grupo=$id and planes.revision=$revision order by planes.resultado_obj desc, planes.clasificacion desc, planes.resultado_360 desc";
						$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)	
						$count=0;
						while(@mysqli_num_rows($resultado)>$count)					
						{
							$res=mysqli_fetch_row($resultado);
							$c=$res[3];
							if($c=="3")
								$c="A";
							else
								if($c=="2")
									$c="M";
								else
									$c="B";
							//if($res[1]=="0000-00-00" && $res[2]!="0000-00-00" && $res[3]==1)
							//{ // si no esta firmado por jefe, si esta firmado por empleado, si estaus igual 1*/
						 ?>
                  <tr bgcolor="#<?echo"$color";?>">
                    <td  class="texto_tareas"><a href="resultados_360.php?id=<? echo"$res[0]";?>&revision=<? echo"$revision";?>" target="_blank" class="texto_tareas"><?echo"$res[1]";?></a></td>
                    <td  class="texto_tareas"><div align="center"><a href="resultados_360.php?id=<? echo"$res[0]";?>&revision=<? echo"$revision";?>" target="_blank" class="texto_tareas"><?echo"$res[4]";?></a></div></td>
                    <td  class="texto_tareas"><div align="center"><a href="resultados_360.php?id=<? echo"$res[0]";?>&revision=<? echo"$revision";?>" target="_blank" class="texto_tareas"><?echo"$res[2]";?></a></div></td>
                    <td  class="texto_tareas"><div align="center"><a href="resultados_360.php?id=<? echo"$res[0]";?>&revision=<? echo"$revision";?>" target="_blank" class="texto_tareas"><?echo"$c";?></a></div></td>
                    <td  class="texto_tareas"><div align="center">
                      <input name="id_c[]" type="hidden" id="id_c" value="<? echo"$res[0]";?>" />
                      <? echo"$res[5]";?>
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
                <td width="177" valign="top"><div align="center"></div></td>
              </tr>
              <tr>
                <td colspan="2"><img src="images/spacer.gif" width="10" height="20" /></td>
              </tr>
              <tr>
                <td colspan="2"><div id="container" style="min-width: 250px; height: 350px; margin: 0 auto"></div></td>
              </tr>
              <tr>
                <td colspan="2"><table width="92%" border="0" cellspacing="2" cellpadding="0">
                  <tr>
                    <td width="21%" bgcolor="#00475c" class="text_mediano_blanco"><div align="center">1</div></td>
                    <td width="20%" bgcolor="#00475c" class="text_mediano_blanco"><div align="center">2</div></td>
                    <td width="23%" bgcolor="#00475c" class="text_mediano_blanco"><div align="center">3</div></td>
                    <td width="18%" bgcolor="#00475c" class="text_mediano_blanco"><div align="center">4</div></td>
                    <td width="18%" bgcolor="#00475c" class="text_mediano_blanco"><div align="center">5</div></td>
                    <td width="18%" bgcolor="#FFFFFF" class="text_mediano"><div align="center">Rating</div></td>
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
						
						$consulta = "SELECT count(planes.resultado_calibracion), planes.resultado_calibracion from usuarios inner join  grupo_empleado on usuarios.id=grupo_empleado.id_empleado inner join planes on usuarios.id=planes.id_empleado where id_grupo=$id and planes.revision=$revision group by planes.resultado_calibracion";			
						
						$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)	
						$count=0;
						$uno=0;
						$dos=0;
						$tres=0;
						$cuatro=0;
						$cinco=0;
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
										else if($res[1]=="5")
										$cinco=round(($res[0]/$cuantos)*100);
							$count++;
							//$temp=round(($res[0]/$cuantos)*100);
							//echo "<br>$temp ; $res[0] / $cuantos";
						}	
						 ?>
                  <tr bgcolor="#<?echo"$color";?>">
                    <td  class="texto_tareas"><div align="center"><? echo"$uno";?></div></td>
                    <td  class="texto_tareas"><div align="center"><? echo"$dos";?></div></td>
                    <td  class="texto_tareas"><div align="center"><? echo"$tres";?></div></td>
                    <td  class="texto_tareas"><div align="center"><? echo"$cuatro";?></div></td>
                    <td  class="texto_tareas"><div align="center"><? echo"$cinco";?></div></td>
                    <td  class="text_mediano"><div align="center">Dep%</div></td>
                  </tr>
                  <tr bgcolor="#<?echo"$color";?>">
                    <td  class="texto_tareas"><div align="center">1%</div></td>
                    <td  class="texto_tareas"><div align="center">10%</div></td>
                    <td  class="texto_tareas"><div align="center">70%</div></td>
                    <td  class="texto_tareas"><div align="center">18%</div></td>
                    <td  class="texto_tareas"><div align="center">1%</div></td>
                    <td  class="text_mediano"><div align="center">Target%</div></td>
                  </tr>
                </table>
                  </td>
              </tr>
              <tr>
                <td colspan="2"><p>&nbsp;</p>
                  <p align="center" class="text_mediano">Conclusions</p>
                  <p align="center" class="text_mediano">&nbsp;</p>
                  <p align="center" class="text_mediano">&nbsp;</p>
                  <p align="center" class="text_mediano">&nbsp;</p>
                  <p align="center" class="text_mediano">&nbsp;</p>
                  <p align="center" class="text_mediano">&nbsp;</p>
                  <p align="center" class="text_mediano">&nbsp;</p></td>
              </tr>
              
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="images/spacer.gif" width="10" height="50" /></td>
      </tr>
    </table></td>
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
            categories: ['1', '2', '3', '4', '5']
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
            data: [<? echo"$uno";?>, <? echo"$dos";?>, <? echo"$tres";?>, <? echo"$cuatro";?>, <? echo"$cinco";?>]
        }, {
            name: 'Target%',
            data: [1, 10, 70, 18, 1]
        }]
    });
});
window.print();
</script>
</form>
</body>
</html>
