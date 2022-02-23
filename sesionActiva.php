<?
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML><head>

</head>
<script>
function auto_reload()
{
	window.location = 'sesionActiva.php';
}
</script>
<BODY onLoad="timer = setTimeout('auto_reload()',100000);">
<?

if($_SESSION['idU']!='' && $_SESSION['idU']!="0")
{

	echo"Sesion Activa..";
}else
{
	echo"Sesion Caducada";
}
?>
</BODY>
</HTML>
