<?
	session_start();
	include "checar_sesion_admin.php";
	include "coneccion_i.php";

	if($_POST['edit']=="Agregar"){
		$id=$_POST['id'];
		$nombre=$_POST['nombre'];
		$email=$_POST['email'];
		$contra=$_POST['contra'];
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
		
		
		$query="INSERT INTO usuarios(id,nombre,email,contra,id_jefe,grado_salarial,id_departamento,puesto,fecha_contratacion,tipo, id_jefe_360, fecha_nacimiento, sexo, numero_colaboradores)
		 VALUES($id,'$nombre','$email','$contra',$jefe,$grado_salarial,$depto,'$puesto','$fecha',$tipo, $jefe_360, '$fecha_nacimiento', $sexo, $numero_colaboradores)";
		$consulta=mysqli_query($enlace,$query)or die("Fallo al agregar usuario: ".mysqli_error($enlace));
		echo"<script>alert(\"Usuario agregado exitosamente\");</script>";
		echo"<script> parent.location=parent.location; parent.cerrarV();</script>";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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
		if(document.form1.contra.value==document.form1.v_contra.value)
			document.form1.submit();
		else{
			alert("El password no coincide");
			document.form1.contra.focus();
			return false;
		}
	}
</script>
<title>Untitled Document</title>
</head>

<body>
	<table width="450" border="0" align="center">
		<tr align="center">
			<td bgcolor="#00475c" class="text_mediano_blanco style1">Agregar Usuario</td>
		</tr>
		<tr>
			<td>
				<form name="form1" id="form1" action="" method="post">
					<table width="100%" border="1" cellpadding="1" cellspacing="0" bordercolor="#CCCCCC">
						<tr>
							<th width="35%" align="right" valign="middle" class="tit_1" scope="row"># de Empleado</th>
							<td>
								<input required name="id" type="text" id="id" placeholder="# empleado" size="10" maxlength="15" />							</td>
						</tr>
						<tr>
							<th width="35%" align="right" valign="middle" class="tit_1" scope="row">Nombre</th>
							<td>
								<input required name="nombre" type="text" id="nombre" placeholder="nombre" size="30" maxlength="100" />							</td>
						</tr>
						<tr>
							<th valign="middle" align="right" class="tit_1" scope="row">E-Mail</th>
							<td>
								<input required name="email" value="" type="email" id="email" placeholder="example@bh.com" size="30" maxlength="100" />							</td>
						</tr>
						<tr>
							<th valign="middle" align="right" class="tit_1" scope="row">Password</th>
							<td>
								<input required name="contra" value="" type="password" id="contra" placeholder="password" size="30" maxlength="100" />							</td>
						</tr>
						<tr>
							<th valign="middle" align="right" class="tit_1" scope="row">Confirmar Password</th>
							<td>
								<input required name="v_contra" type="password" id="v_contra" placeholder="confirma tu password" size="30" maxlength="100" />							</td>
						</tr>
						<tr>
							<th valign="middle" align="right" class="tit_1" scope="row">Jefe</th>
							<td><select id="jefe" name="jefe">
								<option value="0">--Seleccionar Jefe--</option>
							<?
							$query="select id, nombre from usuarios order by nombre";
							$consulta=mysqli_query($enlace,$query)or die("Error al consultar jefe: ".mysqli_error($enlace));
							for($i=0;$i<@mysqli_num_rows($consulta);$i++){
								$jefe=mysqli_fetch_row($consulta);
							?>
                              <option value="<? echo "$jefe[0]";?>"><? echo"$jefe[1]";?></option>
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
                            <option  value="<? echo "$jefe[0]";?>"><? echo"$jefe[1]";?></option>
                            <? }?>
                          </select></td>
					  </tr>
						<tr>
							<th valign="middle" align="right" class="tit_1" scope="row">Grado Salarial</th>
							<td>
								<select id="grado" name="grado">
									<option value="0">--Seleccioar Grado Salarial--</option>
							<?
							for($i=1;$i<=15;$i++){
							?>
                              <option value="<? echo "$i";?>"><? echo"$i";?></option>
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
									<option value="<? echo "$dep[0]";?>"><? echo "$dep[1]";?></option>
								<? }?>
								</select>							</td>
						</tr>
						<tr>
							<th valign="middle" align="right" class="tit_1" scope="row">Posici�n</th>
							<td><select id="puesto" name="puesto">
                              <option value="0">--Seleccionar Puesto--</option>
                              <?
								$query="SELECT id, nombre FROM puestos order by nombre";
								$consulta=mysqli_query($enlace,$query)or die("Error al consultar departamentos: ".mysqli_error($enlace));
								for($i=0;$i<@mysqli_num_rows($consulta);$i++){
									$dep=mysqli_fetch_row($consulta);
								?>
                              <option  value="<? echo "$dep[0]";?>"><? echo "$dep[1]";?></option>
                              <? }?>
                            </select></td>
						</tr>
						<tr>
							<th valign="middle" align="right" class="tit_1" scope="row">Tipo</th>
							<td><select name="tipo" id="tipo">
							  <option value="1">Contribuidor Individual</option>
							  <option value="2">Coordinador, Supervisoro Gerente </option>
							  <option value="3">Director</option>
							  <option value="4">Externo</option>
							  </select>							</td>
						</tr>
						<tr>
						  <th valign="middle" align="right" class="tit_1" scope="row">Fecha de Contrataci&oacute;n </th>
						  <td><input required="required" name="fecha"  id="fecha" size="30" maxlength="100" /></td>
					  </tr>
					  <tr>
						  <th valign="middle" align="right" class="tit_1" scope="row">Fecha de Nacimiento </th>
						  <td><input required="required" name="fecha_nacimiento"  id="fecha_nacimiento" size="30" maxlength="100" /></td>
					  </tr>
					   <tr>
						  <th valign="middle" align="right" class="tit_1" scope="row">Sexo</th>
						  <td><select id="sexo" name="sexo">
								<option value="0">--Seleccionar Sexo--</option>
								<option value="1">Female</option>
								<option value="2">Male</option>
								</select></td>
					  </tr>
					  <tr>
						  <th valign="middle" align="right" class="tit_1" scope="row">Num. Colaboradores fuera del sistema</th>
						  <td><input type="number" min="0" required  name="numero_colaboradores" id="numero_colaboradores" placeholder="Numero de colaboradores"/></td>
					  </tr>
						<tr>
							<td colspan="2">
								<div align="center"><input onclick="javascript:valdar();" name="edit" id="edit" type="submit" align="middle" value="Agregar" /></div>							</td>
						</tr>
					</table>
				</form>
			</td>
		</tr>
	</table>
</body>
</html>
