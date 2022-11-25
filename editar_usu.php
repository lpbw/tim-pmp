<?
	session_start();
	include "checar_sesion_admin.php";
	include "coneccion_i.php";
	$id=$_GET["id"];
	if($_POST['edit']=="Enviar contraseña al correo electrónico"){
		$consulta  = "select  id, contra, email from usuarios where id=$id";
		$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1:$consulta " . mysqli_error($enlace));
		if(@mysqli_num_rows($resultado)>0){
			$res=mysqli_fetch_row($resultado);
			$pass=$res[1];
			$email=$res[2];
			$EmailFrom = "notificaciones@tim-pmp.com";	//mail
			$Subject = "Recuperacion de password - Textron TIM-PMP - ";
			$Body = "";
			$Body .= "<html>";
			$Body .= "<head><style type=\"text/css\"></style>";
			$Body .= "<title>Bell</title>";
			$Body .= "</head>";
			$Body .= "<body>
				<table width=\"600\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
				  <tr>
					<td width=\"90\"></td>
					<td width=\"510\"> </td>
				  </tr>
				  <tr>
					<td colspan=\"2\"><p>$nombre $app $apm</p>
					<p> <br>
				<br><br>Para ingresar usa los siguientes datos:</p>
					<table width=\"50%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
					  <tr>
						<td width=\"22%\" bgcolor=\"#CCCCCC\" class=\"style1\"><div align=\"center\" class=\"style5\">
							USR:</div></td>
						<td width=\"78%\">$id</td>
					  </tr>
					  <tr>
						<td width=\"22%\" bgcolor=\"#CCCCCC\" class=\"style1\"><div align=\"center\" class=\"style5\">
							PSW:</div></td>
						<td width=\"78%\">$pass</td>
					  </tr>";
					$Body .= " </table>
						<p>Este mensaje fue generado automaticamente por la aplicacion de registro por favor no contestar.</p>
						
						<p><br>
						  <br>
						</p></td>
					  </tr>
					</table>";
				$Body .= "</body>";
			$Body .= "</html>";
			if($id!=""){
				$success = mail($email, $Subject, $Body, "From: tim-pmp.com <$EmailFrom>\nContent-type: text/html; charset=utf-8\n");
				echo"<script>alert(\"La contraseña ha sido enviada al correo registrado.\");</script>";
			}
		}
	}
	if($_POST['edit']=="Actualizar"){
		
		$nombre=$_POST['nombre'];
		$email=$_POST['email'];
		$jefe=$_POST['jefe'];
		$jefe_360=$_POST['jefe_360'];
		$grado_salarial=$_POST['grado'];
		$depto=$_POST['depto'];
		$puesto=$_POST['puesto'];
		$tipo=$_POST['tipo'];
		$fecha=$_POST['fecha'];
		$fecha_nacimiento=$_POST['fecha_nacimiento'];
		$sexo=$_POST['sexo'];
		$numero_colaboradores=$_POST['numero_colaboradores'];
		$activo=$_POST['activo'];
		
		$query="UPDATE usuarios SET nombre='$nombre', email='$email', id_jefe=$jefe, grado_salarial=$grado_salarial, id_departamento=$depto, puesto='$puesto', id_jefe_360=$jefe_360, tipo=$tipo, fecha_contratacion='$fecha', fecha_nacimiento='$fecha_nacimiento', sexo=$sexo, numero_colaboradores=$numero_colaboradores, activo='{$_POST['activo']}' WHERE id=$id";
		$consulta=mysqli_query($enlace,$query)or die("Fallo al actualizar: $query ".mysqli_error($enlace));
		
		//archivo
			if($consulta){
			if ($_FILES["imagen"]["error"]> 0 )  {
  				//echo "Error imagen: " . $_FILES["file"]["error"] . "<br />";	
  			}else {	  
 	 					 		$allowed_ext = array("jpeg", "jpg", "gif", "png");
	  							$nom="empleados/".$_FILES["imagen"]["name"];
	 							$nom2="".$_FILES["imagen"]["name"];
								if(move_uploaded_file($_FILES["imagen"]['tmp_name'], $nom)){
									$consulta1  = "update usuarios set imagen='$nom2' where id=$id";
									$resultado1 = mysqli_query($enlace,$consulta1) or die("Error en operacion: $consulta1" . mysqli_error($enlace));	
								}else{
									echo"Error uploading image";
								}	
  				}
			}//archivo
		
		echo"<script>alert(\"Usuario actualizado exitosamente\");</script>";
	}

	$query="SELECT * FROM usuarios where id=$id";
	$result=mysqli_query($enlace,$query) or die("Falla la consulta 1: ". mysqli_error($enlace));
	$usuario=mysqli_fetch_row($result);
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
<link type="text/css" href="css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
	
	<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
