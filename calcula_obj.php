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
			$total_planta=0;
		$consulta2 = "SELECT * FROM objetivos2 where id_empleado={$res['id_empleado']} and revision=$revision and nombre>0";
		$resultado2= mysqli_query($enlace,$consulta2) or die("La consulta fall&oacute;P1: $consulta2". mysqli_error($enlace));
		
	$count=1;
	
		while($res2=mysqli_fetch_assoc($resultado2))
		{
			$calif=0;
			$consulta4 = "SELECT calif FROM lags where id in ({$res2['descripcion']}, {$res2['descripcion2']})";
			$resultado4= mysqli_query($enlace,$consulta4) or die("La consulta fall&oacute;P1: $consulta4". mysqli_error($enlace));
			$no=mysqli_num_rows($resultado4);
			while($res4=mysqli_fetch_assoc($resultado4)){
			
				$calif=$calif+$res4['calif'];
			}
	
	$calif1=0;
	$calif2=0;
	$calif3=0;
	$calif4=0;
	$calif5=0;
	$calif6=0;
	

			$calif=$calif/$no;
			
			echo "$count--------$calif% <br/>";
			if($res2['impacto']>0){
				if($res2['revision_final']==1){$val1=20;}
				if($res2['revision_final']==2){$val1=60;}
				if($res2['revision_final']==3){$val1=100;}
				if($res2['revision_final']==4){$val1=110;}
				$calif1=$val1*$res2['ponderacion'];
				
				echo "$calif1 <br/>";
			}
			if($res2['impacto2']>0){
				if($res2['revision_final2']==1){$val2=20;}
				if($res2['revision_final2']==2){$val2=60;}
				if($res2['revision_final2']==3){$val2=100;}
				if($res2['revision_final2']==4){$val2=110;}
				$calif2=$val2*$res2['ponderacion2'];
				
				echo "$calif2 <br/>";
			}
			if($res2['impacto3']>0){
				if($res2['revision_final3']==1){$val3=20;}
				if($res2['revision_final3']==2){$val3=60;}
				if($res2['revision_final3']==3){$val3=100;}
				if($res2['revision_final3']==4){$val3=110;}
				$calif3=$val3*$res2['ponderacion3'];
				
				echo "$calif3 <br/>";
			}
			if($res2['impacto4']>0){
				if($res2['revision_final4']==1){$val4=20;}
				if($res2['revision_final4']==2){$val4=60;}
				if($res2['revision_final4']==3){$val4=100;}
				if($res2['revision_final4']==4){$val4=110;}
				$calif4=$val4*$res2['ponderacion4'];
				
				echo "$calif4 <br/>";
			}
			if($res2['impacto5']>0){
				if($res2['revision_final5']==1){$val5=20;}
				if($res2['revision_final5']==2){$val5=60;}
				if($res2['revision_final5']==3){$val5=100;}
				if($res2['revision_final5']==4){$val5=110;}
				$calif5=$val5*$res2['ponderacion5'];
				
				echo "$calif5 <br/>";
			}
			if($res2['impacto6']!=""){
				if($res2['revision_final6']==1){$val6=20;}
				if($res2['revision_final6']==2){$val6=60;}
				if($res2['revision_final6']==3){$val6=100;}
				if($res2['revision_final6']==4){$val6=110;}
				$calif6=$val6*$res2['ponderacion6'];
				
				echo "$calif6 <br/>";
			}
			$calif_s=0;
			$calif_s=$calif1+$calif2+$calif3+$calif4+$calif5+$calif6;
			echo "S: $calif_s <br/>";
			$calif_f=(($calif_s*.6)/100);
			$total_personal=$total_personal+$calif_f;
			$calif_f=$calif_f+$calif;
			echo "F: $calif_f <br/>";
			$calif_f2=$calif_f2+$calif_f;
			
		$count++;
		}	echo "<br/> E: $calif_f2  <br/>";
			$calif_final=$calif_f2/($count-1);
			$total_personal=$total_personal/($count-1);
			$consulta3 = "UPDATE planes set  total_planta=$calif, total_personal=$total_personal,resultado_obj_final=$calif_final where id_empleado={$res['id_empleado']} and revision=$revision";//resultado_obj_final=$calif_final,
			$resultado3= mysqli_query($enlace,$consulta3) or die("La consulta fall&oacute;P1: $consulta3". mysqli_error($enlace));
			$calif_f2=0;
			$contador=0;
			echo "----------------------------Empleado: {$res['id_empleado']} Calif: $calif_final $count<br/><br/>";	
	}


?>