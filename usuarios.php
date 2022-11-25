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
		$(".iframe2").colorbox({iframe:true,width:"500", height:"550",transition:"fade", scrolling:true, opacity:0.1});
		$("#click").click(function(){ 
			$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
			return false;
		});
	});
	/*function cerrarV(){
		$.fn.colorbox.close();
	}*/
	function borrar(id){
		if(confirm("¿Está seguro de borrar este usuario?"))
			$.colorbox({iframe:true,href:"borrar_usu.php?id="+id ,width:"auto", height:"auto",transition:"fade", scrolling:false, opacity:0.5});
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
						<td>
							<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
								<tr>
									<td valign="top" bgcolor="#eeeeee">
										<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
											<tr>
												<td><img src="images/spacer.gif" width="10" height="20" /></td>
											</tr>
											<tr>
												<td width="80%"><span class="tit_1">Administración de Usuarios</span>
													<span class="texto_tareas"></span></td>
												<td width="20%" align="right" valign="middle" class="tit_1 style2">
													<a href="agregar_usu.php" class="iframe">Agregar Usuario
													<img src="images/agregar.png" width="15px" height="15px" border="0" title="Agregar Usuario"/></a>												</td>
											</tr>
											<tr>
												<td colspan="2"><img src="images/franja.jpg" width="100%" height="12" /></td>
											</tr>
											<tr>
												<td colspan="2"><img src="images/spacer.gif" width="100%" height="10" /></td>
											</tr>
											<tr>
												<td colspan="2">
													<form name="buscar" id="buscar" action="" method="get">
													<table align="center" width="50%">
														<tr>
															<td colspan="3"><div align="center" class="style4">
																Buscar por Departamento
															</div></td>
														</tr>
														
														<tr>
														  <td valign="middle" align="right" class="usuario">&nbsp;</td>
														  <td valign="middle">&nbsp;</td>
														  <td valign="middle">&nbsp;</td>
													  </tr>
														<tr>
															<td width="25%" valign="middle" align="right" class="usuario">
																Departamento:&nbsp;															</td>
															<td width="50%" valign="middle">
																<select class="forma" id="depto" name="depto">
																<option value="0">--Seleccionar Departamento--</option>
															<?
															$query="SELECT id, nombre FROM departamentos";
															$consulta=mysqli_query($enlace,$query)or die("Error al consultar departamentos: ".mysqli_error($enlace));
															for($i=0;$i<@mysqli_num_rows($consulta);$i++){
																$dep=mysqli_fetch_row($consulta);
															?>
																<option <? if($dep[0]==$id_depto_b) echo "selected=\"selected\""; ?> value="<? echo "$dep[0]";?>"><? echo "$dep[1]";?></option>
															<? }?>
															<option <? if($dep[0]=="9999") echo "selected=\"selected\""; ?> value="9999">Inactivos</option>
															</select>															</td>
															<td width="25%" valign="middle">
																<input class="boton" onclick="return validar();" type="submit" id="busca" name="busca" value="Buscar" />															</td>
														</tr>
													</table>
													</form>
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
															<td width="7%" bgcolor="#00475c" class="text_mediano_blanco">
															# Empleado</td>
															<td width="20%" bgcolor="#00475c" class="text_mediano_blanco">
															Nombre</td>
															<td width="8%" bgcolor="#00475c" class="text_mediano_blanco">
															E-Mail</td>
															<td width="12%" bgcolor="#00475c" class="text_mediano_blanco">
															Departamento</td>
															<td width="19%" bgcolor="#00475c" class="text_mediano_blanco">
															Jefe</td>
															<td width="5%" bgcolor="#00475c" class="text_mediano_blanco">
															Grado Salarial</td>
															<td width="10" bgcolor="#00475c" class="text_mediano_blanco">
															Puesto</td>
															<td width="8%" bgcolor="#00475c" class="text_mediano_blanco">
															Fecha de Ingreso</td>
															<td width="3%" bgcolor="#00475c" class="text_mediano_blanco">
															Tipo</td>
															<td width="8%" bgcolor="#00475c" class="text_mediano_blanco">&nbsp;
														  </td>
														</tr>
														<? 
														$color="CCCCCC";
														$count=0;
														if($_GET['busca']=="Buscar"){
															
															if($id_depto_b =="9999")
															$query="SELECT * FROM usuarios where  activo=0 order by id";
															else
															$query="SELECT * FROM usuarios where  activo=1 and id_departamento=$id_depto_b order by id";
															//echo"$query";
															$result=mysqli_query($enlace,$query) or die("Falla la consulta 1: ". mysqli_error($enlace));
														
														while(@mysqli_num_rows($result)>$count){
															$row=mysqli_fetch_row($result);
															$id=$row[0];
															$nombre=$row[1];
															$email=$row[2];
															$id_jefe=$row[5];
															$grado=$row[6];
															$id_depto=$row[7];
															$puesto=$row[8];
															$fecha_ingreso=$row[9];
															$tipo=$row[11];
															$query ="SELECT nombre from departamentos where id=$id_depto";
															$res=mysqli_query($enlace,$query) or die("Falla consulta 2: ".mysqli_error($enlace));
															$row=mysqli_fetch_row($res);
															$depto=$row[0];
															if($id_jefe==0)
																$jefe="";
															else{
																$query ="SELECT nombre from usuarios where id=$id_jefe";
																$res=mysqli_query($enlace,$query) or die("Falla consulta 2: ".mysqli_error($enlace));
																$row=mysqli_fetch_row($res);
																$jefe=$row[0];
															}
															?>
															<tr bgcolor="#<?echo $color;?>" align="center">
																<td class="texto_tareas"><?echo $id?></td>
																<td class="texto_tareas"><?echo $nombre?></td>
																<td class="texto_tareas"><?echo $email?></td>
																<td class="texto_tareas"><?echo $depto?></td>
																<td class="texto_tareas"><?echo $jefe?></td>
																<td class="texto_tareas"><?echo $grado?></td>
																<td class="texto_tareas"><?echo $puesto?></td>
																<td class="texto_tareas"><?echo $fecha_ingreso?></td>
																<td class="texto_tareas"><?echo $tipo?></td>
																<td class="texto_chico"><a href="editar_usu.php?id=<? echo"$id";?>" class="iframe2"><img src="images/editar.png" width="20px" height="20px" border="0" title="Editar Usuario" /></a>&nbsp;&nbsp;
																<a href="javascript:borrar(<? echo"$id"; ?>);"><img src="images/eliminar.png" width="20px" height="20px" border="0" title="Eliminar Usuario"/></a></td>
															</tr>
															<?
															$count++;
															if($color=="CCCCCC")
																$color="FFFFFF";
															else
																$color="CCCCCC";
														}//while
														}
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
						<td><img src="images/spacer.gif" width="10" height="50" /></td>
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