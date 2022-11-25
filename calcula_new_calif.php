<?

include "coneccion_i.php";


$query="SELECT * from etapa";
	$resultado = mysqli_query($enlace,$query) or die("La consulta fall&oacute;P1: $query". mysqli_error($enlace));
	$resQuery=mysqli_fetch_row($resultado);
	$revision=$resQuery[1];
	
	$q_BC = "SELECT id_empleado FROM planes where revision=$revision order by id_empleado";
	$r_BC = mysqli_query($enlace,$q_BC) or die("La consulta fall&oacute;P1: $q_BC". mysqli_error($enlace));


$count=1;
	
	
	while(@mysqli_num_rows($r_BC)>=$count)
	{		
		$res2=mysqli_fetch_row($r_BC);
		$q_BC2 = "SELECT id_evaluado, round(avg(round(resultadon*150,1)),2) FROM new_resultados where id_evaluado=$res2[0] and revision=$revision";
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