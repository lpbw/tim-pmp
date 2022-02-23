<?
session_start();

include "checar_sesion_admin.php";
include "coneccion_i.php";
$idU=$_SESSION['idU'];

$id=$_GET['id'];
$revision=$_GET['revision'];

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
function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
</head>
<body>

<form method="post" name="form1" action="">
<table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
                            <tr>
                              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td><table width="100%" border="0" cellspacing="2" cellpadding="0">
                                        <tr>
                                          <td height="20" bgcolor="#ced0d1" class="usuario">&nbsp;</td>
                                        </tr>
                                    </table></td>
                                  </tr>
                                 
                              </table></td>
                            </tr>
							<tr>
							<td><table width="100%" border="0" cellspacing="2" cellpadding="2"  bgcolor="#FAFAFA">
  <tr>
    <td width="55%" class="texto_tareas"><b>Leads</b></td>
    <td width="15%" class="texto_tareas" align="center"><b>Calif Lead</b></td>
	<td width="15%" class="texto_tareas" align="center"><b>Calif Lag</b></td>
	<td width="15%" class="texto_tareas" align="center"><b>Total</b></td>
  </tr>
</table></td>
							</tr>
							<?
		$consulta2 = "SELECT * FROM objetivos2 where id_empleado=$id and revision=$revision and nombre>0";
		$resultado2= mysqli_query($enlace,$consulta2) or die("La consulta fall&oacute;P1: $consulta2". mysqli_error($enlace));
		$color="F0F0F0";
		$count=1;
		while($res2=mysqli_fetch_assoc($resultado2))
		{
			$calif=0;
			$consulta4 = "SELECT calif FROM lags where id in ({$res2['descripcion']}, {$res2['descripcion2']})";
			$resultado4= mysqli_query($enlace,$consulta4) or die("La consulta fall&oacute;P1: $consulta4". mysqli_error($enlace));
			$no=mysqli_num_rows($resultado4);
			while($res4=mysqli_fetch_assoc($resultado4)){
			
				$calif=$calif+$res4['calif'];
			}
			
	
	$calif1=0;
	$calif2=0;
	$calif3=0;
	$calif4=0;
	$calif5=0;
	$calif6=0;
	$calif=$calif/$no;
					  ?>
                            <tr bgcolor="#<? echo"$color";?>">
                              <td><table width="70%" border="0" align="left" cellspacing="2" cellpadding="2"  >
  <?
  if($res2['impacto']>0){
				if($res2['revision_final']==1){$val1=20;}
				if($res2['revision_final']==2){$val1=60;}
				if($res2['revision_final']==3){$val1=90;}
				if($res2['revision_final']==4){$val1=100;}
				$calif1=$val1*$res2['ponderacion'];
	$consulta99  = "SELECT * from leads where id={$res2['impacto']}";
	$resultado99 = mysqli_query($enlace,$consulta99);	
	$res99=mysqli_fetch_assoc($resultado99);
  ?>
  <tr>
    <td width="79%" class="texto_tareas" align="justify"><? echo $res99['nombre']?></td>
    <td width="21%" class="texto_tareas" align="center"><? echo ($calif1/100)*.6;?></td>
  </tr>
  <?
  }

			if($res2['impacto2']>0){
				if($res2['revision_final2']==1){$val2=20;}
				if($res2['revision_final2']==2){$val2=60;}
				if($res2['revision_final2']==3){$val2=90;}
				if($res2['revision_final2']==4){$val2=100;}
				$calif2=$val2*$res2['ponderacion2'];
	
	$consulta99  = "SELECT * from leads where id={$res2['impacto2']}";
	$resultado99 = mysqli_query($enlace,$consulta99);	
	$res99=mysqli_fetch_assoc($resultado99);
  ?>
  <tr>
    <td width="79%" class="texto_tareas"><? echo $res99['nombre']?></td>
    <td width="21%" class="texto_tareas" align="center"><? echo ($calif2/100)*.6;?></td>
	</tr>
  <?
  }
			if($res2['impacto3']>0){
				if($res2['revision_final3']==1){$val3=20;}
				if($res2['revision_final3']==2){$val3=60;}
				if($res2['revision_final3']==3){$val3=90;}
				if($res2['revision_final3']==4){$val3=100;}
				$calif3=$val3*$res2['ponderacion3'];
	
	$consulta99  = "SELECT * from leads where id={$res2['impacto3']}";
	$resultado99 = mysqli_query($enlace,$consulta99);	
	$res99=mysqli_fetch_assoc($resultado99);
  ?>
  <tr>
    <td width="79%" class="texto_tareas"><? echo $res99['nombre']?></td>
    <td width="21%" class="texto_tareas" align="center"><? echo ($calif3/100)*.6;?></td>
	</tr>
  <?
  }
			if($res2['impacto4']>0){
				if($res2['revision_final4']==1){$val4=20;}
				if($res2['revision_final4']==2){$val4=60;}
				if($res2['revision_final4']==3){$val4=90;}
				if($res2['revision_final4']==4){$val4=100;}
				$calif4=$val4*$res2['ponderacion4'];

	$consulta99  = "SELECT * from leads where id={$res2['impacto4']}";
	$resultado99 = mysqli_query($enlace,$consulta99);	
	$res99=mysqli_fetch_assoc($resultado99);			
  ?>
  <tr>
    <td width="79%" class="texto_tareas"><? echo $res99['nombre']?></td>
    <td width="21%" class="texto_tareas" align="center"><? echo ($calif4/100)*.6;?></td>
	</tr>
  <?
  }
			if($res2['impacto5']>0){
				if($res2['revision_final5']==1){$val5=20;}
				if($res2['revision_final5']==2){$val5=60;}
				if($res2['revision_final5']==3){$val5=90;}
				if($res2['revision_final5']==4){$val5=100;}
				$calif5=$val5*$res2['ponderacion5'];
	
	$consulta99  = "SELECT * from leads where id={$res2['impacto5']}";
	$resultado99 = mysqli_query($enlace,$consulta99);	
	$res99=mysqli_fetch_assoc($resultado99);
  ?>
  <tr>
    <td width="79%" class="texto_tareas"><? echo $res99['nombre']?></td>
    <td width="21%" class="texto_tareas" align="center"><? echo ($calif5/100)*.6;?></td>
	</tr>
  <? 
  }
			if($res2['impacto6']!=""){
				if($res2['revision_final6']==1){$val6=20;}
				if($res2['revision_final6']==2){$val6=60;}
				if($res2['revision_final6']==3){$val6=90;}
				if($res2['revision_final6']==4){$val6=100;}
				$calif6=$val6*$res2['ponderacion6'];
				
  ?>
  <tr>
    <td width="79%" class="texto_tareas"><? echo $res2['impacto6']?></td>
    <td width="21%" class="texto_tareas" align="center"><? echo ($calif6/100)*.6;?></td>
	</tr>
  <? }  	$calif_s=0;
			$calif_s=$calif1+$calif2+$calif3+$calif4+$calif5+$calif6;
			//echo "S: $calif_s <br/>";
			$calif_f=(($calif_s*.6)/100)+$calif;
			//echo "F: $calif_f <br/>";
			$calif_f2=$calif_f2+$calif_f;?>
</table>
<table width="15%" align="right" border="0" cellspacing="6" cellpadding="6">
  <tr>
    <td width="100%" align="center" class="texto_tareas" valign="middle"><? echo $calif_f?></td>
  </tr>
</table>
<table width="15%" align="right" border="0" cellspacing="6" cellpadding="6">
  <tr>
    <td width="100%" align="center" class="texto_tareas" valign="middle"><? echo $calif?></td>
  </tr>
</table>
</td>
                            </tr>
							<? 
							
		if($color=="F0F0F0")
				  	$color="FFFFFF";
					else
					$color="F0F0F0";
			
		
		$count++;
		}	
		$calif_final=$calif_f2/($count-1);?>
							<tr>
                              <td><table width="100%" border="0" cellspacing="2" cellpadding="2"  bgcolor="#FAFAFA">
  <tr>
    <td width="55%" class="texto_tareas">&nbsp;</td>
	<td width="15%" class="texto_tareas" align="center">&nbsp;</td>
	<td width="15%" class="texto_tareas" align="center"><b>Calif Final</b></td>
    <td width="15%" class="texto_tareas" align="center"><b><? echo $calif_final?></b></td>
	
  </tr>
</table></td>
                            </tr>
                            <tr>
                              <td><img src="images/spacer.gif" width="10" height="20" /></td>
                            </tr>
                        </table>
</form>
</body>
</html>
