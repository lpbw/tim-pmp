<?
	session_start();
	include "checar_sesion_admin.php";
	include "coneccion_i.php";
	$id=$_GET["id"];
	
	if($_POST['edit']=="Actualizar"){
		
		$nombre=$_POST['nombre'];
		$id=$_POST['id'];
		
		 $query = "UPDATE development_needs set competency='".$_POST['competency']."', coments= '".$_POST['coments']."', date='".$_POST['date']."' where id=$id";
  mysqli_query($enlace,($query)) or print("<H1>:( hemos tenido un error. Contacta al adminsitrador del sistemaIN $query</h1>");
		echo"<script>alert(\"Infromacion Actualizada\"); parent.location=\"career_profile.php\";</script>";
		
	}

	$query="SELECT * FROM development_needs WHERE id=$id";
	$result=mysqli_query($enlace,$query) or die("Falla la consulta 1: ". mysqli_error($enlace));
	$res=mysqli_fetch_row($result);
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
			<td bgcolor="#00475c" class="text_mediano_blanco style1">Edit Development Needs</td>
		</tr>
		<tr>
			<td>
				<form name="form1" id="form1" action="" method="post">
					<table width="100%" border="1" cellpadding="1" cellspacing="0" bordercolor="#CCCCCC">
						<tr>
							<th width="35%" align="right" valign="middle" class="tit_1" scope="row">Competency </th>
							<td>
								<input type="text" name="competency" id="competency"  value="<? echo $res[2]?>"/>
										</td>
						</tr>
						<tr>
							<th width="35%" align="right" valign="middle" class="tit_1" scope="row">Date Entered</th>
							<td>
								<input type="text" name="date" id="date" value="<? echo $res[4]?>"/>
													</td>
						</tr>
						<tr>
							<th width="35%" align="right" valign="middle" class="tit_1" scope="row">Comments</th>
							<td>
								<textarea name="coments" rows="5" cols="50"  id="coments" ><? echo $res[3]?></textarea>
								<input name="id" type="hidden" id="id" value="<? echo "$id";?>" />							</td>
						</tr>
						
					
						<tr>
							<th colspan="2" valign="middle" class="tit_1" scope="row">&nbsp;</th>
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
