<?
session_start();
include "checar_sesion_admin.php";
include "coneccion_i.php";
$idU=$_SESSION['idU'];
$id_depto=$_POST["depto"];
$plan=$res[0];
$estatus="";
$firma1e="";
$setenta="0";
$veinte="0";
$diez="0";
	$consulta4  = "SELECT revision, etapa from etapa where id=1";
	$resultado4 = mysqli_query($enlace,$consulta4) or die("La consulta fall&oacute;P1:$consulta4 ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	if(@mysqli_num_rows($resultado4)>=1)
	{
		$res4=mysqli_fetch_row($resultado4);
		$revision=$res4[0];
		$etapa=$res4[1];
	}
	
	if($_POST['comp']=="71")
	{
		$where=" and competencias.id=".$_POST['comp']."";
	}
	elseif($_POST['comp']=="999")
	{
		$where=" and competencias.id<>71";
	}	
	
	if($_POST['depto']=="99" && $_POST['estatus']=="99"){
						$consulta  = "SELECT usuarios.id, usuarios.nombre, terminado, mes, acciones.revision, accion, departamentos.nombre as depto, acciones.tipo FROM acciones
inner join usuarios on usuarios.id=acciones.id_usuario
inner join departamentos on departamentos.id=usuarios.id_departamento inner join competencias on acciones.revision = competencias.revision where mes='".$_POST['mes']."' and acciones.revision=".$_POST['revision']."".$where." and usuarios.activo=1";
$resultado = mysqli_query($enlace,$consulta) or die("La consulta $consulta ". mysqli_error($enlace) );
$resultado6 = mysqli_query($enlace,$consulta) or die("La consulta $consulta ". mysqli_error($enlace) );
						$total=mysqli_num_rows($resultado);
						}else{
							if($_POST['depto']=="99" && $_POST['estatus']!="99"){
							$consulta  = "SELECT usuarios.id, usuarios.nombre, terminado, mes, acciones.revision, accion, departamentos.nombre as depto, acciones.tipo FROM acciones
inner join usuarios on usuarios.id=acciones.id_usuario
inner join departamentos on departamentos.id=usuarios.id_departamento inner join competencias on acciones.revision = competencias.revision where mes='".$_POST['mes']."' and acciones.revision=".$_POST['revision']." and terminado=".$_POST['estatus']."".$where." and usuarios.activo=1";
$resultado = mysqli_query($enlace,$consulta) or die("La consulta $consulta ". mysqli_error($enlace) );
$resultado6 = mysqli_query($enlace,$consulta) or die("La consulta $consulta ". mysqli_error($enlace) );
							$total=mysqli_num_rows($resultado);
							}else{
								if($_POST['depto']!="99" && $_POST['estatus']=="99"){
									$consulta  = "SELECT usuarios.id, usuarios.nombre, terminado, mes, acciones.revision, accion, departamentos.nombre as depto, acciones.tipo FROM acciones
inner join usuarios on usuarios.id=acciones.id_usuario
inner join departamentos on departamentos.id=usuarios.id_departamento inner join competencias on acciones.revision = competencias.revision where activo=1 and  mes='".$_POST['mes']."' and acciones.revision=".$_POST['revision']." and id_departamento=".$_POST['depto']."".$where." and usuarios.activo=1 GROUP BY acciones.tipo";
$resultado = mysqli_query($enlace,$consulta) or die("La consulta $consulta ". mysqli_error($enlace) );
$resultado6 = mysqli_query($enlace,$consulta) or die("La consulta $consulta ". mysqli_error($enlace) );
									$total=mysqli_num_rows($resultado);
								}else{
									if($_POST['depto']!="99" && $_POST['estatus']!="99" && $_POST['mes']!="" && $_POST['estatus']!="" && $_POST['comp']!=""){
									
									
									$consulta  = "SELECT usuarios.id, usuarios.nombre, terminado, mes, acciones.revision, accion, departamentos.nombre as depto, acciones.tipo FROM acciones
inner join usuarios on usuarios.id=acciones.id_usuario
inner join departamentos on departamentos.id=usuarios.id_departamento inner join competencias on acciones.revision = competencias.revision where activo=1 and mes='".$_POST['mes']."' and acciones.revision=".$_POST['revision']." and terminado=".$_POST['estatus']." and id_departamento=".$_POST['depto']."".$where." and usuarios.activo=1 GROUP BY acciones.tipo";
$resultado = mysqli_query($enlace,$consulta) or die("La consulta $consulta ". mysqli_error($enlace) );
$resultado6 = mysqli_query($enlace,$consulta) or die("La consulta $consulta ". mysqli_error($enlace) );
									$total=mysqli_num_rows($resultado);
									}
								}
							}
						}	
						
						if($_POST['buscar']=="Buscar"){
						while($res6=mysqli_fetch_assoc($resultado6))					
						{
						if($res6['tipo']=="70 - Learning by doing"){$setenta++;}
						if($res6['tipo']=="20 - Learning from Others"){$veinte++;}
						if($res6['tipo']=="10 - Learning from Courses & Materials"){$diez++;}
						}	
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
	document.form1.action="objetivos2.php";
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
              <td><div align="center" class="text_grande style1">ADMINISTRACIÓN DEL  PORTAL DE PMP </div></td>
            </tr>
            <tr>
              <td><div align="center" class="text_mediano">(Reporte del Plan de Desarrollo TIM)</div></td>
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
                <td><span class="tit_1">Reporte de planes de desarrollo </span><span class="texto_tareas"></span></td>
              </tr>
              <tr>
                <td><img src="images/franja.jpg" width="753" height="12" /></td>
              </tr>
              <tr>
                <td><img src="images/spacer.gif" width="10" height="10" /></td>
              </tr>
              <tr>
                <td valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="0">
                  <tr>
                    <td colspan="10" class="texto_tareas" align="center">Mes: <select name="mes"  class="texto_tareas" style="width:120px" id="mes" required>
                          	<option value="">--Select--</option>
                          	<option value="1" <? if($_POST['mes']=="1"){echo"selected";}?> >Enero</option>
							<option value="2" <? if($_POST['mes']=="2"){echo"selected";}?>>Febrero</option>
							<option value="3" <? if($_POST['mes']=="3"){echo"selected";}?>>Marzo</option>
							<option value="4" <? if($_POST['mes']=="4"){echo"selected";}?>>Abril</option>
							<option value="5" <? if($_POST['mes']=="5"){echo"selected";}?>>Mayo</option>
							<option value="6" <? if($_POST['mes']=="6"){echo"selected";}?>>Junio</option>
							<option value="7" <? if($_POST['mes']=="7"){echo"selected";}?>>Julio</option>
							<option value="8" <? if($_POST['mes']=="8"){echo"selected";}?>>Agosto</option>
							<option value="9" <? if($_POST['mes']=="9"){echo"selected";}?>>Septiembre</option>
							<option value="10" <? if($_POST['mes']=="10"){echo"selected";}?>>Octubre</option>
							<option value="11" <? if($_POST['mes']=="11"){echo"selected";}?>>Noviembre</option>
							<option value="12" <? if($_POST['mes']=="12"){echo"selected";}?>>Diciembre</option>
                        </select>
						&ensp; 
                      Año: <select name="revision"  class="texto_tareas" id="revision" required>
                        <option value="">--Select--</option>
                        <?	  

		
	$consulta2  = "SELECT revision FROM plan_desarrollo group by revision  ORDER BY revision";
	$resultado2 = mysqli_query($enlace,$consulta2) or die("La consulta fall&oacute;P1: " . mysqli_error($enlace));
	while($res2=mysqli_fetch_assoc($resultado2))
	{
	?>
	<option value="<? echo $res2['revision']?>" <? echo $_POST['revision']==$res2['revision']?"selected":"";?>><? echo $res2['revision']?></option>
	<?
	}	
	?>
                      </select>&ensp; 
					   Estatus: <select name="estatus"  class="texto_tareas" style="width:120px" id="estatus">
                          	<option value="99" <? if($_POST['estatus']=="99"){echo"selected";}?> >Todos</option>
							<option value="0" <? if($_POST['estatus']=="0"){echo"selected";}?>>Abierta</option>
							<option value="1" <? if($_POST['estatus']=="1"){echo"selected";}?>>Cerrada</option>
                        </select>
					   &ensp; 
					    Departamento: 
                      <select name="depto"  class="texto_tareas" id="depto">
						<option value="99" <? if($_POST['depto']=="99"){echo"selected";}?>>--Todos--</option>
                        <?	  

		
	$consulta3  = "SELECT id, nombre FROM departamentos  ORDER BY nombre";
	$resultado3 = mysqli_query($enlace,$consulta3) or die("La consulta fall&oacute;P1: " . mysqli_error($enlace));
	while($res3=mysqli_fetch_assoc($resultado3))
	{
		?>
		<option value="<? echo $res3['id']?>" <? echo $_POST['depto']==$res3['id']?"selected":"";?>><? echo $res3['nombre']?></option>
		<?
	}	
	?>
                      </select>
											
											 </td>
                    </tr>
										<tr>
											<td colspan="10" class="texto_tareas" align="center">
											</td>
										</tr>
										
                  <tr>
                    <td colspan="10"> &ensp; 
					    					Competencias: 
													<select name="comp" id="comp" class="texto_tareas">
															<option value="" <? echo $_POST['comp']==""?"selected":"";?>>Select</option>
															<option value="71" <? echo $_POST['comp']=="71"?"selected":"";?>>CT</option>
															<option value="999" <? echo $_POST['comp']=="999"?"selected":"";?>>CP</option>
														</select>
														&ensp; <input type="submit" name="buscar" id="buscar"  class="texto_tareas" value="Buscar">
														</td>
                  </tr>
									
                  <tr>
                    <td colspan="10"><table width="50%" border="0"  cellspacing="2" cellpadding="0" align="center">
                      <tr>
                        <td width="65%" bgcolor="#ced0d1" class="tit_1">Type</td>
                        <td width="35%" bgcolor="#ced0d1" class="tit_1" align="center">Total</td>
                      </tr>
                      <tr>
                        <td class="texto_tareas">70 - Learning by doing</td>
                        <td class="texto_tareas" align="center"><? echo $setenta?></td>
                      </tr>
                      <tr>
                        <td class="texto_tareas">20 - Learning from Others</td>
                        <td class="texto_tareas" align="center"><? echo $veinte?></td>
                      </tr>
                      <tr>
                        <td class="texto_tareas">10 - Learning from Courses &amp; Materials</td>
                        <td class="texto_tareas" align="center"><? echo $diez?></td>
                      </tr>
                    </table></td>
                    </tr>
                  <tr>
                    <td width="7%">&nbsp;</td>
                    <td width="20%"><input name="verobjetivos" type="hidden" id="verobjetivos" /></td>
                    <td width="19%">&nbsp;</td>
                    <td colspan="2" class="texto_tareas">&nbsp;</td>
                    <td colspan="2" class="texto_tareas">&nbsp;</td>
                    <td width="5%" class="texto_tareas">&nbsp;</td>
                    <td colspan="2" class="texto_tareas">&nbsp;</td>
                    </tr>
                  <tr>
                    <td bgcolor="#00475c" class="text_mediano_blanco">No.</td>
                    <td bgcolor="#00475c" class="text_mediano_blanco">Nombre</td>
                    <td bgcolor="#00475c" class="text_mediano_blanco">Departamento</td>
                    <td colspan="3" bgcolor="#00475c" class="text_mediano_blanco">Accion</td>
                    <td width="13%" bgcolor="#00475c" class="text_mediano_blanco">Fecha</td>
                    <td colspan="3" bgcolor="#00475c" class="text_mediano_blanco">Estatus</td>
                    </tr>
				   <? 
					  	$color="FFFFFF";
						$ter=0;
						$abi=0;
						while($res=mysqli_fetch_assoc($resultado))					
						{
						if($res['terminado']==1){$ter++;}
						if($res['terminado']==0){$abi++;}
						 ?>
                  <tr bgcolor="#<? echo"$color";?>">
                    <td  class="texto_tareas"><? echo $res['id']?></td>
                    <td  class="texto_tareas"><? echo $res['nombre']?></td>
                    <td  class="texto_tareas"><? echo $res['depto']?></td>
                    <td colspan="3"  class="texto_chico"><? echo $res['accion']?></td>
                    <td  class="texto_chico"><? echo $res['revision']?>-<? echo $res['mes']?></td>
                    <td colspan="3"  class="texto_chico"><? if($res['terminado']=="1"){echo "Cerrada";}else{echo"Abierta";}?></td>
                    </tr>
				  <?
				  if($color=="FFFFFF")$color="CCCCCC";else $color="FFFFFF";
				}
				$porcentaje=round(($ter/$total)*100,2);
				
				  ?>
                  <tr>
                    <td bgcolor="#FFFFFF" class="texto_tareas">&nbsp;</td>
                    <td bgcolor="#FFFFFF" class="texto_tareas">&nbsp;</td>
                    <td bgcolor="#FFFFFF" class="texto_tareas">&nbsp;</td>
                    <td width="15%" bgcolor="#FFFFFF" class="texto_chico">&nbsp;</td>
                    <td width="7%" bgcolor="#FFFFFF" class="texto_chico">&nbsp;</td>
                    <td width="7%" bgcolor="#FFFFFF" class="texto_chico">&nbsp;</td>
                    <td colspan="4" bgcolor="#FFFFFF" class="usuario" align="center">% Cumplimiento <? echo $porcentaje?></td>
                    </tr>
                </table></td>
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
      <?include_once("footer.php");?>
      </tr>
    </table></td>
  </tr>
</table>

</form>
</body>
</html>
