<?
session_start();
include "checar_sesion_admin.php";
include "coneccion_i.php";
$idU=$_SESSION['idU'];
$verobjetivos=$_POST["verobjetivos"];
$plan="";
$estatus="";
$firma1e="";
$firma2e="";
$firma1j="";
$firma2j="";
$impacto="";

if($_POST["desfirmar_planeacion"]=="Desfirmar Planeación"){
$revision=$_POST["revision"];
	$plan=$_POST["plan"];
	$consulta  = "update planes set  firma_e_i='0000-00-00', firma_j_i='0000-00-00', estatus='0' where id=$plan";
			//echo"$consulta <br>";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: $consulta". mysqli_error($enlace) );
	echo"<script>alert(\"Plan Desfirmado\");</script>";
}

if($_POST["guardar"]=="1" || $_POST["firma1"]=="1" || $_POST["firma2"]=="1"){

	$revision=$_POST["revision"];
	$plan=$_POST["plan"];
	$objetivo=$_POST["objetivo"];
	$descripcion=$_POST["descripcion"];
	$impacto=$_POST["impacto"];
	
	
	if($plan=="" || $plan==null)
	{
		
		$consulta  = "insert into planes(id_empleado, revision, estatus) value($verobjetivos, $revision, 0)";
		$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );
		$num=1;
		for($i=0 ; $i<6 ; $i++)
		{
			$inicio=$_POST["inicio".$num];
			$fin=$_POST["fin".$num];
			$fechat = explode('-', $inicio);
			$finicio="$fechat[2]-$fechat[1]-$fechat[0]";
			$fechat = explode('-', $fin);
			$ffin="$fechat[2]-$fechat[1]-$fechat[0]";
			$obj=addslashes($objetivo[$i]);
			$des=addslashes($descripcion[$i]);
			$imp=addslashes($impacto[$i]);
			$consulta  = "insert into objetivos(id_empleado, numero, nombre, descripcion, impacto, f_inicio, f_fin, revision) value($verobjetivos, $num, '$obj', '$des', '$imp', '$finicio', '$ffin', $revision)";
			$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: $consulta". mysqli_error($enlace) );
			$num++;
		}
	}else
	{
		//
		$num=1;
		for($i=0 ; $i<6 ; $i++)
		{
			$inicio=$_POST["inicio".$num];
			$fin=$_POST["fin".$num];
			$fechat = explode('-', $inicio);
			$finicio="$fechat[2]-$fechat[1]-$fechat[0]";
			$fechat = explode('-', $fin);
			$ffin="$fechat[2]-$fechat[1]-$fechat[0]";
			$obj=addslashes($objetivo[$i]);
			$des=addslashes($descripcion[$i]);
			$imp=addslashes($impacto[$i]);
			$consulta  = "update objetivos set  nombre='$obj', descripcion='$des', impacto='$imp', f_inicio='$finicio', f_fin='$ffin' where id_empleado=$verobjetivos and numero=$num and revision=$revision";
			//echo"$consulta <br>";
			$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: $consulta". mysqli_error($enlace) );
			$num++;
		}
	}
}

