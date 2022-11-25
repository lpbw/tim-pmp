
<?

include "coneccion_i.php";

$query="SELECT * from etapa";
	$resultado = mysqli_query($enlace,$query) or die("La consulta fall&oacute;P1: $query". mysqli_error($enlace));
	$resQuery=mysqli_fetch_row($resultado);
	$revision=$resQuery[1];
	
//Consulta texto del correo
	$tipo1="";
	$tipo2="";
	$tipo3="";
	$tipo4="";
	$tipo5="";
	$consulta  = "SELECT id_evaluado FROM evaluadores where revision=$revision group by id_evaluado order by id_evaluado";
	//$consulta  = "SELECT id_evaluado  FROM evaluadores where revision=$revision and id_evaluado=70749 group by id_evaluado order by id_evaluado";
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: $consulta". mysqli_error($enlace) );
	$count1=1;
	//echo $consulta;
	while(@mysqli_num_rows($resultado)>=$count1)
	{
		$res=mysqli_fetch_row($resultado);
		$tipo1="0";
		$tipo2="0";
		$tipo3="0";
		$tipo4="0";
		$tipo5="0";
		$tipo1s="0";
		$tipo2s="0";
		$tipo3s="0";
		$tipo4s="0";
		$tipo5s="0";
		$tipo1sn="0";
		$tipo2sn="0";
		$tipo3sn="0";
		$tipo4sn="0";
		$tipo5sn="0";
		
		$consulta2  = "SELECT avg(new_calificaciones.calificacion), ev1.relacion, id_numero, new_calificaciones.id_evaluado, avg(new_calificaciones.normalizado) FROM `new_calificaciones` inner join evaluadores as ev1 on new_calificaciones.id_evaluador=ev1.id_evaluador  WHERE ev1.id_evaluador=new_calificaciones.id_evaluador and ev1.id_evaluado=new_calificaciones.id_evaluado and new_calificaciones.id_evaluado=$res[0] and new_calificaciones.revision=$revision group by id_numero,ev1.relacion order by ev1.id_evaluado, id_numero, ev1.relacion"; // tenia error al no buscar tambie por revision de la evalaucion
		$consulta2  = "SELECT avg(new_calificaciones.calificacion), ev1.relacion, id_numero, new_calificaciones.id_evaluado, avg(new_calificaciones.normalizado) FROM `new_calificaciones` inner join evaluadores as ev1 on new_calificaciones.id_evaluador=ev1.id_evaluador  WHERE ev1.id_evaluador=new_calificaciones.id_evaluador and ev1.id_evaluado=new_calificaciones.id_evaluado and new_calificaciones.id_evaluado=$res[0] and new_calificaciones.revision=$revision and ev1.revision=$revision group by id_numero,ev1.relacion order by ev1.id_evaluado, id_numero, ev1.relacion";
		$resultado2 = mysqli_query($enlace,$consulta2) or die("La consulta fall&oacute;P3: $consulta2". mysqli_error($enlace) );
		$countt=1;
		echo $consulta2;
		while(@mysqli_num_rows($resultado2)>=$countt)
		{
			$res2=mysqli_fetch_row($resultado2);
			if($res2[1]==1)
			{
				$tipo1s="$res2[0]";
				$tipo1sn="$res2[4]";
				//echo $tipo1sn;
			}
			else
			{
				if($res2[1]==2)
				{
					$tipo2s="$res2[0]";
					$tipo2sn="$res2[4]";
				}
				else
				{
					if($res2[1]==3)
					{
						$tipo3s="$res2[0]";
						$tipo3sn="$res2[4]";
					}
					else
					{
						if($res2[1]==4)
						{
							$tipo4s="$res2[0]";
							$tipo4sn="$res2[4]";
						}
						else
						{
							if($res2[1]==5)
							{
								$tipo5s="$res2[0]";
								$tipo5sn="$res2[4]";
								
								if($tipo2s=="")
								{
									$tipo1=$tipo1s*.30;
									$tipo2="0";
									$tipo2s="0";
									$tipo3=$tipo3s*.30;
									$tipo4=$tipo4s*.30;
									$tipo5=$tipo5s*.10;
									
									$tipo1n=$tipo1sn*.30;
									$tipo2n="0";
									$tipo2sn="0";
									$tipo3n=$tipo3sn*.30;
									$tipo4n=$tipo4sn*.30;
									$tipo5n=$tipo5sn*.10;
									
									$total=$tipo1+$tipo3+$tipo4+$tipo5;
									$totaln=$tipo1n+$tipo3n+$tipo4n+$tipo5n;
									
									$tipo1=round($tipo1,1);
									$tipo3=round($tipo3,1);
									$tipo4=round($tipo4,1);
									$tipo5=round($tipo5,1);
									
									$total=round($total,1);
									
									$tipo1s=round($tipo1s,1);
									$tipo2s=round($tipo2s,1);
									$tipo3s=round($tipo3s,1);
									$tipo4s=round($tipo4s,1);
									$tipo5s=round($tipo5s,1);
									
									$tipo1sn=round($tipo1sn,1);
									$tipo2sn=round($tipo2sn,1);
									$tipo3sn=round($tipo3sn,1);
									$tipo4sn=round($tipo4sn,1);
									$tipo5sn=round($tipo5sn,1);
								}else
								{
									$tipo1=$tipo1s*.25;
									$tipo2=$tipo2s*.20;
									$tipo3=$tipo3s*.20;
									$tipo4=$tipo4s*.25;
									$tipo5=$tipo5s*.10;
									
									$tipo1n=$tipo1sn*.25;
									$tipo2n=$tipo2sn*.20;
									$tipo3n=$tipo3sn*.20;
									$tipo4n=$tipo4sn*.25;
									$tipo5n=$tipo5sn*.10;
									
									$total=$tipo1+$tipo2+$tipo3+$tipo4+$tipo5;
									$totaln=$tipo1n+$tipo2n+$tipo3n+$tipo4n+$tipo5n;
									
									$tipo1=round($tipo1,1);
									$tipo2=round($tipo2,1);
									$tipo3=round($tipo3,1);
									$tipo4=round($tipo4,1);
									$tipo5=round($tipo5,1);
									
									$tipo1sn=round($tipo1sn,1);
									$tipo2sn=round($tipo2sn,1);
									$tipo3sn=round($tipo3sn,1);
									$tipo4sn=round($tipo4sn,1);
									$tipo5sn=round($tipo5sn,1);
									
									$tipo1s=round($tipo1s,1);
									$tipo2s=round($tipo2s,1);
									$tipo3s=round($tipo3s,1);
									$tipo4s=round($tipo4s,1);
									$tipo5s=round($tipo5s,1);
									
									$total=round($total,1);
									$totaln=round($totaln,4);
								}
								$consulta3  = "insert into new_resultados (id_evaluado, id_numero, resultado, tipo1, tipo2, tipo3, tipo4, tipo5, tipo1s, tipo2s, tipo3s, tipo4s, tipo5s, tipo1n, tipo2n, tipo3n, tipo4n, tipo5n, resultadon, revision) values ($res2[3], $res2[2],$total, $tipo1, $tipo2, $tipo3, $tipo4, $tipo5, $tipo1s, $tipo2s, $tipo3s, $tipo4s, $tipo5s, $tipo1sn, $tipo2sn, $tipo3sn, $tipo4sn, $tipo5sn, $totaln, $revision)";
								//echo $consulta3;
								$resultado3 = mysqli_query($enlace,$consulta3) or die("La consulta fall&oacute;P1: $consulta3". mysqli_error($enlace) );
								echo"$res2[3], $res2[2],$total, $tipo1, $tipo2, $tipo3, $tipo4, $tipo5s<br>";
							}
						}
					}
				}
			}
			
		
			$countt++;
		}
	$count1++;
	}
	
	
?>


