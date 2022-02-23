<?php
session_start();
date_default_timezone_set("America/Chihuahua");
setlocale(LC_TIME, 'es_MX.UTF-8');
include "checar_sesion_admin.php";
include "coneccion_i.php";
$id_usuario = $_SESSION['idU'];
$ver = $_POST['verobjetivos'];
if($ver=="")
	$ver=$id_usuario;
$mes = date("n");
//echo" ver = $ver";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?
$consulta_etapa = "SELECT revision, etapa from etapa where id=1";
$resultado_etapa = mysqli_query($enlace,$consulta_etapa) or die("La consulta 1 fall&oacute;P1:$consulta_etapa" . mysqli_error($enlace));
if (@mysqli_num_rows($resultado_etapa) >= 1) {
    $res_etapa = mysqli_fetch_row($resultado_etapa);
    if ($_GET['revision'] == '') {
        $revision = $res_etapa[0];
    } else {
        $revision = $_GET['revision'];
    }
    $etapa = $res_etapa[1];
}

$consulta_datos = "SELECT nombre, puesto, DATE_FORMAT(fecha_contratacion,'%d-%m-%Y'), DATEDIFF( NOW() , fecha_contratacion ), id_jefe,email from usuarios where id=$ver";
$resultado_datos = mysqli_query($enlace,$consulta_datos) or die("La consulta 2 fall&oacute;P1:$consulta_datos  " . mysqli_error($enlace));
if (@mysqli_num_rows($resultado_datos) >= 1) {
    $res_datos = mysqli_fetch_row($resultado_datos);
    $nombre = $res_datos[0];
    $puesto = $res_datos[1];
    $jefe = $res_datos[4];
    $contratacion = $res_datos[2];
    $tiempo = round($res_datos[3] / 364, 0);
	$EmailTo=$res_datos[5];
}

if( $jefe==$id_usuario)
{
	$jefeentra=$id_usuario;
	$id_usuario=$ver;
}

$consulta_nombre = "SELECT nombre, email from usuarios where id=$jefe";
$resultado_nombre = mysqli_query($enlace,$consulta_nombre) or die("La consulta 3 fall&oacute;P1:$consulta_nombre  " . mysqli_error($enlace)); //. mysqli_error($enlace)
if (@mysqli_num_rows($resultado_nombre) >= 1) {
    $res_nombre = mysqli_fetch_row($resultado_nombre);
    $manager = $res_nombre[0];
	$EmailTo2=$res_nombre[1];
}

