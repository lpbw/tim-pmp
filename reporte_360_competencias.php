<?php
    header("Content-type: application/vnd.ms-excel charset=iso-8859-1; name='excel'");
    header("Pragma: no-cache");
    header("Expires: 0");
    header("Content-Disposition: filename=reporte_360_competencias.xls");
    include "coneccion_i.php";
    $revision = $_GET['revision'];

    $consulta_resultados  = "SELECT new_competencias.e1 AS competencia , AVG(round(r1.resultado,1)) AS resultado,AVG(round(r1.resultadon*150,1)) AS resultado_normalizado FROM new_resultados AS r1 INNER JOIN new_competencias on r1.id_numero=new_competencias.id WHERE revision=$revision GROUP BY new_competencias.e1 ORDER BY r1.id_numero";
	$resultado_360_competencias = mysqli_query($enlace,$consulta_resultados) or die("La consulta fall&oacute;P1:$consulta_resultados ". mysqli_error($enlace) );	

	if(@mysqli_num_rows($resultado_360_competencias)>=1)
    {
        $table = '<table>
        <thead>
            <th>Competencia</th>
            <th>Resultado 360</th>
            <th>Resultado 360 Normalizado</th>
        </thead>
        <tbody>';
        while ($res_competencias = mysqli_fetch_assoc($resultado_360_competencias)) {
            $table .= '<tr><td>'.$res_competencias['competencia'].'</td><td>'.$res_competencias['resultado'].'</td><td>'.$res_competencias['resultado_normalizado'].'</td></tr>';
        }
        $table .= '  </tbody>
        </table>';
        echo $table;
    }
?>