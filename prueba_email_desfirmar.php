<?php
    $EmailFrom = "notificaciones@tim-pmp.com";
    $EmailTo = "gmartinez01@bellflight.com";
    //$EmailTo = "luis.perez@bluewolf.com.mx";

    $Body = "<html xmlns=\"http://www.w3.org/1999/xhtml\">
    <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
    <title>TIM-PMP</title>
    <link href=\"http://www.tim-pmp.com/images/textos.css\" rel=\"stylesheet\" type=\"text/css\" />
    <style type=\"text/css\">
    <!--
    body {
        margin-left: 0px;
        margin-top: 0px;
    }
    .style1 {font-size: 16px}
    -->
    </style></head>
    
    <body>
    <table width=\"617\" border=\"0\" cellspacing=\"2\" cellpadding=\"0\">
      <tr>
        <td><div align=\"center\"><img src=\"http://www.tim-pmp.com/images/bell.png\" width=\"90\" height=\"51\" /></div></td>
      </tr>
      <tr>
        <td><div align=\"center\" class=\"text_grande\">Gestion de Desempeño </div></td>
      </tr>
      <tr>
        <td><p>&nbsp;</p>
          <p>Tu coordinador ha desfirmado tus objetivos.</p>
          <p>Te invitamos a entrar a la plataforma para hacer las modificaciones necesarias y volver a firmar la planeación, en la sección de tareas pendientes encontraras una liga  \"Planeación de Objetivos\"  </p>
          <p align=\"center\"><a href=\"http://www.tim-pmp.com\" class=\"boton style1\">http:///www.tim-pmp.com</a></p>
        <p align=\"left\">Es importante completar el proceso de revisión para no tener problemas en futuras etapas</p>
        <p align=\"left\">. </p></td>
      </tr>
      <tr>
        <td class=\"texto_chico\"><div align=\"center\">Este correo electronico fue generado automaticamente y no requiere ser contestado, para cualquier duda acudir al departamento de Recursos Humanos  </div></td>
      </tr>
    </table>
    </body>
    </html>";
    $Subject = "TIM-PMP -  Planeación de Objetivos";
    
    $success2 = mail($EmailTo, $Subject, $Body, "From: TIM-PMP <$EmailFrom>\nContent-type: text/html; charset=utf-8\n");
    echo"<script>alert(\"Planeacion Desfirmada\");</script>";
?>