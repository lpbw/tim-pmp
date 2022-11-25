<?
	session_start();
	include "checar_sesion_admin.php";
	include "coneccion_i.php";
	$id=$_GET["id"];
	
	$query  = "update filosofia set archivo='', actualizacion=now()  where id=$id";
	$resultado=mysqli_query($enlace,$query)or die("Falla al borrar archivo: ".mysqli_error($enlace));
	echo"<script>alert(\"Archivo eliminado\");</script>";
	echo"<script> parent.location=parent.location; parent.cerrarV();</script>";
?>