if ($_POST['guardar'] == "." || $_POST['guardar2'] == "1"  || $_POST['guardar2'] == "2"  || $_POST['guardar2'] == "3"  || $_POST['guardar2'] == "4") {
    $consulta_plan_desarrollo = "SELECT * from plan_desarrollo where id_usuario=$id_usuario and revision=$revision";
    $resultado_plan_desarrollo = mysqli_query($enlace,$consulta_plan_desarrollo) or die("La consulta 4 fall&oacute;P1:$consulta_plan_desarrollo" . mysqli_error($enlace));
    if (@mysqli_num_rows($resultado_plan_desarrollo) >= 1) {
        $actualiza_plan_desarrollo = "update plan_desarrollo set goal='" . $_POST['goal'] . "', competency='" . $_POST['competency'] . "', competency2='" . $_POST['competency2'] . "', indicator='" . $_POST['indicator'] . "', otro='" . $_POST['otro'] . "', otro2='" . $_POST['otro2'] . "', a70='" . $_POST['a70'] . "',a20='" . $_POST['a20'] . "',a10='" . $_POST['a10'] . "',av70='" . $_POST['av70'] . "',av20='" . $_POST['av20'] . "',av10='" . $_POST['av10'] . "' where id_usuario=$id_usuario and revision=$revision ";
        $resultado_actualiza_plan_desarrollo = mysqli_query($enlace,$actualiza_plan_desarrollo) or die("La consulta 5 fall&oacute;P1:$actualiza_plan_desarrollo" . mysqli_error($enlace));
       
	} else {
        $insert_plan_desarrollo = "insert into plan_desarrollo  (id_usuario, revision, goal, indicator, competency, competency2, otro, otro2, firma_e, firma_j, firma_e_fin, firma_j_fin,a70,a20,a10,av70,av20,av10) values($id_usuario, $revision, '" . $_POST['goal'] . "', '" . $_POST['indicator'] . "', '" . $_POST['competency'] . "', '', '" . $_POST['otro'] . "', '" . $_POST['otro2'] . "','0000-00-00','0000-00-00','0000-00-00','0000-00-00','" . $_POST['a70'] . "','" . $_POST['a20'] . "','" . $_POST['a10'] . "','" . $_POST['av70'] . "','" . $_POST['av20'] . "','" . $_POST['av10'] . "')";
        $resultado_insert_plan_desarrollo = mysqli_query($enlace,$insert_plan_desarrollo) or die("La consulta 6 fall&oacute;P1:$insert_plan_desarrollo" . mysqli_error($enlace));
        
    }
}
echo $_POST['guardar2'];
if ($_POST['guardar2'] == "1"  ) {

 		$actualiza_plan_desarrollo = "update plan_desarrollo set  firma_e=now() where id_usuario=$id_usuario and revision=$revision ";
        $resultado_actualiza_plan_desarrollo = mysqli_query($enlace,$actualiza_plan_desarrollo) or die("La consulta 5 fall&oacute;P1:$actualiza_plan_desarrollo" . mysqli_error($enlace));
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
			<td><div align=\"center\" class=\"text_grande\">Plan Individual de Desempeño </div></td>
		  </tr>
		  <tr>
			<td><p>&nbsp;</p>
			  <p>Tu colaborador $nombre ha firmado su plan de desarrollo.</p>
			  <p>Te invitamos a entrar a la plataforma para validarla, en la sección de tareas pendientes encontraras una liga &quot; Revisar Plan de Desarrollo Individual de $nombre </p>
			  <p align=\"center\"><a href=\"http://www.tim-pmp.com\" class=\"boton style1\">http:///www.tim-pmp.com</a></p>
			<p align=\"left\">Es importante completar el proceso de revisión para no tener problemas en futuras etapas</p>
			<p align=\"left\">. </p></td>
		  </tr>
		  <tr>
			<td class=\"texto_chico\"><div align=\"center\">Este correo electronico fue generado automaticamente y no requiere ser contestado, para cualquier duda acudir al departamento de Recursos Humanos  </div></td>
		  </tr>
		</table>
		</body>
		</html>";
		$Subject = "TIM-PMP - Plan de Desarrollo Individual de $nombre";
//$EmailTo="mgarciavarela@gmail.com";
		$success2 = mail($EmailTo, $Subject, $Body, "From: TIM-PMP <$EmailFrom>\nContent-type: text/html; charset=utf-8\n");
		echo"<script>alert(\"Plan Firmado\");</script>";
		
}

if ($_POST['guardar2'] == "2"  ) {
 		$actualiza_plan_desarrollo = "update plan_desarrollo set  firma_j=now() where id_usuario=$id_usuario and revision=$revision ";
        $resultado_actualiza_plan_desarrollo = mysqli_query($enlace,$actualiza_plan_desarrollo) or die("La consulta 5 fall&oacute;P1:$actualiza_plan_desarrollo" . mysqli_error($enlace));
		echo"<script>alert(\"Plan Firmado\");</script>";
}
if ($_POST['guardar2'] == "3"  ) {
 		$actualiza_plan_desarrollo = "update plan_desarrollo set  firma_e_fin=now() where id_usuario=$id_usuario and revision=$revision ";
        $resultado_actualiza_plan_desarrollo = mysqli_query($enlace,$actualiza_plan_desarrollo) or die("La consulta 5 fall&oacute;P1:$actualiza_plan_desarrollo" . mysqli_error($enlace));
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
			<td><div align=\"center\" class=\"text_grande\">Plan Individual de Desempeño </div></td>
		  </tr>
		  <tr>
			<td><p>&nbsp;</p>
			  <p>Tu colaborador $nombre ha firmado su plan de desarrollo.</p>
			  <p>Te invitamos a entrar a la plataforma para validarla, en la sección de tareas pendientes encontraras una liga &quot; Revisar Plan de Desarrollo Individual de $nombre </p>
			  <p align=\"center\"><a href=\"http://www.tim-pmp.com\" class=\"boton style1\">http:///www.tim-pmp.com</a></p>
			<p align=\"left\">Es importante completar el proceso de revisión para no tener problemas en futuras etapas</p>
			<p align=\"left\">. </p></td>
		  </tr>
		  <tr>
			<td class=\"texto_chico\"><div align=\"center\">Este correo electronico fue generado automaticamente y no requiere ser contestado, para cualquier duda acudir al departamento de Recursos Humanos  </div></td>
		  </tr>
		</table>
		</body>
		</html>";
		$Subject = "TIM-PMP - Plan de Desarrollo Individual de $nombre";

		$success2 = mail($EmailTo, $Subject, $Body, "From: TIM-PMP <$EmailFrom>\nContent-type: text/html; charset=utf-8\n");
		echo"<script>alert(\"Plan Firmado\");</script>";
}

