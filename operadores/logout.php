<?
session_start();
$_SESSION['idU']="";
				
$_SESSION['idA']="";

session_destroy();
header("Location: index.php");

?>