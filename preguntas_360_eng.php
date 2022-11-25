<?

//ini_set("display_errors", 1);
//ini_set("track_errors", 1);
//ini_set("html_errors", 1);
//session_start();
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
	$nohay= $_POST['nohay'];
	//DecimalFormat myFormatter2 = new DecimalFormat(pattern2);
	if($p_guardar!="p99")
	{
			$tt=sizeof($evaluado_id);
			//echo  "t= $tt";
			$i=0;
			if($tt>1)
			{
				foreach($evaluado_id as $f)
				{
					//echo"entra2";
					$calif=$_POST["ev".$f];
					if($a_sql=="i")
						$query= "insert into tex_calificaciones(id_evaluado, id_evaluador, id_competencia,  calificacion, revision) values(".$evaluado_id[$i].",".$idU.",".$p_guardar.",".$calif.", $revision)";		
					else
						$query= "update tex_calificaciones set calificacion=$calif where id_evaluado=$f and  id_evaluador=$idU and id_competencia=$p_guardar and revision=$revision";  
							
					//echo"$query";
					$resultado = mysqli_query($enlace,$query) or die("Error en operacion1:$query " . mysqli_error($enlace));
					$i++;
				}
			}else
			{
					if($tt==1 && $nohay==0)
					{
					$calif=$_POST["ev".$evaluado_id[$i]];
					if($a_sql=="i")
						$query= "insert into tex_calificaciones(id_evaluado, id_evaluador, id_competencia,  calificacion, revision) values(".$evaluado_id[$i].",".$idU.",".$p_guardar.",".$calif.", $revision)";		
					else
						$query= "update tex_calificaciones set calificacion=$calif where id_evaluado=$evaluado_id[$i] and id_evaluador=$idU and id_competencia=$p_guardar and revision=$revision";  
							
					//echo"$query";
					$resultado = mysqli_query($enlace,$query) or die("Error en operacion de uno:$query " . mysqli_error($enlace));
					}
			}	
	}	
}

