<?

include "coneccion_i.php";

	$query="SELECT * from etapa";
	$resultado = mysqli_query($enlace,$query) or die("La consulta fall&oacute;P1: $query". mysqli_error($enlace));
	$resQuery=mysqli_fetch_row($resultado);
	$revision=$resQuery[1];
	
	$q_BC = "SELECT usuarios.id FROM usuarios 
	INNER JOIN planes ON usuarios.id=planes.id_empleado	
	where usuarios.activo=1 and planes.revision=$revision  order by id"; //and planes.estatus_360=3
	$r_BC = mysqli_query($enlace,$q_BC) or die("La consulta fall&oacute;P1: $q_BC". mysqli_error($enlace));
	
	$count=1;
	while(@mysqli_num_rows($r_BC)>=$count)
	{		
		$res2=mysqli_fetch_row($r_BC);
$q_BC2 = "SELECT STDDEV_POP(new_calificaciones.calificacion) as de, avg(new_calificaciones.calificacion) as pro FROM `new_calificaciones`   WHERE new_calificaciones.id_evaluador=$res2[0] and revision=$revision group by new_calificaciones.id_evaluador";
		$r_BC2= mysqli_query($enlace,$q_BC2) or die("La consulta fall&oacute;P1: $q_BC2". mysqli_error($enlace));
		
		if(@mysqli_num_rows($r_BC2)>0)
		{		
				$res=mysqli_fetch_row($r_BC2);
			$ds = $res[0];
			$avr= $res[1];
			
				
			$q_BC3= "update planes set desviacion='$ds', promedio='$avr' where id_empleado=$res2[0] and revision=$revision";  
			$r_BC3= mysqli_query($enlace,$q_BC3) or die("La consulta fall&oacute;P1: $q_BC2". mysqli_error($enlace) );
			$q_BC32= "SELECT calificacion, id_evaluado, id_numero from new_calificaciones where id_evaluador=$res2[0] and revision=$revision ";//and normalizado is null
			$r_BC32= mysqli_query($enlace,$q_BC32) or die("La consulta fall&oacute;P1: $q_BC32". mysqli_error($enlace) );
			
			$count1=1;
			while(@mysqli_num_rows($r_BC32)>=$count1)
			{
				
			$res3=mysqli_fetch_row($r_BC32);	
			$pregunta=$res3[2];
				$x1=$res3[0];
				
				$x = ($x1 - $avr) / $ds;
				
				if ($x == 0)
				{
					$resultado = 0.5;
					$res=number_format($resultado , 4);
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
						$res=number_format($resultado , 4);
					}
					else
					{
						$resultado = $t;
						$res=number_format($resultado , 4);
					}
				}

				
				$q_BC4 = "update new_calificaciones set normalizado='$res' where id_evaluado=$res3[1] and id_evaluador=$res2[0] and id_numero=$pregunta and revision=$revision"; 
			$r_BC4= mysqli_query($enlace,$q_BC4) or die("La consulta fall&oacute;P1: $q_BC4". mysqli_error($enlace) );
					
			$count1++;
			}
		
		}
		
		$count++;
	echo $count;
	}
?>