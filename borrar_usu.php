<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<?

	session_start();

	include "checar_sesion_admin.php";
mysqli_query($enlace,
	include "coneccion_i.php";

	$id=$_GET["id"];

	

	$query="UPDATE usuarios SET activo=0 where id=$id";

	$resultado=mysqli_query($enlace,$query)or die("Falla al desactivar usuario: ".mysqli_error($enlace));

	echo"<script>alert(\"Usuario Desactivado\");</script>";

	echo"<script> parent.location=parent.location; parent.cerrarV();</script>";

?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

</head>

</html>

