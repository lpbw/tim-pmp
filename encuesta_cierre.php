<?
session_start();
//include "checar_sesion_admin.php";
include "coneccion_i.php";
$id=$_GET['id'];
$revision=$_GET['revision'];
if($_POST['button']=="Enviar"){
	$id=$_POST['id'];
	$p1=$_POST['p1'];
	$p2=$_POST['p2'];
	$p3=$_POST['p3'];
	$revision=$_POST['revision'];
	$comentarios=$_POST['comentarios'];
	$query="insert into encuesta_cierre(id_empleado, p1, p2, p3, comentarios, revision) values ($id, $p1, $p2, $p3, '$comentarios', $revision)";
	$consulta=mysqli_query($enlace,$query)or die("Error al actualizar $query: ".mysqli_error($enlace));
	$query="update planes set retro=1 where id_empleado=$id and $revision=$revision";
	$consulta=mysqli_query($enlace,$query)or die("Error al actualizar password: ".mysqli_error($enlace));
	
		echo"<script>alert(\"Información Enviada!\");window.parent.location=\"menu.php\";</script>";
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bell</title>
<script>
	function validar(){
		if(document.form1.pass.value!=document.form1.pass_conf.value){
			alert("No coincide las contraseñas!\nFavor de ingresar nuevamente los datos.");
			document.form1.reset();
			document.form1.pass.focus;
		}else
			document.form1.submit();
	}
</script>
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
</head>

<body onLoad="document.form1.pass.focus();">
<form id="form1" name="form1" method="post" action="">

<table width="537" height="250" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="6%">&nbsp;</td>
        <td width="85%" bgcolor="#FFFFFF"><table width="434" border="0" align="center" cellpadding="0" cellspacing="4">
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
		  	<td bgcolor="#999999">
			  <div align="center" class="text_mediano_blanco">El Ciclo de Gestión del Desempeño <? echo $revision;?> ha finalizado. <br />
			    Para concluir nuestro proceso, es necesario completar la siguiente tarea:</div>			</td>
		  </tr>
		  <tr>
            <td><div align="right" class="usuario">
              <div align="left" class="text_mediano">1.- Recibiste retroalimentación de tu resultado en Objetivos?</div>
            </div>              </td>
            </tr>
		  <tr>
		    <td class="text_mediano"><div align="center">Si
		      <input name="p1" type="radio" value="1" />
		      No
		      <input name="p1" type="radio" value="0" />
		      </div></td>
		    </tr>
		  <tr>
		    <td class="text_mediano">2.-Recibiste retroalimentación de tu Evaluación 360°?</td>
		    </tr>
		  <tr>
		    <td class="text_mediano"><div align="center">Si
		      <input name="p2" type="radio" value="1" />
		      No
  <input name="p2" type="radio" value="0" />
		      </div></td>
		    </tr>
		  <tr>
		    <td class="text_mediano">3.-	Recibiste calificación final de desempeño?</td>
		    </tr>
		  <tr>
		    <td class="text_mediano"><div align="center">Si
		      <input name="p3" type="radio" value="1" />
		      No
  <input name="p3" type="radio" value="0" />
		      </div></td>
		    </tr>
		  <tr>
		    <td class="text_mediano"><div align="center">Comentarios</div></td>
		    </tr>
		  <tr>
		    <td class="text_mediano"><div align="center">
		      <p>
		        <textarea name="comentarios" cols="50" rows="3" id="comentarios"></textarea>
		        </p>
		      <p>Con el  objetivo de: hacer &nbsp;mejoras a nuestro sistema de PMP y apoyar a todos  aquellos lideres en el proceso de retroalimentación. </p>
		      <p>
		        <input name="id" type="hidden" id="id" value="<?echo"$id";?>" />
		        <input name="revision" type="hidden" id="revision" value="<?echo"$revision";?>" />
		        Gracias por  tu contribución. </p>
		      TIM PMP&nbsp;</div></td>
		    </tr>
		  <tr>
            <td><label>
                  <div align="center">
                    <input name="button" type="submit" onclick="javascript:validar();" class="boton" id="button" value="Enviar" />
                  </div>                  </label></td>
            </tr>
        </table></td>
        <td width="9%">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td><div align="center" class="texto_chico"><hr />Recursos Humanos  -  Desarrollo Organizacional</div></td>
  </tr>
</table>
</form>
</body>
</html>