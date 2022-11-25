<?

//ini_set("display_errors", 1);
//ini_set("track_errors", 1);
//ini_set("html_errors", 1);
//session_start();
session_start();
include "coneccion_i.php";
$idU=$_SESSION['idU'];
$siguiente=$_POST['siguiente'];
if($siguiente=="")
	$siguiente=1;
$inicial=$siguiente;
$v_script="";
$nombre_competencia="";
$nombre_conducta="";
$tipo="";
$grados_n[0]="1";
$grados_n[1]="3";
$grados_n[2]="5";
$id_evaluado= $_POST['id_evaluado'];
$hay=$_POST['hay'];
if($hay=="")
	$hay=0;


$consulta  = "SELECT revision, etapa, etapa_360 from etapa where id=1";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_row($resultado);
		$revision=$res[0];
		$etapa=$res[1];
		$etapa360=$res[2];
	}
	
		/*if($_POST['iniciar']=="Iniciar Encuesta"){
	$consulta2  = "INSERT INTO externos_360 (id_evaluador, revision, tipo) VALUES (0, $revision, 2)";
	$resultado2 = mysqli_query($enlace,$consulta2) or die("La consulta $consulta ". mysqli_error($enlace) );
	
		$idEV=  mysqli_insert_id($enlace);
		$query2= "update externos_360 set id_evaluador=$idEV where id=$idEV";  
		$resul2 = mysqli_query($enlace,$query2) or die("Error en operacion1: $query " . mysqli_error($enlace));
		
		$_SESSION['idEV']=$idEV;
	
	
	$consulta3  = "INSERT INTO evaluadores (id_evaluado, id_evaluador, relacion, revision) VALUES ($idU, $idEV, 2, $revision)";
	//echo $consulta3;
	$resultado3 = mysqli_query($enlace,$consulta3) or die("La consulta $consulta ". mysqli_error($enlace) );
	}*/

