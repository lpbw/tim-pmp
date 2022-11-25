<?


	$x1 = 4;
	$avr = 3.1765;
	$ds = 1.0424;
	
	$x = ($x1 - $avr) / $ds;
			
				if ($x == 0)
				{
					echo $resultado = 0.5;
				}
				else
				{
					$oor2pi = 1 / (sqrt(2 * 3.14159265358979323846));
					$t = 1 / (1 + 0.2316419 * abs($x));
					$t *= $oor2pi * exp(-0.5 * $x * $x) *
						(0.31938153 + $t * (-0.356563782 + $t *
						(1.781477937 + $t * (-1.821255978 + $t * 1.330274429))));
			
					if ($x >= 0)
					{
						 $resultado = 1 - $t;
						 echo $res=number_format($resultado , 4);
					}
					else
					{
						 $resultado = $t;
						 echo $res=number_format($resultado , 4);
					}
				}
				

?>


