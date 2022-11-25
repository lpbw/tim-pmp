<?
	session_start();
	include "checar_sesion_admin.php";
	include "coneccion_i.php";
	$id=$_GET["id"];
	$revision=$_GET["revision"];
	
	if($_POST['edit']=="Actualizar"){
		
		
		 $query = "UPDATE acciones set accion='".$_POST['accion']."', tipo= '".$_POST['tipo']."', mes='".$_POST['mes']."', id_competencia='".$_POST['id_competencia']."' where id=$id";
  		$resultado=mysqli_query($enlace,$query) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistemaIN $query</h1>");
		echo"<script>alert(\"Infromacion Actualizada\"); parent.location=\"planes.php\";</script>";
		
	}

	$query="SELECT * FROM acciones WHERE id=$id";
	$result=mysqli_query($enlace,$query) or die("Falla la consulta 1: ". mysqli_error($enlace));
	$res=mysqli_fetch_assoc($result);
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

</head>

<body>
	<table width="447" border="0" align="center">
		<tr align="center">
			<td bgcolor="#00475c" class="text_mediano_blanco style1">Edit Action</td>
		</tr>
		<tr>
			<td>
				<form name="form1" id="form1" action="" method="post">
					<table width="100%" border="1" cellpadding="1" cellspacing="0" bordercolor="#CCCCCC">
						<tr>
						  <th align="right" valign="middle" class="tit_1" scope="row">Competency</th>
						  <td><select name="id_competencia"  class="texto_tareas" style="width:150px" id="id_competencia" required onchange="cambiar1(this.value);">
                          	<option value="">--Select--</option>
                          	<?
							$consulta4="select * from competencias where revision=$revision order by id";
							$resultado4 = mysqli_query($enlace,$consulta4) or die("$consulta4  ". mysqli_error($enlace) );	
							while($res4=mysqli_fetch_assoc($resultado4)){
							?>
							<option value="<? echo $res4['id']?>" <? echo $res['id_competencia']==$res4['id']?"selected":"";?>><? echo $res4['competencia']?></option>
							<?
							}
							?>
                        </select></td>
					  </tr>
						<tr>
							<th width="35%" align="right" valign="middle" class="tit_1" scope="row">Action </th>
							<td><textarea name="accion" cols="40" rows="4" class="texto_tareas" required><? echo $res['accion']?></textarea></td>
						</tr>
						<tr>
							<th width="35%" align="right" valign="middle" class="tit_1" scope="row">Date Entered</th>
							<td><select name="tipo"  class="texto_tareas" style="width:120px" id="tipo" required>
                          	<option value="">--Select--</option>
                          	<option value="70 - Learning by doing" <? if($res['tipo']=="70 - Learning by doing"){echo"selected";}?>>70 - Learning by doing</option>
							<option value="20 - Learning from Others" <? if($res['tipo']=="20 - Learning from Others"){echo"selected";}?>>20 - Learning from Others</option>
							<option value="10 - Learning from Courses & Materials" <? if($res['tipo']=="10 - Learning from Courses & Materials"){echo"selected";}?>>10 - Learning from Courses & Materials</option>
                        </select></td>
						</tr>
						<tr>
							<th width="35%" align="right" valign="middle" class="tit_1" scope="row">Month</th>
							<td><select name="mes"  class="texto_tareas" style="width:120px" id="mes" required>
                          	<option value="">--Select--</option>
                          	<option value="1" <? if($res['mes']=="1"){ echo"selected";}?> >Enero</option>
							<option value="2" <? if($res['mes']=="2"){ echo"selected";}?>>Febrero</option>
							<option value="3" <? if($res['mes']=="3"){ echo"selected";}?>>Marzo</option>
							<option value="4" <? if($res['mes']=="4"){ echo"selected";}?>>Abril</option>
							<option value="5" <? if($res['mes']=="5"){ echo"selected";}?>>Mayo</option>
							<option value="6" <? if($res['mes']=="6"){ echo"selected";}?>>Junio</option>
							<option value="7" <? if($res['mes']=="7"){ echo"selected";}?>>Julio</option>
							<option value="8" <? if($res['mes']=="8"){ echo"selected";}?>>Agosto</option>
							<option value="9" <? if($res['mes']=="9"){ echo"selected";}?>>Septiembre</option>
							<option value="10" <? if($res['mes']=="10"){ echo"selected";}?>>Octubre</option>
							<option value="11" <? if($res['mes']=="11"){ echo"selected";}?>>Noviembre</option>
							<option value="12" <? if($res['mes']=="12"){ echo"selected";}?>>Diciembre</option>
                        </select></td>
						</tr>
						
					
						<tr>
							<th colspan="2" valign="middle" class="tit_1" scope="row">&nbsp;</th>
						</tr>
						<tr>
							<td colspan="2">
								<div align="center"><input name="edit" id="edit" type="submit" align="middle" class="boton" value="Actualizar" /></div>							</td>
						</tr>
					</table>
				</form>
			</td>
		</tr>
</table>
</body>
</html>
