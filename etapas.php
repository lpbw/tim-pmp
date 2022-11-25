<?
	session_start();
	include "checar_sesion_admin.php";
	include "coneccion_i.php";
	$id=1;
	
	if($_POST['edit']=="Actualizar"){
		$revision=$_POST['revision'];
		$etapa=$_POST['etapa'];
		$etapa_360=$_POST['etapa_360'];
		$cuantos=$_POST['cuantos'];
		$min=$_POST['min'];
		$eliminar=$_POST['eliminar'];
		$retro=$_POST['retro'];
		$id=$_POST['id'];
		
		$query="UPDATE etapa SET revision='$revision', etapa='$etapa', etapa_360=$etapa_360, cuantos=$cuantos, eliminar=$eliminar, min=$min, retro=$retro WHERE id=$id";
		$consulta=mysqli_query($enlace,$query)or die("Fallo al actualizar:$query ".mysqli_error($enlace));
		echo"<script>alert(\"Datos actualizados\");</script>";
	}
	
	if($_POST['enviar']=="Enviar"){
		$revision=$_POST['revision'];
		$consulta  = "SELECT email, nombre, id, contra FROM usuarios where tipo=4 and id in (select id_evaluador from evaluadores where revision=$revision)";
		$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta ". mysqli_error($enlace) );//. mysqli_error($enlace)	
		$count=1;
		while(@mysqli_num_rows($resultado)>=$count)
		{
			$res=mysqli_fetch_row($resultado);
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
					<td><div align=\"left\" class=\"text_grande\">Dear $res[1] </div></td>
			  </tr>
			  <tr>
					<td><p>&nbsp;</p>
					  <p>You have been selected to evaluate an employee of Bell Mexico, via a tool \"360 ° Survey \”</p>
					  <p align=\"left\">Click on <a href=\"http://www.tim-pmp.com\" class=\"boton style1\">http://www.tim-pmp.com</a> and use the following user and password:</p>
					<p align=\"left\">User: $res[2] </p>
					<p align=\"left\">Password: $res[3]</p></td>
			  </tr>
			  <tr>
					<td class=\"texto_chico\">
					<div align=\"center\">Please be sure to complete the survey by December 3rd<br>HR  Lic. Gloria Martinez gmartinez01@bellflight.com </div></td>
			  </tr>
			</table>
			</body>
			</html>";
			$Subject = "TIM-PMP - 360 Survey ";
			$em=$res[0];
			//$em="mario.garcia@bluewolf.com.mx";
			$success2 = mail($em, $Subject, $Body, "From: TIM-PMP 360 Survey<$EmailFrom>\nContent-type: text/html; charset=utf-8\n");
			
			$count++;
		}
		$em2="gmartinez01@bellflight.com";
		$success2 = mail($em2, $Subject, $Body, "From: TIM-PMP 360 Survey<$EmailFrom>\nContent-type: text/html; charset=utf-8\n");
	echo"<script>alert(\"Email enviado\");</script>";
	}
	
	$query="SELECT * FROM etapa where id=$id";
	$result=mysqli_query($enlace,$query) or die("Falla la consulta 1:$query ". mysqli_error($enlace));
	$et=mysqli_fetch_row($result);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
<style type="text/css">
<!--
.style1 {font-size: 24px}
-->
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>
	function validar(){
		if(document.form1.jefe.selectedIndex==0 || document.form1.depto.selectedIndex==0 || document.form1.jefe_360.selectedIndex==0){
			alert("Debes llenar todos los campos");
			return false;
		}
		return true;
	}
</script>
</head>

<body>
	<table width="400" border="0" align="center">
		<tr align="center">
			<td bgcolor="#00475c" class="text_mediano_blanco style1">Etapa</td>
		</tr>
		<tr>
			<td>
				<form name="form1" id="form1" action="" method="post">
					<table width="100%" border="1" cellpadding="1" cellspacing="0" bordercolor="#CCCCCC">
						<tr>
							<th width="35%" align="right" valign="middle" class="tit_1" scope="row">Revisión</th>
							<td>
								<input required name="revision" type="text" id="revision" value="<? echo "$et[1]";?>" size="30" maxlength="100" />
								<input name="id" type="hidden" id="id" value="1" />							</td>
						</tr>
						<tr>
							<th valign="middle" align="right" class="tit_1" scope="row">Etapa</th>
							<td><select name="etapa" id="etapa">
							 <option value="0" <? if($et[2]=="0") echo"selected";?>>Ninguna</option>
							  <option value="1" <? if($et[2]=="1") echo"selected";?>>Planeación</option>
							  <option value="2" <? if($et[2]=="2") echo"selected";?>>Revisión Intermedia</option>
							  <option value="3" <? if($et[2]=="3") echo"selected";?>>Revisión Final</option>
							  <option value="4" <? if($et[2]=="4") echo"selected";?>>Ver Resultados</option>
							  </select>							</td>
						</tr>
						<tr>
							<th valign="middle" align="right" class="tit_1" scope="row">Etapa 360 </th>
							<td><select name="etapa_360" id="etapa_360">
                              <option value="0" <? if($et[3]=="0") echo"selected";?>>Ninguna</option>
                              <option value="1" <? if($et[3]=="1") echo"selected";?>>Selección de Evaluadores</option>
                              <option value="2" <? if($et[3]=="2") echo"selected";?>>Contestar Encuesta</option>
                            </select></td>
						</tr>
						<tr>
						  <th valign="middle" align="right" class="tit_1" scope="row">Encuesta Cierre </th>
						  <td><select name="retro" id="retro">
						    <option value="0" <? if($et[7]=="0") echo"selected";?>>No Activa</option>
						    <option value="1" <? if($et[7]=="1") echo"selected";?>>Activa</option>
						    </select>
						  </td>
					  </tr>
						<tr>
						  <th valign="middle" align="right" class="tit_1" scope="row">Max de evaluadores  </th>
						  <td><input name="cuantos" required="required" id="cuantos" value="<? echo "$et[4]";?>" type="text" size="25" maxlength="50" /></td>
						</tr>
						<tr>
						  <th valign="middle" align="right" class="tit_1" scope="row">Min de evaluadores </th>
						  <td><input name="min" required="required" id="min" value="<? echo "$et[6]";?>" type="text" size="25" maxlength="50" /></td>
					  </tr>
						<tr>
							<th valign="middle" align="right" class="tit_1" scope="row">Permitidos Borrar </th>
							<td><input name="eliminar" required="required" id="eliminar" value="<? echo "$et[5]";?>" type="text" size="25" maxlength="50" /></td>
						</tr>
						<tr>
							<td colspan="2">
								<div align="center"><input  name="edit" id="edit" type="submit" align="middle" class="boton" value="Actualizar" /></div>							</td>
						</tr>
						<tr>
						  <td colspan="2"><p>&nbsp;</p>
					      <p>&nbsp;</p>
					      <p>Enviar correo electrónico a evaluadores externos para contestar encuesta
					        <input name="enviar" type="submit" id="enviar" value="Enviar" />
</p></td>
					  </tr>
					</table>
				</form>
			</td>
		</tr>
	</table>
</body>
</html>
