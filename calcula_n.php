<?

include "coneccion_i.php";

// Programa para tim-pmp que calcule la calificaci�n final de encuesta 360, esto es sacando un promedio de las calificaciones que est�n en la tabla de tex_resultados para cada empleado filtrando el a�o de la revisi�n y la calificaci�n de cada empleado hacerle update a la tabla planes en el campo resultado_360 hay que ver que sea el plan de la misma revisi�n.

$query="SELECT * from etapa";
	$resultado = mysqli_query($enlace,$query) or die("La consulta fall&oacute;P1: $query". mysqli_error($enlace));
	$resQuery=mysqli_fetch_row($resultado);
	$revision=$resQuery[1];
	//echo revision;
	
$q_BC = "SELECT id_empleado FROM planes where revision=$revision order by id_empleado";
//$q_BC = "SELECT id_empleado FROM planes where revision=$revision and id_empleado=70749";
/*$q_BC = "SELECT usuarios.id FROM usuarios 
	INNER JOIN planes ON usuarios.id=planes.id_empleado	
	where usuarios.id=70079  and planes.revision=$revision order by id";*/
	$r_BC = mysqli_query($enlace,$q_BC) or die("La consulta fall&oacute;P1: $q_BC". mysqli_error($enlace));


$count=1;
	
	
	while(@mysqli_num_rows($r_BC)>=$count)
	{		
		$res2=mysqli_fetch_row($r_BC);
$q_BC2 = "SELECT id_evaluado, avg(resultado) FROM tex_resultados where id_evaluado=$res2[0] and revision=$revision";
		$r_BC2= mysqli_query($enlace,$q_BC2) or die("La consulta fall&oacute;P1: $q_BC2". mysqli_error($enlace));
		
		$count1=1;
		while(@mysqli_num_rows($r_BC2)>=$count1)
		{
			
			$res3=mysqli_fetch_row($r_BC2);
			$cons = "UPDATE planes set resultado_360='$res3[1]' where id_empleado=$res2[0] and revision=$revision";
			$rest= mysqli_query($enlace,$cons) or die("La consulta fall&oacute;P1: $cons". mysqli_error($enlace));
			
			
			$count1++;	
			echo "$cons <br/>";	
		}
		$count++;
	}


?>