if ($_POST['guardar2'] == "4"  ) {
 		$actualiza_plan_desarrollo = "update plan_desarrollo set  firma_j_fin=now() where id_usuario=$id_usuario and revision=$revision ";
        $resultado_actualiza_plan_desarrollo = mysqli_query($enlace,$actualiza_plan_desarrollo) or die("La consulta 5 fall&oacute;P1:$actualiza_plan_desarrollo" . mysqli_error($enlace));
		echo"<script>alert(\"Plan Firmado\");</script>";
}

if ($_POST['guardar2'] == "5"  ) {
 		$actualiza_plan_desarrollo = "update plan_desarrollo set  firma_e='0000-00-00' where id_usuario=$ver and revision=$revision ";
        $resultado_actualiza_plan_desarrollo = mysqli_query($enlace,$actualiza_plan_desarrollo) or die("La consulta 5 fall&oacute;P1:$actualiza_plan_desarrollo" . mysqli_error($enlace));
	//echo"$actualiza_plan_desarrollo $EmailTo";
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
			<td><div align=\"center\" class=\"text_grande\">Plan Individual de Desempeño </div></td>
		  </tr>
		  <tr>
			<td><p>&nbsp;</p>
			  <p>Tu coordinador $nombre ha desfirmado su plan de desarrollo.</p>
			  <p>Te invitamos a entrar a la plataforma para modificarlo, en la sección de tareas pendientes encontraras una liga &quot; Capturar Plan de Desarrollo Individual </p>
			  <p align=\"center\"><a href=\"http://www.tim-pmp.com\" class=\"boton style1\">http:///www.tim-pmp.com</a></p>
			<p align=\"left\">Es importante completar el proceso  para no tener problemas en futuras etapas</p>
			<p align=\"left\">. </p></td>
		  </tr>
		  <tr>
			<td class=\"texto_chico\"><div align=\"center\">Este correo electronico fue generado automaticamente y no requiere ser contestado, para cualquier duda acudir al departamento de Recursos Humanos  </div></td>
		  </tr>
		</table>
		</body>
		</html>";
		$Subject = "TIM-PMP - Plan de Desarrollo Individual Desfirmado";

		$success2 = mail($EmailTo, $Subject, $Body, "From: TIM-PMP <$EmailFrom>\nContent-type: text/html; charset=utf-8\n");
		echo"<script>alert(\"Plan desfirmado\");</script>";
}



$consulta = "SELECT * from plan_desarrollo where id_usuario=$id_usuario and revision=$revision";
$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta  " . mysqli_error($enlace)); //. mysqli_error($enlace)
$res = mysqli_fetch_assoc($resultado);

