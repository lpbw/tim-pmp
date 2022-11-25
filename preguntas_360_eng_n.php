<?



//ini_set("display_errors", 1);

//ini_set("track_errors", 1);

//ini_set("html_errors", 1);

session_start();

include "checar_sesion_admin.php";

include "coneccion_i.php";

$idU=$_SESSION['idU'];

$id_evaluado=$_POST['id_evaluado'];

$inicial=$siguiente;

$v_script="";
mysqli_num_rows(
$nombre_competencia="";

$nombre_conducta="";

$tipo="";

$grados_n[0]="1";

$grados_n[1]="2";

$grados_n[2]="3";

$grados_n[3]="4";

$grados_n[4]="5";



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
mysqli_num_rows(
	$id_evaluado= $_POST['id_evaluado'];

	$competencia = $_POST['competencia'];

	$comen = mysqli_real_escape_string($enlace,$_POST['comen']);

	$comenN = mysqli_real_escape_string($enlace,$_POST['comenN']);

	

	$fortaleza = $_POST['fortaleza'];

	$debilidad = $_POST['debilidad'];

	//DecimalFormat myFormatter2 = new DecimalFormat(pattern2);

	

			$tmysqli_num_rows(tencia);

			//echo  "t= $tt";

			$i=0;

			if($tt>1)

			{

				foreach($competencia as $f)

				{

					//echo"entra2";

					$calif=$_POST["ev".$f];

					$forta=mysqli_real_escape_string($enlace,$_POST["forta".$f]);

					$debi=mysqli_real_escape_string($enlace,$_POST["debi".$f]);

					

					$query= "insert into tex_calificaciones(id_evaluado, id_evaluador, id_competencia,  calificacion, revision, fortaleza, debilidad) values(".$id_evaluado.",".$idU.",".$f.",".$calif.", $revision , '".$forta."', '".$debi."')";		

					$resultado = mysqli_query($enlace,$query) or die("Error en operacion1:$query " . mysqli_error($enlace));

					$i++;

				}

				$listGStr= "insert into tex_calificaciones_preg(id_evaluado, id_evaluador, hacer, nohacer, revision, fortaleza, debilidad) values(".$id_evaluado.", ".$idU.",'$comen','$comenN', $revision, '$fortaleza', '$debilidad')";

				$resultado2 = mysqli_query($enlace,$listGStr) or die("Error en operacion1:$listGStr " . mysqli_error($enlace));

				

				$query= "update evaluadores set evaluado=1 where id_evaluado=".$id_evaluado." and  id_evaluador=".$idU." and revision=$revision";		

				$resultado = mysqli_query($enlace,$query) or die("Error en operacion1:$query " . mysqli_error($enlace));

				

				$consulta  = "SELECT count(evaluado) from evaluadores where id_evaluador=".$idU." and evaluado=0 and revision=$revision";

				$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)	

				if(@mysqli_num_rows($resultado)>=1)

				{

					$res=mysqli_fetch_row($resultado);

					$pendientes=$res[0];

					if($pendientes=="0"){

						$listGStr= "update planes set estatus_360=3 where id_empleado=$idU and revision=$revision";	

						$resultado = mysqli_query($enlace,$listGStr) or die("Error en operacion1:$listGStr " . mysqli_error($enlace));

					}

				}

				

				echo"<script>alert(\"Thank you, the avaluation has been saved.\"); window.location=\"evaluacion_360_eng.php\";</script>";

			}

}





			

	$consulta  = "select usuarios.nombre, usuarios.tipo from  usuarios  where id=$id_evaluado";

	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P12:$consulta ". mysqli_error($enlace) );

	//echo"$consulta";

	if(@mysqli_num_rows($resultado)>=1)

	{

		$res=mysqli_fetch_row($resultado);

		

		$nombre=$res[0];

		$tipo=$res[1];

		

	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Textron</title>

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

}mysqli_num_rows(



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

<? for($j=1; $j<11; $j++){?>

function selec<? echo $j?>(i){

		

	if(document.form1.forta<? echo $j?>[i].checked == true){document.form1.debi<? echo $j?>[i].checked = false;}	

	

}

function selec<? echo $j?><? echo $j?>(i){

		

	if(document.form1.debi<? echo $j?>[i].checked == true){document.form1.forta<? echo $j?>[i].checked = false;}	



}

<? }?>

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

<form id="form1" name="form1" method="post" action="preguntas_360_eng_n.php">

<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td background="images/bkg_admin.jpg"><table width="900" border="0" align="center" cellpadding="0" cellspacing="0">

      <tr>
mysqli_num_rows(
        <td><img src="images/header_1.jpg" width="900" height="107" /></td>

      </tr>

    </table></td>

  </tr>

  <tr>

    <td height="698" valign="top" background="images/bkg_fondo.jpg"><table width="900" border="0" align="center" cellpadding="0" cellspacing="0">

      <tr>

        <td><img src="images/spacer.gif" width="10" height="20" /></td>

      </tr>

      <tr>

        <td><div align="center">

          <table width="850" border="0" cellspacing="7" cellpadding="0">

            <tr>

              <td><div align="center" class="text_grande style1">360° Survey </div></td>

            </tr>

            <tr>

              <td><div align="center" class="text_mediano"><span class="texto_contenido2">Evaluate Powerful Beliefs and actions of each belief, identify 1 Strength and 1 Opportunity for Improvement.</span></div></td>

            </tr>

          </table>

        </div></td>

      </tr>

      <tr>

        <td><img src="images/spacer.gif" width="10" height="20" /><span class="style6"><? echo"$nombre ";?></span></td>

      </tr>

      <tr>

        <td><img src="images/spacer.gif" width="10" height="10" /></td>

      </tr>

      <tr>

        <td><table width="844" border="0" align="center" cellpadding="0" cellspacing="0">

          <tr>

            <td height="250" valign="top" bgcolor="#eeeeee"><div align="center">

			<iframe src="sesionActiva.php" width="200" height="25" scrolling="no" style="display:none"></iframe>

			<span class="style5">

              <input name="id_evaluado" type="hidden" id="id_evaluado" value="<? echo"$id_evaluado";?>" />

            </span>

              <?

$expecta="";

$tipo=2;

$consulta = "select id, nombre, descripcion, uno, dos, tres, cuatro, cinco, seis from tex_creencias_eng  order by id";



		$co=0;

		$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P13:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)	

		while(@mysqli_num_rows($resultado)>$co)

		{

			$res=mysqli_fetch_row($resultado);

?>

                <table width="792" border="0">

				<? 

				if($expecta!=$res[1]){

				$expecta=$res[1];

				?>

                  <tr>

                    <td width="602" height="35" bgcolor="#10253F"><div align="left"><span class="nombre_admin"><span class="text_mediano_blanco style6"><? echo $co+1?>.- <? echo"$res[1] ";?></span></span></div></td>

                  </tr>

				  <? }?>

                  <tr>

                    <td bgcolor="#CCCCCC" class="texto_contenido"><div align="left" class="text_mediano"><? echo"$res[2]";?></div></td>

                  </tr>

                  <tr>

                    <td class="texto_contenido"><table width="100%" border="0" align="center" cellspacing="0">

                      <tr>

                        

                        <td height="14" colspan="8" bgcolor="#CCCCCC" class="usuario"><table width="25%" border="0" align="center">

  <tr>

    <td colspan="7"><div align="center" class="texto_logout"><img src="images/valoresencuesta_eng.png" height="55" width="211" border="0"></div></td>

    </tr>

  <tr align="center">

    <td>-3</td>

    <td>-2</td>

    <td>-1</td>

    <td>0</td>

    <td>+1</td>

    <td>+2</td>

    <td>+3</td>

  </tr>

  <tr bgcolor="#FFFFFF" align="center">

    <td class="style6"><div align="center">

                            <input name="ev<? echo"$res[0]";?>" type="radio" value="-3" />

                        </div></td>

                        <td class="style6"><div align="center">

                            <input name="ev<? echo"$res[0]";?>" type="radio" value="-2" />

                        </div></td>

                        <td class="style6"><div align="center">

                            <input name="ev<? echo"$res[0]";?>" type="radio" value="-1"/>

                        </div></td>

                        <td class="style6"><div align="center">

                            <input name="ev<? echo"$res[0]";?>" type="radio" value="0" />

                        </div></td>

						<td class="style6"><div align="center">

                            <input name="ev<? echo"$res[0]";?>" type="radio" value="1" />

                        </div></td>

						<td class="style6"><div align="center">

                            <input name="ev<? echo"$res[0]";?>" type="radio" value="2" />

                        </div></td>

						<td class="style6"><div align="center">

                            <input name="ev<? echo"$res[0]";?>" type="radio" value="3" />

                        </div></td>

  </tr>

</table>

                      </tr>

                     

                     	

				 <?	  		

		

if($res[7]!=""){ $add="|| form1.forta".$res[0]."[4].checked"; $add2="|| form1.debi".$res[0]."[4].checked";}

			

				$v_script=$v_script."(form1.ev".$res[0]."[0].checked || form1.ev".$res[0]."[1].checked || form1.ev".$res[0]."[2].checked || form1.ev".$res[0]."[3].checked || form1.ev".$res[0]."[4].checked || form1.ev".$res[0]."[5].checked || form1.ev".$res[0]."[6].checked ) && (form1.forta".$res[0]."[0].checked || form1.forta".$res[0]."[1].checked || form1.forta".$res[0]."[2].checked || form1.forta".$res[0]."[3].checked $add) && (form1.debi".$res[0]."[0].checked || form1.debi".$res[0]."[1].checked || form1.debi".$res[0]."[2].checked || form1.debi".$res[0]."[3].checked $add2) && ";

				

		?>	

                      

                      <tr bgcolor="#F1F2F4">

                       

                        <td width="75%" colspan="8"  class="style9"><div align="left" class="texto_contenido"><span class="text_mediano"><? echo"";?></span> <span class="style5">

                            <input name="competencia[]" type="hidden" id="competencia" value="<? echo"$res[0]";?>" />

                        </span>

                            <table width="100%" border="0" align="center" cellpadding="0">

                              

                              <tr>

                               

                                <td width="80%" bgcolor="#10253F" class="usuario"><div align="center"><span class="text_mediano_blanco">Actions</span></div></td>

                                <td width="10%" bgcolor="#10253F" class="usuario"><div align="center"><span class="text_mediano_blanco"><img src="images/icono_s3.png" border="0" title="Strength"></span></div></td>

                                <td width="10%" bgcolor="#10253F" class="usuario"><div align="center"><span class="text_mediano_blanco"><img src="images/icono_w3.png" border="0" title="Opportunity for improvement"></span></div></td>

                              </tr>

                              <tr bgcolor="#ffffff">

                                

                                <td bgcolor="#FFFFFF" class="text_mediano"><div align="left"><? echo"$res[3]";?> </div></td>

                                <td bgcolor="#FFFFFF" class="text_mediano" align="center"><input name="forta<? echo"$res[0]";?>" type="radio" value="<? echo"$res[3]";?>" onclick="selec<? echo"$res[0]";?>(0)" /></td>

                                <td bgcolor="#FFFFFF" class="text_mediano" align="center"><input name="debi<? echo"$res[0]";?>" type="radio" value="<? echo"$res[3]";?>" onclick="selec<? echo"$res[0]";?><? echo"$res[0]";?>(0)" /></td>

                              </tr>

                              <tr bgcolor="#F1F2F4">

                               

                                <td bgcolor="#F1F2F4" class="text_mediano"><div align="left"><? echo"$res[4]";?></div></td>

                                <td bgcolor="#F1F2F4" class="text_mediano" align="center"><input name="forta<? echo"$res[0]";?>" type="radio" value="<? echo"$res[4]";?>" onclick="selec<? echo"$res[0]";?>(1)" /></td>

                                <td bgcolor="#F1F2F4" class="text_mediano" align="center"><input name="debi<? echo"$res[0]";?>" type="radio" value="<? echo"$res[4]";?>" onclick="selec<? echo"$res[0]";?><? echo"$res[0]";?>(1)" /></td>

                              </tr>

                              <tr bgcolor="#F1F2F4">

                                

                                <td bgcolor="#FFFFFF" class="text_mediano"><div align="left"><? echo"$res[5]";?></div></td>

                                <td bgcolor="#FFFFFF" class="text_mediano" align="center"><input name="forta<? echo"$res[0]";?>" type="radio" value="<? echo"$res[5]";?>" onclick="selec<? echo"$res[0]";?>(2)" /></td>

                                <td bgcolor="#FFFFFF" class="text_mediano" align="center"><input name="debi<? echo"$res[0]";?>" type="radio" value="<? echo"$res[5]";?>" onclick="selec<? echo"$res[0]";?><? echo"$res[0]";?>(2)" /></td>

                              </tr>

							  <tr bgcolor="#F1F2F4">

                               

                                <td bgcolor="#F1F2F4" class="text_mediano"><div align="left"><? echo"$res[6]";?></div></td>

                                <td bgcolor="#F1F2F4" class="text_mediano" align="center"><input name="forta<? echo"$res[0]";?>" type="radio" value="<? echo"$res[6]";?>" onclick="selec<? echo"$res[0]";?>(3)" /></td>

							    <td bgcolor="#F1F2F4" class="text_mediano" align="center"><input name="debi<? echo"$res[0]";?>" type="radio" value="<? echo"$res[6]";?>" onclick="selec<? echo"$res[0]";?><? echo"$res[0]";?>(3)" /></td>

							  </tr>

							  <? if($res[7]!=""){?>

							  <tr bgcolor="#F1F2F4">

                                <td bgcolor="#FFFFFF" class="text_mediano"><div align="left"><? echo"$res[7]";?></div></td>

                                <td bgcolor="#FFFFFF" class="text_mediano" align="center"><input name="forta<? echo"$res[0]";?>" type="radio" value="<? echo"$res[7]";?>" onclick="selec<? echo"$res[0]";?>(4)" /></td>

							    <td bgcolor="#FFFFFF" class="text_mediano" align="center"><input name="debi<? echo"$res[0]";?>" type="radio" value="<? echo"$res[7]";?>" onclick="selec<? echo"$res[0]";?><? echo"$res[0]";?>(4)" /></td>

							  </tr>

							  <? }?>

                            </table>

                        </div></td>

                        

                       

                      </tr>

                      <tr bgcolor="#F1F2F4">

                        <td  class="style9">&nbsp;</td>

                        <td class="style6">&nbsp;</td>

                        <td class="style6">&nbsp;</td>

                        <td class="style6">&nbsp;</td>

                        <td class="style6">&nbsp;</td>

                        <td class="style6">&nbsp;</td>

						<td class="style6">&nbsp;</td>

                        <td class="style6">&nbsp;</td>

                      </tr>

                      <?

				

				 

			$co++;	

			}

			

		//}

	//$cant=v_script.length()-3;

	$temp=trim($v_script, '&& ');

	//String temp=v_script.substring(0,cant);

	$v_script=$temp;//.")"

?>

                    </table></td>

                  </tr>

                  <tr>

                    <td class="texto_contenido"><table width="773" border="0">

                      <tr>

                        <td width="712" height="35" bgcolor="#999999"><div align="left" class="text_mediano_blanco">

                            <div align="center">In the following boxes you should make objective comments and help the person to clearly identify why it is a strength and why it should improve.</div>

                        </div></td>

                      </tr>



                      <tr>

                        <td class="texto_contenido"><table width="778" border="0" align="center" cellspacing="0">

                            <tr>

                              <td width="37%" height="18" bgcolor="#CCCCCC" class="usuario">Behaviors you demonstrate at work and I would like to continue having</td>

                              <td width="36%" bgcolor="#CCCCCC" class="usuario">I recommend you do less than </td>

                            </tr>

                            <?	  		

	

	

	

		$res=mysqli_fetch_row($resultado);

		$v_script=$v_script." && (form1.comen.value!=\"\" && form1.comenN.value!=\"\" && form1.fortaleza.value!=\"\" && form1.debilidad.value!=\"\")  ";

		

		

		?> <tr >

                              <td class="texto_tareas" align="center">Select 1 Belief that you identify as strength.</td>

                              <td class="texto_tareas" align="center">Select 1 Belief that you identify as opportunity for Improvement</td>

                            </tr>

                          <tr >

                              <td class="style6" align="center"><select id="fortaleza" name="fortaleza">

									<option value="0">--Select Strength--</option>

								<?

								$query8="SELECT id, nombre FROM tex_creencias_eng";

								$resultado8=mysqli_query($enlace,$query8)or die("Error al consultar $query8: ".mysqli_error($enlace));

								while($res8=mysqli_fetch_assoc($resultado8)){

								?>

									<option value="<? echo $res8['id'];?>"><? echo $res8['nombre'];?></option>

								<? }?>

								</select>	</td>

                              <td class="style6" align="center"><select id="debilidad" name="debilidad">

									<option value="0">--Select Opportunity for improvement--</option>

								<?

								$query="SELECT id, nombre FROM tex_creencias_eng";

								$consulta=mysqli_query($enlace,$query)or die("Error al consultar departamentos: ".mysqli_error($enlace));

								for($i=0;$i<@mysqli_num_rows($consulta);$i++){

									$dep=mysqli_fetch_row($consulta);

								?>

									<option <? if($usuario[7]==$dep[0]) echo"selected=\"selected\""?> value="<? echo "$dep[0]";?>"><? echo "$dep[1]";?></option>

								<? }?>

								</select></td>

                            </tr>

						    <tr  >

                              <td class="texto_tareas"><div align="center">

                                  why? 

								  <textarea name="comen" id="comen" cols="40" rows="5"></textarea>

                              </div></td>

                              <td class="texto_tareas"><div align="center">

                                  why? <textarea name="comenN" id="comenN" cols="40" rows="5"></textarea>

                              </div></td>

                            </tr>

                           

                        </table></td>

                      </tr>

                    </table></td>

                  </tr>

                </table>

              </div>

             

              <table width="745" border="0" align="center">

                <tr>

                  <td colspan="3"><div align="center">

                      <table width="100%" border="0" cellpadding="0">

                        <tr>

                          <td width="16%"><div align="right" class="style5"></div></td>

                          <td width="71%">&nbsp;</td>

                          <td width="13%"><span class="style5">

                            <input name="enviar" type="submit" class="boton_entrar" id="enviar" value="Guardar" onclick=" return validaP();"/>

                          </span></td>

                        </tr>

                        <tr>

                          <td colspan="3" ><table width="400" border="0" align="center" cellpadding="0" cellspacing="0">

                              <tr>

                                <td height="5" background="images/franja_negra.jpg">&nbsp;</td>

                              </tr>

                          </table></td>

                        </tr>

                        <tr>

                          <td colspan="3" class="texto_contenido2" ><div align="center"></div></td>

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

	  	if(<? echo"$v_script";?>){

	  	



			

			return true;

	  	}

	  	else

	  	{

			alert("Must evaluate all competencies, strengths and Opportunity for improvement, and final comments")

			return false;

	  	}

	  }

	 

	  </script>

</body>

</html>