if($_POST['enviar']!="")
{
	//echo"entra";
	$calificacion= $_POST['calificacion'];
	$ejemplos=mysqli_real_escape_string($enlace, $_POST['ejemplo']);
	$recurrente= $_POST['recurrente'];
	$p_guardar= $_POST['p_guardar'];
	
	$pattern2 = "0.00";
	$hay= $_POST['hay'];
	//DecimalFormat myFormatter2 = new DecimalFormat(pattern2);
	
	if($hay!="1")
		$query= "insert into new_calificaciones(id_evaluado, id_evaluador, id_numero,  calificacion, revision, ejemplos, recurrentes) values(".$id_evaluado.",".$idU.",".$p_guardar.",".$calificacion.", $revision, '".$ejemplos."', $recurrente)";		
	else
		$query= "update new_calificaciones set calificacion=$calificacion , ejemplos='".$ejemplos."', recurrentes=".$recurrente." where id_evaluado=$id_evaluado and  id_evaluador=$idU and id_numero=$p_guardar and revision=$revision";  
							
	$resultado = mysqli_query($enlace,$query) or die("Error en operacion1:$query " . mysqli_error($enlace));				
}



		$consulta = "select e1,	e1_descripcion,c_1,c_1_descripcion,c_2,c_2_descripcion,c_3,c_3_descripcion,c_4,c_4_descripcion,c_5,c_5_descripcion from new_competencias where numero=$siguiente";
		$co=0;
		$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P13:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)	
		if(@mysqli_num_rows($resultado)>0)
		{
			$res=mysqli_fetch_assoc($resultado);
			$area=$res['e1'];
			$descripcion=$res['e1_descripcion'];
			$c1=$res['c_1'];
			$c1_descripcion=$res['c_1_descripcion'];
			$c2=$res['c_2'];
			$c2_descripcion=$res['c_2_descripcion'];
			$c3=$res['c_3'];
			$c3_descripcion=$res['c_3_descripcion'];
			$c4=$res['c_4'];
			$c4_descripcion=$res['c_4_descripcion'];
			$c5=$res['c_5'];
			$c5_descripcion=$res['c_5_descripcion'];
			
		}	
		
		
		//$id_evaluado=2;//variable de prueba
	$consulta  = "select usuarios.nombre from  usuarios where id=$id_evaluado";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P3:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_row($resultado);
		$nombre_evaluado=$res[0];
		
		
	}

	$consulta  = "select calificacion, ejemplos,recurrentes from  new_calificaciones  where revision=$revision and id_evaluador=$idU and id_evaluado=$id_evaluado and id_numero=$siguiente";
	//echo"$consulta";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P4:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_row($resultado);
		$hay=1;
		$calificacion=$res[0];
		$ejemplos=$res[1];
		$recurrente=$res[2];
		
	}else
	{
			$calificacion="";
		$ejemplos="";
		$recurrente="";
		$hay=0;
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

<script type="text/javascript">

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

.style1 {font-size: 24px}
.style5 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000000; }
.style10 {
	color: #FFFFFF;
	font-weight: bold;
}
.style11 {
	color: #901e14;
	font-weight: bold;
	font-size: 24px;
}
.style12 {color: #FFFFFF}

</style>
</head>

<body onload="MM_preloadImages('images/b_cambio_r.png','images/b_administracion_r.png','images/b_log_out_r.png','images/icono_borrar_r.png')">
<form id="form1" name="form1" method="post" action="preguntas_360_new.php">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <tr>
            <?
      include_once("header.php");
    ?>
      </tr>
  </tr>
  <tr>
    <td height="698" valign="top" background=""><table width="1017" border="0" align="center" cellpadding="0" cellspacing="0">
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
              <td><div align="center" class="text_mediano"><span class="texto_contenido2">Evalúa de manera lógica y basándote en comportamientos actuales, no en experiencias pasadas.</span></div></td>
            </tr>
          </table>
        </div></td>
      </tr>
      <tr>
        <td><img src="images/spacer.gif" width="10" height="20" /><span class="style11">Evaluado</span><span class="style1">: <? echo"$nombre_evaluado";?> </span></td>
      </tr>
      <tr>
        <td><img src="images/spacer.gif" width="10" height="10" /></td>
      </tr>
      <tr>
        <td><table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="250" valign="top" bgcolor="#eeeeee"><div align="center">
                <table border="0">
                  <tr>
                    <td width="177" rowspan="2" valign="top" bgcolor="#CCCCCC"><img src="images/I<?echo"$siguiente";?>.jpg" width="177" height="122" /></td>
                    <td colspan="2" bgcolor="#901e14"><div align="left"><span class="nombre_admin"><span class="style10"><? echo"$area";?></span> <br />
                    </span></div></td>
                    </tr>
                  <tr>
                    <td colspan="2" valign="top" bgcolor="#CCCCCC" class="texto_contenido"><div align="left" class="text_mediano"><? echo"$descripcion";?></div>                      </td>
                    </tr>
                  <tr>
                    <td class="texto_contenido">&nbsp;</td>
                    <td width="576" bgcolor="#999999" class="texto_contenido"><span class="text_mediano style12">En base a tus interacciones a lo largo del <?php echo $revision ?>, como evaluas los comportamientos de esta persona en este Valor?</span></td>
                    <td bgcolor="#999999" class="texto_contenido"><div align="center">
                      <select name="calificacion" id="calificacion">
					  	<option value="" >-Selecciona-</option>
                        <option value="3" <? if($calificacion=="3")echo"selected";?>>Siempre lo pone en practica</option>
                        <option value="2" <? if($calificacion=="2")echo"selected";?>>Frecuentemente lo aplica</option>
                        <option value="1" <? if($calificacion=="1")echo"selected";?>>Raravez lo demuestra</option>
                        <option value="0" <? if($calificacion=="0")echo"selected";?>>Nunca lo pone en practica</option>
                      </select>
                    </div></td>
                    </tr>
                </table>
              </div>
              <table width="1000" height="350" border="0" align="center" cellspacing="0">
                <tr>
                  <td valign="top"><table width="100%" border="0">
                    <tr>
                      <td bgcolor="#901e14"><div align="center" class="style10">COMPETENCIAS</div></td>
                    </tr>
                    <tr>
                      <td><table width="100%" border="0">
                        <tr>
                          <td width="21%" bgcolor="#999999"><div align="center" class="style10"><? echo"$c1";?></div></td>
                          <td width="20%" bgcolor="#999999"><div align="center" class="style10"><? echo"$c2";?> </div></td>
                          <td width="23%" bgcolor="#999999"><div align="center" class="style10"><? echo"$c3";?></div></td>
                          <td width="18%" bgcolor="#999999"><div align="center" class="style10"><? echo"$c4";?> </div></td>
                          <td width="18%" bgcolor="#999999"><div align="center" class="style10"><? echo"$c5";?></div></td>
                        </tr>
                        <tr>
                          <td valign="top" bgcolor="#CCCCCC"><? echo"$c1_descripcion";?></td>
                          <td valign="top" bgcolor="#CCCCCC"><? echo"$c2_descripcion";?></td>
                          <td valign="top" bgcolor="#CCCCCC"><? echo"$c3_descripcion";?></td>
                          <td valign="top" bgcolor="#CCCCCC"><? echo"$c4_descripcion";?></td>
                          <td valign="top" bgcolor="#CCCCCC"><? echo"$c5_descripcion";?></td>
                        </tr>
                        <tr>
                          <td colspan="5" valign="top" bgcolor="#999999"><span class="style12">Menciona ejemplos especificos que soporten tu calificacion:<br />
                              <textarea name="ejemplo" cols="90" rows="3" id="ejemplo"><? echo"$ejemplos";?></textarea>
                          </span></td>
                          </tr>
                        <tr>
                          <td colspan="5" valign="top" bgcolor="#999999"><div align="center" class="style12">Haz observado que estos comportamientos fueron recurrentes o fue un caso aislado?
                            <input name="recurrente" type="radio" value="1" <? if($recurrente=="1")echo"checked";?>/>
                            Son recurrentes 
                            <input name="recurrente" type="radio" value="0" <? if($recurrente=="0")echo"checked";?>/>
                            Caso Aislado </div></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                  </tr>
              </table>
              <table width="745" border="0" align="center">
                <tr>
                  <td colspan="3"><div align="center">
                      <table width="100%" border="0" cellpadding="0">
                        <tr>
                          <td width="16%"><div align="right" class="style5">
                              <? if($siguiente!="1" ){?>
                            <input name="enviar" type="submit" class="boton_entrar" id="enviar" value="Anterior" onclick="document.form1.siguiente.value='<? echo $siguiente-1;?>'; return validaP();"/>
                              <?}?>
                          </div></td>
                          <td width="71%">&nbsp;</td>
                          <td width="13%"><span class="style5">
                            <? if($siguiente!=5){?>
                            <input name="p_guardar" type="hidden" id="p_guardar" value="<?echo $siguiente;?>" />
                            <input name="siguiente" type="hidden" id="siguiente" value="" />
                            <input name="hay" type="hidden" id="hay" value="<? echo $hay;?>" />
                            <input name="id_evaluado" type="hidden" id="id_evaluado" value="<? echo $id_evaluado;?>" />
                            <input name="enviar" type="submit" class="boton_entrar" id="enviar" value="Siguiente" onclick="document.form1.siguiente.value='<? echo $siguiente+1;?>'; return validaP();"/>
                            <? }?>
                            <? if($siguiente==5){?>
                            <input name="p_guardar" type="hidden" id="p_guardar" value="<?echo $siguiente;?>" />
                            <input name="siguiente" type="hidden" id="siguiente" value="" />
                            <input name="hay" type="hidden" id="hay" value="<? echo $hay;?>" />
                            <input name="id_evaluado" type="hidden" id="id_evaluado" value="<? echo $id_evaluado;?>" />

                            <input name="enviar" type="submit" class="boton_entrar" id="enviar" value="Siguiente" onclick="document.form1.siguiente.value='<? echo $siguiente+1;?>'; return validaC();"/>
                            <? }?>
                          </span></td>
                        </tr>
                        <tr>
                          <td colspan="3" ><table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
                              <tr>
                                <td height="5" background="images/franja_negra.jpg"><img src="images/franja_negra.jpg" width="5" height="9" /></td>
                              </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td colspan="3" class="texto_contenido2" ><div align="center">En caso de que tengas que abandonar la evaluaci&oacute;n, podras continuar en otra sesion sin perder tus datos, cada vez que presionas siguiente o anterior los datos quedan guardados. </div></td>
                        </tr>
                      </table>
                  </div></td>
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
            <td width="145"></td>
            <td><img src="images/spacer.gif" width="16" height="20" /></td>
            <td width="114"></td>
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
	  	if(document.form1.calificacion.value=="")
	  	{
			alert("Debe evaluar los comportamientos")
			document.form1.calificacion.focus();
			return false;
	  	}
	  	else
	  	{
			if(document.form1.ejemplo.value=="")
			{
				alert("Debe escribir ejemplos")
				document.form1.ejemplo.focus();
				return false;
			}else
			{
				if(document.form1.recurrente[0].checked || document.form1.recurrente[1].checked)
				{
					
					return true;
				}else
				{
					alert("Seleccione frecuencia observada")
					document.form1.recurrente[0].focus();
					return false;
				}
			}
	  	}
	  }
	  function validaC(){
	  	if(document.form1.calificacion.value=="")
	  	{
			alert("Debe evaluar los comportamientos")
			document.form1.calificacion.focus();
			return false;
	  	}
	  	else
	  	{
			if(document.form1.ejemplo.value=="")
			{
				alert("Debe escribir ejemplos")
				document.form1.ejemplo.focus();
				return false;
			}else
			{
				if(document.form1.recurrente[0].checked || document.form1.recurrente[1].checked)
				{
					
					form1.action="preguntas_fin_new.php";
					return true;
				}else
				{
					alert("Seleccione frecuencia observada")
					document.form1.recurrente[0].focus();
					return false;
				}
			}
	  	}
	  }
	  </script>
</body>
</html>