$n_sql="i";
$contador_comp=0;
$contador_evaluados=0;

		$consulta = "select tex_competencias_ing.id, tex_competencias_ing.nombre, tex_expectativas.ingles as exp, uno, tres, cinco, descripcion  from tex_competencias_ing inner join tex_expectativas on tex_competencias_ing.id_expectativa=tex_expectativas.id order by tex_competencias_ing.id";
		$co=0;
		$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P13:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)	
		while(@mysqli_num_rows($resultado)>$co)
		{
			$res=mysqli_fetch_row($resultado);

			$competencias[$co]= $res[0];
			$competencias_nombre[$co]= $res[1];
			$competencias_desc[$co]=  $res[6];
			$competencias_exp[$co]=  $res[2];
			$grados1[$co]= $res[3];
			$grados3[$co]= $res[4];
			$grados5[$co]= $res[5];
			$co++;	
		}	
		
		for($o=$inicial ;$o<$contador_comp; $o++){
			if($inicial!=$siguiente)
				$siguiente=$siguiente+1;
		
	$consulta  = "select usuarios.nombre, usuarios.id from  usuarios inner join evaluadores on usuarios.id=evaluadores.id_evaluado where id_evaluador=$idU and revision=$revision and tipo in (SELECT id_tipo from tex_competencias_ing inner join tex_competencia_tipo on tex_competencias_ing.id=tex_competencia_tipo.id_competencia where id_competencia=$competencias[$siguiente])";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)	
	if(@mysqli_num_rows($resultado)>=1)
	{
		$res=mysqli_fetch_row($resultado);
		$contador_evaluados++;
		$o=$contador_comp;
		
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
<form id="form1" name="form1" method="post" action="preguntas_360_eng.php">
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
              <td><div align="center" class="text_grande style1">360° Survey</div></td>
            </tr>
            <tr>
              <td><div align="center" class="text_mediano"><span class="texto_contenido2">Evaluate in a logical manner and based on current behavior, not past experiences.</span></div></td>
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
                <table width="792" border="0">
                  <tr>
                    <td bgcolor="#FFFFFF"><div align="right"><? echo $competencias[$siguiente] ?>-30</div></td>
                  </tr>
                  <tr>
                    <td width="602" bgcolor="#999999"><div align="left"><span class="nombre_admin"><span class="text_mediano_blanco style6"><? echo"$competencias_exp[$siguiente]";?></span><br />
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="text_mediano_blanco"><? echo"$competencias_nombre[$siguiente]"; ?></span></div></td>
                  </tr>
                  <tr>
                    <td bgcolor="#CCCCCC" class="texto_contenido"><div align="left" class="text_mediano"><? echo"$competencias_desc[$siguiente]";?></div></td>
                  </tr>
                  <tr>
                    <td class="texto_contenido">&nbsp;</td>
                  </tr>
                </table>
              </div>
              <table width="795" height="350" border="0" align="center" cellspacing="0">
                <tr>
                  <td width="464" valign="top"><table width="464" border="0" align="center" cellspacing="0">
                      <tr>
                        <td  height="18" rowspan="2" bgcolor="#CCCCCC" class="usuario">Partner (s) </td>
                        <td width="26%" height="9" colspan="5" bgcolor="#CCCCCC" class="usuario"><div align="center" class="texto_logout">Behaviors </div></td>
                      </tr>
                      <tr>
                        <td height="9" bgcolor="#CCCCCC" class="usuario"><div align="center">1</div></td>
                        <td bgcolor="#CCCCCC" class="usuario"><div align="center">2</div></td>
                        <td bgcolor="#CCCCCC" class="usuario"><div align="center">3</div></td>
                        <td bgcolor="#CCCCCC" class="usuario"><div align="center">4</div></td>
                        <td bgcolor="#CCCCCC" class="usuario"><div align="center">5</div></td>
                      </tr>
                      <?	  		
		

			$query = "select usuarios.nombre, usuarios.id from  usuarios inner join evaluadores on usuarios.id=evaluadores.id_evaluado where id_evaluador=$idU and revision=$revision and tipo in (SELECT id_tipo from tex_competencias_ing inner join tex_competencia_tipo on tex_competencias_ing.id=tex_competencia_tipo.id_competencia where id_competencia=$competencias[$siguiente])";
			//echo $query;
			$resp="";
			$c=0;
			$v_script="if( ";
			$resultado = mysqli_query($enlace,$query) or die("La consulta fall&oacute;P12:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)	
			while(@mysqli_num_rows($resultado)>$c)
			{
				$res=mysqli_fetch_row($resultado);
				$v_script=$v_script."(form1.ev".$res[1]."[0].checked || form1.ev".$res[1]."[1].checked || form1.ev".$res[1]."[2].checked || form1.ev".$res[1]."[3].checked || form1.ev".$res[1]."[4].checked) && ";
				
				
				$q_Q = "select calificacion from tex_calificaciones where id_evaluador=$idU and id_evaluado=$res[1]  and id_competencia=$competencias[$siguiente] and revision=$revision";
				$resultado2 = mysqli_query($enlace,$q_Q) or die("La consulta fall&oacute;P18:$query $q_Q ". mysqli_error($enlace) );//. mysqli_error($enlace)
				if(@mysqli_num_rows($resultado2)>0)
				{
					$res2=mysqli_fetch_row($resultado2);
					$resp=$res2[0];
					$n_sql="u";
				}else
				{
					$n_sql="i";
					$resp="";
				}
				
				if($color==1)
				{
					$color++;
				?>
                      <tr bgcolor="#ffffff">
                        <?
				}
				else
				{
					$color--;
				?>
                      </tr>
                    <tr bgcolor="#F1F2F4">
                        <?
				}
				?>
                        <td width="54%"  class="style9"><div align="left" class="texto_contenido"><span class="text_mediano"><? echo"$res[0]";?></span> <span class="style5">
                            <input name="evaluado_id[]" type="hidden" id="evaluado_id" value="<? echo"$res[1]";?>" />
                        </span></div></td>
                      <td class="style6"><div align="center">
                            <input name="ev<? echo"$res[1]";?>" type="radio" value="1" <? if($resp=="1") echo"checked";?>/>
                        </div></td>
                      <td class="style6"><div align="center">
                            <input name="ev<? echo"$res[1]";?>" type="radio" value="2" <? if($resp=="2") echo"checked";?>/>
                        </div></td>
                      <td class="style6"><div align="center">
                            <input name="ev<? echo"$res[1]";?>" type="radio" value="3" <? if($resp=="3") echo"checked";?>/>
                        </div></td>
                      <td class="style6"><div align="center">
                            <input name="ev<? echo"$res[1]";?>" type="radio" value="4" <? if($resp=="4") echo"checked";?>/>
                        </div></td>
                      <td class="style6"><div align="center">
                            <input name="ev<? echo"$res[1]";?>" type="radio" value="5" <? if($resp=="5") echo"checked";?>/>
                        </div></td>
                    </tr>
                      <?
				
				 
			$c++;	
			}
			if($c==0)
			{
			?>
                        <td colspan="6"  class="style9"><div align="left" class="text_mediano">
                          <p>&nbsp;</p>
                          <p>This behavior does not apply to your coordinator, click Next to continue<span class="style5">
                            <input name="nohay" type="hidden" id="nohay" value="1" />
                            </span> </p>
                        </div>                            </td>
                      </tr>
                      <?
					  $v_script=$v_script."1<2";
			}else
			{
			?>
                        <td colspan="6"  class="style9">
                          
                            <input name="nohay" type="hidden" id="nohay" value="0" />
                            
                                                   </td>
                      </tr>
                      <?
			}
		//}
	//$cant=v_script.length()-3;
	$temp=trim($v_script, '&& ');
	//String temp=v_script.substring(0,cant);
	$v_script=$temp.")";
?>
                  </table></td>
                  <td width="273" valign="top"><div align="center">
                      <table width="100%" border="0" align="center" cellpadding="0">
                        <tr>
                          <td colspan="2" class="nombre_admin" scope="row"><div align="left"><? echo"$nombre_conducta";?><span class="style5">
                              <input name="siguiente" type="hidden" id="siguiente" value="" />
                              </span><span class="style5">
                              <input name="p_guardar" type="hidden" id="p_guardar" value="<? echo"$competencias[$siguiente]";?>" />
                              </span>
                              <input type="hidden" name="n_sql" value="<? echo"$n_sql";?>" />
                          </div></td>
                        </tr>
                        <tr>
                          <td width="15%" bgcolor="#CCCCCC" class="usuario" scope="row"><div align="center">Level</div></td>
                          <td bgcolor="#CCCCCC" class="usuario"><div align="center">Behavior</div></td>
                        </tr>
                        <tr bgcolor="#ffffff">
                          <td bgcolor="#FFFFFF" class="text_mediano" scope="row"><div align="center">1</div></td>
                          <td bgcolor="#FFFFFF" class="text_mediano"><div align="left"><? echo"$grados1[$siguiente]";?> </div>
                              <div align="center"></div></td>
                        </tr>
                        <tr bgcolor="#F1F2F4">
                          <td bgcolor="#F1F2F4" class="text_mediano" scope="row"><div align="center">3</div></td>
                          <td bgcolor="#F1F2F4" class="text_mediano"><div align="left"><? echo"$grados3[$siguiente]";?></div></td>
                        </tr>
                        <tr bgcolor="#F1F2F4">
                          <td bgcolor="#FFFFFF" class="text_mediano" scope="row"><div align="center">5</div></td>
                          <td bgcolor="#FFFFFF" class="text_mediano"><div align="left"><? echo"$grados5[$siguiente]";?></div></td>
                        </tr>
                      </table>
                  </div></td>
                </tr>
              </table>
              <table width="745" border="0" align="center">
                <tr>
                  <td colspan="3"><div align="center">
                      <table width="100%" border="0" cellpadding="0">
                        <tr>
                          <td width="16%"><div align="right" class="style5">
                              <? if($siguiente!="0" ){?>
                            <input name="enviar" type="submit" class="boton_entrar" id="enviar" value="&lt;&lt; Previuos" onclick="document.form1.siguiente.value='<? echo $siguiente-1;?>'; return validaP();"/>
                              <?}?>
                          </div></td>
                          <td width="71%">&nbsp;</td>
                          <td width="13%"><span class="style5">
                            <? if($siguiente!=$co-1){?>
                            <input name="enviar" type="submit" class="boton_entrar" id="enviar" value="Next &gt;&gt;" onclick="document.form1.siguiente.value='<? echo $siguiente+1;?>'; return validaP();"/>
                            <? }?>
                            <? if($siguiente==$co-1){?>
                            <input name="enviar" type="submit" class="boton_entrar" id="enviar" value="Next &gt;" onclick="document.form1.siguiente.value='<? echo $siguiente+1;?>'; return validaC();"/>
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
                          <td colspan="3" class="texto_contenido2" ><div align="center">In case you have to leave the evaluation, you can continue in another session without losing your data, each time you press next or previous data is saved. </div></td>
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

			
			
		form1.action="preguntas2_360_eng.php";
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