if($_POST["firma1"]=="1")
{
	$consulta  = "SELECT nombre, id_jefe from usuarios where id=$verobjetivos";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_row($resultado);
		$nombreEmpleado=$res[0];
		$jefe=$res[1];
		
	}
	$consulta  = "SELECT email from usuarios where id=$jefe";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_row($resultado);
		$EmailTo=$res[0];
		
	}
	$consulta  = "update planes set estatus=1, firma_e_i=now() where id_empleado=$verobjetivos and revision=$revision";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );
	
	$EmailFrom = "notificaciones@tim-pmp.com";

		$Body = "<html xmlns=\"http://www.w3.org/1999/xhtml\">
		<head>
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
		<title>TIM-PMP</title>
		<link href=\"http://www.tim-pmp.com/images/textos.css\" rel=\"stylesheet\" type=\"text/css\" />
		<style type=\"text/css\">
		<!--
		body {
			margin-left: 0px;
			margin-top: 0px;
		}
		.style1 {font-size: 16px}
		-->
		</style></head>
		
		<body>
		<table width=\"617\" border=\"0\" cellspacing=\"2\" cellpadding=\"0\">
		  <tr>
			<td><div align=\"center\"><img src=\"http://www.tim-pmp.com/images/header_mail.jpg\" width=\"613\" height=\"107\" /></div></td>
		  </tr>
		  <tr>
			<td><div align=\"center\" class=\"text_grande\">Gestion de Desempeño </div></td>
		  </tr>
		  <tr>
			<td><p>&nbsp;</p>
			  <p>Tu colaborador $nombreEmpleado ha firmado sus objetivos.</p>
			  <p>Te invitamos a entrar a la plataforma para validarlos, en la sección de tareas pendientes encontraras una liga &quot; Revisar Planeación de Objetivos de $nombreEmpleado </p>
			  <p align=\"center\"><a href=\"http://www.tim-pmp.com\" class=\"boton style1\">http:///www.tim-pmp.com</a></p>
			<p align=\"left\">Es importante completar el proceso de revisión para no tener problemas en futuras etapas</p>
			<p align=\"left\">. </p></td>
		  </tr>
		  <tr>
			<td class=\"texto_chico\"><div align=\"center\">Este correo electronico fue generado automaticamente y no requiere ser contestado, para cualquier duda acudir al departamento de Recursos Humanos con la Lic. Nancy Haller nhaller@bh.com </div></td>
		  </tr>
		</table>
		</body>
		</html>";
		$Subject = "TIM-PMP - Revisar Planeación de $nombreEmpleado";
		
		$success2 = mail($EmailTo, $Subject, $Body, "From: TIM-PMP <$EmailFrom>\nContent-type: text/html; charset=utf-8\n");
		
	echo"<script>alert(\"Tu planeación ha sido firmada, tu coordinador recibira un correo electronico para que proceda a revisarla\");</script>";
}
if($_POST["firma2"]=="1")
{
	$consulta  = "update planes set estatus=2, firma_j_i=now() where id_empleado=$verobjetivos and revision=$revision";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );
	echo"<script>alert(\"Planeacion Firmada\");</script>";
}


	$consulta  = "SELECT revision, etapa from etapa where id=1";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_row($resultado);
		$revision=$res[0];
		$etapa=$res[1];
	}
	$consulta  = "SELECT nombre, puesto, DATE_FORMAT(fecha_contratacion,'%d-%m-%Y'), DATEDIFF( NOW() , fecha_contratacion ), id_jefe from usuarios where id=$verobjetivos";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_row($resultado);
		$nombre=$res[0];
		$puesto=$res[1];
		$jefe=$res[4];
		$contratacion=$res[2];
		$tiempo=round($res[3]/364, 0);
	}
	$consulta  = "SELECT id, estatus, firma_e_i, firma_e_f, firma_j_i, firma_j_f from planes where id_empleado=$verobjetivos and revision=$revision";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: " . mysqli_error($enlace));//. mysqli_error($enlace)	
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
	$ver=0;
	if(($firma1e=="0000-00-00" || $plan=="") && $idU==$verobjetivos)
		$ver=1; // entra empleado con plan sin firmar o crear puede editar
	else
	{
		if($firma1e!="0000-00-00" && $idU==$verobjetivos && $firma1j=="0000-00-00")
			$ver=2; // entra empleado con plan sin firmado solo puede ver textos
		else
		{
			if($firma1e!="0000-00-00" && $firma1j=="0000-00-00" && $idU==$jefe)
				$ver=3; // entra jefe pendiente de firmar puede editar
			else
			{
				if($firma1e!="0000-00-00" && $firma1j!="0000-00-00" && $idU==$id_jefe)
					$ver=4; // entra jefe frimado solo ver
				else
				{
					$ver=0;
				}
			}
		}
	}
	//echo"$ver =$firma1e $firma1j u=$idU j=$jefe";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Textron</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url();
}
-->
</style>
<link href="images/textos.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
<link rel="stylesheet" href="colorbox.css" />
<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
<script src="colorbox/jquery.colorbox-min.js"></script>