<SCRIPT>
	$(function() {
		$( "#fecha" ).datepicker({ dateFormat: 'yy-mm-dd' });
		$( "#fecha_nacimiento" ).datepicker({ dateFormat: 'yy-mm-dd' });
		
	});
</SCRIPT>
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
	<table width="447" border="0" align="center">
		<tr align="center">
			<td bgcolor="#00475c" class="text_mediano_blanco style1">Editar Usuario</td>
		</tr>
		<tr>
			<td>
				<form name="form1" id="form1" action="" method="post" enctype="multipart/form-data">
					<table width="100%" border="1" cellpadding="1" cellspacing="0" bordercolor="#CCCCCC">
						<tr>
							<th width="35%" align="right" valign="middle" class="tit_1" scope="row">Nombre</th>
							<td>
								<input required name="nombre" type="text" id="nombre" value="<? echo "$usuario[1]";?>" size="30" maxlength="100" />
								<input name="id" type="hidden" id="id" value="<? echo "$id";?>" />							</td>
						</tr>
						<tr>
							<th valign="middle" align="right" class="tit_1" scope="row">E-Mail</th>
							<td>
								<input required name="email" type="email" id="email" value="<? echo "$usuario[2]";?>" size="30" maxlength="100" />							</td>
						</tr>
						<tr>
							<th valign="middle" align="right" class="tit_1" scope="row">Jefe</th>
							<td><select id="jefe" name="jefe">
							<option value="">--Seleccionar Jefe--</option>
							<?
							$query="select id,nombre from usuarios order by nombre";
							$consulta=mysqli_query($enlace,$query)or die("Error al consultar jefe: ".mysqli_error($enlace));
							for($i=0;$i<@mysqli_num_rows($consulta);$i++){
								$jefe=mysqli_fetch_row($consulta);
							?>
                              <option <? if($jefe[0]==$usuario[5]) echo "selected=\"selected\"";?> value="<? echo "$jefe[0]";?>"><? echo"$jefe[1]";?></option>
							<? }?>
							</select></td>
						</tr>
						<tr>
						  <th valign="middle" align="right" class="tit_1" scope="row">Jefe 360 </th>
						  <td><select id="jefe_360" name="jefe_360">
                            <option value="">--Seleccionar Jefe--</option>
                            <?
							$query="select id,nombre from usuarios order by nombre";
							$consulta=mysqli_query($enlace,$query)or die("Error al consultar jefe: ".mysqli_error($enlace));
							for($i=0;$i<@mysqli_num_rows($consulta);$i++){
								$jefe=mysqli_fetch_row($consulta);
							?>
                            <option <? if($jefe[0]==$usuario[12]) echo "selected=\"selected\"";?> value="<? echo "$jefe[0]";?>"><? echo"$jefe[1]";?></option>
                            <? }?>
                          </select></td>
					  </tr>
						<tr>
							<th valign="middle" align="right" class="tit_1" scope="row">Grado Salarial</th>
							<td>
								<select id="grado" name="grado">
								<option value="0">--Selecionar Grado Salarial--</option>
							<?
							for($i=1;$i<=15;$i++){
							?>
                              <option <? if($usuario[6]==$i) echo "selected=\"selected\"";?> value="<? echo "$i";?>"><? echo"$i";?></option>
							<? }?>
							</select>							</td>
						</tr>
						<tr>
							<th valign="middle" align="right" class="tit_1" scope="row">Departamento</th>
							<td>
								<select id="depto" name="depto">
									<option value="0">--Seleccionar Departamento--</option>
								<?
								$query="SELECT id, nombre FROM departamentos";
								$consulta=mysqli_query($enlace,$query)or die("Error al consultar departamentos: ".mysqli_error($enlace));
								for($i=0;$i<@mysqli_num_rows($consulta);$i++){
									$dep=mysqli_fetch_row($consulta);
								?>
									<option <? if($usuario[7]==$dep[0]) echo"selected=\"selected\""?> value="<? echo "$dep[0]";?>"><? echo "$dep[1]";?></option>
								<? }?>
								</select>							</td>
						</tr>
						<tr>
							<th valign="middle" align="right" class="tit_1" scope="row">Posición</th>
						  <td><select id="puesto" name="puesto">
                                  <option value="0">--Seleccionar Puesto--</option>
                                  <?
								$query="SELECT id, nombre FROM puestos order by nombre";
								$consulta=mysqli_query($enlace,$query)or die("Error al consultar departamentos: ".mysqli_error($enlace));
								for($i=0;$i<@mysqli_num_rows($consulta);$i++){
									$dep=mysqli_fetch_row($consulta);
								?>
                                  <option <? if($usuario[8]==$dep[0]) echo"selected=\"selected\""?> value="<? echo "$dep[0]";?>"><? echo "$dep[1]";?></option>
                                  <? }?>
                                </select></td>
						</tr>
						<tr>
						  <th valign="middle" align="right" class="tit_1" scope="row">Tipo</th>
						  <td><select name="tipo" id="tipo">
                            <option value="1" <? if($usuario[11]=="1")echo"selected";?>>Contribuidor Individual</option>
                            <option value="2" <? if($usuario[11]=="2")echo"selected";?>>Coordinador, Supervisoro Gerente </option>
                            <option value="3" <? if($usuario[11]=="3")echo"selected";?>>Director</option>
							<option value="4" <? if($usuario[11]=="4")echo"selected";?>>Externo</option>
                          </select></td>
					  </tr>
						
						<tr>
						  <th valign="middle" class="tit_1" scope="row">Fecha de Contratación </th>
					      <th valign="middle" class="tit_1" scope="row"><div align="left">
					        <input required="required" name="fecha"  id="fecha" value="<? echo "$usuario[9]";?>" size="30" maxlength="100" />
				          </div></th>
					  </tr>
					  <tr>
						  <th valign="middle" class="tit_1" scope="row">Fecha de Nacimiento </th>
					      <th valign="middle" class="tit_1" scope="row"><div align="left">
					        <input required="required" name="fecha_nacimiento"  id="fecha_nacimiento" value="<? echo "$usuario[13]";?>" size="30" maxlength="100" />
				          </div></th>
					  </tr>
					  <tr>
						  <th valign="middle" class="tit_1" scope="row">Sexo</th>
					      <th valign="middle" class="tit_1" scope="row"><div align="left">
					       <select id="sexo" name="sexo">
								<option value="0" >--Seleccionar Sexo--</option>
								<option value="1" <? if($usuario[14]=="1") echo "selected=\"selected\"";?>>Female</option>
								<option value="2" <? if($usuario[14]=="2") echo "selected=\"selected\"";?>>Male</option>
								</select>
				          </div></th>
					  </tr>
					  <tr>
						  <th valign="middle" align="right" class="tit_1" scope="row">Num. Colaboradores fuera del sistema</th>
						  <td><input type="number" min="0" required  name="numero_colaboradores" id="numero_colaboradores" placeholder="Numero de colaboradores" value="<? echo $usuario[15]?>"/></td>
					  </tr>
					   <tr>
					     <th valign="middle" align="right" class="tit_1" scope="row">Imagen</th>
					     <td><input type="file" name="imagen" id="imagen" placeholder="Imagen"/> <? if($usuario[16]!=""){?><a href="empleados/<? echo $usuario[16]?>" target="_blank">Ver</a><? }?></td>
				      </tr>
					   <tr>
						  <th valign="middle" align="right" class="tit_1" scope="row">Activo</th>
						  <td><input name="activo" type="checkbox" value="1" <? if($usuario[4]=="1") echo"checked";?> /></td>
					  </tr>
						<tr>
							<th colspan="2" valign="middle" class="tit_1" scope="row"><input name="edit" id="edit" type="submit" class="boton" value="Enviar contraseña al correo electrónico" /></th>
						</tr>
						<tr>
							<td colspan="2">
								<div align="center"><input onclick="javascript:valdar();" name="edit" id="edit" type="submit" align="middle" class="boton" value="Actualizar" /></div>							</td>
						</tr>
					</table>
				</form>
			</td>
		</tr>
</table>
</body>
</html>
