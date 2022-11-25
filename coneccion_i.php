<?
	$enlace = mysqli_connect('localhost', 'bluewol5_textron', 'Textron11!', "bluewol5_timpmp"); //host, user, pass, bd
	mysqli_set_charset($enlace, 'utf8');
	if (!$enlace) { 
    	die('Could not connect:'); 
	} 

?>