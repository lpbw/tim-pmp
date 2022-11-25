<?
session_start();
include "checar_sesion_admin.php";
include "coneccion_i.php";
$idU=$_SESSION['idU'];


	$consulta  = "SELECT revision, etapa, etapa_360, cuantos, min from etapa where id=1";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_row($resultado);
		$revision=$res[0];
		$etapa=$res[1];
		$etapa_360=$res[2];
		$max=$res[3];
		$min=$res[4];
		//if($etapa_360!="1")
			/*echo"<script>window.location=\"menu.php\";</script>";*/
	}
	$consulta  = "SELECT estatus_360 from planes where id_empleado=$idU and revision=$revision";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_row($resultado);
		$estatus_360=$res[0];
		
		if($estatus_360!="0")
			echo"<script>window.location=\"menu.php\";</script>";
	}
	
	if($_POST['borrar']!="")
	{
		$borrar=$_POST['borrar'];
		$query="delete from evaluadores where id=$borrar";
		$consulta=mysqli_query($enlace,$query)or die("Fallo al actualizar: ".mysqli_error($enlace));
	}
	if($_POST['agregar']=="Agregar Evaluador")
	{
		$evaluador=$_POST['evaluador'];
		$relacion=$_POST['relacion'];
		$query="insert into evaluadores(id_evaluado, id_evaluador, relacion, revision) values($idU, $evaluador, $relacion, $revision)";
		$consulta=mysqli_query($enlace,$query)or die("Fallo al actualizar: ".mysqli_error($enlace));
		//echo"$query";
	}
	
	if($_POST['enviar']!="")
	{
		$evaluador=$_POST['evaluador'];
		$relacion=$_POST['relacion'];
		
		
		$query = "SELECT usuarios.*, us.nombre AS nombreEmpleado,  us.id_jefe_360 AS jefe360Empleado FROM `usuarios` inner join usuarios as us on usuarios.id = us.id_jefe WHERE us.id = $idU";
        $result = mysqli_query($enlace,$query) or print(' No se obtuvo id del jefe '.mysqli_error($enlace));
        $jefe = mysqli_fetch_assoc($result);
		//inserta al jefe
		/*$query="insert into evaluadores(id_evaluado, id_evaluador, relacion, revision) values($idU, {$jefe['jefe360Empleado']}, 1, $revision)";
		$consulta=mysqli_query($enlace,$query)or die("Fallo al actualizar: ".mysqli_error($enlace));*/
		
		//inserta colaboradores
		/*$consulta  = "SELECT id from usuarios where id_jefe=$idU or id_jefe_360=$idU";
		$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)	
		$count1=1;
		while(@mysqli_num_rows($resultado)>=$count1)
		{
			$res1=mysqli_fetch_row($resultado);
			$query2="insert into evaluadores(id_evaluado, id_evaluador, relacion, revision) values($idU, $res1[0], 2, $revision)";
			$consulta2=mysqli_query($enlace,$query2)or die("Fallo al actualizar: ".mysqli_error($enlace));
			$count1++;
		}*/
		//cambia estatus a evaludores seleccionados
		$query="update planes set estatus_360=1 where id_empleado=$idU and revision=$revision";
		$consulta=mysqli_query($enlace,$query)or die("Fallo al actualizar: ".mysqli_error($enlace));
		
		//envia notificacion al jefe para validar
		if(!is_null($jefe)){
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
                <td><div align=\"center\"><img src=\"http://www.tim-pmp.com/images/header_logo_email.png\" width=\"613\" height=\"200\" /></div></td>
          </tr>
          <tr>
                <td><div align=\"center\" class=\"text_grande\">Seleccion de evaluadores $revision </div></td>
          </tr>
          <tr>
                <td><p>&nbsp;</p>
                  <p>Tu colaborador {$jefe['nombreEmpleado']} ha seleccionado evaluadores .</p>
                  <p>Te invitamos a entrar a la plataforma para validarlos, en la secci&oacute;n de tareas pendientes encontrarás una liga &quot; Revisión de Evaluadores $revision</p>
                  <p align=\"center\"><a href=\"http://www.tim-pmp.com\" class=\"boton style1\">http:///www.tim-pmp.com</a></p>
                <p align=\"left\"> </p>
                <p align=\"left\">. </p></td>
          </tr>
          <tr>
                <td class=\"texto_chico\">
                <div align=\"center\">Este correo electrónico fue generado automáticamente y no requiere ser contestado, para cualquier duda acudir al departamento de Recursos Humanos con la Lic. Gloria Martinez, gmartinez01@bellflight.com  </div></td>
          </tr>
        </table>
        </body>
        </html>";
        $Subject = "TIM-PMP - Revisar evaluadores de {$jefe['nombreEmpleado']} ";
        
        $success2 = mail($jefe['email'], $Subject, $Body, "From: TIM-PMP <$EmailFrom>\nContent-type: text/html; charset=utf-8\n");
		}
		echo"<script>alert(\"Su seleccion de evaluadores ha sido enviada para revision\");</script>";
		echo"<script> window.location=\"menu.php\";</script>";
	}
	
	$consulta  = "SELECT id_jefe, id_jefe_360 from usuarios where id=$idU";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_row($resultado);
		$jefe=$res[0];
		$jefe_360=$res[1];
		
	}
	$consulta  = "SELECT count(id) from evaluadores where id_evaluado=$idU and relacion=3 and revision=$revision";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_row($resultado);
		$contador_colaterales=$res[0];
	}
	$consulta  = "SELECT count(id) from evaluadores where id_evaluado=$idU and relacion=4 and revision=$revision";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_row($resultado);
		$contador_clientes=$res[0];
	}
	$consulta  = "SELECT id_evaluador from evaluadores where id_evaluado=$idU and revision=$revision";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	$count=1;
	$cadena=$idU;
	while(@mysqli_num_rows($resultado)>=$count)
	{
		$res=mysqli_fetch_row($resultado);
		$cadena.=",$res[0]";
		$count++;
		
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
.style10 {font-family: Geneva, Arial, Helvetica, sans-serif; font-size: 16px; color: #104352; }
.style5 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000000; }
-->
</style>
</head>

<body onload="MM_preloadImages('images/b_cambio_r.png','images/b_administracion_r.png','images/b_log_out_r.png','images/icono_borrar_r.png')">
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
              <td><div align="center" class="text_grande style1">Selección de Evaluadores  </div></td>
            </tr>
            <tr>
              <td><div align="center" class="text_mediano"><span class="texto_contenido2">El evaluado (Tú) debes tener máximo <? echo"$max";?> y mínimo <? echo"$min";?> de cada tipo :”Clientes y Colaterales”<br />
                    Tus Colaboradores y tú Jefe Directo serán agregados automáticamente al dar click en el botón “Enviar Evaluadores para aprobación”
<br />
Tu Jefe Directo podrá hacer cambio de hasta 2 evaluadores de los que hayas seleccionado.</span></div></td>
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
                <td><table width="747" border="1" align="center" cellspacing="0">
                  <tr>
                    <td><table width="745" border="0" align="center" cellspacing="0">
                        <tr>
                          <td  height="16" bgcolor="#00475c" class="text_mediano_blanco"><span class="texto_logout">Seleccione al evaluador </span></td>
                          <td width="26%" height="18" bgcolor="#00475c" class="text_mediano_blanco"><div align="left"><span class="texto_logout">Seleccione tipo de relaci&oacute;n </span></div></td>
                          <td width="20%" height="18" bgcolor="#00475c" class="text_mediano_blanco">&nbsp;</td>
                        </tr>
                        <tr>
                          <td width="54%" class="style9"><div align="left" class="texto_logout"><span class="style6"><span class="style5">
                              <select name="evaluador" class="texto_contenido" id="evaluador" onchange="mostrar(document.form1.evaluador);">
                                <option value="">Seleccione Evaluador</option>
                                
                                <?
	$consulta  = "select id, nombre from usuarios  where activo=1 and id not in($cadena) and activo=1 order by nombre";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	$count=1;
	//echo"$consulta";
	while(@mysqli_num_rows($resultado)>=$count)
	{
		$res=mysqli_fetch_row($resultado);
?>                                
	<option value="<? echo"$res[0]";?>" ><? echo"$res[1]";?> </option>
     <?
	 $count++;
	 }
	?>
                              </select>
                          </span></span></div></td>
                          <td class="style6"><select name="relacion" id="relacion">
                              <option value="0">Selecione Relaci&oacute;n</option>
                              <? if($contador_colaterales<$max){?>
                            <option value="3">Colaterales</option>
                            <? }?>
                              <? if($contador_clientes<$max){?>
                            <option value="4">Cliente</option>
                            <? }?>
                              
                            </select>
                          </td>
                          <td class="style6">
                              <input name="revision" type="hidden" id="revision" value="<? echo"$revision";?>" />
                              <input name="borrar" type="hidden" id="borrar" />
                              <span class="style9"><span class="style5">
                              <? if($contador_colaterales<$max || $contador_clientes<$max){?>
                                
                                <input name="agregar" type="submit" class="boton_entrar" id="agregar" value="Agregar Evaluador" onclick="return valida();"/>
							 <? }?>
                            </span></span></td>
                        </tr>
                      </table>
                        <table width="745" border="0" align="center" cellspacing="0" id="externos" style="display:none;">
                          <!---->
                          <tr>
                            <td class="texto_logout">Evaluadores externos </td>
                            <td class="style6">&nbsp;</td>
                            <td class="style6">&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="style9"><table width="100%" border="0">
                                <tr>
                                  <td width="18%" bgcolor="#F3F3F3"><span class="texto_contenido5">Nombre: </span></td>
                                  <td width="82%" bgcolor="#F3F3F3"><span class="texto_contenido5">
                                    <input name="nombre" type="text" id="nombre" size="30" maxlength="50" />
                                  </span></td>
                                </tr>
                                <tr>
                                  <td bgcolor="#F3F3F3"><span class="texto_contenido5">Email:</span></td>
                                  <td bgcolor="#F3F3F3"><input name="email" type="text" id="email" size="30" maxlength="50" /></td>
                                </tr>
                              </table>
                                <span class="texto_contenido5"><br />
                              </span></td>
                            <td class="style9">&nbsp;</td>
                            <td class="style9"><span class="style6"><span class="style5">
                              <!-- Validar no boton cuando tenga todos seleccionados, 
	       validar no agregar al jefe
		   	validar no agregar subordinados-->
                            </span></span></td>
                          </tr>
                      </table></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td><img src="images/franja.jpg" width="753" height="12" /></td>
              </tr>
              <tr>
                <td><img src="images/spacer.gif" width="10" height="10" /></td>
              </tr>
              <tr>
                <td valign="top"><table width="745" border="0" align="center">
                 <tr>
                    <td colspan="3"><div align="center">
                        <table width="100%" border="0" cellpadding="0">
                          <tr>
                            <td bgcolor="#00475c" class="text_mediano_blanco"  scope="row"><div align="center" class="texto_logout">Evaluadores seleccionados </div></td>
                            <td bgcolor="#00475c" class="text_mediano_blanco" scope="row"><div align="center">Relaci&oacute;n</div></td>
                            <td bgcolor="#00475c" class="text_mediano_blanco" scope="row"><div align="center"></div></td>
                          </tr>
                          <?
	$consulta  = "select usuarios.nombre, evaluadores.relacion, evaluadores.id_evaluador, evaluadores.id from evaluadores left join usuarios on evaluadores.id_evaluador=usuarios.id where evaluadores.id_evaluado=$idU and evaluadores.revision=$revision order by evaluadores.relacion, usuarios.nombre";
	//echo"$consulta";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	$count=1;
	while(@mysqli_num_rows($resultado)>=$count)
	{
		$res=mysqli_fetch_row($resultado);
		$relacion=$res[1];
		if($relacion=="3")
			$relacion="Colaterales";
		else
		{
			if($relacion=="4")
				$relacion="Cliente";
		}
?>   
                          <tr>
                            <td width="64%"><div align="left"><span class="texto_contenido"><? echo"$res[0]";?></span></div></td>
                            <td width="23%"><div align="center"><span class="texto_contenido"><? echo"$relacion";?></a></div></td>
                            <td width="13%"><div align="center"> <a href="javascript:borrar('<? echo"$res[3]";?>');" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image6','','images/icono_borrar_r.png',1)"><img src="images/icono_borrar.png" name="Image6" width="18" height="22" border="0" id="Image6" /></a> </div></td>
                          </tr>
	  <?
	  $count++;
	}	
	?>
                          <tr>
                            <td><div align="right"><span class="style5">
                                <? if($contador_colaterales>=$min && $contador_colaterales<=$max && $contador_clientes>=$min && $contador_clientes<=$max){?>
                              <input name="enviar" type="submit" class="boton_entrar" id="enviar" value="Enviar Evaluadores para aprobación" />
                                <? }?>
                            </span></div></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="3" ><table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr>
                                  <td height="5" background="images/franja_negra.jpg"><img src="images/franja_negra.jpg" width="5" height="9" /></td>
                                </tr>
                            </table></td>
                          </tr>
                        </table>
                    </div></td>
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
</body>
</html>
