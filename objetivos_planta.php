<?
session_start();

include "checar_sesion_admin.php";
include "coneccion_i.php";
$idU=$_SESSION['idU'];

$revision=$_GET['revision'];


if( isset($_POST['guardar']) || isset($_POST['firmar']) ) {

		$consulta2  = "SELECT * from lags order by id";
		$resultado2 = mysqli_query($enlace,$consulta2) or die("La consulta fall&oacute;P1: $consulta2 ". mysqli_error($enlace) );//. mysqli_error($enlace)	
		while($res2=mysqli_fetch_assoc($resultado2))
		{
		$id_l=$res2['id'];
		$query = "UPDATE lags SET calif='{$_POST["calif_$id_l"]}' WHERE id=$id_l";
    	$result = mysqli_query($enlace,$query) or print("$query");
		
		}
		$mensaje="guardada";	
	if(isset($_POST['firmar'])){
	
		$query2 = "UPDATE io_principies SET fecha_firma=now() WHERE revision = $revision";
    	$result2 = mysqli_query($enlace,$query2) or print("$query2");
		$mensaje="firmada";
	}
	echo"<script>alert(\"La revisión ha sido $mensaje\");</script>";
	echo"<script>window.location=\"objetivos_planta.php?revision=$revision\"</script>";
	
}

if($revision!=""){
$consulta99  = "SELECT * from io_principies where revision=$revision order by id";
$resultado99 = mysqli_query($enlace,$consulta99) or die("La consulta fall&oacute;P1: $consulta99 ". mysqli_error($enlace) );//. mysqli_error($enlace)	
$res99= mysqli_fetch_assoc($resultado99);
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
.texto_rojo {
	color: #F00;
}
.texto_verde {
	color: #060;
}
.texto_azul {
	color: #009;
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


function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function guardar()
{
    var element = document.createElement('input');
    element.name = 'guardar';
    element.value = 1;
    document.form1.appendChild(element);
    document.form1.submit();
}

function firmar()
{
    var element = document.createElement('input');
    element.name = 'firmar';
    element.value = 1;
    document.form1.appendChild(element);
    document.form1.submit();
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
</head>
<body>
<!---->
<form method="post" name="form1" action="">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
   <?include_once("header.php");?>
  </tr>
  <tr>
    <td height="698" valign="top" background="images/bkg_fondo_2.jpg"><table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><div align="right"><a href="menu<? if($debug) echo 2;?>.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image30','','images/b_inicio_r.png',1)"><img src="images/b_inicio.png" name="Image30" width="58" height="23" border="0" id="Image30" /></a><a href="menu.php" class="boton"></a><img src="images/spacer.gif" width="56" height="19" /></div></td>
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
                      <td width="477" class="tit_1">&nbsp;</td>
                      <td colspan="4" rowspan="4" valign="top"><img src="images/logo_marca_agua.jpg" width="278" height="59" /></td>
                      </tr>
                    <tr>
                      <td class="tit_1">Revisión <select name="revision" id="revision" class="texto_tareas" onchange="MM_jumpMenu('parent',this,0)">
					  		
							<option value="objetivos_planta.php">--Seleccionar--</option>
							<?
							$consulta3  = "SELECT revision from io_principies group by revision";
							$resultado3 = mysqli_query($enlace,$consulta3) or die("La consulta fall&oacute;P1: $consulta3 ". mysqli_error($enlace) );//. mysqli_error($enlace)	
							while($res3=mysqli_fetch_assoc($resultado3))
							{
							?>
                          <option value="objetivos_planta.php?revision=<? echo $res3['revision']?>" <? echo $_GET['revision']==$res3['revision']?"selected":""; ?>><? echo $res3['revision']?></option>
						  <? }?>
                        </select></td>
                      </tr>
                    <tr>
                      <td class="tit_1">&nbsp;</td>
                      </tr>
                    <tr>
                      <td class="tit_1">&nbsp;</td>
                      </tr>
                  </table></td>
              </tr>
              <tr>
                <td><img src="images/spacer.gif" width="10" height="20" /></td>
              </tr>
              

            </table>
			<?
				if($revision!=""){
				$consulta  = "SELECT * from io_principies where revision=$revision order by id";
				$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: $consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)	
				$count=1;
				while($res= mysqli_fetch_assoc($resultado))
				{	
		
			?>
              <table width="753" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td><img src="images/spacer.gif" width="10" height="20" /></td>
                </tr>
                <tr>
                  <td><table width="753" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="700" valign="top"><table width="700" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td><table width="350" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="410"><table width="410" border="0" cellspacing="2" cellpadding="0">
                                        <tr>
                                          <td height="20" bgcolor="#ced0d1" class="usuario"><img src="images/spacer.gif" width="10" height="10" /><? echo $count?>. <? echo $res['nombre']?></td>
                                        </tr>
                                    </table></td>
                                  </tr>
                                 
                              </table></td>
                            </tr>
							<?
								$consulta2  = "SELECT * from lags where id_io={$res['id']} order by id";
								$resultado2 = mysqli_query($enlace,$consulta2) or die("La consulta fall&oacute;P1: $consulta2 ". mysqli_error($enlace) );//. mysqli_error($enlace)	
									$count2=1;
									while($res2=mysqli_fetch_assoc($resultado2))
									{
								  ?>
                            <tr>
                              <td><table width="100%" border="0" cellspacing="2" cellpadding="2"  bgcolor="#FAFAFA">
  <tr>
    <td width="80%" class="texto_tareas"><b><? echo $count2?>.</b> <? echo $res2['nombre']?></td>
    <td width="20%"><select name="calif_<? echo $res2['id']?>" id="calif_<? echo $res2['id']?>" class="texto_tareas">
							<option value="0" <? if($res2['calif']=="0"){echo "selected";}?> >0</option>
							<option value="20" <? if($res2['calif']=="20"){echo "selected";}?>>20</option>
							<option value="40" <? if($res2['calif']=="40"){echo "selected";}?>>40</option>
                        </select></td>
  </tr>
</table></td>
                            </tr>
							<? $count2++; }?>
                            <tr>
                              <td><img src="images/spacer.gif" width="10" height="20" /></td>
                            </tr>
                        </table></td>
                      
                      </tr>
                  </table></td>
              </table>
			  <?
			  $count++;
			  }
			  }
			  ?><div align="center"><img src="images/spacer.gif" width="10" height="20" />
					 <? if($revision!=""){?>
					 <? if($res99['fecha_firma']==NULL) {?>
					 <a href="javascript:guardar();" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image31','','images/b_guardar_r.png',1)"><img src="images/b_guardar.png" name="Image31" width="69" height="23" border="0" id="Image31" /></a>
					 
					 <img src="images/spacer.gif" width="10" height="20" />
					  
					  <a href="javascript:firmar();" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image31','','images/b_firmar_r.png',1)"><img src="images/b_firmar.png" name="Image31" width="69" height="23" border="0" id="Image31" /></a>
					  <? } }?></div>
					  
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
