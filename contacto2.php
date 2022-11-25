<?
ini_set('display_errors', 'On');
		
		

		$success2 = mail("mgarciavarela@gmail.com", "Prueba", "Prueba", "From:notificaciones@tim-pmp.com");
		
		
		
		
		
			if ($success2){
			  print "<script>alert('Tu comentario ha sido enviado. Gracias!');</script>";
			}
			else{
		 		 print "<script>alert('Error en el envio intente de nuevo');</script>";
			}





?>
