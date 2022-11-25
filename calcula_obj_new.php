<?

include "coneccion_i.php";


	$query="SELECT * from etapa";
	$resultado = mysqli_query($enlace,$query) or die("La consulta fall&oacute;P1: $query". mysqli_error($enlace));
	$resQuery=mysqli_fetch_row($resultado);
	$revision=$resQuery[1];
	//echo revision;
	$contador=0;
	$consulta = "SELECT id_empleado FROM planes where revision=$revision and firma_j_f <> '0000-00-00' order by id_empleado"; //and id_empleado=70749
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: $consulta". mysqli_error($enlace));

	while($res=mysqli_fetch_assoc($resultado))
	{		
			$total_personal=0;
			$total_total=0;
		$consulta2 = "SELECT * FROM objetivos_new where id_empleado={$res['id_empleado']} and revision=$revision ";
		$resultado2= mysqli_query($enlace,$consulta2) or die("La consulta fall&oacute;P1: $consulta2". mysqli_error($enlace));
		
	$count=1;
	
		while($res2=mysqli_fetch_assoc($resultado2))
		{
			$calif=0;
			$consulta4 = "SELECT calif FROM lags where id ={$res2['id_estrategia']}";
			$resultado4= mysqli_query($enlace,$consulta4) or die("La consulta fall&oacute;P1: $consulta4". mysqli_error($enlace));
			//$no=mysqli_num_rows($resultado4);
			if($res4=mysqli_fetch_assoc($resultado4)){
			
				$calif=$res4['calif'];
			}
			if($res2['evaluacion_j']==1){$val1=20;}
			if($res2['evaluacion_j']==2){$val1=60;}
			if($res2['evaluacion_j']==3){$val1=100;}
			if($res2['evaluacion_j']==4){$val1=110;}
			
			
			$calif_f=(($val1*.6)+$calif);
			
			$total_total=$total_total+$calif_f;
			$total_personal=$total_personal+$val1;
			
			echo "F: $calif_f <br/>";
			
			
		$count++;
		}	//echo "<br/> E: $calif_f2  <br/>";
			$total_total=$total_total/($count-1);
			$total_personal=$total_personal/($count-1);
			$consulta3 = "UPDATE planes set  total_planta=$calif, total_personal=$total_personal,resultado_obj_final=$total_total where id_empleado={$res['id_empleado']} and revision=$revision";//resultado_obj_final=$calif_final,
			$resultado3= mysqli_query($enlace,$consulta3) or die("La consulta fall&oacute;P1: $consulta3". mysqli_error($enlace));
			$calif_f2=0;
			$contador=0;
			echo "----------------------------Empleado: {$res['id_empleado']} Calif: $total_total $count<br/><br/>";	
	}


?>