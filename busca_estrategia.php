<?

include "coneccion_i.php";

$id_objetivo = $_POST['id_objetivo'];


	
/*

	$r_BC = mysqli_query($enlace,$q_BC) or die("La consulta fall&oacute;P1: $q_BC". mysqli_error($enlace));


$count=1;
	
	
	while(@mysqli_num_rows($r_BC)>=$count)
	{		
		$res2=mysqli_fetch_row($r_BC);
$q_BC2 = "SELECT id_evaluado, avg(resultadon)*150 FROM tex_resultados where id_evaluado=$res2[0] and revision=$revision";
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
	}*/
//$sql = "SELECT lags.id,lags.nombre FROM lags inner join lags_leads on lags.id=lags_leads.id_lead WHERE lags_leads.id_lag=".$id_objetivo;
$sql = "SELECT * FROM lags  WHERE id_io=".$id_objetivo;
$result = mysqli_query($enlace,$sql);

$entrategias = array();
$entrategias[] = array("id" => "0", "name" => "Selecciona estrategia");
while( $row = mysqli_fetch_assoc($result) ){
    $estrategiaid = $row['id'];
    $nombre = $row['nombre'];

    $entrategias[] = array("id" => $estrategiaid, "name" => $nombre);
}

// encoding array to json format
echo json_encode($entrategias);

?>