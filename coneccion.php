<?
	$enlace = mysql_connect('localhost', 'bluewol5_textron', 'Textron11!');
	mysql_set_charset('utf8',$enlace);
	if (!$enlace) { 
    die('Could not connect: ' . mysqli_error($enlace)); 
	} 

	mysql_select_db("bluewol5_timpmp") or die("No pudo seleccionarse la BD.");
?>