if ($revision <= 2019) {
    if ($res['competency'] != "") {
        $consulta2 = "SELECT * from competencias where id={$res['competency']}";
        $resultado2 = mysqli_query($enlace,$consulta2) or die("La consulta fall&oacute;P1:$consulta2  " . mysqli_error($enlace)); //. mysqli_error($enlace)
        $res2 = mysqli_fetch_assoc($resultado2);
    }
    if ($res['competency2'] != "") {
        $consulta3 = "SELECT * from competencias where id={$res['competency2']}";
        $resultado3 = mysqli_query($enlace,$consulta3) or die("La consulta fall&oacute;P1:$consulta3  " . mysqli_error($enlace)); //. mysqli_error($enlace)
        $res3 = mysqli_fetch_assoc($resultado3);
    }
} else {
    if ($res['competency'] != "") {
        $consulta2 = "SELECT * from new_competencias where id={$res['competency']}";
        $resultado2 = mysqli_query($enlace,$consulta2) or die("La consulta fall&oacute;P1:$consulta2  " . mysqli_error($enlace)); //. mysqli_error($enlace)
        $res2 = mysqli_fetch_assoc($resultado2);
    }
    if ($res['competency2'] != "") {
        $consulta3 = "SELECT * from new_competencias where id={$res['competency2']}";
        $resultado3 = mysqli_query($enlace,$consulta3) or die("La consulta fall&oacute;P1:$consulta3  " . mysqli_error($enlace)); //. mysqli_error($enlace)
        $res3 = mysqli_fetch_assoc($resultado3);
        if ($res['competency2'] == 6) {
            $desc_competencia = $res3['e1_descripcion'];
        } else {
            $desc_competencia = $res3['c_1'] . ', ' . $res3['c_2'] . ', ' . $res3['c_3'] . ', ' . $res3['c_4'] . ', ' . $res3['c_5'];
        }
    }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bell</title>
<style type="text/css">

body {
				margin-left: 0px;
				margin-top: 0px;
				margin-right: 0px;
				margin-bottom: 0px;
				background-image: url();
				background-color: #E5E5E5;
			}
.texto_rojo {
	color: #F00;
}
.texto_verde {
	color: #060;
}
.texto_azul {
	color: #009;
}
.style3 { font-size: 24px; color: #013098}

.miboton{
width:150px;
height:23px;
background:url("images/b_guardarn.png");

}

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
		$(".iframe1").colorbox({iframe:true,width:"500", height:"320",transition:"fade", scrolling:true, opacity:0.7});
		$("#click").click(function(){
			$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
			return false;
		});
	});

	$(function() {
		$( "#fecha_term" ).datepicker({ dateFormat: 'yy-mm-dd' });
		$( "#fecha_term2" ).datepicker({ dateFormat: 'yy-mm-dd' });
		$( "#fecha_term3" ).datepicker({ dateFormat: 'yy-mm-dd' });
		$( "#fecha_term4" ).datepicker({ dateFormat: 'yy-mm-dd' });
		$( "#fecha_term5" ).datepicker({ dateFormat: 'yy-mm-dd' });
		$( "#fecha_term6" ).datepicker({ dateFormat: 'yy-mm-dd' });

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



function eliminar(id){
        if(confirm('Deseas eliminar?')){
            var elem = document.createElement('input');
            elem.name='id';
            elem.value = id;
            elem.type = 'hidden';
            $("#form3").append(elem);

            $("#form3").attr('action','elimina_accion.php');
            $("#form3").submit();
        }
    }
// submit con revision del select revision.
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function firmar_e() {
	if(validar_e())
	{
  		document.form1.guardar2.value=1;
  		document.form1.submit();
  	}
}
function firmar_j() {
	
  		document.form1.guardar2.value=2;
  		document.form1.submit();
  
}
function desfirmar_j() {
	
  		document.form1.guardar2.value=5;
  		document.form1.submit();
  
}
function firmar_e_fin() {
	if(validar_e_fin())
	{
  		document.form1.guardar2.value=3;
  		document.form1.submit();
  	}
}
function firmar_j_fin() {
	
  		document.form1.guardar2.value=4;
  		document.form1.submit();
  
}
function validar_e()
{
	if(document.form1.competency.value=="")
	{
		document.form1.competency.focus();
		alert('Seleccione Valor 1');
		return false;
	}else if(document.form1.goal.value=="")
	{
		document.form1.goal.focus();
		alert('Escriba Objetivo');
		return false;
	} else if(document.form1.a70.value=="")
	{
		document.form1.a70.focus();
		alert('Escriba Aprender Haciendo');
		return false;
	} else if(document.form1.a20.value=="")
	{
		document.form1.a20.focus();
		alert('Escriba Aprender de otros');
		return false;
	}else if(document.form1.a10.value=="")
	{
		document.form1.a10.focus();
		alert('Escriba Aprender en Aula');
		return false;
	}else if(document.form1.av70.value=="")
	{
		document.form1.av70.focus();
		alert('Escriba Avance Aprender Haciendo');
		return false;
	} else if(document.form1.av20.value=="")
	{
		document.form1.av20.focus();
		alert('Escriba Avance Aprender de otros');
		return false;
	}else if(document.form1.av10.value=="")
	{
		document.form1.av10.focus();
		alert('Escriba Avance Aprender en Aula');
		return false;
	}else
		return true;
}
function validar_e_fin()
{
	if(document.form1.competency.value=="")
	{
		document.form1.competency.focus();
		alert('Seleccione Valor 1');
		return false;
	}else if(document.form1.competency2.value=="")
	{
		document.form1.competency2.focus();
		alert('Seleccione Valor 2');
		return false;
	}else if(document.form1.goal.value=="")
	{
		document.form1.goal.focus();
		alert('Escriba Objetivo');
		return false;
	} else if(document.form1.a70.value=="")
	{
		document.form1.a70.focus();
		alert('Escriba Aprender Haciendo');
		return false;
	} else if(document.form1.a20.value=="")
	{
		document.form1.a70.focus();
		alert('Escriba Aprender de otros');
		return false;
	}else if(document.form1.a10.value=="")
	{
		document.form1.a70.focus();
		alert('Escriba Aprender en Aula');
		return false;
	}
}

//-->
</script>

</head>
<body onload="MM_preloadImages('images/b_inicio.png','images/b_firmarn_r.png','images/b_cambio_r.png','images/b_administracion_r.png','images/b_log_out_r.png')">
<!---->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td background="images/Header_bkg.png"><table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><div align="center"><a href="menu.php"><img src="images/header_logo.png" width="210" height="175" border="0" /></a></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="698" valign="top" background=""><table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><div align="right"><a href="menu.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image30','','images/b_inicio.png',1)"><img src="images/b_inicio.png" name="Image30" width="58" height="23" border="0" id="Image30" /></a><a href="menu.php" class="boton"></a><img src="images/spacer.gif" width="56" height="19" /></div></td>
      </tr>

      <tr>
        <td><table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="250" valign="top" bgcolor="#eeeeee"><table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td><img src="images/spacer.gif" width="10" height="20" /></td>
              </tr>
              <tr>
                <td><table width="900" border="0" cellspacing="3" cellpadding="0">
                    <tr>
                      <td colspan="2" align="center" class="style3">Plan Idividual de Desarrollo </td>
                    </tr>
                    <tr>
                      <td width="237" class="tit_1">Nombre: <span class="texto_tareas"><? echo $nombre?></span></td>
                      <td width="237" class="tit_1">Coordinador: <span class="texto_tareas"><? echo $manager?></span></td>
                    </tr>
                    <tr>
                      <td class="tit_1">Tiempo en la posición actual : <span class="texto_tareas"><? echo $tiempo?></span></td>
                      <td class="tit_1">Año de revisión : <span class="texto_tareas"><? echo $revision?></span></td>
                    </tr>
                    <tr>
                      <td colspan="2" class="tit_1">&nbsp;</td>
                      </tr>
                    <tr>
                      <td colspan="2" class="tit_1" align="center">
                        <table width="50%" border="0" cellspacing="0" cellpadding="0" align="center">
                          <tr>
                            <td align="center">Revision
                              <select name="revision"  class="texto_tareas" style="width:120px" id="revision" onchange="MM_jumpMenu('window',this,0)">
                          	    <option value="">--Select--</option>
                                <?
                                  $query32 = "SELECT revision FROM plan_desarrollo group by revision union select revision from etapa";
                                  $result32 = mysqli_query($enlace,$query32) or print("<option value=\"ERROR\">".mysqli_error($enlace)."</option>");
                                  while($revs = mysqli_fetch_assoc($result32)){
							                  ?>
                                    <option value="planes.php?revision=<? echo $revs['revision']?>" <? echo $revision==$revs['revision']?"selected":"";?>><? echo $revs['revision']?></option>
                                <?
                                  }
                                ?>
                              </select>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table></td>
              </tr>

            </table>

              <table width="753" border="0" align="center" cellpadding="0" cellspacing="0">

                <tr>
                  <td><img src="images/spacer.gif" width="10" height="20" /></td>
                </tr>

                <tr>
                  <td><table width="900" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="350" valign="top"><table width="900" border="0" cellspacing="0" cellpadding="0">

							<form method="post" name="form1" id="form1" action="">
							<script type="text/javascript">


             

function cambiar2(e){
  <?
    if ($revision <= 2019) {
      $consulta10  = "SELECT * from competencias where revision=$revision order by id";
      $resultado10 = mysqli_query($enlace,$consulta10) or die("La consulta fall&oacute;P1:$consulta10  ". mysqli_error($enlace) );//. mysqli_error($enlace)
      $count2=1;
      while($res10=mysqli_fetch_assoc($resultado10)){
	?>
        if(e==<? echo $res10['id']?>){
        var element = document.getElementById("celda2").style;
        //element.background = '#FF0000';
          if(e==72){
          document.getElementById('celda2').innerHTML='<b>Describe the Competency:</b> <textarea name="otro2" cols="55" rows="3" class="texto_tareas"><? echo $res['otro2']?></textarea>';
          }else{
          document.getElementById('celda2').innerHTML='<b>Description:</b> <? echo $res10['descripcion']?>';
          }
        }
  <?
        $count2++;
      }
    }else{

  ?>
      $("#celda2").load("llenardescripcion.php?id="+e);
  <?
    }
  ?>
}
						   </script>
                            <tr>
                              <td><img src="images/spacer.gif" width="10" height="20" /></td>
                            </tr>
                            <tr>
                              <td><table width="450" border="0" cellpadding="0" cellspacing="0" bgcolor="#FF3333">
                            <tr>
                              <td width="10"><img src="images/spacer.gif" width="15" height="28" /></td>
                              <td class="text_mediano_blanco">#1 Programa Istitucional.- Valores:</td>
                            </tr>
                        </table></td>
                            </tr>
                            <tr>
                              <td><img src="images/spacer.gif" width="10" height="20" /></td>
                            </tr>
                            <tr>
                              <td>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="30%" valign="top">
                                      
                                        <?
                                          
                                              $consulta123 = "SELECT * FROM new_competencias WHERE id=5";
                                              $resultado123 = mysqli_query($enlace,$consulta123) or die("$consulta123  ". mysqli_error($enlace) );
                                              $res123 = mysqli_fetch_assoc($resultado123);
                                              $descripcion = $res123['e1_descripcion'];
                                              
                                              ?>
                                                <? echo $res123['e1']?>
                                              <ul>
                                        <li><? echo $res123['c_1']?></li>
                                        <li><? echo $res123['c_2']?></li>
                                        <li><? echo $res123['c_3']?></li>
                                        <li><? echo $res123['c_4']?></li>
										<li><? echo $res123['c_5']?></li>
                                      </ul> 
                                      
                                                <input name="competency" type="hidden" id="competency" value="<? echo $res123['id']?>" />
                                                <input name="verobjetivos" type="hidden" id="verobjetivos" value="<? echo $ver?>" /></td>
                                    <td width="70%" class="texto_tareas" id="celda1">
                                                                          
                                      </td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="30%">&nbsp;</td>
                                    <td width="70%" class="texto_tareas" id="celda2">&nbsp;</td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td class="texto_tareas">&nbsp;</td>
                            </tr>
                            <tr>
                              <td><img src="images/spacer.gif" width="10" height="20" /></td>
                            </tr>
                            <tr>
                              <td><table width="450" border="0" cellspacing="0" cellpadding="0"  background="images/tit_sin_nada.jpg">
                            <tr>
                              <td width="10"><img src="images/spacer.gif" width="15" height="28" /></td>
                              <td class="text_mediano_blanco">Objetivo:</td>
                            </tr>
                        </table></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td><textarea name="goal" cols="85" rows="4" class="texto_tareas"><? echo $res['goal']?></textarea></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td><table width="450" border="0" cellspacing="0" cellpadding="0"  background="images/tit_sin_nada.jpg">
                            <tr>
                              <td width="10"><img src="images/spacer.gif" width="15" height="28" /></td>
                              <td class="text_mediano_blanco">Avances:</td>
                            </tr>
                        </table></td>
                            </tr>
                            <tr>
                              <td><img src="images/spacer.gif" width="10" height="20" /></td>
                            </tr>
                            <tr>
                              <td><textarea name="indicator" cols="85" rows="4" class="texto_tareas"><? echo $res['indicator']?></textarea></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
 <tr>
                              <td><table width="450" border="0" cellpadding="0" cellspacing="0" bgcolor="#FF3333">
                                <tr>
                                  <td width="10"><img src="images/spacer.gif" width="15" height="28" /></td>
                                  <td class="text_mediano_blanco">#2 Competencias Tecnicas </td>
                                </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td><table width="100%" border="0">
                                <tr>
                                  <td width="50%" bgcolor="#CCCCCC"><table width="90%" border="0" align="center">
                                    <tr>
                                      <td width="50%" bgcolor="#00475C"><span class="text_mediano_blanco">Aprender Haciendo- 70% :</span></td>
                                      <td width="50%">&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td colspan="2"><textarea name="a70" cols="70" rows="4" class="texto_tareas" id="a70"><? echo $res['a70']?></textarea></td>
                                      </tr>
                                  </table></td>
                                  <td width="50%"><table width="90%" border="0" align="center">
                                    <tr>
                                      <td width="50%" bgcolor="#00475C"><span class="text_mediano_blanco">Avances</span></td>
                                      <td width="50%">&nbsp;</td>
									  <td bgcolor="#00475C" class="text_mediano_blanco" >Status</td>
                                    </tr>
                                    <tr>
                                      <td colspan="2" bgcolor="#00475C"><textarea name="av70" cols="60" rows="4" class="texto_tareas" id="av70"><? echo $res['av70']?></textarea></td>
									  <td ><select name="estatus70" id="estatus70">
									    <option value="0" <? if($res['estatus70']=="0")echo "selected";?>>Abierto</option>
									    <option value="1" <? if($res['estatus70']=="1")echo "selected"?>>Cerrado</option>
									    </select>
									  </td>
                                    </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td bgcolor="#CCCCCC"><table width="90%" border="0" align="center">
                                    <tr>
                                      <td width="50%" bgcolor="#00475C"><span class="text_mediano_blanco">Aprender de Otros- 20% :</span></td>
                                      <td width="50%">&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td colspan="2"><textarea name="a20" cols="70" rows="4" class="texto_tareas" id="a20"><? echo $res['a20']?></textarea></td>
                                    </tr>
                                  </table></td>
                                  <td><table width="90%" border="0" align="center">
                                    <tr>
                                      <td width="50%" bgcolor="#00475C"><span class="text_mediano_blanco">Avances</span></td>
                                      <td width="50%">&nbsp;</td>
                                      <td bgcolor="#00475C" class="text_mediano_blanco" >Status</td>
                                    </tr>
                                    <tr>
                                      <td colspan="2" bgcolor="#00475C"><textarea name="av20" cols="60" rows="4" class="texto_tareas" id="av20"><? echo $res['av20']?></textarea></td>
                                      <td ><select name="estatus20" id="estatus20">
                                          <option value="0" <? if($res['estatus20']=="0")echo "selected";?>>Abierto</option>
                                          <option value="1" <? if($res['estatus20']=="1")echo "selected"?>>Cerrado</option>
                                        </select>
                                      </td>
                                    </tr>
                                  </table></td>
                                </tr>
                                <tr>
                                  <td bgcolor="#CCCCCC"><table width="90%" border="0" align="center">
                                    <tr>
                                      <td width="50%" bgcolor="#00475C"><span class="text_mediano_blanco">Aprender en Aula- 10% :</span></td>
                                      <td width="50%">&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td colspan="2"><textarea name="a10" cols="70" rows="4" class="texto_tareas" id="a10"><? echo $res['a10']?></textarea></td>
                                    </tr>
                                  </table></td>
                                  <td><table width="90%" border="0" align="center">
                                    <tr>
                                      <td width="50%" bgcolor="#00475C"><span class="text_mediano_blanco">Avances</span></td>
                                      <td width="50%">&nbsp;</td>
                                      <td bgcolor="#00475C" class="text_mediano_blanco" >Status</td>
                                    </tr>
                                    <tr>
                                      <td colspan="2" bgcolor="#00475C"><textarea name="av10" cols="60" rows="4" class="texto_tareas" id="av10"><? echo $res['av10']?></textarea></td>
                                      <td ><select name="estatus10" id="estatus10">
                                          <option value="0" <? if($res['estatus10']=="0")echo "selected";?>>Abierto</option>
                                          <option value="1" <? if($res['estatus10']=="1")echo "selected"?>>Cerrado</option>
                                        </select>
                                      </td>
                                    </tr>
                                  </table></td>
                                </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td align="center"><input type="submit" name="guardar" id="guardar" value="." class="miboton">
                                <input name="guardar2" type="hidden" id="guardar2" /></td>
                            </tr>
							</form>
							
                            <tr>
                              <td><img src="images/spacer.gif" width="10" height="20" /></td>
                            </tr>
                        </table></td>

                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td><table width="371" border="0" align="center">
                    <tr>
                      <td>
					  <? 
					  /// firma de empleado planeacion
					  if($res['firma_e']=="0000-00-00"){?>
					  <a href="javascript:firmar_e()" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image23','','images/b_desfirmar_r.png',1)"><img src="images/b_firmarn.png" name="Image23" width="150" height="23" border="0" id="Image23" /></a>
					  
					  <? }else  if($res['firma_e']!="0000-00-00" && $res['firma_j']=="0000-00-00" && $jefeentra!=""){?>
					  <a href="javascript:desfirmar_j()" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image23','','images/b_firmarn_r.png',1)"><img src="images/b_desfirmar.png" name="Image23" width="150" height="23" border="0" id="Image23" /></a>
					 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="javascript:firmar_j()" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image23','','images/b_firmarn_r.png',1)"><img src="images/b_firmarn.png" name="Image23" width="150" height="23" border="0" id="Image23" /></a>
					  <? }?>					  </td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><? 
					  /// firma de empleado planeacion
					  if($res['firma_e_fin']=="0000-00-00" && $res['firma_j']!="0000-00-00"){?>
                        <a href="javascript:firmar_e_fin()" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image231','','images/b_firmarn_r.png',1)"><img src="images/b_firmarn.png" name="Image231" width="150" height="23" border="0" id="Image231" /></a>
                        <? }else  if($res['firma_e_fin']!="0000-00-00" && $res['firma_j_fin']=="0000-00-00" && $jefeentra!=""){?>
                        <a href="javascript:firmar_j_fin()" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image232','','images/b_firmarn_r.png',1)"><img src="images/b_firmarn.png" name="Image232" width="150" height="23" border="0" id="Image232" /></a>
                        <? }?></td>
                      <td>&nbsp;</td>
                    </tr>
                  </table></td>
                </tr>

                <tr>
                  <td>&nbsp;</td>
                </tr>
              </table>
			  </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="images/spacer.gif" width="10" height="50" /></td>
      </tr>
      <tr>
        <td><table width="386" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="145"><a href="cambia_pass.php?id=<?echo"$id_usuario";?>" class="iframe2" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image21','','images/b_cambio_r.png',1)"><img src="images/b_cambio.png" name="Image21" width="150" height="23" border="0" id="Image21" /></a></td>
            <td><img src="images/spacer.gif" width="16" height="20" /></td>
            <td width="114">
			 <? if($_SESSION["idA"]=="1"){?>
			<a href="admin.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image24','','images/b_administracion_r.png',1)"><img src="images/b_administracion.png" name="Image24" width="150" height="23" border="0" id="Image24" /></a>
			<? }?>			</td>
            <td><img src="images/spacer.gif" width="17" height="20" /></td>
            <td><a href="logout.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image25','','images/b_log_out_r.png',1)"><img src="images/b_log_out.png" name="Image25" width="150" height="23" border="0" id="Image25" /></a></td>
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

<textarea name="av20" cols="60" rows="4" class="texto_tareas" id="av20"><? echo $res['av20']?></textarea>
</body>
</html>
