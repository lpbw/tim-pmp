<?

ini_set("display_errors", 1);
ini_set("track_errors", 1);
ini_set("html_errors", 1);
session_start();
include "checar_sesion_admin.php";
include "coneccion_i.php";
$idU=$_SESSION['idU'];
$siguiente=$_POST['siguiente'];
$inicial=$siguiente;
$v_script="";
$nombre_competencia="";
$nombre_conducta="";
$tipo="";
$grados_n[0]="1";
$grados_n[1]="3";
$grados_n[2]="5";

$consulta  = "SELECT revision, etapa, etapa_360 from etapa where id=1";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_row($resultado);
		$revision=$res[0];
		$etapa=$res[1];
		$etapa360=$res[2];
	}

if($_POST['enviar']!="")
{
	//echo"entra";
	$a_sql= $_POST['n_sql'];
	$a_tipo= $_POST['n_tipo'];
	$p_guardar= $_POST['p_guardar'];
	$evaluado_id = $_POST['evaluado_id'];
	$calif="";
	$calif2="";
	$esperado="0";
	$calculado="0";
	$v_plus="0";
	$v_esperado=0;
	$v_calculado=0;
	$pattern2 = "0.00";
	
	
			$q_BC = "select usuarios.nombre, usuarios.id from  usuarios inner join evaluadores on usuarios.id=evaluadores.id_evaluado where id_evaluador=$idU";
			$c=0;
			$resultado = mysqli_query($enlace,$q_BC) or die("Error en operacion1:$query " . mysqli_error($enlace));
			while(@mysqli_num_rows($resultado)>$c)
			{
				$res=mysqli_fetch_row($resultado);		
				//out.println("ev"+r_BC.getString("id_usuario"));
				$calif=$_POST['comen'.$res[1]];
				$sustituye = array("\r\n", "\n\r", "\n", "\r");
				$calif = str_replace($sustituye, " ", $calif);  
				$calif = str_replace("'", "\'", $calif);
				
				$calif2=$_POST['comenN'.$res[1]];
				$calif2 = str_replace($sustituye, " ", $calif2);  
				$calif2 = str_replace("'", "\'", $calif2);
				if($a_sql=="i")
					$listGStr= "insert into tex_calificaciones_preg(id_evaluado, id_evaluador, hacer, nohacer, revision) values($res[1], $idU,'$calif','$calif2', $revision)";		
				else
					$listGStr= "update tex_calificaciones_preg set hacer='$calif',nohacer='$calif2' where id_evaluado=$res[1] and id_evaluador=$idU and  revision=$revision ";
					//out.println(listGStr);	
				$resultado2 = mysqli_query($enlace,$listGStr) or die("Error en operacion1:$query " . mysqli_error($enlace));
				$c++;	
			}	
				
					$listGStr= "update planes set estatus_360=3 where id_empleado=$idU";	
					$resultado = mysqli_query($enlace,$listGStr) or die("Error en operacion1:$query " . mysqli_error($enlace));
	
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
//-->
function valida(){
	if(document.form1.evaluador.value=="")
	{
		alert("Seleccione Evaluador");
			document.form1.evaluador.focus();
			return false;
	}else
	{
		
		if(document.form1.relacion.value=="0")
		{
			alert("Seleccione relacion con el evaluador");
			document.form1.relacion.focus();
			return false;
		}else
		{
			if(document.form1.evaluador.value=="<? echo"$jefe";?>" || document.form1.evaluador.value=="<? echo"$jefe_360";?>")
			{
				alert("No se puede seleccionar a su coordinador");
				document.form1.evalaudor.focus();
				return false;
			}else
			{
			
			}
		}
	}
}
function borrar(valor){
if(confirm("Esta seguro de borrar este evaluador")){
document.form1.borrar.value=valor;
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
.style5 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000000; }
.style9 {font-size: x-large}
.style6 {font-size: 18px}
-->
</style>
</head>

<body onload="MM_preloadImages('images/b_cambio_r.png','images/b_administracion_r.png','images/b_log_out_r.png','images/icono_borrar_r.png')">
<form id="form1" name="form1" method="post" action="preguntas_360.php">
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
              <td><div align="center" class="text_grande style1">Evaluación 360°   </div></td>
            </tr>
            <tr>
              <td><div align="center" class="text_mediano"></div></td>
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
            <td height="250" valign="top" bgcolor="#eeeeee"><div align="center">
                <table width="773" border="0">
                  <tr>
                    <td width="712" class="texto_contenido">&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="texto_contenido"><div align="center">
                      <p>&nbsp;</p>
                      <p>&nbsp;</p>
                      <p>Gracias por tu tiempo, con esta evaluaci&oacute;n 
                        colaboras en el logro de los objetivos de la empresa. </p>
                    </div></td>
                  </tr>
                </table>
              </div>
              </td>
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
<script>
	  function validaP(){
	  	<? echo"$v_script";?>
	  	{

			
			return true;
	  	}
	  	else
	  	{
			alert("Debe evaluar a todos")
			return false;
	  	}
	  }
	  function validaC(){
	  	<? echo"$v_script";?>
	  	{

			
			
		form1.action="preguntas2_360.php";
			return true;
	  	}
	  	else
	  	{
			alert("Debe evaluar a todos")
			return false;
	  	}
	  }
	  </script>
</body>
</html>
