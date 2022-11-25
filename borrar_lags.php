
<?
	session_start();
	include "checar_sesion_admin.php";
	include "coneccion_i.php";
	$id=$_GET["id"];
	
	$query="delete from lags where id=$id";
	$resultado=mysqli_query($enlace,$query)or die("Falla al desactivar usuario: ".mysqli_error($enlace));
	echo"<script>alert(\"Lag eliminado\");</script>";
	echo"<script> parent.location=parent.location; parent.cerrarV();</script>";
?>

