<?
$valor="1.5";
$valor2="2";
$valor3="3.74";

$decimales=explode(".", $valor);
$horas1=$decimales[0];
$minutos1=number_format(($decimales[1]*60)/10,0);

$decimales2=explode(".", $valor2);
$horas2=$decimales2[0];
$minutos2=number_format(($decimales2[1]*60)/10,0);

$decimales3=explode(".", $valor3);
$horas3=$decimales3[0];
$minutos3=number_format(($decimales3[1]*60)/10,0);


echo"valor1 =$valor tiempo h:$horas1 m:$minutos1<br>";
echo"valor2 =$valor2 tiempo h:$horas2 m:$minutos2<br>";
echo"valor3 =$valor3 tiempo h:$horas3 m:$minutos3<br>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
