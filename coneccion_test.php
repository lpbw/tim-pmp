<?
	$enlace = mysql_connect('localhost', 'timusr', 'mytim11!');
	mysql_set_charset('utf8',$enlace);
	if (!$enlace) { 
    die('Could not connect: ' . mysqli_error($enlace)); 
	} 

	mysql_select_db("timpmp_test") or die("No pudo seleccionarse la BD.");
?>
