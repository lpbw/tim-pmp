<?
	session_start();
	include "checar_sesion_admin.php";
	include "coneccion_i.php";
	$idU=$_SESSION['idU'];
	$id_depto_b=$_GET['depto'];
	
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
-->
</style>
<link href="images/textos.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="colorbox.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="colorbox/jquery.colorbox-min.js"></script>
<script>
	$(document).ready(function(){
		$(".iframe").colorbox({iframe:true,width:"550", height:"570",transition:"fade", scrolling:false, opacity:0.1});
		$(".iframe2").colorbox({iframe:true,width:"480", height:"500",transition:"fade", scrolling:false, opacity:0.1});
		$(".iframe3").colorbox({iframe:true,width:"500", height:"300",transition:"fade", scrolling:false, opacity:0.1});
		$("#click").click(function(){ 
			$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
			return false;
		});
	});
	/*function cerrarV(){
		$.fn.colorbox.close();
	}*/
	function borrar(id){
		if(confirm("¿Está seguro de borrar este programa?"))
			$.colorbox({iframe:true,href:"borrar_programas.php?id="+id ,width:"auto", height:"auto",transition:"fade", scrolling:false, opacity:0.5});
	}
	function validar(){
		if(document.buscar.depto.value<1){
			alert("Escoja un departamento a buscar");
			return  false;
		}
		
	}

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

//-->
</script>
<style type="text/css">
<!--
.style1 {font-size: 24px}
.style2 {font-size: 12px}
.style4 {
	font-size: 24px;
	color: #00475c;
	font-weight: bold;
}
-->
</style>
</head>

<body onload="MM_preloadImages('images/b_cambio_r.png','images/b_administracion_r.png','images/b_log_out_r.png')">
	<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<?php include_once("header.php");?>
		</tr>
		<tr>
			<td valign="top" background="">
				<table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td><img src="images/spacer.gif" width="10" height="20" /></td>
					</tr>
					<tr>
						<td><div align="center">
							<table width="850" border="0" cellspacing="7" cellpadding="0">
								<tr>
									<td><div align="center" class="text_grande style1">ADMINISTRACIÓN DEL  PORTAL DE PMP
									</div></td>
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
						<td>
							<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
								<tr>
									<td valign="top" bgcolor="#eeeeee">
										<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
											<tr>
												<td><img src="images/spacer.gif" width="10" height="20" /></td>
											</tr>
											<tr>
												<td width="80%"><span class="tit_1">Administración de Programas Anuales </span>
													<span class="texto_tareas"></span></td>
												<td width="20%" align="right" valign="middle" class="tit_1 style2">
													<!--<a href="agregar_puesto.php" class="iframe3">Agregar Puesto
													<img src="images/agregar.png" width="15px" height="15px" border="0" title="Agregar Usuario"/></a>	-->											</td>
											</tr>
											<tr>
												<td colspan="2"><img src="images/franja.jpg" width="100%" height="12" /></td>
											</tr>
											<tr>
												<td colspan="2"><img src="images/spacer.gif" width="100%" height="10" /></td>
											</tr>
											<tr>
												<td colspan="2">
												
												</td>
											</tr>
											<tr>
												<td colspan="2">&nbsp;
												</td>
											</tr>
											<tr>
												<td colspan="2" valign="top">
													<table align="center" width="100%" border="0" cellspacing="2" cellpadding="0">
														<tr align="center">
															<td width="12%" bgcolor="#00475c" class="text_mediano_blanco">
															Programa</td>
															<td width="8%" bgcolor="#00475c" class="text_mediano_blanco">&nbsp;
														  </td>
														</tr>
														<? 
														$color="CCCCCC";
														$count=0;
														
															
															$query="SELECT * FROM programas order by nombre";
															//echo"$query";
															$result=mysqli_query($enlace,$query) or die("Falla la consulta 1: ". mysqli_error($enlace));
														
														while(@mysqli_num_rows($result)>$count){
															$row=mysqli_fetch_row($result);
															
															
															?>
															<tr bgcolor="#<?echo $color;?>" align="center">
																<td class="texto_tareas"><? echo"$row[1]";?></td>
																<td class="texto_chico"><a href="editar_programa.php?id=<? echo $row[0]?>" class="iframe3"><img src="images/editar.png" width="20px" height="20px" border="0" title="Editar programa" /></a>&nbsp;&nbsp;
																<a href="javascript:borrar(<? echo $row[0] ?>);"><img src="images/eliminar.png" width="20px" height="20px" border="0" title="Eliminar programa"/></a></td>
															</tr>
															<?
															$count++;
															if($color=="CCCCCC")
																$color="FFFFFF";
															else
																$color="CCCCCC";
														}//while
														
														?>
													</table>
												</td>
											</tr>
											<tr>
												<td><img src="images/spacer.gif" width="10" height="20" /></td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td><img src="images/spacer.gif" width="10" height="290" /></td>
					</tr>
					<tr>
						<?php include_once("footer.php");?>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>