<SCRIPT>
	$(document).ready(function(){
		$(".iframe2").colorbox({iframe:true,width:"450", height:"320",transition:"fade", scrolling:false, opacity:0.1});
		$("#click").click(function(){ 
			$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
			return false;
		});
	});
	
	$(function() {
		$( "#inicio1" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#fin1" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#inicio2" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#fin2" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#inicio3" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#fin3" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#inicio4" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#fin4" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#inicio5" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#fin5" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#inicio6" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#fin6" ).datepicker({ dateFormat: 'dd-mm-yy' });
		
	});
	</SCRIPT>
<script type="text/javascript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function validar()
{
	var numero=1;
	for(var i=0 ; i<4 ; i++)
	{
		if(document.form1.objetivo[i].value=="")
		{
			alert("No escribio Nombre del Objetivo "+numero);
			document.form1.objetivo[i].focus();
			return false;
		}else
		{
			if(document.form1.descripcion[i].value=="")
			{
				alert("No escribio Descripcion del Objetivo "+numero);
				document.form1.descripcion[i].focus();
				return false;
			}else
			{
				if(document.form1.impacto[i].value=="")
				{
					alert("No escribio Impacto del Objetivo "+numero);
					document.form1.impacto[i].focus();
					return false;
				}else
				{
					
				}
			}
		}
		numero++;
	}
	if(document.form1.inicio1.value=="" || document.form1.fin1.value=="")
	{
		alert("No escribio el rango Fecha de inicio y fin del Objetivo 1");
		document.form1.inicio1.focus();
		return false;
	}else
	{
		if(document.form1.inicio2.value=="" || document.form1.fin2.value=="")
		{
			alert("No escribio el rango Fecha de inicio y fin del Objetivo 1");
			document.form1.inicio2.focus();
			return false;
		}else
		{
			if(document.form1.inicio3.value=="" || document.form1.fin3.value=="")
			{
				alert("No escribio el rango Fecha de inicio y fin del Objetivo 3");
				document.form1.inicio3.focus();
				return false;
			}else
			{
				if(document.form1.inicio4.value=="" || document.form1.fin4.value=="")
				{
					alert("No escribio el rango Fecha de inicio y fin del Objetivo 4");
					document.form1.inicio4.focus();
					return false;
				}
			}
		}
	}
	return true;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
function guardar()
{
	document.form1.guardar.value="1";
	document.form1.submit();
}
function firmar()
{
	if(validar()==true)
	{
	document.form1.firma1.value="1";
	document.form1.submit();
	}
}
function firmarR()
{
	if(validar()==true)
	{
	document.form1.firma2.value="1";
	document.form1.submit();
	}
}
//-->
</script>
</head>

<body onload="MM_preloadImages('images/b_cambio_r.png','images/b_administracion_r.png','images/b_log_out_r.png','images/b_inicio_r.png','images/b_guardar_r.png','images/b_firmar_r.png')">
<form action="objetivos.php" method="post" name="form1">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td background="images/bkg_admin.jpg"><table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><img src="images/header_1.jpg" width="900" height="107" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="698" valign="top" background="images/bkg_fondo_2.jpg"><table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><div align="right"><a href="menu.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image30','','images/b_inicio_r.png',1)"><img src="images/b_inicio.png" name="Image30" width="58" height="23" border="0" id="Image30" /></a><a href="menu.php" class="boton"></a><img src="images/spacer.gif" width="56" height="19" /></div></td>
      </tr>
      
      <tr>
        <td><table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="250" valign="top" bgcolor="#eeeeee"><table width="753" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td><img src="images/spacer.gif" width="10" height="20" /></td>
              </tr>
              <tr>
                <td><table width="753" border="0" cellspacing="3" cellpadding="0">
                    <tr>
                      <td width="477" class="tit_1">2014 PMP for: <span class="texto_tareas"><? echo $nombre?></span></td>
                      <td colspan="4" rowspan="4" valign="top"><img src="images/logo_marca_agua.jpg" width="278" height="59" /></td>
                      </tr>
                    <tr>
                      <td class="tit_1">Position Title:<span class="texto_tareas"> <? echo $puesto?></span></td>
                      </tr>
                    <tr>
                      <td class="tit_1">Hire date: <span class="texto_tareas"><? echo $contratacion?></span></td>
                      </tr>
                    <tr>
                      <td class="tit_1">Time on this job: <span class="texto_tareas"><? echo $tiempo?> años
                        <input name="plan" type="hidden" id="plan" value="<?echo"$plan";?>" />
                        <input name="verobjetivos" type="hidden" id="verobjetivos" value="<?echo"$verobjetivos";?>" />
                        <input name="revision" type="hidden" id="revision" value="<?echo"$revision";?>" />
                        <input name="guardar" type="hidden" id="guardar" />
                      </span></td>
                      </tr>
                  </table></td>
              </tr>
              <tr>
                <td><img src="images/spacer.gif" width="10" height="20" /></td>
              </tr>
              

            </table>
			<?
			for($i=1 ; $i<=6 ; $i++)
			{
				$ob="";
				$de="";
				$inicio="";
				$fin="";
				$im="";
				$consulta  = "SELECT nombre, descripcion, DATE_FORMAT(f_inicio,'%d-%m-%Y'), DATE_FORMAT(f_fin,'%d-%m-%Y'), impacto from objetivos where id_empleado=$verobjetivos and numero=$i and revision=$revision";
				$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: ". mysqli_error($enlace) );//. mysqli_error($enlace)	
				if(@mysqli_num_rows($resultado)>=1)
				{
					$res=mysqli_fetch_row($resultado);
					$ob=stripcslashes($res[0]);
					$de=stripcslashes($res[1]);
					$inicio=$res[2];
					$fin=$res[3];
					$im=stripcslashes($res[4]);
				}
			?>
              <table width="753" border="0" align="center" cellpadding="0" cellspacing="0">

                <tr>
                  <td><img src="images/spacer.gif" width="10" height="20" /></td>
                </tr>
                <tr>
                  <td><table width="753" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="28" background="images/titulos_franjas.jpg"><table width="450" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="10"><img src="images/spacer.gif" width="15" height="28" /></td>
                              <td class="text_mediano_blanco">BUSINESS OBJECTIVE # <? echo"$i";?></td>
                            </tr>
                        </table></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td><img src="images/spacer.gif" width="10" height="20" /></td>
                </tr>
                <tr>
                  <td><table width="753" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="350" valign="top"><table width="350" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td><table width="350" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="410"><table width="250" border="0" cellspacing="2" cellpadding="0">
                                        <tr>
                                          <td height="20" bgcolor="#ced0d1" class="usuario"><img src="images/spacer.gif" width="10" height="10" />1. Name of Objective:</td>
                                        </tr>
                                    </table></td>
                                  </tr>
                                  <tr>
                                    <td><label>
									<? if($ver=="1" || $ver=="3"){?>
                                      <input name="objetivo[]" type="text" class="texto_tareas" id="objetivo" value="<?echo"$ob";?>" size="60" />
                                    <? }else{?>
									 <div align="left" class="texto_tareas"><? echo"$ob";?></div>
									 <? }?>
									</label></td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td><img src="images/spacer.gif" width="10" height="20" /></td>
                            </tr>
                            <tr>
                              <td><table width="350" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="410"><table width="250" border="0" cellspacing="2" cellpadding="0">
                                        <tr>
                                          <td height="20" bgcolor="#ced0d1" class="usuario"><img src="images/spacer.gif" width="10" height="10" />2. SMART Description:</td>
                                        </tr>
                                    </table></td>
                                  </tr>
                                  <tr>
                                    <td><label>
                                     
									  <? if($ver=="1" || $ver=="3"){?>
                                       <textarea name="descripcion[]" cols="60" rows="5" class="texto_tareas" id="descripcion"><?echo"$de";?></textarea>
                                    <? }else{?>
									 <div align="left" class="texto_tareas"><? echo"$de";?></div>
									 <? }?>
                                    </label></td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td><img src="images/spacer.gif" width="10" height="20" /></td>
                            </tr>
                            <tr>
                              <td><table width="350" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="410"><table width="330" border="0" cellspacing="2" cellpadding="0">
                                        <tr>
                                          <td height="20" bgcolor="#ced0d1" class="usuario"><img src="images/spacer.gif" width="10" height="10" />3. Textron Behaviors which impact this objective:</td>
                                        </tr>
                                    </table></td>
                                  </tr>
                                  <tr>
                                    <td><label>
                                      
									   <? if($ver=="1" || $ver=="3"){?>
                                       <textarea name="impacto[]" cols="60" rows="5" class="texto_tareas" id="impacto"><?echo"$im";?></textarea>
                                    <? }else{?>
									 <div align="left" class="texto_tareas"><? echo"$im";?></div>
									 <? }?>
                                    </label></td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td><img src="images/spacer.gif" width="10" height="20" /></td>
                            </tr>
                            <tr>
                              <td><table width="350" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="410"><table width="300" border="0" cellspacing="2" cellpadding="0">
                                        <tr>
                                          <td height="20" bgcolor="#ced0d1" class="usuario"><img src="images/spacer.gif" width="10" height="10" /> 4. Beginning Date: </td>
                                          <td width="128" class="usuario">
										  <? if($ver=="1" || $ver=="3"){?>
                                       <input name="inicio<?echo"$i";?>" type="text" class="texto_tareas" id="inicio<?echo"$i";?>" value="<?echo"$inicio";?>" size="15" readonly/>
                                    <? }else{?>
									 	<div align="left" class="texto_tareas"><? echo"$inicio";?></div>
									 <? }?>
										  </td>
                                        </tr>
                                    </table></td>
                                  </tr>
                                  <tr> </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td><img src="images/spacer.gif" width="10" height="20" /></td>
                            </tr>
                            <tr>
                              <td><table width="300" border="0" cellspacing="2" cellpadding="0">
                                  <tr>
                                    <td height="20" bgcolor="#ced0d1" class="usuario"><img src="images/spacer.gif" width="10" height="10" /> 5. Due Date:</td>
                                    <td width="128" class="usuario">
									 <? if($ver=="1" || $ver=="3"){?>
                                       <input name="fin<?echo"$i";?>" type="text" class="texto_tareas" id="fin<?echo"$i";?>" value="<?echo"$fin";?>" size="15" readonly/>
                                    <? }else{?>
									 	<div align="left" class="texto_tareas"><? echo"$fin";?></div>
									 <? }?>
									</td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td><img src="images/spacer.gif" width="10" height="20" /></td>
                            </tr>
                        </table></td>
                        <td width="53"><img src="images/spacer.gif" width="52" height="20" /></td>
                        <td width="350" valign="top">
						<!--
						<table width="350" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td><table width="350" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="410"><table width="250" border="0" cellspacing="2" cellpadding="0">
                                        <tr>
                                          <td height="20" bgcolor="#ced0d1" class="usuario"><img src="images/spacer.gif" width="10" height="10" />6. MID YEAR REVIEW:</td>
                                        </tr>
                                    </table></td>
                                  </tr>
                                  <tr>
                                    <td><label>
                                      <input name="textfield62" type="text" class="texto_tareas" id="textfield62" value="" size="40" />
                                      </label>
                                        <table width="350" border="0" cellspacing="2" cellpadding="0">
                                          <tr>
                                            <td height="20" class="texto_tareas">Rating: <span class="usuario">
                                              <input name="textfield102" type="text" class="texto_tareas" id="textfield102" value="" size="4" />
                                              </span>BT<span class="usuario">
                                              <input name="textfield112" type="text" class="texto_tareas" id="textfield112" value="" size="4" />
                                              </span><br />
                                              (BT: Behind Target / OT: On Target / C: Complete)</td>
                                          </tr>
                                      </table></td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td><img src="images/spacer.gif" width="10" height="20" /></td>
                            </tr>
                            <tr>
                              <td><table width="350" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="410"><table width="270" border="0" cellspacing="2" cellpadding="0">
                                        <tr>
                                          <td height="20" bgcolor="#ced0d1" class="usuario"><img src="images/spacer.gif" width="10" height="10" />7. ANNUAL PERFORMANCE REVIEW:</td>
                                        </tr>
                                    </table></td>
                                  </tr>
                                  <tr>
                                    <td><label>
                                        <div align="justify" class="texto_tareas">Employee Rating : <span class="usuario">
                                          <input name="textfield122" type="text" class="texto_tareas" id="textfield122" value="" size="4" />
                                          </span> (Scale of 1-5)<br />
                                          <span class="usuario">Comments:</span> Do not push managers to reach 100%. <br />
                                          The compliance was 75% TIM population.</div>
                                      </label></td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td><img src="images/spacer.gif" width="10" height="20" /></td>
                            </tr>
                            <tr>
                              <td><table width="300" border="0" cellspacing="2" cellpadding="0">
                                  <tr>
                                    <td width="266" height="20" bgcolor="#ced0d1" class="usuario"><img src="images/spacer.gif" width="10" height="10" /> Supervisor / Manager : (Scale of 1-5)</td>
                                    <td width="28" class="usuario"><input name="textfield72" type="text" class="texto_tareas" id="textfield72" value="" size="4" /></td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td><img src="images/spacer.gif" width="10" height="20" /></td>
                            </tr>
                            <tr>
                              <td><table width="350" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="410"><table width="350" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td width="410"><table width="270" border="0" cellspacing="2" cellpadding="0">
                                              <tr>
                                                <td height="20" bgcolor="#ced0d1" class="usuario"><img src="images/spacer.gif" width="10" height="10" />Comments:</td>
                                              </tr>
                                          </table></td>
                                        </tr>
                                        <tr>
                                          <td><label>
                                            <textarea name="textarea" cols="40" rows="4" class="texto_tareas" id="textarea3"></textarea>
                                          </label></td>
                                        </tr>
                                    </table></td>
                                  </tr>
                                  <tr> </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td><img src="images/spacer.gif" width="10" height="20" /></td>
                            </tr>
                        </table>
						-->						</td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>

                <tr>
                  <td><div align="center"><img src="images/spacer.gif" width="10" height="20" />
                      <? if($ver=="1" || $ver=="3"){?>
					  <a href="javascript:guardar();" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image31<?echo"$i";?>','','images/b_guardar_r.png',1)"><img src="images/b_guardar.png" name="Image31<?echo"$i";?>" width="69" height="23" border="0" id="Image31<?echo"$i";?>" /></a><? }?>
                  </div></td>
                </tr>
              </table>
			  <?
			  }
			  ?>
			  
              <p align="center">
			   <? if($ver=="1" ){?>
                <a href="javascript:firmar();" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image32','','images/b_firmar_r.png',1)"><img src="images/b_firmar.png" name="Image32" width="61" height="23" border="0" id="Image32" /></a>
                <input name="firma1" type="hidden" id="firma1" />
                <? }?>
				<? if($ver=="3" ){?>
                <a href="javascript:firmarR();" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image321','','images/b_firmar_r.png',1)"><img src="images/b_firmar.png" name="Image321" width="61" height="23" border="0" id="Image321" /></a>
                <input name="firma2" type="hidden" id="firma2" />
                <? }?>
              </p>
			  <? if($_SESSION["idA"]=="1" && $firma1e!="0000-00-00"){?>
              <p align="center">
                <input name="desfirmar_planeacion" type="submit" id="desfirmar_planeacion" value="Desfirmar Planeación" />
              </p>
			  <? }?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="images/spacer.gif" width="10" height="50" /></td>
      </tr>
      <tr>
        <td><table width="386" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="145"><a href="cambia_pass.php?id=<?echo"$idU";?>" class="iframe2" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image21','','images/b_cambio_r.png',1)"><img src="images/b_cambio.png" name="Image21" width="145" height="23" border="0" id="Image21" /></a></td>
            <td><img src="images/spacer.gif" width="16" height="20" /></td>
            <td width="114">
			 <? if($_SESSION["idA"]=="1"){?>
			<a href="admin.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image24','','images/b_administracion_r.png',1)"><img src="images/b_administracion.png" name="Image24" width="114" height="23" border="0" id="Image24" /></a>
			<? }?>			</td>
            <td><img src="images/spacer.gif" width="17" height="20" /></td>
            <td><a href="logout.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image25','','images/b_log_out_r.png',1)"><img src="images/b_log_out.png" name="Image25" width="71" height="23" border="0" id="Image25" /></a></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="images/spacer.gif" width="10" height="20" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="17" valign="top" background="images/bkg_azul.jpg"><img src="images/spacer.gif" width="10" height="17" /></td>
  </tr>
</table>
</form>
</body>
</html>
