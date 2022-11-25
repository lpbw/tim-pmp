<?

$verev = $_REQUEST["verev"];
//if($_GET['generarPDF']!=""){
  date_default_timezone_set('America/Chihuahua');
  
    include_once 'evaluacion_imp2.php';
    require_once(dirname(__FILE__)."/dompdf/dompdf_config.inc.php");
    require_once ("dompdf/include/style.cls.php");
    
      $html= htmlEvaluacion();
      echo "asdf".$html;
//      $pdf = new DOMPDF();
//      $pdf ->load_html($html);
//      $pdf ->render();
//      $archivo="pdfs/evaluacion_$verev.pdf";
//      file_put_contents($archivo,$pdf->output());
//      $pdf ->stream("evaluacion_$verev.pdf");
//
//      $x= htmlEvaluacion();
//}
?>