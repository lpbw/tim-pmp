<?

include "coneccion_i.php";

	$consulta = "SELECT * FROM competencias where revision=2016 "; //and id_empleado=70749
	$resultado = mysqli_query($enlace,$consulta) or die("La consulta fall&oacute;P1: $consulta". mysqli_error($enlace));
	while($res=mysqli_fetch_assoc($resultado))
	{		
			
		$consulta2 = "insert into competencias(competencia, descripcion, revision) values('{$res['competencia']}', '{$res['descripcion']}', 2017)  ";
		$resultado2= mysqli_query($enlace,$consulta2) or die("La consulta fall&oacute;P1: $consulta2". mysqli_error($enlace));
	}

?>