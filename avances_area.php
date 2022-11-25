<?
session_start();
include "checar_sesion_admin.php";
include "coneccion_i.php";
$idU=$_SESSION['idU'];
$id_depto=$_POST["depto"];
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
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bell</title>
<link rel="stylesheet" href="colorbox.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="colorbox/jquery.colorbox-min.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>

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
	document.form1.target="blank";
	document.form1.submit();
}
function buscar()
{
	document.form1.action="reporte_planes.php";
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
   <? include_once("header.php");?>
  </tr>
  <tr>
    <td height="698" valign="top" background=""><table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
     
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
                <td><span class="tit_1">Reporte de Avances </span><span class="texto_tareas"></span></td>
              </tr>
              <tr>
                <td><img src="images/franja.jpg" width="753" height="12" /></td>
              </tr>
              <tr>
                <td><img src="images/spacer.gif" width="10" height="10" /></td>
              </tr>
              <tr>
                <td valign="top"><div align="center">Planeación<br />
                </div>
                  <table width="785" border="0" align="center" cellpadding="0" cellspacing="3">
                    <tr>
                      <td bgcolor="#00475c">&nbsp;</td>
                      <td colspan="3" bgcolor="#00475c"><div align="center" class="text_mediano_blanco">Empleado </div></td>
                      <td colspan="3" bgcolor="#00475c"><div align="center" class="text_mediano_blanco">Supervisor</div></td>
                      <td bgcolor="#00475c">&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="152" bgcolor="#00475c"><div align="center"><span class="text_mediano_blanco">Area</span></div></td>
                      <td width="139" bgcolor="#00475c"><div align="center"><span class="text_mediano_blanco">Firmados </span></div></td>
                      <td width="69" bgcolor="#00475c"><div align="center"><span class="text_mediano_blanco">Sin Firma </span></div></td>
                      <td width="38" bgcolor="#00475c"><div align="center"><span class="text_mediano_blanco">%</span></div></td>
                      <td width="90" bgcolor="#00475c" class="text_mediano_blanco"><div align="center">Firmados</div></td>
                      <td width="90" bgcolor="#00475c" class="text_mediano_blanco"><div align="center">Sin firmar </div></td>
                      <td width="90" bgcolor="#00475c" class="text_mediano_blanco"><div align="center">%</div></td>
                      <td width="90" bgcolor="#00475c"><div align="center"><span class="text_mediano_blanco">Población Real </span></div></td>
                    </tr>
					<?	  

	$e_planeacion="";
	$d_planeacion="";
	$e_checkpoint="";
	$d_checkpoint="";	
	$consulta  = "SELECT departamentos.id, departamentos.nombre FROM departamentos inner join usuarios on departamentos.id=usuarios.id_departamento and usuarios.activo=1 and tipo<>4 and departamentos.id not in(2,4, 13) group by departamentos.nombre ORDER BY departamentos.nombre";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: " . mysqli_error($enlace));
	$count=1;
	while(@mysqli_num_rows($resultado)>=$count)
	{
		$res2=mysqli_fetch_row($resultado);
		$consulta3  = "SELECT count(usuarios.id) from  planes inner join usuarios on planes.id_empleado=usuarios.id  where id_departamento=$res2[0] and  planes.revision=$revision and planes.firma_e_i<>'0000-00-00' and usuarios.activo=1";
		$resultado3 = mysqli_query($enlace,$consulta3) or die("La consulta fall&oacute;P1: " . mysqli_error($enlace));
		if(@mysqli_num_rows($resultado3)>0)
		{
			$res3=mysqli_fetch_row($resultado3);
			$firmas=$res3[0];
		}
		$consulta3  = "SELECT count(usuarios.id) from  planes inner join usuarios on planes.id_empleado=usuarios.id  where id_departamento=$res2[0] and  planes.revision=$revision and planes.firma_j_i<>'0000-00-00' and usuarios.activo=1";
		$resultado3 = mysqli_query($enlace,$consulta3) or die("La consulta fall&oacute;P1: " . mysqli_error($enlace));
		if(@mysqli_num_rows($resultado3)>0)
		{
			$res3=mysqli_fetch_row($resultado3);
			$firmas2=$res3[0];
		}
		$consulta3  = "SELECT count(usuarios.id) from   usuarios  where id_departamento=$res2[0] and usuarios.activo=1";
		$resultado3 = mysqli_query($enlace,$consulta3) or die("La consulta fall&oacute;P1: " . mysqli_error($enlace));
		if(@mysqli_num_rows($resultado3)>0)
		{
			$res3=mysqli_fetch_row($resultado3);
			$total=$res3[0];
		}
		$sin_firma=$total-$firmas;
		$sin_firma2=$total-$firmas2;
		$por=round(($firmas*100)/$total);
		$por2=round(($firmas2*100)/$total);
		$e_planeacion.="'$res2[1]',";
		$de_planeacion.="$por,";
		$dj_planeacion.="$por2,";
		?>
                    <tr>
                      <td bgcolor="#E1E1E1" class="text_mediano"><? echo"$res2[1]";?> </td>
                      <td bgcolor="#E1E1E1" class="text_mediano"><div align="center"><? echo"$firmas";?></div></td>
                      <td bgcolor="#E1E1E1" class="text_mediano"><div align="center"><? echo"$sin_firma";?></div></td>
                      <td bgcolor="#E1E1E1" class="text_mediano"><div align="center"><? echo"$por";?>%</div></td>
                      <td bgcolor="#E1E1E1" class="text_mediano"><div align="center"><? echo"$firmas2";?></div></td>
                      <td bgcolor="#E1E1E1" class="text_mediano"><div align="center"><? echo"$sin_firma2";?></div></td>
                      <td bgcolor="#E1E1E1" class="text_mediano"><div align="center"><? echo"$por2";?>%</div></td>
                      <td bgcolor="#E1E1E1" class="text_mediano"><div align="center"><? echo"$total";?></div></td>
                    </tr>
			<?
			$count=$count+1;
	}	
			$e_planeacion=trim($e_planeacion, ',');
			$de_planeacion=trim($de_planeacion, ',');
			$dj_planeacion=trim($dj_planeacion, ',');
			?>
                  </table>
                  <p align="center"><div id="container_p" style="min-width: 500px; height: 300px; margin: 0 auto"></div></p>
                  <p align="center">Check Point </p>
                  <table width="785" border="0" align="center" cellpadding="0" cellspacing="3">
                    <tr>
                      <td bgcolor="#00475c">&nbsp;</td>
                      <td colspan="3" bgcolor="#00475c"><div align="center" class="text_mediano_blanco">Empleado </div></td>
                      <td colspan="3" bgcolor="#00475c"><div align="center" class="text_mediano_blanco">Supervisor</div></td>
                      <td bgcolor="#00475c">&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="152" bgcolor="#00475c"><div align="center"><span class="text_mediano_blanco">Area</span></div></td>
                      <td width="139" bgcolor="#00475c"><div align="center"><span class="text_mediano_blanco">Firmados </span></div></td>
                      <td width="69" bgcolor="#00475c"><div align="center"><span class="text_mediano_blanco">Sin Firma </span></div></td>
                      <td width="38" bgcolor="#00475c"><div align="center"><span class="text_mediano_blanco">%</span></div></td>
                      <td width="90" bgcolor="#00475c" class="text_mediano_blanco"><div align="center">Firmados</div></td>
                      <td width="90" bgcolor="#00475c" class="text_mediano_blanco"><div align="center">Sin firmar </div></td>
                      <td width="90" bgcolor="#00475c" class="text_mediano_blanco"><div align="center">%</div></td>
                      <td width="90" bgcolor="#00475c"><div align="center"><span class="text_mediano_blanco">Población Real </span></div></td>
                    </tr>
                    <?	  

		
	$consulta  = "SELECT departamentos.id, departamentos.nombre FROM departamentos inner join usuarios on departamentos.id=usuarios.id_departamento and usuarios.activo=1 and tipo<>4 and departamentos.id not in(2,4, 13) group by departamentos.nombre ORDER BY departamentos.nombre";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: " . mysqli_error($enlace));
	$count=1;
	while(@mysqli_num_rows($resultado)>=$count)
	{
		$res2=mysqli_fetch_row($resultado);
		$consulta3  = "SELECT count(usuarios.id) from  planes inner join usuarios on planes.id_empleado=usuarios.id  where id_departamento=$res2[0] and  planes.revision=$revision and planes.firmaUser_midYearReview<>'0000-00-00' and usuarios.activo=1";
		$resultado3 = mysqli_query($enlace,$consulta3) or die("La consulta fall&oacute;P1: " . mysqli_error($enlace));
		if(@mysqli_num_rows($resultado3)>0)
		{
			$res3=mysqli_fetch_row($resultado3);
			$firmas=$res3[0];
		}
		$consulta3  = "SELECT count(usuarios.id) from  planes inner join usuarios on planes.id_empleado=usuarios.id  where id_departamento=$res2[0] and  planes.revision=$revision and planes.firmaJefe_midYearReview<>'0000-00-00' and usuarios.activo=1";
		$resultado3 = mysqli_query($enlace,$consulta3) or die("La consulta fall&oacute;P1: " . mysqli_error($enlace));
		if(@mysqli_num_rows($resultado3)>0)
		{
			$res3=mysqli_fetch_row($resultado3);
			$firmas2=$res3[0];
		}
		$consulta3  = "SELECT count(usuarios.id) from   usuarios  where id_departamento=$res2[0] and usuarios.activo=1";
		$resultado3 = mysqli_query($enlace,$consulta3) or die("La consulta fall&oacute;P1: " . mysqli_error($enlace));
		if(@mysqli_num_rows($resultado3)>0)
		{
			$res3=mysqli_fetch_row($resultado3);
			$total=$res3[0];
		}
		$sin_firma=$total-$firmas;
		$sin_firma2=$total-$firmas2;
		$por=round(($firmas*100)/$total);
		$por2=round(($firmas2*100)/$total);
		$e_checkpointc.="'$res2[1]',";
		$de_checkpoint.="$por,";
		$dj_checkpoint.="$por2,";
		?>
                    <tr>
                      <td bgcolor="#E1E1E1" class="text_mediano"><? echo"$res2[1]";?> </td>
                      <td bgcolor="#E1E1E1" class="text_mediano"><div align="center"><? echo"$firmas";?></div></td>
                      <td bgcolor="#E1E1E1" class="text_mediano"><div align="center"><? echo"$sin_firma";?></div></td>
                      <td bgcolor="#E1E1E1" class="text_mediano"><div align="center"><? echo"$por";?>%</div></td>
                      <td bgcolor="#E1E1E1" class="text_mediano"><div align="center"><? echo"$firmas2";?></div></td>
                      <td bgcolor="#E1E1E1" class="text_mediano"><div align="center"><? echo"$sin_firma2";?></div></td>
                      <td bgcolor="#E1E1E1" class="text_mediano"><div align="center"><? echo"$por2";?>%</div></td>
                      <td bgcolor="#E1E1E1" class="text_mediano"><div align="center"><? echo"$total";?></div></td>
                    </tr>
                    <?
			$count=$count+1;
	}	
			$e_checkpoint=trim($e_checkpoint, ',');
			$de_checkpoint=trim($de_checkpoint, ',');
			$dj_checkpoint=trim($dj_checkpoint, ',');
			?>
                  </table>
                  <p><div id="container_c" style="min-width: 500px; height: 300px; margin: 0 auto"></div>
                  </p>
                  <div align="center">Encuesta 360                  </div>
                  <table width="822" border="0" align="center" cellpadding="0" cellspacing="3">
                    <tr>
                      <td bgcolor="#00475c">&nbsp;</td>
                      <td colspan="8" bgcolor="#00475c"><div align="center" class="text_mediano_blanco">Empleado </div></td>
                      <td bgcolor="#00475c">&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="139" bgcolor="#00475c"><div align="center"><span class="text_mediano_blanco">Area</span></div></td>
                      <td width="111" bgcolor="#00475c"><div align="center"><span class="text_mediano_blanco">Sin Evaluadores  </span></div></td>
                      <td width="74" bgcolor="#00475c"><div align="center"><span class="text_mediano_blanco">%</span></div></td>
                      <td width="78" bgcolor="#00475c" class="text_mediano_blanco"><div align="center">Seleccionados</div></td>
                      <td width="78" bgcolor="#00475c" class="text_mediano_blanco"><div align="center"><span class="text_mediano_blanco">%</span></div></td>
                      <td width="78" bgcolor="#00475c"><div align="center"><span class="text_mediano_blanco">Aprobados</span></div></td>
                      <td width="35" bgcolor="#00475c" class="text_mediano_blanco"><div align="center">%</div></td>
                      <td width="69" bgcolor="#00475c" class="text_mediano_blanco"><div align="center">Contestada</div></td>
                      <td width="35" bgcolor="#00475c"><div align="center"><span class="text_mediano_blanco">%</span></div></td>
                      <td width="92" bgcolor="#00475c"><div align="center"><span class="text_mediano_blanco">Población Real </span></div></td>
                    </tr>
                    <?	  

		
	$consulta  = "SELECT departamentos.id, departamentos.nombre FROM departamentos inner join usuarios on departamentos.id=usuarios.id_departamento and usuarios.activo=1 and tipo<>4 and departamentos.id not in(2,4, 13) group by departamentos.nombre ORDER BY departamentos.nombre";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: " . mysqli_error($enlace));
	$count=1;
	while(@mysqli_num_rows($resultado)>=$count)
	{
		$res2=mysqli_fetch_row($resultado);
		$consulta3  = "SELECT count(usuarios.id) from  planes inner join usuarios on planes.id_empleado=usuarios.id  where id_departamento=$res2[0] and  planes.revision=$revision and planes.estatus_360=0 and usuarios.activo=1";
		$resultado3 = mysqli_query($enlace,$consulta3) or die("La consulta fall&oacute;P1: " . mysqli_error($enlace));
		if(@mysqli_num_rows($resultado3)>0)
		{
			$res3=mysqli_fetch_row($resultado3);
			$cero=$res3[0];
		}
		$consulta3  = "SELECT count(usuarios.id) from  planes inner join usuarios on planes.id_empleado=usuarios.id  where id_departamento=$res2[0] and  planes.revision=$revision and planes.estatus_360=1 and usuarios.activo=1";
		$resultado3 = mysqli_query($enlace,$consulta3) or die("La consulta fall&oacute;P1: " . mysqli_error($enlace));
		if(@mysqli_num_rows($resultado3)>0)
		{
			$res3=mysqli_fetch_row($resultado3);
			$uno=$res3[0];
		}
		$consulta3  = "SELECT count(usuarios.id) from  planes inner join usuarios on planes.id_empleado=usuarios.id  where id_departamento=$res2[0] and  planes.revision=$revision and planes.estatus_360=2 and usuarios.activo=1";
		$resultado3 = mysqli_query($enlace,$consulta3) or die("La consulta fall&oacute;P1: " . mysqli_error($enlace));
		if(@mysqli_num_rows($resultado3)>0)
		{
			$res3=mysqli_fetch_row($resultado3);
			$dos=$res3[0];
		}
		$consulta3  = "SELECT count(usuarios.id) from  planes inner join usuarios on planes.id_empleado=usuarios.id  where id_departamento=$res2[0] and  planes.revision=$revision and planes.estatus_360=3 and usuarios.activo=1";
		$resultado3 = mysqli_query($enlace,$consulta3) or die("La consulta fall&oacute;P1: " . mysqli_error($enlace));
		if(@mysqli_num_rows($resultado3)>0)
		{
			$res3=mysqli_fetch_row($resultado3);
			$tres=$res3[0];
		}
		$consulta3  = "SELECT count(usuarios.id) from   usuarios  where id_departamento=$res2[0] and usuarios.activo=1";
		$resultado3 = mysqli_query($enlace,$consulta3) or die("La consulta fall&oacute;P1: " . mysqli_error($enlace));
		if(@mysqli_num_rows($resultado3)>0)
		{
			$res3=mysqli_fetch_row($resultado3);
			$total=$res3[0];
		}
		$p_cero=$total-$cero;
		$p_uno=$total-$uno;
		$p_dos=$total-$dos;
		$p_tres=$total-$tres;
		$por0=round(($cero*100)/$total);
		$por=round(($uno*100)/$total);
		$por2=round(($dos*100)/$total);
		$por3=round(($tres*100)/$total);
		$e_checkpointd.="'$res2[1]',";
		$de_360.="$por,";
		$dj_360.="$por2,";
		$dt_360.="$por3,";
		
		?>
                    <tr>
                      <td bgcolor="#E1E1E1" class="text_mediano"><? echo"$res2[1]";?> </td>
                      <td bgcolor="#E1E1E1" class="text_mediano"><div align="center"><? echo"$cero";?></div></td>
                      <td bgcolor="#E1E1E1" class="text_mediano"><div align="center"><? echo"$por0";?>%</div></td>
                      <td bgcolor="#E1E1E1" class="text_mediano"><div align="center"><? echo"$uno";?></div></td>
                      <td bgcolor="#E1E1E1" class="text_mediano"><div align="center"><? echo"$por";?>%</div></td>
                      <td bgcolor="#E1E1E1" class="text_mediano"><div align="center"><? echo"$dos";?></div></td>
                      <td bgcolor="#E1E1E1" class="text_mediano"><div align="center"><? echo"$por2";?>%</div></td>
                      <td bgcolor="#E1E1E1" class="text_mediano"><div align="center"><? echo"$tres";?></div></td>
                      <td bgcolor="#E1E1E1" class="text_mediano"><div align="center"><? echo"$por3";?>%</div></td>
                      <td bgcolor="#E1E1E1" class="text_mediano"><div align="center"><? echo"$total";?></div></td>
                    </tr>
                    <?
			$count=$count+1;
	}	
			$e_checkpoint=trim($e_checkpoint, ',');
			$de_checkpoint=trim($de_checkpoint, ',');
			$dj_checkpoint=trim($dj_checkpoint, ',');
			$dt_checkpoint=trim($dt_checkpoint, ',');
			?>
                  </table>
                  <div  id="container_d" style="min-width: 500px; height: 300px; margin: 0 auto"></div>
                  <p>&nbsp;</p>
				   <div align="center">Cierre de Objetivos                </div>
                   <table width="785" border="0" align="center" cellpadding="0" cellspacing="3">
                     <tr>
                       <td bgcolor="#00475c">&nbsp;</td>
                       <td colspan="3" bgcolor="#00475c"><div align="center" class="text_mediano_blanco">Empleado </div></td>
                       <td colspan="3" bgcolor="#00475c"><div align="center" class="text_mediano_blanco">Supervisor</div></td>
                       <td bgcolor="#00475c">&nbsp;</td>
                     </tr>
                     <tr>
                       <td width="152" bgcolor="#00475c"><div align="center"><span class="text_mediano_blanco">Area</span></div></td>
                       <td width="139" bgcolor="#00475c"><div align="center"><span class="text_mediano_blanco">Firmados </span></div></td>
                       <td width="69" bgcolor="#00475c"><div align="center"><span class="text_mediano_blanco">Sin Firma </span></div></td>
                       <td width="38" bgcolor="#00475c"><div align="center"><span class="text_mediano_blanco">%</span></div></td>
                       <td width="90" bgcolor="#00475c" class="text_mediano_blanco"><div align="center">Firmados</div></td>
                       <td width="90" bgcolor="#00475c" class="text_mediano_blanco"><div align="center">Sin firmar </div></td>
                       <td width="90" bgcolor="#00475c" class="text_mediano_blanco"><div align="center">%</div></td>
                       <td width="90" bgcolor="#00475c"><div align="center"><span class="text_mediano_blanco">Población Real </span></div></td>
                     </tr>
                     <?	  

		
	$consulta  = "SELECT departamentos.id, departamentos.nombre FROM departamentos inner join usuarios on departamentos.id=usuarios.id_departamento and usuarios.activo=1 and tipo<>4 and departamentos.id not in(2,4, 13) group by departamentos.nombre ORDER BY departamentos.nombre";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: " . mysqli_error($enlace));
	$count=1;
	while(@mysqli_num_rows($resultado)>=$count)
	{
		$res2=mysqli_fetch_row($resultado);
		$consulta3  = "SELECT count(usuarios.id) from  planes inner join usuarios on planes.id_empleado=usuarios.id  where id_departamento=$res2[0] and  planes.revision=$revision and planes.firma_e_f<>'0000-00-00' and usuarios.activo=1";
		$resultado3 = mysqli_query($enlace,$consulta3) or die("La consulta fall&oacute;P1: " . mysqli_error($enlace));
		if(@mysqli_num_rows($resultado3)>0)
		{
			$res3=mysqli_fetch_row($resultado3);
			$firmas=$res3[0];
		}
		$consulta3  = "SELECT count(usuarios.id) from  planes inner join usuarios on planes.id_empleado=usuarios.id  where id_departamento=$res2[0] and  planes.revision=$revision and planes.firma_j_f<>'0000-00-00' and usuarios.activo=1";
		$resultado3 = mysqli_query($enlace,$consulta3) or die("La consulta fall&oacute;P1: " . mysqli_error($enlace));
		if(@mysqli_num_rows($resultado3)>0)
		{
			$res3=mysqli_fetch_row($resultado3);
			$firmas2=$res3[0];
		}
		$consulta3  = "SELECT count(usuarios.id) from   usuarios  where id_departamento=$res2[0] and usuarios.activo=1";
		$resultado3 = mysqli_query($enlace,$consulta3) or die("La consulta fall&oacute;P1: " . mysqli_error($enlace));
		if(@mysqli_num_rows($resultado3)>0)
		{
			$res3=mysqli_fetch_row($resultado3);
			$total=$res3[0];
		}
		$sin_firma=$total-$firmas;
		$sin_firma2=$total-$firmas2;
		$por=round(($firmas*100)/$total);
		$por2=round(($firmas2*100)/$total);
		$e_final.="'$res2[1]',";
		$de_final.="$por,";
		$dj_final.="$por2,";
		?>
                     <tr>
                       <td bgcolor="#E1E1E1" class="text_mediano"><? echo"$res2[1]";?> </td>
                       <td bgcolor="#E1E1E1" class="text_mediano"><div align="center"><? echo"$firmas";?></div></td>
                       <td bgcolor="#E1E1E1" class="text_mediano"><div align="center"><? echo"$sin_firma";?></div></td>
                       <td bgcolor="#E1E1E1" class="text_mediano"><div align="center"><? echo"$por";?>%</div></td>
                       <td bgcolor="#E1E1E1" class="text_mediano"><div align="center"><? echo"$firmas2";?></div></td>
                       <td bgcolor="#E1E1E1" class="text_mediano"><div align="center"><? echo"$sin_firma2";?></div></td>
                       <td bgcolor="#E1E1E1" class="text_mediano"><div align="center"><? echo"$por2";?>%</div></td>
                       <td bgcolor="#E1E1E1" class="text_mediano"><div align="center"><? echo"$total";?></div></td>
                     </tr>
                     <?
			$count=$count+1;
	}	
			$e_final=trim($e_final, ',');
			$de_final=trim($de_final, ',');
			$dj_final=trim($dj_final, ',');
			?>
                   </table>
                   <div  id="container_e" style="min-width: 500px; height: 300px; margin: 0 auto"></div>
                  <p>&nbsp;</p></td>
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
      <? include_once("footer.php");?>
      </tr>
    </table></td>
  </tr>
</table>

</form>
<script>
$(function () {
        $('#container_p').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Reporte de Planeación'
            },
            subtitle: {
                text: 'Revisión: <? echo"$revision";?>'
            },
            xAxis: {
                categories: [
                    <? echo"$e_planeacion";?>
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Rainfall (mm)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Empleado',
                data: [<? echo"$de_planeacion";?>]
    
            }, {
                name: 'Jefe',
                data: [<? echo"$dj_planeacion";?>]
    
            }]
        });
   
	 $('#container_c').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Reporte de Checkpoint'
            },
            subtitle: {
                text: 'Revisión: <? echo"$revision";?>'
            },
            xAxis: {
                categories: [
                    <? echo"$e_checkpointc";?>
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Rainfall (mm)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Empleado',
                data: [<? echo"$de_checkpoint";?>]
    
            }, {
                name: 'Jefe',
                data: [<? echo"$dj_checkpoint";?>]
    
            }]
        });
		
	 $('#container_d').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Reporte de 360'
            },
            subtitle: {
                text: 'Revisión: <? echo"$revision";?>'
            },
            xAxis: {
                categories: [
                    <? echo"$e_checkpointd";?>
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Rainfall (mm)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Seleccion',
                data: [<? echo"$de_360";?>]
    
            }, {
                name: 'Aprobacion',
                data: [<? echo"$dj_360";?>]
    
            }, {
                name: 'Encuesta',
                data: [<? echo"$dt_360";?>]
    
            }]
        });
		$('#container_e').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Reporte de Cierre de Objetivos'
            },
            subtitle: {
                text: 'Revisión: <? echo"$revision";?>'
            },
            xAxis: {
                categories: [
                    <? echo"$e_final";?>
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Rainfall (mm)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Empleado',
                data: [<? echo"$de_final";?>]
    
            }, {
                name: 'Jefe',
                data: [<? echo"$dj_final";?>]
    
            }]
        });
    });

</script>
</body>
</html>
